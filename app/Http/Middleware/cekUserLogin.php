<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class cekUserLogin
{
    public function handle(Request $request, Closure $next, $level)
    {
        $user = Auth::user();

        if (!Auth::check()) {
            return redirect('login');
        }
        if ($user->level == $level) 
             return $next($request);
        
        return redirect('login')->with('error', 'Anda tidak memiliki hak akses yang diperlukan');
    }
}

