<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Product::truncate();
        $categories = Category::get();
        $faker = Faker\Factory::create();
        foreach ($categories->where('type', 'menu') as $category) {
            for ($i = 1; $i < 8; $i++) {
                //solo hay 8 imagenes por caategoria  asi que solo se crearan 8 productos por categoria
                Product::factory()
                    ->has(Image::factory()->count(3))
                    ->create([
                        "img" => "products/img-" . $i . ".jpg",
                        "banner" => "products/banner-1.jpg",
                        "category_id" => $category->id,
                    ]);
            }
        }
        $category_gift_card = $categories->where('type', 'gift_card')->first();
        $gift_card = [50, 85, 125];
        foreach ($gift_card as $amount) {
            $name = 'Gift Card ' . $amount;
            Product::factory()->create([
                "name" => $name,
                "slug" => Str::slug($name),
                "img" => "gift-cards/card-$amount.png",
                "banner" => "gift-cards/banner-1.jpg",
                "price" => $amount,
                'category_id' => $category_gift_card->id,
                "portion_size" => null,
                "calories" => null,
                "allergies" => null,
            ]);
        }
    }
}
