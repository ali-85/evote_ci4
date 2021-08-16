<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'nim'       => [
					'type'       => 'INT',
					'constraint' => 11,
			],
			'nama' => [
					'type' => 'varchar',
					'constraint' => 64,
			],
			'password' => [
					'type' => 'varchar',
					'constraint' => 64,
			],
			'role' => [
					'type' => 'BOOL',
					'default' => 0,
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users', false, true);
	}
}
