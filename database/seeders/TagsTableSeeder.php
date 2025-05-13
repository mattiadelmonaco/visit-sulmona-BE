<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $tags = [
    "Cultura",
    "Gastronomia",
    "Famiglie",
    "Accessibile",
    "Pet-friendly",
    "Romantico",
    "Economico",
    "Eventi speciali",
    "Vista panoramica",
    "Esperienza locale",
    "Ingresso gratuito", 
    "Ingresso a pagamento",
    "Evento religioso",
    "Evento culturale",
    "Aperto 24 ore su 24"
    ];

    foreach($tags as $tag) {
        $newTag = new Tag();

        $newTag->name = $tag;
        $newTag->color = $faker->hexColor();

        $newTag->save();
    }

    }
}
