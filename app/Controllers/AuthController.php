<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenggunaModel;

class AuthController extends BaseController
{
	public function index()
	{
		if(!session()->get('logged_in')){
			$data['title'] = 'EVote | Login Page';
			echo view('auth/login',$data);
		} else {
			return redirect()->to(base_url('admin/dashboard'));
		}
	}
	public function postLogin()
	{
		$session = session();
		if (!$this->validate([
			'nim' => 'max_length[20]|required',
			'password' => 'max_length[15]|required',
			])) {
				$session->setFlashdata('msg','Anda belum mengisi form atau karakter melebihi maksimum!');
				return redirect()->to(base_url());
			} else {
			$model = new PenggunaModel();
			$nim = htmlspecialchars($this->request->getPost('nim'));
			$password = htmlspecialchars($this->request->getPost('password'));
			$data = $model->where('nim',$nim)->first();
			if ($data) {
				$pass = $data['password'];
				$verify = password_verify($password,$pass);
				if ($verify) {
					$ses_data = [
						'id' => $data['id'],
						'nim' => $data['nim'],
						'nama' => $data['nama'],
						'role' => $data['role'],
						'logged_in' => true
					];
					$session->set($ses_data);
					return redirect()->to(base_url('admin/dashboard'));
				} else {
					$session->setFlashdata('msg','Password anda salah!');
					return redirect()->to(base_url());
				}
			} else {
				$session->setFlashdata('msg','NIM tidak ditemukan!');
				return redirect()->to(base_url());
			}
		}
	}
	public function logout()
	{
		$session = session();
        $session->destroy();
		$session->setFlashdata('msg','Anda sudah logout!');
        return redirect()->to(base_url());
	}
}
