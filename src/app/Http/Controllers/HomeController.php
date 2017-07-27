<?php

namespace DuyDev\Http\Controllers;

use DuyDev\Frame;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastest = Frame::orderBy('created_at', 'desc')->take(10)->get();
        return view('pages.home', compact('lastest'));
    }

    public function dashboard()
    {
        return view('pages.dashboard');
    }

}
