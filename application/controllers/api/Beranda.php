<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Beranda extends RestController
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

			$user_id 			= $this->get('user_id');

			$json_response = array();

			// $this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
			// $this->db->where('peternakan.tipe_peternakan', 'Fase Grower');
			
			$query_layer = $this->db->select_sum('jumlah_ayam','total');
			$query_layer = $this->db->join('peternakan', 'peternakan.id_peternakan = kandang.peternakan_id', 'left');
			$query_layer = $this->db->where('peternakan.tipe_peternakan', 'Fase Layer');
			$query_layer = $this->db->where('user_id',$user_id);
			$query_layer = $this->db->get('kandang');
			$res = $query_layer->row_array();
			$jml_ayam_layer = $res['total'];

			

			$query_grower = $this->db->select_sum('jumlah_ayam','total');
			$query_grower = $this->db->join('peternakan', 'peternakan.id_peternakan = kandang.peternakan_id', 'left');
			$query_grower = $this->db->where('peternakan.tipe_peternakan', 'Fase Grower');
			$query_grower = $this->db->where('user_id',$user_id);
			$query_grower = $this->db->get('kandang');
			$ress = $query_grower->row_array();
			$jml_ayam_grower = $ress['total'];

			$jumlah_telur = $this->db->query("SELECT AVG(jml_utuh_kg) AS jumlah_telur_rata_rata_perhari FROM produksi WHERE user_id = $user_id")->row(); 
			$jumlah_telur_kg = $this->db->select_sum('jml_utuh_kg','total_telur');
			$jumlah_telur_kg = $this->db->where('user_id',$user_id);
			$jumlah_telur_kg = $this->db->where('jenis_produksi', 'layer');
			$jumlah_telur_kg = $this->db->get('produksi');
			$res = $jumlah_telur_kg->row_array();
			$jml_telur = $res['total_telur'];

			$jumlah_telur_butir = $this->db->select_sum('jml_utuh_butir');
			$jumlah_telur_butir = $this->db->select_sum('sortir_butir');
			$jumlah_telur_butir = $this->db->select_sum('bs_butir');
			$jumlah_telur_butir = $this->db->select_sum('cangkang_butir');
			$jumlah_telur_butir = $this->db->where('user_id',$user_id);
			$jumlah_telur_butir = $this->db->where('jenis_produksi', 'layer');
			$jumlah_telur_butir = $this->db->get('produksi');
			$ress = $jumlah_telur_butir->row_array();
			$jml_telur_butir = $ress['jml_utuh_butir'] + $ress['sortir_butir'] + $ress['bs_butir'] + $ress['cangkang_butir'];
			
			
			$jumlah_pakan_kg = $this->db->select_sum('pakan_kg','total_pakan');
			$jumlah_pakan_kg = $this->db->where('user_id',$user_id);
			$jumlah_pakan_kg = $this->db->where('jenis_produksi', 'layer');
			$jumlah_pakan_kg = $this->db->get('produksi');
			$res = $jumlah_pakan_kg->row_array();
			$jml_pakan = $res['total_pakan'];

			if($jml_telur == NULL){
				$fcr = 0;
			} else {
				$fcr =  @($jml_pakan/$jml_telur);
			}

			if($jml_telur == 0){
				$fcr = 0;
			} else {
				$fcr =  @($jml_pakan/$jml_telur);
			}

			if($jml_ayam_layer == NULL){
				$jml_ayam_layer_jadi = 0;
			} else {
				$jml_ayam_layer_jadi = $jml_ayam_layer;
			}
			
			if($jml_ayam_grower == NULL){
				$jml_ayam_grower_jadi = 0;
			} else {
				$jml_ayam_grower_jadi = $jml_ayam_grower;
			}

			if($jumlah_telur->jumlah_telur_rata_rata_perhari == NULL){
				$jumlah_telur_rata_rata_perhari = 0;
			} else {
				$jumlah_telur_rata_rata_perhari = $jumlah_telur->jumlah_telur_rata_rata_perhari;
			}

			$row_array['total_ayam'] = $jml_ayam_grower+$jml_ayam_layer;
			$row_array['total_ayam_fase_layer'] = (int)$jml_ayam_layer_jadi;
			$row_array['total_ayam_fase_grower'] = (int)$jml_ayam_grower_jadi;
			$row_array['total_accumulate_telur'] = round($jumlah_telur_rata_rata_perhari, 2);
			$row_array['total_fcr'] = round($fcr,2);
			$row_array['jumlah_butir_telur'] = $jml_telur_butir;


			$json_response = $row_array;
		if ($json_response) {
			// Set the response and exit
			$this->response([
				'status' => TRUE,
				'message' => 'Load Success',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("Error.", RestController::HTTP_BAD_REQUEST);
		}

	}

	public function performa_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

			$user_id 			= $this->get('user_id');

			$json_response = array();

			$jumlah_telur_kg = $this->db->select_sum('total_kg_telur','total_telur');
			$jumlah_telur_kg = $this->db->where('user_id',$user_id);
			$jumlah_telur_kg = $this->db->where('jenis_produksi', 'layer');
			$jumlah_telur_kg = $this->db->get('produksi');
			$res = $jumlah_telur_kg->row_array();
			$jml_telur = $res['total_telur'];

			$jumlah_telur_kg_mingguini = $this->db->select_sum('total_kg_telur','total_telur');
			$jumlah_telur_kg_mingguini = $this->db->where('user_id',$user_id);
			$jumlah_telur_kg_mingguini = $this->db->where('jenis_produksi', 'layer');
			$jumlah_telur_kg_mingguini = $this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()');
			$jumlah_telur_kg_mingguini = $this->db->get('produksi');
			$ress = $jumlah_telur_kg_mingguini->row_array();
			$jml_telur_minguini = $ress['total_telur'];

			$mingguini_hari = $this->db->select('tanggal_prod, total_kg_telur');
			$mingguini_hari = $this->db->where('user_id',$user_id);
			$mingguini_hari = $this->db->where('jenis_produksi', 'layer');
			$mingguini_hari = $this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()');
			$mingguini_hari = $this->db->get('produksi');
			$resss = $mingguini_hari->result_array();
			
			// var_dump($resss);
			// die();

			$row_array['total_kg'] = $jml_telur;
			$row_array['kg_minggu_ini'] = $jml_telur_minguini;
			$row_array['hari'] = $resss;


			$json_response = $row_array;
		if ($json_response) {
			// Set the response and exit
			$this->response([
				'status' => TRUE,
				'message' => 'Load Succes',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("Error.", RestController::HTTP_BAD_REQUEST);
		}

	}
	

	


}
