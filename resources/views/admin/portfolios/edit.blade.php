@extends('admin.layouts.app')
@section('title', 'Portfolyo Duzenle')
@section('content')
<form method="POST" action="{{ route('admin.portfolios.update', $portfolio) }}">@csrf @method('PUT')
<div class="card"><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Baslik</label><input name="title" class="form-control" value="{{ old('title',$portfolio->title) }}" required></div>
<div class="col-md-6"><label class="form-label">URL slug</label><input name="slug" class="form-control" value="{{ old('slug',$portfolio->slug) }}" placeholder="ornek: dugun-gecesi"></div>
<div class="col-md-6"><label class="form-label">Cift Adi</label><input name="couple_name" class="form-control" value="{{ old('couple_name',$portfolio->couple_name) }}" required></div>
<div class="col-md-6"><label class="form-label">Musteri / gorunen isim</label><input name="client_name" class="form-control" value="{{ old('client_name',$portfolio->client_name) }}"></div>
<div class="col-md-6"><label class="form-label">Proje tarihi</label><input name="project_date" class="form-control" value="{{ old('project_date',$portfolio->project_date) }}"></div>
<div class="col-md-12"><label class="form-label">Aciklama</label><textarea name="description" class="form-control" rows="4">{{ old('description',$portfolio->description) }}</textarea></div>
<div class="col-md-6"><label class="form-label">Gorsel Path</label><input name="image_path" class="form-control" value="{{ old('image_path',$portfolio->image_path) }}" required></div>
<div class="col-md-6"><label class="form-label">Video URL</label><input name="video_url" class="form-control" value="{{ old('video_url',$portfolio->video_url) }}"></div>
<div class="col-md-3"><label class="form-label">Sira</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$portfolio->sort_order) }}" required></div>
<div class="col-md-3"><label class="form-label">Aktif</label><input type="checkbox" name="is_active" value="1" {{ $portfolio->is_active ? 'checked' : '' }}></div>
<div class="col-12"><p class="text-muted small mb-0">Onizleme: <a href="{{ route('portfolio.show', ['slug' => $portfolio->slug]) }}" target="_blank" rel="noopener">{{ route('portfolio.show', ['slug' => $portfolio->slug]) }}</a></p></div>
<div class="col-12"><button class="btn btn-primary">Kaydet</button></div></div></div></form>
@endsection
