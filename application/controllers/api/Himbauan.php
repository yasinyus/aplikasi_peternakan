<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Himbauan extends RestController
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

		$halaman = $_GET["row_per_page"]; /* page halaman*/
		$page    =isset($_GET["page"]) ? (int)$_GET["page"] : 1;
		$mulai    =($page>1) ? ($page * $halaman) - $halaman : 0;

			// echo $limitStart;
			// die();

			$user_id 	= $this->get('user_id');
			// $this->db->select('tipe as tipe_himbauan, judul as judul_himbauan, created_at as tanggal_himbauan, detail as detail_himbauan');
			$this->db->where('id_user', $user_id);
			// $this->db->order_by('id', 'desc');
			// $peternakan = $this->db->get('himbauan')->result();

			$query = "SELECT tipe as tipe_himbauan, judul as judul_himbauan, created_at as tanggal_himbauan, detail as detail_himbauan FROM himbauan WHERE tipe = 'himbauan' AND id_user = $user_id LIMIT $mulai, $halaman";
			$peternakan = $this->db->query($query)->result_array();

		if ($peternakan == null) {
			$this->response([
				'status' => FALSE,
				'message' => 'No data found',
				'data' => null
			], 404);
		} else {
			$this->response([
				'status' => TRUE,
				'message' => 'Success',
				'data' => $peternakan
			], RestController::HTTP_OK);
		}
	}
	function tiga_terbaru_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$user_id 	= $this->get('user_id');
			$this->db->select('tipe as tipe_himbauan, judul as judul_himbauan, created_at as tanggal_himbauan, detail as detail_himbauan');
			$this->db->where('id_user', $user_id);
			$this->db->limit(3);
			$this->db->order_by('id', 'desc');
			$peternakan = $this->db->get('himbauan')->result();

		if ($peternakan == null) {
			$this->response([
				'status' => FALSE,
				'message' => 'No data found',
				'data' => null
			], 404);
		} else {
			$this->response([
				'status' => TRUE,
				'message' => 'Success',
				'data' => $peternakan
			], RestController::HTTP_OK);
		}
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

		$data = array(
			'id_user' 	  	=> $this->input->post('id_user'),
			'judul' 	  	=> $this->input->post('judul_himbauan'),
			'tipe' 			=> $this->input->post('tipe_himbauan'),
			'detail' 		=> $this->input->post('detail_himbauan'),
			'created_at'    => date("Y-m-d H:i:s"),
		);
		
        $insert = $this->db->insert('himbauan', $data);

		if ($insert) {
			$this->response([
				'status' => TRUE,
				'message' => 'Himbauan berhasil disimpan.',
				'data' => $data,
			], RestController::HTTP_OK);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}


}
