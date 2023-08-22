<?php

namespace App\Http\Controllers\Admin\Discounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\MenuSectionResource;
use App\Models\Discount\Discount;
use App\Models\Menu\MenuSection;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscountController extends Controller
{
    private string $routeResourceName = 'discounts';

    public function __construct()
    {
        $this->middleware('can:view discounts list')->only('index');
        $this->middleware('can:create discount')->only(['create', 'store']);
        $this->middleware('can:edit discount')->only(['edit', 'update']);
        $this->middleware('can:delete discount')->only('destroy');
    }

    public function index(Request $request)
    {
        $Discounts = Discount::query()
            ->latest('id')
            ->paginate(10);

        $menuSections = MenuSection::all();

        return Inertia::render('Discounts/Index', [
            'title' => 'Discounts',
            'items' => DiscountResource::collection($Discounts),
            'menuSections' => MenuSectionResource::collection($menuSections),
            'headers' => [
                [
                    'label' => 'Name',
                    'name' => 'name',
                ],
                [
                    'label' => 'Active',
                    'name' => 'is_active',
                ],
                [
                    'label' => 'Starts At',
                    'name' => 'starts_at',
                ],
                [
                    'label' => 'Ends At',
                    'name' => 'ends_at',
                ],
                [
                    'label' => 'Actions',
                    'name' => 'actions',
                    'align' => 'center',
                ],
            ],
            'filters' => (object) $request->all(),
            'routeResourceName' => $this->routeResourceName,
            'can' => [
                'create' => $request->user()->can('create discount'),
                'edit' => $request->user()->can('edit discount'),
                'delete' => $request->user()->can('delete discount'),
            ],
        ]);
    }

    public function create()
    {
        return Inertia::render('Discounts/Create', [
            'edit' => false,
            'title' => 'Add Discount',
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function store(DiscountRequest $request)
    {
        $Discount = Discount::create($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        return Inertia::render('Discounts/Create', [
            'edit' => true,
            'title' => 'Edit Discount',
            'item' => new DiscountResource($discount),
            'routeResourceName' => $this->routeResourceName,
        ]);
    }

    public function update(DiscountRequest $request, Discount $discount)
    {
        $discount->update($request->validated());

        return redirect()->route("admin.{$this->routeResourceName}.index")->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $menuItem)
    {
        $menuItem->delete();

        return back()->with('success', 'Discount deleted successfully.');
    }
}
