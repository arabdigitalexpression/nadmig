<?php namespace App\Modules\Event\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class EventMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Event::dashboard.menu.event.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Event::dashboard.menu.event.add'), ['route' => 'dashboard.event.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Event::dashboard.menu.event.all'), ['route' => 'dashboard.event.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
