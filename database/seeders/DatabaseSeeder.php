<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
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
        

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            ShoppingCartSeeder::class,
            PageSeeder::class,
            GallerySeeder::class,
        ]);
        Discount::factory(20)->create();
    }
}
