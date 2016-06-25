<?php namespace App\Modules\Reservation\Controllers\Application;

use Auth;
use Hash;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use App\Base\Controllers\ApplicationController;
use App\Base\Controllers\LogController;
use App\Modules\Reservation\Models\Reservation;
use App\Modules\Space\Models\Space;
use App\Modules\Event\Models\Event;
use App\Modules\Session\Models\Session;
use App\Modules\Reservation\Requests\Application\ReservationRequest;
class ReservationController extends ApplicationController {

private $imageColumn = "artwork";

public function list()
{

    if(Auth::check()){
        $reservations = Auth::user()->reservations()->where("status", "!=" ,"deleted")->get();
        foreach ($reservations as $reservation) {
            $reservation->organization;
            foreach ($reservation->sessions->toArray() as $key_1 => $sessions) {
                $sessions['start_date'] = strtotime($sessions['start_date']);
                foreach ($sessions as $key_2 => $session) {
                    if ($this->isJson($session)) {
                      $reservation->sessions[$key_1][$key_2] = json_decode($session);
                    }     
                }  
            }
            $sessions = $reservation->sessions->toArray();
            $this->sortBy("start_date",$sessions);
            $reservation['sessions'] = $sessions;
        }
        // dd($reservations->toArray());
        return view('Reservation::application.list', compact('reservations'));
    }
    return redirect()->route('auth.login');
}
public function index($reservation_url_id)
{
	if(!$reservation = Reservation::where('url_id', $reservation_url_id)->first()){
        abort(404);
    }
    if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $reservation->organization_id) ||  (Auth::user()->hasRole('space_manager') && Auth::user()->manageSpace->organization['id'] == $reservation->organization_id) || (Auth::user()->id == $reservation->user_id))){
        $allSessions = $reservation->sessions()->where("status", "!=" ,"deleted")->get();
        foreach ($reservation->toArray() as $key => $value) {
            if ($this->isJson($value)) {
                $reservation[$key] = json_decode($value);
            }
        }
        foreach ($allSessions->toArray() as $key_1 => $sessions) {
            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
            foreach ($sessions as $key_2 => $session) {
                if ($this->isJson($session)) {
                  $allSessions[$key_1][$key_2] = json_decode($session);
                }     
            }  
        }
        $reservation['sessions'] = $allSessions;
        $reservation->organization;
        return view('Reservation::application.index', compact('reservation'));
    }
    abort(401);
}
public function delete($reservation_url_id)
{
    if(!$reservation = Reservation::where('url_id', $reservation_url_id)->first()){
        abort(404);
    }
    if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $reservation->organization_id) || (Auth::user()->id == $reservation->user_id))){
        
        foreach ($reservation->sessions->toArray() as $key => $session) {
                $reservation->sessions[$key]['start_timestamp'] = strtotime($session['start_date']);
        }
        $sessions = $reservation->sessions->toArray();
        $this->sortBy("start_timestamp",$sessions);
        if(Carbon::now()->subDay()->diffInDays(Carbon::createFromTimeStamp($sessions[0]['start_timestamp']), false) > intval(json_decode($reservation->organization->min_to_cancel)->period)){
            $reservation['status'] = 'deleted';
            LogController::Log($reservation, 'deleted');
            $reservation->update();
            foreach ($reservation->sessions as $session) {
                unset($session['start_timestamp']);
                $session['status'] = 'deleted';
                LogController::Log($session, 'deleted', $reservation);
                $session->save();
            }
            return redirect()->route('reservation');
        }else{
            abort(403);
        }
    }
    abort(401);

}
public function create($organization_slug){
    $url =  $this->urlRoutePath("store", null, ['organization_slug' => $organization_slug['slug']]);
    $method = 'POST';
    $path = $this->viewPath("create");
    $extra = $organization_slug;
    $form = $this->createForm($url, $method, null, $extra);
    return view($path, compact('form', 'extra'));
}
public function store(ReservationRequest $request, $organization_slug)
{	
    if(Auth::check()){
        $sessions = $request['session'];
        if(!$sessions){
            Flash::warning(trans('application.sessions.none'));
            return back()->withInput();
        }
        $reservation = new Reservation($this->getDataP($request, $this->imageColumn));
        $organization_slug->reservations()->save($reservation) ? Flash::success(trans('application.create.success')) : Flash::error(trans('application.create.fail'));
        LogController::Log($reservation, 'created');
        foreach ($sessions as $session) {
            $session = new Session($this->to_json($session));
            LogController::Log($session, 'created', $reservation);
            $reservation->sessions()->save($session);
        }
        return $this->redirectRoutePath("index", null, $reservation);
    }
    return redirect()->route('auth.login');
}
public function edit($reservation_url_id)
{

    if(!$reservation = Reservation::where('url_id', $reservation_url_id)->first()){
        abort(404);
    }   
    if(Auth::check() && ((Auth::user()->id == $reservation->user_id) || Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $reservation->organization_id))){
        $allSessions = $reservation->sessions()->where("status", "!=" ,"deleted")->get();

        foreach ($reservation->toArray() as $key => $value) {
            if ($this->isJson($value)) {
                $reservation[$key] = json_decode($value);
            }
        }
        foreach ($allSessions->toArray() as $key_1 => $sessions) {
            $sessions['start_timestamp'] = strtotime($sessions['start_date']);
            foreach ($sessions as $key_2 => $session) {
                if ($this->isJson($session)) {
                  $allSessions[$key_1][$key_2] = json_decode($session);
                }     
            }  
        }
        $sortedSessions = $allSessions->toArray();
        $this->sortBy("start_timestamp",$sortedSessions);
        $reservation['sessions'] = $sortedSessions;
        if(Carbon::now()->subDay()->diffInDays(Carbon::createFromTimeStamp($sortedSessions[0]['start_timestamp']), false) > intval(json_decode($reservation->organization->min_time_before_usage_to_edit)->period)){
            $change_fees = json_decode($reservation->organization->change_fees);
            $change_fees_type = array("null" => "لا يوجد","percentage" => "نسبة من قيمة الحجز الكلى للمساحات","value" => "قيمة");
            Flash::warning(trans('Reservation::application.edit.warning') . $change_fees_type[$change_fees->type] . " " . $change_fees->amount);
            return $this->getForm($reservation, ['reservation_url_id' => $reservation['url_id']], $reservation->organization);
        }else{
            abort(403);
        }
    }else{
        abort(401);
    }

}
public function update($reservation_url_id, ReservationRequest $request)
{
    if(!$reservation = Reservation::where('url_id', $reservation_url_id)->first()){
        abort(404);
    }
    if(Auth::check() && ((Auth::user()->id == $reservation->user_id) || Auth::user()->hasRole('admin'))){
        $sessions = $request['session'];
        $reservation->fill($this->getDataP($request, $this->imageColumn));
        
        $actions = json_decode($reservation['actions']);
        foreach ($reservation->sessions()->where('status', '!=' , 'deleted')->get() as $session) {
            if (!$this->in_array_field($session->id, 'id', $sessions)) {
                $session = Session::findOrFail($session->id);
                $session['status'] = 'deleted';
                LogController::Log($session, 'deleted', $reservation);
                $session->save();
                array_push($actions, ["session" => $session->id, "action" =>"deleted", "time_stamp" => Carbon::now()->toDateTimeString()]);   
            }
        }
        foreach ($sessions as $session) {

            if ($session['id'] == 0) {
                if($reservation['status'] == 'accepted'){
                    $reservation['status'] = 'pending';
                    if(Event::where('reservation_id', $reservation->id)->exists()){
                        $event = Event::where('reservation_id', $reservation->id)->firstOrFail();
                        $event->status = 'pending';
                        $event->save();
                        LogController::Log($event, 'pending', $reservation);                
                    }
                    LogController::Log($reservation, 'pending');
                }
                $session = new Session($this->to_json($session));
                LogController::Log($session, 'created', $reservation);
                $reservation->sessions()->save($session);
            }else{
                $updateSession = Session::findOrFail($session['id']);
                LogController::Log($updateSession, 'updated', $reservation);
                $updateSession->update($this->to_json($session));
            }
        }
        $reservation['actions'] = json_encode($actions);
        $reservation->push() ? Flash::success(trans('application.update.success')) : Flash::error(trans('application.update.fail'));
        LogController::Log($reservation, 'updated');
        return $this->redirectRoutePath("index", null, $reservation);
    }
    abort(401);
}
public function accept($reservation_url_id)
{
    if(!$reservation = Reservation::where('url_id', $reservation_url_id)->first()){
        dd($reservation->toArray());
        abort(404);
    }
    if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $reservation->organization_id) )){
        $reservation['status'] = 'accepted';
        LogController::Log($reservation, 'accepted');
        $reservation->update();
        foreach ($reservation->sessions as $session) {
            $session['status'] = 'accepted';
            LogController::Log($session, 'accepted', $reservation);
            $session->save();
        }
        if($reservation->event_type == 'public'){
            if(!Event::where('reservation_id', $reservation->id)->exists()){
                $event = Event::create(['name' => $reservation->name, 'reservation_id' => $reservation->id]);
                LogController::Log($event, 'created', $reservation);                
            }else{
                $event = Event::where('reservation_id', $reservation->id)->firstOrFail();
                $event->status = 'accepted';
                $event->save();
                LogController::Log($event, 'accepted', $reservation); 
            }
        }
        Flash::success(trans('application.update.success'));
        return redirect()->back();
    }
    abort(401);
}
}
