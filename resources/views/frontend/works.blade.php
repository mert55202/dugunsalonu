@extends('frontend.layouts.app')

@php use App\Models\ContentItem; @endphp

@section('title', ContentItem::text('works', 'page_title_prefix', 'Calismalar') . ' - ' . ($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('works', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('works', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('works', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('works', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('works', 'og_image', $ogImageDefault))
@section('body_class', 'page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')

@push('subheader')
<div id="Subheader" style="padding:190px 20% 100px">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ ContentItem::text('works', 'subheader_title', '') }}</h1>
        </div>
    </div>
</div>
@endpush

@section('content')
<style>
    .wg-post { margin-bottom: 40px; }
    .wg-slider { display:flex; align-items:center; gap:12px; }
    .wg-track { flex:1 1 auto; display:flex; gap:12px; overflow-x:auto; scroll-snap-type:x mandatory; padding: 8px 2px 14px; }
    .wg-photo { flex:0 0 auto; width: 240px; height: 150px; object-fit: cover; border-radius: 4px; scroll-snap-align: start; }
    .wg-photo--hidden { display:block; }
    .wg-arrow { flex:0 0 auto; width:40px; height:40px; border-radius:20px; border: 1px solid rgba(0,0,0,.15); background:#fff; cursor:pointer; }
    .wg-loadmore-wrap { margin-top: 12px; }
</style>

<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section" style="padding-top:0px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one">
                                    @foreach($workGalleryPosts as $post)
                                        @php
                                            $photos = $post->photos ?? collect();
                                            $total = $photos->count();
                                            $initial = 8;
                                            $showInitial = min($total, $initial);
                                        @endphp

                                        @if($total > 0)
                                            <div class="wg-post" data-wg-post-id="{{ $post->id }}">
                                                <div style="padding: 0 0 10px;">
                                                    <h2 class="entry-title" style="margin:0;">{{ $post->title }}</h2>
                                                    @if(filled($post->description))
                                                        <p style="margin:8px 0 0;">{{ $post->description }}</p>
                                                    @endif
                                                </div>

                                                <div class="wg-slider">
                                                    <button type="button" class="wg-arrow wg-arrow-left" aria-label="Sola kaydir" data-target="wg-track-{{ $post->id }}" data-dir="-1">&lt;</button>

                                                    <div class="wg-track" id="wg-track-{{ $post->id }}">
                                                        @foreach($photos as $idx => $photo)
                                                            @php $blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=='; @endphp
                                                            @if($idx < $showInitial)
                                                                <img class="wg-photo" src="{{ asset($photo->image_path) }}" alt="{{ $post->title }}" loading="lazy" />
                                                            @else
                                                                <img class="wg-photo wg-photo--hidden" data-src="{{ asset($photo->image_path) }}" src="{{ $blank }}" alt="{{ $post->title }}" loading="lazy" />
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                    <button type="button" class="wg-arrow wg-arrow-right" aria-label="Saga kaydir" data-target="wg-track-{{ $post->id }}" data-dir="1">&gt;</button>
                                                </div>

                                                @if($total > $showInitial)
                                                    <div class="wg-loadmore-wrap">
                                                        <button type="button" class="wg-load-more" data-wg-post-id="{{ $post->id }}" style="border:0; background:transparent; color:#836a28; cursor:pointer; padding:0;">
                                                            Daha fazla yukle
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.wg-load-more');
        if (!btn) return;

        var postId = btn.getAttribute('data-wg-post-id');
        var root = document.querySelector('[data-wg-post-id="' + postId + '"]');
        if (!root) return;

        root.querySelectorAll('.wg-photo--hidden').forEach(function (img) {
            img.src = img.getAttribute('data-src');
            img.classList.remove('wg-photo--hidden');
        });
        btn.remove();
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wg-arrow').forEach(function (arrow) {
            arrow.addEventListener('click', function () {
                var targetId = arrow.getAttribute('data-target');
                var dir = parseInt(arrow.getAttribute('data-dir') || '1', 10);
                var track = document.getElementById(targetId);
                if (!track) return;
                track.scrollBy({ left: dir * 320, behavior: 'smooth' });
            });
        });
    });
</script>
@endpush
@endsection
