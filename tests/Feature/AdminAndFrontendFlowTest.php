<?php

namespace Tests\Feature;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\ContentItem;
use App\Models\Testimonial;
use App\Models\WorkGalleryPost;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAndFrontendFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutMiddleware(PreventRequestForgery::class);

        $adminEmail = env('ADMIN_EMAIL', 'admin@dugunsalonu.com');
        $adminPassword = env('ADMIN_PASSWORD', 'Admin12345!');

        $admin = User::query()->updateOrCreate(
            ['email' => $adminEmail],
            ['name' => 'Admin', 'password' => Hash::make($adminPassword)]
        );

        $this->actingAs($admin);
    }

    public function test_frontend_and_admin_pages_open_successfully(): void
    {
        $this->seed();

        $this->get('/')->assertOk()->assertSee('Hizmetlerimiz');
        $this->get('/admin')->assertOk()->assertSee('Dashboard');
        $this->get('/admin/settings')->assertOk()->assertSee('Site Ayarlari');
        $this->get('/admin/services')->assertOk()->assertSee('Hizmetler');
        $this->get('/admin/portfolios')->assertOk()->assertSee('Portfolyo');
        $this->get('/admin/testimonials')->assertOk()->assertSee('Yorumlar');
    }

    public function test_settings_update_works(): void
    {
        $this->seed();

        $payload = [
            'site_title' => 'Dugun Sarayi',
            'hero_title' => 'Yeni Baslik',
            'hero_subtitle' => 'Yeni Alt Baslik',
            'phone' => '+90 500 000 00 00',
            'email' => 'hello@example.com',
            'address' => 'Istanbul',
            'seo_title' => 'Dugun Sarayi SEO Baslik',
            'seo_description' => 'SEO aciklama test metni',
            'seo_keywords' => 'dugun,salon',
            'og_image' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-pic1.jpg',
        ];

        $this->put('/admin/settings', $payload)
            ->assertRedirect('/admin/settings');

        $this->assertDatabaseHas('settings', [
            'site_title' => 'Dugun Sarayi',
            'hero_title' => 'Yeni Baslik',
            'seo_title' => 'Dugun Sarayi SEO Baslik',
        ]);
    }

    public function test_service_create_update_delete_flow_works(): void
    {
        $createPayload = [
            'title' => 'Canli Muzik',
            'description' => 'Orkestra ve DJ hizmeti.',
            'icon_path' => 'themes/weddingphotos/content/weddingphotos/images/weddingphotos-icon1.png',
            'sort_order' => 9,
            'is_active' => 1,
        ];

        $this->post('/admin/services', $createPayload)
            ->assertRedirect('/admin/services');

        $service = Service::query()->where('title', 'Canli Muzik')->firstOrFail();

        $this->put('/admin/services/' . $service->id, [
            'title' => 'Canli Muzik Premium',
            'description' => 'Orkestra, DJ ve ses sistemi.',
            'icon_path' => $createPayload['icon_path'],
            'sort_order' => 3,
            'is_active' => 1,
        ])->assertRedirect('/admin/services');

        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'title' => 'Canli Muzik Premium',
            'sort_order' => 3,
        ]);

        $this->delete('/admin/services/' . $service->id)
            ->assertRedirect('/admin/services');

        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    public function test_portfolio_create_update_delete_flow_works(): void
    {
        $createPayload = [
            'title' => 'Kina Gecesi',
            'couple_name' => 'Selin & Arda',
            'description' => 'Kina gecesi cekimleri.',
            'image_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic8.jpg',
            'video_url' => 'https://example.com/video',
            'sort_order' => 8,
            'is_active' => 1,
        ];

        $this->post('/admin/portfolios', $createPayload)
            ->assertRedirect('/admin/portfolios');

        $portfolio = Portfolio::query()->where('title', 'Kina Gecesi')->firstOrFail();

        $this->put('/admin/portfolios/' . $portfolio->id, [
            'title' => 'Kina Gecesi Gold',
            'couple_name' => 'Selin & Arda',
            'description' => 'Detayli kina gecesi cekimleri.',
            'image_path' => $createPayload['image_path'],
            'video_url' => 'https://example.com/new-video',
            'sort_order' => 2,
            'is_active' => 1,
        ])->assertRedirect('/admin/portfolios');

        $this->assertDatabaseHas('portfolios', [
            'id' => $portfolio->id,
            'title' => 'Kina Gecesi Gold',
            'sort_order' => 2,
        ]);

        $this->delete('/admin/portfolios/' . $portfolio->id)
            ->assertRedirect('/admin/portfolios');

        $this->assertDatabaseMissing('portfolios', ['id' => $portfolio->id]);
    }

    public function test_testimonial_create_update_delete_flow_works(): void
    {
        $createPayload = [
            'name' => 'Merve A.',
            'content' => 'Cok memnun kaldik.',
            'avatar_path' => 'themes/weddingphotos/content/weddingphotos/images/home_weddingphotos_pic11-85x85.png',
            'sort_order' => 7,
            'is_active' => 1,
        ];

        $this->post('/admin/testimonials', $createPayload)
            ->assertRedirect('/admin/testimonials');

        $testimonial = Testimonial::query()->where('name', 'Merve A.')->firstOrFail();

        $this->put('/admin/testimonials/' . $testimonial->id, [
            'name' => 'Merve Aksoy',
            'content' => 'Hizmet kalitesi cok iyiydi.',
            'avatar_path' => $createPayload['avatar_path'],
            'sort_order' => 1,
            'is_active' => 1,
        ])->assertRedirect('/admin/testimonials');

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'name' => 'Merve Aksoy',
            'sort_order' => 1,
        ]);

        $this->delete('/admin/testimonials/' . $testimonial->id)
            ->assertRedirect('/admin/testimonials');

        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    public function test_site_content_update_text_and_image_works(): void
    {
        $this->seed();

        Storage::fake('public');

        // GD yoksa `fake()->image()` patlar; görsel boyamaya ihtiyaç duymayan "create" kullanıyoruz.
        $logoFile = UploadedFile::fake()->create('logo-standard.png', 10, 'image/png');

        $payload = [
            'value' => [
                'buy_label' => 'Satın Al',
            ],
            'upload' => [
                'logo_standard' => $logoFile,
            ],
        ];

        $this->put('/admin/site-content/shared', $payload)
            ->assertRedirect('/admin/site-content/shared');

        $this->assertDatabaseHas('content_items', [
            'page' => 'shared',
            'field' => 'buy_label',
            'value' => 'Satın Al',
        ]);

        $storedLogo = ContentItem::query()
            ->where('page', 'shared')
            ->where('field', 'logo_standard')
            ->value('value');

        $this->assertNotNull($storedLogo);
        $this->assertStringContainsString('storage/site', $storedLogo);
    }

    public function test_work_gallery_crud_works(): void
    {
        $this->seed();

        Storage::fake('public');

        $file1 = UploadedFile::fake()->create('foto1.png', 10, 'image/png');
        $file2 = UploadedFile::fake()->create('foto2.png', 10, 'image/png');

        $this->post('/admin/work-galleries', [
            'title' => 'Galeri Post',
            'description' => 'Aciklama',
            'sort_order' => 0,
            'is_active' => 1,
            'photos' => [$file1],
        ])->assertRedirect('/admin/work-galleries');

        $post = WorkGalleryPost::query()->where('title', 'Galeri Post')->firstOrFail();
        $this->assertDatabaseHas('work_gallery_posts', ['id' => $post->id, 'title' => 'Galeri Post']);
        $this->assertDatabaseHas('work_gallery_photos', ['work_gallery_post_id' => $post->id]);

        $this->put('/admin/work-galleries/' . $post->id, [
            'title' => 'Galeri Post',
            'description' => 'Aciklama',
            'sort_order' => 1,
            'is_active' => 1,
            'photos' => [$file2],
        ])->assertRedirect('/admin/work-galleries/' . $post->id . '/edit');

        $this->assertDatabaseHas('work_gallery_posts', ['id' => $post->id, 'sort_order' => 1]);

        $photo = $post->photos()->firstOrFail();
        $this->delete('/admin/work-galleries/' . $post->id . '/photos/' . $photo->id)
            ->assertRedirect('/admin/work-galleries/' . $post->id . '/edit');

        $this->assertDatabaseMissing('work_gallery_photos', ['id' => $photo->id]);

        $this->delete('/admin/work-galleries/' . $post->id)
            ->assertRedirect('/admin/work-galleries');

        $this->assertDatabaseMissing('work_gallery_posts', ['id' => $post->id]);
    }
}
