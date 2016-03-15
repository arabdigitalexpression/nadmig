<?php namespace App\Modules\Auth\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class authsMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Auth::admin.menu.auth.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Auth::admin.menu.auth.add'), ['route' => 'admin.auth.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Auth::admin.menu.auth.all'), ['route' => 'admin.auth.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
