<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kandidat extends Migration
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
			'voting_id'       => [
					'type'       => 'int',
					'constraint' => 11,
			],
			'nama' => [
					'type' => 'varchar',
					'constraint' => 16,
			],
			'image' => [
					'type' => 'varchar',
					'constraint' => 16,
			],
			'visi' => [
					'type' => 'text'
			],
			'misi' => [
					'type' => 'text'
			],
			'vote' => [
					'type' => 'int',
					'constraint' => 11
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('kandidat');
	}

	public function down()
	{
		$this->forge->dropTable('kandidat', false, true);
	}
}
