<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        // Example 1
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'id_type' => 'IC',
            'id_no' => '123456-78-9012',
            'gender' => 'male',
            'dob' => '1990-05-15',
            'address' => '123 Main Street, Kuala Lumpur',
        ]);

        Patient::create([
            'user_id' => $user1->id,
            'medium_acquisition' => 'Walk-in',
        ]);

        // Example 2
        $user2 = User::create([
            'name' => 'Sarah Lee',
            'email' => 'sarah.lee@example.com',
            'id_type' => 'Passport',
            'id_no' => 'A12345678',
            'gender' => 'female',
            'dob' => '1985-08-20',
            'address' => '456 Park Avenue, Penang',
        ]);

        Patient::create([
            'user_id' => $user2->id,
            'medium_acquisition' => 'Referral',
        ]);

        // Example 3
        $user3 = User::create([
            'name' => 'Ahmad bin Abdullah',
            'email' => 'ahmad.abdullah@example.com',
            'id_type' => 'IC',
            'id_no' => '987654-32-1098',
            'gender' => 'male',
            'dob' => '1975-12-03',
            'address' => '789 Jalan Merdeka, Johor Bahru',
        ]);

        Patient::create([
            'user_id' => $user3->id,
            'medium_acquisition' => 'Online Registration',
        ]);

        // Example 4
        $user4 = User::create([
            'name' => 'Mei Ling',
            'email' => 'mei.ling@example.com',
            'id_type' => 'IC',
            'id_no' => '456789-01-2345',
            'gender' => 'female',
            'dob' => '1995-03-25',
            'address' => '321 Taman Seri, Melaka',
        ]);

        Patient::create([
            'user_id' => $user4->id,
            'medium_acquisition' => 'Emergency',
        ]);
    }
}
