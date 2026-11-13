@extends('admin.layouts.app')
@section('title', 'Yorumlar')
@section('content')
<a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mb-3">Yeni Yorum</a>
<div class="card"><div class="table-responsive"><table class="table"><thead><tr><th>Ad Soyad</th><th>Metin</th><th>Sira</th><th></th></tr></thead><tbody>
@foreach($testimonials as $testimonial)
<tr><td>{{ $testimonial->name }}</td><td>{{ $testimonial->content }}</td><td>{{ $testimonial->sort_order }}</td><td><a href="{{ route('admin.testimonials.edit',$testimonial) }}" class="btn btn-sm btn-warning">Duzenle</a> <form method="POST" action="{{ route('admin.testimonials.destroy',$testimonial) }}" class="d-inline">@csrf @method('DELETE') <button class="btn btn-sm btn-danger">Sil</button></form></td></tr>
@endforeach
</tbody></table></div></div>
@endsection
