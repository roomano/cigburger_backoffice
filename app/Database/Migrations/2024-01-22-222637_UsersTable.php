<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class UsersTable extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'id_restaurant' => [
                'type' => 'int',
                'constraint' => 11
            ],
            'username' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'passwrd' => [
                'type' => 'varchar',
                'constraint' => 250
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'phone' => [
                'type' => 'varchar',
                'constraint' => 20
            ],
            'roles' => [
                'type' => 'varchar',
                'constraint' => 500
            ],
            'blocked_until' => [
                'type' => 'datetime',
                'null' => true
            ],
            'active' => [
                'type' => 'int',
                'constraint' => 1
            ],
            'code' => [
                'type' => 'varchar',
                'constraint' => 20
            ],
            'last_login' => [
                'type' => 'datetime',
                'null' => true
            ],
            'created_at' => [
                'type' => 'datetime',
                'default' => new RawSql('NOW()')
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'datetime',
                'null' => true
            ],
        ];

        $this->forge->addField($fields);

        $this->forge->addKey('id', true);

        $this->forge->createTable('users');
    }


    public function down()
    {
        $this->forge->dropTable('users');
    }
}
