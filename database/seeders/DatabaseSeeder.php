<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([DaysOfWeekTableSeeder::class, TagsTableSeeder::class, TypesTableSeeder::class, PointsOfInterestTableSeeder::class, ImagesTableSeeder::class,
    PointOfInterestTagTableSeeder::class, DayOfWeekPointOfInterestTableSeeder::class]);

    }
}
