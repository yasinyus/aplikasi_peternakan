<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Profil extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	function edit_put($id)
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

		if($this->put('password') != NULL){
			$data = array(
				'nama'      		=> $this->put('nama'),
				'nama_peternakan'   => $this->put('nama_peternakan'),
				'email'    			=> $this->put('email'),
				'no_telp'    		=> $this->put('no_telp'),
				'password'    		=> password_hash($this->put('password'), PASSWORD_DEFAULT),
			);
		} else {
			$data = array(
				'nama'      		=> $this->put('nama'),
				'nama_peternakan'   => $this->put('nama_peternakan'),
				'email'    			=> $this->put('email'),
				'no_telp'    		=> $this->put('no_telp'),
			);
		}

		$this->db->where('id', $id);
		$update =  $this->db->update('user_pendaftar', $data);
		if ($update) {
			$this->response([
				'status' => true,
				'message' => 'Profil Berhasil diupdate'
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Profil Gagal diupdate'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}
