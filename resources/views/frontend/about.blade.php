@extends('frontend.layouts.app')

@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
@endphp

@section('title', ContentItem::text('about', 'page_title_prefix', 'Hakkimizda') . ' - ' . ($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('about', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('about', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('about', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('about', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('about', 'og_image', $ogImageDefault))
@section('body_class', 'page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')

@push('subheader')
<div id="Subheader" style="padding:190px 20% 100px">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ ContentItem::text('about', 'subheader_title', '') }}</h1>
        </div>
    </div>
</div>
@endpush

@section('content')
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section equal-height-wrap" style="padding-top:0px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('about', 'profile_image', $b.'home_weddingphotos_pic16.jpg') }}" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <h2>{{ ContentItem::text('about', 'profile_name', '') }}</h2>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        {!! ContentItem::text('about', 'profile_body_html', '') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:40px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                @foreach([
                                    ['icon' => 'counter1_icon', 'num' => 'counter1_number', 'title' => 'counter1_title', 'def' => 'home_weddingphotos_icon5.png'],
                                    ['icon' => 'counter2_icon', 'num' => 'counter2_number', 'title' => 'counter2_title', 'def' => 'home_weddingphotos_icon6.png'],
                                    ['icon' => 'counter3_icon', 'num' => 'counter3_number', 'title' => 'counter3_title', 'def' => 'home_weddingphotos_icon7.png'],
                                    ['icon' => 'counter4_icon', 'num' => 'counter4_number', 'title' => 'counter4_title', 'def' => 'home_weddingphotos_icon8.png'],
                                ] as $c)
                                <div class="column mcb-column one-fourth column_counter">
                                    <div class="counter counter_vertical animate-math">
                                        <div class="icon_wrapper"><img src="{{ ContentItem::media('about', $c['icon'], $b.$c['def']) }}" alt="" /></div>
                                        <div class="desc_wrapper">
                                            <div class="number-wrapper">
                                                <span class="number" data-to="{{ ContentItem::text('about', $c['num'], '0') }}">{{ ContentItem::text('about', $c['num'], '0') }}</span>
                                            </div>
                                            <p class="title">{!! nl2br(e(ContentItem::text('about', $c['title'], ''))) !!}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section mcb-section" style="padding-top:40px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        @foreach([
                            ['img' => 'col1_image', 't' => 'col1_title', 'b' => 'col1_body', 'def' => 'home_weddingphotos_pic21.jpg'],
                            ['img' => 'col2_image', 't' => 'col2_title', 'b' => 'col2_body', 'def' => 'home_weddingphotos_pic22.jpg'],
                            ['img' => 'col3_image', 't' => 'col3_title', 'b' => 'col3_body', 'def' => 'home_weddingphotos_pic23.jpg'],
                        ] as $col)
                        <div class="wrap mcb-wrap one-third valign-top clearfix" style="padding:0 1%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('about', $col['img'], $b.$col['def']) }}" alt="" /></div>
                                    </div>
                                </div>
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <h3>{{ ContentItem::text('about', $col['t'], '') }}</h3>
                                        <p>{!! nl2br(e(ContentItem::text('about', $col['b'], ''))) !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
