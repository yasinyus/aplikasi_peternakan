<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Menu extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
		$this->load->model('menu_model');
	}

	function index_get()
	{
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

		// $menu = $this->menu_model->listing();
		// foreach ($menu as $menus) {
		// 	$a = $menus->id_menu;
		// 	$submenu = $this->db->query("SELECT * FROM menu_submenu WHERE id_menu = '$a' ");
		// 	foreach ($submenu->result() as $submenus) {


		// 		if ($menu) {
		// 			// Set the response and exit
		// 			$this->response([
		// 				'status' => TRUE,
		// 				'message' => 'successful.',
		// 				'data' => $submenus->id_menu

		// 			], RestController::HTTP_OK);
		// 		} else {
		// 			// Set the response and exit
		// 			//BAD_REQUEST (400) being the HTTP response code
		// 			$this->response("Wrong email or password.", RestController::HTTP_BAD_REQUEST);
		// 		}
		// 	}
		// }

		$orders = $this->menu_model->listing();

		$json_response = array();
		foreach ($orders as $row) {
			$row_array = (array) $row;
			$sm_id = $row->id_menu;
			$submenu = $this->db->query("SELECT id_menu, nama_submenu, link_submenu FROM menu_submenu WHERE id_menu = '$sm_id' ");

			foreach ($submenu->result_array() as $sm) {
				$row_array['nama_menu'] = $row_array['nama_menu'];
				$row_array['submenu'][] = $sm;
			}
			$json_response[] = $row_array;
		}
		if ($json_response) {
			// Set the response and exit
			$this->response([
				'status' => TRUE,
				'message' => 'successful.',
				'data' => $json_response

			], RestController::HTTP_OK);
		} else {
			$this->response("Wrong email or password.", RestController::HTTP_BAD_REQUEST);
		}
	}
}
