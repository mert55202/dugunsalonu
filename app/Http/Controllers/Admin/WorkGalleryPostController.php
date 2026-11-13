<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkGalleryPhoto;
use App\Models\WorkGalleryPost;
use App\Services\SiteSnapshotService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkGalleryPostController extends Controller
{
    public function index(): View
    {
        return view('admin.work-galleries.index', [
            'posts' => WorkGalleryPost::query()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.work-galleries.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'photos' => ['nullable', 'array', 'max:20'],
            'photos.*' => ['file', 'image', 'max:5120'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $post = WorkGalleryPost::query()->create($validated);

        $this->storeUploadedPhotos($post, $request->file('photos', []));

        SiteSnapshotService::dumpQuietly();

        return redirect()->route('admin.work-galleries.index')->with('success', 'Galeri eklendi.');
    }

    public function edit(WorkGalleryPost $workGallery): View
    {
        $workGallery->load('photos');

        return view('admin.work-galleries.edit', [
            'post' => $workGallery,
        ]);
    }

    public function update(Request $request, WorkGalleryPost $workGallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['file', 'image', 'max:5120'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $existingCount = $workGallery->photos()->count();
        $newCount = is_array($request->file('photos')) ? count($request->file('photos')) : 0;

        if ($existingCount + $newCount > 20) {
            return back()->withErrors(['photos' => 'Bu galeri postu icin toplam 20 fotograf limitini asamazsiniz.']);
        }

        $workGallery->update($validated);

        $this->storeUploadedPhotos($workGallery, $request->file('photos', []));

        SiteSnapshotService::dumpQuietly();

        return redirect()->route('admin.work-galleries.edit', $workGallery)->with('success', 'Galeri guncellendi.');
    }

    public function destroy(WorkGalleryPost $workGallery): RedirectResponse
    {
        $this->deletePhotos($workGallery);
        $workGallery->delete();

        SiteSnapshotService::dumpQuietly();

        return redirect()->route('admin.work-galleries.index')->with('success', 'Galeri silindi.');
    }

    public function destroyPhoto(WorkGalleryPost $workGallery, WorkGalleryPhoto $photo): RedirectResponse
    {
        // Yetkisiz/ilksiz silmeyi engelle
        if ($photo->work_gallery_post_id !== $workGallery->id) {
            return back()->withErrors(['photo' => 'Fotograf bu galeriye ait degil.']);
        }

        $relative = $this->relativePublicPath($photo->image_path);
        Storage::disk('public')->delete($relative);

        $photo->delete();

        SiteSnapshotService::dumpQuietly();

        return redirect()->route('admin.work-galleries.edit', $workGallery)->with('success', 'Fotograf silindi.');
    }

    private function storeUploadedPhotos(WorkGalleryPost $post, array $files): void
    {
        if (empty($files)) {
            return;
        }

        $nextSort = (int) ($post->photos()->max('sort_order') ?? 0) + 1;

        foreach ($files as $file) {
            if (! $file || ! $file->isValid()) {
                continue;
            }

            $path = $file->store('work-gallery/' . $post->id, 'public');
            if (!is_string($path)) {
                continue;
            }

            $post->photos()->create([
                'image_path' => 'storage/' . $path,
                'sort_order' => $nextSort++,
            ]);
        }
    }

    private function deletePhotos(WorkGalleryPost $post): void
    {
        $photos = WorkGalleryPhoto::query()
            ->where('work_gallery_post_id', $post->id)
            ->get();

        foreach ($photos as $photo) {
            $relative = $this->relativePublicPath($photo->image_path);
            Storage::disk('public')->delete($relative);
            $photo->delete();
        }
    }

    private function relativePublicPath(string $imagePath): string
    {
        // imagePath DB formatimiz: "storage/<subPath>"
        $imagePath = trim($imagePath);
        $imagePath = str_starts_with($imagePath, 'storage/') ? substr($imagePath, 8) : $imagePath;

        return $imagePath;
    }
}

