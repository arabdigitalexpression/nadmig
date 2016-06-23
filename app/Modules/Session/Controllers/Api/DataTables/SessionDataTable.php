<?php namespace App\Modules\Session\Controllers\Api\DataTables;

use App\Modules\Session\Models\Session;
use App\Modules\Session\Base\Controllers\ModuleDataTableController;
use Auth;
class SessionDataTable extends ModuleDataTableController {

protected $pluck_columns = ['space_id' => ['space', 'name'], 'reservation_id' => ['reservation', 'name']];
 protected $columns = ['start_date', 'start_time', 'status'];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];
  public function query()
  {
  	if (Auth::user()->hasRole('admin')){
  		$session = Session::Query();
  	}else if(Auth::user()->hasRole('organization_manager')){
      	$session = Session::Query()->whereIn('reservation_id', array_pluck(Auth::user()->manageOrganization->reservations->toArray(), 'id'));
    }else if(Auth::user()->hasRole('space_manager')){
        $session = Session::Query()->where('space_id', Auth::user()->manageSpace['id']);
    }
      
      return $this->applyScopes($session);
  }

}
