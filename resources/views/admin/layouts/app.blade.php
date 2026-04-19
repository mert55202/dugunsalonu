<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Dugun Salonu</title>
    <link href="{{ asset('themes/limitless/bs5/template/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('themes/limitless/bs5/template/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('themes/limitless/bs5/template/html/layout_1/full/assets/css/ltr/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('themes/limitless/bs5/template/assets/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('themes/limitless/bs5/template/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
</head>
<body>
<div class="navbar navbar-dark navbar-static border-bottom border-bottom-white border-opacity-10">
    <div class="container-fluid">
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill">
                <i class="ph-list"></i>
            </button>
        </div>
        <span class="navbar-brand">Dugun Salonu Admin</span>
    </div>
</div>
<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">
        <div class="sidebar-content">
            <div class="sidebar-section">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                    <li class="nav-item"><a href="{{ route('admin.settings.edit') }}" class="nav-link">Ayarlar</a></li>
                    <li class="nav-item"><a href="{{ route('admin.site-content.index') }}" class="nav-link">Sayfa icerikleri</a></li>
                    <li class="nav-item"><a href="{{ route('admin.services.index') }}" class="nav-link">Hizmetler</a></li>
                    <li class="nav-item"><a href="{{ route('admin.work-galleries.index') }}" class="nav-link">Galeri</a></li>
                    <li class="nav-item"><a href="{{ route('admin.portfolios.index') }}" class="nav-link">Portfolyo</a></li>
                    <li class="nav-item"><a href="{{ route('admin.testimonials.index') }}" class="nav-link">Yorumlar</a></li>
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Siteyi Gor</a></li>
                    <li class="nav-item mt-2">
                        <form method="POST" action="{{ route('admin.logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="nav-link" style="background:transparent;border:0;width:100%;text-align:left;cursor:pointer;">
                                Cikis
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="page-header page-header-light shadow"><div class="page-header-content d-lg-flex"><div class="d-flex"><h4 class="page-title mb-0">@yield('title')</h4></div></div></div>
            <div class="content">
                @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
                @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                @yield('content')
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('themes/limitless/bs5/template/html/layout_1/full/assets/js/app.js') }}"></script>
</body>
</html>
