<?php

namespace App\Controllers;

use App\Models\RestaurantModel;
use Config\Database;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Auth extends BaseController
{
    public function index()
    {
        $data = [];
        $restaurantModel = new RestaurantModel();
        $restaurants = $restaurantModel->select('id, name',)->findAll();

        $data['restaurants'] = $restaurants;

        $validationErrors = session()->getFlashdata('validationErrors');

        if ($validationErrors) {
            $data['validationErrors'] = $validationErrors;
        }

        return view('auth/index', $data);
    }

    public function loginSubmit()
    {
        $rules = [
            'textUsername' => [
                'label' => 'Usuário',
                'rules' => 'required|min_length[6]|max_length[16]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter, no mínimo, {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter, no máximo, {param} caracteres.'
                ],
            ],
            'textPasswrd' => [
                'label' => 'Palavra-passe',
                'rules' => 'required|min_length[6]|max_length[16]',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.',
                    'min_length' => 'O campo {field} deve ter, no mínimo, {param} caracteres.',
                    'max_length' => 'O campo {field} deve ter, no máximo, {param} caracteres.'
                ],
            ],
            'selectRestaurant' => [
                'label' => 'Restaurante',
                'rules' => 'required',
                'errors' => [
                    'required' => 'O campo {field} é obrigatório.'
                ],
            ]
        ];

        $validation = $this->validate($rules);

        if (!$validation) {
            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
            // dd($this->validator->getErrors());
        }

        $data = [];
        $data['restaurantId'] = $this->request->getPost('selectRestaurant');
        $data['userName'] = $this->request->getPost('textUsername');
        $data['userName'] = $this->request->getPost('textUsername');
        dd($data);
        // echo 'login submit ' . decrypt($restaurantId);
    }

    public function logout()
    {
        echo  'logout';
    }
}
