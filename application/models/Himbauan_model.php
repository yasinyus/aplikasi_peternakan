<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Himbauan_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function list_himbauan($id_user)
	{
		$this->db->select('*');
		$this->db->from('himbauan');
		$this->db->where('id_user', $id_user);
		$this->db->order_by('id', 'desc');
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
	public function detail_himbauan($id)
	{
		$this->db->select('*');
		$this->db->from('himbauan');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function insert($data)
	{
		$this->db->insert('himbauan', $data);
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
		$this->db->update('himbauan', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('himbauan', $data);
	}
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
