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
use App\Modules\Session\Middlewares\Custom\SessionMiddleware as Sessions;
use App\Modules\Event\Middlewares\Custom\EventMiddleware as Events;
use App\Modules\Apply\Middlewares\Custom\ApplyMiddleware as Apply;
use App\Modules\Log\Middlewares\Custom\LogMiddleware as Log;
use App\Modules\Program\Middlewares\Custom\ProgramMiddleware as Program;
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
                    Organization::AddMenus($menu);
                    Space::AddMenus($menu);
                    Program::AddMenus($menu);
                    Events::AddMenus($menu);
                    Reservation::AddMenus($menu);
                    Sessions::AddMenus($menu);
                    Apply::AddMenus($menu);
                    User::AddMenus($menu);
                    Role::AddMenus($menu);
                    Permission::AddMenus($menu);
                    Log::AddMenus($menu);
                    $settings = $menu->add(trans('dashboard.menu.setting'), ['route' => 'dashboard.setting.index'])
                        ->icon('gears')
                        ->prependIcon();
                }   

             if (Auth::user()->hasRole('organization_manager')) {
                MyOrganization::AddMenus($menu);
                Space::AddMenus($menu);
                Events::AddMenus($menu);
                Reservation::AddMenus($menu);
                Sessions::AddMenus($menu);
                Apply::AddMenus($menu);
             }
             if (Auth::user()->hasRole('space_manager')) {
                Space::AddMenus($menu);
                Events::AddMenus($menu);
                Reservation::AddMenus($menu);
                Sessions::AddMenus($menu);
                Apply::AddMenus($menu);
             }
            
        });
    }
}
