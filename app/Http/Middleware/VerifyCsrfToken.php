<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Input;
use Redirect;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

    protected $except = []
    ;
	public function handle($request, Closure $next)
	{
/*        if (Session::token() !== Input::get('_token')) {
        // throw new Illuminate\Session\TokenMismatchException;
            return Redirect::back()->withMessage('stop wiggling wit h my token');
        }*/
		return parent::handle($request, $next);
	}

}
