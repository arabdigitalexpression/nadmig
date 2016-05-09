<?php namespace App\Modules\Session\Controllers\Api\DataTables;

use App\Modules\Session\Models\Session;
use App\Modules\Session\Base\Controllers\ModuleDataTableController;

class SessionDataTable extends ModuleDataTableController {

  protected $columns = ['where'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $session = Session::query();
      return $this->applyScopes($session);
  }

}
