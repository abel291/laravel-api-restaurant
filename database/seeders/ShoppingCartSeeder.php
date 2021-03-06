<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shopping_cart')->truncate();
        $products = Product::get()->random(10);
        $user = User::first();

        foreach ($products as $key => $product) {
            $quantity = rand(1, $product->stock);
            $total_price_quantity = $product->price * $quantity;

            $user->shopping_cart()->attach($product->id, [
                'quantity' => $quantity,
                'total_price_quantity' => $total_price_quantity
            ]);
        }
    }
}
