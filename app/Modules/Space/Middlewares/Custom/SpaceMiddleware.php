<?php namespace App\Modules\Space\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;
use Auth;
class SpaceMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Space::dashboard.menu.space.root'), '#')
		        ->icon('circle-o')
		        ->prependIcon();

		  if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('organization_manager')){
		   	$module->add(trans('Space::dashboard.menu.space.add'), ['route' => 'dashboard.space.create'])
		      ->icon("plus")
		      ->prependIcon();
		   }
		   $module->add(trans('Space::dashboard.menu.space.all'), ['route' => 'dashboard.space.index'])
		      ->icon("list")
		      ->prependIcon();  
		   
		}
}
