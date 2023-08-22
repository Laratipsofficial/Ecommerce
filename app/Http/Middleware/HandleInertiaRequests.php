<?php

namespace App\Http\Middleware;

use App\Models\Content\CmsContent;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'admin.app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => $request->session()->get('success'),
            ],
            'menus' => $this->getMenu($request),
            'locale' => session('locale', 'nl'),
        ]);
    }


    public function getMenu(Request $request){
        if($request->routeIs('admin.*')){
            return $this->getAdminMenu($request);
        }

        if($request->routeIs('tablets.*')){
            return $this->getTableMenu($request);
        }

        return $this->getFrontMenu($request);
    }

    public function getAdminMenu(Request $request){
        return [
            [
                'label' => 'Dashboard',
                'url' => route('admin.dashboard'),
                'isActive' => $request->routeIs('admin.dashboard'),
                'isVisible' => true,
            ],
            [
                'label' => 'Permissions',
                'url' => route('admin.permissions.index'),
                'isActive' => $request->routeIs('admin.permissions.*'),
                'isVisible' => $request->user()?->can('view permissions module'),
            ],
            [
                'label' => 'Roles',
                'url' => route('admin.roles.index'),
                'isActive' => $request->routeIs('admin.roles.*'),
                'isVisible' => $request->user()?->can('view roles module'),
            ],
            [
                'label' => 'Users',
                'url' => route('admin.users.index'),
                'isActive' => $request->routeIs('admin.users.*'),
                'isVisible' => $request->user()?->can('view users module'),
            ],
            [
                'label' => 'Tables',
                'url' => route('admin.tables.index'),
                'isActive' => $request->routeIs('admin.tables.*'),
                'isVisible' => $request->user()?->can('view tables module'),
            ],
            [
                'label' => 'Content',
                'url' => route('admin.content.index'),
                'isActive' => $request->routeIs('admin.content.pages.*'),
                'isVisible' => $request->user()?->can('view cms content module'),
            ],
            [
                'label' => 'Items',
                'url' => route('admin.menus-items.index'),
                'isActive' => $request->routeIs('admin.menus-items.*'),
                'isVisible' => $request->user()?->can('view menu items module'),
            ],
            [
                'label' => 'Sections',
                'url' => route('admin.menus-sections.index'),
                'isActive' => $request->routeIs('admin.menus-sections.*'),
                'isVisible' => $request->user()?->can('view menu sections module'),
            ],
            [
                'label' => 'Side Items',
                'url' => route('admin.menus-side-items.index'),
                'isActive' => $request->routeIs('admin.menus-side-items.*'),
                'isVisible' => $request->user()?->can('view menu side items module'),
            ],
            [
                'label' => 'Menu Discounts',
                'url' => route('admin.discounts.index'),
                'isActive' => $request->routeIs('admin.discounts.*'),
                'isVisible' => $request->user()?->can('view menu discounts module'),
            ],
            [
                'label' => 'Orders',
                'url' => route('admin.orders.index'),
                'isActive' => $request->routeIs('admin.orders.*'),
                'isVisible' => $request->user()?->can('view orders module'),
            ]
        ];
    }

    public function getFrontMenu(Request $request){
        $currentLocale = session('locale', 'nl');

        $baseMenu = [
                [
                'label' => 'Home',
                'url' => route('home'),
                'isActive' => $request->routeIs('home'),
                'isVisible' => true,
                ],
            [
                'label' => 'Menu',
                'url' => route('menu'),
                'isActive' => $request->routeIs('takeaway.menus.*'),
                'isVisible' => true,
            ],
            // label based on the current locale
                [
                'label' => $currentLocale == 'nl' ? 'Bestellen' : 'Order',
                'url' => route('takeaway.menus.index'),
                'isActive' => $request->routeIs('takeaway.menus.*'),
                'isVisible' => true,
                ]
        ];

        $contentPagesMenuItems = [];

        // retrieve all cms content pages and add them to the menu
        $locale = session('locale', 'nl');
        $cmsContentPages = CmsContent::where('culture', $locale)->get();

        foreach ($cmsContentPages as $cmsContentPage){
            $contentPagesMenuItems[] = [
                'label' => $cmsContentPage->displayName,
                'url' => route('content.show', $cmsContentPage->slug),
                'isActive' => $request->routeIs('content.show', $cmsContentPage->slug),
                'isVisible' => true,
            ];
        }

        // merge the content pages menu items with the base menu
        return array_merge($baseMenu, $contentPagesMenuItems);
    }

    private function getTableMenu(Request $request)
    {
        return [

                [
                    'label' => 'Menu',
                    'url' => route('tablets.menus.index'),
                    'isActive' => $request->routeIs('tablets.menus.*'),
                    'isVisible' => true,
                ],
                [
                    'label' => 'Cart',
                    'url' => route('tablets.cart.index'),
                    'isActive' => $request->routeIs('tablets.cart.*'),
                    'isVisible' => true,
                ],
                [
                    'label' => 'History',
                    'url' => route('tablets.history.index'),
                    'isActive' => $request->routeIs('tablets.history.*'),
                    'isVisible' => true,
                ],
            [
                'label' => 'End dinner',
                'url' => route('tablets.reset'),
                'isActive' => $request->routeIs('tablets.reset'),
                'isVisible' => true,
            ]
        ];
    }
}
