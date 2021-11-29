<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $categories = ['Hamburguesas', 'Ensaladas', 'Pizza', 'Bebidas'];

        foreach ($categories as $key => $category) {

            echo "category  " . $category . "  \n";
            Category::create(
                [
                    'name' => $category,
                    'slug' =>  Str::slug($category),
                    'img' => "/img/" . Str::slug($category) . "/banner-1.jpg",
                ]
            );
        }
    }
}
