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
        $tgl_mulai = new Carbon($request->tgl_mulai);
        $tgl_akhir = new Carbon($request->tgl_akhir);
        $reservation = new Sewa();
        $reservation->status = $request->status;
        $reservation->no_transaksi = $this->autoNumber('sewa','no_transaksi','RENT');
        $reservation->tgl_mulai = (isset($request->tgl_mulai)) ? $tgl_mulai->toDateTimeString() : null;
        $reservation->tgl_akhir = (isset($request->tgl_akhir)) ? $tgl_akhir->toDateTimeString() : null;
        $reservation->sewa_latitude = (isset($request->sewa_latitude)) ? $request->sewa_latitude : null;
        $reservation->sewa_longitude = (isset($request->sewa_longitude)) ? $request->sewa_longitude : null;
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
        
        DB::table('sewa_detail')->insert(
            [
                'sewa_id' => $reservation->id, 
                'sewa_type' => $request->sewa_type,
                'duration'=>$request->duration,
                'distance'=>$request->distance
            ]
        );
        return $reservation;
        /*return array(
            'id'=>$reservation->id,
            'status'=>$reservation->status,
            'no_transaksi'=>$reservation->no_transaksi,
            'origin'=>$reservation->origin,
            'destination'=>$reservation->destination,
            'total_bayar'=>$reservation->total_bayar,
            'denda'=>$reservation->denda,
            'customer_id'=>$reservation->customer_id,
            'mobil_id'=>$reservation->mobil_id,
            'mobil'=> array(
                'name'=>$mobil->name,
                'driver'=>$mobil->supir->name,
                'merk'=>$mobil->merk,
                'warna'=>$mobil->warna,
                'tahun'=>$mobil->tahun,
                'foto'=>$mobil->foto
            ),
            'customer'=>array(
                'name'=>$customer->name,
                'email'=>$customer->email,
                'no_telp'=>$customer->no_telp,
                'sex'=>$customer->sex
            )
        );*/
    }
    public function getlimit($limit = '5'){
        return $this->sewa->limit($limit)->orderBy('tgl_mulai', 'desc')->get();
    }
    public function getDatatableData(){
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::join('sewa_detail','sewa.id','=','sewa_detail.sewa_id')
            ->leftjoin('mobil','sewa.mobil_id', '=', 'mobil.id')
            ->leftjoin('customers','sewa.customer_id', '=', 'customers.id')
            ->orderBy('sewa.created_at','DESC')
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'sewa.id',
                'sewa.no_transaksi',
                'sewa.mobil_id',
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
                'sewa_detail.sewa_type',
                'sewa.created_at',
                'sewa.updated_at'
            ]
        );
        
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
        if($q->count()>0){
            foreach($q->get() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%04s", $tmp);
            }
        }else{
            $kd = $prx."0001";
        }
 
        return $kd;
    }

    public function getPesananByCustomer($id){
        $sewa = $this->sewa->where('customer_id',$id)->where('status','!=','pending')->first();
        $customer = $sewa->customer;
        $mobil = $sewa->mobil;

        return response([
            'id'=>$sewa->id,
            'status'=>$sewa->status,
            'origin'=>$sewa->origin,
            'destination'=>$sewa->destination,
            'total_bayar'=>$sewa->total_bayar,
            'denda'=>$sewa->denda,
            'customer_id'=>$sewa->customer_id,
            'mobil_id'=>$sewa->mobil_id,
            'mobil'=>$mobil,
            'customer'=>$customer,
        ]);
    }
    public function getPesananByCustomerAll($id){
        $sewa = $this->sewa->where('customer_id',$id)->get();
        
        $data = array();$_data = array();
        foreach($sewa as $k => $v){
            $customer = $v->customer;
            $mobil = $v->mobil;
            $data['id'] = $v->id;
            $data['status']= $v->status;
            $data['origin']= $v->origin;
            $data['destination']= $v->destination;
            $data['total_bayar']= $v->total_bayar;
            $data['denda']= $v->denda;
            $data['customer_id']= $v->customer_id;
            $data['mobil_id']= $v->mobil_id;
            $data['mobil']= $mobil;
            $data['customer']= $customer;
            array_push($_data,$data);
        }
        
        return response($_data);
    }
    public function statistikPemesanan($statistik='bulan'){
        if($statistik == 'hari'){
            $statistik_query = DB::table('sewa')
            ->join('sewa_detail','sewa.id','sewa_detail.sewa_id')
            ->select(
                DB::raw('DAY(sewa.created_at) as hari'),
                DB::raw('MONTH(sewa.created_at) as bulan'),
                DB::raw('YEAR(sewa.created_at) as tahun'),
                DB::raw('COUNT(sewa_type) as total_bulan')
            )->orderBy('tahun')->groupBy('hari')->get();
        }else if($statistik == 'tahun'){
                $statistik_query = DB::table('sewa')
                ->join('sewa_detail','sewa.id','sewa_detail.sewa_id')
                ->select(
                    DB::raw('DAY(sewa.created_at) as hari'),
                    DB::raw('MONTH(sewa.created_at) as bulan'),
                    DB::raw('YEAR(sewa.created_at) as tahun'),
                    DB::raw('COUNT(sewa_type) as total_bulan')
                )->orderBy('tahun')->groupBy('tahun')->get();
        }else{
            $statistik_query = DB::table('sewa')
            ->join('sewa_detail','sewa.id','sewa_detail.sewa_id')
            ->select(
                DB::raw('MONTH(sewa.created_at) as bulan'),
                DB::raw('YEAR(sewa.created_at) as tahun'),
                DB::raw('COUNT(sewa_type) as total_bulan'),
                'sewa_detail.sewa_type'
            )->orderBy('tahun')->groupBy('sewa_type')->groupBy('bulan')->groupBy('tahun')->get();
        }
        
        return $statistik_query;
    }

    public function getDatatableDataRental(){
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::join('sewa_detail','sewa.id','=','sewa_detail.sewa_id')
            ->leftjoin('mobil','sewa.mobil_id', '=', 'mobil.id')
            ->leftjoin('customers','sewa.customer_id', '=', 'customers.id')
            //->whereRaw('sewa.status=?', ['pending'])
            ->whereRaw('sewa_detail.sewa_type=?', ['rental'])
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'sewa.id',
                'sewa.no_transaksi',
                'sewa.mobil_id',
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
                'sewa_detail.sewa_type',
                'sewa.created_at',
                'sewa.updated_at'
            ]
        );
        
        return $sewa;
    }
    public function getDatatableDataTask(){
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::join('sewa_detail','sewa.id','=','sewa_detail.sewa_id')
            ->leftjoin('mobil','sewa.mobil_id', '=', 'mobil.id')
            ->leftjoin('customers','sewa.customer_id', '=', 'customers.id')
            //->whereRaw('sewa.status=?', ['pending'])
            ->whereRaw('sewa_detail.sewa_type=?', ['reguler'])
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'sewa.id',
                'sewa.no_transaksi',
                'sewa.mobil_id',
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
                'sewa_detail.sewa_type',
                'sewa.created_at',
                'sewa.updated_at'
            ]
        );
        
        return $sewa;
    }

    public function getDataRange($dari,$sampai,$type){
        \DB::statement(DB::raw('set @rownum=0'));
            $sewa = Sewa::join('sewa_detail','sewa.id','=','sewa_detail.sewa_id')
            ->leftjoin('mobil','sewa.mobil_id', '=', 'mobil.id')
            ->leftjoin('customers','sewa.customer_id', '=', 'customers.id')
            ->whereRaw('sewa.tgl_mulai BETWEEN ? AND ?' , [$dari,$sampai])
            ->orWhereRaw('sewa.tgl_akhir BETWEEN ? AND ?' , [$dari,$sampai])
            //->whereRaw('sewa.tgl_mulai >= ? or sewa.tgl_akhir <= ?' , [$dari,$sampai])
            //->whereRaw('sewa_detail.sewa_type = ?' , [$type])
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'sewa.id',
                'sewa.mobil_id',
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
                'sewa_detail.sewa_type',
                'sewa.created_at',
                'sewa.updated_at'
            ]
        )->get();

        
        
        return $sewa;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
