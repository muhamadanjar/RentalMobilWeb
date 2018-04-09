<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promo';
    protected $primaryKey = 'id';
    protected $dates = ['tgl_mulai','tgl_akhir'];
}
