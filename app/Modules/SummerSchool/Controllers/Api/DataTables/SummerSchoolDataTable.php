<?php namespace App\Modules\SummerSchool\Controllers\Api\DataTables;

use App\Modules\SummerSchool\Models\SummerSchool;
use App\Modules\SummerSchool\Base\Controllers\ModuleDataTableController;

class SummerSchoolDataTable extends ModuleDataTableController {

  protected $columns = ['title'];

  protected $common_columns = ['created_at', 'updated_at'];

  public function query()
  {
      $summerSchool = SummerSchool::whereLanguageId(session('current_lang')->id);
      return $this->applyScopes($summerSchool);
  }

}
