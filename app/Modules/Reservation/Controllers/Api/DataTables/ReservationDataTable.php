<?php namespace App\Modules\Reservation\Controllers\Api\DataTables;

use App\Modules\Reservation\Models\Reservation;
use App\Modules\Reservation\Base\Controllers\ModuleDataTableController;

class ReservationDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'status'];
  protected $pluck_columns = ['organization_id' => ['organization', 'name'], 'user_id' => ['user', 'name']];
  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $reservation = Reservation::Query();
      return $this->applyScopes($reservation);
  }

}
