<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\WorkGalleryPostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AdminAuthenticatedMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/works', [FrontendController::class, 'works'])->name('works');
Route::get('/services-page', [FrontendController::class, 'services'])->name('services.page');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/portfolio/{slug}', [FrontendController::class, 'portfolioShow'])
    ->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*')
    ->name('portfolio.show');

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'authenticate'])->name('admin.login.authenticate');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(AdminAuthenticatedMiddleware::class)
    ->group(function (): void {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/site-content', [SiteContentController::class, 'index'])->name('site-content.index');
        Route::get('/site-content/{page}', [SiteContentController::class, 'edit'])->name('site-content.edit');
        Route::put('/site-content/{page}', [SiteContentController::class, 'update'])->name('site-content.update');
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('portfolios', PortfolioController::class)->except(['show']);
        Route::resource('testimonials', TestimonialController::class)->except(['show']);
        Route::resource('work-galleries', WorkGalleryPostController::class)->except(['show']);
        Route::delete('/work-galleries/{workGallery}/photos/{photo}', [WorkGalleryPostController::class, 'destroyPhoto'])
            ->name('work-galleries.photos.destroy');
    });
