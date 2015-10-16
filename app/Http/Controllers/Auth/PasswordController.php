<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset requests
	| and uses a simple trait to include this behavior. You're free to
	| explore this trait and override any methods you wish to tweak.
	|
	*/

	use ResetsPasswords;

	/**
	 * Create a new password controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\PasswordBroker  $passwords
	 * @return void
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;

		$this->middleware('guest');

	}

    /**
     * @return \Illuminate\View\View
     */
    public function index(){
        return view('auth.password');
    }

    /**
     * @return mixed
     */
    public  function updatepassword(){
        $rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $email = Input::get('email');

        $user = Sentinel::findByCredentials(compact('email'));

        if ( ! $user)
        {
            return Redirect::back()
                ->withInput()
                ->withErrors('No user with that email address belongs in our system.');
        }

        $reminder = Reminder::exists($user) ?: Reminder::create($user);

        $code = $reminder->code;

        $sent = Mail::send('emails.reminder', compact('user', 'code'), function($m) use ($user)
        {
            $m->to($user->email)->subject('Reset your account password.');
        });

        if ($sent === 0)
        {
            return Redirect::to('register')
                ->withErrors('Failed to send reset password email.');
        }

        return Redirect::to('wait');
    }

    /**
     * @param $id
     * @param $code
     * @return \Illuminate\View\View
     */
    public function getResetPasswordCode( $id, $code ){
        $user = Sentinel::findById($id);
        return view('auth.complete',compact('user'));
    }

    /**
     * @param $id
     * @param $code
     * @return mixed
     */
    public  function postResetPasswordCode($id,$code){
        $rules = [
            'password' => 'required|confirmed',
        ];

        $validator = Validator::make(Input::get($id), $rules);

        if ($validator->fails())
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user = Sentinel::findById($id);

        if ( ! $user)
        {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        if ( ! Reminder::complete($user, $code, Input::get('password')))
        {
            return Redirect::to('login')
                ->withErrors($validator);
        }

        return Redirect::once('login')
            ->withSuccess("Password Reset.");
    }
}
