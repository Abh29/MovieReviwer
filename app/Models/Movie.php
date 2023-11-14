<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'kid', 'name', 'alternative_name', 'en_name', 'names', 'type',
        'type_number', 'year', 'description', 'short_description',
        'slogan', 'status', 'rating', 'votes', 'movie_length', 'rating_mpaa',
        'age_rating', 'logo', 'poster', 'backdrop', 'videos', 'genres', 'countries',
        'persons', 'review_info', 'seasons_info', 'budget', 'similar_movies', 'seq_preq',
        'release_years', 'total_series_length', 'series_length', 'is_series',
        'facts', 'images_info', 'searched_for',
    ];



    public function fillFromJson($jsonString) {
        $this->kid = $jsonString->id;
        $this->externalID = json_encode($jsonString->externalId ?? '');
        $this->name = $jsonString->name ?? "";
        $this->alternative_name = $jsonString->alternativeName ?? 'Alternative Name';
        $this->en_name = $jsonString->enName ?? "";
        $this->names = json_encode($jsonString->names);
        $this->type = $jsonString->type;
        $this->type_number = $jsonString->typeNumber;
        $this->year = $jsonString->year;
        $this->description = $jsonString->description;
        $this->short_description = $jsonString->shortDescription;
        $this->slogan = $jsonString->slogan ?? null;
        $this->status = $jsonString->status ?? 'completed';
        $this->rating = json_encode($jsonString->rating);
        $this->votes = json_encode($jsonString->votes);
        $this->movie_length = $jsonString->movieLength;
        $this->rating_mpaa = $jsonString->ratingMpaa;
        $this->age_rating = $jsonString->ageRating;
        $this->logo = json_encode($jsonString->logo ?? '');
        $this->poster = json_encode($jsonString->poster);
        $this->backdrop = json_encode($jsonString->backdrop);
        $this->videos = json_encode($jsonString->videos ?? '');
        $this->genres = json_encode($jsonString->genres);
        $this->countries = json_encode($jsonString->countries);
        $this->persons = json_encode($jsonString->persons ?? '');
        $this->review_info = json_encode($jsonString->reviewInfo ?? '');
        $this->seasons_info = json_encode($jsonString->seasonsInfo ?? '');
        $this->budget = json_encode($jsonString->budget ?? '');
        $this->similar_movies = json_encode($jsonString->similarMovies ?? '');
        $this->seq_preq = json_encode($jsonString->sequelsAndPrequels ?? '');
        $this->release_years = json_encode($jsonString->releaseYears ?? '');
        $this->total_series_length = $jsonString->totalSeriesLength;
        $this->series_length = $jsonString->seriesLength;
        $this->is_series = $jsonString->isSeries;
        $this->facts = json_encode($jsonString->facts ?? '');
        $this->images_info = json_encode($jsonString->imagesInfo ?? '');
    }


    public function ratings() {
        return $this->hasMany(Rating::class, 'movie_id', 'id')->get();
    }

}
