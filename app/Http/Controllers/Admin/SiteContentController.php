<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentItem;
use App\Services\SiteSnapshotService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function index(): View
    {
        $pages = config('content_fields.pages', []);

        return view('admin.site-content.index', compact('pages'));
    }

    public function edit(string $page): View
    {
        $pages = config('content_fields.pages', []);
        abort_unless(isset($pages[$page]), 404);

        $definition = $pages[$page];
        $values = ContentItem::query()
            ->where('page', $page)
            ->pluck('value', 'field')
            ->all();

        return view('admin.site-content.edit', [
            'page' => $page,
            'definition' => $definition,
            'values' => $values,
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $pages = config('content_fields.pages', []);
        abort_unless(isset($pages[$page]), 404);

        $fields = $pages[$page]['fields'];

        foreach ($fields as $field => $meta) {
            $file = $request->file("upload.$field");
            if ($file && $file->isValid()) {
                $path = $file->store('site', 'public');
                ContentItem::query()->updateOrCreate(
                    ['page' => $page, 'field' => $field],
                    ['value' => 'storage/'.$path]
                );

                continue;
            }

            $type = $meta['type'] ?? 'text';
            if ($type === 'image') {
                continue;
            }

            ContentItem::query()->updateOrCreate(
                ['page' => $page, 'field' => $field],
                ['value' => (string) $request->input("value.$field", '')]
            );
        }

        ContentItem::flushCache();
        SiteSnapshotService::dumpQuietly();

        return redirect()->route('admin.site-content.edit', $page)->with('success', 'Icerik kaydedildi.');
    }
}
