<?php

namespace App\Mobil;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';

    public function car() {
        return $this->belongsToMany(Car::class, 'car_type')->withTimestamps();
    }

}
