<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TeacherAuth
{
    public function handle(Request $request, Closure $next)
    {

        if(!session()->has('teacher_logged_in'))
        {
            return redirect('/');
        }

        return $next($request);
    }
}
