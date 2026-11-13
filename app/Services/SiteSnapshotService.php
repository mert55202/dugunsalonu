<?php

namespace App\Services;

use App\Models\ContentItem;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\WorkGalleryPhoto;
use App\Models\WorkGalleryPost;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Throwable;

class SiteSnapshotService
{
    public static function path(): string
    {
        $p = env('SITE_SNAPSHOT_PATH');
        if (is_string($p) && $p !== '') {
            return $p;
        }

        // Hosting ortamlarında kod dizini (base_path) writeable olmayabiliyor.
        // Snapshot'u storage dizinine yazmak restore senaryolarını güvenli yapar.
        return storage_path('app/site_snapshot.json');
    }

    public static function dumpQuietly(): void
    {
        try {
            self::dump();
        } catch (Throwable) {
            // Kullanıcı akışını bozma
        }
    }

    public static function dump(): void
    {
        if (app()->environment('testing')) {
            return;
        }

        $payload = [
            'version' => 1,
            'dumped_at' => now()->toIso8601String(),
            'settings' => self::dumpSettings(),
            'content_items' => ContentItem::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'page' => $m->page,
                'field' => $m->field,
                'value' => $m->value,
            ])->values()->all(),
            'services' => Service::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'title' => $m->title,
                'description' => $m->description,
                'icon_path' => $m->icon_path,
                'sort_order' => $m->sort_order,
                'is_active' => (bool) $m->is_active,
            ])->values()->all(),
            'portfolios' => Portfolio::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'title' => $m->title,
                'slug' => $m->slug,
                'couple_name' => $m->couple_name,
                'client_name' => $m->client_name,
                'project_date' => $m->project_date,
                'description' => $m->description,
                'image_path' => $m->image_path,
                'video_url' => $m->video_url,
                'sort_order' => $m->sort_order,
                'is_active' => (bool) $m->is_active,
            ])->values()->all(),
            'testimonials' => Testimonial::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'name' => $m->name,
                'content' => $m->content,
                'avatar_path' => $m->avatar_path,
                'sort_order' => $m->sort_order,
                'is_active' => (bool) $m->is_active,
            ])->values()->all(),
            'work_gallery_posts' => WorkGalleryPost::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'title' => $m->title,
                'description' => $m->description,
                'sort_order' => $m->sort_order,
                'is_active' => (bool) $m->is_active,
            ])->values()->all(),
            'work_gallery_photos' => WorkGalleryPhoto::query()->get()->map(fn ($m) => [
                'id' => $m->id,
                'work_gallery_post_id' => $m->work_gallery_post_id,
                'image_path' => $m->image_path,
                'sort_order' => $m->sort_order,
            ])->values()->all(),
        ];

        $path = self::path();
        $dir = dirname($path);
        if (! File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        File::put($path, json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public static function importIfExistsQuietly(): void
    {
        try {
            self::importIfExists();
        } catch (Throwable) {
            // Restore'u engelleme
        }
    }

    public static function importIfExists(): void
    {
        if (app()->environment('testing')) {
            return;
        }

        $path = self::path();
        if (! File::exists($path)) {
            return;
        }

        $raw = File::get($path);
        if (! is_string($raw) || trim($raw) === '') {
            return;
        }

        $data = json_decode($raw, true);
        if (! is_array($data)) {
            return;
        }

        DB::transaction(function () use ($data): void {
            // FK dolayısıyla önce alt tablolar
            WorkGalleryPhoto::query()->delete();
            WorkGalleryPost::query()->delete();
            ContentItem::query()->delete();
            Service::query()->delete();
            Portfolio::query()->delete();
            Testimonial::query()->delete();
            Setting::query()->delete();

            $settings = $data['settings'] ?? [];
            foreach ($settings as $row) {
                $id = $row['id'] ?? null;
                if (! $id) {
                    continue;
                }

                Setting::query()->updateOrCreate(
                    ['id' => $id],
                    [
                        'site_title' => $row['site_title'] ?? null,
                        'hero_title' => $row['hero_title'] ?? null,
                        'hero_subtitle' => $row['hero_subtitle'] ?? null,
                        'phone' => $row['phone'] ?? null,
                        'email' => $row['email'] ?? null,
                        'address' => $row['address'] ?? null,
                        'seo_title' => $row['seo_title'] ?? null,
                        'seo_description' => $row['seo_description'] ?? null,
                        'seo_keywords' => $row['seo_keywords'] ?? null,
                        'og_image' => $row['og_image'] ?? null,
                    ]
                );
            }

            foreach (($data['content_items'] ?? []) as $row) {
                ContentItem::query()->updateOrCreate(
                    ['id' => $row['id'] ?? 0],
                    [
                        'page' => $row['page'] ?? '',
                        'field' => $row['field'] ?? '',
                        'value' => $row['value'] ?? null,
                    ]
                );
            }

            foreach (($data['services'] ?? []) as $row) {
                if (! isset($row['id'])) {
                    continue;
                }
                Service::query()->updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'title' => $row['title'] ?? '',
                        'description' => $row['description'] ?? '',
                        'icon_path' => $row['icon_path'] ?? '',
                        'sort_order' => (int) ($row['sort_order'] ?? 0),
                        'is_active' => (bool) ($row['is_active'] ?? true),
                    ]
                );
            }

            foreach (($data['portfolios'] ?? []) as $row) {
                if (! isset($row['id'])) {
                    continue;
                }
                Portfolio::query()->updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'title' => $row['title'] ?? '',
                        'slug' => $row['slug'] ?? null,
                        'couple_name' => $row['couple_name'] ?? '',
                        'client_name' => $row['client_name'] ?? null,
                        'project_date' => $row['project_date'] ?? null,
                        'description' => $row['description'] ?? null,
                        'image_path' => $row['image_path'] ?? '',
                        'video_url' => $row['video_url'] ?? null,
                        'sort_order' => (int) ($row['sort_order'] ?? 0),
                        'is_active' => (bool) ($row['is_active'] ?? true),
                    ]
                );
            }

            foreach (($data['testimonials'] ?? []) as $row) {
                if (! isset($row['id'])) {
                    continue;
                }
                Testimonial::query()->updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'name' => $row['name'] ?? '',
                        'content' => $row['content'] ?? '',
                        'avatar_path' => $row['avatar_path'] ?? '',
                        'sort_order' => (int) ($row['sort_order'] ?? 0),
                        'is_active' => (bool) ($row['is_active'] ?? true),
                    ]
                );
            }

            foreach (($data['work_gallery_posts'] ?? []) as $row) {
                if (! isset($row['id'])) {
                    continue;
                }
                WorkGalleryPost::query()->updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'title' => $row['title'] ?? '',
                        'description' => $row['description'] ?? null,
                        'sort_order' => (int) ($row['sort_order'] ?? 0),
                        'is_active' => (bool) ($row['is_active'] ?? true),
                    ]
                );
            }

            foreach (($data['work_gallery_photos'] ?? []) as $row) {
                if (! isset($row['id'])) {
                    continue;
                }
                WorkGalleryPhoto::query()->updateOrCreate(
                    ['id' => $row['id']],
                    [
                        'work_gallery_post_id' => (int) ($row['work_gallery_post_id'] ?? 0),
                        'image_path' => $row['image_path'] ?? '',
                        'sort_order' => (int) ($row['sort_order'] ?? 0),
                    ]
                );
            }
        });
    }

    private static function dumpSettings(): array
    {
        return Setting::query()->get()->map(fn ($m) => [
            'id' => $m->id,
            'site_title' => $m->site_title,
            'hero_title' => $m->hero_title,
            'hero_subtitle' => $m->hero_subtitle,
            'phone' => $m->phone,
            'email' => $m->email,
            'address' => $m->address,
            'seo_title' => $m->seo_title,
            'seo_description' => $m->seo_description,
            'seo_keywords' => $m->seo_keywords,
            'og_image' => $m->og_image,
        ])->values()->all();
    }
}

