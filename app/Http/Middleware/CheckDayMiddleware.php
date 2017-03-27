<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
class CheckDayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$day)
    {
                $arrayDay=explode("-",$day);
                if(in_array(Carbon::now()->dayOfWeek,$arrayDay)){
                 return $next($request);   
             }else{
                abort(401);
            }
     }
}
