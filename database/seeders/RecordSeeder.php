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
        \DB::table('record')->insert([
            'city' => 'miami',
            'humedad' => '55',
            'viento' => '7',
            'alta' => '86',
            'baja' => '36',
            'pubDate' => '1610056700',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \DB::table('record')->insert([
            'city' => 'miami',
            'humedad' => '54',
            'viento' => '18',
            'alta' => '23',
            'baja' => '9',
            'pubDate' => '1610056800',
            'created_at' => now(),
            'updated_at' => now()
        ]);



        \DB::table('record')->insert([
            'city' => 'orlando',
            'humedad' => '51',
            'viento' => '10',
            'alta' => '69',
            'baja' => '44',
            'pubDate' => '1610056700',
            'created_at' => now(),
            'updated_at' => now()
        ]);


        \DB::table('record')->insert([
            'city' => 'orlando',
            'humedad' => '54',
            'viento' => '14',
            'alta' => '17',
            'baja' => '13',
            'pubDate' => '1610056800',
            'created_at' => now(),
            'updated_at' => now()
        ]);



        \DB::table('record')->insert([
            'city' => 'newyork',
            'humedad' => '43',
            'viento' => '11',
            'alta' => '10',
            'baja' => '-1',
            'pubDate' => '1610055700',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        \DB::table('record')->insert([
            'city' => 'newyork',
            'humedad' => '46',
            'viento' => '11',
            'alta' => '8',
            'baja' => '-1',
            'pubDate' => '1610056800',
            'created_at' => now(),
            'updated_at' => now()
        ]);

         
    }
}
