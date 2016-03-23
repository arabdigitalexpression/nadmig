<?php namespace App\Modules\Organization\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class MyOrganizationMiddleware extends MakeMenu
{

    private $circle = "circle-o";

		public static function AddMenus($menu){
			self::moduleMenu($menu);
		}

		private static function moduleMenu($menu){
			$module = $menu->add(trans('Organization::dashboard.menu.my_organization.root'), ['route' => 'dashboard.organization.mine.show'])
		        ->icon('apple')
		        ->prependIcon();
		}
}
