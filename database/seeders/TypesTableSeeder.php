<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
    "Evento",
    "Monumento",
    "Ristorante",
    "Bar",
    "Associazione",
    "BnB",
    "Hotel",
    "Museo",
    "Parco",
    "Spiaggia",
    "Chiesa",
    "Mercato",
    "Negozio",
    "Teatro",
    "Cinema",
    "Centro commerciale",
    "Enoteca",
    "Agriturismo",
    "Stadio",
    "Galleria d'arte",
    "Biblioteca",
];

    foreach($types as $type) {
        $newType = new Type();

        $newType->user_id = 9;
        $newType->name = $type;

        $newType->save();
    }

    }
}
