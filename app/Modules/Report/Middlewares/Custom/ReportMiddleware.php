<?php namespace App\Modules\Report\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class ReportMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Report::dashboard.menu.report.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Report::dashboard.menu.report.add'), ['route' => 'dashboard.report.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Report::dashboard.menu.report.all'), ['route' => 'dashboard.report.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		   $module->add(trans('Report::dashboard.menu.report.trainer.all'), ['route' => 'dashboard.report.trainer'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
