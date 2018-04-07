<?php

namespace App\Transaksi;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Mobil\Mobil;
use App\Customer;
class Sewa extends Model
{
    protected $table = 'sewa';
    protected $fillable = array('status', 'tgl_mulai', 'tgl_akhir', 'type_id', 'origin', 'destination', 'user_id');
    public $timestamps = true;

    protected $dates = ['tgl_mulai','tgl_akhir'];
    
    public function mobil(){
        return $this->belongsTo(Mobil::class,'mobil_id');
    }
    public function Payment(){
        return $this->hasOne('PaymentDetail','reservation_id');
    }
    
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','user_id');
    }

    public static function Selectbox() {
        $data = array();
        $checkbox = Type::where('status', 1)->get()->toArray();
        if (!empty($checkbox)) {
            foreach ($checkbox as $check) {
                $data[0] = '-- Choose Type --';
                $data[$check['id']] = $check['type'];
            }
        }
        return $data;
    }
}
