<?php

namespace Database\Seeders;

use App\Models\DayOfWeek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysOfWeekTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"];

        foreach($days as $day) {
            $newDay = new DayOfWeek();

            $newDay->name = $day;

            $newDay->save();
        }
    }
}
