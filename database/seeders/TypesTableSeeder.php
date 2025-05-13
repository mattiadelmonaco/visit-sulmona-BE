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
    "BnB",
    "Hotel",
    "Museo",
    "Parco",
    "Spiaggia",
    "Chiesa",
    "Castello",
    "Mercato",
    "Negozio",
    "Teatro",
    "Cinema",
    "Centro commerciale",
    "Osservatorio",
    "Area archeologica",
    "Enoteca",
    "Agriturismo",
    "Centro benessere",
    "Stadio",
    "Punto panoramico",
    "Centro congressi",
    "Galleria d'arte",
    "Biblioteca",
];

    foreach($types as $type) {
        $newType = new Type();

        $newType->name = $type;

        $newType->save();
    }

    }
}
