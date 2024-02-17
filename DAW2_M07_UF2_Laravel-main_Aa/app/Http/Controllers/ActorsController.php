<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    /**
    * Read actors from DB
    */
    public static function readActors(){
        $actors = DB::table('actors')->get();
        return $actors;
    }
    /**
    * List all the actors.
    */
    public function listActors(){
        $title = "List of all actors";
        $actors = ActorsController::readActors();

        //Convert to a PHP array
        $actorsArray = $actors->toArray();

        return view('actors.list', ["actors" => $actorsArray, "title" => $title]);
    }
    /**
    * List total number of actors
    */
    public function listCountActors() {
        $actors = ActorsController::readActors();
        $title = "Total number of actors";
        $totalActorsCount = count($actors);
    
        return view('actors.count', ["actors" => $totalActorsCount, "title" => $title]);
    }
    /**
    * List actors by decade
    */
    public function listActorsByDecade(Request $request){
        $decade = $request->query('decade');
        $actors = ActorsController::readActors();
        $title = "Actors by decade";
        $actorsByDecade = [];
        
        switch($decade){
            case 'option1':
                $actorsByDecade = $actors->whereBetween('birthdate', ['1980-01-01', '1989-12-31']);
                break;
            case 'option2':
                $actorsByDecade = $actors->whereBetween('birthdate', ['1990-01-01', '1999-12-31']);
                break;
            case 'option3':
                $actorsByDecade = $actors->whereBetween('birthdate', ['2000-01-01', '2009-12-31']);
                break;
            case 'option4':
                $actorsByDecade = $actors->whereBetween('birthdate', ['2010-01-01', '2019-12-31']);
                break;
            case 'option5':
                $actorsByDecade = $actors->whereBetween('birthdate', ['2020-01-01', '2029-12-31']);
                break;
            default:
                break;
        }

        return view('actors.list', ["actors" => $actorsByDecade, "title" => $title]);
    }
    
    /**
    * Delete actors
    */
    public function listDeleteActors($id){
        $actors = DB::table('actors');
        
        if (!$actors) {
            return response()->json(['action' => 'delete', 'status' => false]);
        }
        $deleted = $actors->delete($id);
        
        return response()->json(['action' => 'delete', 'status' => $deleted]);
    }
}
