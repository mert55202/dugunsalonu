@extends('admin.layouts.app')
@section('title', 'Yorum Duzenle')
@section('content')
<form method="POST" action="{{ route('admin.testimonials.update', $testimonial) }}">@csrf @method('PUT')
<div class="card"><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Ad Soyad</label><input name="name" class="form-control" value="{{ old('name',$testimonial->name) }}" required></div>
<div class="col-md-6"><label class="form-label">Avatar Path</label><input name="avatar_path" class="form-control" value="{{ old('avatar_path',$testimonial->avatar_path) }}" required></div>
<div class="col-md-12"><label class="form-label">Yorum</label><textarea name="content" class="form-control" required>{{ old('content',$testimonial->content) }}</textarea></div>
<div class="col-md-3"><label class="form-label">Sira</label><input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$testimonial->sort_order) }}" required></div>
<div class="col-md-3"><label class="form-label">Aktif</label><input type="checkbox" name="is_active" value="1" {{ $testimonial->is_active ? 'checked' : '' }}></div>
<div class="col-12"><button class="btn btn-primary">Kaydet</button></div></div></div></form>
@endsection
