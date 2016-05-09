<?php namespace App\Modules\Event\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class EventMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Event::admin.menu.event.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Event::admin.menu.event.add'), ['route' => 'admin.event.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Event::admin.menu.event.all'), ['route' => 'admin.event.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
