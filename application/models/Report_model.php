<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function list_produksi_grower($filter)
	{
	
		// $this->db->select('*');
		$this->db->select('tanggal_prod');
		$this->db->select_sum('jml_total_ayam');
		$this->db->select_sum('jml_utuh_butir');
		$this->db->select_sum('jml_utuh_kg');
		$this->db->select_sum('sortir_butir');
		$this->db->select_sum('sortir_kg');
		$this->db->select_sum('bs_butir');
		$this->db->select_sum('bs_kg');
		$this->db->select_sum('cangkang_butir');
		$this->db->select_sum('cangkang_kg');
		$this->db->select_sum('pakan_kg');
		$this->db->select_sum('minum_liter');
		$this->db->select('bobot_ayam');
		$this->db->select_sum('mort');
		$this->db->select_sum('kematian');
		$this->db->select_sum('afkir');
		$this->db->select_sum('kematian');
		$this->db->select_sum('mort');
		$this->db->select_sum('pakan_gr_per_ekor');
		$this->db->select_sum('minum_ml_per_ekor');
		$this->db->select_sum('uniformity');
		$this->db->select_sum('perlakuan');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');

		if($filter['peternakan_id'] == "all"){

		} else if($filter['peternakan_id'] == "\0" || $filter['peternakan_id'] == NULL) {
			$this->db->where('produksi.peternakan_id', $filter['peternakan_id']);
		} else {
			$this->db->where('produksi.peternakan_id', $filter['peternakan_id']);
		}

		if($filter['flock_id'] != "" || $filter['flock_id'] != NULL){
			$this->db->where('produksi.flock_id', $filter['flock_id']);
		} else {}

		if($filter['kandang_id'] != "" || $filter['kandang_id'] != NULL){
			$this->db->where('produksi.kandang_id', $filter['kandang_id']);
		} else {}

		if($filter['tgl_awal'] != "" || $filter['tgl_awal'] != NULL){
			$this->db->where('DATE(tanggal_prod) >=',$filter['tgl_awal']); 
			$this->db->where('DATE(tanggal_prod) <=',$filter['tgl_akhir']);
		} else {} 

		$this->db->where('produksi.user_id', $this->session->userdata('id'));
		$this->db->where('produksi.jenis_produksi', 'grower');
		$this->db->group_by('tanggal_prod');
		$this->db->group_by('bobot_ayam');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_dashboard(){
		$this->db->select('nama_peternakan');
		$this->db->select('lokasi_peternakan');
		$this->db->select_sum('jml_utuh_butir');
		$this->db->select_sum('jml_utuh_kg');
		$this->db->select_sum('sortir_butir');
		$this->db->select_sum('sortir_kg');
		$this->db->select_sum('bs_butir');
		$this->db->select_sum('bs_kg');
		$this->db->select_sum('cangkang_butir');
		$this->db->select_sum('cangkang_kg');
		$this->db->select_sum('jml_total_ayam');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('user_id', $this->session->userdata('id'));
		$this->db->where('jenis_produksi', 'layer');
		$this->db->group_by('peternakan_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_produksi_layer($filter)
	{
	   // var_dump($filter);
	   // die();
		// $this->db->select('*');
		$this->db->select('tanggal_prod');
		$this->db->select_sum('pakan_gr_per_ekor');
		$this->db->select_sum('minum_ml_per_ekor');
		$this->db->select_sum('total_butir_telur');
		$this->db->select_sum('total_kg_telur');
		$this->db->select_sum('bobot_telur_gr_perbutir');
		$this->db->select_sum('bobot_telur_per_seribu_ekor');
		$this->db->select_sum('hd');
		$this->db->select_sum('fcr');
		$this->db->select_sum('mort');
		$this->db->select_sum('egg_mass_comulative');
		$this->db->select_sum('jml_total_ayam');
		$this->db->select_sum('jml_utuh_butir');
		$this->db->select_sum('jml_utuh_kg');
		$this->db->select_sum('sortir_butir');
		$this->db->select_sum('sortir_kg');
		$this->db->select_sum('bs_butir');
		$this->db->select_sum('bs_kg');
		$this->db->select_sum('cangkang_butir');
		$this->db->select_sum('cangkang_kg');
		$this->db->select_sum('pakan_kg');
		$this->db->select_sum('minum_liter');
		$this->db->select_sum('bobot_ayam');
		$this->db->select_sum('kematian');
		$this->db->select_sum('afkir');
		$this->db->select_sum('kematian');
		$this->db->select_sum('umur');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');

		if($filter['peternakan_id'] == "all"){
			
		} else if($filter['peternakan_id'] == "\0" || $filter['peternakan_id'] == NULL) {
			$this->db->where('produksi.peternakan_id', $filter['peternakan_id']);
		} else {
			$this->db->where('produksi.peternakan_id', $filter['peternakan_id']);
		}

		if($filter['flock_id'] != "" || $filter['flock_id'] != NULL){
			$this->db->where('produksi.flock_id', $filter['flock_id']);
		} else {}

		if($filter['kandang_id'] != "" || $filter['kandang_id'] != NULL){
			$this->db->where('produksi.kandang_id', $filter['kandang_id']);
		} else {}
		
		if($filter['periode'] != "" || $filter['periode'] != NULL){
			$this->db->where('tanggal_prod BETWEEN DATE_SUB(NOW(), INTERVAL '.$filter['periode'].' DAY) AND NOW()');
		} else {}

		if($filter['tgl_awal'] != "" || $filter['tgl_awal'] != NULL){
			$this->db->where('DATE(tanggal_prod) >=',$filter['tgl_awal']); 
			$this->db->where('DATE(tanggal_prod) <=',$filter['tgl_akhir']);
		} else {}

		
		
		$this->db->where('produksi.user_id', $this->session->userdata('id'));
		$this->db->where('produksi.jenis_produksi', 'layer');
		$this->db->group_by('tanggal_prod');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_produksi_layer_api($data_filter)
	{
		// $this->db->select('*');
		$this->db->select('tanggal_prod');
		$this->db->select_sum('jml_total_ayam');
		$this->db->select_sum('jml_utuh_butir');
		$this->db->select_sum('jml_utuh_kg');
		$this->db->select_sum('sortir_butir');
		$this->db->select_sum('sortir_kg');
		$this->db->select_sum('bs_butir');
		$this->db->select_sum('bs_kg');
		$this->db->select_sum('cangkang_butir');
		$this->db->select_sum('cangkang_kg');
		$this->db->select_sum('pakan_kg');
		$this->db->select_sum('minum_liter');
		$this->db->select_sum('bobot_ayam');
		$this->db->select_sum('kematian');
		$this->db->select_sum('afkir');
		$this->db->select_sum('kematian');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');

		if($data_filter['peternakan_id'] == "all"){

		} else if($data_filter['peternakan_id'] == "\0" || $data_filter['peternakan_id'] == NULL) {
			
		} else {
			$this->db->where('produksi.peternakan_id', $data_filter['peternakan_id']);
		}

		if($data_filter['flock_id'] != "" || $data_filter['flock_id'] != NULL){
			$this->db->where('produksi.flock_id', $data_filter['flock_id']);
		} else {}

		if($data_filter['kandang_id'] != "" || $data_filter['kandang_id'] != NULL){
			$this->db->where('produksi.kandang_id', $data_filter['kandang_id']);
		} else {}

		if($data_filter['tgl_awal'] != "" || $data_filter['tgl_awal'] != NULL){
			$this->db->where('DATE(tanggal_prod) >=',$data_filter['tgl_awal']); 
			$this->db->where('DATE(tanggal_prod) <=',$data_filter['tgl_akhir']);
		} else {}


		
		
		$this->db->where('produksi.user_id', $data_filter['user_id']);
		$this->db->where('produksi.jenis_produksi', 'layer');
		$this->db->group_by('tanggal_prod');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_peternakan() {
		$id_user 	= $this->session->userdata('id');
		$this->db->select('*');
		$this->db->from('peternakan');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->result();
	}

	public function list_peternakan_api($id_user) {
		$this->db->select('*');
		$this->db->from('peternakan');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		return $query->result();
	}

	// public function list_flock() {
	// 	$id_user 	= $this->session->userdata('id');
	// 	$this->db->select('*');
	// 	$this->db->select_sum('kandang.jumlah_ayam','total');
	// 	$this->db->from('flock');
	// 	$this->db->join('kandang', 'kandang.id = flock.flock_id', 'left');
	// 	$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id', 'left');
	// 	$this->db->where('flock.user_id', $id_user);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function jml_ayam($flock)
	{

		$this->db->select_sum('jumlah_ayam','total');
		$this->db->where('id_flock',$flock);
		$query = $this->db->get('kandang');
		$res = $query->row_array();
		//now SUM is available in $res['total']
		return $res['total'];

	}

	public function jml_kandang($flock)
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('kandang');
		$this->db->where('id_flock', $flock);
		$query = $this->db->get();
		return $query->row();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('users');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail_layer($id_prod_layer)
	{
		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		$this->db->where('id_produksi', $id_prod_layer);
		$query = $this->db->get();
		return $query->row();
	}
	
	// Get tanggal
	public function get_tanggal_for_fase_layer($id_peternakan)
	{
		$query = $this->db->select('tanggal_prod')->where('peternakan_id', $id_peternakan)->get('produksi')->result();
		$tanggal_produksi = array_column($query, 'tanggal_prod');
        return $tanggal_produksi	;
	}

	// Tambah
	public function insert_grower($data)
	{
		$this->db->insert('produksi', $data);
	}
	// Tambah
	public function insert_layer($data)
	{
		$this->db->insert('produksi', $data);
	}
	public function insert($data)
	{
		$this->db->insert('flock', $data);
	}
	// Tambah kandang
	public function insert_kandang($data2)
	{
		$this->db->insert('kandang', $data2);
	}

	// Tambah insert data
	public function tambah_user($data)
	{
		$this->db->insert('user_pendaftar', $data);
	}

	// Edit
	public function update($data)
	{
		$this->db->where('id_peternakan', $data['id_peternakan']);
		$this->db->update('peternakan', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_peternakan', $data['id_peternakan']);
		$this->db->delete('peternakan', $data);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
