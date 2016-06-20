<?php namespace App\Modules\Organization\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class OrganizationMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Organization::dashboard.menu.organization.root'), '#')
		        ->icon('building')
		        ->prependIcon();

		  $module->add(trans('Organization::dashboard.menu.organization.add'), ['route' => 'dashboard.organization.create'])
		      ->icon("plus")
		      ->prependIcon();

		  $module->add(trans('Organization::dashboard.menu.organization.all'), ['route' => 'dashboard.organization.index'])
		      ->icon("list")
		      ->prependIcon();
		}
}
