@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3"><div class="card"><div class="card-body"><h6>Hizmet</h6><h3>{{ $stats['services'] }}</h3></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><h6>Portfolyo</h6><h3>{{ $stats['portfolios'] }}</h3></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><h6>Yorum</h6><h3>{{ $stats['testimonials'] }}</h3></div></div></div>
    <div class="col-md-3"><div class="card"><div class="card-body"><h6>Ayar Durumu</h6><h3>{{ $stats['hasSettings'] ? 'Hazir' : 'Eksik' }}</h3></div></div></div>
</div>
@endsection
