<?php

namespace aieapV1\Http\Middleware;

use Closure;
use Auth;
use \aieapV1\Models\Role;
class Admin
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
          /*if(Auth::check() && Auth::user()->role == 'Admin'){
           return $next($request);
          } else {
             return redirect('login');
               }
         }*/
         if ($request->user()===null) {
          return response ("--------Sorry!----Insufficient Permission ---------","401");
         }

         $actions=$request->route()->getAction();
         $roles=isset($actions['roles'])?$actions['roles']:null;
         if ($request->user()->hasAnyRole($roles)|| !$roles)
          {return $next($request);

          }
          return response ("--------Sorry!----Insufficient Permission ---------","401");
        }
}
