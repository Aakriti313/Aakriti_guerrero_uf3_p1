<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Actor;

class FilmActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();

        foreach ($films as $film) {
            $actorsToRelate = $actors->random(rand(1, 3));
            $film->actors()->attach($actorsToRelate);
        }

        //Delete
        Film::whereIn('id', [1, 2])->delete();
        Actor::whereIn('id', [1, 2])->delete();

    }
}
