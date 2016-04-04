<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Menu;
use Auth;
use App\Modules\User\Middlewares\Custom\usersMiddleware as User;
use App\Modules\Role\Middlewares\Custom\RoleMiddleware as Role;
use App\Modules\Permission\Middlewares\Custom\PermissionMiddleware as Permission;
use App\Modules\Organization\Middlewares\Custom\OrganizationMiddleware as Organization;
use App\Modules\Organization\Middlewares\Custom\MyOrganizationMiddleware as MyOrganization;
use App\Modules\Space\Middlewares\Custom\SpaceMiddleware as Space;
use App\Modules\Reservation\Middlewares\Custom\ReservationMiddleware as Reservation;
class MakeMenu
{
    /**
     * @var string
     */
    private $circle = "circle-o";

    /**
     * Set menus in middleware as sessions are not stored already in service providers instead
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->makeAdminMenu();
        return $next($request);
    }

    private function makeAdminMenu()
    {
        Menu::make('admin', function ($menu) {
            $dashboard = $menu->add(trans('dashboard.menu.dashboard'), ['route' => 'dashboard.root'])
                ->icon('dashboard')
                ->prependIcon();
             if (Auth::user()->hasRole('admin')) {
                    $language  = $menu->add(trans('dashboard.menu.language.root'), '#')
                        ->icon('flag')
                        ->prependIcon();

                    $language->add(trans('dashboard.menu.language.add'), ['route' => 'dashboard.language.create'])
                        ->icon($this->circle)
                        ->prependIcon();

                    $language->add(trans('dashboard.menu.language.all'), ['route' => 'dashboard.language.index'])
                        ->icon($this->circle)
                        ->prependIcon();

                    $pages = $menu->add(trans('dashboard.menu.page.root'), '#')
                        ->icon('folder')
                        ->prependIcon();

                    $pages->add(trans('dashboard.menu.page.add'), ['route' => 'dashboard.page.create'])
                        ->icon($this->circle)
                        ->prependIcon();

                    $pages->add(trans('dashboard.menu.page.all'), ['route' => 'dashboard.page.index'])
                        ->icon($this->circle)
                        ->prependIcon();
                    Organization::AddMenus($menu);
                    Space::AddMenus($menu);
                    Reservation::AddMenus($menu);
                    User::AddMenus($menu);
                    Role::AddMenus($menu);
                    Permission::AddMenus($menu);
                    $settings = $menu->add(trans('dashboard.menu.setting'), ['route' => 'dashboard.setting.index'])
                        ->icon('gears')
                        ->prependIcon();
                }   

             if (Auth::user()->hasRole('orgnization_manager')) {
                MyOrganization::AddMenus($menu);
             }
            
        });
    }
}
