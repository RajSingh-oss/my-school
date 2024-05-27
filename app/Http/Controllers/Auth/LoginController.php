<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

     use AuthenticatesUsers;

     /**
      * Where to redirect users after login.
      *
      * @var string
      */
     protected $redirectTo = RouteServiceProvider::HOME;

     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
          $this->middleware('guest')->except('logout');
     }

     public function login(Request $request): RedirectResponse
     {
          $input = $request->all();

          $this->validate($request, [
               'email' => 'required|email',
               'password' => 'required',
          ]);

          if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
               if (auth()->user()->type == 'Teacher') {
                    return redirect()->route('Teacher.home');
               } else if (auth()->user()->type == 'HR') {
                    return redirect()->route('HR.home');
               } else if (auth()->user()->type == 'Admin') {
                    return redirect()->route('Admin.home');
               } else if (auth()->user()->type == 'SuperAdmin') {
                    return redirect()->route('SuperAdmin.home');
               } else {
                    Session::flash('Show', true);
                    return redirect()->route('Student.home');
               }
          } else {
               return redirect()->route('login')->with('error', 'Email-Address And Password Are Wrong.');
          }
     }
}
