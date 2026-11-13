<!DOCTYPE html>
<html lang="tr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Girisi')</title>
    <link href="{{ asset('themes/limitless/bs5/template/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('themes/limitless/bs5/template/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('themes/limitless/bs5/template/html/layout_1/full/assets/css/ltr/all.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('themes/limitless/bs5/template/assets/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('themes/limitless/bs5/template/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
</head>
<body style="background:#f7f7fb;">
    <div class="container py-5">
        @yield('content')
    </div>
</body>
</html>

