<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'point_of_interest_id'];

    public function pointOfInterest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }
}

