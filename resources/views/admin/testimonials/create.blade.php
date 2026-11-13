@extends('admin.layouts.app')
@section('title', 'Yorum Ekle')
@section('content')
<form method="POST" action="{{ route('admin.testimonials.store') }}">@csrf
<div class="card"><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Ad Soyad</label><input name="name" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Avatar Path</label><input name="avatar_path" class="form-control" value="themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic11-85x85.png" required></div>
<div class="col-md-12"><label class="form-label">Yorum</label><textarea name="content" class="form-control" required></textarea></div>
<div class="col-md-3"><label class="form-label">Sira</label><input type="number" name="sort_order" class="form-control" value="0" required></div>
<div class="col-md-3"><label class="form-label">Aktif</label><input type="checkbox" name="is_active" value="1" checked></div>
<div class="col-12"><button class="btn btn-primary">Kaydet</button></div></div></div></form>
@endsection
