<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
        public function pointsOfInterest()
    {
        return $this->hasMany(PointOfInterest::class);
    }

}
