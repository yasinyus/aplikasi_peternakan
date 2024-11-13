<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;

require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Laporan extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
		$this->load->model('report_model');
		$this->load->model('flock_model');
		$this->load->model('peternakan_model');
		$this->load->model('kandang_model');
		$this->load->database();
    }

    function index_post() {
		$header =  $this->input->request_headers();

		if(!isset($header['app_key'])){
			$this->response("App key is required", 401);
		} else {
			if($header['app_key'] != APP_KEY){
				$this->response("Wrong app key", 401);
			}
		}

		$filter = array(
			'user_id'			=> $this->input->post('user_id'),
			'peternakan_id'		=> $this->input->post('peternakan_id'),
			'flock_id'			=> $this->input->post('flock_id'),
			'kandang_id'		=> $this->input->post('kandang_id'),
			'tgl_awal'		    => $this->input->post('tgl_awal'),
			'tgl_akhir'		    => $this->input->post('tgl_akhir'),
		);
		
		$this->db->select('tanggal_prod');
		$this->db->select('flock.usia_ayam as minggu');
		$this->db->select('flock.tanggal');
		$this->db->select('nama_obat');
		$this->db->select('nama_pakan');
		$this->db->select('vitamin');
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

		
        $this->db->where('DATE(tanggal_prod) >=',$filter['tgl_awal']); 
		$this->db->where('DATE(tanggal_prod) <=',$filter['tgl_akhir']);
		$this->db->where('produksi.user_id', $filter['user_id']);
		$this->db->where('produksi.jenis_produksi', 'layer');
		$this->db->group_by('tanggal_prod');
		$query = $this->db->get();
		$produksi_layer =  $query->result_array();
		

		$spreadsheet = new Spreadsheet();

			// Set document properties
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
				->setCellValue('Q2', 'FCR')
				->setCellValue('R2', 'Nama Obat')
				->setCellValue('S2', 'Nama Pakan')
				->setCellValue('T2', 'Vitamin');
				$i = 1;
				foreach ($produksi_layer as $data) {
					$nomor = $i + 2;
					$spreadsheet->getActiveSheet()
							->setCellValue('A' . $nomor, $data['tanggal_prod'])
							->setCellValue('B' . $nomor, $data['jml_total_ayam'])
							->setCellValue('C' . $nomor, $data['kematian'])
							->setCellValue('D' . $nomor, $data['afkir'])
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
							->setCellValue('Q' . $nomor, $data['fcr'])
							->setCellValue('R' . $nomor, $data['nama_obat'])
							->setCellValue('S' . $nomor, $data['nama_pakan'])
							->setCellValue('T' . $nomor, $data['vitamin']);
					$i++;
				}

			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename=" DATA LAPORAN  PRODUKSI LAYER TANGGAL ' . date('d-m-Y') . '.xls"');
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0

			$writer = IOFactory::createWriter($spreadsheet, 'Xls');
			$writer->save('assets/' . 'laporan_tgl_' . date('d-m-Y') . '.xls');


       $this->response([
				'status' => TRUE,
				'message' => 'success',
				'data' => $produksi_layer,
				'download_link' => base_url() . 'assets/' . 'laporan_tgl_' . date("d-m-Y") . '.xls'
		], RestController::HTTP_OK);
        
    }

}
