<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function list_produksi_telurkg (){
		$this->db->select('kel');
		$this->db->select('prov');
		// $this->db->select('tanggal_prod');
		$this->db->select_sum('total_kg_telur');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}


	public function list_petenakan_today (){
		$yesterday = date('Y-m-d');
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->where('tanggal_prod >=',  $yesterday);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_yesterday (){
		$yesterday = date('Y-m-d', strtotime('yesterday'));
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->where('tanggal_prod >=',  $yesterday);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_mingguan1 (){
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
// 		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()');
        $this->db->order_by('tanggal_prod', 'desc');
		$this->db->limit(7);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_mingguan_grower1 (){
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select('jml_total_ayam');
		$this->db->select('umur');
		$this->db->select('pakan_gr_per_ekor');
		$this->db->select('bobot_telur_gr_perbutir');
		$this->db->select('uniformity');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'grower');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
// 		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()');
        $this->db->order_by('tanggal_prod', 'desc');
		$this->db->limit(7);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_mingguan2 (){

        
		$lastweek1 = date('Y-m-d', strtotime('-7 days'));
		$lastweek2 = date('Y-m-d', strtotime('-14 days'));
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		// $this->db->where("tanggal_prod ", $lastweek);
		$this->db->where('tanggal_prod <=', $lastweek1);
		$this->db->where('tanggal_prod >=', $lastweek2);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_mingguan_grower2 (){

        
		$lastweek1 = date('Y-m-d', strtotime('-7 days'));
		$lastweek2 = date('Y-m-d', strtotime('-14 days'));
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'grower');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		// $this->db->where("tanggal_prod ", $lastweek);
		$this->db->where('tanggal_prod <=', $lastweek1);
		$this->db->where('tanggal_prod >=', $lastweek2);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_bulanan1 (){
		
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		// $this->db->where("tanggal_prod between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()");
// 		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
		$this->db->group_by('peternakan_id');
		$this->db->order_by('tanggal_prod', 'desc');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_bulanan_grower1 (){
		
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select('jml_total_ayam');
		$this->db->select('umur');
		$this->db->select('pakan_gr_per_ekor');
		$this->db->select('bobot_telur_gr_perbutir');
		$this->db->select('uniformity');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'grower');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		// $this->db->where("tanggal_prod between  DATE_FORMAT(CURDATE() ,'%Y-%m-01') AND CURDATE()");
// 		$this->db->where('tanggal_prod BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()');
		$this->db->group_by('peternakan_id');
		$this->db->order_by('tanggal_prod', 'desc');
		$this->db->limit(30);
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_bulanan2 (){
		$lastmonth1 = date('Y-m-d', strtotime('-30 day'));
		$lastmonth2 = date('Y-m-d', strtotime('-60 day'));
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->where('tanggal_prod <=', $lastmonth1);
		$this->db->where('tanggal_prod >=', $lastmonth2);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_petenakan_bulanan_grower2 (){
		$lastmonth1 = date('Y-m-d', strtotime('-30 day'));
		$lastmonth2 = date('Y-m-d', strtotime('-60 day'));
		$this->db->select('kel');
		$this->db->select('prov');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'grower');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->where('tanggal_prod <=', $lastmonth1);
		$this->db->where('tanggal_prod >=', $lastmonth2);
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function last_update() {
	    $this->db->select('tanggal_prod');
	    $this->db->from('produksi');
		$this->db->where('jenis_produksi', 'layer');
	    $this->db->order_by('tanggal_prod', 'desc');
		
		$query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $row = $query->row(); 
            return $row->tanggal_prod;
        }
	}

	public function last_update_grower() {
	    $this->db->select('tanggal_prod');
	    $this->db->from('produksi');
		$this->db->where('jenis_produksi', 'grower');
	    $this->db->order_by('tanggal_prod', 'desc');
		
		$query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $row = $query->row(); 
            return $row->tanggal_prod;
        }
	}

	
}

