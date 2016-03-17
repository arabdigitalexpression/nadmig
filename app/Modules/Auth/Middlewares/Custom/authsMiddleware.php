<?php namespace App\Modules\Auth\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class authsMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Auth::dashboard.menu.auth.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Auth::dashboard.menu.auth.add'), ['route' => 'dashboard.auth.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Auth::dashboard.menu.auth.all'), ['route' => 'dashboard.auth.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
