<?php namespace App\Modules\Permission\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class PermissionMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Permission::dashboard.menu.permission.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Permission::dashboard.menu.permission.add'), ['route' => 'dashboard.permission.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Permission::dashboard.menu.permission.all'), ['route' => 'dashboard.permission.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
