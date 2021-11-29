<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (Category::get() as $key => $category) {

            $gallery=Gallery::create([
                "name" => $category->name,
                "slug" => Str::slug($category->name),
                "active" => 1,
            ]);

            $images = [];
            for ($t = 1; $t < 9; $t++) {
                echo "---image - $t  \n";
                $images[$t] = [
                    "alt" => $faker->sentence(3),
                    "title" => $faker->sentence(3),
                    "img" => "/img/" . $category->slug . "/img-$t.jpg",

                ];
            }
            $gallery->images()->createMany($images);
        }
    }
}
