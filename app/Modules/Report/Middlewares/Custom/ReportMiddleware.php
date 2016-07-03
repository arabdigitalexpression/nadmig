<?php namespace App\Modules\Report\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class ReportMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Report::admin.menu.report.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Report::admin.menu.report.add'), ['route' => 'admin.report.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Report::admin.menu.report.all'), ['route' => 'admin.report.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
