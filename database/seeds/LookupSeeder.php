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
        );
        
    }
}
