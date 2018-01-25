<?php

namespace App\Mobil;

use Illuminate\Database\Eloquent\Model;
use App\Mobil\Fasilitas;
class Mobil extends Model
{
    protected $table = 'mobil';

    protected $primaryKey = 'id';

    public function author(){
        return $this->belongsTo('App\User', 'author_id');
    }

    public function fasilitas(Type $var = null){
        return $this->hasMany('App\Mobil\Fasilitas', 'fasilitas_id');
        //return $this->belongsToMany(Fasilitas::class,'post_tag');
    }
}
