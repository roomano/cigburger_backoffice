<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Stock extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->where('id_restaurant', session()->user['idRestaurant'])->findAll();


        $data = [
            'title' => '- Stock',
            'page' => 'Stock',
            'products' => $products
        ];

        return view('dashboard/stock/index', $data);
    }
}
