<?php

namespace App\Models;

use CodeIgniter\Model;

class HasvoteModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'has_vote';
	protected $primaryKey           = 'id';
	protected $allowedFields        = ['user_id','voting_id'];

	public function getVote($id = false)
	{
		if ($id == false) {
			$query = $this->db->table($this->table);
			return $query;
		}else{
			$query = $this->db->table($this->table)->getWhere(['id' => $id]);
			return $query;
		}
	}
	public function storeVote($data)
	{
		$query = $this->db->table($this->table)->insert($data);
        return $query;
	}
	public function hasVote($user_id,$voting_id)
	{
		$query = $this->db->table($this->table)->where('user_id',$user_id)->Where('voting_id',$voting_id);
        return $query;
	}
	public function deleteData($voting_id)
	{
		$query = $this->db->table($this->table)->delete(['voting_id' => $voting_id]);
		return $query;
	}
}
