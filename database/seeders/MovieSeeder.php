<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 51; $i++) { 
            DB::table('movies')->insert([
                [
                    'title' => fake()->name(10),
                    'poster' => fake()->imageUrl(),
                    'intro' => fake()->text(),
                    'release_date' => fake()->dateTime(),
                    'genre_id' => rand(1,3),
                ],
            ]);
        }

    }
}
