<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class StockTable extends Migration
{
    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_product' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'stock_quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'stock_in_out' => [
                'type' => 'VARCHAR',
                'constraint' => 5,  // IN or OUT
                'null' => true,
            ],
            'stock_supplier' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'reason' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'movement_date' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => new RawSql('NOW()')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];

        $this->forge->addField($fields);

        // Add primary key
        $this->forge->addKey('id', true);

        // Create stocks table
        $this->forge->createTable('stock');
    }

    public function down()
    {
        // Drop stocks table
        $this->forge->dropTable('stock');
    }
}
