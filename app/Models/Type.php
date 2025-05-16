<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
        public function pointsOfInterest()
    {
        return $this->hasMany(PointOfInterest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
