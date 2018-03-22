<?php

use Illuminate\Database\Seeder;
use App\Mobil\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        
        $arr = array('Coupe','Hatcback','Minivan','Sedan','Sports Car','Sport Vehicle','Station Wagon');
        for ($i = 0; $i < count($arr); $i++) {
            Type::create([
                'type' => $arr[$i],
            ]);
        }
        
    }
}
