<?php namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelRedirectifAuthenticated {


    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle($request, Closure $next)
	{
        if(Sentinel::check()){
            return redirect('account');
        }

		return $next($request);
	}

}
