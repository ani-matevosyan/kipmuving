<?php

namespace App\Http\Controllers;

use App\GuideActivity;
use App\GuideComment;
use App\Mappoint;
use App\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class GuideController extends Controller
{
	
	public function howToGetToPucon()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.how-to-get-to-pucon', $data);
	}
	
	public function shopsAndServices()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.shops-and-services', $data);
	}
	
	public function transportation()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.transportation', $data);
	}
	
	public function summerAndWinter()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.summer-and-winter', $data);
	}
	
	public function whereToSleep()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.where-to-sleep', $data);
	}
	
	public function nightLife()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.night-life', $data);
	}
	
	public function cityAndZones()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.city-and-zones', $data);
	}
	
	public function whatToEat()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.what-to-eat', $data);
	}
	
	public function money()
	{
		
		$data = [
			'styles'  => [
				'css/guide-style.min.css'
			],
			'scripts' => [
				'js/guide-scripts.min.js'
			]
		];
		
		return view('site.guide.money', $data);
	}
	
	public function addComment(Request $request)
	{
		if (!empty($request['comment_id'])) {
			
			if ($guide_comment = GuideComment::find($request['comment_id'])) {
				$guide_comment->answer = $request['message'];
				$guide_comment->save();
			} else abort(404);
			
		} else {
			$guide_comment = new GuideComment();
			
			$guide_comment->guide_page = $request['guide_page'];
			$guide_comment->user_id = auth()->user()->id;
			$guide_comment->question = $request['message'];
			
			$guide_comment->save();
		}
		
		return redirect()->back();
	}
}
