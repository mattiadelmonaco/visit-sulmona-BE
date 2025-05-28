<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path', 'point_of_interest_id']; // fillable permette di spiegare quali campi possono essere gestiti da input esterni

    public function pointOfInterest()
    {
        return $this->belongsTo(PointOfInterest::class);
    }
}

