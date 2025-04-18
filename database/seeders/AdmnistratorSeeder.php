<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdmnistratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('adminstrators')->insert([
        'name'=>'edna takaisa',
        'emailAddress'=>'ednatakaisa@gmail.com',
        'password'=>Hash::make('password'),
       ]);
    }
}
