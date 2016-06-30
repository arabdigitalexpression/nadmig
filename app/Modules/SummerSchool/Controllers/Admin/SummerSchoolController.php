<?php namespace App\Modules\SummerSchool\Controllers\Admin;

use App\Modules\SummerSchool\Models\SummerSchool;
use App\Modules\SummerSchool\Requests\Admin\SummerSchoolRequest;
use App\Modules\SummerSchool\Base\Controllers\ModuleController;
use App\Modules\SummerSchool\Controllers\Api\DataTables\SummerSchoolDataTable;

class SummerSchoolController extends ModuleController {

  public function index(SummerSchoolDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(SummerSchoolRequest $request)
  {
      return $this->createFlashRedirect(SummerSchool::class, $request);
  }

  public function show(SummerSchool $summerSchool)
  {
      return $this->viewPath("show", $summerSchool);
  }

  public function edit(SummerSchool $summerSchool)
  {
      return $this->getForm($summerSchool);
  }

  public function update(SummerSchool $summerSchool, SummerSchoolRequest $request)
  {
      return $this->saveFlashRedirect($summerSchool, $request);
  }

  public function destroy(SummerSchool $summerSchool)
  {
      return $this->destroyFlashRedirect($summerSchool);
  }

}
