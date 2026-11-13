<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\WorkGalleryPost;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    private function data(): array
    {
        try {
            $setting = Setting::query()->first();
            $services = Service::query()->where('is_active', true)->orderBy('sort_order')->get();
            $portfolios = Portfolio::query()
                ->where('is_active', true)
                ->where(function (Builder $query): void {
                    $query->whereNotNull('slug')->where('slug', '!=', '');
                })
                ->orderBy('sort_order')
                ->get();
            $testimonials = Testimonial::query()->where('is_active', true)->orderBy('sort_order')->get();
        } catch (QueryException) {
            $setting = null;
            $services = new Collection();
            $portfolios = new Collection();
            $testimonials = new Collection();
        }

        return compact('setting', 'services', 'portfolios', 'testimonials');
    }

    public function index(): View
    {
        return view('frontend.home', $this->data());
    }

    public function about(): View
    {
        return view('frontend.about', $this->data());
    }

    public function works(): View
    {
        $data = $this->data();

        try {
            $workGalleryPosts = WorkGalleryPost::query()
                ->where('is_active', true)
                ->with('photos')
                ->orderBy('sort_order')
                ->orderBy('id')
                ->take(4)
                ->get();
        } catch (QueryException) {
            $workGalleryPosts = new Collection();
        }

        return view('frontend.works', array_merge($data, compact('workGalleryPosts')));
    }

    public function services(): View
    {
        return view('frontend.services', $this->data());
    }

    public function contact(): View
    {
        return view('frontend.contact', $this->data());
    }

    public function portfolioShow(string $slug): View
    {
        $portfolio = Portfolio::query()->where('slug', $slug)->firstOrFail();

        $data = $this->data();
        $next = Portfolio::query()
            ->where('is_active', true)
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('id', '!=', $portfolio->id)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->first();

        return view('frontend.portfolio-show', array_merge($data, compact('portfolio', 'next')));
    }
}
