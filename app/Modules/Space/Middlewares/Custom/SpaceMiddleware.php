<?php namespace App\Modules\Space\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class SpaceMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Space::dashboard.menu.space.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Space::dashboard.menu.space.add'), ['route' => 'dashboard.space.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Space::dashboard.menu.space.all'), ['route' => 'dashboard.space.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
