<?php namespace App\Modules\Space\Controllers\Api\DataTables;

use App\Modules\Space\Models\Space;
use App\Modules\Space\Base\Controllers\ModuleDataTableController;

class SpaceDataTable extends ModuleDataTableController {

  protected $columns = ['name', 'organization'];

  protected $common_columns = ['created_at', 'updated_at'];
  protected $image_columns = ['logo'];

  public function query()
  {
      $space = Space::query();
      return $this->applyScopes($space);
  }

}
