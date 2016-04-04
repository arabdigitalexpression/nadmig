<?php namespace App\Modules\Reservation\Controllers\Api\DataTables;

use App\Modules\Reservation\Models\Reservation;
use App\Modules\Reservation\Base\Controllers\ModuleDataTableController;

class ReservationDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'status'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $reservation = Reservation::query();
      return $this->applyScopes($reservation);
  }

}
