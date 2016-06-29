<?php namespace App\Modules\Trainer\Controllers\Api\DataTables;

use App\Modules\Trainer\Models\Trainer;
use App\Modules\Trainer\Base\Controllers\ModuleDataTableController;

class TrainerDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $trainer = Trainer::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($trainer);
  }

}
