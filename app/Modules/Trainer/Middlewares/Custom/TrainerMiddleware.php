<?php namespace App\Modules\Trainer\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class TrainerMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Trainer::dashboard.menu.trainer.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Trainer::dashboard.menu.trainer.add'), ['route' => 'dashboard.trainer.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Trainer::dashboard.menu.trainer.all'), ['route' => 'dashboard.trainer.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
