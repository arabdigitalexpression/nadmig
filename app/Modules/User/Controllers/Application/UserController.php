<?php namespace App\Modules\User\Controllers\Application;

use App\Base\Controllers\ApplicationController;
use App\Modules\User\Models\User;
use App\Modules\User\Requests\Application\UserRequest;
use Laracasts\Flash\Flash;
use Mail;
use Input;
use Auth;
use App\Modules\Role\Models\Role;
class UserController extends ApplicationController {
	/**
     * Image column of the model
     *
     * @var string
     */
    private $imageColumn = "picture";

	public function index()
	{
        if(Auth::check()){
            $user = Auth::user();
            return view('User::application.index', compact('user'));
        }
        return redirect(route('auth.login'));
	}
	public function create()
	{
		$url =  $this->urlRoutePath("store");
    	$method = 'POST';
		$path = $this->viewPath("register");
		$form = $this->createForm($url, $method, null);
		return view($path, compact('form'));
	}
	public function store(UserRequest $request)
	{
		
        $confirmation_code = str_random(30);
        $request['confirmation_code'] = $confirmation_code;
     	$role = Role::whereName('user')->first();
        $user = User::create($this->getDataP($request, $this->imageColumn));
        $user->attachRole($role);
    	$user->id ? Flash::success(trans('user.create.success')) : Flash::error(trans('user.create.fail'));
    	Mail::send('User::email.verify', ['confirmation_code' => $confirmation_code], function($message) {
            $message->to(Input::get('email'), Input::get('name'))
                ->subject(trans('user.mail.verify'));
        });
		return redirect("/");
	}

    public function edit()
    {

        if(Auth::check()){
            $user = Auth::user();
            unset($user['password']);
            return $this->getForm($user, null, $user);
        }
        abort(403);
    }

    public function update(UserRequest $request)
    {
        if(Auth::check()){
            $user = Auth::user();
            return $this->saveFlashRedirect($user, $request, $this->imageColumn);
        }
        abort(403);
    }
	public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->save();

        Flash::message(trans('user.mail.verify'));

        return redirect("/");
    }
}
