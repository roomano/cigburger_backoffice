<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Refreshed extends Seeder
{
    public function run()
    {
        $this->call('UsersSeeder');
        $this->call('RestaurantsSeeder');
        $this->call('ProductsSeederRest01');
        $this->call('StockSeeder');
    }
}
