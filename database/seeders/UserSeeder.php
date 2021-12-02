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
        $faker = Faker\Factory::create();
        User::create([
            'name' => 'Gregoria Soriano',
            'email' => 'example@exmaple.com',
            'password' => Hash::make('123123'),
            'phone' => $faker->phoneNumber,
            'country' => str_replace(["'", '"'], '', $faker->country),
            'city' => str_replace(["'", '"'], '', $faker->city),

        ]);
        User::factory(20)->create();
    }
}
