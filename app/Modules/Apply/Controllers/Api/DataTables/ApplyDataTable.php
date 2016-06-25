<?php namespace App\Modules\Apply\Controllers\Api\DataTables;

use App\Modules\Apply\Models\Apply;
use App\Modules\Apply\Base\Controllers\ModuleDataTableController;
use Auth;
class ApplyDataTable extends ModuleDataTableController {

  protected $pluck_columns = ['event_id' => ['reservation', 'name'], 'user_id' => ['user' , 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $ops = false;
  public function query()
  {
  	if (Auth::user()->hasRole('admin')){
  		$apply = Apply::Query();
  	}else if(Auth::user()->hasRole('organization_manager')){
  		$events = array();
  		foreach (Auth::user()->manageOrganization->reservations as $reservation) {
  			array_push($events, $reservation->event);
  		}
      	$apply = Apply::Query()->whereIn('event_id', array_pluck($events, 'id'));
    }else if(Auth::user()->hasRole('space_manager')){
    	$events = array();
  		foreach (Auth::user()->manageSpace->organization->reservations as $reservation) {
  			array_push($events, $reservation->event);
  		}
       	$apply = Apply::Query()->whereIn('event_id', array_pluck($events, 'id'));
    }
      
      return $this->applyScopes($apply);
  }

}
