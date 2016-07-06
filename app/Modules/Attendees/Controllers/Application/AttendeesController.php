<?php namespace App\Modules\Attendees\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\Attendees\Models\Attendees;
use App\Modules\Attendees\Requests\Admin\AttendeesRequest;
use Laracasts\Flash\Flash;
class AttendeesController extends ApplicationController {

	public function index(Attendees $attendees)
	{
	  return view('Attendees::application.index', compact('attendees'));
	}
  	public function create()
	{
		$url =  $this->urlRoutePath("store");
		$method = 'POST';
		$path = $this->viewPath("register");
		$form = $this->createForm($url, $method, null);
		return view($path, compact('form'));
	}
	public function store(AttendeesRequest $request)
	{
		$attende = Attendees::create($this->getDataP($request, false));
		$attende->id ? Flash::success(trans('Attendees::application.create.success')) : Flash::error(trans('Attendees::application.create.fail'));
		return redirect("/");
	}
}
