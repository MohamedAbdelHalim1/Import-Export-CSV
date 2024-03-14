<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 10 users
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'fullname' => $this->generateName(),
                'email' => $this->generateEmail(),
                'phone_number' => $this->generatePhoneNumber(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateName()
    {
        return Str::random(8) . ' ' . Str::random(8);
    }

    private function generateEmail()
    {
        return Str::random(10) . '@example.com';
    }

    private function generatePhoneNumber()
    {
        $prefixes = ['010', '011', '012', '015']; 
        $prefix = $prefixes[array_rand($prefixes)]; 
        $suffix = mt_rand(10000000, 99999999); 
    
        return $prefix . '' . $suffix;
    }
}