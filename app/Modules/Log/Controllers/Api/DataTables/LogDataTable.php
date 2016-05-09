<?php namespace App\Modules\Log\Controllers\Api\DataTables;

use App\Modules\Log\Models\Log;
use App\Modules\Log\Base\Controllers\ModuleDataTableController;

class LogDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $log = Log::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($log);
  }

}
