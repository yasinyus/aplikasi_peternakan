<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produksi_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function list_produksi_grower($id_user)
	{
		$first_date = date('Y-m-d', strtotime(' -90 day'));
		$second_date = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('produksi.user_id', $id_user);
		$this->db->where('jenis_produksi', 'grower');
		$this->db->where('tanggal_prod >=', $first_date);
		$this->db->where('tanggal_prod <=', $second_date);
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('produksi.peternakan_id', $this->session->userdata('id_peternakan'));
		} 
		$this->db->order_by('tanggal_prod', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	public function list_produksi_grower_seminggu($id_user)
	{
		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		// $this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('produksi.user_id', $id_user);
		$this->db->where('jenis_produksi', 'grower');
		// $this->db->where('peternakan.tipe_peternakan', 'Fase Grower');
		// $this->db->where('tanggal_prod BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
		$query = $this->db->get();
		return $query->result();
	}
	// Listing
	public function list_produksi_layer($id_user)
	{
		$first_date = date('Y-m-d', strtotime(' -90 day'));
		$second_date = date('Y-m-d');

		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		$this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('produksi.user_id', $id_user);
		$this->db->where('jenis_produksi', 'layer');
// 		$this->db->where('tanggal_prod >=', $first_date);
// 		$this->db->where('tanggal_prod <=', $second_date);
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('produksi.peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->order_by('tanggal_prod', 'desc');
		$query = $this->db->get();
		return $query->result();
	}
	public function list_produksi_layer_seminggu($id_user)
	{
		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		// $this->db->join('peternakan', 'peternakan.id_peternakan = produksi.peternakan_id', 'left');
		$this->db->where('produksi.user_id', $id_user);
		$this->db->where('jenis_produksi', 'layer');
		// $this->db->where('peternakan.tipe_peternakan', 'Fase Layer');
		// $this->db->where('tanggal_prod BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
		// $this->db->order_by('id_grower', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

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

	// Detail
	public function detail_grower($id_prod_grower)
	{
		$this->db->select('*');
		$this->db->from('produksi');
		$this->db->join('flock', 'flock.flock_id = produksi.flock_id', 'left');
		$this->db->join('kandang', 'kandang.id = produksi.kandang_id', 'left');
		$this->db->where('id_produksi', $id_prod_grower);
		$query = $this->db->get();
		return $query->row();
	}

	public function select_kandang($id_kandang)
	{
		$this->db->select('jumlah_ayam');
		$this->db->from('kandang');
		$this->db->where('id', $id_kandang);
		$query = $this->db->get();
		return $query->row();
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
		$this->db->where('id_produksi', $data['id_produksi']);
		$this->db->update('produksi', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id_produksi', $data['id_produksi']);
		$this->db->delete('produksi', $data);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
