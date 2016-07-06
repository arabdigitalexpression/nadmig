<?php namespace App\Modules\Attendees\Controllers\Api\DataTables;

use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Base\Controllers\ModuleDataTableController;

class AttendeesDataTable extends ModuleDataTableController {

  protected $columns = ['name','birthday'];

  protected $common_columns = ['created_at'];
  protected $options = ['edit'];
  public function query()
  {
      $attendees = Attendees::Query();
      return $this->applyScopes($attendees);
  }

}
