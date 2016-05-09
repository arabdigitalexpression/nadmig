<?php namespace App\Modules\Log\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class LogMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Log::admin.menu.log.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Log::admin.menu.log.add'), ['route' => 'admin.log.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Log::admin.menu.log.all'), ['route' => 'admin.log.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
