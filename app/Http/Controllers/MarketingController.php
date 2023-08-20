<?php

namespace App\Http\Controllers;

use App\Models\Content\CmsContent;
use App\Models\Discount\Discount;
use App\Models\Menu\MenuSection;
use Inertia\Inertia;

class MarketingController extends Controller
{
    public function index()
    {
        return Inertia::render('Home');
    }

    public function menu()
    {
        return Inertia::render('Marketing/Menu');
    }

    public function news()
    {
        return Inertia::render('Marketing/News');
    }

    public function discounts()
    {
        $discounts = Discount::with('menuItems')->get();

        return Inertia::render('Marketing/Discounts',[
            'discounts' => $discounts
        ]);
    }

    public function contact()
    {
        return Inertia::render('Marketing/Contact');
    }

    public function content(string $slug)
    {
        $content = CmsContent::where('slug', $slug)->first();

        if (!$content) {
            return redirect()->route('not-found');
        }

        return Inertia::render('Marketing/Content',[
            'content' => $content,
        ]);
    }
}
