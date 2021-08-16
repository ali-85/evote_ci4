<?php

namespace App\Models;

use CodeIgniter\Model;

class KandidatModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kandidat';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['voting_id','nama','visi','misi','image','vote'];

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

	public function getKandidat($id = false)
	{
		if ($id == false) {
			$query = $this->db->table('kandidat')
								->select('kandidat.*,voting.id as id_voting,voting.title as title,voting.started,voting.ended')
								->join('voting','voting.id = kandidat.voting_id')
								->orderBy('voting_id','ASC')
                                ->get();
			return $query;
		}else{
			$query = $this->db->table($this->table)->getWhere(['id' => $id]);
			return $query;
		}
	}
	public function showKandidat($voting_id)
	{
		$query = $this->db->table($this->table)->where('voting_id',$voting_id);	
		return $query;
	}
	public function storeKandidat($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query;
	}
	public function updateKandidat($id,$data)
	{
		$query = $this->db->table($this->table)->update($data,['id' => $id]);
		return $query;
	}
	public function deleteKandidat($id)
	{
		$query = $this->db->table($this->table)->delete(['id' => $id]);
		return $query;
	}
}

