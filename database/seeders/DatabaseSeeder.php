<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Services\SiteSnapshotService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(ContentItemSeeder::class);
        $this->call(AdminUserSeeder::class);

        Setting::query()->updateOrCreate(['id' => 1], [
            'site_title' => 'Dugun Salonu',
            'hero_title' => 'Bu Ozel Gunu Birlikte Yasayalim',
            'hero_subtitle' => 'WeddingPhotos temasina uygun tam dinamik dugun salonu yonetim paneli',
            'phone' => '+90 555 555 55 55',
            'email' => 'info@dugunsalonu.com',
            'address' => 'Denizli / Turkiye',
            'seo_title' => 'Dugun Salonu | Dugun, Nisan ve Kina Organizasyonu',
            'seo_description' => 'Dugun, nisan ve kina gecesi organizasyonlari icin profesyonel dugun salonu hizmetleri.',
            'seo_keywords' => 'dugun salonu, nisan, kina, dugun fotograf',
            'og_image' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-pic1.jpg',
        ]);

        $services = [
            ['title' => 'Fotograf Cekimi', 'description' => 'Profesyonel gelin-damat cekimleri.', 'icon_path' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon1.png', 'sort_order' => 1, 'is_active' => true],
            ['title' => 'Video Cekimi', 'description' => '4K sinema kalitesinde dugun videolari.', 'icon_path' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon2.png', 'sort_order' => 2, 'is_active' => true],
            ['title' => 'Drone Cekimi', 'description' => 'Havadan unutulmaz kadrajlar.', 'icon_path' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon3.png', 'sort_order' => 3, 'is_active' => true],
            ['title' => 'Album Tasarimi', 'description' => 'Ozel tasarim premium albumler.', 'icon_path' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon4.png', 'sort_order' => 4, 'is_active' => true],
        ];

        foreach ($services as $service) {
            Service::query()->updateOrCreate(['title' => $service['title']], $service);
        }

        $portfolios = [
            ['slug' => 'dis-cekim', 'title' => 'Dis Cekim', 'couple_name' => 'Elif & Mert', 'client_name' => 'Elif & Mert', 'project_date' => 'Haziran 2025', 'description' => 'Pamukkale gun batimi cekimi.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic8.jpg', 'video_url' => null, 'sort_order' => 1, 'is_active' => true],
            ['slug' => 'nisan-tanisma', 'title' => 'Nisan Tani', 'couple_name' => 'Zeynep & Can', 'client_name' => 'Zeynep & Can', 'project_date' => 'Mayis 2025', 'description' => 'Nisan gecesinden secme kareler.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic9.jpg', 'video_url' => null, 'sort_order' => 2, 'is_active' => true],
            ['slug' => 'dugun-gecesi', 'title' => 'Dugun Gecesi', 'couple_name' => 'Ayse & Berk', 'client_name' => 'Ayse & Berk', 'project_date' => 'Temmuz 2025', 'description' => 'Canli muzikli dugun gecesi.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic10.jpg', 'video_url' => null, 'sort_order' => 3, 'is_active' => true],
            ['slug' => 'stil-cekim', 'title' => 'Stil Cekimi', 'couple_name' => 'Deniz & Lara', 'client_name' => 'Deniz & Lara', 'project_date' => 'Eylul 2025', 'description' => 'Sehir merkezinde editorial stil cekim.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic30.jpg', 'video_url' => null, 'sort_order' => 4, 'is_active' => true],
            ['slug' => 'plaj-dugunu', 'title' => 'Plaj Dugunu', 'couple_name' => 'Ece & Tolga', 'client_name' => 'Ece & Tolga', 'project_date' => 'Agustos 2025', 'description' => 'Gun batiminda plaj dugunu fotograflari.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic29.jpg', 'video_url' => null, 'sort_order' => 5, 'is_active' => true],
            ['slug' => 'kina-gecesi', 'title' => 'Kina Gecesi', 'couple_name' => 'Selin & Arda', 'client_name' => 'Selin & Arda', 'project_date' => 'Mart 2025', 'description' => 'Geleneksel kina gecesi ve detay cekimleri.', 'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic28.jpg', 'video_url' => null, 'sort_order' => 6, 'is_active' => true],
        ];

        foreach ($portfolios as $portfolio) {
            Portfolio::query()->updateOrCreate(
                ['slug' => $portfolio['slug']],
                $portfolio
            );
        }

        $testimonials = [
            ['name' => 'Cansu Y.', 'content' => 'Tum surec mukemmeldi, fotograf kalitesi harika.', 'avatar_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic11-85x85.png', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Seda K.', 'content' => 'Organizasyon ekibi cok ilgiliydi.', 'avatar_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic12-85x85.png', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Emre T.', 'content' => 'Salon, ikram ve servis her sey cok guzeldi.', 'avatar_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic13-85x85.png', 'sort_order' => 3, 'is_active' => true],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::query()->updateOrCreate(['name' => $testimonial['name']], $testimonial);
        }

        // Backup/restore senaryolarinda admin'den girilen veriyi kaybetmemek icin
        // en son snapshot varsa onu uygula.
        SiteSnapshotService::importIfExistsQuietly();
    }
}
