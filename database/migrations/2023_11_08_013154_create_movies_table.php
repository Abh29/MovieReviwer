<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->integer('kid')->index();
            $table->json('externalID')->nullable();
            $table->string('name')->default("Movie Title");
            $table->string('alternative_name')->default("Alternative Name");
            $table->string('en_name')->nullable();
            $table->json('names')->nullable();
            $table->String('type')->nullable();
            $table->integer('type_number')->default(1);
            $table->integer('year')->nullable();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('slogan')->nullable();
            $table->string('status')->default("completed");
            $table->json('rating')->nullable();
            $table->json('votes')->nullable();
            $table->integer('movie_length')->nullable();
            $table->string('rating_mpaa')->nullable();
            $table->integer('age_rating')->nullable();
            $table->json('logo')->nullable();
            $table->json('poster')->nullable();
            $table->json('backdrop')->nullable();
            $table->json('videos')->nullable();
            $table->json('genres')->nullable();
            $table->json('countries')->nullable();
            $table->json('persons')->nullable();
            $table->json('review_info')->nullable();
            $table->json('seasons_info')->nullable();
            $table->json('budget')->nullable();
            $table->json('similar_movies')->nullable();
            $table->json('seq_preq')->nullable();
            $table->json('release_years')->nullable();
            $table->integer('total_series_length')->nullable();
            $table->integer('series_length')->nullable();
            $table->boolean('is_series')->default(false);
            $table->json('facts')->nullable();
            $table->json('images_info')->nullable();
            $table->integer('searched_for')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
