@php
    use App\Models\ContentItem;
    $imgBase = 'themes/weddingphotos/content/weddingphotos/images/';
@endphp
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu'))</title>
    <meta name="description" content="@yield('meta_description', $setting?->seo_description ?: ($setting?->hero_subtitle ?? ''))">
    <meta name="keywords" content="@yield('meta_keywords', $setting?->seo_keywords ?: '')">
    <meta property="og:title" content="@yield('og_title', $setting?->seo_title ?: ($setting?->site_title ?? ''))">
    <meta property="og:description" content="@yield('og_description', $setting?->seo_description ?: ($setting?->hero_subtitle ?? ''))">
    <meta property="og:type" content="website">
    @php
        $ogImage = trim($__env->yieldContent('og_image'));
        if ($ogImage === '') {
            $ogImage = $setting?->og_image ?? '';
        }
    @endphp
    @if($ogImage)
        <meta property="og:image" content="{{ asset($ogImage) }}">
    @endif
    <link rel="shortcut icon" href="{{ ContentItem::media('shared', 'favicon', $imgBase.'favicon.ico') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:100,300,400,400italic,500,700,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair+Display:100,300,400,400italic,500,700,900">
    <link rel="stylesheet" href="{{ asset('themes/weddingphotos/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/weddingphotos/content/weddingphotos/css/structure.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/weddingphotos/content/weddingphotos/css/weddingphotos.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/weddingphotos/content/weddingphotos/css/custom.css') }}">
</head>
<body class="@yield('body_class', 'home page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')">
<div id="Wrapper">
    <div id="Header_wrapper">
        <header id="Header">
            <div id="Top_bar">
                <div class="container">
                    <div class="column one">
                        <div class="top_bar_left clearfix">
                            <div class="logo">
                                <a id="logo" href="{{ route('home') }}" title="{{ $setting?->site_title ?? 'Dugun Salonu' }}">
                                    <img class="logo-main scale-with-grid" src="{{ ContentItem::media('shared', 'logo_retina', $imgBase.'wedingphotos-logo-retina.png') }}" data-retina="{{ ContentItem::media('shared', 'logo_standard', $imgBase.'weddingphotos-logo.png') }}" data-height="87" data-no-retina />
                                    <img class="logo-sticky scale-with-grid" src="{{ ContentItem::media('shared', 'logo_retina', $imgBase.'wedingphotos-logo-retina.png') }}" data-retina="{{ ContentItem::media('shared', 'logo_standard', $imgBase.'weddingphotos-logo.png') }}" data-height="87" data-no-retina />
                                    <img class="logo-mobile scale-with-grid" src="{{ ContentItem::media('shared', 'logo_retina', $imgBase.'wedingphotos-logo-retina.png') }}" data-retina="{{ ContentItem::media('shared', 'logo_standard', $imgBase.'weddingphotos-logo.png') }}" data-height="87" data-no-retina />
                                    <img class="logo-mobile-sticky scale-with-grid" src="{{ ContentItem::media('shared', 'logo_retina', $imgBase.'wedingphotos-logo-retina.png') }}" data-retina="{{ ContentItem::media('shared', 'logo_standard', $imgBase.'weddingphotos-logo.png') }}" data-height="87" data-no-retina />
                                </a>
                            </div>
                            <div class="menu_wrapper">
                                <nav id="menu">
                                    <ul id="menu-main-menu-left" class="menu menu-main menu_left">
                                        <li class="@if(request()->routeIs('home')) current-menu-item @endif"><a href="{{ route('home') }}"><span>{{ ContentItem::text('shared', 'menu_home_label', 'Anasayfa') }}</span></a></li>
                                        <li class="@if(request()->routeIs('about')) current-menu-item @endif"><a href="{{ route('about') }}"><span>{{ ContentItem::text('shared', 'menu_about_label', 'Hakkimizda') }}</span></a></li>
                                        <li class="@if(request()->routeIs('works')) current-menu-item @endif"><a href="{{ route('works') }}"><span>{{ ContentItem::text('shared', 'menu_works_label', 'Calismalar') }}</span></a></li>
                                    </ul>
                                    <ul id="menu-main-menu-right" class="menu menu-main menu_right">
                                        <li class="@if(request()->routeIs('services.page')) current-menu-item @endif"><a href="{{ route('services.page') }}"><span>{{ ContentItem::text('shared', 'menu_services_label', 'Hizmetler') }}</span></a></li>
                                        <li class="@if(request()->routeIs('contact')) current-menu-item @endif"><a href="{{ route('contact') }}"><span>{{ ContentItem::text('shared', 'menu_contact_label', 'Iletisim') }}</span></a></li>
                                    </ul>
                                </nav>
                                <a class="responsive-menu-toggle" href="#"><i class="icon-menu-fine"></i></a>
                            </div>
                            <div class="secondary_menu_wrapper">
                                <nav id="secondary-menu" class="menu-main-menu-right-container">
                                    <ul id="menu-main-menu-right-1" class="secondary-menu">
                                        <li><a href="{{ route('services.page') }}">{{ ContentItem::text('shared', 'menu_services_label', 'Hizmetler') }}</a></li>
                                        <li><a href="{{ route('contact') }}">{{ ContentItem::text('shared', 'menu_contact_label', 'Iletisim') }}</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @stack('subheader')
    </div>

    @yield('content')

    @include('frontend.partials.footer-widgets')
</div>
<div id="Side_slide" class="right dark" data-width="250">
    <div class="close-wrapper"><a href="#" class="close"><i class="icon-cancel-fine"></i></a></div>
    <div class="extras"><div class="extras-wrapper"></div></div>
    <div class="menu_wrapper"></div>
</div>
<div id="body_overlay"></div>
<script src="{{ asset('themes/weddingphotos/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/jquery-migrate-3.4.0.min.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/mfn.menu.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/jquery.plugins.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/jquery.jplayer.min.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/animations/animations.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/translate3d.js') }}"></script>
<script src="{{ asset('themes/weddingphotos/js/scripts.js') }}"></script>
@stack('scripts')
</body>
</html>
