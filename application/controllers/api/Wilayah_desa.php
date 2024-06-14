<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Wilayah_desa extends RestController
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

		$id = $this->get('kecamatan_id');
		if ($id == '') {
			$berita = $this->db->get('wilayah_desa')->result();
		} else {
			$this->db->where('kecamatan_id', $id);
			$berita = $this->db->get('wilayah_desa')->result();
		}

		if ($berita == null) {
			$this->response("Data With Id " . $id . " Not Found", 200);
		} else {
			$this->response($berita, 200);
		}
	}
}
