@extends('frontend.layouts.app')

@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
    $blocks = [
        ['side' => 'block1_side_image', 'icon' => 'block1_icon', 'title' => 'block1_title', 'body' => 'block1_body', 'image_first' => true, 'side_def' => 'home_weddingphotos_pic24.jpg', 'icon_def' => 'weddingphotos-icon1.png'],
        ['side' => 'block2_side_image', 'icon' => 'block2_icon', 'title' => 'block2_title', 'body' => 'block2_body', 'image_first' => false, 'side_def' => 'home_weddingphotos_pic25.jpg', 'icon_def' => 'weddingphotos-icon2.png'],
        ['side' => 'block3_side_image', 'icon' => 'block3_icon', 'title' => 'block3_title', 'body' => 'block3_body', 'image_first' => true, 'side_def' => 'home_weddingphotos_pic26.jpg', 'icon_def' => 'weddingphotos-icon3.png'],
    ];
@endphp

@section('title', ContentItem::text('services_page', 'page_title_prefix', 'Hizmetler') . ' - ' . ($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('services_page', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('services_page', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('services_page', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('services_page', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('services_page', 'og_image', $ogImageDefault))
@section('body_class', 'page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')

@push('subheader')
<div id="Subheader" style="padding:190px 20% 100px">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ ContentItem::text('services_page', 'subheader_title', '') }}</h1>
        </div>
    </div>
</div>
@endpush

@section('content')
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                @foreach($blocks as $blk)
                <div class="section mcb-section equal-height-wrap" style="padding-top:0px; padding-bottom:40px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        @if($blk['image_first'])
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('services_page', $blk['side'], $b.$blk['side_def']) }}" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                            <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('services_page', $blk['icon'], $b.$blk['icon_def']) }}" alt="" /></div>
                                        </div>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        <h2>{{ ContentItem::text('services_page', $blk['title'], '') }}</h2>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        @foreach(preg_split("/\n\n+/", ContentItem::text('services_page', $blk['body'], '')) as $para)
                                            @if(trim($para) !== '')<p>{{ trim($para) }}</p>@endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                            <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('services_page', $blk['icon'], $b.$blk['icon_def']) }}" alt="" /></div>
                                        </div>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        <h2>{{ ContentItem::text('services_page', $blk['title'], '') }}</h2>
                                        <hr class="no_line" style="margin: 0 auto 15px;" />
                                        @foreach(preg_split("/\n\n+/", ContentItem::text('services_page', $blk['body'], '')) as $para)
                                            @if(trim($para) !== '')<p>{{ trim($para) }}</p>@endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap mcb-wrap one-second valign-middle clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_image">
                                    <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('services_page', $blk['side'], $b.$blk['side_def']) }}" alt="" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                <div class="section mcb-section" style="padding-top:20px; padding-bottom:60px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix align_center">
                                        <h3>{{ ContentItem::text('services_page', 'services_list_heading', 'Panelden tanimlanan hizmetler') }}</h3>
                                    </div>
                                </div>
                                @foreach($services as $service)
                                <div class="column mcb-column one-fourth column_column">
                                    <div class="column_attr clearfix align_center">
                                        <img src="{{ asset($service->icon_path) }}" alt="" style="max-width:72px;height:auto" />
                                        <h4>{{ $service->title }}</h4>
                                        <p>{{ $service->description }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
