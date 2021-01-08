<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('record')->insert([
            'city' => 'miami',
            'Humedad' => '55',
            'Viento' => '7',
            'alta' => '86',
            'baja' => '36',
            'pubDate' => '1610056700',
        ]);

        DB::table('record')->insert([
            'city' => 'miami',
            'Humedad' => '54',
            'Viento' => '18',
            'alta' => '23',
            'baja' => '9',
            'pubDate' => '1610056800',
        ]);



        DB::table('record')->insert([
            'city' => 'orlando',
            'Humedad' => '51',
            'Viento' => '10',
            'alta' => '69',
            'baja' => '44',
            'pubDate' => '1610056700',
        ]);
        

        DB::table('record')->insert([
            'city' => 'orlando',
            'Humedad' => '54',
            'Viento' => '14',
            'alta' => '17',
            'baja' => '13',
            'pubDate' => '1610056800',
        ]);



        DB::table('record')->insert([
            'city' => 'newyork',
            'Humedad' => '43',
            'Viento' => '11',
            'alta' => '10',
            'baja' => '-1',
            'pubDate' => '1610055700',
        ]);

        DB::table('record')->insert([
            'city' => 'newyork',
            'Humedad' => '46',
            'Viento' => '11',
            'alta' => '8',
            'baja' => '-1',
            'pubDate' => '1610056800',
        ]);

         
    }
}
