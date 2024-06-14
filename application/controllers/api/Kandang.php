<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Kandang extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('flock_model');
		$this->load->model('kandang_model');
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

			$user_id 		= $this->get('user_id');
			$peternakan_id 	= $this->get('peternakan_id');
			$flock_id 	= $this->get('flock_id');
			$this->db->where('user_id', $user_id);
			$this->db->where('peternakan_id', $peternakan_id);
			$this->db->where('id_flock', $flock_id);
			$kandang = $this->db->get('kandang')->result();

		$json_response = $kandang;
	
		if ($json_response) {
			// Set the response and exit
			$this->response([
				'status' => TRUE,
				'message' => 'successful.',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("id tidak ditemukan.", RestController::HTTP_BAD_REQUEST);
		}

	}

	function detail_flock_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$flock_id 		= $this->get('flock_id');
			$this->db->where('flock_id', $flock_id);
			$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id', 'left');
			$flock = $this->db->get('flock')->result();
			$json_response = array();
			foreach ($flock as $row) {
			// $row_array = (array) $row;
			$id_flock = $row->id;
			$kandang = $this->db->query("SELECT id,id_flock, nama_kandang, jumlah_ayam, tipe_ayam, last_update FROM kandang  WHERE id_flock = $id_flock ");
			
			$this->db->select_sum('jumlah_ayam','total');
			$this->db->where('id_flock',$id_flock);
			$query = $this->db->get('kandang');
			$res = $query->row_array();
			$jml_ayam = $res['total'];

			$this->db->select_sum('kematian','total_mati');
			$this->db->where('flock_id',$id_flock);
			$query = $this->db->get('produksi');
			$res = $query->row_array();
			$jml_ayam_mati = $res['total_mati'];

			$this->db->select_sum('afkir','total_afkir');
			$this->db->where('flock_id',$id_flock);
			$query = $this->db->get('produksi');
			$res = $query->row_array();
			$jml_ayam_afkir = $res['total_afkir'];

			$new_val = (($jml_ayam_mati + $jml_ayam_afkir) / $jml_ayam) * 100 ;

			$this->db->select_sum('jml_utuh_kg','total_utuh_kg');
			$this->db->where('flock_id',$id_flock);
			$query = $this->db->get('produksi');
			$res = $query->row_array();
			$total_telur_kg = $res['total_utuh_kg'];

			$com_egg_mass = $total_telur_kg / $jml_ayam;

			
			$tanggal = new DateTime($row->tanggal);
			$today = new DateTime('today');
			$d = $today->diff($tanggal)->d;
			foreach ($kandang->result_array() as $sm) {
				$row_array['lokasi'] = $row->lokasi_peternakan;
				$row_array['populasi_awal'] = $jml_ayam;
				$row_array['populasi_sekarang'] = $jml_ayam-$jml_ayam_mati-$jml_ayam_afkir;
				$row_array['deplesi'] = round($new_val, 2) . ' %';
				$row_array['komulatif_egg_mass'] = round($com_egg_mass * 1000, 2);
				$row_array['usia_ayam'] = $d + $row->usia_ayam . ' Hari';
				$row_array['chick_in'] = $row->tanggal;
				$row_array['kandang'][] = $sm;
			}
			$json_response[] = $row_array;

		if ($json_response) {
			$this->response([
				'status' => TRUE,
				'message' => 'successful.',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("id tidak ditemukan.", RestController::HTTP_BAD_REQUEST);
		}
			}

			

	}

	function detail_kandang_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$flock_id 		= $this->get('flock_id');
			$kandang_id 	= $this->get('kandang_id');
			$this->db->where('flock_id', $flock_id);
			$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id', 'left');
			$flock = $this->db->get('flock')->result();

			$json_response = array();
			foreach ($flock as $row) {
				$this->db->select('jumlah_ayam');
				$this->db->where('id',$kandang_id);
				$query = $this->db->get('kandang');
				$res = $query->row_array();
				$jml_ayam = $res['jumlah_ayam'];

				$this->db->select_sum('kematian','total_mati');
				$this->db->where('kandang_id',$kandang_id);
				$query = $this->db->get('produksi');
				$res = $query->row_array();
				$jml_ayam_mati = $res['total_mati'];

				$this->db->select_sum('afkir','total_afkir');
				$this->db->where('kandang_id',$kandang_id);
				$query = $this->db->get('produksi');
				$res = $query->row_array();
				$jml_ayam_afkir = $res['total_afkir'];

				$new_val = (($jml_ayam_mati + $jml_ayam_afkir) / $jml_ayam) * 100 ;

				$this->db->select_sum('jml_utuh_kg','total_utuh_kg');
				$this->db->where('kandang_id',$kandang_id);
				$query = $this->db->get('produksi');
				$res = $query->row_array();
				$total_telur_kg = $res['total_utuh_kg'];

				$com_egg_mass = $total_telur_kg / $jml_ayam;

				$this->db->select('tipe_ayam');
				$this->db->where('id',$kandang_id);
				$query = $this->db->get('kandang');
				$res = $query->row_array();
				$tipe_ayam = $res['tipe_ayam'];

				$tanggal = new DateTime($row->tanggal);
				$today = new DateTime('today');
				$d = $today->diff($tanggal)->d;
					$row_array['lokasi'] = $row->lokasi_peternakan;
					$row_array['populasi_awal'] = $jml_ayam;
					$row_array['populasi_sekarang'] = $jml_ayam-$jml_ayam_mati-$jml_ayam_afkir;
					$row_array['deplesi'] = round($new_val , 2) . ' %';
					$row_array['komulatif_egg_mass'] = round($com_egg_mass, 2) * 1000;
					$row_array['usia_ayam'] = $d;
					$row_array['chick_in'] = $row->tanggal;
					$row_array['strain'] = $tipe_ayam;
				$json_response[] = $row_array;
		}
		if ($json_response) {
			$this->response([
				'status' => TRUE,
				'message' => 'successful.',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("id tidak ditemukan", RestController::HTTP_BAD_REQUEST);
		}

	}

	function detail_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$id_flock 		= $this->get('flock_id');
			$this->db->where('id', $id_flock);
			$flock = $this->db->get('flock')->result();

		$json_response = array();
		foreach ($flock as $row) {
			$row_array = (array) $row;
			$id_flock = $row->id;
			$kandang = $this->db->query("SELECT id,id_flock, nama_kandang, jumlah_ayam, tipe_ayam FROM kandang WHERE id_flock = '$id_flock' ");
			
			$this->db->select_sum('jumlah_ayam','total');
			$this->db->where('id_flock',$id_flock);
			$query = $this->db->get('kandang');
			$res = $query->row_array();
			//now SUM is available in $res['total']
			$jml_ayam = $res['total'];

			foreach ($kandang->result_array() as $sm) {
				$row_array['nama_flock'] = $row_array['nama_flock'];
				$row_array['jumlah_ayam'] = $jml_ayam;
				$row_array['kandang'][] = $sm;
			}
			$json_response[] = $row_array;
		}
		if ($json_response) {
			// Set the response and exit
			$this->response([
				'status' => TRUE,
				'message' => 'successful.',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("id tidak ditemukan.", RestController::HTTP_BAD_REQUEST);
		}

	}

	function hapus_flock_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$id_flock 		= $this->get('flock_id');
			$data = array('id'	=> $id_flock);
			$data_kandang = array('id_flock' => $id_flock);
			

			$this->db->where('id',$id_flock);
			$query = $this->db->get('flock');
			if (!empty($query->result_array())){
				$this->flock_model->delete($data);
				$this->kandang_model->delete($data_kandang);

				$this->response([
					'status' => TRUE,
					'message' => 'deleted.'
	
				], RestController::HTTP_OK);
			}
			else{
				$this->response([
					'status' => FALSE,
					'message' => 'id flock not found.'
	
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
		$last_id = $this->db->query("SELECT id FROM flock ORDER BY id DESC LIMIT 1")->result();
		

		$data = array(
			'id'   					=> $last_id[0]->id+1,
			'user_id' 	  		  	=> $this->input->post('user_id'),
			'peternakan_id' 	  	=> $this->input->post('peternakan_id'),
			'nama_flock' 	  		=> $this->input->post('nama_flock'),
			'kode_kandang' 	  		=> $this->input->post('kode_kandang'),
			'flock_id'   			=> $last_id[0]->id+1,
			'usia_ayam'     		=> $this->input->post('usia_ayam'),
			// 'doc_in' 				=> date('Y-m-d H:i:s'),
			'tanggal'     			=> $this->input->post('tanggal'),
		);

			// insert kandang
			foreach($_POST['jumlah_ayam'] as $key=>$ja) 
			{
					$form_data = array(
						'id_flock'			=> $last_id[0]->id+1,
						'nama_kandang' 		=> $_POST['nama_kandang'][$key],
						'jumlah_ayam' 		=> $_POST['jumlah_ayam'][$key],
						'tipe_ayam' 		=> $_POST['tipe_ayam'][$key],
						'peternakan_id' 	=> $this->input->post('peternakan_id'),
						'user_id' 			=> $this->input->post('user_id'),
						// 'tipe_peternakan' 	=> $_POST['tipe_peternakan'][$key],
						
					);
					$this->db->insert('kandang', $form_data);
					
			}
		
		
        $insert = $this->db->insert('flock', $data);

		if ($insert) {
			$this->response([
				'status' => TRUE,
				'message' => 'Produksi berhasil disimpan.',
				'data' => $data,

			], RestController::HTTP_OK);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}


}
