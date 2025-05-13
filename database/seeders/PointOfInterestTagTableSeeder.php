<?php

namespace Database\Seeders;

use App\Models\PointOfInterestTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointOfInterestTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 15; $i++) {
            $newPOITag = new PointOfInterestTag();

            $newPOITag->point_of_interest_id = rand(1, 15);
            $newPOITag->tag_id = rand(1, 15);

            $newPOITag->save();
        }
    }
}
