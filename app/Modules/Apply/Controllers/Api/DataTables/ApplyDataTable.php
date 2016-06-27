<?php namespace App\Modules\Apply\Controllers\Api\DataTables;

use App\Modules\Apply\Models\Apply;
use App\Modules\Event\Models\Event;
use App\Modules\Reservation\Models\Reservation;
use App\Modules\Apply\Base\Controllers\ModuleDataTableController;
use Auth;
class ApplyDataTable extends ModuleDataTableController {

  // protected $columns = [ 'name', 'email'];
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
        if($reservation->event){
          array_push($events, $reservation->event);
        }
  		}
      // $apply = Apply::Query()->select('applies.*', 'users.name')->leftJoin('users', 'users.id','=','applies.user_id')->whereIn('event_id', array_pluck($events, 'id'));
      // $apply = Event::Query()
      //           ->leftJoin('applies', 'events.id','=','applies.event_id')
      //           ->leftJoin('users', 'users.id','=','applies.user_id')
      //           ->select('reservations.url_id', 'users.*', 'applies.created_at', 'applies.updated_at')
      //           ->whereIn('event_id', array_pluck($events, 'id')); 
                
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
