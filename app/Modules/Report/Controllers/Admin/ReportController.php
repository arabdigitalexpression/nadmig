<?php namespace App\Modules\Report\Controllers\Admin;

use App\Modules\Report\Models\Report;
use App\Modules\Report\Models\TrainerReport;
use App\Modules\Report\Models\SpaceManager2Report;
use App\Modules\Report\Requests\Admin\ReportRequest;
use App\Modules\Report\Requests\Admin\SpaceManager2ReportRequest;
use App\Modules\Report\Base\Controllers\ModuleController;
use App\Modules\Report\Controllers\Api\DataTables\ReportDataTable;
use App\Modules\Report\Controllers\Api\DataTables\TrainerReportDataTable;
use App\Modules\Report\Controllers\Api\DataTables\SpaceManager2ReportDataTable;
class ReportController extends ModuleController {

  public function index(ReportDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }
  public function trainer(TrainerReportDataTable $dataTable)
  {

    return $dataTable->render($this->viewPath());
  }
  public function trainerShow(TrainerReport $trainer){
    dd($trainer);
    return redirect()->route('event.page', ['event_slug' => $event->slug]);
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

  ////////////////////////////////////
  //// Space manage 2 functions /////
  //////////////////////////////////
  public function space_manger_2Create(){
    $this->formPath = 'App\Modules\Report\Forms\Admin\SpaceManager2ReportsForm';
    $url = route('dashboard.report.space_manger_2.store');
    $form = $this->createForm($url, 'POST', null, null);
    return view('Report::dashboard.create', compact('form'));
  }
  
  public function space_manger_2Index(SpaceManager2ReportDataTable $dataTable){
    return $dataTable->render($this->viewPath());
  }
  public function space_manger_2Show(SpaceManager2Report $report_id){
      return $this->viewPath("space_manager_2_show", $report_id);
  }
  public function space_manger_2Store(SpaceManager2ReportRequest $request)
  {
    return $this->createFlashRedirect(SpaceManager2Report::class, $request, false, 'space_manger_2.index');
  }
  public function space_manger_2Edit(SpaceManager2Report $report_id){
    $this->formPath = 'App\Modules\Report\Forms\Admin\SpaceManager2ReportsForm';
    $url = route('dashboard.report.space_manger_2.update', ['report_id' => $report_id->id]);
    $form = $this->createForm($url, 'PATCH', $report_id, null);
    return view('Report::dashboard.create', compact('form'));
  }
  public function space_manger_2Update(SpaceManager2Report $report_id, SpaceManager2ReportRequest $request)
  {
    return $this->saveFlashRedirect($report_id, $request);
  }
  public function space_manger_2Destroy(){
    abrot(404);
  }
}
