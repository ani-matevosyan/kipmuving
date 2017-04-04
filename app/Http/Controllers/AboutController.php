<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return view('site.about.index');
    }

}
