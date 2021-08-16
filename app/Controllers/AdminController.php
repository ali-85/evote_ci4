<?php

namespace App\Controllers;

use PHPExcel;
use PHPExcel_IOFactory;
use App\Models\PenggunaModel;
use App\Models\VotingModel;
use App\Models\HasvoteModel;
use App\Models\KandidatModel;

class AdminController extends BaseController
{
	public function __construct(){
		$this->pengguna = new PenggunaModel();
		$this->voting = new VotingModel();
		$this->vote = new HasvoteModel();
		$this->kandidat = new KandidatModel();
	}
	public function index()
	{
		$data['total_users'] = $this->pengguna->where('role',0)->countAllResults();
		$data['events'] = $this->voting->countAllResults();
		$data['voting'] = $this->voting->getVoting()->getResult();
		$data['kandidat'] = $this->kandidat->getKandidat()->getResult();
		$data['title'] = "Dashboard | EVote";
		echo view('admin/index', $data);
	}
	public function pengguna()
	{
		$data = [
			'title' => "Pengguna | EVote",
			'pengguna' => $this->pengguna->asObject()->paginate(10,'users'),
			'pager' => $this->pengguna->pager
		];
		echo view('admin/pengguna/pengguna', $data);
	}
	public function searchPengguna()
	{
		$key = $this->request->getPost('key');
		$data = [
            'title' => "Cari Pengguna | EVote",
            'pengguna' => $this->pengguna->like('nim', $key)->orLike('nama',$key)->asObject()->paginate(10,'users'),
            'pager' => $this->pengguna->pager
        ];
		echo view('admin/pengguna/pengguna', $data);
	}
	public function addPengguna()
	{
		$data['title'] = "Tambah Pengguna | EVote";
		echo view('admin/pengguna/tambah', $data);
	}
	public function postPengguna()
	{
		$nim = $this->request->getPost('nim');
		$nama = $this->request->getPost('nama');
		$password = password_hash(strtolower(substr(str_replace(" ","",$nama),0,5)).substr($nim,4),PASSWORD_DEFAULT);
		$data = [
			'nim' => $nim,
			'nama' => $nama,
			'password' => $password,
			'role' => $this->request->getPost('role')
		];
		$this->pengguna->saveUser($data);
		session()->setFlashdata('message','Tambah pengguna berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function deletePengguna($id = null)
	{
		$this->pengguna->deleteUser($id);
		session()->setFlashdata('message','Hapus pengguna berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function deletePenggunaBatch()
	{
		$id = $this->request->getPost('id');
		$this->pengguna->deleteBatch($id);
		session()->setFlashdata('message','Hapus massal pengguna berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function editPenggunaBatch()
	{
		$id = $this->request->getPost('id');
		$data['title'] = "Edit Pengguna | EVote";
		$data['pengguna'] = $this->pengguna->editBatch($id)->getResult();
		echo view('admin/pengguna/editbatch', $data);
	}
	public function editPengguna($id)
	{
		$data['title'] = "Edit Pengguna | EVote";
		$data['pengguna'] = $this->pengguna->getPengguna($id)->getResult();
		echo view('admin/pengguna/edit', $data);
	}
	public function updatePengguna()
	{
		$id = $this->request->getPost('id');
		$checked = $this->request->getPost('reset');
		$nim = $this->request->getPost('nim');
		$nama = $this->request->getPost('nama');
		if (isset($checked) == 1) {
			$password = password_hash(strtolower(substr(str_replace(" ","",$nama),0,5)).substr($nim,4),PASSWORD_DEFAULT);
			$data = [
				'nama' => $nama,
				'nim' => $nim,
				'role' => $this->request->getPost('role'),
				'password' => $password
			];
		} else {
			$data = [
				'nama' => $nama,
				'nim' => $nim,
				'role' => $this->request->getPost('role')
			];
		}
		$this->pengguna->updateUser($id,$data);
		session()->setFlashdata('message','Sunting pengguna berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function updatePenggunaBatch()
	{
		$id = $this->request->getPost('id');
		$nim = $this->request->getPost('nim');
		$nama = $this->request->getPost('nama');
		$role = $this->request->getPost('role');
        $result = array();
		foreach($id as $key => $val){
			$result[] = array(
				"id" => $id[$key],
				"nim"  => $nim[$key],
				"nama"  => $nama[$key],
				"role"  => $role[$key]
			);
		}
		//var_dump($result);
		$this->pengguna->updateUsersBatch($result);
		session()->setFlashdata('message','Sunting massal pengguna berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function import()
	{
		$data['title'] = "Import Data | EVote";
		echo view('admin/pengguna/import', $data);
	}
	public function postImport()
	{
		$file = $this->request->getFile('excelfile');
		//$files->move(WRITEPATH.'excel');
		if($file){
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$tempfile = $file->getTempName();
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($tempfile);
			//ambil sheet active
			/*$newName = $file->getClientName();
			$files->move(ROOTPATH . 'excel',$newName.'.xlsx');
			$excelReader = new PHPExcel();
			$fileLocation = ROOTPATH . 'excel/'.$this->filename.'.xlsx';
			$loadexcel = PHPExcel_IOFactory::load($fileLocation);*/
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			foreach ($sheet as $idx => $data) {
				//skip index 1 karena title excel
				if($idx==1){
					continue;
				}
				$nim = $data['A'];
				$nama = $data['B'];
				$password = password_hash(strtolower(substr(str_replace(" ","",$nama),0,5)).substr($nim,4),PASSWORD_DEFAULT);
				// insert data
				$this->pengguna->insert([
					'nim'=>$nim,
					'nama'=>$nama,
					'password'=>$password
				]);
			}
		}
		session()->setFlashdata('message','Import Excel Berhasil!');
		return redirect()->to(base_url('admin/pengguna'));
	}
	public function voting()
	{
		$data['voting'] = $this->voting->getVoting()->getResult();
		$data['title'] = "Voting | EVote";
		echo view('admin/voting/index', $data);
	}
	public function addVoting()
	{
		$data['title'] = "Tambah Acara | EVote";
		echo view('admin/voting/tambah', $data);
	}
	public function storeVoting()
	{
		$data = [
			'title' => $this->request->getPost('title'),
			'started' => $this->request->getPost('started'),
			'ended' => $this->request->getPost('ended')
		];
		$this->voting->addVoting($data);
		session()->setFlashdata('message','Tambah voting berhasil!');
		return redirect()->to(base_url('admin/voting'));
	}
	public function editVoting($id)
	{
		$data['voting'] = $this->voting->getVoting($id)->getResult();
		$data['title'] = "Edit Acara | EVote";
		echo view('admin/voting/edit', $data);
	}
	public function updateVoting()
	{
		$id = $this->request->getPost('id');
		$data = [
			'title' => $this->request->getPost('title'),
			'started' => $this->request->getPost('started'),
			'ended' => $this->request->getPost('ended')
		];
		$this->voting->updateVoting($id,$data);
		session()->setFlashdata('message','Sunting voting berhasil!');
		return redirect()->to(base_url('admin/voting'));
	}
	public function deleteVoting($id)
	{
		$db      = \Config\Database::connect();
		$kandidat = $db->table('kandidat')->where('voting_id' ,$id)->get()->getResult();
		$path = "../dist/img/";
		foreach ($kandidat as $row) {
			$row->image;
			@unlink($path.$row->image);
			$this->kandidat->deleteKandidat($row->id);
		}
		$this->vote->deleteData($id);
		$this->voting->deleteVoting($id);
		session()->setFlashdata('message','Hapus voting berhasil!');
		return redirect()->to(base_url('admin/voting'));
	}
	public function addKandidat()
	{
		$data['voting'] = $this->voting->getVoting()->getResult();
		$data['title'] = "Tambah Kandidat | EVote";
		echo view('admin/kandidat/tambah', $data);
	}
	public function kandidat()
	{
		$data['kandidat'] = $this->kandidat->getKandidat()->getResult();
		$data['title'] = "Kandidat | EVote";
		echo view('admin/kandidat/index', $data);
	}
	public function storeKandidat()
	{
		if (!$this->validate([
			'voting_id' => 'required',
			'nama' => 'required',
			'visi' => 'required',
			'misi' => 'required',
			'img' => 'uploaded[img]|mime_in[img,image/jpg,image/jpeg,image/png]|max_size[img,4096]'
			])) {
		$data = [
			'voting_id' => $this->request->getPost('voting_id'),
			'nama' => $this->request->getPost('nama'),
			'visi' => $this->request->getPost('visi'),
			'misi' => $this->request->getPost('misi'),
			'image' => 'no_image.jpg',
		];
		} else {
			$upload = $this->request->getFile('img');
            $upload->move(FCPATH . 'dist/img/');
			$data = [
				'voting_id' => $this->request->getPost('voting_id'),
				'nama' => $this->request->getPost('nama'),
				'visi' => $this->request->getPost('visi'),
				'misi' => $this->request->getPost('misi'),
				'image' => $upload->getName()
			];
		}
		//var_dump($data);
		$this->kandidat->storeKandidat($data);
		session()->setFlashdata('message','Tambah kandidat berhasil!');
		return redirect()->to(base_url('admin/kandidat'));
	}
	public function editKandidat($id)
	{
		$data['kandidat'] = $this->kandidat->getKandidat($id)->getResult();
		$data['voting'] = $this->voting->getVoting()->getResult();
		$data['title'] = "Kandidat | EVote";
		echo view('admin/kandidat/edit', $data);
	}
	public function updateKandidat()
	{
		$id = $this->request->getPost('id');
		if (!$this->validate([
			'id' => 'required',
			'voting_id' => 'required',
			'nama' => 'required',
			'visi' => 'required',
			'misi' => 'required',
			'img' => 'uploaded[img]|mime_in[img,image/jpg,image/jpeg,image/png]|max_size[img,4096]'
			])) {
		$data = [
			'voting_id' => $this->request->getPost('voting_id'),
			'nama' => $this->request->getPost('nama'),
			'visi' => $this->request->getPost('visi'),
			'misi' => $this->request->getPost('misi')
		];
		} else {
			$upload = $this->request->getFile('img');
			if (!$upload) {
				$data = [
					'voting_id' => $this->request->getPost('voting_id'),
					'nama' => $this->request->getPost('nama'),
					'visi' => $this->request->getPost('visi'),
					'misi' => $this->request->getPost('misi')
				];
			}
			$data = $this->kandidat->getKandidat($id)->getRow();
			$image = $data->image;
			$path = "../dist/img/";
			@unlink($path.$image);
            $upload->move(ROOTPATH . '../dist/img/');
			$data = [
				'voting_id' => $this->request->getPost('voting_id'),
				'nama' => $this->request->getPost('nama'),
				'visi' => $this->request->getPost('visi'),
				'misi' => $this->request->getPost('misi'),
				'image' => $upload->getName()
			];
		}
		//var_dump($data);
		$this->kandidat->updateKandidat($id,$data);
		session()->setFlashdata('message','Sunting kandidat berhasil!');
		return redirect()->to(base_url('admin/kandidat'));
	}
	public function deleteKandidat($id)
	{
		$data = $this->kandidat->getKandidat($id)->getRow();
		$image = $data->image;
		$path = "../dist/img/";
		@unlink($path.$image);
		$this->kandidat->deleteKandidat($id);
		session()->setFlashdata('message','Hapus kandidat berhasil!');
		return redirect()->to(base_url('admin/kandidat'));
	}
}