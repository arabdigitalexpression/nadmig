<?php namespace App\Modules\SummerSchool\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class SummerSchoolMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('SummerSchool::admin.menu.summerschool.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('SummerSchool::admin.menu.summerschool.add'), ['route' => 'admin.summerschool.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('SummerSchool::admin.menu.summerschool.all'), ['route' => 'admin.summerschool.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
