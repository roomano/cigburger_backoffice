<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class Products extends BaseController
{
    public function index()
    {
        $idRestaurant = session()->user['idRestaurant'];
        $productModel = new ProductModel();
        $products = $productModel
            ->where('id_restaurant', $idRestaurant)
            ->findAll();

        // printData($products);
        $data = [
            'title' => '- Produtos',
            'page' =>  'Produtos',
            'products' => $products
        ];



        return view('dashboard/products/index', $data);
    }

    public function newProduct()
    {
        $data = [
            'title' => '- Novo produto',
            'page' =>  'Novo produto'
        ];

        $data['fileError'] = session()->getFlashdata('fileError');
        $data['validationErrors'] = session()->getFlashdata('validationErrors');

        $data['message'] = session()->getFlashdata('message');

        $productModel = new ProductModel();

        $data['categories'] = $productModel->where('id_restaurant', session()->user['idRestaurant'])->select('category')->distinct()->findAll();


        return view('dashboard/products/new', $data);
    }

    public function newSubmit()
    {

        $upFile = $this->request->getFile('fileImage');
        $imageName = '';

        if ($upFile->isValid()) {
            $rules = [
                'fileImage' => [
                    'label' => 'imagem do produto',
                    'rules' => [
                        'mime_in[fileImage,image/png]',
                        'max_size[fileImage,200]'
                    ],
                    'errors' => [
                        'mime_in' => 'O campo {field} deve ser uma imagem PNG',
                        'max_size' => 'O campo {field} deve ter no máximo 200KB'
                    ]
                ],
            ];
            $fileValidation = $this->validate($rules);

            if (!$fileValidation) {
                return redirect()->back()->withInput()->with('fileError', $this->validator->getErrors());
            }
        }


        $rules = [
            // input fields
            'textName' => [
                'label' => 'nome do produto',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 100 caracteres'
                ]
            ],
            'textDescription' => [
                'label' => 'descrição do produto',
                'rules' => 'required|min_length[3]|max_length[200]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 200 caracteres'
                ]
            ],
            'textCategory' => [
                'label' => 'categoria do produto',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 50 caracteres'
                ]
            ],
            'textPrice' => [
                'label' => 'preço do produto',
                'rules' => 'required|regex_match[/^\d+\,\d{2}$/]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'regex_match' => 'O campo {field} deve ser um número com o formato x,xx',
                ]
            ],
            'textPromotion' => [
                'label' => 'promoção do produto',
                'rules' => 'required|greater_than[-1]|less_than[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'greater_than' => 'O campo {field} deve ser um número maior que {param}',
                    'less_than' => 'O campo {field} deve ser um número menor que {param}',
                ]
            ],
            'textInitialStock' => [
                'label' => 'estoque inicial do produto',
                'rules' => 'required|greater_than[99]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'greater_than' => 'O campo {field} deve ser um número maior que {param}',
                ]
            ],
            'textStockMinimumLimit' => [
                'label' => 'limite mínimo de estoque do produto',
                'rules' => 'required|greater_than[1]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'greater_than' => 'O campo {field} deve ser um número maior que {param}',
                ]
            ]
        ];

        $validation = $this->validate($rules);

        if (!$validation) {

            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
        }

        $productModel = new ProductModel();

        $productName = $this->request->getPost('textName');
        $idRestaurant = session()->user['idRestaurant'];
        $imagesPath = 'public/assets/images/products';
        $productDescription = $this->request->getPost('textDescription');
        $productCategory = $this->request->getPost('textCategory');
        $productPrice = $this->request->getPost('textPrice');
        $productPromotion = $this->request->getPost('textPromotion');
        $productInitialStock = $this->request->getPost('textInitialStock');
        $productStockLimit = $this->request->getPost('textStockMinimumLimit');

        $product = $productModel
            ->where('name', $productName)
            ->where('id_restaurant', $idRestaurant)
            ->first();
        if ($product) {
            return redirect()->back()->withInput()->with('validationErrors', ['textName' => 'Já existe outro produto com o mesmo nome neste restaurante']);
        }

        $imageName = "rest_{$idRestaurant}_" . str_replace(' ', '_', $productName) . ".{$upFile->getExtension()}";

        if (!$upFile->isValid()) {
            $imageName = "no_image.png";
        } else {
            $upFile->move(ROOTPATH . $imagesPath, $imageName, true);
        }

        $data = [
            'id_restaurant' => $idRestaurant,
            'name' => $productName,
            'description' => $productDescription,
            'category' => $productCategory,
            'price' => preg_replace("/\,/", '.', $productPrice),
            'promotion' => $productPromotion,
            'stock' => $productInitialStock,
            'stock_min_limit' => $productStockLimit,
            'image' => $imageName,
            'availability' => $this->request->getPost('checkAvailable') ? 1 : 0
        ];

        // dd($data);

        $productModel->insert($data);

        return redirect()->to('/products/new')->with('message', $productName);
        // echo 'submetido';
    }

    public function edit(string $encryptedId)
    {


        $id = decrypt($encryptedId);
        if (empty($id)) {
            return redirect()->to('/products');
        }
        $data = [
            'title' => '- Editar produtos',
            'page' =>  'Editar produto',

        ];
        $data['validationErrors'] = session()->getFlashdata('validationErrors');
        $data['fileError'] = session()->getFlashdata('fileError');
        $data['message'] = session()->getFlashdata('message');
        $data['serverError'] = session()->getFlashdata('serverError');

        $productModel = new ProductModel();

        $data['product'] = $productModel->find($id);

        $data['categories'] = $productModel->where('id_restaurant', session()->user['idRestaurant'])->select('category')->distinct()->findAll();
        return view('dashboard/products/edit', $data);
    }

    public function editSubmit()
    {
        $id = decrypt($this->request->getPost('idProduct'));

        if (empty($id)) {
            return redirect()->to('/products');
        }

        $upFile = $this->request->getFile('fileImage');
        $imageName = '';

        if ($upFile->isValid()) {
            $rules = [
                'fileImage' => [
                    'label' => 'imagem do produto',
                    'rules' => [
                        'mime_in[fileImage,image/png]',
                        'max_size[fileImage,200]'
                    ],
                    'errors' => [
                        'mime_in' => 'O campo {field} deve ser uma imagem PNG',
                        'max_size' => 'O campo {field} deve ter no máximo 200KB'
                    ]
                ],
            ];
            $fileValidation = $this->validate($rules);

            if (!$fileValidation) {
                return redirect()->back()->withInput()->with('fileError', $this->validator->getErrors());
            }
        }

        $rules = [
            // input fields
            'textName' => [
                'label' => 'nome do produto',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 100 caracteres'
                ]
            ],
            'textDescription' => [
                'label' => 'descrição do produto',
                'rules' => 'required|min_length[3]|max_length[200]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 200 caracteres'
                ]
            ],
            'textCategory' => [
                'label' => 'categoria do produto',
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'min_length' => 'O campo {field} deve ter no mínimo 3 caracteres',
                    'max_length' => 'O campo {field} deve ter no máximo 50 caracteres'
                ]
            ],
            'textPrice' => [
                'label' => 'preço do produto',
                'rules' => 'required|regex_match[/^\d+\,\d{2}$/]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'regex_match' => 'O campo {field} deve ser um número com o formato x,xx',
                ]
            ],
            'textPromotion' => [
                'label' => 'promoção do produto',
                'rules' => 'required|greater_than[-1]|less_than[100]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'greater_than' => 'O campo {field} deve ser um número maior que {param}',
                    'less_than' => 'O campo {field} deve ser um número menor que {param}',
                ]
            ],
            'textStockMinimumLimit' => [
                'label' => 'limite mínimo de estoque do produto',
                'rules' => 'required|greater_than[1]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório',
                    'greater_than' => 'O campo {field} deve ser um número maior que {param}',
                ]
            ]
        ];

        $validation = $this->validate($rules);

        if (!$validation) {

            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
        }

        $productName = $this->request->getPost('textName');

        $idRestaurant = session()->user['idRestaurant'];

        $productModel = new ProductModel();

        $product = $productModel
            ->where('name', $productName)
            ->where('id_restaurant', $idRestaurant)
            ->where('id !=', $id)
            ->first();

        if ($product) {
            return redirect()->back()->withInput()->with('serverError', 'Ja existe outro produto com o mesmo nome');
        }



        $productDescription = $this->request->getPost('textDescription');
        $productCategory = $this->request->getPost('textCategory');
        $productPrice = $this->request->getPost('textPrice');
        $productPromotion = $this->request->getPost('textPromotion');
        $productStockLimit = $this->request->getPost('textStockMinimumLimit');

        $data = [
            'id_restaurant' => $idRestaurant,
            'name' => $productName,
            'description' => $productDescription,
            'category' => $productCategory,
            'price' => preg_replace("/\,/", ".", $productPrice),
            'promotion' => $productPromotion,
            'stock_min_limit' => $productStockLimit,
            'availability' => $this->request->getPost('checkAvailable') ? 1 : 0

        ];


        if ($upFile->isValid()) {
            $imagesPath = 'public/assets/images/products';

            $imageName = "rest_{$idRestaurant}_" . str_replace(' ', '_', $productName) . ".{$upFile->getExtension()}";

            $data['image'] = $imageName;
            $upFile->move(ROOTPATH . $imagesPath, $imageName, true);
        }
        // dd($data);
        $productModel->update($id, $data);

        return redirect()->to('/products/edit/' . encrypt($id))->with('message', $productName);
    }

    public function delete(string $encryptedId)
    {
        $id = decrypt($encryptedId);

        if (empty($id)) {
            return redirect()->to('/products');
        }

        $productModel = new ProductModel();

        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/products');
        }

        $data = [
            'title' => '- Eliminar produto',
            'page' => 'Eliminar produto',
            'product' => $product
        ];

        return view('dashboard/products/delete', $data);
    }

    public function deleteConfrim(string $encryptedId)
    {


        $id = decrypt($encryptedId);

        if (empty($id)) {
            return json_encode([
                'status' => 'error'
            ]);
        }

        $productModel = new ProductModel();

        $product = $productModel->find($id);

        if (!$product) {
            return json_encode([
                'title' => "Falha ao eliminar o produto!",
                'text' => "O produto já não existe nos registros!",
                "icon" => "error",
                'status' => 'error'
            ]);
        }
        $data = [
            'title' => $product->name,
            'text' => "Produto eliminado!",
            "icon" => "success",
            'status' => 'success'
        ];

        $productModel->delete($id);

        return json_encode($data);
    }

    public function getDeleteConfrim(string $encryptedId)
    {


        $id = decrypt($encryptedId);

        if (empty($id)) {
            return redirect()->to('/products');
        }

        $productModel = new ProductModel();

        $product = $productModel->find($id);

        if (!$product) {
            return redirect()->to('/products');
        }

        $productModel->delete($id);
        // dd($id);
        return  redirect()->to('/products');
    }
}
