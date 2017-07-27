<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GuideController extends Controller
{

    public function howToGetToPucon()
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.how-to-get-to-pucon', $data);
    }

    public function shopsAndServices()
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.shops-and-services', $data);
    }
    public function transportation()
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.transportation', $data);
    }

    public function summerAndWinter()
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.summer-and-winter', $data);
    }

    public function whereToSleep()
    {

        $data = [
            'styles'     => [
                'css/guide-style.min.css'
            ],
            'scripts'    => [
                'js/guide-scripts.min.js'
            ]
        ];

        return view('site.guide.where-to-sleep', $data);
    }
}
