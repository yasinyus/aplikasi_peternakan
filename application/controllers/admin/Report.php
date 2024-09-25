<?php
defined('BASEPATH') or exit('No direct script access allowed');

// LOAD EXCEL
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

// END LOAD EXCEL

class Report extends CI_Controller
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
		$this->load->model('report_model');
		$this->load->model('flock_model');
		$this->load->model('peternakan_model');
		$this->load->model('kandang_model');
		$this->load->database();
	}

	public function fase_grower()
	{
		$id_user 	= $this->session->userdata('id');
		$filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'		=> $this->input->get('tgl_awal'),
			'tgl_akhir'		=> $this->input->get('tgl_akhir'),
		);

		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Grower')
			->where('id_peternakan', $this->session->userdata('id_peternakan'))
			->get();
		} else {
			$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Grower')->get();

		}
		// $get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Grower')->get();
		// if($this->input->get('peternakan_id') && $this->input->get('flock_id')){
			// $produksi = $this->db->select('*')
			// // $produksi = $this->db->select_sum('umur')->select_sum('jml_total_ayam')
			// ->from('produksi')
			// ->where('user_id', $id_user)
			// ->where('peternakan_id', $filter['peternakan_id'])
			// ->where('flock_id', $filter['flock_id'])
			// ->where('kandang_id', $filter['kandang_id'])
			// ->where('DATE(tanggal_prod) >=',$filter['tgl_awal'])
			// ->where('DATE(tanggal_prod) <=',$filter['tgl_akhir'])
			// ->get();
			$id_peternakan = $get_peternakan->result()[0]->id_peternakan;
			$tanggal_prod 	= $this->report_model->get_tanggal_for_fase_layer($id_peternakan);
			$produksi_grower 	= $this->report_model->list_produksi_grower($filter);
			$data = array(
				'tanggal_prod'		=> $tanggal_prod,
				'peternakan'	=> $get_peternakan->result(),
				'produksi'		=> $produksi_grower,
				'isi'		=> 'admin/report/list_grower'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		// }

		// $produksi 	= $this->report_model->list_produksi_grower($data_filter);
		// $data = array(
		// 	'peternakan'	=> $get_peternakan->result(),
		// 	// 'produksi'		=> $produksi,
		// 	'isi'		=> 'admin/report/list_grower'
		// );
		// $this->load->view('layout/wrapper', $data, FALSE);
	}

	public function fase_layer()
	{
		$id_user 	= $this->session->userdata('id');
		$filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		=> $this->input->get('periode'),
			'tgl_awal'		=> $this->input->get('tgl_awal'),
			'tgl_akhir'		=> $this->input->get('tgl_akhir'),
		);

		if($this->session->userdata('tipe_user') == 'admin_input' || $this->session->userdata('tipe_user') == 'super_user'){ 
			$get_peternakan = $this->db->select('*')->from('peternakan')
			->where('id_user', $id_user)
			->where('tipe_peternakan', 'Fase Layer')
			->where('id_peternakan', $this->session->userdata('id_peternakan'))
			->get();
		} else {
			$get_peternakan = $this->db->select('*')->from('peternakan')->where('id_user', $id_user)->where('tipe_peternakan', 'Fase Layer')->get();

		}
