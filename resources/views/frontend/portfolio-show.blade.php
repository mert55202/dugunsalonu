@extends('frontend.layouts.app')

@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
    $p = $portfolio;
    $defaultMeta = '<h6><b>Musteri</b>: '.e($p->client_name ?: $p->couple_name).'<br><b>Tarih</b>: '.e($p->project_date ?? '').'</h6>';
    $metaHtml = ContentItem::text('portfolio_item', 'meta_sidebar_html', '');
    if (trim(strip_tags($metaHtml)) === '') {
        $metaHtml = $defaultMeta;
    }
    $heading = ContentItem::text('portfolio_item', 'heading_line', '') ?: $p->title;
    $leadHtml = ContentItem::text('portfolio_item', 'lead_html', '');
    if (trim(strip_tags($leadHtml)) === '' && filled($p->description)) {
        $leadHtml = '<h6>'.e(\Illuminate\Support\Str::limit($p->description, 280)).'</h6>';
    }
    $mainHtml = ContentItem::text('portfolio_item', 'body_column_main_html', '');
    if (trim(strip_tags($mainHtml)) === '' && filled($p->description)) {
        $mainHtml = '<p>'.nl2br(e($p->description)).'</p>';
    }
    $sideHtml = ContentItem::text('portfolio_item', 'body_column_side_html', '');
@endphp

@section('title', $portfolio->title.' - '.($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('portfolio_item', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('portfolio_item', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('portfolio_item', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('portfolio_item', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('portfolio_item', 'og_image', $ogImageDefault))
@section('body_class', 'portfolio-template-default single single-portfolio button-flat layout-full-width no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')

@push('subheader')
<div id="Subheader" style="padding:190px 20% 100px">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ ContentItem::text('portfolio_item', 'subheader_title', '') ?: $p->title }}</h1>
        </div>
    </div>
</div>
@endpush

@section('content')
<div id="Content" class="no-padding">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            @if($next)
            <a class="fixed-nav fixed-nav-next format- style-default" href="{{ route('portfolio.show', ['slug' => $next->slug]) }}">
                <span class="arrow"><i class="icon-right-open-big"></i></span>
                <div class="photo"><img src="{{ asset($next->image_path) }}" class="attachment-blog-navi size-blog-navi wp-post-image" alt="" /></div>
                <div class="desc">
                    <h6>{{ ContentItem::text('portfolio_item', 'nav_next_title', '') ?: $next->title }}</h6>
                    <span class="date"><i class="icon-clock"></i>{{ ContentItem::text('portfolio_item', 'nav_next_date', '') ?: ($next->project_date ?? '') }}</span>
                </div>
            </a>
            @endif
            <div class="section mcb-section" style="padding-top:0px; padding-bottom:0px; background-color:">
                <div class="section_wrapper mcb-section-inner">
                    <div class="wrap mcb-wrap one valign-top clearfix">
                        <div class="mcb-wrap-inner">
                            <div class="column mcb-column two-third column_column">
                                <div class="column_attr clearfix" style="padding:0 5% 0 0;">
                                    <div class="mfn_heading heading_lines align_left">
                                        <h2 class="title" style="color:#000;"><span class="line line_l" style="background:#000;"></span>{{ $heading }}<span class="line line_r" style="background:#000;"></span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="column mcb-column one-third column_column">
                                <div class="column_attr clearfix" style="padding:10px 0 0;">
                                    {!! $metaHtml !!}
                                </div>
                            </div>
                            <div class="column mcb-column one column_divider"><hr class="no_line" /></div>
                            <div class="column mcb-column two-third column_column">
                                <div class="column_attr clearfix" style="padding:0 5% 0 0;">
                                    @if($leadHtml !== ''){!! $leadHtml !!}@endif
                                    {!! $mainHtml !!}
                                </div>
                            </div>
                            <div class="column mcb-column one-third column_column">
                                <div class="column_attr clearfix">
                                    @if($sideHtml !== ''){!! $sideHtml !!}@endif
                                </div>
                            </div>
                            <div class="column mcb-column one column_divider"><hr class="no_line" style="margin: 0 auto 20px;" /></div>
                            <div class="column mcb-column one column_image">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('portfolio_item', 'hero_image', $p->image_path) }}" alt="" /></div>
                                </div>
                            </div>
                            <div class="column mcb-column one-fourth column_placeholder"><div class="placeholder">&nbsp;</div></div>
                            <div class="column mcb-column one-second column_column">
                                <div class="column_attr clearfix">
                                    {!! ContentItem::text('portfolio_item', 'gallery_block_html', '') !!}
                                </div>
                            </div>
                            <div class="column mcb-column one column_divider"><hr class="no_line" /></div>
                            <div class="column mcb-column one-second column_image">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('portfolio_item', 'gallery_image_1', $b.'home_weddingphotos_pic28.jpg') }}" alt="" /></div>
                                </div>
                            </div>
                            <div class="column mcb-column one-second column_image">
                                <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                                    <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('portfolio_item', 'gallery_image_2', $b.'home_weddingphotos_pic29.jpg') }}" alt="" /></div>
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
