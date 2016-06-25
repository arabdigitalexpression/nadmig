<?php namespace App\Modules\Log\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class LogMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Log::dashboard.menu.log.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Log::dashboard.menu.log.all'), ['route' => 'dashboard.log.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
