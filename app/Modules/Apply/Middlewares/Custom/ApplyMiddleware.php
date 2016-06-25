<?php namespace App\Modules\Apply\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;


class ApplyMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Apply::dashboard.menu.apply.root'), '#')
		        ->icon('crosshairs')
		        ->prependIcon();
		  $module->add(trans('Apply::dashboard.menu.apply.all'), ['route' => 'dashboard.apply.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
