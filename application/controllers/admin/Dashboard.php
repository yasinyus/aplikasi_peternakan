<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


	// load data
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('produksi_model');
		$this->load->model('dashboard_model');
	
		$url_pengalihan = str_replace('index.php/', '', current_url());
		$pengalihan 	= $this->session->set_userdata('pengalihan', $url_pengalihan);
	
		if($this->session->userdata('id') == "")
		{
			$this->session->set_flashdata('message', '<div class="alert bg-danger alert-danger text-white" role="alert">
                                          Anda Perlu Login !
                                        </div>');
			redirect(base_url('login'),'refresh');
		}
	}

	
	public function index()
	{
		$id_user 	= $this->session->userdata('id');
		

		$this->db->select('kel');
	  	$this->db->select('prov');
		$this->db->select_sum('jumlah_ayam', 'count');
		$this->db->from('kandang');
		$this->db->join('peternakan', 'peternakan.id_peternakan = kandang.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		// $this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('id_peternakan', $this->session->userdata('id_peternakan'));
		} 
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
 
      $record = $query->result();
      $data = [];
 
	  //PIE CHART
      foreach($record as $row) {
            $data['label'][] = $row->kel;
            $data['data'][] = (int) $row->count;
      }

	  	$this->db->select('kel');
	  	$this->db->select('prov');
		$this->db->select_avg('fcr');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
		$this->db->where('fcr <=', 3,00);
		// $this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		} 
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
 
      $record2 = $query->result();
      $data2 = [];
 
	  //BAR CHART
      foreach($record2 as $row) {
            $data2['label'][] = $row->kel;
            $data2['data'][] = (int) $row->fcr;
      }

	  	$this->db->select('kel');
	  	$this->db->select('prov');
		$this->db->select_sum('jml_total_ayam', 'count');
		$this->db->select_sum('jml_utuh_kg');
		$this->db->select_sum('sortir_kg');
		$this->db->select_sum('bs_kg');
		$this->db->select_sum('cangkang_kg');
		$this->db->select_sum('pakan_kg');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()');
		// $this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		} 
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
 
      $record3 = $query->result();
      $data3 = [];
 
      foreach($record3 as $row) {
		$total_seluruh_telurkg = $row->jml_utuh_kg + $row->sortir_kg + $row->bs_kg + $row->cangkang_kg;
		// $pakan = $row->pakan_kg;
		// $total_telur_kg = $pakan / $total_seluruh_telurkg;
            $data3['label'][] = $row->kel;
            $data3['data'][] = (int) $total_seluruh_telurkg;
      }

      $charts  = json_encode($data);
      $bar_charts  = json_encode($data2);
      $line_charts  = json_encode($data3);

	//   print_r($line_charts);
	//   die();
	$produksi_telurkg 	= $this->dashboard_model->list_produksi_telurkg();
	// $produksi_today 	= $this->dashboard_model->list_petenakan_today();
	// $produksi_yesterday 	= $this->dashboard_model->list_petenakan_yesterday();
	$produksi_mingguan1 	= $this->dashboard_model->list_petenakan_mingguan1();
	$produksi_mingguan2 	= $this->dashboard_model->list_petenakan_mingguan2();
	$produksi_mingguan_grower1 	= $this->dashboard_model->list_petenakan_mingguan_grower1();
	$produksi_mingguan_grower2 	= $this->dashboard_model->list_petenakan_mingguan_grower2();
	$produksi_bulanan1 	= $this->dashboard_model->list_petenakan_bulanan1();
	$produksi_bulanan2 	= $this->dashboard_model->list_petenakan_bulanan2();
	$produksi_bulanan_grower1 	= $this->dashboard_model->list_petenakan_bulanan_grower1();
	$produksi_bulanan_grower2 	= $this->dashboard_model->list_petenakan_bulanan_grower2();
	$last_update 	    = $this->dashboard_model->last_update();
	$last_update_grower 	    = $this->dashboard_model->last_update_grower();
		

		$data = array(
			'last_update'		    => $last_update,
			'last_update_grower'		    => $last_update_grower,
			'produksi_telurkg'		=> $produksi_telurkg,
			// 'produksi_today'		=> $produksi_today,
			// 'produksi_yesterday'	=> $produksi_yesterday,
			'produksi_mingguan1'	=> $produksi_mingguan1,
			'produksi_mingguan2'	=> $produksi_mingguan2,
			'produksi_bulanan1'		=> $produksi_bulanan1,
			'produksi_bulanan2'		=> $produksi_bulanan2,
			'produksi_mingguan_grower1'	=> $produksi_mingguan_grower1,
			'produksi_mingguan_grower2'	=> $produksi_mingguan_grower2,
			'produksi_bulanan_grower1'		=> $produksi_bulanan_grower1,
			'produksi_bulanan_grower2'		=> $produksi_bulanan_grower2,
			'chart_data'			=> $charts,
			'bar_chart'				=> $bar_charts,
			'line_chart'			=> $line_charts,
			'isi'					=> 'admin/beranda/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	
}

