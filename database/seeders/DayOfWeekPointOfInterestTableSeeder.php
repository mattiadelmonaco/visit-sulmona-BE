<?php

namespace Database\Seeders;

use App\Models\DayOfWeekPointOfInterest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class DayOfWeekPointOfInterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i <10; $i++) {
            $newDoWPoI = new DayOfWeekPointOfInterest();
    
            $newDoWPoI->day_of_week_id = rand(1, 7);
            $newDoWPoI->point_of_interest_id = rand(1, 15);
            $newDoWPoI->first_opening = $faker->time();
            $newDoWPoI->second_opening = $faker->time();
            $newDoWPoI->first_closing = $faker->time();
            $newDoWPoI->second_closing = $faker->time();
    
            $newDoWPoI->save();

        }

    }
}
