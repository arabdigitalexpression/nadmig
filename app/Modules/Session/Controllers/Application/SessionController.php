<?php namespace App\Modules\Session\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Session\Models\Session;
use App\Modules\Event\Models\Event;
use Auth;
use Flash;
class SessionController extends ApplicationController {

  public function index(Session $session)
  {
  	if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $session->reservation->organization_id) || (Auth::user()->hasRole('space_manager') && Auth::user()->manageSpace['id'] == $session->space_id) )){
	  	foreach ($session->toArray() as $key => $value) {
	  		if (!is_array($value) && $this->isJson($value)) {
	              $session[$key] = json_decode($value);
	        } 
	  	}
	  	$session->space;
	  	$session->reservation;
      return view('Session::application.index', compact('session'));
     }
	return response('Unauthorized.', 401);
  }
  public function accept(Session $session)
  {
  	 if(Auth::check() && (Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organization_manager') && Auth::user()->manageOrganization['id'] == $session->reservation->organization_id) || (Auth::user()->hasRole('space_manager') && Auth::user()->manageSpace['id'] == $session->space_id) )){
        $session['status'] = 'accepted';
        $session->update();
        if($this->isAllAccepted($session->reservation->sessions->toArray())){
        	// update reservation status if all session accepted
        	$session->reservation->status = 'accepted';
        	$session->reservation->update();
        	// create event if public
        	if($session->reservation->event_type == 'public'){
        		Event::create(['name' => $session->reservation->name, 'reservation_id' => $session->reservation->id]);
        	}
        }
        Flash::success(trans('application.update.success'));
        return redirect()->route('application.reservation.index', ['reservation_url_id' => $session->reservation->url_id]);
    }
    return response('Unauthorized.', 401);
  }
  public function isAllAccepted($sessions){
  	$length = count($sessions);
  	$count = 0;
  	foreach ($sessions as $session) {
  		if($session['status'] == 'accepted'){
  			$count++;
  		}
  	}
  	if($count == $length){
  		return true;
  	}else{
  		return false;
  	}
  }
}
