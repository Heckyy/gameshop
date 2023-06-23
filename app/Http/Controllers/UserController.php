<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{

    function login(Request $req)
    {
        $user = User::where(['email' => $req->email])->first();
        if (!$user   || !Hash::check($req->password, $user->password)) {
            return redirect('/');
        } else {
            $req->session()->put('user', $user);
            return redirect('/');
        }
    }

    function register(Request $req)
    {
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        $req->session()->put('user', $user);
        return redirect('/');
    }
    // function login(Request $req)
    //  {
    //      $user= User::where(['email'=>$req->email])->first();
    //     if(!$user   || Crypt::decrypt($user->password)==$req->input('password'))
    //     //!Hash::check($req->password, $user->password))
    //      {
    //          return redirect('/');
    //      }
    //      else{
    //          $req->session()->put('user',$user);
    //          return redirect('/');
    //      }
    // }

    // function loginn(Request $req)
    // {
    //     $user = User::where('email',$req->input('email'))->get();
    //     if(Crypt::decrypt($user[0]->password)==$req->input('password'))
    //     {
    //         $req->session()->put('user',$user);
    //         return redirect('/');

    //     }

    // }

    // function register(Request $req)
    // {
    //     //return $req->input();
    //     $user= new User;
    //     $user->email=$req->input('email');
    //     $user->name=$req->input('name');
    //     $user->password=Crypt::encrypt($req->input('password'));
    //     $user->save();

    //     $req->session()->put('user',$user);
    //     return redirect('/');
    // }
}
