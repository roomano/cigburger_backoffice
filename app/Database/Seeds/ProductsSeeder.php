<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products  = [
            [
                'id_restaurant' => 1,
                'name' => 'Cig Hamburger',
                'description' => 'O melhor hambúrguer pelo melhor preço',
                'category' => 'Hambugueres',
                'price' => 6.50,
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_burger_01.png',

            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Cheese In',
                'description' => 'O sabor do queijo dentro do hambúrguer.',
                'category' => 'Hambugueres',
                'price' => 8.00,
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_burger_02.png',

            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Double',
                'description' => 'Duas vezes mais sabor.',
                'category' => 'Hambugueres',
                'price' => 12.50,
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_burger_03.png',

            ],
            [
                'id_restaurant' => 1,
                'name' => 'Fantasia de Laranja',
                'description' => 'O sumo da laranja natural.',
                'category' => 'Bebidas',
                'price' => 2.50,
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_drink_01.png',

            ],
            [
                'id_restaurant' => 1,
                'name' => 'Gelado de Morango',
                'description' => 'Para os dias mais quentes.',
                'category' => 'Sobremesas',
                'price' => 3.75,
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_ice_cream_01.png',

            ],
        ];

        $this->db->table('products')->insertBatch($products);
    }
}
