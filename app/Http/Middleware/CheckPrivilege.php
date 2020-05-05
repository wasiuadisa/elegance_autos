<?php

namespace App\Http\Middleware;

use Closure;

/* Import database logic */

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        echo "This is the created middleware in effect.";

        $privilege = (new \App\Models\Logic\Users)->userPrivilege();

//        if($request->privilege == 3)
        if($request->id == 3)
        {
//            return redirect("login");
            return redirect('contact-us');
        }

        return $next($request);
    }
}
