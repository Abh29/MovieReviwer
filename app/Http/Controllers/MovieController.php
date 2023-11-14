<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::inRandomOrder()->limit(12)->get([
            'id', 'kid', 'name', 'alternative_name', 'type',
            'year', 'short_description', 'rating', 'votes',
            'age_rating', 'poster', 'countries', 'seasons_info',
            'release_years', 'is_series', 'images_info', 'searched_for',
        ]);

        return Inertia::render('Movie/Index', [
            'movies' => $movies,
            'canLogin' => true,
            'canRegister' => true,
            'csrf' => csrf_token(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($movie)
    {
        /**
         * @type Movie $movie
         **/
        $movie = Movie::find($movie);
        if(!$movie) return abort(404);

        if ($movie->searched_for == 0) {
            $response = Http::get(env('KINOPOISK_URL') . 'v1.4/movie/' . $movie->kid,[
                'token' => env('KINOPOISK_KEY'),
            ]);
            $json_content = json_decode($response->body());
            $movie->fillFromJson($json_content);
            $movie->searched_for = 1;
            $movie->save();
        }

        $rated = 0;
        if (auth()->user()) {
            $rt = DB::table('ratings')
                ->where('user_id', auth()->user()->getAuthIdentifier())
                ->where('movie_id', $movie->id)
                ->get()->first();
            if ($rt)
                $rated = $rt->ratings;

        }

        $ratings = array();
        $rawRatings = $movie->ratings();

        $ratings[1] = 0;
        $ratings[2] = 0;
        $ratings[3] = 0;
        $ratings[4] = 0;
        $ratings[5] = 0;
        $ratings['total'] = 0;
        $ratings['sum'] = 0;


        foreach ($rawRatings as $rating) {
            $ratings[$rating->ratings]++;
            $ratings['total']++;
            $ratings['sum'] += $rating->ratings;
        }


        return Inertia::render('Movie/Show', [
            'canLogin' => true,
            'canRegister' => true,
            'movie' => $movie,
            'rated' => $rated,
            'ratings' => $ratings,
        ]);
    }

    public function search(Request $request) {


        $data = $request->validate([
            'search_query' => 'string|max:100|required',
        ]);

        $response = Http::get(env('KINOPOISK_URL') . 'v1.4/movie/search',[
            'token' => env('KINOPOISK_KEY'),
            'query' => $data['search_query'],
        ]);
        $json_content = json_decode($response->body());

        $out = array();
        for ($i = 0; $i < $json_content->total && $i < 10; $i++) {
            $movie = Movie::find($json_content->docs[$i]->id);
            if (!$movie) {
                $movie = new Movie();
                $movie->fillFromJson($json_content->docs[$i]);
                $movie->save();
            }
            $out[$i] = $movie;
        }

        $movies = Collection::make($out);

        return Inertia::render('Movie/Index', [
            'movies' => $movies,
            'canLogin' => true,
            'canRegister' => true,
        ]);

    }

    public function test() {
        $data = array();
        $data["movie1"] = "this is movie1";
        $data["movie2"] = "this is movie2";
        $data["movie3"] = "this is movie3";

        return inertia::render('Movie/Test', [
            'movies' => $data,
            'users' => User::all(),
        ]);
    }
}
