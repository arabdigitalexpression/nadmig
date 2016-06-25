<?php namespace App\Modules\Program\Controllers\Api\DataTables;

use App\Modules\Program\Models\Program;
use App\Modules\Program\Base\Controllers\ModuleDataTableController;

class ProgramDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $program = Program::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($program);
  }

}
