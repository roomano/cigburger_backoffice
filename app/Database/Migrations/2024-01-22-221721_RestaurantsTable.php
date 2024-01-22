<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class RestaurantsTable extends Migration
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
            'name' => [
                'type' => 'varchar',
                'constraint' => 50
            ],
            'address' => [
                'type' => 'varchar',
                'constraint' => 250
            ],
            'phone' => [
                'type' => 'varchar',
                'constraint' => 20
            ],
            'email' => [
                'type' => 'varchar',
                'constraint' => 50
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

        $this->forge->createTable('restaurants');
    }

    public function down()
    {
        $this->forge->dropTable('restaurants');
    }
}
