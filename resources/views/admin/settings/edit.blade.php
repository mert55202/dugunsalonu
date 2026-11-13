@extends('admin.layouts.app')

@section('title', 'Site Ayarlari')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf
    @method('PUT')
    <div class="card"><div class="card-body row g-3">
        <div class="col-md-6"><label class="form-label">Site Basligi</label><input name="site_title" class="form-control" value="{{ old('site_title', $setting?->site_title) }}" required></div>
        <div class="col-md-6"><label class="form-label">Hero Baslik</label><input name="hero_title" class="form-control" value="{{ old('hero_title', $setting?->hero_title) }}" required></div>
        <div class="col-md-12"><label class="form-label">Hero Alt Baslik</label><input name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $setting?->hero_subtitle) }}" required></div>
        <div class="col-md-4"><label class="form-label">Telefon</label><input name="phone" class="form-control" value="{{ old('phone', $setting?->phone) }}"></div>
        <div class="col-md-4"><label class="form-label">E-posta</label><input name="email" class="form-control" value="{{ old('email', $setting?->email) }}"></div>
        <div class="col-md-4"><label class="form-label">Adres</label><input name="address" class="form-control" value="{{ old('address', $setting?->address) }}"></div>
        <div class="col-12"><hr></div>
        <div class="col-12"><h6 class="mb-0">SEO Ayarlari</h6></div>
        <div class="col-md-6"><label class="form-label">SEO Baslik</label><input name="seo_title" class="form-control" value="{{ old('seo_title', $setting?->seo_title) }}"></div>
        <div class="col-md-6"><label class="form-label">SEO Anahtar Kelimeler</label><input name="seo_keywords" class="form-control" value="{{ old('seo_keywords', $setting?->seo_keywords) }}" placeholder="dugun salonu, nisan, kina"></div>
        <div class="col-md-8"><label class="form-label">SEO Aciklama</label><textarea name="seo_description" class="form-control" rows="3">{{ old('seo_description', $setting?->seo_description) }}</textarea></div>
        <div class="col-md-4"><label class="form-label">OG Gorsel Path</label><input name="og_image" class="form-control" value="{{ old('og_image', $setting?->og_image) }}" placeholder="themes/weddingphotos/...jpg"></div>
        <div class="col-12"><button class="btn btn-primary">Kaydet</button></div>
    </div></div>
</form>
@endsection
