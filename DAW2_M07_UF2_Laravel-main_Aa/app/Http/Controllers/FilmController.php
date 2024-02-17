<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller{
    /**
    * Read films from storage
    */
    public static function readFilms(): array {
        //Get films from storage and decode it.
        $filmsfromStorage = json_decode(Storage::get('public/films.json'), true);
        //Get films from DB and convert to array.
        $filmsfromDB = DB::table('films')->get()->toArray();
        //Convert filmsFromDB from an object stdClass to an asosiative arrays.
        $filmsfromDBArray = [];
            foreach ($filmsfromDB as $film) {
            $filmsfromDBArray[] = (array) $film;
        }

        $films = array_merge($filmsfromStorage, $filmsfromDBArray);

        return $films;
    }
    /**
    * List films older than input year 
    * if year is not infomed 2000 year will be used as criteria
    */
    public function listOldFilms($year = null){        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "List of old films (Before $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
    * List films younger than input year
    * if year is not infomed 2000 year will be used as criteria
    */
    public function listNewFilms($year = null){
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "List of new films (After $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
    * List all the films or filter by year or genre.
    */
    public function listFilms($year = null, $genre = null){
        $films_filtered = [];

        $title = "List of all films";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "List of all films filtered by year";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "List of all films filtered by category";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "List of all films filtered by year and category";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    /**
    * List films by year
    * if year is not infomed 1994 year will be used as criteria
    */
    public function listFilmsByYear($year = null){
        $filmsByYear = [];   
        $films = FilmController::readFilms();

        //if year is null
        if (is_null($year))
        $year = 1994;

        //list based on year
        foreach ($films as $film) {
            if (!is_null($year) && $film['year'] == $year){
                $title = "List of all films filtered by year( $year )";
                $filmsByYear[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByYear, "title" => $title]);
    }
    /**
    * List films by genre
    * if genre is not infomed Drama genre will be used as criteria
    */
    public function listFilmsByGenre($genre = null){
        $filmsByGenre = [];
        $films = FilmController::readFilms();

        //if genre is null
        if (is_null($genre))
        $genre = "Drama";

        //list based on genre
        foreach ($films as $film) {
            if (!is_null($genre) && strtolower($film['genre']) == strtolower($genre)){
                $title = "List of all films filtered by genre ( $genre )";
                $filmsByGenre[] = $film;
            }
        }
        return view('films.list', ["films" => $filmsByGenre, "title" => $title]);
    }

    /**
    * List films sorted by year descending from newest to oldest
    */
    public function listSortFilms($year = null){
    
        $sortFilms = [];   
        $films = FilmController::readFilms();

        if (!is_null($year)) {
            $title = "List of all films filtered by year from new to old";
            foreach ($films as $film) {
                if ($film['year'] == $year) {
                    $sortFilms[] = $film;
                }
            }
        } else {
            $title = "List of all films filtered by year from new to old";
            usort($films, function($a, $b) {
                return $b['year'] - $a['year'];
            });
            $sortFilms = $films;
        }
        return view('films.list', ["films" => $sortFilms, "title" => $title]);
    }
    /**
    * List total number of films
    */
    public function listCountFilms($year = null, $genre = null) {
        $films = FilmController::readFilms();
        $title = "Total number of films";
        $filteredFilms = array_filter($films, function ($film) use ($year, $genre) {
            return (is_null($year) || $film['year'] == $year) && (is_null($genre) || strtolower($film['genre']) == strtolower($genre));
        });
    
        $totalFilmCount = count($filteredFilms);
    
        return view('films.count', ["films" => $totalFilmCount, "title" => $title]);
    }
    /**
    * Check if film name exists
    */
    public function isFilm($nombre) {
        $films = FilmController::readFilms();
    
        foreach ($films as $film) {
            if ($film['name'] == $nombre) {
                return true;
            }
        }
    
        return false;
    }    
    /**
    * Create a new film
    */
    public function createFilm(Request $request){
        //Get the form data
        $nombre = $request->input('nombre');
        $ano = $request->input('ano');
        $genero = $request->input('genero');
        $pais = $request->input('pais');
        $duracion = $request->input('duracion');
        $img_url = $request->input('img_url');

        //Check if film name exists in films
        if ($this->isFilm($nombre)) {
            // Redirect to the main page with an error message
            return redirect('/')->with('error', 'This film already exists.');
        }

        $filmData = [
            'name' => $nombre,
            'year' => $ano,
            'genre' => $genero,
            'country' => $pais,
            'duration' => $duracion,
            'img_url' => $img_url ?: '',
        ];

        //Decide where insert the data, JSON or SQL
        $insertIntoJSON = false;

        if ($insertIntoJSON === "true") {
            //Insert film into JSON
            $films = $this->readFilms();
            $films[] = $filmData;
            Storage::put('public/films.json', json_encode($films));
        } else {
            // Insert into SQL
            $film = new Film();
            $film->name = $nombre;
            $film->year = $ano;
            $film->genre = $genero;
            $film->country = $pais;
            $film->duration = $duracion;
            $film->img_url = $img_url ?: '';
            $film->screenwriters_id  = 1;
            $film->save();
        }

        return $this->listFilms();
    }
}