<?php namespace App\Mobil;

use DB;
use Datatables;
use App\Officer\Officer;
use App\User;
use App\Location;
use Carbon\Carbon;
class EloquentRepository implements RepositoryInterface {

    /**
     * @type officer
     */
    private $mobil;

    function __construct(Mobil $mobil)
    {

        $this->mobil = $mobil;
    }

    public function all()
    {
        return $this->mobil->orderBy('name', 'asc')->get();
    }

    public function find($id)
    {
        return $this->mobil->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->mobil->findOrFail($id)->delete();
    }

    public function countmobil(){
        return $this->mobil->count();
    }

    public function updatestatusmobil($id){
        $mobil = $this->find($id);
        $status = ($mobil->status =='tersedia') ? 'dipinjam' : 'tersedia' ;
        //$this->mobil->where('id',$id)->update(['status' => $status]);
        $mobil->status = $status;
        $mobil->save();
        return $status;
    }
    public function updatestatus($id,$status){
        $mobil = $this->find($id);
        $mobil->status = $status;
        $mobil->save();
        return $mobil;
    }
    public function updatebystatus($id,$status){
        $mobil = $this->find($id);
        $status = $mobil->status = $status ;
        $this->mobil->where('id',$id)->update(['status' => $status]);
        
        return $status;
    }

    public function mobilavailable(){
        $mobil = $this->mobil->where('status','tersedia')->orderBy('name', 'asc')->get();
        $new = new Mobil();
        foreach($mobil as $key =>$v){
            $v->foto = $new->getPermalink().$v->foto;
        }
        return $mobil;
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

    public function checkstatus($id){
        $mobil = $this->find($id);
        return $mobil->status;
    }

    public function getDriverInfo($id){
        $mobil = $this->find($id);
        $officer = Officer::where('user_id',$mobil->user_id)->first();
        return response([
            'id'=>$mobil->id,
            'name'=>$mobil->author->name,
            'mobil'=>$mobil,
            'officers'=>$officer
        ]);
    }

    public function getDriverLocation($id){
        $location = Location::join('users','user_location.user_id','=','users.id')
        ->where('user_id',$id)
        ->select('users.*','user_location.latitude','user_location.longitude','user_location.latest_update')
        ->first();
        return $location;
    }

    public function getAllDriverLocation(){
        $location = Location::join('users','user_location.user_id','=','users.id')
        ->select('users.*','user_location.latitude','user_location.longitude','user_location.latest_update')
        ->get();
        return $location;
    }

    public function setDriverLocation($request){
        $id = $request->user_id;
        $user = User::find($id);
        
        $location = Location::where('user_id','=',$user->id)->first();
        if($location){
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->latest_update = Carbon::now();
            $location->save();
        }else{
            $location = new Location();
            $location->user_id = $request->user_id;
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->latest_update = Carbon::now();
            $location->save();
        }

        return $location;
    }

    public function getDatatableData(){
        \DB::statement(DB::raw('set @rownum=0'));
            $mobil = Mobil::orderBy('id','ASC')
            ->select(
            [
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'mobil.id',
                'mobil.name',
                'mobil.no_plat',
                'mobil.merk',
                'mobil.type',
                'mobil.warna',
                'mobil.harga',
                'mobil.harga_perjam',
                'mobil.user_id',
                'mobil.created_at',
                'mobil.updated_at'
            ]
        );
        
        return $mobil;
    }
}