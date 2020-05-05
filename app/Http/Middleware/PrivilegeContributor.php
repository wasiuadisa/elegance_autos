<?php

namespace App\Http\Middleware;

use Closure;

/*Import additional classes*/
use Illuminate\Contracts\Auth\Guard;

class PrivilegeContributor
{
    /* Properties */
    protected $auth;

    /* Constructor */
    public function __contstruct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $id != $this->auth->user()->id )
        {
//            return redirect('landingPage');
        }
        else {
            return $next($request);
        }
    }
}
