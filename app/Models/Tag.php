<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function pointsOfInterest() {
        return $this->belongsToMany(PointOfInterest::class, "point_of_interest_tags");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
