<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PupilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pupils')->insert([
            'firstName'=>'malcolm',
            'lastName'=>'kisakye',
            'emailAddress'=>'malcolmkisakye@gmail.com',
            'dateOfBirth'=>'2012-2-27',
            'password'=>Hash::make('password'),
            'school_registration_number'=>'SC00123',
           ]);
    }
}
