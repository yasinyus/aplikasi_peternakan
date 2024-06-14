<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Login extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		// Load the user model
		// $this->load->model('Anggota_model');
	}
	

	function index_post()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}
		// Get the post data
		$email = $this->post('email');
		$password = $this->post('password');
		
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
							];
							$this->response([
								'status' => TRUE,
								'message' => 'Login Success!',
								'data' => $data,
							], RestController::HTTP_OK);
						} else {
							$data = [
								'id' => $user['id'],
								'nama' => $user['nama'],
								'nama_peternakan' => $user['nama_peternakan'],
								'email' => $user['email'],
								'no_telp' => $user['no_telp'],
								'tanggal_daftar' => $user['tanggal_daftar'],
							];
							$this->response([
								'status' => TRUE,
								'message' => 'Login Success!',
								'data' => $data,
							], RestController::HTTP_OK);
						}
					} else {
						$this->response([
							'status' => TRUE,
							'message' => 'Email atau Password Salah!',
						], RestController::HTTP_BAD_REQUEST);
					}
				} else {
					$this->response([
						'status' => TRUE,
						'message' => 'Akun belum diverifikasi!',
					], RestController::HTTP_BAD_REQUEST);
				}
			} else {
				$this->response([
					'status' => TRUE,
					'message' => 'Email Belum Terdaftar!',
				], RestController::HTTP_BAD_REQUEST);
			}
		}
	}

