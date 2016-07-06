<?php namespace App\Modules\Attendees\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class AttendeesMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Attendees::dashboard.menu.attendees.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Attendees::dashboard.menu.attendees.add'), ['route' => 'dashboard.attendees.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Attendees::dashboard.menu.attendees.all'), ['route' => 'dashboard.attendees.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
