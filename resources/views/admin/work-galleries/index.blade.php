@extends('admin.layouts.app')
@section('title', 'Galeri Postlari')
@section('content')
<a href="{{ route('admin.work-galleries.create') }}" class="btn btn-primary mb-3">Yeni Galeri Postu</a>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-striped align-middle">
            <thead>
            <tr>
                <th>Baslik</th>
                <th>Aciklama</th>
                <th>Sira</th>
                <th>Aktif</th>
                <th>Fotograf</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td style="max-width: 380px;">{{ \Illuminate\Support\Str::limit($post->description ?? '', 70) }}</td>
                    <td>{{ $post->sort_order }}</td>
                    <td>{{ $post->is_active ? 'Evet' : 'Hayir' }}</td>
                    <td>{{ $post->photos()->count() }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.work-galleries.edit', $post) }}" class="btn btn-sm btn-warning">Duzenle</a>
                        <form method="POST" action="{{ route('admin.work-galleries.destroy', $post) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

