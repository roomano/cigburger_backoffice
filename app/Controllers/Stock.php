<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\StockModel;
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

    public function productStock(string $encryptedId)
    {
        return view('dashboard/stock/productStock', $data);
    }

    public function addProductStock(string $encryptedId)
    {
        $id = decrypt($encryptedId);

        if (!$id) {
            return redirect()->to('/stock');
        }
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/stock');
        }

        $stockModel = new StockModel();
        $idRestaurant = session()->user['idRestaurant'];

        $listSuppliers = $stockModel->getStockSuppliers($idRestaurant);
        // printData($listSuppliers);

        $data = [
            'title' => '- Stock de produtos',
            'page' => 'Entrada de stock para ' . $product->name,
            'product' => $product,
            'listSuppliers' => $listSuppliers,
            'success' => session()->getFlashdata('success'),
            'validationErrors' => session()->getFlashdata('validationErrors'),
            'serverError' => session()->getFlashdata('serverError')
        ];

        return view('dashboard/stock/addProductStock', $data);
    }


    public function addProductStockSubmit()
    {

        $validation = $this->validate($this->_addProductStockValidaton());

        if (!$validation) {
            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
        }

        $idProduct = decrypt($this->request->getPost('idProduct'));
        if (empty($idProduct)) {
            return redirect()->back()->withInput()->with('serverError', 'Ocorreu um erro, tente novamente!');
        }

        $textStock = $this->request->getPost('textStock');
        $textDate = $this->request->getPost('textDate');
        $textSupplier = $this->request->getPost('textSupplier');
        $textReason = $this->request->getPost('textReason');
        $productName = $this->request->getPost('productName');

        $data = [
            'id_product' => $idProduct,
            'stock_quantity' => intval($textStock),
            'stock_in_out' => 'IN',
            'movement_date' => $textDate,
            'stock_supplier' => $textSupplier,
            'reason' => $textReason,
        ];

        $stockModel = new StockModel();
        $stockModel->insert($data);

        $productModel = new ProductModel();
        $productModel->where('id', $idProduct)->set('stock',  'stock+' . intval($textStock), false)
            ->update();


        $dataRes = [
            'title' => 'Stock do produto atualizado!',
            'text' => (intval($textStock) <= 1 ? "Adicionada " : "Adiconadas ") . $textStock . (intval($textStock) <= 1 ? " quantidade ao " : " quantidades ao ") . $productName,
            "icon" => "success",
            'status' => 'success'
        ];


        return redirect()->back()->with('success', $dataRes);
    }

    public function removeProductStock(string $encryptedId)
    {
        $id = decrypt($encryptedId);

        if (!$id) {
            return redirect()->to('/stock');
        }
        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/stock');
        }

        // printData($listSuppliers);

        $data = [
            'title' => '- Stock de produtos',
            'page' => 'Saída de stock para' . $product->name,
            'product' => $product,
            'success' => session()->getFlashdata('success'),
            'validationErrors' => session()->getFlashdata('validationErrors'),
            'serverError' => session()->getFlashdata('serverError')
        ];

        return view('dashboard/stock/removeProductStock', $data);
    }

    public function removeProductStockSubmit()
    {
        $validation = $this->validate($this->_removeProductStockValidaton());

        if (!$validation) {
            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
        }

        $idProduct = decrypt($this->request->getPost('idProduct'));
        if (empty($idProduct)) {
            return redirect()->back()->withInput()->with('serverError', 'Ocorreu um erro, tente novamente!');
        }

        $textStock = $this->request->getPost('textStock');
        $textDate = $this->request->getPost('textDate');
        $textReason = $this->request->getPost('textReason');
        $productName = $this->request->getPost('productName');

        $productModel = new ProductModel();
        $product = $productModel->where('id', $idProduct)->first();
        if ($product->stock < intval($textStock)) {
            return redirect()->back()->withInput()->with('serverError', 'O stock actual é inferior à quantidade que pretende remover!');
        }


        $stockModel = new StockModel();

        $data = [
            'id_product' => $idProduct,
            'stock_quantity' => intval($textStock),
            'stock_in_out' => 'OUT',
            'stock_supplier' => 'Owner',
            'movement_date' => $textDate,
            'reason' => $textReason,
        ];

        $stockModel->insert($data);

        $productModel->where('id', $idProduct)->set('stock',  'stock-' . intval($textStock), false)
            ->update();




        $dataRes = [
            'title' => 'Stock do produto removido!',
            'text' => (intval($textStock) <= 1 ? "Removida " : "Removidas ") . $textStock . (intval($textStock) <= 1 ? " quantidade ao " : " quantidades ao ") . $productName,
            "icon" => "warning",
            'status' => 'success'
        ];
        return redirect()->back()->with('success', $dataRes);
    }

    private function _removeProductStockValidaton()
    {
        return [
            'idProduct' => [
                'rules' => 'required'
            ],
            'textStock' => [
                'label' => 'Quantidade',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'numeric' => 'O campo {field} deve conter apenas números',
                    'greater_than' => 'O campo {field} deve conter um valor maior que {param}.'
                ]
            ],
            'textReason' => [
                'label' => 'Observações',
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'greater_than' => 'O campo {field} deve conter um descrição com no mínimo {param} caracteres.'
                ]
            ],
            'textDate' => [
                'label' => 'Data do movimento',
                'rules' => 'required|valid_date[Y-m-d H:i]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'valid_date' => 'O campo {field} deve conter uma data válida (AAAA-MM-DD HH-MM).',
                ]
            ],
        ];
    }

    private function _addProductStockValidaton()
    {
        return [
            'idProduct' => [
                'rules' => 'required'
            ],
            'textStock' => [
                'label' => 'Quantidade',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'numeric' => 'O campo {field} deve conter apenas números',
                    'greater_than' => 'O campo {field} deve conter um valor maior que {param}.'
                ]
            ],
            'textSupplier' => [
                'label' => 'Fornecedor',
                'rules' => 'required',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                ]
            ],
            'textDate' => [
                'label' => 'Data do movimento',
                'rules' => 'required|valid_date[Y-m-d H:i]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'valid_date' => 'O campo {field} deve conter uma data válida (AAAA-MM-DD HH-MM).',
                ]
            ],
        ];
    }
}
