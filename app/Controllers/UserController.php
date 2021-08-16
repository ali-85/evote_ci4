<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KandidatModel;
use App\Models\VotingModel;
use App\Models\PenggunaModel;
use App\Models\HasvoteModel;
class UserController extends BaseController
{
	public function __construct()
	{
		date_default_timezone_set('asia/jakarta');
		$this->kandidat = new KandidatModel();
		$this->voting = new VotingModel();
		$this->pengguna = new PenggunaModel();
		$this->vote = new HasvoteModel();
	}
	public function index()
	{
		$data['voting'] = $this->voting->getVoting()->getResult();
		//var_dump($data);
		$data['title'] = 'Dashboard | EVote';
		echo view('user/index',$data);
	}
	public function viewKandidat($voting_id)
	{
		date_default_timezone_set('asia/jakarta');
		$data['total'] = $this->pengguna->where('role',0)->countAllResults();
		//var_dump($data['total']);
		//die();
		$data['has_vote'] = $this->vote->hasVote(session()->get('id'),$this->request->uri->getSegment(3))->get()->getRow();
		$data['voting'] = $this->voting->getVoting($voting_id)->getResult();
		$data['kandidat'] = $this->kandidat->showKandidat($voting_id)->get()->getResult();
		$data['title'] = 'Kandidat | EVote';
		echo view('user/kandidat',$data);
	}
	public function getProfile()
	{
		$data['users'] = $this->pengguna->getPengguna(session()->get('id'))->getResult();
		$data['title'] = 'Profile | EVote';
		echo view('user/profile',$data);
	}
	public function vote($id)
	{
		$kandidat = $this->kandidat->getKandidat($id)->getRow();
		$data['has_vote'] = $this->vote->hasVote(session()->get('id'),$this->request->uri->getSegment(3))->get()->getRow();
		if(!empty($data['has_vote'])){
			session()->setFlashdata('message','Anda tidak bisa melakukan vote lagi!');
			return redirect()->back();
		} else {
			$has = $kandidat->vote;
			$has += 1;
			$data = [
				'user_id' => session()->get('id'),
				'voting_id' => $kandidat->voting_id
			];
			$vote = [
				'vote' => $has
			];
			$this->vote->storeVote($data);
			$this->kandidat->updateKandidat($kandidat->id,$vote);
			session()->setFlashdata('message','Terimakasih telah berpartisipasi!');
			return redirect()->back();
		}
	}
	public function changePass()
	{
		if (!$this->validate([
			'oldpass' => 'required',
			'newpass' => 'max_length[15]|required'
			])) {
				return redirect()->to(base_url('user/profile'));
			} else {
				$oldPass = $this->request->getPost('oldpass');
				$data = $this->pengguna->where('id',session()->get('id'))->first();
				$pass = $data['password'];
				$verify = password_verify($oldPass,$pass);
				if ($verify) {
					$data = [
						'password' => password_hash($this->request->getPost('newpass'),PASSWORD_DEFAULT)
					];
					$this->pengguna->update(session()->get('id'),$data);
					session()->setFlashdata('message','Password berhasil diganti!');
					return redirect()->to(base_url('user/profile'));
				}
			session()->setFlashdata('message','Password lama yang anda masukkan salah!');
			return redirect()->to(base_url('user/profile'));
		}
	}
}
