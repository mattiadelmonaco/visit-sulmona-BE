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
        return $this->belongsToMany(Tag::class, 'point_of_interest_tags');
    }

    public function daysOfWeek() {
        return $this->belongsToMany(DayOfWeek::class, 'day_of_week_point_of_interests')
        ->withPivot('first_opening', 'second_opening', 'first_closing', 'second_closing'); // withPivot prende le colonne inserite nella tabella pivot
    }

    public function firstImage()
{
    return $this->hasOne(Image::class)->orderBy('id');
}
}
