<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

public function login(Request $request)
{

$credentials = $request->validate([

'email'=>'required|email',

'password'=>'required'

]);


if(Auth::attempt($credentials)){


$request->session()->regenerate();


$user = Auth::user();



if($user->role == 'production_manager'){

return redirect('/production/dashboard');

}


if($user->role == 'administrator'){

return redirect('/admin/dashboard');

}


if($user->role == 'super_admin'){

return redirect('/super/dashboard');

}


}


return back()->withErrors([

'email'=>'Invalid credentials'

]);


}

}