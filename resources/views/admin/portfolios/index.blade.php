@extends('admin.layouts.app')
@section('title', 'Portfolyo')
@section('content')
<a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary mb-3">Yeni Portfolyo</a>
<div class="card"><div class="table-responsive"><table class="table"><thead><tr><th>Baslik</th><th>Cift</th><th>Sira</th><th></th></tr></thead><tbody>
@foreach($portfolios as $portfolio)
<tr><td>{{ $portfolio->title }}</td><td>{{ $portfolio->couple_name }}</td><td>{{ $portfolio->sort_order }}</td><td><a href="{{ route('admin.portfolios.edit',$portfolio) }}" class="btn btn-sm btn-warning">Duzenle</a> <form method="POST" action="{{ route('admin.portfolios.destroy',$portfolio) }}" class="d-inline">@csrf @method('DELETE') <button class="btn btn-sm btn-danger">Sil</button></form></td></tr>
@endforeach
</tbody></table></div></div>
@endsection
