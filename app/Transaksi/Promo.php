<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $primaryKey = 'id';
    protected $dates = ['tgl_mulai','tgl_akhir'];


    public function getPermalink(){
        return url('images/uploads/promo').DIRECTORY_SEPARATOR.'/';
    }

    public function getPath(){
        
        return public_path('images/uploads/promo').DIRECTORY_SEPARATOR.'/';
    }
}
