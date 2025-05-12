<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
        public function pointsOfInterest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }
}
