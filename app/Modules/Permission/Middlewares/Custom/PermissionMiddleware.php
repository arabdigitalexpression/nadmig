<?php namespace App\Modules\Permission\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class PermissionMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Permission::admin.menu.permission.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Permission::admin.menu.permission.add'), ['route' => 'admin.permission.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Permission::admin.menu.permission.all'), ['route' => 'admin.permission.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
