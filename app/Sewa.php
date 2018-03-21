<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Sewa extends Model
{
    protected $table = 'sewa';
    protected $fillable = array('status', 'tgl_mulai', 'tgl_akhir', 'type_id', 'origin', 'destination', 'user_id');
    public $timestamps = true;
    
    public function Payment(){
        return $this->hasOne('PaymentDetail','reservation_id');
    }
    
    public function Customer(){
        return $this->belongsTo(User::class,'user_id');
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
