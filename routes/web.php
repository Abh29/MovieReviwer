<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('movies.index'));
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(["prefix" => "/movies", "as" => "movies."],function (){

    Route::post("/search", [MovieController::class, 'search'])->name("search");
    Route::get("/", [MovieController::class, 'index'])->name('index');
    Route::get("/{id}", [MovieController::class, 'show'])->name('show');
    Route::get("/test", [MovieController::class, 'test'])->name('test');
    Route::post('/rating',[RatingController::class, 'rate'])->name('rate')->middleware('auth');
});


require __DIR__.'/auth.php';
