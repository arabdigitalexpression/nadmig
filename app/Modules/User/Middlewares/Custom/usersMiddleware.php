<?php namespace App\Modules\User\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;

class usersMiddleware extends MakeMenu
{

    private $circle = "circle-o";

	public static function AddMenus($menu){
		self::moduleMenu($menu);
	}

	private static function moduleMenu($menu){
		$module = $menu->add(trans('User::admin.menu.user.root'), '#')
	        ->icon('users')
	        ->prependIcon();

	  $module->add(trans('User::admin.menu.user.add'), ['route' => 'admin.user.create'])
	      ->icon("plus")
	      ->prependIcon();

	  $module->add(trans('User::admin.menu.user.all'), ['route' => 'admin.user.index'])
	      ->icon("list")
	      ->prependIcon();
	}
}
