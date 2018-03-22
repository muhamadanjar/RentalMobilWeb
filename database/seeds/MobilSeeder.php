<?php

use Illuminate\Database\Seeder;
use App\Mobil\Mobil;
class MobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
 
        // Create 50 product records
        for ($i = 0; $i < 50; $i++) {
            Mobil::create([
                'no_plat' => strtoupper($faker->randomLetter).' '.$faker->randomNumber(4),
                'merk' => $faker->randomElement(array('Daihatsu','Toyota','Mitsubishi')),
                'type' => $faker->randomElement(array('Sedan','Truk','Cumperback')),
                'warna' => $faker->randomElement(array('Hitam','Putih','biru')),
                'harga' => $faker->randomNumber(4),
                'status' => $faker->randomElement(array('tersedia','dipinjam')),
                'user_id' => 2,
            ]);
        }
    }
}
