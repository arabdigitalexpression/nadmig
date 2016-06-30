<?php namespace App\Modules\School\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class SchoolMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('School::dashboard.menu.school.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('School::dashboard.menu.school.add'), ['route' => 'dashboard.school.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('School::dashboard.menu.school.all'), ['route' => 'dashboard.school.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
