<?php namespace App\Modules\Trainer\Middlewares\Custom;

use App\Base\Middleware\AdminMiddleware as AdminMiddlewareInterface;

class TrainerMiddleware extends AdminMiddlewareInterface
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Trainer::admin.menu.trainer.root'), '#')
		        ->icon('apple')
		        ->prependIcon();

		  $module->add(trans('Trainer::admin.menu.trainer.add'), ['route' => 'admin.trainer.create'])
		      ->icon("circle-o")
		      ->prependIcon();

		  $module->add(trans('Trainer::admin.menu.trainer.all'), ['route' => 'admin.trainer.index'])
		      ->icon("circle-o")
		      ->prependIcon();
		}
}
