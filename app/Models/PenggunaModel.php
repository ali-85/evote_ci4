<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nim','nama','password','role'];

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

	public function getPengguna($id = false)
	{
		if ($id == false) {
			$query = $this->db->table($this->table)->get();
			return $query;
		} else {
			$query = $this->db->table($this->table)->getWhere(['id' => $id]);
			return $query;
		}
	}
	public function saveUser($data)
	{
		$query = $this->db->table($this->table)->insert($data);
        return $query;
	}
	public function deleteUser($id)
    {
        $query = $this->db->table($this->table)->delete(['id' => $id]);
        return $query;
    }
	public function deleteBatch($id)
    {
        $query = $this->db->table($this->table)->whereIn('id',$id)->delete();
        return $query;
    }
	public function editBatch($id)
	{
		$builder = $this->db->table($this->table)->whereIn('id',$id);
        return $builder->get();
	}
	public function updateUsersBatch($result = array())
	{
		$query = $this->db->table($this->table)->updateBatch($result, 'id');
        return $query;
	}
	public function updateUser($id,$data)
	{
		$query = $this->db->table($this->table)->update($data,['id' => $id]);
        return $query;
	}
	public function searchPengguna($key)
	{
        $query = $this->db->table($this->table)->like('nim', $key)->orLike('nama',$key)->get();
        return $query;
	}
}
