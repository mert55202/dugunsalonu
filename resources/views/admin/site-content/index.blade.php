@extends('admin.layouts.app')
@section('title', 'Sayfa icerikleri')
@section('content')
<div class="card">
    <div class="card-body">
        <p class="text-muted">Metin ve gorselleri sayfa bazinda duzenleyin. Yuklenen dosyalar <code>storage/app/public/site</code> altinda saklanir.</p>
        <ul class="list-group list-group-flush border rounded">
            @foreach($pages as $key => $page)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $page['label'] ?? $key }}</span>
                    <a href="{{ route('admin.site-content.edit', $key) }}" class="btn btn-sm btn-primary">Duzenle</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
