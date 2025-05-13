<?php

namespace Database\Seeders;

use App\Models\PointOfInterest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class PointsOfInterestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i = 0; $i < 15; $i++) {
            $newPOI = new PointOfInterest();

            $newPOI->user_id = 1;
            $newPOI->type_id = rand(1, 25);
            $newPOI->name = $faker->name();
            $newPOI->description = $faker->sentence();
            $newPOI->address = $faker->address();
            $newPOI->latitude = $faker->latitude();
            $newPOI->longitude = $faker->longitude();
            $newPOI->start_date = $faker->date();
            $newPOI->end_date = $faker->date();
            $newPOI->external_link = $faker->url();
            $newPOI->phone_number = $faker->phoneNumber();

            $newPOI->save();
        }
    }
}
