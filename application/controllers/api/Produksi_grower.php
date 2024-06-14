<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Produksi_grower extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('produksi_model');
		$this->load->model('flock_model');
		$this->load->model('peternakan_model');
		$this->load->model('kandang_model');
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

			$jml_ayam_perkandang = $this->kandang_model->detail_kandang($this->input->post('kandang_id'))->jumlah_ayam;
				if($this->input->post('kematian') == "" || $this->input->post('kematian') == NULL){
					$ayam_mati = 0;
				} else {
					$ayam_mati = $this->input->post('kematian');
				}
				if($this->input->post('afkir') == "" || $this->input->post('afkir') == NULL){
					$ayam_afkir = 0;
				} else {
					$ayam_afkir = $this->input->post('afkir');
				}
	
				$jml_ayam_berkurang = $ayam_mati + $ayam_afkir;
				$sisa_ayam = $jml_ayam_perkandang - $jml_ayam_berkurang;
	
				$total_kg_telur =  $this->input->post('jml_utuh_kg') + $this->input->post('sortir_kg') + $this->input->post('bs_kg') + $this->input->post('cangkang_kg');                                                              
				$total_butir_telur =  $this->input->post('jml_utuh_butir') + $this->input->post('sortsortir_butirir_kg') + $this->input->post('bs_butir') + $this->input->post('cangkang_butir');                                                              
				// $bobot_telur_gr_perbutir = $total_kg_telur / $total_butir_telur;
				$pop_per_Seribu = $sisa_ayam / 1000;
				$bobot_telur_per_seribu_ekor  = $total_kg_telur / $pop_per_Seribu;
				$pop_butir_dibagi_pop_ayam = $total_butir_telur / $sisa_ayam;
				$hd = $pop_butir_dibagi_pop_ayam * 100;
				$populasi_umur_18_week = $this->input->post('umur');
				$kematian_afkir = $this->input->post('kematian') + $this->input->post('afkir');
				$kematian_afkir_dibagi_pop_ayam = $kematian_afkir / $jml_ayam_perkandang;
	
				if($populasi_umur_18_week >= 18){
					$hh = $total_butir_telur / $populasi_umur_18_week;
					$egg_mass_comulative = $populasi_umur_18_week / $jml_ayam_perkandang;
					$mort = $kematian_afkir_dibagi_pop_ayam * 100;
				} else {
					$hh = 0;
					$egg_mass_comulative = 0;
					$mort = 0;
				}
				$fcr = $total_kg_telur / $this->input->post('pakan_kg');
	
				$q = $this->db->select('*')->from('flock')->where('id', $this->input->post('flock_id'))->get()->row();
				
	
				$doc_in = new DateTime($q->tanggal);
				$tgl_prod = new DateTime($this->input->post('tanggal_prod'));
				$d = $tgl_prod->diff($doc_in)->days;
	
				$umur_hari = $d + $q->usia_ayam;
				$umur_week = round($umur_hari / 7, 1);
			
				$data = [
					'user_id' 			=> $this->input->post('id_user'),
					'peternakan_id' 	=> $this->input->post('peternakan_id'),
					'flock_id' 	  		=> $this->input->post('flock_id'),
					'kandang_id' 		=> $this->input->post('kandang_id'),
					'tanggal_prod'     	=> $this->input->post('tanggal_prod'),

					'umur' 				=> $umur_week,
					'pakan_kg' 	  		=> $this->input->post('pakan_kg'),
					'pakan_gr_per_ekor' => $this->input->post('pakan_kg') /  $jml_ayam_perkandang,
					'minum_liter'   	=> $this->input->post('minum_liter'),
					'minum_ml_per_ekor' => $this->input->post('minum_liter') / $jml_ayam_perkandang,
					'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
					'kematian'     		=> $this->input->post('kematian'),
					'afkir'     		=> $this->input->post('afkir'),

					'jml_total_ayam'    => $sisa_ayam,
					// 'sisa_ayam_perkandang'    => $jml_ayam_perkandang,
					'uniformity'     	=> $this->input->post('uniformity'),
					'perlakuan'     	=> $this->input->post('perlakuan'),
					'jenis_produksi'    => "grower"
				];

				$data_update_flock = [
					'id' 	  		=> $this->input->post('flock_id'),
					'flock_terisi' 	  	=> '1',
				];
				$data_update_peternakan = [
					'id_peternakan' => $this->input->post('peternakan_id'),
					'terisi' 	  	=> '1',
				];

				$this->peternakan_model->update($data_update_peternakan);
				$this->flock_model->update($data_update_flock);
				$this->produksi_model->insert_grower($data);

				// $jml_ayam_awal = $this->flock_model->jml_ayam($this->input->post('flock_id'));
				// $jml_ayam_akhir = $this->input->post('kematian') + $this->input->post('afkir');
				$this->db->set('jumlah_ayam', $sisa_ayam);
				$this->db->set('last_update', date('Y-m-d H:i:s'));
				$this->db->where('id', $data['kandang_id']);
				$this->db->update('kandang');
// 		if ($insert) {
			$this->response([
				'status' => TRUE,
				'message' => 'Produksi berhasil disimpan.',
				'data' => $data,
			], RestController::HTTP_OK);
	
	}

}
