<?php

namespace Database\Seeders;

use App\Models\DiscountCode;
use App\Models\Image;
use App\Models\Promo;
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
        Image::truncate();
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ShoppingCartSeeder::class,
            PageSeeder::class,
            GallerySeeder::class,
            PromoSeeder::class,
        ]);
        DiscountCode::factory(4)->create();

        
    }
}
