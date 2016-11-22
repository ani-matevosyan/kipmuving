<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuiaController extends Controller
{
	public function index()
	{
		return view('site.guia.caminhando');
	}

	public function getBicicleta()
	{
		return view('site.guia.bicicleta');
	}

	public function getDecarro()
	{
		return view('site.guia.decarro');
	}

	public function getTourcultural()
	{
		return view('site.guia.tourcultural');
	}
}
