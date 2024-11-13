<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController;
// LOAD EXCEL
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class Laporan_grower extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        // $this->load->database();
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
		$this->db->select('flock.usia_ayam');
		$this->db->select('nama_obat');
		$this->db->select('nama_pakan');
		$this->db->select('vitamin');
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
		$this->db->select('bobot_ayam');
		$this->db->select_sum('mort');
		$this->db->select_sum('kematian');
		$this->db->select_sum('afkir');
		$this->db->select_sum('kematian');
		$this->db->select_sum('mort');
		$this->db->select_sum('pakan_gr_per_ekor');
		$this->db->select_sum('minum_ml_per_ekor');
		$this->db->select_sum('uniformity');
		$this->db->select_sum('perlakuan');
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

		
// 		$this->db->where('DATE(tanggal_prod) =', date('Y-m-d')); 
        $this->db->where('DATE(tanggal_prod) >=',$filter['tgl_awal']); 
		$this->db->where('DATE(tanggal_prod) <=',$filter['tgl_akhir']);
		$this->db->where('produksi.user_id', $filter['user_id']);
		$this->db->where('produksi.jenis_produksi', 'layer');
		$this->db->group_by('tanggal_prod');
		$query = $this->db->get();
		$produksi_layer =  $query->result_array();
		
			$this->db->select('tanggal_prod');
		$this->db->select('flock.usia_ayam');
		$this->db->select('nama_obat');
		$this->db->select('nama_pakan');
		$this->db->select('vitamin');
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
		$this->db->select('bobot_ayam');
		$this->db->select_sum('mort');
		$this->db->select_sum('kematian');
		$this->db->select_sum('afkir');
		$this->db->select_sum('kematian');
		$this->db->select_sum('mort');
		$this->db->select_sum('pakan_gr_per_ekor');
		$this->db->select_sum('minum_ml_per_ekor');
		$this->db->select_sum('uniformity');
		$this->db->select_sum('perlakuan');
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

		
		$this->db->where('DATE(tanggal_prod) =', date('Y.m.d',strtotime("-1 days"))); 
		$this->db->where('produksi.user_id', $filter['user_id']);
		$this->db->where('produksi.jenis_produksi', 'layer');
		$this->db->group_by('tanggal_prod');
		$query = $this->db->get();
		$produksi_layer_kemaren =  $query->result_array();

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
				->setCellValue('P2', 'Keterangan')
				->setCellValue('R2', 'Nama Obat')
				->setCellValue('R2', 'Nama Pakan')
				->setCellValue('S2', 'Vitamin');
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
							->setCellValue('P' . $nomor, $data['perlakuan'])
							->setCellValue('Q' . $nomor, $data['nama_obat'])
							->setCellValue('R' . $nomor, $data['nama_pakan'])
							->setCellValue('S' . $nomor, $data['vitamin']);
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
			$writer->save('assets/' . 'laporan_tgl_' . date('d-m-Y') . '.xls');

			// Redirect output to a client’s web browser (Xlsx)
			
// 			$data => $produksi_layer, $produksi_layer_kemaren);
			
// 			$data_array[] = (object) array('produksi_hariini' => $produksi_layer);
// 			$data_array[] = (object) array('produksi_kemaren' => $produksi_layer_kemaren);
			
			
			


       $this->response([
				'status' => TRUE,
				'message' => 'success',
				// 'data' => $data_array,
				'data' => $produksi_layer,
				// 'data_kemarin' => $produksi_layer_kemaren,
				'download_link' => base_url() . 'assets/' . 'laporan_tgl_' . date("d-m-Y") . '.xls'
		], RestController::HTTP_OK);
        
    }

}
