<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function TeacherHome()
    {
        return view('TeacherHome');
    }
    public function HRHome()
    {
        return view('HRHome');
    }
    public function AdminHome()
    {
        return view('AdminHome');
    }
}
