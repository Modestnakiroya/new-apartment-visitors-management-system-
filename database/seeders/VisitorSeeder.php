<?php

namespace Database\Seeders;

use App\Models\Visitor;
use App\Models\Approval;
use App\Models\Alert;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    public function run()
    {
        // Create some visitors
        $visitor1 = Visitor::create([
            'name' => 'John Doe',
            //'check_in' => now(),
            //'check_out' => null,
            //'expected_arrival' => now(),
            'phone' => '0776418919',
            'status' => 'confirmed',
            'email' => 'johndodo@gmail.com',
            'id_number' => 'UG02081992-022'
        ]);

        $visitor2 = Visitor::create([
            'name' => 'Krystal Kwagala',
            //'check_in' => now(),
            //'check_out' => null,
            //'expected_arrival' => now(),
            'phone' => '0753410915',
            'status' => 'pending',
            'email' => 'kkrystie@yahoo.com',
            'id_number' => 'UG19022006-011'
        ]);

        $visitor3 = Visitor::create([
            'name' => 'Elishama Dragule',
            //'check_in' => now(),
            //'check_out' => null,
            //'expected_arrival' => now(),
            'phone' => '0791240110',
            'status' => 'pending',
            'email' => 'studentelishaama@mukc.ug',
            'id_number' => 'UG31122000-392'
        ]);

        // Create some approvals
        Approval::create([
            'visitor_id' => $visitor1->id,
            'status' => 'pending',
        ]);

        Approval::create([
            'visitor_id' => $visitor3->id,
            'status' => 'pending',
        ]);

        // Create some alerts
        Alert::create([
            'description' => 'Suspicious activity detected',
            'resolved' => false,
        ]);

        Alert::create([
            'description' => 'Unauthorized entry attempt',
            'resolved' => false,
        ]);
    }
}
