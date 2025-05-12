<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{
     public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
