<?php namespace App\Modules\Auth\Controllers\Application;

use App\Base\Controllers\ApplicationController;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Input;
use Auth;
use Redirect;
class AuthController extends ApplicationController {

   /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     */
    public function __construct()
    {
         $this->middleware('guest', ['except' => ['logout', 'getLogout']]);
    }
    public function postLogin() {

        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'confirmed' => 1
        ];

        if ( ! Auth::attempt($credentials, Input::get('remember')))
        {
            return Redirect::back()
                ->withInput()
                ->withErrors([
                    'credentials' => trans('auth.verify.error')
                ]);
        }
        return redirect("/");
    }

}
