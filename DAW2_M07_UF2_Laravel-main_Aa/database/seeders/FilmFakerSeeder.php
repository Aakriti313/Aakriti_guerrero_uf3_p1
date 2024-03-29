<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Film;
use App\Models\Screenwriter;

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $films = Film::all();
        $screenwriters = Screenwriter::all();

        foreach (range(1, 10) as $index) {
            DB::table('films')->insert([
                'name' => $faker->sentence,
                'year' => $faker->year,
                'genre' => $faker->word,
                'country' => $faker->country,
                'duration' => $faker->numberBetween(60, 180),
                'img_url' => $faker->imageUrl(),
                'screenwriters_id' => $faker->numberBetween(1,10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
