<?php namespace App\Transaksi;


use Illuminate\Support\Facades\Hash;
use App\User;
use App\Customer;
use App\Transaksi\Sewa;
use App\Mobil\Mobil;
use Carbon\Carbon;
use DB;

class EloquentRepository implements RepositoryInterface{

    
    private $user;

    public $sewa;

    function __construct(User $user,Sewa $sewa){
        $this->user = $user;
        $this->sewa = $sewa;
    }
    public function all(){
        return $this->sewa->orderBy('tgl_mulai', 'desc')->get();
    }
    public function find($id){
        return $this->sewa->findOrFail($id);
    }
    public function delete($id){
        return $this->sewa->findOrFail($id)->delete();
    }
    public function post($aksi){
        $sewa = ($aksi == 'edit') ? Sewa::find($id) : new Sewa;
        $sewa->status = $request->status;
        $sewa->tgl_mulai = Carbon::now();
        $sewa->tgl_akhir = Carbon::now();
        $sewa->origin = $request->origin;
        $sewa->destination = $request->destination;
        $sewa->total_bayar = $request->total_bayar;
        $sewa->denda = 0;
        $sewa->customer_id = $request->customer_id;
        $sewa->mobil_id = $request->mobil_id;
        $sewa->save();
        return $sewa;
    }
    public function makeSewa($request){
        $reservation = new Sewa();
        $reservation->status = $request->status;
        //$reservation->no_transaksi = $request->no_transaksi;
        //$reservation->tgl_mulai = Carbon::now();
        //$reservation->tgl_akhir = Carbon::now();
        $reservation->origin = $request->origin;
        $reservation->origin_latitude = (isset($request->origin_latitude)) ? $request->origin_latitude : null;
        $reservation->origin_longitude = (isset($request->origin_longitude)) ? $request->origin_longitude : null;
        $reservation->destination = $request->destination;
        $reservation->destination_latitude = (isset($request->destination_latitude)) ? $request->destination_latitude : null;
        $reservation->destination_longitude = (isset($request->destination_longitude)) ? $request->destination_longitude : null;
        $reservation->total_bayar = $request->total_bayar;
        $reservation->denda = 0;
        $reservation->customer_id = $request->customer_id;
        $reservation->mobil_id = $request->mobil_id;
        $reservation->save();
        $mobil = Mobil::find($reservation->mobil_id);
        $customer = Customer::where('user_id',$reservation->customer_id)->first();
        return response([
            'id'=>$reservation->id,
            'status'=>$reservation->status,
            'origin'=>$reservation->origin,
            'destination'=>$reservation->destination,
            'total_bayar'=>$reservation->total_bayar,
            'denda'=>$reservation->denda,
            'customer_id'=>$reservation->customer_id,
            'mobil_id'=>$reservation->mobil_id,
            'mobil'=>$mobil,
            'customer'=>$customer,
        ]);
    }
    public function getlimit($limit = '5'){
        return $this->sewa->limit($limit)->orderBy('tgl_mulai', 'desc')->get();
    }
    public function getDatatableData(){
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::join('mobil','sewa.mobil_id', '=', 'mobil.id')
            ->select([DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'sewa.origin',
            'sewa.destination',
            \DB::raw("CONCAT('Rp.',FORMAT(sewa.total_bayar,2)) as total_bayar"),
            'sewa.status',
            \DB::raw("CONCAT('Rp.',FORMAT(sewa.denda,2)) as denda"),
            'sewa.tgl_mulai',
            'sewa.tgl_akhir',
            'mobil.no_plat',
            'mobil.merk',
            'mobil.warna',
            'mobil.tahun',
            'sewa.created_at',
            'sewa.updated_at']);
        
        return $sewa;
    }
    function countTransaksi(){
        return $this->sewa->count();
    }
    function checkstatus($id){
        $sewa = $this->sewa->where('mobil_id',$id)->first();
        return $sewa->status;
    }
    function setStatusPesanan($id,$status){
        $this->sewa->where('id',$id)->update(['status' => $status]);
        return $status;
    }
    public function autoNumber($table,$primary,$prefix){
        $q=DB::table($table)->select(DB::raw('MAX(RIGHT('.$primary.',3)) as kd_max'));
        $prx=$prefix;
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%04s", $tmp);
            }
        }
        else
        {
            $kd = $prx."0001";
        }
 
        return $kd;
    }
}
