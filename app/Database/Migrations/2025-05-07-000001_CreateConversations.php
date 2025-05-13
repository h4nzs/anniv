<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOnversationsTables extends Migration
{
    public function up()
    {

$this->forge->addField([
    'id' => [
        'type' => 'INT',
        'auto_increment' => true
    ],
    'user1_id' => [
        'type' => 'INT'
    ],
    'user2_id' => [
        'type' => 'INT'
    ],
    'created_at' => [
        'type' => 'DATETIME',
        'null' => true
    ],
    'updated_at' => [
        'type' => 'DATETIME',
        'null' => true
    ]
]);
    }


    public function down()
    {
        $this->forge->dropTable('conversations');
    }
}