<?php namespace App\Modules\Event\Controllers\Api\DataTables;

use App\Modules\Event\Models\Event;
use App\Modules\Event\Base\Controllers\ModuleDataTableController;
use Auth;
class EventDataTable extends ModuleDataTableController {

  protected $columns = ['status'];
  protected $pluck_columns = ['reservation_id' => ['reservation', 'name'], 'description' => ['reservation' , 'description']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];
  public function query()
  {
  	if (Auth::user()->hasRole('admin')){
  		$event = Event::Query();	
  	}else if(Auth::user()->hasRole('organization_manager')){
      	$event = Event::Query()->whereIn('reservation_id', array_pluck(Auth::user()->manageOrganization->reservations->toArray(), 'id'));
    }else if(Auth::user()->hasRole('space_manager')){
        $event = Event::Query()->whereIn('reservation_id', array_pluck(Auth::user()->manageSpace->organization->reservations->toArray(), 'id'));
    }
      return $this->applyScopes($event);
  }

}
