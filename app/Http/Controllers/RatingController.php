<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
  public function rate(Request $request) {
      $movie = Movie::find($request->id);
      if (!$movie) return;

      $rating = Rating::query()
          ->where('user_id', auth()->user()->getAuthIdentifier())
          ->where('movie_id', $request->id)
          ->first();

      if (!$rating) $rating = new Rating();

      $rating->movie_id = $movie->id;
      $rating->user_id = auth()->user()->getAuthIdentifier();
      $rating->ratings = $request->rating;

      $rating->save();
  }

}
