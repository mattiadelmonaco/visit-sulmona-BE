<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointOfInterest extends Model
{
     public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function daysOfWeek() {
        return $this->belongsToMany(DayOfWeek::class);
    }

    public function firstImage()
{
    return $this->hasOne(Image::class)->orderBy('id'); // o created_at, se preferisci
}
}
