<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $user->user_id = $request->input('user_id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        return Redirect::route('home');
    }
}