// 		if($this->input->get('peternakan_id') && $this->input->get('flock_id')){
// 			$produksi = $this->db->select('*')
// 			// $produksi = $this->db->select_sum('umur')->select_sum('jml_total_ayam')
// 			->from('produksi')
// 			->where('user_id', $id_user)
// 			->where('peternakan_id', $filter['peternakan_id'])
// 			->where('flock_id', $filter['flock_id'])
// 			->where('kandang_id', $filter['kandang_id'])
// 			->where('DATE(tanggal_prod) >=',$filter['tgl_awal'])
// 			->where('DATE(tanggal_prod) <=',$filter['tgl_akhir'])
// 			->get();

			$id_peternakan = $get_peternakan->result()[0]->id_peternakan;
			$produksi_layer 	= $this->report_model->list_produksi_layer($filter);
			$tanggal_prod 	= $this->report_model->get_tanggal_for_fase_layer($id_peternakan);
			$data = array(
				'peternakan'	=> $get_peternakan->result(),
				'produksi'		=> $produksi_layer,	
				'tanggal_prod'		=> $tanggal_prod,	
				'isi'		=> 'admin/report/list_layer'
			);
			$this->load->view('layout/wrapper', $data, FALSE);
		// }
		// $produksi 	= $this->report_model->list_produksi_layer($data_filter);
		// $data = array(
		// 	'peternakan'	=> $get_peternakan->result(),
		// 	// 'produksi'		=> $produksi,
		// 	'isi'		=> 'admin/report/list_layer'
		// );
		// $this->load->view('layout/wrapper', $data, FALSE);
	}

	public function tambah_grower()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);

		$data = array(
			'flock'		=> $flock,
			'isi'		=> 'admin/produksi_grower/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}
	public function tambah_layer()
	{
		$id_user 	= $this->session->userdata('id');
		$flock		= $this->flock_model->list_flock($id_user);

		$data = array(
			'flock'		=> $flock,
			'isi'		=> 'admin/produksi_layer/tambah'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function insert_grower()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'user_id' 			=> $this->input->post('user_id'),
				'flock_id' 	  		=> $this->input->post('flock_id'),
				'kandang_id' 		=> $this->input->post('kandang_id'),
				'pakan_kg' 	  		=> $this->input->post('pakan_kg'),
				'minum_liter'   	=> $this->input->post('minum_liter'),
				'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
				'kematian'     		=> $this->input->post('kematian'),
				'afkir'     		=> $this->input->post('afkir'),
				'uniformity'     	=> $this->input->post('uniformity'),
				'perlakuan'     	=> $this->input->post('perlakuan'),
				'tanggal_prod'     	=> date("Y-m-d H:i:s"),
				'jenis_produksi'    => "grower"
			];

			$this->produksi_model->insert_grower($data);
			$this->db->set('last_update', date('Y-m-d H:i:s'));
			$this->db->where('id', $data['kandang_id']);
			$this->db->update('kandang');
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil ditambahkan !
                                        </div>');
			redirect(base_url('admin/produksi/grower'), 'refresh');
		}
	}

	public function insert_layer()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'user_id' 			=> $this->input->post('user_id'),
				'flock_id' 	  		=> $this->input->post('flock_id'),
				'kandang_id' 		=> $this->input->post('kandang_id'),

				'jml_utuh_butir' 	=> $this->input->post('jml_utuh_butir'),
				'jml_utuh_kg' 		=> $this->input->post('jml_utuh_kg'),
				'sortir_butir' 		=> $this->input->post('sortir_butir'),
				'sortir_kg' 		=> $this->input->post('sortir_kg'),
				'bs_butir' 			=> $this->input->post('bs_butir'),
				'bs_kg' 			=> $this->input->post('bs_kg'),
				'cangkang_butir' 	=> $this->input->post('cangkang_butir'),
				'cangkang_kg' 		=> $this->input->post('cangkang_kg'),

				'pakan_kg' 	  		=> $this->input->post('pakan_kg'),
				'minum_liter'   	=> $this->input->post('minum_liter'),
				'bobot_ayam'     	=> $this->input->post('bobot_ayam'),
				'kematian'     		=> $this->input->post('kematian'),
				'afkir'     		=> $this->input->post('afkir'),
				// 'uniformity'     	=> $this->input->post('uniformity'),
				'perlakuan'     	=> $this->input->post('perlakuan'),
				'tanggal_prod'     	=> date("Y-m-d H:i:s"),
				'jenis_produksi'    => "layer"
			];

			$this->produksi_model->insert_layer($data);
			$this->db->set('last_update', date('Y-m-d H:i:s'));
			$this->db->where('id', $data['kandang_id']);
			$this->db->update('kandang');
			$this->session->set_flashdata('message', '<div class="alert bg-success alert-success text-white" role="alert">
                                          Data Berhasil ditambahkan !
                                        </div>');
			redirect(base_url('admin/produksi/layer'), 'refresh');
		}
	}

	public function lihat_produksi_layer($id_produksi_layer)
	{
		$produksi_layer 	= $this->produksi_model->detail_layer($id_produksi_layer);
		$data = array(
			'produksi_layer'		=> $produksi_layer,
			'isi'					=> 'admin/produksi_layer/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function lihat_produksi_grower($id_produksi_layer)
	{
		$produksi 	= $this->produksi_model->detail_layer($id_produksi_layer);
		$data = array(
			'produksi_layer'		=> $produksi,
			'isi'					=> 'admin/produksi_grower/edit'
		);
		$this->load->view('layout/wrapper', $data, FALSE);
	}

	public function update()
	{
		if (isset($_POST['submit'])) {
			$data = [
				'id_peternakan' 	  => $this->input->post('id_peternakan'),
				'id_user' 	  		  => $this->input->post('id_user'),
				'nama_peternakan' 	  => $this->input->post('nama_peternakan'),
				'lokasi_peternakan'   => $this->input->post('lokasi_peternakan'),
				'tipe_peternakan'     => $this->input->post('tipe_peternakan'),
			];
			
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

	public function xls_layer() {
		$id_user 	= $this->session->userdata('id');
		$data_filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'			=> $this->input->get('tgl_awal'),
			'tgl_akhir'			=> $this->input->get('tgl_akhir'),
		);

		$produksi_layer 	= $this->report_model->list_produksi_layer($data_filter);
		$spreadsheet = new Spreadsheet();

			$spreadsheet->getProperties()->setCreator('Admin')
				->setLastModifiedBy('Admin')
				->setTitle('Office 2007 XLSX Test Document')
				->setSubject('Office 2007 XLSX Test Document')
				->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
				->setKeywords('office 2007 openxml php')
				->setCategory('Test result file');

			$spreadsheet->getActiveSheet()->mergeCells('C1:D1')->mergeCells('F1:I1')->mergeCells('J1:M1')->mergeCells('N1:T1')
				->setCellValue('A1', 'UB1')
				->setCellValue('B1', '')
				->setCellValue('C1', 'Deplesi')
				->setCellValue('F1', 'Konsumsi Pakan')
				->setCellValue('J1', 'Produksi Telur')
				->setCellValue('N1', 'Performa Produksi')
				->setCellValue('A2', 'Tanggal')
				->setCellValue('B2', 'Populasi')
				->setCellValue('C2', 'Mati')
				->setCellValue('D2', 'Afkir')
				// ->setCellValue('E2', 'Mort')
				->setCellValue('E2', 'Pakan KG')
				->setCellValue('F2', 'Pakan gr/Ekor')
				->setCellValue('G2', 'Minum Liter')
				->setCellValue('H2', 'Minum ml/Ekor')
				->setCellValue('I2', 'Telur Normal Butir')
				->setCellValue('J2', 'Telur Normal Kg')
				->setCellValue('K2', 'Telur BS Butir')
				->setCellValue('L2', 'Telur BS Kg')
				->setCellValue('M2', 'Bobot Telur Gr/Butir')
				->setCellValue('N2', 'Bobot Telur/1000 ekor (Kg/1000)')
				->setCellValue('O2', '%HD Real')
				// ->setCellValue('Q2', '%HD Week')
				// ->setCellValue('R2', '%HD Target')
				->setCellValue('Q2', 'FCR');
				// ->setCellValue('T2', 'Egg mass cum');
				$i = 1;
				foreach ($produksi_layer as $data) {
					$nomor = $i + 2;
					$spreadsheet->getActiveSheet()
							->setCellValue('A' . $nomor, $data['tanggal_prod'])
							->setCellValue('B' . $nomor, $data['jml_total_ayam'])
							->setCellValue('C' . $nomor, $data['kematian'])
							->setCellValue('D' . $nomor, $data['afkir'])
				// 			->setCellValue('E' . $nomor, round($data['kematian']/$data['jml_total_ayam']*100/100, 4)." %")
							->setCellValue('F' . $nomor, $data['pakan_kg'])
							->setCellValue('G' . $nomor, $data['pakan_gr_per_ekor'] * 1000)
							->setCellValue('H' . $nomor, $data['minum_liter'])
							->setCellValue('I' . $nomor, $data['minum_ml_per_ekor'] * 1000)
							->setCellValue('J' . $nomor, $data['total_butir_telur'])
							->setCellValue('K' . $nomor, $data['total_kg_telur'])
							->setCellValue('L' . $nomor, $data['bs_butir'])
							->setCellValue('M' . $nomor, $data['bs_kg'])
							->setCellValue('N' . $nomor, $data['bobot_telur_gr_perbutir'])
							->setCellValue('O' . $nomor, $data['bobot_telur_per_seribu_ekor'])
							->setCellValue('P' . $nomor, $data['hd']." %")
				// 			->setCellValue('Q' . $nomor, '')
				// 			->setCellValue('R' . $nomor, '')
							->setCellValue('Q' . $nomor, $data['fcr']);
				// 			->setCellValue('T' . $nomor, $data['egg_mass_comulative']);
					$i++;
				}

				// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=" DATA LAPORAN  PRODUKSI LAYER TANGGAL ' . date('d-m-Y') . '.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
	}

	public function xls_grower() {
		$id_user 	= $this->session->userdata('id');
		$data_filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'			=> $this->input->get('tgl_awal'),
			'tgl_akhir'			=> $this->input->get('tgl_akhir'),
		);

		$produksi_layer 	= $this->report_model->list_produksi_grower($data_filter);
		$spreadsheet = new Spreadsheet();

			// Set document properties
			$spreadsheet->getProperties()->setCreator('Admin')
				->setLastModifiedBy('Admin')
				->setTitle('Office 2007 XLSX Test Document')
				->setSubject('Office 2007 XLSX Test Document')
				->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
				->setKeywords('office 2007 openxml php')
				->setCategory('Test result file');

			$spreadsheet->getActiveSheet()->mergeCells('B1:C1')->mergeCells('D1:F1')->mergeCells('G1:K1')->mergeCells('L1:M1')->mergeCells('N1:O1')
				->setCellValue('A1', '')
				->setCellValue('B1', 'Profil')
				->setCellValue('D1', 'Deplesi')
				->setCellValue('G1', 'Konsumsi')
				->setCellValue('L1', 'Bobot Ayam')
				->setCellValue('N1', 'Uniformity')

				->setCellValue('A2', 'Tanggal')
				->setCellValue('B2', 'Umur')
				->setCellValue('C2', 'Populasi')
				->setCellValue('D2', 'Kematian')
				->setCellValue('E2', 'Afkir')
				->setCellValue('F2', 'Mort%')
				->setCellValue('G2', 'Total pakan KG')
				->setCellValue('H2', 'Fl(Gram/Ekor)')
				->setCellValue('I2', 'Standar(Gram/Ekor)')
				->setCellValue('J2', 'Total Minum L')
				->setCellValue('K2', 'ML/Ekor')
				->setCellValue('L2', 'Bobot Real')
				->setCellValue('M2', 'Bobot Standar')
				->setCellValue('N2', 'Uniform Real')
				->setCellValue('O2', 'Uniform Standar')
				->setCellValue('P2', 'Keterangan');
				$i = 1;
				foreach ($produksi_layer as $data) {
					if($data['bobot_ayam'] >= 1.400 && $this->input->get('flock_id') != NULL){
						$bobot_ayam = $data['bobot_ayam'] / $this->flock_model->jml_kandang($this->input->get('flock_id'))->total;
					} else { 
						$bobot_ayam  = $data['bobot_ayam'];
					}

					$nomor = $i + 2;
					$spreadsheet->getActiveSheet()
							->setCellValue('A' . $nomor, $data['tanggal_prod'])
							->setCellValue('B' . $nomor, '')
							->setCellValue('C' . $nomor, $data['jml_total_ayam'])
							->setCellValue('D' . $nomor, $data['kematian'])
							->setCellValue('E' . $nomor, $data['afkir'])
							->setCellValue('F' . $nomor, $data['mort'])
							->setCellValue('G' . $nomor, $data['pakan_kg'])
							->setCellValue('H' . $nomor, $data['pakan_gr_per_ekor'])
							->setCellValue('I' . $nomor, '')
							->setCellValue('J' . $nomor, $data['minum_liter'])
							->setCellValue('K' . $nomor, $data['minum_ml_per_ekor'])
							->setCellValue('L' . $nomor, $bobot_ayam)
							->setCellValue('M' . $nomor, '')
							->setCellValue('N' . $nomor, $data['uniformity'])
							->setCellValue('O' . $nomor, '')
							->setCellValue('P' . $nomor, $data['perlakuan']);
					$i++;
				}

				// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=" DATA LAPORAN  PRODUKSI GROWER TANGGAL ' . date('d-m-Y') . '.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
	}

	public function export_layer() {
		$id_user 	= $this->session->userdata('id');
		$data_filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'			=> $this->input->get('tgl_awal'),
			'tgl_akhir'			=> $this->input->get('tgl_akhir'),
		);

		$this->db->select('*');
		$this->db->from('flock');
		$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id');
		$this->db->where('flock_id',  $this->input->get('flock_id'));
		$query = $this->db->get();
		$val_flock = $query->row();

		if($this->input->get('kandang_id')) {
			$this->db->select('*');
			$this->db->from('kandang');
			// $this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id');
			$this->db->where('id',  $this->input->get('kandang_id'));
			$query = $this->db->get();
			$val_kandang = $query->row();
			$nama_kandang = $val_kandang->nama_kandang;
		} else {
			$nama_kandang = 'All kandang';
		}

		


			$query_layer = $this->db->select_sum('jumlah_ayam','total');
			$query_layer = $this->db->where('id_flock',$this->input->get('flock_id'));
			$query_layer = $this->db->get('kandang');
			$res = $query_layer->row_array();

		$jml_ayam_layer = $res['total'];

		
		$produksi_layer 	= $this->report_model->list_produksi_layer($data_filter);
		$peternakan 	= $this->report_model->list_peternakan();
		$flock 	= $this->flock_model->list_flock($id_user);
		$spreadsheet = new Spreadsheet();

			// Set document properties
			$spreadsheet->getProperties()->setCreator('Admin')
				->setLastModifiedBy('Admin')
				->setTitle('Office 2007 XLSX Test Document')
				->setSubject('Office 2007 XLSX Test Document')
				->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
				->setKeywords('office 2007 openxml php')
				->setCategory('Test result file');
			
			$spreadsheet->getActiveSheet()->setCellValue('A2', 'Lokasi Peternakan');
			$spreadsheet->getActiveSheet()->setCellValue('A10', 'Daftar Flock');

			// Add some data to active sheet
			$spreadsheet->getActiveSheet()
				->setCellValue('A4', 'No')
				->setCellValue('B4', 'Nama Lokasi Peternakan')
				->setCellValue('C4', 'Detail Alamat');

			$i = 1;
			foreach ($peternakan as $farm) {
				
				$nomor = $i + 4;
				$spreadsheet->getActiveSheet()
						->setCellValue('A' . $nomor, $i)
						->setCellValue('B' . $nomor, $farm->nama_peternakan)
						->setCellValue('C' . $nomor, $farm->lokasi_peternakan);
				$i++;
			}
			// Add some data to second sheet
			$spreadsheet->getActiveSheet()
				->setCellValue('A12', 'No')
				->setCellValue('B12', 'Kode Kandang')
				->setCellValue('C12', 'Total DOC Layer')
				->setCellValue('D12', 'Satuan')
				->setCellValue('E12', 'DOC in')
				->setCellValue('F12', 'Strain Ayam')
				->setCellValue('G12', 'Total Kandang')
				->setCellValue('H12', 'DOC Per Kandang')
				->setCellValue('I12', 'Lokasi Peternakan');

			$i = 1;
			foreach ($flock as $flock) {
				$tanggal = new DateTime($flock->tanggal);
				$today = new DateTime('today');
				$d = $today->diff($tanggal)->d;
				$nomor = $i + 12;
				$spreadsheet->getActiveSheet()
						->setCellValue('A' . $nomor, $i)
						->setCellValue('B' . $nomor, $flock->kode_kandang)
						->setCellValue('C' . $nomor, $this->flock_model->jml_ayam($flock->flock_id))
						->setCellValue('D' . $nomor, 'ekor')
						->setCellValue('E' . $nomor, date('F Y', strtotime($flock->tanggal)))
						->setCellValue('F' . $nomor, $flock->strain)
						->setCellValue('G' . $nomor, $this->flock_model->jml_kandang($flock->flock_id)->total)
						->setCellValue('H' . $nomor, $this->flock_model->jml_ayam($flock->flock_id) / $this->flock_model->jml_kandang($flock->flock_id)->total)
						->setCellValue('I' . $nomor, $flock->nama_peternakan);
				$i++;
			}

			$sheet_2=$spreadsheet->createSheet();
			$sheet_2->setCellValue('A3', $val_flock->nama_flock. ' - ' . $nama_kandang);
			$sheet_2->setCellValue('L3', 'Pakan');
			$sheet_2->setCellValue('R3', 'FCR');
			$sheet_2->setCellValue('V3', 'HD = Hen Day');
			$sheet_2->setCellValue('L4', $this->flock_model->jml_kandang($flock->flock_id)->total . ' Kandang');
			$sheet_2->setCellValue('O4', $val_flock->nama_peternakan);
			$sheet_2->setCellValue('R4', 'Pakan kg / Butir Kg');
			$sheet_2->setCellValue('V4', 'Jumlah Butir Telur Saat ini/ Jumlah Populasi Ayam Saat ini');
			$sheet_2->setCellValue('A4', $val_flock->kode_kandang)
				->setCellValue('B4', $jml_ayam_layer)
				->setCellValue('C4', 'ekor')
				->setCellValue('D4', '')
				->setCellValue('E4', 'DOC in')
				->setCellValue('F4', date('F Y', strtotime($val_flock->tanggal)))
				->setCellValue('G4', '')
				->setCellValue('H4', 'strain')
				->setCellValue('I4', $val_flock->strain)
				->setCellValue('J4', '');
				
				$sheet_2
				->setCellValue('A5', 'Tgl')
				->setCellValue('B5', 'Telur Utuh(butir)')
				->setCellValue('C5', 'Berat Telur(gram)')
				->setCellValue('D5', 'Qty(kg)')
				->setCellValue('E5', 'Telur Sortir(butir)')
				->setCellValue('F5', 'Telur Sortir(kg)')
				->setCellValue('G5', 'Telur BS(butir)')
				->setCellValue('H5', 'Telur BS(kg)')
				->setCellValue('I5', 'Cangkang(btr)')
				->setCellValue('J5', 'Cangkang(kg)')
				->setCellValue('L5', 'Pakan(kg)')
				->setCellValue('M5', 'Minum(ml)')
				->setCellValue('N5', 'Bobot Ayam(kg)')
				->setCellValue('O5', 'Kematian(ekor)')
				->setCellValue('P5', 'Afkir(ekor)')
				->setCellValue('R5', 'Total Kg')
				->setCellValue('S5', 'Total Seluruh Telur Kg')
				->setCellValue('T5', 'FCR')
				->setCellValue('V5', 'Jumlah Ayam Saat ini')
				->setCellValue('W5', 'Jumlah Butir Telur saat ini')
				->setCellValue('X5', 'HD')
				;
			$i = 1;
			foreach ($produksi_layer as $client) {
				$nomor = $i + 5;
				// $telurkg = $client->jml_utuh_kg;
				// $telurkg = $client->jml_utuh_kg + $client->sortir_kg + $client->bs_kg + $client->cangkang_kg;
				// $telurbtr = $client->total_butir_telur;
				// $berat_rata_pertelur = $client->total_kg_telur /  $client->total_butir_telur;
				// $berat_telur_rata_kg = $berat_rata_pertelur * 1000;
				// $bulat = round($berat_telur_rata_kg, 2);
				// $total_seluruh_telurkg = $telurkg + $client->sortir_kg + $client->bs_kg + $client->cangkang_kg;
				// $semua_butir = $client->jml_utuh_butir + $client->sortir_butir + $client->bs_butir + $client->cangkang_butir;
				$sheet_2
						// ->setCellValue('A' . $nomor, date('d', strtotime($client->tanggal_prod)))
						->setCellValue('B' . $nomor, $client['total_butir_telur'])
						// ->setCellValue('C' . $nomor, $bulat)
						->setCellValue('D' . $nomor, $client['total_kg_telur'])
						->setCellValue('E' . $nomor, $client['sortir_butir'])
						->setCellValue('F' . $nomor, $client['sortir_kg'])
						->setCellValue('G' . $nomor, $client['bs_butir'])
						->setCellValue('H' . $nomor, $client['bs_kg'])
						->setCellValue('I' . $nomor, $client['cangkang_butir'])
						->setCellValue('J' . $nomor, $client['cangkang_kg'])

						->setCellValue('L' . $nomor, $client['pakan_kg'])
						->setCellValue('M' . $nomor, $client['minum_liter'])
						->setCellValue('N' . $nomor, $client['bobot_ayam'])
						->setCellValue('O' . $nomor, $client['kematian'])
						->setCellValue('P' . $nomor, $client['afkir'])

						->setCellValue('R' . $nomor, $client['pakan_kg'])
						->setCellValue('S' . $nomor, $client['total_kg_telur'])
						->setCellValue('T' . $nomor, round($client['pakan_kg'] / $client['total_kg_telur'], 2))

						->setCellValue('V' . $nomor, $client['jml_total_ayam'])
						// ->setCellValue('W' . $nomor, $semua_butir)
						// ->setCellValue('X' . $nomor, round($semua_butir / $client->jml_total_ayam * 100, 2)) 
						;
				$i++;
			}
			// END
			// Rename worksheet
			// $spreadsheet->getActiveSheet(0)->setTitle('Flock & Name Flock');
			

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle('Flock & Name Flock');
			$sheet_2->setTitle('Report Table');

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=" DATA LAPORAN  PRODUKSI LAYER TANGGAL ' . date('d-m-Y') . '.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
	} 

	public function export_grower() {
		$id_user 	= $this->session->userdata('id');
		$data_filter = array(
			'user_id'			=> $id_user,
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'			=> $this->input->get('tgl_awal'),
			'tgl_akhir'			=> $this->input->get('tgl_akhir'),
		);

		$this->db->select('*');
		$this->db->from('flock');
		$this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id');
		$this->db->where('flock_id',  $this->input->get('flock_id'));
		$query = $this->db->get();
		$val_flock = $query->row();

		if($this->input->get('kandang_id')) {
			$this->db->select('*');
			$this->db->from('kandang');
			// $this->db->join('peternakan', 'peternakan.id_peternakan = flock.peternakan_id');
			$this->db->where('id',  $this->input->get('kandang_id'));
			$query = $this->db->get();
			$val_kandang = $query->row();
			$nama_kandang = $val_kandang->nama_kandang;
		} else {
			$nama_kandang = 'All kandang';
		}

			$query_layer = $this->db->select_sum('jumlah_ayam','total');
			$query_layer = $this->db->where('id_flock',$this->input->get('flock_id'));
			$query_layer = $this->db->get('kandang');
			$res = $query_layer->row_array();

		$jml_ayam_layer = $res['total'];

		// $nama_flock = $val_flock->nama_flock;
		// $strain = $val_kandang->tipe_ayam;
		
		$produksi_grower 	= $this->report_model->list_produksi_grower($data_filter);
		$peternakan 	= $this->report_model->list_peternakan();
		$flock 	= $this->flock_model->list_flock($id_user);
		$spreadsheet = new Spreadsheet();

			// Set document properties
			$spreadsheet->getProperties()->setCreator('Admin')
				->setLastModifiedBy('Admin')
				->setTitle('Office 2007 XLSX Test Document')
				->setSubject('Office 2007 XLSX Test Document')
				->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
				->setKeywords('office 2007 openxml php')
				->setCategory('Test result file');
			
			$spreadsheet->getActiveSheet()->setCellValue('A2', 'Lokasi Peternakan');
			$spreadsheet->getActiveSheet()->setCellValue('A10', 'Daftar Flock');

			// Add some data to active sheet
			$spreadsheet->getActiveSheet()
				->setCellValue('A4', 'No')
				->setCellValue('B4', 'Nama Lokasi Peternakan')
				->setCellValue('C4', 'Detail Alamat');

			$i = 1;
			foreach ($peternakan as $farm) {
				
				$nomor = $i + 4;
				$spreadsheet->getActiveSheet()
						->setCellValue('A' . $nomor, $i)
						->setCellValue('B' . $nomor, $farm->nama_peternakan)
						->setCellValue('C' . $nomor, $farm->lokasi_peternakan);
				$i++;
			}
			// Add some data to second sheet
			$spreadsheet->getActiveSheet()
				->setCellValue('A12', 'No')
				->setCellValue('B12', 'Kode Kandang')
				->setCellValue('C12', 'Total DOC Layer')
				->setCellValue('D12', 'Satuan')
				->setCellValue('E12', 'DOC in')
				->setCellValue('F12', 'Stain Ayam')
				->setCellValue('G12', 'Total Kandang')
				->setCellValue('H12', 'DOC Per Kandang')
				->setCellValue('I12', 'Lokasi Peternakan');

			$i = 1;
			foreach ($flock as $flock) {
				$tanggal = new DateTime($flock->tanggal);
				$today = new DateTime('today');
				$d = $today->diff($tanggal)->d;
				$nomor = $i + 12;
				$spreadsheet->getActiveSheet()
						->setCellValue('A' . $nomor, $i)
						->setCellValue('B' . $nomor, $flock->kode_kandang)
						->setCellValue('C' . $nomor, $this->flock_model->jml_ayam($flock->flock_id))
						->setCellValue('D' . $nomor, 'ekor')
						->setCellValue('E' . $nomor, date('F Y', strtotime($flock->tanggal)))
						->setCellValue('F' . $nomor, $flock->strain)
						->setCellValue('G' . $nomor, $this->flock_model->jml_kandang($flock->flock_id)->total)
						->setCellValue('H' . $nomor, $this->flock_model->jml_ayam($flock->flock_id) / $this->flock_model->jml_kandang($flock->flock_id)->total)
						->setCellValue('I' . $nomor, $flock->nama_peternakan);
				$i++;
			}

			$sheet_2=$spreadsheet->createSheet();
			$sheet_2->setCellValue('A3', $val_flock->nama_flock. ' - ' . $nama_kandang);
			$sheet_2->setCellValue('L3', 'Pakan');
			// $sheet_2->setCellValue('R3', 'FCR');
			// $sheet_2->setCellValue('V3', 'HD = Hen Day');
			$sheet_2->setCellValue('L4', $this->flock_model->jml_kandang($flock->flock_id)->total . ' Kandang');
			$sheet_2->setCellValue('O4', $val_flock->nama_peternakan);
			// $sheet_2->setCellValue('R4', 'Pakan kg / Butir Kg');
			// $sheet_2->setCellValue('V4', 'Jumlah Butir Telur Saat iini/ Jumlah Populasi Ayam Saat ini');
			$sheet_2->setCellValue('A4', $val_flock->kode_kandang)
				->setCellValue('B4', $jml_ayam_layer)
				->setCellValue('C4', 'ekor')
				->setCellValue('D4', '')
				->setCellValue('E4', 'DOC in')
				->setCellValue('F4', date('F Y', strtotime($val_flock->tanggal)))
				->setCellValue('G4', '')
				->setCellValue('H4', 'strain')
				->setCellValue('I4', $val_flock->strain)
				->setCellValue('J4', '');
				
				$sheet_2
				->setCellValue('A5', 'Tgl')
				// ->setCellValue('B5', 'Telur Utuh(butir)')
				// ->setCellValue('C5', 'Berat Telur(gram)')
				// ->setCellValue('D5', 'Qty(kg)')
				// ->setCellValue('E5', 'Telur Sortir(butir)')
				// ->setCellValue('F5', 'Telur Sortir(kg)')
				// ->setCellValue('G5', 'Telur BS(butir)')
				// ->setCellValue('H5', 'Telur BS(kg)')
				// ->setCellValue('I5', 'Cangkang(btr)')
				// ->setCellValue('J5', 'Cangkang(kg)')
				->setCellValue('B5', 'Pakan(kg)')
				->setCellValue('C5', 'Minum(ml)')
				->setCellValue('D5', 'Bobot Ayam(kg)')
				->setCellValue('E5', 'Kematian(ekor)')
				->setCellValue('F5', 'Afkir(ekor)')
				->setCellValue('G5', 'Total Pakan Kg')
				->setCellValue('H5', 'Jumlah Ayam Saat ini')
				// ->setCellValue('S5', 'Total Seluruh Telur Kg')
				// ->setCellValue('T5', 'FCR')
				// ->setCellValue('W5', 'Jumlah Butir Telur saat ini')
				// ->setCellValue('X5', 'HD')
				;
			$i = 1;
			foreach ($produksi_grower as $client) {
				$nomor = $i + 5;
				// $telurkg = $client->jml_utuh_kg;
				// $telurkg = $client->jml_utuh_kg + $client->sortir_kg + $client->bs_kg + $client->cangkang_kg;
				// $telurbtr = $client->jml_utuh_butir;
				// $berat_rata_pertelur = $telurkg /  $telurbtr;
				// $berat_telur_rata_kg = $berat_rata_pertelur * 1000;
				// $bulat = round($berat_telur_rata_kg, 2);
				// $total_seluruh_telurkg = $telurkg + $client->sortir_kg + $client->bs_kg + $client->cangkang_kg;
				// $semua_butir = $client->jml_utuh_butir + $client->sortir_butir + $client->bs_butir + $client->cangkang_butir;
				$sheet_2
						->setCellValue('A' . $nomor, date('d', strtotime($client->tanggal_prod)))
						// ->setCellValue('B' . $nomor, $telurbtr)
						// ->setCellValue('C' . $nomor, $bulat)
						// ->setCellValue('D' . $nomor, $telurkg)
						// ->setCellValue('E' . $nomor, $client->sortir_butir)
						// ->setCellValue('F' . $nomor, $client->sortir_kg)
						// ->setCellValue('G' . $nomor, $client->bs_butir)
						// ->setCellValue('H' . $nomor, $client->bs_kg)
						// ->setCellValue('I' . $nomor, $client->cangkang_butir)
						// ->setCellValue('J' . $nomor, $client->cangkang_kg)

						->setCellValue('B' . $nomor, $client->pakan_kg)
						->setCellValue('C' . $nomor, $client->minum_liter)
						->setCellValue('D' . $nomor, $client->bobot_ayam)
						->setCellValue('E' . $nomor, $client->kematian)
						->setCellValue('F' . $nomor, $client->afkir)
						->setCellValue('G' . $nomor, $client->pakan_kg)
						->setCellValue('H' . $nomor, $client->jml_total_ayam)
						// ->setCellValue('I' . $nomor, $total_seluruh_telurkg)
						// ->setCellValue('J' . $nomor, round($client->pakan_kg / $total_seluruh_telurkg, 2))

						// ->setCellValue('M' . $nomor, $semua_butir)
						// ->setCellValue('N' . $nomor, round($semua_butir / $client->jml_total_ayam * 100, 2)) 
						;
				$i++;
			}
			// END
			// Rename worksheet
			// $spreadsheet->getActiveSheet(0)->setTitle('Flock & Name Flock');
			

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle('Flock & Name Flock');
			$sheet_2->setTitle('Report Table');

			// Redirect output to a client’s web browser (Xlsx)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=" DATA LAPORAN  PRODUKSI GROWER TANGGAL ' . date('d-m-Y') . '.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('php://output');
	}

}

