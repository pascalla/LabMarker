<?php

namespace App\Http\Middleware;

use Closure;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

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

        if ($request->isMethod('post') || $request->isMethod('delete')) {
          
          $lab = Lab::findOrFail($request->lab);
        } else {
          $lab = Lab::findOrFail($request->route('lab_id'));
        }

        if($user->hasAnyPermission(['lecturer ' . $lab->course_code, 'admin'])){
          return $next($request);
        } else {
          return redirect()->route('lab.show', $lab->id);
        }

     }
}
