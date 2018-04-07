<?php

use Illuminate\Database\Seeder;
use App\Lookup;
class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $arr = array(
            array('id'=>1,'type'=>'jabatan','name'=>'Operator'),
            array('id'=>2,'type'=>'jabatan','name'=>'Pengemudi'),
            array('id'=>11,'type'=>'type_sewa','name'=>'Rental'),
            array('id'=>12,'type'=>'type_sewa','name'=>'Taxi'),
            array('id'=>21,'type'=>'status_sewa','name'=>'pending'),
            array('id'=>22,'type'=>'status_sewa','name'=>'cancelled'),
            array('id'=>23,'type'=>'status_sewa','name'=>'confirmed'),
            array('id'=>24,'type'=>'status_sewa','name'=>'collected'),
            array('id'=>25,'type'=>'status_sewa','name'=>'completed'),
        );
        foreach($arr as $key =>$val){
            Lookup::create([
                'id' => $val->id,
                'type' => $val->type,
                'name' => $val->name
            ]);
        }
    }
}
