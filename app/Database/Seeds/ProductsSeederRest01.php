<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductsSeederRest01 extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_restaurant' => 1,
                'name' => 'Cig Hamburger',
                'description' => 'O melhor hambúrguer pelo melhor preço.',
                'category' => 'Hambúrgueres',
                'price' => '6.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Hamburger.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Cheese In',
                'description' => 'O sabor do queijo dentro do hambúrguer.',
                'category' => 'Hambúrgueres',
                'price' => '8.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Cheese_In.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Double',
                'description' => 'Duas vezes mais sabor.',
                'category' => 'Hambúrgueres',
                'price' => '12.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Double.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Double Cheese',
                'description' => 'Duas vezes mais queijo e mais sabor.',
                'category' => 'Hambúrgueres',
                'price' => '13.20',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Double_Cheese.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Bacon Strike',
                'description' => 'Um hambúrguer com bacon estaladiço.',
                'category' => 'Hambúrgueres',
                'price' => '11.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Bacon_Strike.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Royale',
                'description' => 'Uma hambúrguer ao estilo casa real.',
                'category' => 'Hambúrgueres',
                'price' => '13.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Royale.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Chicken Planet',
                'description' => 'O sabor irresistível a frango.',
                'category' => 'Hambúrgueres',
                'price' => '8.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Chicken_Planet.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Vegan World',
                'description' => 'Para quem ama vegetais.',
                'category' => 'Hambúrgueres',
                'price' => '10.70',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Vegan_World.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Chicken Barbecue',
                'description' => 'Frango com sabor a churrasco.',
                'category' => 'Hambúrgueres',
                'price' => '8.80',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Chicken_Barbecue.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Fish & Sea',
                'description' => 'O mar dentro do um hambúrguer.',
                'category' => 'Hambúrgueres',
                'price' => '9.70',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Fish_&_Sea.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Fish & Vegs',
                'description' => 'O sabor do mar e dos vegetais.',
                'category' => 'Hambúrgueres',
                'price' => '10.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Fish_&_Vegs.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Master Crusher',
                'description' => 'Para quem não gosta de um simples hambúrguer convencional.',
                'category' => 'Hambúrgueres',
                'price' => '15.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Master_Crusher.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Batatas fritas',
                'description' => 'O melhor acompanhamento para um hambúrguer.',
                'category' => 'Acompanhamentos',
                'price' => '2.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Batatas_fritas.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Café',
                'description' => 'O sabor do bom café.',
                'category' => 'Bebidas',
                'price' => '1.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Café.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Coca',
                'description' => 'Bebida refrescante.',
                'category' => 'Bebidas',
                'price' => '3.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Coca.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Fanta',
                'description' => 'Bebida refrescante com sabor a laranja.',
                'category' => 'Bebidas',
                'price' => '3.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Fanta.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Ice Tea',
                'description' => 'Vai um chá frio?',
                'category' => 'Bebidas',
                'price' => '3.50',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Ice_Tea.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Caramelo Ice',
                'description' => 'Gelado com topping de caramelo.',
                'category' => 'Sobremesas',
                'price' => '3.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Caramelo_Ice.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Chocolate Ice',
                'description' => 'Gelado com topping de chocolate.',
                'category' => 'Sobremesas',
                'price' => '3.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Chocolate_Ice.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Strawberry Ice',
                'description' => 'Gelado com topping de morango.',
                'category' => 'Sobremesas',
                'price' => '3.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Strawberry_Ice.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Ketchup',
                'description' => 'Acompanhamento tradicional.',
                'category' => 'Acompanhamentos',
                'price' => '1.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Ketchup.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Mustarda',
                'description' => 'Acompanhamento tradicional.',
                'category' => 'Acompanhamentos',
                'price' => '1.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Mustarda.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Nuggets',
                'description' => 'Sabor do frango em pequenos pedaços.',
                'category' => 'Acompanhamentos',
                'price' => '4.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Nuggets.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id_restaurant' => 1,
                'name' => 'Cig Nuggets Box',
                'description' => 'Sabor do frango em 10 pequenos pedaços.',
                'category' => 'Acompanhamentos',
                'price' => '8.00',
                'availability' => 1,
                'promotion' => 0,
                'stock' => 1000,
                'stock_min_limit' => 100,
                'image' => 'rest_1_Cig_Nuggets_Box.png',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('products')->insertBatch($data);

        echo PHP_EOL . "Inserted " . count($data) . " products" . PHP_EOL;
    }
}
