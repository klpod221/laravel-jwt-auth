<?php

namespace Database\Seeders\Faker;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Faker $faker
     * @return void
     */
    public function run(Faker $faker)
    {
        // Admin
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin name',
            'email' => 'admin@gmail.com',
            'phone' => '0326977221',
            'marital' => 'single',
            'gender' => 'male',
            'birthday' => \Carbon\Carbon::createFromFormat('d/m/Y', '17/12/2001'),
            'type' => \App\Models\User::TYPE_ADMIN,
            'status' => \App\Models\User::STATUS_ACTIVATED,
            'password' => Hash::make('Admin123!@'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Candidate
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Candidate name',
            'email' => 'candidate@gmail.com',
            'phone' => '0326977222',
            'marital' => 'single',
            'gender' => 'male',
            'birthday' => \Carbon\Carbon::createFromFormat('d/m/Y', '17/12/2001'),
            'type' => \App\Models\User::TYPE_CANDIDATE,
            'status' => \App\Models\User::STATUS_ACTIVATED,
            'password' => Hash::make('Candidate123!@'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
