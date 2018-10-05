<?php

namespace App\Http\Middleware;

use Closure;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use App\Lab;
use App\User;

class modifyLabPermission
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
         $user = Auth::user();
         $lab = Lab::findOrFail($request->lab);
         if($user->hasAnyPermission(['lecturer ' . $lab->course_code, 'admin'])){
           return $next($request);
         } else {
            return redirect()->route('lab.show', $lab->id);
         }

     }
}
