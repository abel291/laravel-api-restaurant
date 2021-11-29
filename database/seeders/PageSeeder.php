<?php

namespace Database\Seeders;

use App\Models\Page;
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
                'img' => '/img/home/banner.jpg',
                'alt_img' => ' img home',
                'title' => 'COMPARTE Y DISFRUTA',
                'breadcrumb' => '',
            ],
            [
                'type' => 'menus',
                'img' => '/img/menu/banner.jpg',
                'alt_img' => ' img home',
                'title' => 'MENU',
                'breadcrumb' => '',
            ],
            [
                'type' => 'about',
                'img' => '/img/about/banner.jpg',
                'alt_img' => '/img/about  ',
                "title" => "Acerca de nosotros",
                'breadcrumb' => '',
            ],
            [
                'type' => 'gallery',
                'img' => 'img/galleries/banner.jpg"',
                'alt_img' => 'img/galleries . ',
                "title" => "Galeria de imagenes",
                'breadcrumb' => '',
            ],
            [
                'type' => 'locations',
                'img' => '/img/locations/banner.jpg',
                'alt_img' => '/img/locations  ',
                "title" => "NUESTRAS UBICACIONES",
                'breadcrumb' => '',
            ],
            [
                'type' => 'team',
                'img' => '/img/team/banner.jpg',
                'alt_img' => '/img/team  ',
                "title" => "NUESTRO EQUIPO",
                'breadcrumb' => '',
            ],
            [
                'type' => 'faq',
                'img' => '/img/faq/banner.jpg',
                'alt_img' => '/img/faq  ',
                "title" => "PREGUNTAS FRECUENTES",
                'breadcrumb' => '',
            ],
            [
                'type' => 'terms',
                'img' => '/img/terms/banner.jpg',
                'alt_img' => '/img/terms  ',
                "title" => "TERMINOS Y CONDICIONES",
                'breadcrumb' => '',
            ],
            [
                'type' => 'gift-card',
                'img' => '/img/gift-cards/banner',
                'alt_img' => '/img/gift-cards  ',
                "title" => "TARJETAS  DE REGALO",
                'breadcrumb' => '',
            ],
            [
                'type' => 'contact',
                'img' => '/img/contact/banner.jpg',
                'alt_img' => '/img/contact  ',
                "title" => "CONTÁCTENOS",
                'breadcrumb' => '',
            ],
        ];
        Page::truncate();
        foreach ($pages as $key => $page) {
            Page::create([
                'type' => $page['type'],
                'img' => $page['img'],
                'alt_img' => $page['alt_img'],
                "title" => $page['title'],
                'breadcrumb' => $page['breadcrumb'],
            ]);
        }
    }
}
