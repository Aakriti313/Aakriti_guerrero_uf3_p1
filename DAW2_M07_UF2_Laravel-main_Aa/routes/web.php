<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorsController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('year')->group(function() {
    Route::group(['prefix'=>'filmout'], function(){
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}',[FilmController::class, "listFilmsByYear"])->name('filmsByYear');
        Route::get('filmsByGenre/{genre?}',[FilmController::class, "listFilmsByGenre"])->name('filmsByGenre');
        Route::get('sortFilms',[FilmController::class, "listSortFilms"])->name('sortFilms');
        Route::get('countFilms',[FilmController::class, "listCountFilms"])->name('countFilms');
    });
});

//New group with the prefix filmin and the new route.
Route::middleware('img_url')->group(function() {
    Route::group(['prefix'=>'filmin'], function(){
        Route::post('createFilm',[FilmController::class, "createFilm"])->name('createFilm');
    });
});

//New group of actors with the prefix actorout
Route::group(['prefix'=>'actorout'], function(){
    Route::get('actors',[ActorsController::class, "listActors"])->name('actors');
    Route::get('countActors',[ActorsController::class, "listCountActors"])->name('countActors');
    Route::get('actorsByDecade/{decade?}',[ActorsController::class, "listactorsByDecade"])->name('actorsByDecade');
});
