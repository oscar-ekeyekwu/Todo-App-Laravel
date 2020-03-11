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
    public function index()
    {
        $user = \App\User::find(auth()->id());

        if ($user->hasRole('deptHead')) {
            $userProjects = auth()->user()->projects;
            return view('user.headhome', compact('userProjects'));
        } elseif ($user->hasRole('admin')) {
            return redirect()->intended('/admin');
        } else {
            return redirect('user');
        }
    }
}
