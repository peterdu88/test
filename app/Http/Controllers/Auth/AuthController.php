<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Routing\Controller;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Input;
USE Password;
use Redirect;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    /**
     * Show the form for logging the user in.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Handle posting of the form for logging the user in.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin()
    {
        try {
            $input = Input::all();

            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];

            $validator = Validator::make($input, $rules);

            if ($validator->fails()) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors($validator);
            }
            $remember = (bool)Input::get('remember', false);
            if ($user = \Sentinel::authenticate($input, $remember)) {

                if(\Sentinel::login($user,$remember)){

                    $this->redirectWhenLoggedIn();
                }
            }

            $errors = 'Invalid login or password.';

        } catch (NotActivatedException $e) {
            $errors = 'Account is not activated!';

            return Redirect::to('reactivate')->with('user', $e->getUser());
        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();

            $errors = "Your account is blocked for {$delay} second(s).";
        }

        return Redirect::back()
            ->withInput()
            ->withErrors($errors);
    }

    /**
     * Show the form for the user registration.
     *
     * @return \Illuminate\View\View
     */
/*    public function register()
    {
        return view('auth.register');
    }*/

    /**
     * Handle posting of the form for the user registration.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
/*    public function processRegistration()
    {
        $input = Input::all();

        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        if ($user = \Sentinel::register($input)) {
            $activation =
                \Activation::create($user);

            $code = $activation->code;

            $sent = Mail::send('emails.activate', compact('user', 'code'), function ($m) use ($user) {
                $m->to($user->email)->subject('Activate Your Account');
            });

            if ($sent === 0) {
                return Redirect::to('register')
                    ->withErrors('Failed to send activation email.');
            }

            return Redirect::to('login')
                ->withSuccess('Your accout was successfully created. You might login now.')
                ->with('userId', $user->getUserId());
        }

        return Redirect::to('register')
            ->withInput()
            ->withErrors('Failed to register.');
    }*/


    protected function redirectWhenLoggedIn()
    {
        // Logged in successfully - redirect based on type of user
        $user = Sentinel::getUser();
        $admin = Sentinel::findRoleByName('admin');

        if ($user->inRole($admin)) {
            return redirect()->intended('admin');
        } else{
            return redirect()->intended('account');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Sentinel::logout();
        return Redirect::to('login');
    }

    /**
     * @param $id
     * @param $code
     * @return $this
     */
    public function getActivate($id, $code){

        $user = Sentinel::findById($id);

        if ( ! Activation::complete($user, $code))
        {
            return Redirect::to("login")
                ->withErrors('Invalid or expired activation code.');
        }

        return Redirect::to('login')
            ->withSuccess('Account activated.');
    }

    /**
     * @param $id
     * @param $code
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function getReactivate($id, $code){
        if ( ! $user = Sentinel::check())
        {
            return Redirect::to('login');
        }

        $activation = Activation::exists($user) ?: Activation::create($user);

        // This is used for the demo, usually you would want
        // to activate the account through the link you
        // receive in the activation email
        Activation::complete($user, $activation->code);

        $code = $activation->code;

        $sent = Mail::send('emails.activate', compact('user', 'code'),
            function($m) use ($user)
            {
                $m->to($user->email)->subject('Activate Your Account');
            });

        if ($sent === 0)
        {
            return Redirect::to('login')
                ->withErrors('Failed to send activation email.');
        }

        return Redirect::to('account')
            ->withSuccess('Account activated.');
    }

    public function deactivate(){

        $user = Sentinel::check();

        Activation::remove($user);

        return Redirect::back()
            ->withSuccess('Account deactivated.');
    }

    public function wait(){
        return view('emails.wait');
    }
}
