<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HasVote extends Migration
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
			'user_id'          => [
					'type'           => 'INT',
					'constraint'     => 5
			],
			'voting_id'          => [
					'type'           => 'INT',
					'constraint'     => 5
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('has_vote');
	}

	public function down()
	{
		$this->forge->dropTable('has_vote', false, true);
	}
}
