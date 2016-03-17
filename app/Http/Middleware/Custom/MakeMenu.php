<?php

namespace App\Http\Middleware\Custom;

use Closure;
use Menu;
use App\Modules\User\Middlewares\Custom\usersMiddleware as User;
use App\Modules\Role\Middlewares\Custom\RoleMiddleware as Role;
use App\Modules\Permission\Middlewares\Custom\PermissionMiddleware as Permission;
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
            $dashboard = $menu->add(trans('admin.menu.dashboard'), ['route' => 'admin.root'])
                ->icon('dashboard')
                ->prependIcon();

            $language  = $menu->add(trans('admin.menu.language.root'), '#')
                ->icon('flag')
                ->prependIcon();

            $language->add(trans('admin.menu.language.add'), ['route' => 'admin.language.create'])
                ->icon($this->circle)
                ->prependIcon();

            $language->add(trans('admin.menu.language.all'), ['route' => 'admin.language.index'])
                ->icon($this->circle)
                ->prependIcon();

            $pages = $menu->add(trans('admin.menu.page.root'), '#')
                ->icon('folder')
                ->prependIcon();

            $pages->add(trans('admin.menu.page.add'), ['route' => 'admin.page.create'])
                ->icon($this->circle)
                ->prependIcon();

            $pages->add(trans('admin.menu.page.all'), ['route' => 'admin.page.index'])
                ->icon($this->circle)
                ->prependIcon();
            User::AddMenus($menu);
            Role::AddMenus($menu);
            Permission::AddMenus($menu);
            $settings = $menu->add(trans('admin.menu.setting'), ['route' => 'admin.setting.index'])
                ->icon('gears')
                ->prependIcon();
        });
    }
}
