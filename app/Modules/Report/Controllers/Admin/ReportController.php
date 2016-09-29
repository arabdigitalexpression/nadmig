<?php namespace App\Modules\Report\Controllers\Admin;

use App\Modules\Report\Models\Report8;
use App\Modules\Report\Models\TrainerReport;
use App\Modules\Report\Models\SpaceManager2Report;
use App\Modules\Report\Models\LikeDislikeReport;
use App\Modules\Report\Requests\Admin\Report8Request;
use App\Modules\Report\Requests\Admin\SpaceManager2ReportRequest;
use App\Modules\Report\Requests\Admin\LikeDislikeReportRequest;
use App\Modules\Report\Base\Controllers\ModuleController;
use App\Modules\Report\Controllers\Api\DataTables\Report8DataTable;
use App\Modules\Report\Controllers\Api\DataTables\TrainerReportDataTable;
use App\Modules\Report\Controllers\Api\DataTables\LikeDislikeDataTable;
use App\Modules\Report\Controllers\Api\DataTables\SpaceManager2ReportDataTable;
use Excel;
use Carbon\Carbon;
class ReportController extends ModuleController {

  public function trainer(TrainerReportDataTable $dataTable)
  {
    return $dataTable->render($this->viewPath());
  }
  public function trainerShow(TrainerReport $report_id){
    return redirect()->route('event.page', ['event_slug' => $report_id->event->slug]);
  }
  public function trainerEdit(TrainerReport $trainer){
   return redirect();
  }
  public function trainerDestroy(TrainerReport $trainer){
   return redirect();
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
  ////////////////////////////////////
  //// report 8 functions /////
  //////////////////////////////////
  public function report_8_Create(){
    $this->formPath = 'App\Modules\Report\Forms\Admin\Report8ReportsForm';
    $url = route('dashboard.report.report_8.store');
    $form = $this->createForm($url, 'POST', null, null);
    return view('Report::dashboard.create', compact('form'));
  }
  
  public function report_8_Index(Report8DataTable $dataTable){
    return $dataTable->render($this->viewPath());
  }
  public function report_8_Show(Report8 $report_id){
      // return $this->viewPath("space_manager_2_show", $report_id);
  }
  public function report_8_Store(Report8Request $request)
  {
    return $this->createFlashRedirect(Report8::class, $request, false, 'report_8.index');
  }
  public function report_8_Edit(Report8 $report_id){
    $this->formPath = 'App\Modules\Report\Forms\Admin\Report8ReportsForm';
    $url = route('dashboard.report.report_8.update', ['report_id' => $report_id->id]);
    $form = $this->createForm($url, 'PATCH', $report_id, null);
    return view('Report::dashboard.create', compact('form'));
  }
  public function report_8_Update(Report8 $report_id, Report8Request $request)
  {
    return $this->saveFlashRedirect($report_id, $request);
  }
  public function report_8_Destroy(){
    abrot(404);
  }

  ////////////////////////////
  //// Export Functions /////
  //////////////////////////
  public function export_page(){
    return view('Report::dashboard.export');
  }
  public function export($model_name, $period, $from_date = null, $to_date = null)
  {
    $model = '\App\Modules\Report\Models\\' . $model_name;
    if ($period == "all") {
      $data = $model::all();
    }else{
      $data = $model::whereBetween('created_at', [$from_date, $to_date])->get();
    }
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
      if($data[$key_1]['session_id']){
        $data[$key_1]['session_id'] =  $data[$key_1]->session->reservation->name . ' --> ' . $data[$key_1]->session->name;  
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
    return Excel::create($model_name . '_' . Carbon::now(), function($excel) use($data) {
        $excel->sheet('Sheetname', function($sheet) use($data) {
            $sheet->fromArray($data, null, 'A1', false, true);
        });
    })->export('xls');
  }

}
