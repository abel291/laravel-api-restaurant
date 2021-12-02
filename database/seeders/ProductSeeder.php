<?php

namespace Database\Seeders;


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
        DB::table('images')->truncate();
        DB::table('products')->truncate();
        $categories = DB::table('categories')->get();
        $faker = Faker\Factory::create();
        foreach ($categories as $category) {
            for ($i = 1; $i < 9; $i++) {

                
                $name = $faker->sentence(2);
                $price_default = rand(10, 200);
                $price = 0;
                $offer = $faker->randomElement([null, 10, 20, 30, 40, 50]);

                if ($offer) {
                    $price = $price_default - ($price_default * ($offer / 100));
                } else {
                    $price = $price_default;
                }

                $product = Product::create([
                    "name" => $name,
                    "portion_size" => rand(200, 250) . "g",
                    "calories" => rand(300, 750) . "Kj",
                    "allergies" => $faker->words(3, true),
                    "slug" => Str::slug($name),
                    "type" => 'menu',
                    "description_min" => $faker->paragraph(1),
                    "img" => "/img/$category->name/img-" . $i . ".jpg",
                    "banner" => "/img/$category->name/banner-1.jpg",
                    "stars" => rand(3, 5),
                    "price_default" => $price_default,
                    "offer" => $offer,
                    "price" => $price,
                    'category_id' => $category->id,
                    'max_quantity' => rand(10, 30),
                    'stock' => rand(1, 100),
                ]);

                $images = [];
                for ($t = 1; $t < 4; $t++) {
                    
                    $images[$t] = [
                        "alt" => $faker->sentence(3),
                        "title" => $faker->sentence(3),
                        "img" => "/img/" . $category->slug . "/img-$t.jpg",

                    ];
                }
                $product->images()->createMany($images);
            }
        }



        $gift_cards = [50, 85, 125];
        foreach ($gift_cards as $key => $amount) {
            $name = $faker->words(2, true);
            Product::create([
                "name" => $name,
                "portion_size" => null,
                "calories" => null,
                "allergies" => null,
                "slug" => Str::slug($name),
                "description_min" => $faker->paragraph(1),
                "img" => "/img/gift-cards/card-$amount.png",
                "banner" => "/img/gift-cards/banner-1.jpg",
                "stars" => rand(3, 5),
                "price_default" => null,
                "offer" => null,
                "price" => $amount,
                'max_quantity' => rand(10, 30),
                "type" => 'card',
                'category_id' => null,
                'stock' => rand(1, 100),


            ]);
        }
    }
}
