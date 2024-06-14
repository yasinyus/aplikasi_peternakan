<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Notifikasi extends RestController
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


		// $this->db->where('id_berita', $id);
		$this->db->join('kategori', 'kategori.id_kategori = berita.id_kategori');
		$this->db->where('jenis_berita', 'Berita');
		// $berita = $this->db->get('berita')->result();
		$berita = $this->db->select('id_berita,judul_berita, gambar, tanggal, nama_kategori')->order_by('id_berita', "desc")->limit(5)->get('berita')->result();

		if ($berita == null) {
			$this->response("Data Not Found", 200);
		} else {
			$this->response($berita, 200);
		}
	}
}
