<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model{
    protected $primaryKey = 'id';
    protected $table = 'user_location';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
