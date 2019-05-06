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
     * @resource('able to see home')
     * @allowRole('Default, Admin')
     */
    public function index()
    {
        return view('home');
    }
}
