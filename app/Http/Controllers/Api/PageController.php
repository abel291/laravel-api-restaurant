<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

use App\Http\Resources\ProductRelatedResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $menus = Category::inRandomOrder()->take(2)->with('products')->get();
        $products_featured  = Product::inRandomOrder()->take(8)->where('type', 'menu')->get();

        $promos = [
            [
                "title" => "GET YOUR FREE",
                "sub_title" => "CHEESE FRIES",
                "img" => "/img/card-banner-2.jpg",
                "path" => "/"
            ],
            [
                "title" => "CRISPY CHICKEN",
                "sub_title" => "BURGER IS BACK!",
                "img" => "/img/card-banner-1.jpg",
                "path" => "/"
            ]
        ];

        return [
            "menus" => CategoryResource::collection($menus),
            //"banner" => $banner,
            "promos" => $promos,
            "products_featured" => ProductResource::collection($products_featured),
        ];
    }

    public function menu()
    {
        $menu = Category::with('products')->get();

        return [
            "menu" => $menu,
            //"banner" => $banner,

        ];
    }

    public function gallery()
    {
        $galleries = Gallery::with('images')->get();
        return [
            "galleries" => $galleries,
            //"banner" => $banner,
        ];
    }

    public function gift_cards()
    {
        $cards = Product::where('type', 'card')->get();
        return [
            "cards" => $cards,
            //"banner" => $banner,

        ];
    }

    public function product($product_slug)
    {
        $product = Product::where('slug', $product_slug)->with('images')->firstOrFail();

        $related_products = Product::where('category_id', $product->category_id)->get();

        return [
            "product" => new ProductResource($product),
            "related_products" => ProductResource::collection($related_products)
        ];
    }
}
