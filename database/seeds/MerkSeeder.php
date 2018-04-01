<?php

use Illuminate\Database\Seeder;
use App\Mobil\Merk;
class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        $arr = array('Mitsubishi','Toyota','Daihatsu','Suzuki');
        for ($i = 0; $i < count($arr); $i++) {
            Merk::create([
                'merk' => $arr[$i],
            ]);
        }
    }
}
