@extends('frontend.layouts.app')

@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
@endphp

@section('title', ContentItem::text('contact', 'page_title_prefix', 'Iletisim') . ' - ' . ($setting?->site_title ?? 'Dugun Salonu'))
@php
    $seoDescriptionDefault = $setting?->seo_description ?: ($setting?->hero_subtitle ?? '');
    $seoKeywordsDefault = $setting?->seo_keywords ?? '';
    $seoTitleDefault = $setting?->seo_title ?: ($setting?->site_title ?? 'Dugun Salonu');
    $ogImageDefault = $setting?->og_image ?? '';
@endphp
@section('meta_description', ContentItem::text('contact', 'seo_description', $seoDescriptionDefault))
@section('meta_keywords', ContentItem::text('contact', 'seo_keywords', $seoKeywordsDefault))
@section('og_title', ContentItem::text('contact', 'seo_title', $seoTitleDefault))
@section('og_description', ContentItem::text('contact', 'seo_description', $seoDescriptionDefault))
@section('og_image', ContentItem::text('contact', 'og_image', $ogImageDefault))
@section('body_class', 'page button-flat layout-full-width no-content-padding no-shadows header-split minimalist-header-no sticky-header sticky-tb-color ab-hide subheader-both-center menu-link-color menuo-no-borders mobile-tb-center mobile-side-slide mobile-mini-mr-ll tr-header tr-menu tr-content')

@push('subheader')
<div id="Subheader" style="padding:190px 20% 100px">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ ContentItem::text('contact', 'subheader_title', '') }}</h1>
        </div>
    </div>
</div>
@endpush

@section('content')
<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section" style="padding-top:0px; padding-bottom:0px; background-color:">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one-second valign-top clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <h3>{{ ContentItem::text('contact', 'form_title', '') }}</h3>
                                        <p>{{ ContentItem::text('contact', 'form_intro', '') }}</p>
                                        <hr class="no_line" style="margin: 0 auto 40px;" />
                                        <div id="contactWrapper">
                                            <form id="contactform">
                                                <div class="column one-second">
                                                    <input placeholder="{{ ContentItem::text('contact', 'form_name_placeholder', 'Adiniz') }}" type="text" name="name" id="name" size="40" aria-required="true" aria-invalid="false" />
                                                </div>
                                                <div class="column one-second">
                                                    <input placeholder="{{ ContentItem::text('contact', 'form_email_placeholder', 'E-posta') }}" type="email" name="email" id="email" size="40" aria-required="true" aria-invalid="false" />
                                                </div>
                                                <div class="column one">
                                                    <input placeholder="{{ ContentItem::text('contact', 'form_subject_placeholder', 'Konu') }}" type="text" name="subject" id="subject" size="40" aria-invalid="false" />
                                                </div>
                                                <div class="column one">
                                                    <textarea placeholder="{{ ContentItem::text('contact', 'form_message_placeholder', 'Mesaj') }}" name="body" id="body" style="width:100%;" rows="10" aria-invalid="false"></textarea>
                                                </div>
                                                <div class="column one">
                                                    <input type="button" value="{{ ContentItem::text('contact', 'form_submit_label', 'Mesaj gonder') }}" id="submit" onClick="return check_values();">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wrap mcb-wrap one-second valign-top clearfix" style="padding:0 2%">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one column_column">
                                    <div class="column_attr clearfix">
                                        <h3>{{ ContentItem::text('contact', 'side_title', '') }}</h3>
                                        {!! ContentItem::text('contact', 'side_body_html', '') !!}
                                    </div>
                                </div>
                                <div class="column mcb-column one-second column_image">
                                    <div class="image_frame image_item no_link scale-with-grid no_border">
                                        <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('contact', 'side_image', $b.'home_weddingphotos_pic15.jpg') }}" alt="" /></div>
                                    </div>
                                </div>
                                <div class="column mcb-column one-second column_column">
                                    <div class="column_attr clearfix" style="padding:30px 30px 0;">
                                        <h4 style="margin-bottom: 5px;">{{ $setting?->site_title ?? 'Dugun Salonu' }}</h4>
                                        <p>{{ $setting?->phone }}</p>
                                        <p><a href="mailto:{{ $setting?->email }}">{{ $setting?->email }}</a></p>
                                        <p>{{ $setting?->address }}</p>
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

@push('scripts')
<script src="{{ asset('themes/weddingphotos/js/email.js') }}"></script>
@endpush
