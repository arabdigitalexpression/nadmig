<?php namespace App\Modules\Report\Controllers\Admin;

use App\Modules\Report\Models\Report;
use App\Modules\Report\Requests\Admin\ReportRequest;
use App\Modules\Report\Base\Controllers\ModuleController;
use App\Modules\Report\Controllers\Api\DataTables\ReportDataTable;

class ReportController extends ModuleController {

  public function index(ReportDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(ReportRequest $request)
  {
      return $this->createFlashRedirect(Report::class, $request);
  }

  public function show(Report $report)
  {
      return $this->viewPath("show", $report);
  }

  public function edit(Report $report)
  {
      return $this->getForm($report);
  }

  public function update(Report $report, ReportRequest $request)
  {
      return $this->saveFlashRedirect($report, $request);
  }

  public function destroy(Report $report)
  {
      return $this->destroyFlashRedirect($report);
  }

}
