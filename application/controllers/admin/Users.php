<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	// Database
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('id') == "")
		{
			$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Anda Perlu Login !
                                        </div>');
			redirect(base_url('login'),'refresh');
		}
		$this->load->model('user_model');
		$this->load->model('peternakan_model');
	}

	public function index()
	{
		// $id_user 	= $this->session->userdata('id');
		$user 	= $this->user_model->list_user();

		$data = array(
			'user'		=> $user,
			'isi'		=> 'admin/tabel_user/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function list_downline()
	{
		$id_user 	= $this->session->userdata('id');
		$user 	= $this->user_model->list_user_downline($id_user);

		$data = array(
			'user'		=> $user,
			'isi'		=> 'admin/tabel_user/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function tambah_downline()
	{
		$peternakan = $this->peternakan_model->list_peternakan($this->session->userdata('id'));
		$data = array(
			'peternakan'			=> $peternakan,
			'isi'		=> 'admin/tabel_user/tambah_user',
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	

	public function confirm($id_user)
	{
		// $id_user = $this->session->userdata('id');
		$data = array(
						'id'		=> $id_user,
						'status'	=> 1
					);
		$this->user_model->edit($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil diaktifkan !
                                        </div>');
		redirect(base_url('admin/users/list_downline'), 'refresh');
	}

	public function submit_downline()
    {
        	// START VALIDASI
            $valid = $this->form_validation;
            $valid->set_rules('nama', 'Nama', 'required', array('required'        => 'Form %s tidak boleh kosong'));
            $valid->set_rules('email', 'Email', 'required|is_unique[user_pendaftar.email]',
                  array(
                        'required'        => 'Form %s tidak boleh kosong', 
                        'is_unique'       => 'Email sudah digunakan, silahkan gunakan email yang lainnya'));
            $valid->set_rules('no_telp', 'No HP', 'required|min_length[8]|max_length[20]', 
				  array(
					'required'        => 'Form %s tidak boleh kosong',
					'min_length'        => 'Minimal 8 angka',
					'max_length'        => 'Maksimal 20 angka',
				));
            $valid->set_rules('password', 'Password', 'required');

            if($valid->run()===FALSE)
            {

				$data = array(
					'isi'		=> 'admin/tabel_user/tambah_user'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
            }
            else
            {
                  $i = $this->input;
                  $data = array(
					  	'id_user_downline'  => $i->post('id_user_downline'),
                        'nama'              => $i->post('nama'),
                        'id_peternakan'   	=> $i->post('id_peternakan'),
                        'email'             => $i->post('email'),
                        'no_telp'           => $i->post('no_telp'),
                        'password'		    => password_hash($i->post('password'), PASSWORD_DEFAULT),
                        'status'            => '1',
                        'jenis_akun'        => 'user_downline',
                        'tipe_user'        	=> $i->post('tipe_user'),
                        'tanggal_daftar'    => date('Y-m-d H:i:s')
                  );

				  $token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $this->input->post('email'),
						'token' => $token,
						'date_created' => time()
					];

                  $this->user_model->tambah_user($data);
				//   $this->_sendEmail($token, 'verify');
				//   $this->db->insert('user_token', $user_token);
                  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil disimpan</div>');
                //   $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Daftar, Silahkan cek email anda dan lakukan aktivasi</div>');
			      redirect(base_url('admin/users/list_downline'),'refresh');
            }
    }

	public function edit($id_user)
	{
		$user 	= $this->user_model->detail($id_user);
		$peternakan = $this->peternakan_model->list_peternakan($this->session->userdata('id'));
		// $get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $this->session->userdata('id'))->get();
		$data = array(
			'user'			=> $user,
			'peternakan'			=> $peternakan,
			'isi'			=> 'admin/tabel_user/edit'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function view($id_user)
	{
		$user 	= $this->user_model->detail($id_user);

		$data = array(
			'user'			=> $user,
			'isi'			=> 'admin/tabel_user/view'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}


	public function edit_aksi($id_user)
	{
		 // START VALIDASI
		 $valid = $this->form_validation;
		//  $valid->set_rules('nama', 'Nama', 'required', array('required'        => 'Form %s tidak boleh kosong'));
		//  $valid->set_rules('nama_peternakan', 'Nama Peternakan', 'required', array('required'        => 'Form %s tidak boleh kosong'));
		//  $valid->set_rules('email', 'Email', 'required|valid_email|is_unique[user_pendaftar.email]',
		//    array(
		// 		 'required'        => 'Form %s tidak boleh kosong', 
		// 		 'is_unique'       => 'Email sudah digunakan, silahkan gunakan'));
		//  $valid->set_rules('no_telp', 'No Telp', 'required|min_length[8]|max_length[20]', array('required' => 'Form %s tidak boleh kosong'));
		//  $valid->set_rules('password', 'Password', 'required');
		
			
			// if($valid->run()===FALSE)
            // {
			// 	$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
            //                               Password tidak sama, pastikan min 8 karakter dan gunakan kombinasi huruf dan angka !
            //                             </div>');
			// 	redirect(base_url('admin/users/edit/'.$id_user), 'refresh');
            // } else
            // {
				if($this->input->post('password') != NULL || $this->input->post('password') != ""){
					$data = array(
						'id'			=> $id_user,
						'nama'			=> $this->input->post('nama'),
						'id_peternakan'			=> $this->input->post('id_peternakan'),
						'email'			=> $this->input->post('email'),
						'no_telp'		=> $this->input->post('no_telp'),
						'tipe_user'		=> $this->input->post('tipe_user'),
						'password'		=> $this->input->post('password'),
						// 'id_kandang'	=> $this->input->post('id_kandang'),
						// 'status'		=> $this->input->post('status')
					);
				} else {
					$data = array(
						'id'			=> $id_user,
						'nama'			=> $this->input->post('nama'),
						'id_peternakan'			=> $this->input->post('id_peternakan'),
						'email'			=> $this->input->post('email'),
						'no_telp'		=> $this->input->post('no_telp'),
						'tipe_user'		=> $this->input->post('tipe_user'),
						// 'id_kandang'		=> $this->input->post('id_kandang'),
						// 'status'		=> $this->input->post('status')
					);
				}
			// }
		
		
		$this->user_model->edit($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil diedit !
                                        </div>');
		redirect(base_url('admin/users/list_downline'), 'refresh');
	}

	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} harus diisi.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} harus mengandung huruf kecil.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} harus mengandung huruf kapital.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} minimal mengandung 1 nomor.');

			return FALSE;
		}

		if (strlen($password) < 8)
		{
			$this->form_validation->set_message('valid_password', '{field} minimal 8 karakter.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}

	public function confirm_nonactive($id_user)
	{
		// $id_user = $this->session->userdata('id');
		$data = array(
						'id'		=> $id_user,
						'status'	=> 0
					);
		$this->user_model->edit($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dinonaktifkan !
                                        </div>');
		redirect(base_url('admin/users/list_downline'), 'refresh');
	}

	public function delete($id_user) {
		$data = array('id'	=> $id_user);
		$this->user_model->delete($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/users/list_downline'), 'refresh');
	}

}

