<?php namespace App\Modules\School\Controllers\Api\DataTables;

use App\Modules\School\Models\School;
use App\Modules\School\Base\Controllers\ModuleDataTableController;

class SchoolDataTable extends ModuleDataTableController {

  protected $columns = ['name'];

  protected $common_columns = ['created_at', 'updated_at'];
  protected $options = ['edit'];
  public function query()
  {
      $school = School::Query();
      return $this->applyScopes($school);
  }

}
