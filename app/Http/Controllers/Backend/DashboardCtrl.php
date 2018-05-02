<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Agenda\Agenda;
//use App\Agenda\RepositoryInterface;
use App\Mobil\RepositoryInterface as MobilInterface;
use App\Moderator\RepositoryInterface as ModeratorInterface;
use App\Post\RepositoryInterface as PostInterface;
use App\Transaksi\RepositoryInterface as TransaksiInterface;
use App\AuditTrail\Activity\RepositoryInterface as ActivityInterface;
use DB;
use App\Mobil\Mobil;
class DashboardCtrl extends BackendCtrl{
    public function __construct(
        ModeratorInterface $mi,
        PostInterface $post,
        TransaksiInterface $transaksi,
        MobilInterface $mobil,
        //RepositoryInterface $agenda,
        ActivityInterface $activity){
        $this->user = $mi;
        $this->post = $post;
        //$this->agenda = $agenda;
        $this->mobil = $mobil;
        $this->activity = $activity;
        $this->transaksi = $transaksi;
    }
    public function getIndex(){
        session(['link_web'=>'dashboard']);
        //$transdata = $this->transmigrasi->getTransPivotData();
        //$transdatadaerah = $this->transmigrasi->getTransPivotDaerahData();

        $listtransaksi = $this->transaksi->getlimit(3);
        $reguler = $this->transaksi->getlimitType(5,'reguler');
        $countpost = $this->post->countByType('post');
        $countuser = $this->user->countUser();
        //$countagenda = $this->agenda->countNewThisWeek();
        $datastatistik = $this->activity->statistikPengunjung();
        $chartstatistik = $this->getChartStatistik();
        $chartpesanan = $this->getChartPesanan();
        $totalmobil = $this->mobil->countmobil();
        return view('backend.dashboard.index')
        //->with('transdata',$transdata)
        //->with('transdatadaerah',$transdatadaerah)
        ->with('countuser',$countuser)
        ->with('countpost',$countpost)
        ->with('countmobil',$totalmobil)
        ->with('datastatistik',$datastatistik)
        ->with('listtransaksi',$listtransaksi)
        ->with('reguler',$reguler)
        ->with('chartstatistik',$chartstatistik)
        ->with('chartpesanan',$chartpesanan);
    }

    

    public function getChartStatistik(){
        $chartbar = $this->activity->statistikPengunjung();
        $arr = array();
        $category = array();
        $total = 0;
        $month = 0;
        $data = [];
        
        foreach ($chartbar as $key => $value) {
            array_push($category,date('M',mktime(date('H'),date('i'),date('s'),$value->bulan,date('j'),$value->tahun)));
            array_push($data, $value->total_bulan);
            $arr['chart'][$key]['name'] = date('M',mktime(0,0,0,$value->bulan,0,$value->tahun));
            $arr['chart'][$key]['data'] = $data;
            $total += $value->total_bulan;
        }
        //$arr['chart'][0]['name'] = 'Statistik';
        //$arr['chart'][0]['data'] = $data;
        $arr['category'] = $category;
        $arr['total'] = $total;
        return json_encode($arr);
    }

    public function getChartPesanan(){
        $chartbar = $this->transaksi->statistikPemesanan();
        $arr = array();
        $category = array();
        $total = 0;
        $month = 0;
        $data = [];
        
        foreach ($chartbar as $key => $value) {
            array_push($category,date('M',mktime(date('H'),date('i'),date('s'),$value->bulan,date('j'),$value->tahun)));
            array_push($data, $value->total_bulan);
            $arr['chart'][$key]['name'] = $value->sewa_type;
            $arr['chart'][$key]['data'] = $data;
            $total += $value->total_bulan;
        }
        //$arr['chart'][0]['name'] = 'Statistik';
        //$arr['chart'][0]['data'] = $data;
        $arr['category'] = $category;
        $arr['total'] = $total;
        return json_encode($arr);
    }
    
}
