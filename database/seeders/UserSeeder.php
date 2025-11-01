<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     "name"=>"fake_name_3",
        //     "email"=>"fake_3@gmail.com",
        //     "password"=>bcrypt("password"),
        //     "company_id"=>'2',
          
        // ]);

        User::factory()->create();
    }
}
