<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
             'name'=>'naysa',
             'email'=>'naysa@gmail.com',
             'role_id'=>1,

        ]);
        User::factory()->count(5)->create();
    }
}
