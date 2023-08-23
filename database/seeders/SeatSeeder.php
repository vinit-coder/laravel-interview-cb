<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; $i++){
            \DB::insert("insert into seats values()");
        }
        
    }
}
