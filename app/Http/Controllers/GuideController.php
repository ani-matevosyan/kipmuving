<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GuideController extends Controller
{

    public function index(Offer $offer)
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.how-to-get', $data);
    }

    public function getMarkets(Offer $offer)
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.markets', $data);
    }
}
