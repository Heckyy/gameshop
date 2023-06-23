<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userId = Session::get('user')['id'];
        // $userId = session('user');
        $users = DB::table('users')->where('id', "=", $userId)->get();
        foreach ($users as $user) {
            if (!$user || $user->role !== 'admin') {
                return abort(403, 'Unauthorized');
            }
        }
        // Cek jika user tidak memiliki peran admin



        return $next($request);
    }
}
