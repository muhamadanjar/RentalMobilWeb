<?php

namespace App\Mobil;

use Illuminate\Database\Eloquent\Model;
use App\Mobil\Fasilitas;
class Mobil extends Model
{
    protected $table = 'mobil';

    protected $primaryKey = 'id';
    public $timestamps = false;
    public function author(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function fasilitas(){
        return $this->hasMany('App\Mobil\Fasilitas', 'fasilitas_id');
        //return $this->belongsToMany(Fasilitas::class,'post_tag');
    }
}
