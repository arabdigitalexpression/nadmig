<?php namespace App\Modules\Reservation\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;
use Auth;
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
		   if(Auth::user()->manageOrganization){
		   	$module->add(trans('Reservation::dashboard.menu.reservation.add'), route('reservation.create', ['organization_slug' => Auth::user()->manageOrganization->slug]))
		      ->icon("plus")
		      ->prependIcon();
		   } else if(Auth::user()->manageSpace){
		   	$module->add(trans('Reservation::dashboard.menu.reservation.add'), route('reservation.create', ['organization_slug' => Auth::user()->manageSpace->organization->slug]))
		      ->icon("plus")
		      ->prependIcon();
		   } 
		  $module->add(trans('Reservation::dashboard.menu.reservation.all'), ['route' => 'dashboard.reservation.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
