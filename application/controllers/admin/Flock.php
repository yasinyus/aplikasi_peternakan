<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flock extends CI_Controller
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
		$this->load->model('flock_model');
		$this->load->model('peternakan_model');
		$this->load->model('kandang_model');
	}

	public function index()
	{
		$id_user 	= $this->session->userdata('id');
		$flock 	= $this->flock_model->list_flock($id_user);
		

		$data = array(
			'flock'		=> $flock,
			'isi'		=> 'admin/flock/list'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function tambah()
	{
		$id_user 	= $this->session->userdata('id');
		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_peternakan', $this->session->userdata('id_peternakan'))->where('id_user', $id_user)->get();
		}else{
			$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();
		}
		
		$last_id = $this->db->query("SELECT id FROM flock ORDER BY id DESC LIMIT 1")->result(); 

		// var_dump($last_id);
		// echo $last_id[0]->id+1;
		// exit;

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'last_id'		=> $last_id,
			'isi'			=> 'admin/flock/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert()
	{

		if (isset($_POST['submit'])) {
			$data = [
				'id' 	  		  		=> $this->input->post('flock_id'),
				'user_id' 	  		  	=> $this->input->post('id_user'),
				'peternakan_id' 	  	=> $this->input->post('peternakan_id'),
				'lokasi' 	  			=> $this->input->post('lokasi'),
				'nama_flock' 	  		=> $this->input->post('nama_flock'),
				'kode_kandang' 	  		=> $this->input->post('kode_kandang'),
				'flock_id'   			=> $this->input->post('flock_id'),
				'usia_ayam'     		=> $this->input->post('usia_doc'),
				'strain'     			=> $this->input->post('strain'),
				'lokasi'     			=> $this->input->post('peternakan_id'),
				'tanggal'     			=> $this->input->post('tanggal'),
			];

			// insert kandang
			foreach($_POST['jumlah_ayam'] as $key=>$ja) 
			{
					$form_data = array(
						'id_flock' 			=> $_POST['flock_id'],
						'nama_kandang' 		=> $_POST['nama_kandang'][$key],
						'jumlah_ayam' 		=> $_POST['jumlah_ayam'][$key],
						'peternakan_id' 	=> $this->input->post('peternakan_id'),
						'user_id' 			=> $this->input->post('id_user'),
					);
					$this->flock_model->insert_kandang($form_data);
			}
			
			$this->flock_model->insert($data);
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil ditambahkan !
                                        </div>');
			redirect(base_url('admin/flock'), 'refresh');
		}
	}

	public function edit($id_flock)
	{
		$flock 	= $this->flock_model->detail_flock($id_flock);
		$id_user 	= $this->session->userdata('id');
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();
		$get_kandang = $this->db->select('*')->from('kandang')->where('id_flock', $id_flock)->get();

		// $peternakan 	= $this->peternakan_model->list_peternakan($id_user);

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'flock'			=> $flock,
			'kandang'		=> $get_kandang->result(),
			'isi'			=> 'admin/flock/edit'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function pindah($id_flock)
	{
		$flock 	= $this->flock_model->detail_flock($id_flock);
		$id_user 	= $this->session->userdata('id');
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Layer')->get();
		$get_kandang = $this->db->select('*')->from('kandang')->where('id_flock', $id_flock)->get();
		$jml_populasi = $this->db->select_sum('jumlah_ayam')->from('kandang')->where('id_flock', $id_flock)->get()->result();
		$last_id = $this->db->query("SELECT id FROM flock ORDER BY id DESC LIMIT 1")->result();

		// $peternakan 	= $this->peternakan_model->list_peternakan($id_user);

		// print_r($jml_populasi[0]);
		// die();

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'last_id'		=> $last_id,
			'flock'			=> $flock,
			'kandang'		=> $get_kandang->result(),
			'isi'			=> 'admin/flock/pindah'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function pindah_kan($id_kandang)
	{
		$this->db->where('id', $id_kandang);
    	$this->db->update('kandang', array('tipe_peternakan' => 'Fase Layer'));

		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Kandang Berhasil dipindahkan !
                                        </div>');
			redirect(base_url('admin/flock'), 'refresh');
	}

	public function edit_pindah()
	{
		// if (isset($_POST['submit'])) {
			$data = [
				'id' 	  		  		=> $this->input->get('flock_id'),
				'user_id' 	  		  	=> $this->input->get('id_user'),
				'peternakan_id' 	  	=> $this->input->get('peternakan_id'),
				'lokasi' 	  			=> $this->input->get('peternakan_id'),
				'nama_flock' 	  		=> $this->input->get('nama_flock'),
				'kode_kandang' 	  		=> $this->input->get('kode_kandang'),
				'flock_id'   			=> $this->input->get('flock_id'),
				'usia_ayam'     		=> $this->input->get('usia_ayam'),
				'strain'     			=> $this->input->get('strain'),
				'status'     			=> $this->input->get('status'),
				'tanggal'     			=> $this->input->get('tanggal'),
			];

			$data_pindah = [
				'id' 	  		  		=> $this->input->get('flock_id_pindah'),
				'user_id' 	  		  	=> $this->input->get('id_user'),
				'peternakan_id' 	  	=> $this->input->get('peternakan_id_tujuan'),
				'lokasi' 	  			=> $this->input->get('peternakan_id_tujuan'),
				'nama_flock' 	  		=> $this->input->get('nama_flock'),
				'kode_kandang' 	  		=> $this->input->get('kode_kandang'),
				'flock_id'   			=> $this->input->get('flock_id_pindah'),
				'usia_ayam'     		=> $this->input->get('usia_ayam'),
				'strain'     			=> $this->input->get('strain'),
				'status'     			=> $this->input->get('status'),
				'tanggal'     			=> $this->input->get('tanggal'),
			];

			$this->db->where('id_flock', $this->input->get('flock_id'));
			$this->db->delete('kandang');

			// insert kandang baru
			foreach($_GET['jumlah_ayam'] as $key=>$ja) 
			{
					$form_data = array(
						'id_flock' 			=> $_GET['flock_id'],
						'nama_kandang' 		=> $_GET['nama_kandang'][$key],
						'jumlah_ayam' 		=> $_GET['jumlah_ayam'][$key],
						'peternakan_id' 	=> $this->input->get('peternakan_id'),
						'user_id' 			=> $this->input->get('id_user'),
					);
					$this->flock_model->insert_kandang($form_data);
			}
			// insert kandang pindah
			foreach($_GET['jumlah_ayam_tujuan'] as $key=>$ja) 
			{
					$form_data = array(
						'id_flock' 			=> $_GET['flock_id_pindah'],
						'nama_kandang' 		=> $_GET['nama_kandang_tujuan'][$key],
						'jumlah_ayam' 		=> $_GET['jumlah_ayam_tujuan'][$key],
						'peternakan_id' 	=> $this->input->get('peternakan_id_tujuan'),
						'user_id' 			=> $this->input->get('id_user'),
					);
					$this->flock_model->insert_kandang($form_data);
			}

			
			$this->db->where('id', $this->input->get('flock_id'));
			$this->db->delete('flock');
			$this->flock_model->insert($data);
			$this->flock_model->insert($data_pindah);
			
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dipindah !
                                        </div>');
			redirect(base_url('admin/flock'), 'refresh');

		// if (isset($_POST['submit'])) {
		// 	$data = [
		// 		'id' 	  		  		=> $this->input->post('flock_id'),
		// 		'peternakan_id' 	  	=> $this->input->post('peternakan_id'),
		// 		'lokasi' 	  			=> $this->input->post('peternakan_id'),
		// 	];

		// 	$this->flock_model->update($data);
			
		// 	$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
        //                                   Flock Berhasil dipindah !
        //                                 </div>');
		// 	redirect(base_url('admin/flock'), 'refresh');
		// }
	}

	public function view($id_flock)
	{
		$flock 	= $this->flock_model->detail_flock($id_flock);
		$id_user 	= $this->session->userdata('id');
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();
		$get_kandang = $this->db->select('*')->from('kandang')->where('id_flock', $id_flock)->get();

		// $peternakan 	= $this->peternakan_model->list_peternakan($id_user);

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'flock'			=> $flock,
			'kandang'		=> $get_kandang->result(),
			'isi'			=> 'admin/flock/view'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function view_kandang($id_flock)
	{
		$flock 	= $this->flock_model->detail_flock($id_flock);
		$id_user 	= $this->session->userdata('id');
		$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->get();
		$get_kandang = $this->db->select('*')->from('kandang')->where('id_flock', $id_flock)->get();

		// $peternakan 	= $this->peternakan_model->list_peternakan($id_user);

		$data = array(
			'peternakan'	=> $get_peternakan->result(),
			'flock'			=> $flock,
			'kandang'		=> $get_kandang->result(),
			'isi'			=> 'admin/flock/view_kandang'
		);
		
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert_edit()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id' 	  		  		=> $this->input->post('flock_id'),
				'user_id' 	  		  	=> $this->input->post('id_user'),
				'peternakan_id' 	  	=> $this->input->post('peternakan_id'),
				'lokasi' 	  			=> $this->input->post('peternakan_id'),
				'nama_flock' 	  		=> $this->input->post('nama_flock'),
				'kode_kandang' 	  		=> $this->input->post('kode_kandang'),
				'flock_id'   			=> $this->input->post('flock_id'),
				'usia_ayam'     		=> $this->input->post('usia_ayam'),
				'strain'     			=> $this->input->post('strain'),
				'status'     			=> $this->input->post('status'),
				'tanggal'     			=> $this->input->post('tanggal'),
			];

			$this->db->where('id_flock', $this->input->post('flock_id'));
			$this->db->delete('kandang');

			// insert kandang baru
			foreach($_POST['jumlah_ayam'] as $key=>$ja) 
			{
					$form_data = array(
						'id_flock' 			=> $_POST['flock_id'],
						'nama_kandang' 		=> $_POST['nama_kandang'][$key],
						'jumlah_ayam' 		=> $_POST['jumlah_ayam'][$key],
						'peternakan_id' 	=> $this->input->post('peternakan_id'),
						'user_id' 			=> $this->input->post('id_user'),
					);
					$this->flock_model->insert_kandang($form_data);
			}

			
			$this->db->where('id', $this->input->post('flock_id'));
			$this->db->delete('flock');
			$this->flock_model->insert($data);
			
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil diupdate !
                                        </div>');
			redirect(base_url('admin/flock'), 'refresh');
		}
	}

	public function delete($id_flock) {
		$data = array('id'	=> $id_flock);
		$data_kandang = array('id_flock' => $id_flock);
		$this->flock_model->delete($data);
		$this->kandang_model->delete($data_kandang);
		$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil dihapus !
                                        </div>');
			redirect(base_url('admin/flock'), 'refresh');
	}

	function add_ajax_get_flock($peternakan_id)
	{
		$user_id = $this->session->userdata('id');
		$query = $this->db->get_where('flock', array('peternakan_id' => $peternakan_id, 'user_id' => $user_id));
		$data = "<option value=''>All</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama_flock . "</option>";
		}
		echo $data;
	}

	function add_ajax_kandang_layer($id_flock)
	{
		$query = $this->db->get_where('kandang', array('id_flock' => $id_flock));
		$data = "<option value=''>All</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama_kandang . "</option>";
		}
		echo $data;
	}

	function add_ajax_kandang_grower($id_flock)
	{
		$query = $this->db->get_where('kandang', array('id_flock' => $id_flock));
		$data = "<option value=''>All</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->nama_kandang . "</option>";
		}
		echo $data;
	}

	function get_ajax_tgl_last_produksi($kandang_id)
	{
		$this->db->where('kandang_id',$kandang_id);
		$query = $this->db->get('produksi');
		if ($query->num_rows() > 0){
			$query = $this->db->order_by('tanggal_prod', 'DESC')->limit(1)->get_where('produksi', array('kandang_id' => $kandang_id));
			foreach ($query->result() as $value) {
				$data = "<span> Tanggal Input Terakhir " . date('d/m/Y', strtotime($value->tanggal_prod)) . "</span>";
			}
			echo $data;
		} else {
			$data = "<span></span>";
			echo $data;
		}
	}

	function get_ajax_tgl_awal($kandang_id)
	{
		$query = null; //emptying in case 
		$query = $this->db->get_where('produksi', array(//making selection
            'peternakan_id' => $kandang_id
        ));
		$count = $query->num_rows(); //counting result from query
		if ($count === 0) {
			$html = '<input type="date" class="form-control" name="tgl_awal" id="tgl_awal">';
			echo $html;
		} else {
			$tgl_awal = $this->db->select('tanggal_prod')->order_by('tanggal_prod', 'ASC')->limit(1)
                  ->get_where('produksi', array(
						'peternakan_id' => $kandang_id,
						'user_id' => $this->session->userdata('id')
						))
                  ->row()
                  ->tanggal_prod;
			$tgl_akhir = $this->db->select('tanggal_prod')->order_by('tanggal_prod', 'DESC')->limit(1)
                  ->get_where('produksi', array('peternakan_id' => $kandang_id))
                  ->row()
                  ->tanggal_prod;
			$html = '<input type="date" class="form-control" name="tgl_awal" id="tgl_awal"  min="'.$tgl_awal.'" max="'.$tgl_akhir.'">';
			echo $html;
		}
	}
	function get_ajax_tgl_akhir($kandang_id)
	{
		$query = null; //emptying in case 
		$query = $this->db->get_where('produksi', array(//making selection
            'peternakan_id' => $kandang_id
        ));
		$count = $query->num_rows(); //counting result from query
		if ($count === 0) {
			$html = '<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir">';
			echo $html;
		} else {
			$tgl_awal = $this->db->select('tanggal_prod')->order_by('tanggal_prod', 'ASC')->limit(1)
				->get_where('produksi', array(
						'peternakan_id' => $kandang_id,
						'user_id' => $this->session->userdata('id')
						))
                  ->row()
                  ->tanggal_prod;
			$tgl_akhir = $this->db->select('tanggal_prod')->order_by('tanggal_prod', 'DESC')->limit(1)
                  ->get_where('produksi', array('peternakan_id' => $kandang_id))
                  ->row()
                  ->tanggal_prod;
			$html = '<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" min="'.$tgl_awal.'" max="'.$tgl_akhir.'">';
			echo $html;
		}
	}



}

