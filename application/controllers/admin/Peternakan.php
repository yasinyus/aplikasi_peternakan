<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peternakan extends CI_Controller
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
		$this->load->model('peternakan_model');
	}

	public function index()
	{
		$id_user 	= $this->session->userdata('id');
		$peternakan 	= $this->peternakan_model->list_peternakan($id_user);
		

		$data = array(
			'peternakan'		=> $peternakan,
			'isi'		=> 'admin/tabel_peternakan/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	function add_ajax_kab($id_prov)
	{
		$query = $this->db->get_where('wilayah_kabupaten', array('provinsi_id' => $id_prov));
		$data = "<option value=''>- Pilih Kota/Kab -</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
		}
		echo $data;
	}

	function add_ajax_kec($id_kab)
	{
		$query = $this->db->get_where('wilayah_kecamatan', array('kabupaten_id' => $id_kab));
		$data = "<option value=''> -  Pilih Kecamatan - </option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
		}
		echo $data;
	}

	function add_ajax_des($id_kec)
	{
		$query = $this->db->get_where('wilayah_desa', array('kecamatan_id' => $id_kec));
		$data = "<option value=''> - Pilih Desa - </option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama . "</option>";
		}
		echo $data;
	}

	public function tambah()
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();

		$data = array(
			'provinsi'  => $get_prov->result(),
			'isi'		=> 'admin/tabel_peternakan/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id_user' 	  		  => $this->input->post('id_user'),
				'nama_peternakan' 	  => $this->input->post('nama_peternakan'),
				'lokasi_peternakan'   => $this->input->post('lokasi_peternakan'),
				'prov'   			  => $this->input->post('nam_prov'),
				'kab'   			  => $this->input->post('nam_kab'),
				'kec'   			  => $this->input->post('nam_kec'),
				'kel'   			  => $this->input->post('nam_kel'),
				'alamat_lengkap'   	  => $this->input->post('full_address'),
				'longitude'   		  => $this->input->post('longitude'),
				'latitude'   		  => $this->input->post('latitude'),
				'tipe_peternakan'     => $this->input->post('tipe_peternakan'),
				'deskripsi'     	  => $this->input->post('deskripsi'),
			];
			
			$this->peternakan_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">Data Berhasil ditambahkan, Silahkan tambah FLock <a href="'.base_url('admin/flock/tambah').'" style="color:yellow">Disini !</a></div>');
			redirect(base_url('admin/peternakan'), 'refresh');
		}
	}

	public function edit($id_peternakan)
	{
		$get_prov = $this->db->select('*')->from('wilayah_provinsi')->get();
		$peternakan 	= $this->peternakan_model->detail_peternakan($id_peternakan);

		$data = array(
			'provinsi' 		=> $get_prov->result(),
			'peternakan'	=> $peternakan,
			'isi'			=> 'admin/tabel_peternakan/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update()
	{
		if (isset($_POST['submit'])) {
			if($this->input->post('prov') == "" || $this->input->post('prov') == NULL) {
				$data = [
					'id_peternakan' 	  => $this->input->post('id_peternakan'),
					'id_user' 	  		  => $this->input->post('id_user'),
					'nama_peternakan'     => $this->input->post('nama_peternakan'),
					'lokasi_peternakan'   => $this->input->post('lokasi_peternakan'),
			
					'longitude'   		  => $this->input->post('longitude'),
					'latitude'   		  => $this->input->post('latitude'),
					'tipe_peternakan'     => $this->input->post('tipe_peternakan'),
					'deskripsi'     	  => $this->input->post('deskripsi'),
				];
			} else {
				$data = [
					'id_peternakan' 	  => $this->input->post('id_peternakan'),
					'id_user' 	  		  => $this->input->post('id_user'),
					'nama_peternakan'     => $this->input->post('nama_peternakan'),
					'lokasi_peternakan'   => $this->input->post('lokasi_peternakan'),
					'prov'   			  => $this->input->post('nam_prov'),
					'kab'   			  => $this->input->post('nam_kab'),
					'kec'   			  => $this->input->post('nam_kec'),
					'kel'   			  => $this->input->post('nam_kel'),
					'alamat_lengkap'   	  => $this->input->post('full_address'),
					'longitude'   		  => $this->input->post('longitude'),
					'latitude'   		  => $this->input->post('latitude'),
					'tipe_peternakan'     => $this->input->post('tipe_peternakan'),
					'deskripsi'     	  => $this->input->post('deskripsi'),
				];
			}
			
			$this->peternakan_model->update($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dirubah !
                                        </div>');
			redirect(base_url('admin/peternakan'), 'refresh');
		}
	}

	public function delete($id_peternakan) {
		$data = array('id_peternakan'	=> $id_peternakan);
		$this->peternakan_model->delete($data);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/peternakan'), 'refresh');
	}



}

