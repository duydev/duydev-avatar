<?php

namespace DuyDev\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use DuyDev\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }
}
