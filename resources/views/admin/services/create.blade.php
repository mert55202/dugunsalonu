@extends('admin.layouts.app')
@section('title', 'Hizmet Ekle')
@section('content')
<form method="POST" action="{{ route('admin.services.store') }}">@csrf
<div class="card"><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Baslik</label><input name="title" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Icon Path</label><input name="icon_path" class="form-control" value="themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon1.png" required></div>
<div class="col-md-12"><label class="form-label">Aciklama</label><textarea name="description" class="form-control" required></textarea></div>
<div class="col-md-3"><label class="form-label">Sira</label><input type="number" name="sort_order" class="form-control" value="0" required></div>
<div class="col-md-3"><label class="form-label">Aktif</label><input type="checkbox" name="is_active" value="1" checked></div>
<div class="col-12"><button class="btn btn-primary">Kaydet</button></div></div></div></form>
@endsection
