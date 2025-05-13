<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true, // tambahkan unsigned
            ],
            'username'    => ['type' => 'VARCHAR', 'constraint' => '100'],
            'email'       => ['type' => 'VARCHAR', 'constraint' => '100'],
            'password'    => ['type' => 'VARCHAR', 'constraint' => '255'],
            'role'     => ['type' => 'VARCHAR', 'constraint' => '10'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
            'deleted_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
