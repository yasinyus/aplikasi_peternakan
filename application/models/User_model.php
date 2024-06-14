<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	// load database
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Listing
	public function list_user()
	{
		$this->db->select('*');
		$this->db->from('user_pendaftar');
		// $this->db->where('jenis_akun', 'user');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing
	public function list_user_downline($id_user_downline)
	{
		$this->db->select('*');
		$this->db->from('user_pendaftar');
		$this->db->join('peternakan', 'peternakan.id_peternakan = user_pendaftar.id_peternakan');
		$this->db->where('jenis_akun', 'user_downline');
		$this->db->where('id_user_downline', $id_user_downline);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Listing
	public function listing()
	{
		$this->db->select('*');
		$this->db->from('user_pendaftar');
		// join
		// $this->db->join('bagian', 'bagian.id_bagian = user_pendaftar.id_bagian', 'left');
		// End join
		$this->db->order_by('user_pendaftar.id', 'desc');
		$query = $this->db->get();
		return $query->result();
	}

	// Total
	public function total()
	{
		$this->db->select('COUNT(*) AS total');
		$this->db->from('user_pendaftar');
		$query = $this->db->get();
		return $query->row();
	}

	// Login
	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('user_pendaftar');
		// join
		// $this->db->join('bagian', 'bagian.id_bagian = user_pendaftar.id_bagian', 'left');
		// End join
		// where
		$this->db->where(array(	'username'	=> $username,
								'password'	=> sha1($password)
							));
		$this->db->order_by('user_pendaftar.id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Detail
	public function detail($id)
	{
		$this->db->select('*');
		$this->db->from('user_pendaftar');
		$this->db->where('id', $id);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	// Tambah
	public function tambah($data)
	{
		$this->db->insert('user_pendaftar', $data);
	}

	// Tambah insert data
	public function tambah_user($data)
	{
		$this->db->insert('user_pendaftar', $data);
	}

	// Edit
	public function edit($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('user_pendaftar', $data);
	}

	// Delete
	public function delete($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('user_pendaftar', $data);
	}

	//Start: method tambahan untuk reset code  
    public function getUserInfo($id)
    {
        $q = $this->db->get_where('user_pendaftar', array('id' => $id), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        } else {
            error_log('no user found getUserInfo(' . $id . ')');
            return false;
        }
    }

    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('user_pendaftar', array('email' => $email), 1);
        if ($this->db->affected_rows() > 0) {
            $row = $q->row();
            return $row;
        }
    }

    public function insertToken($user_id)
    {
        $token = substr(sha1(rand()), 0, 30);
        $date = date('Y-m-d');

        $string = array(
            'token' => $token,
            'user_id' => $user_id,
            'created' => $date
        );
        $query = $this->db->insert_string('tokens', $string);
        $this->db->query($query);
        return $token . $user_id;
    }

    public function isTokenValid($token)
    {
        $tkn = substr($token, 0, 30);
        $uid = substr($token, 30);

        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn,
            'tokens.user_id' => $uid
        ), 1);

        if ($this->db->affected_rows() > 0) {
            $row = $q->row();

            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d');
            $todayTS = strtotime($today);

            if ($createdTS != $todayTS) {
                return false;
            }

            $user_info = $this->getUserInfo($row->user_id);
            return $user_info;
        } else {
            return false;
        }
    }

    public function updatePassword($post)
    {
        $this->db->where('id', $post['id']);
        $this->db->update('user_pendaftar', array('password' => $post['password']));
        return true;
    }
    //End: method tambahan untuk reset code  
}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
