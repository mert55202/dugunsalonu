<?php

namespace Database\Seeders;

use App\Models\ContentItem;
use Illuminate\Database\Seeder;

class ContentItemSeeder extends Seeder
{
    public function run(): void
    {
        $b = 'themes/weddingphotos/content/weddingphotos/images/';

        $rows = [
            ['shared', 'logo_retina', $b.'wedingphotos-logo-retina.png'],
            ['shared', 'logo_standard', $b.'weddingphotos-logo.png'],
            ['shared', 'favicon', $b.'favicon.ico'],
            ['shared', 'buy_url', 'https://themeforest.net/item/betheme-responsive-multipurpose-wordpress-theme/7758048'],
            ['shared', 'buy_label', 'Satın Al'],
            ['shared', 'footer_widget_image', $b.'home_weddingphotos_pic14.png'],
            ['shared', 'footer_call_text', 'Sorunuz varsa arayin'],
            ['shared', 'footer_phone_line', '+90 555 555 55 55'],
            ['shared', 'footer_email_line', 'veya mesaj gonderin <a href="mailto:info@dugunsalonu.com">info@dugunsalonu.com</a>'],
            ['shared', 'copyright_html', '&copy; '.date('Y').' Dugun Salonu. Tum haklari saklidir.'],

            ['home', 'hero_title_html', 'Bu Ozel Gunu <br>Birlikte Yasayalim <br> <span class="themecolor"> ve anilarinizi </span> fotografla olumsuzlestirelim.'],
            ['home', 'hero_subtitle', 'Aşkın, heyecanın ve mutluluğun her karesini profesyonel kadrajlarla ölümsüzleştiriyoruz.'],
            ['home', 'hero_image_intro', $b.'home_weddingphotos_pic2.png'],
            ['home', 'hero_image_banner', $b.'weddingphotos-pic1.jpg'],
            ['home', 'services_section_title', 'Hizmetlerimiz'],
            ['home', 'services_mid_text', 'Düğün sürecinizin her anında size eşlik eden yaratıcı ekip, özel çekim planlaması ve kusursuz bir deneyim için buradayız.'],
            ['home', 'services_cta_label', 'Hizmetlerimiz'],
            ['home', 'services_cta_url', '/services-page'],
            ['home', 'highlight_section_bg', $b.'weddingphotos-bg2.jpg'],
            ['home', 'highlight_wrap_bg', $b.'home_weddingphotos_pic7.jpg'],
            ['home', 'highlight_title', 'Drone’dan Vintage Bir Hikaye'],
            ['home', 'highlight_subsubtitle', 'Maria & Christian, 29 Temmuz 2018'],
            ['home', 'highlight_video_url', 'https://vimeo.com/58010546'],
            ['home', 'portfolio_btn_label', 'Portfolyomuz'],
            ['home', 'portfolio_btn_url', '/works'],

            ['about', 'subheader_title', 'Hakkımda Bilmeniz Gereken Her Şey'],
            ['about', 'profile_image', $b.'home_weddingphotos_pic16.jpg'],
            ['about', 'profile_name', 'Ece Yılmaz'],
            ['about', 'profile_body_html', '<p>Düğün fotoğrafçılığına yaklaşımım; hikayeyi yakalamak, duyguyu yönetmek ve sizin için akıcı bir süreç tasarlamak.</p><p>Çekim öncesi planlama, ışık ve kurgu detayları, sonrasında ise özenli renk düzenleme ile her kareyi anlamlı hale getiriyoruz.</p><p>İsterseniz doğal anların peşinde, isterseniz modern bir stil kurgusunda buluşalım.</p>'],
            ['about', 'counter1_icon', $b.'home_weddingphotos_icon5.png'],
            ['about', 'counter1_number', '16'],
            ['about', 'counter1_title', 'Yıllık Deneyim'],
            ['about', 'counter2_icon', $b.'home_weddingphotos_icon6.png'],
            ['about', 'counter2_number', '4'],
            ['about', 'counter2_title', 'Paket Seçenekleri'],
            ['about', 'counter3_icon', $b.'home_weddingphotos_icon7.png'],
            ['about', 'counter3_number', '8'],
            ['about', 'counter3_title', 'Ortalama Çekim Süresi'],
            ['about', 'counter4_icon', $b.'home_weddingphotos_icon8.png'],
            ['about', 'counter4_number', '43'],
            ['about', 'counter4_title', 'Mutlu Çift Yorumları'],
            ['about', 'col1_image', $b.'home_weddingphotos_pic21.jpg'],
            ['about', 'col1_title', 'Duygu Odaklı Çekim'],
            ['about', 'col1_body', 'Kadrajda sadece görüntü değil, hisleri de taşıyoruz. Çekim sırasında sizi rahatlatacak akış ve yönlendirmeyle doğal anlar yakalıyoruz.'],
            ['about', 'col2_image', $b.'home_weddingphotos_pic22.jpg'],
            ['about', 'col2_title', 'Özenli Planlama'],
            ['about', 'col2_body', 'Düğün gününüz için çekim akışı, ışık planı ve detay senaryosu önceden hazırlanır. Böylece gün akıp giderken siz sadece keyfinize bakarsınız.'],
            ['about', 'col3_image', $b.'home_weddingphotos_pic23.jpg'],
            ['about', 'col3_title', 'Son Dokunuşlar'],
            ['about', 'col3_body', 'Çekimden sonra renkler, tonlar ve detaylar özenle düzenlenir. Sonuç; sevdiğiniz stile uyumlu, zamansız ve kaliteli bir portfolyodur.'],

            ['works', 'subheader_title', 'Portföyümüze göz atın ve deneyimimizi keşfedin.'],
            ['services_page', 'subheader_title', 'Hizmetlerimizi ihtiyaçlarınıza göre uyarlıyoruz'],
            ['services_page', 'block1_side_image', $b.'home_weddingphotos_pic24.jpg'],
            ['services_page', 'block1_icon', $b.'weddingphotos-icon1.png'],
            ['services_page', 'block1_title', 'Fotoğraf Çekimi'],
            ['services_page', 'block1_body', "Düğün gününüzde hikayenizi yakalayan kadrajlar.\n\nIşık, kompozisyon ve kurgu ile doğal anlarınızı ölümsüzleştiriyoruz."],
            ['services_page', 'block2_side_image', $b.'home_weddingphotos_pic25.jpg'],
            ['services_page', 'block2_icon', $b.'weddingphotos-icon2.png'],
            ['services_page', 'block2_title', 'Video Çekimi'],
            ['services_page', 'block2_body', "Anılarınızı hareketli bir hikayeye dönüştürüyoruz.\n\nÖzel çekim planı ve profesyonel düzenleme ile sinematik bir deneyim."],
            ['services_page', 'block3_side_image', $b.'home_weddingphotos_pic26.jpg'],
            ['services_page', 'block3_icon', $b.'weddingphotos-icon3.png'],
            ['services_page', 'block3_title', 'Drone ile Çekim'],
            ['services_page', 'block3_body', "Göz alıcı havadan görüntülerle hikayenize derinlik katıyoruz.\n\nVintage estetik ve profesyonel planlama ile unutulmaz kadrajlar."],

            ['contact', 'subheader_title', 'Sorularınız varsa çekinmeden bizimle iletişime geçin.'],
            ['contact', 'form_title', 'Online İletişim Formu'],
            ['contact', 'form_intro', 'Düğün planınız için bize yazın, en kısa sürede dönüş yapalım.'],
            ['contact', 'side_title', 'Hızlı İletişim'],
            ['contact', 'side_image', $b.'home_weddingphotos_pic15.jpg'],
            ['contact', 'side_body_html', '<p><strong>Adres:</strong> Denizli / Türkiye</p><p><strong>Telefon:</strong> +90 555 555 55 55</p><p><strong>E-posta:</strong> info@dugunsalonu.com</p>'],

            ['portfolio_item', 'subheader_title', ''],
            ['portfolio_item', 'nav_next_thumb', $b.'home_weddingphotos_pic29-80x80.jpg'],
            ['portfolio_item', 'nav_next_title', ''],
            ['portfolio_item', 'nav_next_date', ''],
            ['portfolio_item', 'heading_line', ''],
            ['portfolio_item', 'meta_sidebar_html', ''],
            ['portfolio_item', 'lead_html', ''],
            ['portfolio_item', 'body_column_main_html', ''],
            ['portfolio_item', 'body_column_side_html', ''],
            ['portfolio_item', 'hero_image', $b.'home_weddingphotos_pic30.jpg'],
            ['portfolio_item', 'gallery_image_1', $b.'home_weddingphotos_pic28.jpg'],
            ['portfolio_item', 'gallery_block_html', ''],
            ['portfolio_item', 'gallery_image_2', $b.'home_weddingphotos_pic29.jpg'],
        ];

        foreach ($rows as [$page, $field, $value]) {
            ContentItem::query()->updateOrCreate(
                ['page' => $page, 'field' => $field],
                ['value' => $value]
            );
        }

        ContentItem::flushCache();
    }
}
