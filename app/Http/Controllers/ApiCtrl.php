<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mobil\Mobil;
use App\Transaksi\Sewa;
use App\Transaksi\Promo;
use App\User;
use App\Customer;
use Carbon\Carbon;
use Datatables;
use DB; 
use Mail;
use App\Mobil\RepositoryInterface as MobilInterface;
use App\Transaksi\RepositoryInterface as TransaksiInterface;

class ApiCtrl extends Controller{
    public function __construct(MobilInterface $mobil,TransaksiInterface $transaksi){
        $this->mobil = $mobil;
        $this->transaksi = $transaksi;
    }
    public function getAllMobil(){
        $mobil = $this->mobil->mobilavailable();
        return $mobil;
    }
    public function getDriverInfo($id){
        $driver = $this->mobil->getDriverInfo($id);
        return $driver;
    }
    public function updateStatusMobil($id){
        $mobil = $this->mobil->updatestatusmobil($id);
        return response()->json(['status'=>$mobil]);
    }
    public function getTotalMobil(){
        $mobil = $this->mobil->countmobil();
        return response($mobil,200);
    }
    public function checkstatusmobil($id){
        $mobil = $this->mobil->checkstatus($id);
        return response($mobil,200);
    }


    public function getReservation(Request $request) {
        $sewa = $this->transaksi->getDatatableData();
        return Datatables::of($sewa)
        ->addColumn('action', function ($user) {
            return '<a href="'.route('backend.transaksi.edit',[$user->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
        })
        ->editColumn('tgl_mulai', function ($user) {
            return $user->tgl_mulai;
        })
        ->editColumn('created_at', '{!! $created_at !!}')
        ->editColumn('updated_at', function ($user) {
            return $user->updated_at->format('Y/m/d');
        })
        ->addColumn('details_url', function($user) {
            return url('api/mobil/'.$user->mobil_id.'/driverinfo/');
        })
        ->editColumn('status', '{{$status}}')
        ->filter(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('sewa.status', 'like', "%{$request->get('status')}%");
            }
            if ($request->has('tgl_mulai')) {
                $query->whereRaw("DATE_FORMAT(sewa.tgl_mulai,'%H:%i:%s') like ?", ["%{$request->get('tgl_mulai')}%"]);
            }

            if ($request->has('sq')) {
                $query->whereRaw("DATE_FORMAT(sewa.tgl_mulai,'%H:%i:%s') like ?", ["%{$request->get('sq')}%"])
                    ->orWhere('sewa.origin', 'like', "%{$request->get('sq')}%")
                    ->orWhere('sewa.destination', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.no_plat', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.warna', 'like', "%{$request->get('sq')}%")
                    ->orWhere('mobil.merk', 'like', "%{$request->get('sq')}%");
            }
            
        })
        ->make(true);
    }
    public function getReservationDetailsData($id){
        $posts = $this->transaksi->find($id)->customer;
        return Datatables::of($posts)->make(true);
    }
    public function getTask(Request $request) {
        $task = $this->transaksi->getDatatableDataTask();
        return Datatables::of($task)
        ->addColumn('action', function ($user) {
            return '<a href="'.route('backend.transaksi.taskform',[$user->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-send"></i> Aksi</a>';
        })
        ->filter(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('sewa.status', 'like', "%{$request->get('status')}%");
            }
        })
        ->make(true);
    }
    public function getReservationNotComplete($id){
        $pesanan = $this->transaksi->getPesananByCustomer($id);
        return $pesanan;
    }
    public function getReservationByCustomer($id){
        $pesanan = $this->transaksi->getPesananByCustomerAll($id);
        return $pesanan;
    }
    public function makeSewaRental(Request $request){
        $reservation = $this->transaksi->makeSewa($request);
        $mobil = $reservation->mobil;
        $customer = $reservation->customer;
        $data = array();
        $email = $customer->email;
        $name = $customer->name;
        $subject = 'Invoice';
        $data['no_transaksi'] = $reservation->no_transaksi;
        $data['origin'] = $reservation->origin;
        $data['destination'] = $reservation->destination;
        $data['name'] = $name;
        $data['email'] = $email;
        $data['customer'] = $name;
        $data['driver'] = $mobil->supir->name;
        $data['jeniskendaraan'] = $mobil->name;
        $data['tarif'] = $reservation->total_bayar;
        $data['total'] = $reservation->total_bayar;
        Mail::send('email.invocespesan',['data'=>$data],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "Trans Utama");
                $mail->to($email, $name);
                $mail->subject($subject);
        });

        return $reservation;
    }
    public function makeSewaReguler(Request $request){
        try{
            $customers = new Customer() ;
            $customers->sex = $request->sex;
            $customers->name = $request->name;
            $customers->email = $request->email;
            $customers->no_telp = $request->email;
            $customers->religion = $request->religion;
            $customers->address = $request->address;
            $customers->save();
            
            $data = array();
            $request->customer_id = $customers->id;
            $reservation = $this->transaksi->makeSewa($request);
            $email = $customers->email;
            $name = $customers->name;
            $subject = 'Info Pesanan';
            $data['name'] = $name;
            $data['no_transaksi'] = $reservation->no_transaksi;
        }catch(Exception $e){
            return response()->json(['success'=> false, 'error'=> $e]);
        }
        Mail::send('email.info',['data'=>$data],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_USERNAME'), "Trans Utama");
                $mail->to($email, $name);
                $mail->subject($subject);
        });
        return response()->json([
            'success'=> true,
            'message'=> 'Thanks for Ordering! Please wait until your receive email..',
            'data'=> ['customers'=>$customers,'reservation'=>$reservation]
        ]);
        
    }
    public function getDataPemesananBulanan(){
        $pemesananbulan_query = DB::table('sewa')
            ->select(
                DB::raw('MONTH(sewa.tgl_mulai) as bulan'),
                DB::raw('YEAR(sewa.tgl_mulai) as tahun'),
                DB::raw('COUNT(sewa.tgl_mulai) as total_bulan')
            )->groupBy('bulan')
            ->groupBy('tahun')
            ->orderBy('tahun')->get();

        return $pemesananbulan_query;
    }

    public function checkstatuspesanan($id){
        $sewa = $this->transaksi->checkstatus($id);
        return response()->json($sewa);
    }

    public function cancelledPesanan($id){
        return $this->transaksi->setStatusPesanan($id,'cancelled');
    }

    public function createCustomer(Request $request){
        $customers = new Customer() ;
        
        $customers->sex = $request->sex;
        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->no_telp = $request->email;
        $customers->religion = $request->religion;
        $customers->address = $request->address;
        $customers->save();
        return $customers;
    }

    public function createCustomerAndBookCar(Request $request){
        
    }

    public function getMobil(Request $request){
        $mobil = $this->mobil->getDatatableData();
        return Datatables::of($mobil)
        ->addColumn('details_url', function($m) {
            return url('api/mobil/detail-data/datatable/' . $m->user_id);
        })
        ->filter(function ($query) use ($request) {
            if ($request->has('status')) {
                $query->where('mobil.status', 'like', "%{$request->get('status')}%");
            }
        })
        ->make(true);        
    }

    public function getMobilDriver($id){
        $mobil = User::join('officers','users.id','=','officers.user_id')
        ->where('users.id',$id)
        ->select(['officers.id','officers.name','officers.deposit']);
        return Datatables::of($mobil)->make(true);
    }
    
    public function getPromo(Request $request){
        $promo = Promo::orderBy('tgl_mulai','DESC')->select();
        return Datatables::of($promo)
        ->addColumn('action', function ($p) {
            return '<div class="btn-group"><a href="'.route('backend.promo.edit',[$p->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a><a href="'.route('backend.promo.delete',[$p->id]).'" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a></div>';
        })
        ->filter(function ($query) use ($request) {
            if ($request->has('kode_promo')) {
                $query->where('promo.kode_promo', 'like', "%{$request->get('q')}%");
            }
        })
        ->make(true); 
    }

}
