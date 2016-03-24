<?php namespace App\Modules\Space\Controllers\Api\DataTables;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Base\Controllers\ModuleDataTableController;

class SpaceDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $space = Space::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($space);
  }

}
