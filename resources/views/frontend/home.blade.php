@extends('frontend.layouts.app')

@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
@endphp

@section('body_class', 'home page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')
@section('title', ContentItem::text('home', 'page_title_prefix', 'Anasayfa') . ' - ' . ($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('home', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('home', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('home', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('home', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('home', 'og_image', $ogImageDefault))

@section('content')
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section" style="padding-top:0px; padding-bottom:40px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix" style="padding:17% 0 0">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix align_center">
                                        <h2>{!! ContentItem::text('home', 'hero_title_html', 'Fotografin Buyusu') !!}</h2>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        <p class="big">{{ ContentItem::text('home', 'hero_subtitle', '') }}</p>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border hover-disable">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('home', 'hero_image_intro', $b.'home_weddingphotos_pic2.png') }}" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section full-width" style="padding-top:0px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('home', 'hero_image_banner', $b.'weddingphotos-pic1.jpg') }}" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:90px; padding-bottom:50px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix align_center">
                                        <h2>{{ ContentItem::text('home', 'services_section_title', 'Hizmetlerimiz') }}</h2>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_divider"><hr class="no_line" style="margin: 0 auto 20px;" /></div>
                            </div>
                        </div>
                        @foreach($services as $service)
                        <div class="wrap mcb-wrap one-fourth valign-top clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ asset($service->icon_path) }}" alt="" /></div>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix align_center">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ $service->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_divider"><hr class="no_line" style="margin: 0 auto 20px;" /></div>
                                <div class="column mcb-column one-fourth column_placeholder"><div class="placeholder">&nbsp;</div></div>
                                <div class="column mcb-column one-second column_column">
                                    <div class="column_attr clearfix align_center">
                                        <p>{{ ContentItem::text('home', 'services_mid_text', '') }}</p>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_button">
                                    <div class="button_align align_center">
                                        @php $cta = ContentItem::text('home', 'services_cta_url', '/services-page'); @endphp
                                        <a class="button button_size_2 button_dark button_js" href="{{ str_starts_with($cta, 'http') ? $cta : url($cta) }}"><span class="button_label">{{ ContentItem::text('home', 'services_cta_label', 'Hizmetlerimiz') }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:0px; padding-bottom:0px; background-image:url({{ ContentItem::media('home', 'highlight_section_bg', $b.'weddingphotos-bg2.jpg') }}); background-repeat:no-repeat; background-position:center top;">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix" style="padding:90px 0 160px; background-image:url({{ ContentItem::media('home', 'highlight_wrap_bg', $b.'home_weddingphotos_pic7.jpg') }}); background-repeat:no-repeat; background-position:center top;">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one-second column_column">
                                    <div class="column_attr clearfix align_left mobile_align_center" style="padding:0 10%;">
                                        <h2 style="color: #fff;">{{ ContentItem::text('home', 'highlight_title', '') }}</h2>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        <p style="color: #fff;">{{ ContentItem::text('home', 'highlight_subtitle', '') }}</p>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        @php $v = ContentItem::text('home', 'highlight_video_url', '#'); @endphp
                                        <a class="button button_size_2 button_dark button_js" href="{{ $v }}" rel="prettyphoto"><span class="button_label">{{ ContentItem::text('home', 'highlight_play_label', 'Videoyu Oynat') }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:25px; padding-bottom:50px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix" style="padding:0 1%">
                            <div class="mcb-wrap-inner">
                                @foreach($portfolios->take(3) as $p)
                                <div class="column mcb-column one-third column_zoom_box">
                                    <div class="zoom_box">
                                        @php
                                            $href = $p->video_url ?: (filled($p->slug) ? route('portfolio.show', ['slug' => $p->slug]) : route('works'));
                                        @endphp
                                        <a href="{{ $href }}" @if($p->video_url) rel="prettyphoto" @endif>
                                            <div class="photo"><img class="scale-with-grid" src="{{ asset($p->image_path) }}" alt="" /></div>
                                            <div class="desc" style="background-color:rgba(58, 58, 58, 0.8);">
                                                <div class="desc_wrap">
                                                    <div class="desc_txt">
                                                        <h3 style="color: #fff;">{{ $p->title }}</h3>
                                                        <h6 style="color: #fff;">{{ $p->couple_name }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                <div class="column mcb-column one column_divider"><hr class="no_line" style="margin: 0 auto 20px;" /></div>
                                <div class="column mcb-column one column_button">
                                    <div class="button_align align_center">
                                        @php $pb = ContentItem::text('home', 'portfolio_btn_url', '/works'); @endphp
                                        <a class="button button_size_2 button_dark button_js" href="{{ str_starts_with($pb, 'http') ? $pb : url($pb) }}"><span class="button_label">{{ ContentItem::text('home', 'portfolio_btn_label', 'Portfolyomuz') }}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:0px; padding-bottom:50px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_testimonials">
                                    <div class="testimonials_slider single-photo">
                                        <ul class="testimonials_slider_ul">
                                            @foreach($testimonials as $t)
                                            <li>
                                                <div class="single-photo-img"><img src="{{ asset($t->avatar_path) }}" class="scale-with-grid wp-post-image" alt="" /></div>
                                                <div class="bq_wrapper"><blockquote>{{ $t->content }}</blockquote></div>
                                                <div class="hr_dots"><span></span><span></span><span></span></div>
                                                <div class="author"><h5>{{ $t->name }}</h5><span class="company"></span></div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="slider_pager slider_pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
