<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class RedirectIfAuthenticated
// {
//     public function handle(Request $request, Closure $next)
//     {
//         if (Auth::check()) {
//             $user = Auth::user();
//             if ($user->hasRole('admin')) {
//                 return redirect()->route('admin.dashboard');  // Pastikan route admin.dashboard ada
//             } elseif ($user->hasRole('user')) {
//                 return redirect()->route('user.dashboard');  // Pastikan route user.dashboard ada
//             } elseif ($user->hasRole('organizer')) {
//                 return redirect()->route('organizer.dashboard');  // Pastikan route organizer.dashboard ada
//             }
//         }

//         return $next($request);
//     }
// }
