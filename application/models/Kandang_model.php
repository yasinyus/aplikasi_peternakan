<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kandang_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function list_kandang($id_flock)
	{
		$this->db->select('*');
		$this->db->from('kandang');
		$this->db->where('id_flock', $id_flock);
		$this->db->order_by('id', 'asc');
		$query = $this->db->get();
		return $query->result();
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
	public function detail_peternakan($id_peternakan)
	{
		$this->db->select('*');
		$this->db->from('peternakan');
		$this->db->where('id_peternakan', $id_peternakan);
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail_kandang($id_kandang)
	{
		$this->db->select('*');
		$this->db->from('kandang');
		$this->db->where('id', $id_kandang);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function insert($data)
	{
		$this->db->insert('peternakan', $data);
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
	public function delete($data_kandang)
	{
		$this->db->where('id_flock', $data_kandang['id_flock']);
		$this->db->delete('kandang', $data_kandang);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
