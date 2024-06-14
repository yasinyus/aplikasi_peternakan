<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
	}

	// Index
	public function index()
	{
		if($this->session->userdata('nama')){
			redirect('admin/dashboard');
		}

		$valid 		= $this->form_validation;
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');

		$valid->set_rules('email', 'Email', 'trim|required');
		$valid->set_rules('password', 'Password', 'trim|required');;

		if ($valid->run()) {

			$this->db->select('*');
			$this->db->from('user_pendaftar');
			$this->db->where('email', $email);

			$user = $this->db->get()->row_array();

			// jika usernya ada
			if ($user) {
				// jika usernya aktif
				if ($user['status'] == 1) {
					// cek password
					if (password_verify($password, $user['password'])) {
						if($user['jenis_akun'] == 'user_downline'){
							$data = [
								'id' => $user['id_user_downline'],
								'nama' => $user['nama'],
								'nama_peternakan' => $user['nama_peternakan'],
								'email' => $user['email'],
								'no_telp' => $user['no_telp'],
								'jenis_akun' => $user['jenis_akun'],
								'tipe_user' => $user['tipe_user'],
								'id_peternakan' => $user['id_peternakan'],
							];
							$this->session->set_userdata($data);
							redirect('admin/dashboard');
						} else {
							$data = [
								'id' => $user['id'],
								'nama' => $user['nama'],
								'nama_peternakan' => $user['nama_peternakan'],
								'email' => $user['email'],
								'no_telp' => $user['no_telp'],
								'jenis_akun' => $user['jenis_akun'],
								'tipe_user' => $user['tipe_user'],
								'id_peternakan' => $user['id_peternakan'],
							];
							$this->session->set_userdata($data);
							redirect('admin/dashboard');
						}
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email / Password salah</div>');
						redirect('login');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum diaktifkan</div>');
					redirect('login');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun anda belum terdaftar</div>');
				redirect('login');
			}
		}
		// End validasi

		// $data = array(
		// 	'title'		=> 'Login Anggota',
		// 	'deskripsi'	=> 'Login Anggota',
		// 	'keywords'	=> 'Login Anggota',
		// 	'site'		=> $site,
		// 	'isi'		=> 'login/list'
		// );
		$data = array('title'		=> 'Halaman Login');
		$this->load->view('login/list', $data, FALSE);
	}

	private function _sendEmail($token, $type)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'berkarya686@gmail.com',
			'smtp_pass' => 'asking00',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];
		$this->load->library('email', $config);

		$this->email->initialize($config);

		$this->email->from('berkarya686@gmail.com', 'Admin Berkarya');
		$this->email->to($this->input->post('email'));

		if (
			$type == 'verify'
		) {
			$this->email->subject('Verifikasi akun');
			$this->email->message('Klik link untuk aktivasi akun : <a href="' . base_url() . 'admin/anggota/aktivasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activasi sekarang</a>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'masuk/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	public function lupa_password()
	{
		$site		= $this->konfigurasi_model->listing();
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$data = array(
				'title'		=> 'Login Anggota',
				'deskripsi'	=> 'Login Anggota',
				'keywords'	=> 'Login Anggota',
				'site'		=> $site,
				'menus'     => $this->menu_model->listing(),
				'isi'		=> 'masuk/lupa'
			);
			$this->load->view('layout2/wrapper', $data);
		} else {
			$email = $this->input->post('email');
			$user = $this->db->get_where('anggota', ['email' => $email, 'status' => 1])->row_array();

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token, 'forgot');

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Check kotak masuk pada email anda</div>');
				redirect('masuk/lupa_password');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email tidak terdaftar</div>');
				redirect('masuk/lupa_password');
			}
		}
	}


	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('anggota', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				$this->session->set_userdata('reset_email', $email);
				$this->changepassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal reset password. Token salah</div>');
				redirect('masuk');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password gagal, Email salah.</div>');
			redirect('masuk');
		}
	}


	public function changepassword()
	{
		$site		= $this->konfigurasi_model->listing();

		if (!$this->session->userdata('reset_email')) {
			redirect('masuk');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
			'matches' => 'Password tidak cocok',
			'min_length' => 'Password terlalu pendek.'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
			'matches' => 'Password tidak cocok',
			'min_length' => 'Password terlalu pendek.'
		]);

		if ($this->form_validation->run() == false) {
			$data = array(
				'title'		=> 'Ubah Password',
				'deskripsi'	=> 'Login Anggota',
				'keywords'	=> 'Login Anggota',
				'site'		=> $site,
				'menus'     => $this->menu_model->listing(),
				'isi'		=> 'masuk/ubah_password'
			);
			$this->load->view('layout2/wrapper', $data);
		} else {
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password', $password);
			$this->db->where('email', $email);
			$this->db->update('anggota');

			$this->session->unset_userdata('reset_email');

			$this->db->delete('user_token', ['email' => $email]);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil dirubah. Silahkan login</div>');
			redirect('masuk');
		}
	}

}
