<?php

namespace App\Models;

use CodeIgniter\Model;

class VotingModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'voting';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['title','started','ended'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function getVoting($id = false)
	{
		if ($id == false) {
			$builder = $this->db->table($this->table);
			return $builder->get();
		} else {
			$query = $this->db->table($this->table)->getWhere(['id' => $id]);
			return $query;
		}
	}
	public function addVoting($data)
	{
		$query = $this->db->table($this->table)->insert($data);
        return $query;
	}
	public function updateVoting($id,$data)
	{
		$query = $this->db->table($this->table)->update($data,['id' => $id]);
		return $query;
	}
	public function deleteVoting($id)
	{
		$query = $this->db->table($this->table)->delete(['id' => $id]);
		return $query;
	}
}
