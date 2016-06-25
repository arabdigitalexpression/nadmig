<?php namespace App\Modules\Reservation\Controllers\Api\DataTables;

use App\Modules\Reservation\Models\Reservation;
use App\Modules\Reservation\Base\Controllers\ModuleDataTableController;
use Auth;
class ReservationDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'status'];
  protected $pluck_columns = ['organization_id' => ['organization', 'name'], 'user_id' => ['user', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['show'];
  public function query()
  {
  	if (Auth::user()->hasRole('admin')){
  		$reservation = Reservation::Query()->orderBy('id', 'DESC');
  	}else if(Auth::user()->hasRole('organization_manager')){
      	$reservation = Reservation::Query()->where('organization_id', Auth::user()->manageOrganization['id'])->orderBy('id', 'DESC');
    }else if(Auth::user()->hasRole('space_manager')){
        $reservation = Reservation::Query()->where('organization_id', Auth::user()->manageSpace->organization['id'])->orderBy('id', 'DESC');
    }
    return $this->applyScopes($reservation);
  }

}
