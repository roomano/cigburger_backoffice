<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['last_login'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function checkValidLogin($username, $passwrd, $id_restaurant)
    {
        $where = [
            'username' => $username,
            'id_restaurant' => $id_restaurant,
            'blocked_until' => null,
            'active' => 1,
            'deleted_at' => null
        ];

        $user = $this->where($where)->first();

        if (!$user) {
            return false;
        }

        if (!password_verify($passwrd, $user->passwrd)) {
            return false;
        }
        $this->save([
            'id' => $user->id,
            'last_login' => date('Y-m-d H:i:s')
        ]);;
        $user = $this->find($user->id);
        return $user;
    }
}
