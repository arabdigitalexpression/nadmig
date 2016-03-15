<?php namespace App\Modules\Role\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class RoleMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Role::admin.menu.role.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Role::admin.menu.role.add'), ['route' => 'admin.role.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Role::admin.menu.role.all'), ['route' => 'admin.role.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
