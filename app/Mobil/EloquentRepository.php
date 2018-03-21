<?php namespace App\Mobil;

use DB;
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

    public static function autoNumber($table,$primary,$prefix){
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