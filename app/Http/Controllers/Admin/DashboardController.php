<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'services' => Service::query()->count(),
                'portfolios' => Portfolio::query()->count(),
                'testimonials' => Testimonial::query()->count(),
                'hasSettings' => Setting::query()->exists(),
            ],
        ]);
    }
}
