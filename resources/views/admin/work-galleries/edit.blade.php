@extends('admin.layouts.app')
@section('title', 'Galeri Postu Duzenle')
@section('content')
<form method="POST" action="{{ route('admin.work-galleries.update', $post) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label">Baslik</label>
                <input name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sira</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $post->sort_order) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Aciklama</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $post->description) }}</textarea>
            </div>
            <div class="col-md-3">
                <label class="form-label">Aktif</label>
                <input type="checkbox" name="is_active" value="1" {{ $post->is_active ? 'checked' : '' }}>
            </div>
            <div class="col-12">
                <label class="form-label">Yeni Fotograflar (toplam maks 20)</label>
                <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
                @error('photos')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12">
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="fw-bold">Mevcut Fotograflar ({{ $post->photos->count() }})</div>
                </div>
                <div class="row g-2">
                    @foreach($post->photos as $photo)
                        <div class="col-md-3 col-sm-4 col-6">
                            <div class="border rounded p-2">
                                <img src="{{ asset($photo->image_path) }}" class="img-fluid rounded border" style="max-height:90px; object-fit:cover;" alt="">
                                <form method="POST" action="{{ route('admin.work-galleries.photos.destroy', [$post, $photo]) }}" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger w-100" onclick="return confirm('Silinsin mi?')">Sil</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary">Kaydet</button>
                <a href="{{ route('admin.work-galleries.index') }}" class="btn btn-light ms-2">Listeye don</a>
            </div>
        </div>
    </div>
</form>
@endsection

