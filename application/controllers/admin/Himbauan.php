<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Himbauan extends CI_Controller
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
		$this->load->model('himbauan_model');
	}

	public function index()
	{
		$id_user 	= $this->session->userdata('id');
		$himbauan 	= $this->himbauan_model->list_himbauan($id_user);
		

		$data = array(
			'himbauan'		=> $himbauan,
			'isi'		=> 'admin/tabel_himbauan/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	
	public function tambah()
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();

		$data = array(
			'provinsi'  => $get_prov->result(),
			'isi'		=> 'admin/tabel_himbauan/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id_user' 	  		  	=> $this->input->post('id_user'),
				'judul' 	  			=> $this->input->post('judul'),
				'tipe'   				=> $this->input->post('tipe'),
				'detail'   		  		=> $this->input->post('detail'),
				'tanggal'   		 	=> $this->input->post('tanggal'),
				'created_at'     	  	=> date("Y-m-d H:i:s"),
			];
			
			$this->himbauan_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">Data Berhasil ditambahkan</a></div>');
			redirect(base_url('admin/himbauan'), 'refresh');
		}
	}

	public function edit($id_himbauan)
	{
		$himbauan 	= $this->himbauan_model->detail_himbauan($id_himbauan);

		$data = array(
			'himbauan'		=> $himbauan,
			'isi'		=> 'admin/tabel_himbauan/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id' 	  		=> $this->input->post('id'),
				'id_user' 	  	=> $this->input->post('id_user'),
				'judul'   		=> $this->input->post('judul'),
				'tipe' 	  		=> $this->input->post('tipe'),
				'detail'     	=> $this->input->post('detail')
			];
			
			$this->himbauan_model->update($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dirubah !
                                        </div>');
			redirect(base_url('admin/himbauan'), 'refresh');
		}
	}

	public function delete($id) {
		$data = array('id'	=> $id);
		$this->himbauan_model->delete($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/himbauan'), 'refresh');
	}



}

