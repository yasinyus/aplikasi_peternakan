<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flock_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function list_flock($id_user)
	{
		$this->db->select('*');
		$this->db->from('flock');
		$this->db->join('peternakan', 'id_peternakan = flock.peternakan_id');
		// $this->db->join('kandang', 'id_flock = flock.flock_id');
		$this->db->where('user_id', $id_user);
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$this->db->where('peternakan_id', $this->session->userdata('id_peternakan'));
		}
		$this->db->order_by('flock.id', 'desc');
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
	public function detail_flock($id_flock)
	{
		$this->db->select('*');
		$this->db->from('flock');
		$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id', 'LEFT');
		$this->db->where('flock_id', $id_flock);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function insert($data)
	{
		$this->db->insert('flock', $data);
	}
	// Tambah kandang
	public function insert_kandang($data2)
	{
		$this->db->insert('kandang', $data2);
	}

	public function update_kandang($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('kandang', $data);
	}

	// Tambah insert data
	public function tambah_user($data)
	{
		$this->db->insert('user_pendaftar', $data);
	}

	// Edit
	public function update($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('flock', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('flock', $data);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
