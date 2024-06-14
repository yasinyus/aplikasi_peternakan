<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{


	// load data
	public function __construct()
	{
		parent::__construct();
		// $this->log_user->add_log();
		$this->load->model('user_model');
		// Tambahkan proteksi halaman
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
		// Ambil check login dari simple_login
		// Check status login (kita ambil status username dan akses level)
		if($this->session->userdata('id') == "")
		{
			$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Anda Perlu Login !
                                        </div>');
			redirect(base_url('login'),'refresh');
		}
	}

	// Main page akun
	public function index()
	{
		$id_user 	= $this->session->userdata('id');
		$user 		= $this->user_model->detail($id_user);


		if($_SERVER['REQUEST_METHOD'] == 'POST') {

					$i = $this->input;
					$this->session->set_userdata('nama', $i->post('nama'));
					$data = array(
						'id'				=> $id_user,
						'nama'				=> $i->post('nama'),
						'nama_peternakan'	=> $i->post('nama_peternakan'),
						'email'				=> $i->post('email'),
						'no_telp'			=> $i->post('no_telp'),
						// 'gambar'			=> $upload_data['uploads']['file_name'],
					);
					$this->user_model->edit($data);
					// $this->session->set_flashdata('sukses', 'Data ' . $user->nama . ' telah diupdate');
					$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil diupdate !
                                        </div>');
					redirect(base_url('admin/profil'), 'refresh');
				
		} else {
		$data = array(
			'title'		=> 'Profil Akun Anda: ' . $this->session->userdata('nama'),
			'user'		=> $user,
			'isi'		=> 'admin/profil/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
		}
	}

	// Main page akun
	public function password()
	{
		$id_user 	= $this->session->userdata('id');
		$user 		= $this->user_model->detail($id_user);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'password',
			'Password',
			'required|trim|min_length[6]|max_length[32]',
			array(
				'required'		=> '%s harus diisi',
				'min_length'	=> '%s minimal 6 karakter',
				'max_length'	=> '%s maksimal 32 karakter'
			)
		);

		$valid->set_rules(
			'passconfirm',
			'Konfirmasi password',
			'required|matches[password]',
			array(
				'required'	=> '%s harus diisi',
				'matches'	=> '%s tidak cocok. Pastikan password Anda sama'
			)
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Profil Akun Anda: ' . $this->session->userdata('nama'),
				'user'		=> $user,
				'isi'		=> 'admin/profil/list'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		} else {

			$i = $this->input;
			$this->session->set_userdata('nama', $i->post('nama'));
			$data = array(
				'id'				=> $id_user,
				'password'			=> password_hash($i->post('password'), PASSWORD_DEFAULT),
			);
			$this->user_model->edit($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Password Berhasil diupdate !
                                        </div>');
					redirect(base_url('admin/profil'), 'refresh');
		}
	}

	public function logout()
	{

		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout berhasil, silahkan Login kembali!</div>');
		redirect('login');
	}
}

/* End of file Akun.php */
/* Location: ./application/controllers/admin/Akun.php */
