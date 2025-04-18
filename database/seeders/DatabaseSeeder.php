<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdmnistratorSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(RepresentativeSeeder::class);
        $this->call(PupilSeeder::class);
    }
}
