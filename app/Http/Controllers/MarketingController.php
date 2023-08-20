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
        $contentPages = CmsContent::get(['slug', 'title']);

        return Inertia::render('Home', [
            'contentPages' => $contentPages
        ]);
    }

    public function menu()
    {
        $contentPages = CmsContent::get(['slug', 'title']);
        $sections = MenuSection::with('menuItems')->get();

        return Inertia::render('Marketing/Menu', [
            'menuSections' => $sections,
            'contentPages' => $contentPages
        ]);
    }

    public function news()
    {
        $contentPages = CmsContent::get(['slug', 'title']);

        return Inertia::render('Marketing/News',[
            'contentPages' => $contentPages
        ]);
    }

    public function discounts()
    {
        $discounts = Discount::with('menuItems')->get();
        $contentPages = CmsContent::get(['slug', 'title']);

        return Inertia::render('Marketing/Discounts',[
            'discounts' => $discounts,
            'contentPages' => $contentPages
        ]);
    }

    public function contact()
    {
        $contentPages = CmsContent::get(['slug', 'title']);

        return Inertia::render('Marketing/Contact',[
            'contentPages' => $contentPages
        ]);
    }

    public function content(string $slug)
    {
        $content = CmsContent::where('slug', $slug)->first();

        if (!$content) {
            return redirect()->route('not-found');
        }

        $contentPages = CmsContent::get(['slug', 'title']);

        return Inertia::render('Marketing/Content',[
            'content' => $content,
            'contentPages' => $contentPages
        ]);
    }
}
