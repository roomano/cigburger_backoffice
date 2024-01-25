<?php

namespace App\Controllers;

use App\Models\RestaurantModel;
use App\Models\UserModel;
use CodeIgniter\Commands\Database\Seed;
use Config\Database;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\IncomingRequest;

class Auth extends BaseController
{
    public function index()
    {
        if (session()->has('user')) {
            return redirect()->to('/');
        }
        $data = [];
        $restaurantModel = new RestaurantModel();
        $restaurants = $restaurantModel->select('id, name',)->findAll();

        $data['restaurants'] = $restaurants;

        // array or null
        $data['validationErrors'] = session()->getFlashdata('validationErrors');

        $data['selectRestaurant'] = session()->getFlashdata('selectRestaurant');

        $data['loginError'] = session()->getFlashdata('loginError');

        // if ($validationErrors) {

        //     $data['validationErrors'] = $validationErrors;
        // }

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
            session()->setFlashdata('selectRestaurant', decrypt($this->request->getPost('selectRestaurant')));

            return redirect()->back()->withInput()->with('validationErrors', $this->validator->getErrors());
            // dd($this->validator->getErrors());
        }

        $username = $this->request->getPost('textUsername');
        $passwrd = $this->request->getPost('textPasswrd');
        $id_restaurant = decrypt($this->request->getPost('selectRestaurant'));

        $userModel = new UserModel();
        $user = $userModel->checkValidLogin($username, $passwrd, $id_restaurant);

        if (!$user) {
            session()->setFlashdata('selectRestaurant', decrypt($this->request->getPost('selectRestaurant')));
            return redirect()->back()->withInput()->with('loginError', 'Usuário ou Senha inválidos');
        }


        $restaurant = new RestaurantModel();
        $restaurantName = $restaurant->select('name')->find($user->id_restaurant)->name;

        $userData = [
            'id' => $user->id,
            'name' => $user->name,
            'idRestaurant' => $user->id_restaurant,
            'restaurantName' => $restaurantName,
            'email' => $user->email,
            'phone' => $user->phone,
            'roles' => $user->roles,
        ];

        session()->set('user', $userData);

        return redirect()->to('/');

        // dd($data);
        // echo 'login submit ' . decrypt($restaurantId);
    }

    public function logout()
    {
        // if ($this->request->isAjax()) {
        //     $a = 'ajax reconhecido';
        //     return    dd($a);
        // }
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}
