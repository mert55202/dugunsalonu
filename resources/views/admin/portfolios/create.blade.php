@extends('admin.layouts.app')
@section('title', 'Portfolyo Ekle')
@section('content')
<form method="POST" action="{{ route('admin.portfolios.store') }}">@csrf
<div class="card"><div class="card-body row g-3">
<div class="col-md-6"><label class="form-label">Baslik</label><input name="title" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">URL slug (bos birakilirsa otomatik)</label><input name="slug" class="form-control" placeholder="ornek: dugun-gecesi"></div>
<div class="col-md-6"><label class="form-label">Cift Adi</label><input name="couple_name" class="form-control" required></div>
<div class="col-md-6"><label class="form-label">Musteri / gorunen isim</label><input name="client_name" class="form-control" placeholder="Listelerde Client satiri"></div>
<div class="col-md-6"><label class="form-label">Proje tarihi (metin)</label><input name="project_date" class="form-control" placeholder="Ornek: Eylul 2025"></div>
<div class="col-md-12"><label class="form-label">Aciklama</label><textarea name="description" class="form-control" rows="4"></textarea></div>
<div class="col-md-6"><label class="form-label">Gorsel Path</label><input name="image_path" class="form-control" value="themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic8.jpg" required></div>
<div class="col-md-6"><label class="form-label">Video URL</label><input name="video_url" class="form-control" placeholder="https://..."></div>
<div class="col-md-3"><label class="form-label">Sira</label><input type="number" name="sort_order" class="form-control" value="0" required></div>
<div class="col-md-3"><label class="form-label">Aktif</label><input type="checkbox" name="is_active" value="1" checked></div>
<div class="col-12"><button class="btn btn-primary">Kaydet</button></div></div></div></form>
@endsection
