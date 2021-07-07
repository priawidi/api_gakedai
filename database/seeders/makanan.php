<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class makanan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();
        $limit = 20;
        for($i=0;$i<$limit;$i++){
            DB::table('makanan')->insert([
                'nama'=>$faker->name,
                'harga'=>$faker->phonenumber
            ]);
        }
    }
}
