<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pdf extends CI_Controller
{
    public function layer(){
        $filter = array(
			'user_id'			=> $this->session->userdata('id'),
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'		=> $this->input->get('tgl_awal'),
			'tgl_akhir'		=> $this->input->get('tgl_akhir'),
		);

        $this->load->model('report_model');
        $produksi_layer 	= $this->report_model->list_produksi_layer($filter);
        $data = array(
            'produksi'		=> $produksi_layer,
			'title_pdf' 	=> 'Laporan Produksi Layer'
        );
		$this->load->library('pdfgenerator');
        $file_pdf = 'Laporan Produksi Layer';
        $paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('laporan_layer',$data, true);	    
    
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }

	public function grower(){
        $filter = array(
			'user_id'			=> $this->session->userdata('id'),
			'peternakan_id'		=> $this->input->get('peternakan_id'),
			'flock_id'			=> $this->input->get('flock_id'),
			'kandang_id'		=> $this->input->get('kandang_id'),
			'periode'		    => $this->input->get('periode'),
			'tgl_awal'		=> $this->input->get('tgl_awal'),
			'tgl_akhir'		=> $this->input->get('tgl_akhir'),
		);

        $this->load->model('report_model');
        $produksi_grower 	= $this->report_model->list_produksi_grower($filter);
        $data = array(
            'produksi'		=> $produksi_grower,
			'title_pdf' 	=> 'Laporan Produksi Grower'
        );
		$this->load->library('pdfgenerator');
        $file_pdf = 'Laporan Produksi Grower';
        $paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('laporan_grower',$data, true);	    
    
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
	
    }
}