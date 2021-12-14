<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'type' => 'home',
                'banner' => 'home/banner.jpg',
                'title' => 'COMPARTE Y DISFRUTA',

            ],
            [
                'type' => 'menus',
                'banner' => 'menu/banner.jpg',
                'title' => 'MENU',
            ],
            [
                'type' => 'about',
                'banner' => 'about/banner.jpg',
                "title" => "Acerca de nosotros",
            ],
            [
                'type' => 'gallery',
                'banner' => 'galleries/banner.jpg',
                "title" => "Galeria de imagenes",

            ],
            [
                'type' => 'locations',
                'banner' => 'locations/banner.jpg',
                "title" => "NUESTRAS UBICACIONES",

            ],
            [
                'type' => 'team',
                'banner' => 'team/banner.jpg',
                "title" => "NUESTRO EQUIPO",

            ],
            [
                'type' => 'faq',
                'banner' => 'faq/banner.jpg',
                "title" => "PREGUNTAS FRECUENTES",

            ],
            [
                'type' => 'terms',
                'banner' => 'terms/banner.jpg',
                "title" => "TERMINOS Y CONDICIONES",

            ],
            [
                'type' => 'gift-card',
                'banner' => 'gift-cards/banner.jpg',
                "title" => "TARJETAS  DE REGALO",

            ],
            [
                'type' => 'contact',
                'banner' => 'contact/banner.jpg',
                "title" => "CONTÁCTENOS",
            ],
        ];
        Page::truncate();
        Page::factory()
            ->count(count($pages))
            ->state(new Sequence(...$pages))
            ->create();
        // foreach ($pages as $key => $page) {
        //     Page::create([
        //         'type' => $page['type'],
        //         'banner' => $page['banner'],
        //         "title" => $page['title'],
        //         'breadcrumb' => $page['breadcrumb'],
        //         'options' => $page['options'],

        //     ]);
        // }
    }
}
