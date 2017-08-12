<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class AboutController extends Controller
{
  public function index()
  {
    $data = [
      'styles' => config('resources.about.styles')
    ];

    return view('site.about.index', $data);
  }

}
