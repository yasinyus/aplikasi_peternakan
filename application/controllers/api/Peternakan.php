<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Peternakan extends RestController
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

		$user_id 	= $this->get('user_id');
			$this->db->where('id_user', $user_id);
			// $this->db->limit(3);
			$this->db->order_by('id_peternakan', 'desc');
			$peternakan = $this->db->get('peternakan')->result();

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
			$this->db->where('id_user', $user_id);
			$this->db->limit(3);
			$this->db->order_by('id_peternakan', 'desc');
			$peternakan = $this->db->get('peternakan')->result();

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

	function info_get()
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
			$jml_peternakan = $this->db->query('select * from peternakan WHERE id_user = '.$user_id)->num_rows();
			$jml_flock= $this->db->query('select * from flock WHERE user_id = '.$user_id)->num_rows();
			$jml_kandang = $this->db->query('select * from kandang WHERE user_id = '.$user_id)->num_rows();

			$row_array['jumlah_peternakan'] = (int)$jml_peternakan;
			$row_array['jumlah_flock'] = (int)$jml_flock;
			$row_array['jumlah_kandang'] = (int)$jml_kandang;


			$json_response = $row_array;
			if ($json_response) {
				// Set the response and exit
				$this->response([
					'status' => TRUE,
					'message' => 'uccess',
					'data' => $json_response
	
				], RestController::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'uccess',
					'data' => null
	
				], RestController::HTTP_BAD_REQUEST);
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

		if (!empty($_FILES['gambar_peternakan']['name'])) {

			$config['upload_path'] = './assets/upload/gambar_peternakan';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = '5120';
			$config['file_name'] = $_FILES['gambar_peternakan']['name'];
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload('gambar_peternakan')) {
				$uploadData = $this->upload->data();
				$gambar_peternakan = $uploadData['file_name'];
			} else {
				$gambar_peternakan = $this->upload->display_errors();
			}
		} else {
			$gambar_peternakan = "default.jpg";
		}

		$data = array(
			'id_user' 	  		  	=> $this->input->post('id_user'),
			'nama_peternakan' 	  	=> $this->input->post('nama_peternakan'),
			'lokasi_peternakan' 	=> $this->input->post('lokasi_peternakan'),
			'prov'   			  => $this->input->post('nama_prov'),
				'kab'   			  => $this->input->post('nama_kab'),
				'kec'   			  => $this->input->post('nama_kec'),
				'kel'   			  => $this->input->post('nama_kel'),
				'alamat_lengkap'   	  => $this->input->post('alamat_lengkap'),
				'longitude'   		  => $this->input->post('longitude'),
				'latitude'   		  => $this->input->post('latitude'),
			'tipe_peternakan'     	=> $this->input->post('tipe_peternakan'),
			'deskripsi'     		=> $this->input->post('deskripsi'),
			'gambar_peternakan'    	=> base_url('assets/upload/gambar_peternakan/').$gambar_peternakan,
		);
		
        $insert = $this->db->insert('peternakan', $data);

		if ($insert) {
			$this->response([
				'status' => TRUE,
				'message' => 'Peternakan berhasil disimpan.',
				'data' => $data,
			], RestController::HTTP_OK);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}


}
