<?php namespace App\Modules\Role\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class RoleMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Role::dashboard.menu.role.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Role::dashboard.menu.role.add'), ['route' => 'dashboard.role.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Role::dashboard.menu.role.all'), ['route' => 'dashboard.role.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
