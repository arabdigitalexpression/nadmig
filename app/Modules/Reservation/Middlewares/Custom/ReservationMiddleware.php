<?php namespace App\Modules\Reservation\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class ReservationMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Reservation::dashboard.menu.reservation.root'), '#')
		        ->icon('object-group')
		        ->prependIcon();

		  $module->add(trans('Reservation::dashboard.menu.reservation.all'), ['route' => 'dashboard.reservation.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
