<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getMovie(Request $request)
    {
        return view('movie', ['movie' => $request->name]);
    }
}