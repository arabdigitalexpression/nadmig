<?php namespace App\Modules\Report\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Report\Requests\Application\TrainerRequest;
use App\Modules\Report\Models\TrainerReport;
use App\Modules\Event\Models\Event;
use App\Modules\Attendees\Models\Attendees;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Base\Controllers\LogController;
class ReportController extends ApplicationController {

  public function index(Event $event)
  {

  	$sessions = $event->reservation->sessions->toArray();
  	$start = Carbon::createFromFormat('Y/m/d', current($sessions)['start_date'])->format('Y-m-d');
  	$end = Carbon::createFromFormat('Y/m/d', end($sessions)['start_date']);
  	$now = Carbon::now();
  	if($now->diffInDays($end, false) > 0){
  		$count = $this->diff_in_weeks_and_days($start, $now);
  	}else{
		  $count = $this->diff_in_weeks_and_days($start, $end->format('Y-m-d'));
  	}
    return view('Report::application.index', compact('event', 'count'));
  }
  public function report(Event $event, $week, $attendees_id)
  {
  	if(is_null(TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first())){
	  	$attende = Attendees::findOrFail($attendees_id);
	  	$url =  route("report.page.event.store", ['event_slug' => $event->slug, 'week' => $week, 'attendees_id' => $attende->id]);
	  	$this->formPath = "App\Modules\Report\Forms\Application\TrainerReportForm";
	    $method = 'POST';
	    $path = $this->viewPath("create");
	    $extra = $attende;
	    $form = $this->createForm($url, $method, null, $extra);
	    return view($path, compact('form', 'extra'));
	}else{
		Flash::error(trans('Report::application.create.created'));
  		return redirect()->route('report.page', ['event_slug' => $event->slug]);  
	}
  }
  public function store(Event $event, $week, $attendees_id, TrainerRequest $request)
  {
  	if(is_null(TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first())){
		  $request['attendees_id'] =  intval($attendees_id);
	  	$request['week'] =  intval($week);
	  	$request['event_id'] = $event->id;
	  	$model = TrainerReport::create($this->getDataP($request, false));
	    $model->id ? Flash::success(trans('Report::application.create.success')) : Flash::error(trans('Report::application.create.fail'));
	    LogController::Log($model, 'updated');
	  	return redirect()->route('report.page', ['event_slug' => $event->slug]);  		
  	}else{
  		Flash::error(trans('Report::application.create.created'));
  		return redirect()->route('report.page', ['event_slug' => $event->slug]);  	
  	}

  }
  public function show(Event $event, $week, $attendees_id)
  {
  	if(!is_null(TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first())){
  		$report = TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first();
  		return view('Report::application.show', compact('report'));
  	}else{
  		abort(404);
  	}
  }
  public function edit(Event $event, $week, $attendees_id)
  {
  	if(TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first()){
  		$report = TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first();
  		if($this->diff_in_weeks_and_days(Carbon::createFromFormat('Y/m/d', $event->reservation->sessions()->first()['start_date'])->format('Y-m-d'), Carbon::now()) == $report->week){
  			$attende = Attendees::findOrFail($attendees_id);
		  	$url =  route("report.page.event.edit", ['event_slug' => $event->slug, 'week' => $week, 'attendees_id' => $attende->id]);
		  	$this->formPath = "App\Modules\Report\Forms\Application\TrainerReportForm";
		    $method = 'PATCH';
		    $path = $this->viewPath("edit");
		    $extra = $attende;
		    $form = $this->createForm($url, $method, $report, $extra);
		    return view($path, compact('form', 'extra'));
  		}else{
  			abort(401);
  		}
	}else{
		abort(401);
	}
  }
  public function update(Event $event, $week, $attendees_id, TrainerRequest $request)
  {
  	if(TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first()){
  		$report = TrainerReport::where('event_id', $event->id)->where('week', $week)->where('attendees_id', $attendees_id)->first();
  		$report->fill($this->getDataP($request, null));
        $report->save() ? Flash::success(trans('Report::application.create.success')) : Flash::error(trans('Report::application.create.fail'));
        LogController::Log($report, 'updated');
        return redirect()->route('report.page', ['event_slug' => $event->slug]);  		
  	}else{
		abort(401);
	}
  }
  protected function diff_in_weeks_and_days($from, $to) {
	    $day   = 24 * 3600;
	    $from  = strtotime($from);
	    $to    = strtotime($to) + $day;
	    $diff  = abs($to - $from);
	    $weeks = floor($diff / $day / 7);
	    $out   = array();
	    return (int)($weeks);
	}

}
