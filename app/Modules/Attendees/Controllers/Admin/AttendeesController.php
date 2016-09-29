<?php namespace App\Modules\Attendees\Controllers\Admin;

use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Requests\Admin\AttendeesRequest;
use App\Modules\Attendees\Base\Controllers\ModuleController;
use App\Modules\Attendees\Controllers\Api\DataTables\AttendeesDataTable;
use Auth;
use Excel;
use Carbon\Carbon;
class AttendeesController extends ModuleController {

  public function index(AttendeesDataTable $dataTable)
  {
      return $dataTable->render($this->viewPath());
  }

  public function store(AttendeesRequest $request)
  {
    if(Auth::user()->hasRole('organization_manager') || Auth::user()->hasRole('admin')){
      $request['organization_id'] = Auth::user()->manageOrganization->id;
    }
    return $this->createFlashRedirect(Attendees::class, $request);
  }

  public function show(Attendees $attendees)
  {
      return $this->viewPath("show", $attendees);
  }

  public function edit(Attendees $attendees)
  {
    if(Auth::user()->hasRole('organization_manager') && $attendees->organization_id == Auth::user()->manageOrganization->id || Auth::user()->hasRole('admin')){
      return $this->getForm($attendees);
    } 
    abrot(401);
  }

  public function update(Attendees $attendees, AttendeesRequest $request)
  {
    if(Auth::user()->hasRole('organization_manager') && $attendees->organization_id == Auth::user()->manageOrganization->id || Auth::user()->hasRole('admin')){
      if($request['workshop']){
          $attendees->events()->sync($request['workshop']);    
      }
        return $this->saveFlashRedirect($attendees, $request);
    }
    abrot(401);
  }

  public function destroy(Attendees $attendees)
  {
      return $this->destroyFlashRedirect($attendees);
  }
  public function export($selector_key, $selector_value, $period, $from_date = null, $to_date = null)
  {
    if ($period == "all") {
      $data = Attendees::where($selector_key, $selector_value)->get();
    }else{
      $data = Attendees::whereBetween('created_at', [$from_date, $to_date])->where($selector_key, $selector_value)->get();
    }
    // dd($data->toArray());
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
            $data[$key_1][trans('Attendees::dashboard.fields.attendees.'. $key_2 .'.'. $key_3)] = $value_3;  
          }
        }else{
          $data[$key_1][trans('Attendees::dashboard.fields.attendees.'. $key_2)] = $value_2;
        }
        unset($data[$key_1][$key_2]);
      }
    }
    $data = $data->toArray();
    return Excel::create('Attendees_' . Carbon::now(), function($excel) use($data) {
        $excel->sheet('Sheetname', function($sheet) use($data) {
            $sheet->fromArray($data, null, 'A1', false, true);
        });
    })->export('xls');
  }

}
