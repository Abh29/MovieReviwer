<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $local_files = [
      'movies.json',
      'movies25.json',
      'movies1000.json',
    ];


    public function run(): void
    {
        foreach ($this->local_files as $file_name) {

            $content = Storage::disk('local')->get('public/' . $file_name);
            $content_json = json_decode($content);

            for ($i = 0; $i < count($content_json->docs); $i++) {
                $m = new Movie();
                $m->fillFromJson($content_json->docs[$i]);
                $m->save();
            }


        }
    }
}
