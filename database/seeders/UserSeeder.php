<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();
        User::factory()->create([
            'email' => 'example@exmaple.com',
            'password' => Hash::make('123123'),
        ]);
        User::factory(20)->create();
    }
}
