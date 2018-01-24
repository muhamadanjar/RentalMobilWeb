<?php namespace App\AuditTrail\Activity;

use App\AuditTrail\Revision;
use DB;
class EloquentRepository implements RepositoryInterface {
    private $activity;
    
    private $revision;

    function __construct(Activity $activity, Revision $revision){
        $this->activity = $activity;
        $this->revision = $revision;
    }

    public function insert($subject, $predicate, $object = null, $note = null, $parentId = null){
        $data = [
            //'case_id'      => $case->getKey(),
            'subject_id'   => $subject->getKey(),
            'subject_type' => get_class($subject),
            'predicate'    => $predicate,
            'object_id'    => $object->getKey(),
            'object_type'  => get_class($object),
            'note'         => $note,
            'parent_id'    => $parentId,
        ];

        return $this->activity->create($data);
    }

    public function paginate($keyword){
        $query = $this->activity
            ->select('log_activities.*', /*'cases.kasus',*/ 'users.name')
            //->join('cases', 'case_id', '=', 'cases.id')
            ->join('users', 'subject_id', '=', 'users.id')
            ->orderBy('created_at' ,' desc');

        if($keyword){
            $query->where('users.name', 'like', "%$keyword%");
        }

        return $query->paginate();
    }

    public function find($id){
        return $this->activity->findOrFail($id);
    }

    public function UpdateStatistik(){
        $ip      = $_SERVER['REMOTE_ADDR']; // Mendapatkan IP komputer user
        $tanggal = date("Y-m-d"); // Mendapatkan tanggal sekarang
        $waktu   = time(); // 
        $s = DB::table('statistik')->where('ip',$ip)->where('tanggal',$tanggal);
        
        // Kalau belum ada, simpan data user tersebut ke database
        if($s->count() == 0){
            DB::table('statistik')->insert(['ip'=>$ip,'tanggal'=>$tanggal,'hits'=>1,'online'=>$waktu]);
        } else{
            DB::table('statistik')->where('ip',$ip)->where('tanggal',$tanggal)->update(['hits'=>DB::raw('hits+1'),'online'=>$waktu]);
        }
        /*$pengunjung       = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE tanggal='$tanggal' GROUP BY ip"));
        $totalpengunjung  = mysql_result(mysql_query("SELECT COUNT(hits) FROM statistik"), 0); 
        $hits             = mysql_fetch_assoc(mysql_query("SELECT SUM(hits) as hitstoday FROM statistik WHERE tanggal='$tanggal' GROUP BY tanggal")); 
        $totalhits        = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
        $tothitsgbr       = mysql_result(mysql_query("SELECT SUM(hits) FROM statistik"), 0); 
        $bataswaktu       = time() - 300;
        $pengunjungonline = mysql_num_rows(mysql_query("SELECT * FROM statistik WHERE online > '$bataswaktu'"));*/
    }
    public function hits(){
        $tanggal = date("Y-m-d");
        $hits = DB::table('statistik')->select(DB::Raw('SUM(hits) as hitstoday'))->where('tanggal',$tanggal)->groupBy('tanggal')->first(); 
        $hitstoday = ($hits==null) ? 0 : $hits->hitstoday ;
        return $hitstoday;
    }
    public function totalhits(){
        return DB::table('statistik')->sum('hits');
    }
    
    public function pengunjungonline($bataswaktu){
        return DB::table('statistik')->where('online','>',$bataswaktu)->count();
    }

    public function totalpengunjung(){
        return DB::table('statistik')->count('hits');
    }

    function ip_user(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
    # User Agent
    function _userAgent(){
        $u_agent 	= $_SERVER['HTTP_USER_AGENT']; 
        $bname   	= 'Unknown';
        $platform 	= 'Unknown';
        $version 	= "";

        $os_array       =   array(
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile'
                            );

        foreach ($os_array as $regex => $value) { 

            if (preg_match($regex, $u_agent)) {
                $platform    =   $value;
            }

        }
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 
    
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }
        
        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }
        
        // check if we have a number
        if ($version==null || $version=="") {$version="?";}
        
        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern
        );
    }
    function os_user(){
        $OS = $this->_userAgent();
        return $OS['platform'];
    }
    function browser_user(){
        $browser = $this->_userAgent();
        return $browser['name'] . ' v.'.$browser['version'];
    }

    public function statistikPengunjung($statistik='bulan'){
        if($statistik == 'hari'){
            $statistik_query = DB::table('statistik')
            ->select(
                DB::raw('DAY(statistik.tanggal) as hari'),
                DB::raw('MONTH(statistik.tanggal) as bulan'),
                DB::raw('YEAR(statistik.tanggal) as tahun'),
                DB::raw('SUM(statistik.hits) as total_bulan')
            )->orderBy('tahun')->groupBy('hari')->get();
        }else if($statistik == 'tahun'){
                $statistik_query = DB::table('statistik')
                ->select(
                    DB::raw('DAY(statistik.tanggal) as hari'),
                    DB::raw('MONTH(statistik.tanggal) as bulan'),
                    DB::raw('YEAR(statistik.tanggal) as tahun'),
                    DB::raw('SUM(statistik.hits) as total_bulan')
                )->orderBy('tahun')->groupBy('tahun')->get();
        }else{
            $statistik_query = DB::table('statistik')
            ->select(
                DB::raw('MONTH(statistik.tanggal) as bulan'),
                DB::raw('YEAR(statistik.tanggal) as tahun'),
                DB::raw('SUM(statistik.hits) as total_bulan')
            )->orderBy('tahun')->groupBy('bulan')->groupBy('tahun')->get();
        }
        
        return $statistik_query;
    }

    

    

    //public function revisionsByActivity($id)
    //{
    //    return $this->revision->where('activity_id', '=', $id)->get();
    //}
}