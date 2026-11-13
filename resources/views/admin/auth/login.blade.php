@extends('admin.auth.layouts.guest')
@section('title', 'Admin Girisi')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Admin Girisi</h5>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">E-posta</label>
                        <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sifre</label>
                        <input name="password" type="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Giris Yap</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

