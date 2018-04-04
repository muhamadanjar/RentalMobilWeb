<?php namespace App\Transaksi;


use Illuminate\Support\Facades\Hash;
use App\User;
use App\Transaksi\Sewa;
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
}
