<?php namespace App\Modules\Report\Controllers\Admin;

use App\Modules\Report\Models\Report;
use App\Modules\Report\Models\TrainerReport;
use App\Modules\Report\Models\SpaceManager2Report;
use App\Modules\Report\Models\LikeDislikeReport;
use App\Modules\Report\Requests\Admin\ReportRequest;
use App\Modules\Report\Requests\Admin\SpaceManager2ReportRequest;
use App\Modules\Report\Requests\Admin\LikeDislikeReportRequest;
use App\Modules\Report\Base\Controllers\ModuleController;
use App\Modules\Report\Controllers\Api\DataTables\ReportDataTable;
use App\Modules\Report\Controllers\Api\DataTables\TrainerReportDataTable;
use App\Modules\Report\Controllers\Api\DataTables\LikeDislikeDataTable;
use App\Modules\Report\Controllers\Api\DataTables\SpaceManager2ReportDataTable;
use Excel;
use Carbon\Carbon;
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


  ////////////////////////////////////
  //// Like Dislike functions /////
  //////////////////////////////////
  public function like_dislike_reports_Create(){
    $this->formPath = 'App\Modules\Report\Forms\Admin\LikeDislikeReportsForm';
    $url = route('dashboard.report.like_dislike_reports.store');
    $form = $this->createForm($url, 'POST', null, null);
    return view('Report::dashboard.create', compact('form'));
  }
  
  public function like_dislike_reports_Index(LikeDislikeDataTable $dataTable){
    return $dataTable->render($this->viewPath());
  }
  public function like_dislike_reports_Show(LikeDislikeReport $report_id){
      // return $this->viewPath("space_manager_2_show", $report_id);
  }
  public function like_dislike_reports_Store(LikeDislikeReportRequest $request)
  {
    return $this->createFlashRedirect(LikeDislikeReport::class, $request, false, 'like_dislike_reports.index');
  }
  public function like_dislike_reports_Edit(LikeDislikeReport $report_id){
    $this->formPath = 'App\Modules\Report\Forms\Admin\SpaceManager2ReportsForm';
    $url = route('dashboard.report.like_dislike_reports.update', ['report_id' => $report_id->id]);
    $form = $this->createForm($url, 'PATCH', $report_id, null);
    return view('Report::dashboard.create', compact('form'));
  }
  public function like_dislike_reports_Update(LikeDislikeReport $report_id, LikeDislikeReportRequest $request)
  {
    return $this->saveFlashRedirect($report_id, $request);
  }
  public function like_dislike_reports_Destroy(){
    abrot(404);
  }

  ////////////////////////////
  //// Export Functions /////
  //////////////////////////
  public function export($model_name)
  {
    $model = '\App\Modules\Report\Models\\' . $model_name;
    $data = $model::all();

    foreach ($data as $key_1 => $value_1) {
      if ($data[$key_1]['user_id']) {
        $data[$key_1]['user_id'] = $data[$key_1]->user->name;
      }
      if($data[$key_1]['organization_id']){
        $data[$key_1]['organization_id'] = $data[$key_1]->organization->name;  
      }
      if($data[$key_1]['event_id']){
        $data[$key_1]['event_id'] = $data[$key_1]->event->reservation->name;  
        $data[$key_1]['organization_id'] = $data[$key_1]->event->reservation->organization->name;  
      }
      if($data[$key_1]['attendees_id']){
        $data[$key_1]['attendees_id'] = $data[$key_1]->attende->name;  
      }
      if($data[$key_1]['trainer_id']){
        $data[$key_1]['trainer_id'] = $data[$key_1]->trainer->user->name;  
      }
      foreach ($value_1->toArray() as $key_2 => $value_2) {
        if (is_object($value_2)) {
          foreach ($value_2 as $key_3 => $value_3) {
            $data[$key_1][trans('Report::dashboard.'.$model_name.'.fields.'. $key_2 .'.'. $key_3)] = $value_3;  
          }
        }else{
          $data[$key_1][trans('Report::dashboard.'.$model_name.'.fields.'. $key_2)] = $value_2;
        }
        unset($data[$key_1][$key_2]);
      }
    }
    $data = $data->toArray();
    dd($data);
    return Excel::create($model_name . '_' . Carbon::now(), function($excel) use($data) {
        $excel->sheet('Sheetname', function($sheet) use($data) {
            $sheet->fromArray($data, null, 'A1', false, true);
        });
    })->export('xls');
  }

}
