<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
//use App\Agenda\Agenda;
//use App\Agenda\RepositoryInterface;
use App\Moderator\RepositoryInterface as ModeratorInterface;
use App\Post\RepositoryInterface as PostInterface;
//use App\Transmigrasi\RepositoryInterface as TransmigrasiInterface;
use App\AuditTrail\Activity\RepositoryInterface as ActivityInterface;
use DB;
class DashboardCtrl extends BackendCtrl{
    public function __construct(
        ModeratorInterface $mi,
        PostInterface $post,
        //TransmigrasiInterface $transmigrasi,
        //RepositoryInterface $agenda,
        ActivityInterface $activity){
        $this->user = $mi;
        $this->post = $post;
        //$this->agenda = $agenda;
        $this->activity = $activity;
        //$this->transmigrasi = $transmigrasi;
    }
    public function getIndex(){
        session(['link_web'=>'dashboard']);
        //$transdata = $this->transmigrasi->getTransPivotData();
        //$transdatadaerah = $this->transmigrasi->getTransPivotDaerahData();
        $countpost = $this->post->countByType('post');
        $countuser = $this->user->countUser();
        //$countagenda = $this->agenda->countNewThisWeek();
        $datastatistik = $this->activity->statistikPengunjung();
        $chartstatistik = $this->getChartStatistik();
        //dd($chartstatistik);
        return view('backend.dashboard.index')
        //->with('transdata',$transdata)
        //->with('transdatadaerah',$transdatadaerah)
        ->with('countuser',$countuser)
        ->with('countpost',$countpost)
        //->with('countagenda',$countagenda)
        ->with('datastatistik',$datastatistik)
        ->with('chartstatistik',$chartstatistik);
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


    
}
