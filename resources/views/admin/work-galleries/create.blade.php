@extends('admin.layouts.app')
@section('title', 'Galeri Postu Ekle')
@section('content')
<form method="POST" action="{{ route('admin.work-galleries.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="card">
        <div class="card-body row g-3">
            <div class="col-md-6">
                <label class="form-label">Baslik</label>
                <input name="title" class="form-control" value="{{ old('title') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sira</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" required>
            </div>
            <div class="col-12">
                <label class="form-label">Aciklama</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="col-md-3">
                <label class="form-label">Aktif</label>
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
            </div>
            <div class="col-12">
                <label class="form-label">Fotograflar (maks 20 adet)</label>
                <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</form>
@endsection

