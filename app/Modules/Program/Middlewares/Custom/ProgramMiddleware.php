<?php namespace App\Modules\Program\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class ProgramMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Program::dashboard.menu.program.root'), '#')
		        ->icon('cubes')
		        ->prependIcon();

		  $module->add(trans('Program::dashboard.menu.program.add'), ['route' => 'dashboard.program.create'])
		      ->icon("plus")
		      ->prependIcon();

		  $module->add(trans('Program::dashboard.menu.program.all'), ['route' => 'dashboard.program.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
