<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        DB::table('representatives')->insert([
            'username'=>'kwagala blessed',
            'emailAddress'=>'kwagalablessed@gmail.com',
            'school_registration_number'=>'SC00123',
             'password'=>Hash::make('password'),
           ]);
    }
}
