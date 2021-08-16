<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voting extends Migration
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
			'title'       => [
					'type'       => 'varchar',
					'constraint' => 64,
			],
			'started' => [
					'type' => 'timestamp',
					'null' => true
			],
			'ended' => [
					'type' => 'timestamp',
					'null' => true
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('voting');
	}

	public function down()
	{
		$this->forge->dropTable('voting', false, true);
	}
}
