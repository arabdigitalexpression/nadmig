<?php namespace App\Modules\Report\Middlewares\Custom;

use App\Http\Middleware\Custom\MakeMenu;
use Auth;
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

		        
		  $module->add(trans('Report::dashboard.menu.report.space_manger_2.add'), ['route' => 'dashboard.report.space_manger_2.create'])
		      ->icon("circle-o")
		      ->prependIcon();
		      
		  $module->add(trans('Report::dashboard.menu.report.space_manger_2.all'), ['route' => 'dashboard.report.space_manger_2.index'])
		      ->icon("circle-o")
		      ->prependIcon();

		   // like dislike 
		   $module->add(trans('Report::dashboard.menu.report.like_dislike.add'), ['route' => 'dashboard.report.like_dislike_reports.create'])
		      ->icon("circle-o")
		      ->prependIcon();
		      
		  $module->add(trans('Report::dashboard.menu.report.like_dislike.all'), ['route' => 'dashboard.report.like_dislike_reports.index'])
		      ->icon("circle-o")
		      ->prependIcon();

		   // report 8
		   $module->add(trans('Report::dashboard.menu.report.report_8.add'), ['route' => 'dashboard.report.report_8.create'])
		      ->icon("circle-o")
		      ->prependIcon();
		      
		  $module->add(trans('Report::dashboard.menu.report.report_8.all'), ['route' => 'dashboard.report.report_8.index'])
		      ->icon("circle-o")
		      ->prependIcon();

		   if(Auth::user()->hasRole('admin')){
		   	$module->add(trans('Report::dashboard.menu.report.trainer.all'), ['route' => 'dashboard.report.trainer'])
		      ->icon("circle-o")
		      ->prependIcon();
		    $module->add(trans('Report::dashboard.menu.report.trainer.export'), ['route' => 'dashboard.report.export.index'])
		      ->icon("circle-o")
		      ->prependIcon(); 
		   }
		}
}
