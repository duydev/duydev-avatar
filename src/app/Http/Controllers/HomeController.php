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
        $frames = Frame::all();
        $lastest = Frame::orderBy('created_at', 'desc')->take(10)->get();
        return view('pages.home', compact('frames', 'lastest'));
    }

    public function dashboard()
    {
        $frames = Frame::where('user_id', auth()->id())->paginate(8);
        return view('pages.dashboard', compact('frames'));
    }

}
