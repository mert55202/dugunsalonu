@extends('admin.layouts.app')
@section('title', ($definition['label'] ?? $page) . ' — icerik')
@section('content')
<form method="POST" action="{{ route('admin.site-content.update', $page) }}" enctype="multipart/form-data">@csrf @method('PUT')
<div class="card"><div class="card-body row g-3">
@foreach($definition['fields'] as $field => $meta)
    @php $type = $meta['type'] ?? 'text'; $cur = $values[$field] ?? ''; @endphp
    <div class="col-12"><h6 class="mb-0">{{ $meta['label'] ?? $field }}</h6><small class="text-muted">{{ $field }}</small></div>
    @if($type === 'image')
        <div class="col-md-6">
            @if($cur !== '')
                <div class="mb-2"><img src="{{ str_starts_with($cur, 'http') ? $cur : asset($cur) }}" alt="" class="img-fluid rounded border" style="max-height:160px"></div>
                <div class="small text-break">{{ $cur }}</div>
            @else
                <p class="text-muted small mb-0">Varsayilan tema gorseli kullaniliyor.</p>
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">Yeni dosya yukle</label>
            <input type="file" name="upload[{{ $field }}]" class="form-control" accept="image/*,.ico">
        </div>
    @elseif($type === 'textarea')
        <div class="col-12">
            <textarea name="value[{{ $field }}]" class="form-control" rows="5">{{ old('value.'.$field, $cur) }}</textarea>
        </div>
    @else
        <div class="col-12">
            <input type="text" name="value[{{ $field }}]" class="form-control" value="{{ old('value.'.$field, $cur) }}">
        </div>
    @endif
    <div class="col-12"><hr class="my-2"></div>
@endforeach
<div class="col-12 d-flex gap-2">
    <button type="submit" class="btn btn-primary">Kaydet</button>
    <a href="{{ route('admin.site-content.index') }}" class="btn btn-light">Listeye don</a>
</div>
</div></div>
</form>
@endsection
