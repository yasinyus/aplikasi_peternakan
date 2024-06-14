<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Pindah_kandang extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}

	function index_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}
		
		
		$id_flock = $this->get('id_flock');
		$id_peternakan_tujuan = $this->get('id_peternakan_tujuan');

		$this->db->where('id', $id_flock);
		$update =  $this->db->update('flock', array('peternakan_id' => $id_peternakan_tujuan));
		
		if ($update) {
			$this->response([
				'status' => true,
				'message' => 'Kandang Berhasil dipindahkan'
			], RestController::HTTP_OK);
		} else {
			$this->response([
				'status' => false,
				'message' => 'Kandang Gagal dipindahkan'
			], RestController::HTTP_BAD_REQUEST);
		}
	}
}
