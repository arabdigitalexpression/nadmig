<?php namespace App\Modules\Program\Controllers\Api\DataTables;

use App\Modules\Program\Models\Program;
use App\Modules\Program\Base\Controllers\ModuleDataTableController;

class ProgramDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'description'];

  protected $common_columns = ['created_at', 'updated_at'];

  protected $image_columns = ['artwork'];
  protected $options = ['show', 'edit'];
  public function query()
  {
      $program = Program::Query();
      return $this->applyScopes($program);
  }

}
