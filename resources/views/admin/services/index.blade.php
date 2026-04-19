@extends('admin.layouts.app')
@section('title', 'Hizmetler')
@section('content')
<a href="{{ route('admin.services.create') }}" class="btn btn-primary mb-3">Yeni Hizmet</a>
<div class="card"><div class="table-responsive"><table class="table"><thead><tr><th>Baslik</th><th>Sira</th><th>Durum</th><th></th></tr></thead><tbody>
@foreach($services as $service)
<tr><td>{{ $service->title }}</td><td>{{ $service->sort_order }}</td><td>{{ $service->is_active ? 'Aktif' : 'Pasif' }}</td><td><a href="{{ route('admin.services.edit',$service) }}" class="btn btn-sm btn-warning">Duzenle</a> <form method="POST" action="{{ route('admin.services.destroy',$service) }}" class="d-inline">@csrf @method('DELETE') <button class="btn btn-sm btn-danger">Sil</button></form></td></tr>
@endforeach
</tbody></table></div></div>
@endsection
