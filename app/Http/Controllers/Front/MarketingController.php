<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\MenuSectionResource;
use App\Models\Content\CmsContent;
use App\Models\Discount\Discount;
use App\Models\Menu\MenuItem;
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
        // menu items grouped by section, also add section name to group
        // also add current price and full number attribute to menu items
        $sections = MenuSection::with('menuItems')->get();
        return Inertia::render('Marketing/Menu', [
            'sections' => MenuSectionResource::collection($sections),
            'discounts' => DiscountResource::collection(Discount::all()),
        ]);
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
