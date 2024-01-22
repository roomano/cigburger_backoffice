<?php

namespace App\Controllers;

use Config\Database;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/index');
    }

    public function loginSubmit()
    {
        echo 'login submit';
    }

    public function logout()
    {
        echo  'logout';
    }
}
