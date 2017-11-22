<?php

namespace App\Http\Controllers;

use App\GuideComment;
use App\Offer;
use Illuminate\Http\Request;

class GuideController extends Controller
{

  private $data = [];

  public function __construct(Offer $offer)
  {
    $s_offers = \session('basket.special');

    $this->data = [
      'styles' => config('resources.guide.styles'),
      'scripts' => config('resources.guide.scripts'),
      'count'             => [
				'special_offers' => count($s_offers),
				  'offers'         => count(session('basket.offers')) + count(session('basket.free'))
			]
    ];
  }

  public function howToGetToPucon()
  {
    return view('site.guide.how-to-get-to-pucon', $this->data);
  }

  public function shopsAndServices()
  {
    return view('site.guide.shops-and-services', $this->data);
  }

  public function transportation()
  {
    return view('site.guide.transportation', $this->data);
  }

  public function summerAndWinter()
  {
    return view('site.guide.summer-and-winter', $this->data);
  }

  public function whereToSleep()
  {
    return view('site.guide.where-to-sleep', $this->data);
  }

  public function nightLife()
  {
    return view('site.guide.night-life', $this->data);
  }

  public function cityAndRegion()
  {
    return view('site.guide.city-and-region', $this->data);
  }

  public function whatToEat()
  {
    return view('site.guide.what-to-eat', $this->data);
  }

  public function money()
  {
    return view('site.guide.money', $this->data);
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
