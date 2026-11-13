@php
    use App\Models\ContentItem;
    $b = 'themes/weddingphotos/content/weddingphotos/images/';
@endphp
<footer id="Footer" class="clearfix">
    <div class="widgets_wrapper" style="padding:70px 0;">
        <div class="container">
            <div class="column one">
                <aside class="widget_text widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                        <div style="text-align: center;">
                            <div class="image_frame image_item no_link scale-with-grid alignnone no_border">
                                <div class="image_wrapper"><img class="scale-with-grid" src="{{ ContentItem::media('shared', 'footer_widget_image', $b.'home_weddingphotos_pic14.png') }}" alt="" /></div>
                            </div>
                            <hr class="no_line" style="margin: 0 auto 20px;" />
                            <p>{{ ContentItem::text('shared', 'footer_call_text', 'Sorulariniz icin arayin') }}</p>
                            <div class="mfn_heading heading_lines align_center">
                                <h3 class="title" style="color:#000;"><span class="line line_l" style="background:#e6e6df;"></span>{{ ContentItem::text('shared', 'footer_phone_line', '+90 555 555 55 55') }}<span class="line line_r" style="background:#e6e6df;"></span></h3>
                            </div>
                            <p>{!! ContentItem::text('shared', 'footer_email_line', 'ya da mesaj gonderin') !!}</p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="footer_copy">
        <div class="container">
            <div class="column one">
                <a id="back_to_top" class="button button_js" href="#"><i class="icon-up-open-big"></i></a>
                <div class="copyright">{!! ContentItem::text('shared', 'copyright_html', '&copy; Dugun Salonu') !!}</div>
            </div>
        </div>
    </div>
</footer>
