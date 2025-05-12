<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    public function pointsOfInterest() {
        return $this->belongsToMany(PointOfInterest::class);
    }
}
