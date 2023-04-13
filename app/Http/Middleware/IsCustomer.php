<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
            if(auth()->check() && auth()->user()->is_system_admin ==1){
                return new Response('<h1 style="margin-top: 150px; color:dimgray"><center>401<br>ACCESS DENIED</center></h1>',401);
            }
            return $next($request);
    }
}
