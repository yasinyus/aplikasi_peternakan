<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{

	// Database
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('id') == "")
		{
			$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Anda Perlu Login !
                                        </div>');
			redirect(base_url('login'),'refresh');
		}
		$this->load->model('produksi_model');
		$this->load->model('flock_model');
		$this->load->model('peternakan_model');
		$this->load->model('kandang_model');
	}

	public function grower()
	{
		$id_user 	= $this->session->userdata('id');
		
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$produksi 	= $this->produksi_model->list_produksi_grower($id_user);
		} else {
			$produksi 	= $this->produksi_model->list_produksi_grower($id_user);
		}
		

		$data = array(
			'produksi'		=> $produksi,
			'isi'		=> 'admin/produksi_grower/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function layer()
	{
		$id_user 	= $this->session->userdata('id');
		$produksi 	= $this->produksi_model->list_produksi_layer($id_user);
		
		

		$data = array(
			'produksi'		=> $produksi,
			'isi'		=> 'admin/produksi_layer/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function tambah_grower()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);
		if($this->session->userdata('tipe_user') == 'admin_input'){ 
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Grower')
			->where('id_peternakan', $this->session->userdata('id_peternakan'))
			->get();
		} else {
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Grower')
			->get();
		}

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'flock'		=> $flock,
			'isi'		=> 'admin/produksi_grower/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function tambah_grower_lagi()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Grower')->get();

		$get_pt = $this->db->select('*')->from('peternakan')->where('id_peternakan', $this->input->get('id_pt'))->get()->row_array();
		$get_fl = $this->db->select('*')->from('flock')->where('id', $this->input->get('id_fl'))->get()->row_array();
		$get_kd = $this->db->select('*')->from('kandang')->where('id', $this->input->get('id_kd'))->get()->row_array();

		$data = array(
			'get_peternakan'	=> $get_pt['nama_peternakan'],
			'get_flock'			=> $get_fl['nama_flock'],
			'get_kandang'		=> $get_kd['nama_kandang'],
			'peternakan'	=> $get_peternakan->result(),
			'flock'		=> $flock,
			'isi'		=> 'admin/produksi_grower/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function tambah_layer()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user') { 
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Layer')
			->where('id_peternakan', $this->session->userdata('id_peternakan'))
			->get();
		} else {
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Layer')
			->get();
		}

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'flock'		=> $flock,
			'isi'		=> 'admin/produksi_layer/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function tambah_layer_lagi()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Layer')->get();

		$get_pt = $this->db->select('*')->from('peternakan')->where('id_peternakan', $this->input->get('id_pt'))->get()->row_array();
		$get_fl = $this->db->select('*')->from('flock')->where('id', $this->input->get('id_fl'))->get()->row_array();
		$get_kd = $this->db->select('*')->from('kandang')->where('id', $this->input->get('id_kd'))->get()->row_array();

		$data = array(
			'get_peternakan'	=> $get_pt['nama_peternakan'],
			'get_flock'			=> $get_fl['nama_flock'],
			'get_kandang'		=> $get_kd['nama_kandang'],
			'peternakan'		=> $get_peternakan->result(),
			'flock'				=> $flock,
			'isi'				=> 'admin/produksi_layer/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert_grower()
	{
		$this->db->select('*');
			$this->db->from('produksi');
			$this->db->where('tanggal_prod', $this->input->post('tanggal_prod'));
			$this->db->where('kandang_id', $this->input->post('kandang_id'));
			$user = $this->db->get()->row_array();

			if ($user) {
				$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Data produksi sudah pernah diinput !
                                        </div>');
				$tgl_prods = date('d/m/Y', strtotime($this->input->post('tanggal_prod')));
				$this->session->set_flashdata('error_tgl', 'Produksi tanggal '. $tgl_prods .' sudah pernah diinput');
				redirect(base_url('admin/produksi/tambah_grower_lagi?id_pt='.$this->input->post('peternakan_id').'&id_fl='.$this->input->post('flock_id').'&id_kd='.$this->input->post('kandang_id')), 'refresh');
			} else {
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
			if (isset($_POST['submit'])) {
				$data = [
					'user_id' 			=> $this->input->post('user_id'),
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
					'jenis_produksi'    => "grower",
					'nama_obat'     	=> $this->input->post('nama_obat'),
					'nama_pakan'     	=> $this->input->post('nama_pakan'),
					'vitamin'     	    => $this->input->post('vitamin'),
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
				$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
											Data Berhasil ditambahkan !
											</div>');
				redirect(base_url('admin/produksi/grower'), 'refresh');
				// redirect(base_url('admin/produksi/tambah_grower_lagi?id_pt='.$this->input->post('peternakan_id').'&id_fl='.$this->input->post('flock_id').'&id_kd='.$this->input->post('kandang_id')), 'refresh');
				
			}
		}
	}

	public function insert_layer()
	{

			$this->db->select('*');
			$this->db->from('produksi');
			$this->db->where('tanggal_prod', $this->input->post('tanggal_prod'));
			$this->db->where('kandang_id', $this->input->post('kandang_id'));
			$user = $this->db->get()->row_array();

			if ($user) {
				$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Data produksi sudah pernah diinput !
                                        </div>');
										$tgl_prods = date('d/m/Y', strtotime($this->input->post('tanggal_prod')));
										$this->session->set_flashdata('error_tgl', 'Produksi tanggal '. $tgl_prods .' sudah pernah diinput');
				redirect(base_url('admin/produksi/tambah_layer_lagi?id_pt='.$this->input->post('peternakan_id').'&id_fl='.$this->input->post('flock_id').'&id_kd='.$this->input->post('kandang_id')), 'refresh');
			} else {

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

			$total_kg_telur =  $this->input->post('jml_utuh_kg') + $this->input->post('sortir_kg') ;
			
				// $total_kg_telur =  $this->input->post('jml_utuh_kg') + $this->input->post('sortir_kg') + $this->input->post('bs_kg') + $this->input->post('cangkang_kg');   
				
			$total_butir_telur =  $this->input->post('jml_utuh_butir') + $this->input->post('sortsortir_butirir_kg');                                                              
			$bobot_telur_gr_perbutir = $total_kg_telur / $total_butir_telur;
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
			$fcr = $this->input->post('pakan_kg') / $total_kg_telur;

			$q = $this->db->select('*')->from('flock')->where('id', $this->input->post('flock_id'))->get()->row();
			

			$doc_in = new DateTime($q->tanggal);
			$tgl_prod = new DateTime($this->input->post('tanggal_prod'));
			$d = $tgl_prod->diff($doc_in)->days;

			$umur_hari = $d + $q->usia_ayam;
			$umur_week = round($umur_hari / 7, 1);
			
			$pakan = $this->input->post('pakan_kg');
			$pakan_gr_perekor = $pakan / $sisa_ayam;
			$minum = $this->input->post('minum_liter');
			$minum_ml_perekor = $minum / $sisa_ayam;
			
// 			echo $pakan .' -- ' . $sisa_ayam. ' -- ' .$pakan_gr_perekor * 1000 ;
// 			die();
			
	        
			
			

			if (isset($_POST['submit'])) {
				$data = [
					'user_id' 			=> $this->input->post('user_id'),
					'peternakan_id' 	=> $this->input->post('peternakan_id'),
					'flock_id' 	  		=> $this->input->post('flock_id'),
					'kandang_id' 		=> $this->input->post('kandang_id'),
					'tanggal_prod'     	=> $this->input->post('tanggal_prod'),
					'jml_utuh_butir' 	=> $this->input->post('jml_utuh_butir'),
					'jml_utuh_kg' 		=> $this->input->post('jml_utuh_kg'),
					'sortir_butir' 		=> $this->input->post('sortir_butir'),
					'sortir_kg' 		=> $this->input->post('sortir_kg'),
					'bs_butir' 			=> $this->input->post('bs_butir'),
					'bs_kg' 			=> $this->input->post('bs_kg'),
					'cangkang_butir' 	=> $this->input->post('cangkang_butir'),
					'cangkang_kg' 		=> $this->input->post('cangkang_kg'),

					'umur' 							=> $umur_week,
					'total_kg_telur' 				=> $total_kg_telur,
					'total_butir_telur' 			=> $total_butir_telur,
					'bobot_telur_gr_perbutir' 		=> $bobot_telur_gr_perbutir * 1000,
					'bobot_telur_per_seribu_ekor' 	=> $bobot_telur_per_seribu_ekor,
					'hd' 							=> $hd,
					'hh' 							=> $hh,
					'fcr' 							=> $fcr,
					'egg_mass_comulative' 			=> $egg_mass_comulative,
					'mort' 							=> $mort,
					
					'pakan_kg' 	  		=> $pakan,
					'pakan_gr_per_ekor' => $pakan_gr_perekor * 1000,
					'minum_liter'   	=> $minum,
					'minum_ml_per_ekor' => $minum_ml_perekor * 1000,
					'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
					'kematian'     		=> $this->input->post('kematian'),
					'afkir'     		=> $this->input->post('afkir'),

					'jml_total_ayam'    => $sisa_ayam,
					// 'uniformity'     	=> $this->input->post('uniformity'),
					'perlakuan'     	=> $this->input->post('perlakuan'),
					'jenis_produksi'    => "layer",
					'nama_obat'     	=> $this->input->post('nama_obat'),
					'nama_pakan'     	=> $this->input->post('nama_pakan'),
					'vitamin'     	    => $this->input->post('vitamin'),
				];
				
				// echo $pakan_gr_perekor * 1000 . ' - ' . $minum_ml_perekor * 1000;
	   //         die();
				
				

				$data_update_flock = [
					'id' 	  			=> $this->input->post('flock_id'),
					'flock_terisi' 	  		=> '1',
				];
				$data_update_peternakan = [
					'id_peternakan' => $this->input->post('peternakan_id'),
					'terisi' 	  	=> '1',
				];

				$this->peternakan_model->update($data_update_peternakan);
				$this->db->set('jumlah_ayam', $sisa_ayam);
				$this->db->set('last_update', date('Y-m-d H:i:s'));
				$this->db->where('id', $data['kandang_id']);
				$this->db->update('kandang');

				$this->flock_model->update($data_update_flock);
				$this->produksi_model->insert_layer($data);
				
				
				$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
											Data Berhasil ditambahkan !
											</div>');
				redirect(base_url('admin/produksi/layer'), 'refresh');
				// redirect(base_url('admin/produksi/tambah_layer_lagi?id_pt='.$this->input->post('peternakan_id').'&id_fl='.$this->input->post('flock_id').'&id_kd='.$this->input->post('kandang_id').'&tgl_last='.$this->input->post('tanggal_prod')), 'refresh');
					
				}
			}
	
		
		
	}

	public function lihat_produksi_layer($id_produksi_layer)
	{
		$id_user 	= $this->session->userdata('id');
		$produksi_layer = $this->produksi_model->detail_layer($id_produksi_layer);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();

		$data = array(
			'produksi_layer'		=> $produksi_layer,
			'peternakan'			=> $get_peternakan->result(),
			'isi'					=> 'admin/produksi_layer/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function lihat_produksi_grower($id_produksi_grower)
	{
		$id_user 	= $this->session->userdata('id');
		$produksi_grower = $this->produksi_model->detail_layer($id_produksi_grower);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();

		$data = array(
			'produksi_grower'		=> $produksi_grower,
			'peternakan'			=> $get_peternakan->result(),
			'isi'					=> 'admin/produksi_grower/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update_layer($id_produksi_layer)
	{
		$id_user 	= $this->session->userdata('id');
		$produksi_layer = $this->produksi_model->detail_layer($id_produksi_layer);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();

		$data = array(
			'produksi_layer'		=> $produksi_layer,
			'peternakan'			=> $get_peternakan->result(),
			'isi'					=> 'admin/produksi_layer/edit_layer'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update_grower($id_produksi_grower)
	{
		$id_user 	= $this->session->userdata('id');
		$produksi_grower = $this->produksi_model->detail_grower($id_produksi_grower);
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();

		$data = array(
			'produksi_grower'		=> $produksi_grower,
			'peternakan'			=> $get_peternakan->result(),
			'isi'					=> 'admin/produksi_grower/edit_grower'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update_layer_post()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id_produksi' 	  	=> $this->input->post('id_produksi'),
				// 'peternakan_id' 	=> $this->input->post('peternakan_id'),
				// 'flock_id' 	  		=> $this->input->post('flock_id'),
				// 'kandang_id'   		=> $this->input->post('kandang_id'),
				// 'tanggal_prod'   	=> $this->input->post('tanggal_prod'),
				'jml_utuh_butir'    => $this->input->post('jml_utuh_butir'),
				'jml_utuh_kg'     	=> $this->input->post('jml_utuh_kg'),
				'sortir_butir'     	=> $this->input->post('sortir_butir'),
				'sortir_kg'     	=> $this->input->post('sortir_kg'),
				'bs_butir'     		=> $this->input->post('bs_butir'),
				'bs_kg'     		=> $this->input->post('bs_kg'),
				'cangkang_butir'    => $this->input->post('cangkang_butir'),
				'cangkang_kg'     	=> $this->input->post('cangkang_kg'),
				'pakan_kg'     		=> $this->input->post('pakan_kg'),
				'minum_liter'     	=> $this->input->post('minum_liter'),
				'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
				'kematian'     		=> $this->input->post('kematian'),
				'afkir'     		=> $this->input->post('afkir'),
				'perlakuan'     	=> $this->input->post('perlakuan'),
				'nama_obat'     	=> $this->input->post('nama_obat'),
				'nama_pakan'     	=> $this->input->post('nama_pakan'),
				'vitamin'     	    => $this->input->post('vitamin'),
			];
			
			$this->produksi_model->update($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dirubah !
                                        </div>');
			redirect(base_url('admin/produksi/layer'), 'refresh');
		}
	}

	public function update_grower_post()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id_produksi' 	  	=> $this->input->post('id_produksi'),
				// 'peternakan_id' 	=> $this->input->post('peternakan_id'),
				// 'flock_id' 	  		=> $this->input->post('flock_id'),
				// 'kandang_id'   		=> $this->input->post('kandang_id'),
				// 'tanggal_prod'   	=> $this->input->post('tanggal_prod'),
				
				'pakan_kg'     		=> $this->input->post('pakan_kg'),
				'minum_liter'     	=> $this->input->post('minum_liter'),
				'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
				'kematian'     		=> $this->input->post('kematian'),
				'afkir'     		=> $this->input->post('afkir'),
				'uniformity'     	=> $this->input->post('uniformity'),
				'perlakuan'     	=> $this->input->post('perlakuan'),
				'nama_obat'     	=> $this->input->post('nama_obat'),
				'nama_pakan'     	=> $this->input->post('nama_pakan'),
				'vitamin'     	    => $this->input->post('vitamin'),
			];
			
			$this->produksi_model->update($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dirubah !
                                        </div>');
			// redirect(base_url('admin/produksi/grower'), 'refresh');
		}
	}

	public function delete_layer($id_produksi) {
		$data = array('id_produksi'	=> $id_produksi);
		$this->produksi_model->delete($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/produksi/layer'), 'refresh');
	}

	public function delete_grower($id_produksi) {
		$data = array('id_produksi'	=> $id_produksi);
		$this->produksi_model->delete($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/produksi/grower'), 'refresh');
	}



}

