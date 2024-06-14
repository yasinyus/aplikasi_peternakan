<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Register extends RestController
{

	function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->database();
	}
	
	private function _sendEmail($token, $type)
	{
	    ini_set( 'display_errors', 1 );   
        error_reporting( E_ALL );    
        $config = [
            'protocol'  => 'ssmtp',
			'smtp_host' => 'ssl://ssmtp.googlemail.com',
			'smtp_user' => 'berkarya686@gmail.com',
			'smtp_pass' => 'asking00',
			'smtp_port' => '587',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
        ];
        $this->load->library('email', $config);

        $this->email->initialize($config);
		// $this->email->set_newline("\r\n");
        $this->email->from('admin@finsapp.id', 'Aktivasi Akun Fins App');
        // $this->email->to('irmafitriana48@gmail.com');
        $this->email->to($this->input->post('email'));

        if (
            $type == 'verify'
        ) {
			$this->email->subject('Verifikasi akun');
// 			$this->email->message('Klik link untuk aktivasi akun : <a href="' . base_url() . 'admin/anggota/aktivasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activasi sekarang</a>');
			$this->email->message(' <!DOCTYPE html>
									<html>

									<head>
										<title></title>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<meta name="viewport" content="width=device-width, initial-scale=1">
										<meta http-equiv="X-UA-Compatible" content="IE=edge" />
										<style type="text/css">
											@media screen {
												@font-face {
													font-family: &#39;Lato&#39;;
													font-style: normal;
													font-weight: 400;
													src: local("Lato Regular"), local("Lato-Regular"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format("woff");
												}

												@font-face {
													font-family: &#39;Lato&#39;;
													font-style: normal;
													font-weight: 700;
													src: local("Lato Bold"), local("Lato-Bold"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format("woff");
												}

												@font-face {
													font-family: &#39;Lato&#39;;
													font-style: italic;
													font-weight: 400;
													src: local("Lato Italic"), local("Lato-Italic"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format("woff");
												}

												@font-face {
													font-family: &#39;Lato&#39;;
													font-style: italic;
													font-weight: 700;
													src: local("Lato Bold Italic"), local("Lato-BoldItalic"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format("woff");
												}
											}

											/* CLIENT-SPECIFIC STYLES */
											body,
											table,
											td,
											a {
												-webkit-text-size-adjust: 100%;
												-ms-text-size-adjust: 100%;
											}

											table,
											td {
												mso-table-lspace: 0pt;
												mso-table-rspace: 0pt;
											}

											img {
												-ms-interpolation-mode: bicubic;
											}

											img {
												border: 0;
												height: auto;
												line-height: 100%;
												outline: none;
												text-decoration: none;
											}

											table {
												border-collapse: collapse !important;
											}

											body {
												height: 100% !important;
												margin: 0 !important;
												padding: 0 !important;
												width: 100% !important;
											}

											a[x-apple-data-detectors] {
												color: inherit !important;
												text-decoration: none !important;
												font-size: inherit !important;
												font-family: inherit !important;
												font-weight: inherit !important;
												line-height: inherit !important;
											}

											@media screen and (max-width:600px) {
												h1 {
													font-size: 32px !important;
													line-height: 32px !important;
												}
											}

											div[style*="margin: 16px 0;"] {
												margin: 0 !important;
											}
										</style>
									</head>

									<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
										<!-- HIDDEN PREHEADER TEXT -->
										<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: &#39;Lato&#39;, Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We are thrilled to have you here! Get ready to dive into your new account. </div>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<!-- LOGO -->
											<tr>
												<td bgcolor="#fd7e14" align="center">
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
														<tr>
															<td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td bgcolor="#fd7e14" align="center" style="padding: 0px 10px 0px 10px;">
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
														<tr>
															<td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: &#39;Lato&#39;, Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
																<h1 style="font-size: 28px; font-weight: 400; margin: 2;">Selamat Datang di <br> Fins App</h1> <img src="'.base_url().'assets/images/logo.png" width="125" height="120" style="display: block; border: 0px;" />
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
													<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
														<tr>
															<td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-family: &#39;Lato&#39;, Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
																<p style="margin: 0;">Terimakasih sudah mendaftar sebagai user Fins App, untuk melakukan aktivasi akun anda, silahkan klik link di bawah ini</p>
															</td>
														</tr>
														<tr>
															<td bgcolor="#ffffff" align="left">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
																			<table border="0" cellspacing="0" cellpadding="0">
																				<tr>
																					<td align="center" style="border-radius: 3px;" bgcolor="#fd7e14">
																					<a href="' . base_url() . 'daftar/aktivasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #fd7e14; display: inline-block;">Aktivasi Sekarang</a></td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr> 
													</table>
												</td>
											</tr>
											
										
										</table>
									</body>

									</html>');
		} else if ($type == 'forgot') {
			$this->email->subject('Reset Password');
			$this->email->message('Click this link to reset your password : <a href="' . base_url() . 'admin/anggota/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
		}

		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}

	function index_post()
	{
		
		$header =  $this->input->request_headers();

		if (!isset($header['app_key'])) {
			$this->response("App key is required", 401);
		} else {
			if ($header['app_key'] != APP_KEY) {
				$this->response("Wrong app key", 401);
			}
		}

		$data = array(
			'nama'				=> $this->post('nama'),
			'nama_peternakan'   => $this->post('nama_peternakan'),
			'email'    			=> $this->post('email'),
			'no_telp'    		=> $this->post('no_telp'),
			'password'    		=> password_hash($this->post('password'), PASSWORD_DEFAULT),
			'status'    		=> '0',
			'jenis_akun'  		=> 'user',
            'tanggal_daftar'    => date('Y-m-d H:i:s')
		);
		
		// siapkan token
					$token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $this->input->post('email'),
						'token' => $token,
						'date_created' => time()
					];
					

		// $email = $data['email'];
        $sql = $this->db->query("SELECT email FROM user_pendaftar where email='$data[email]'");
        $cek_email = $sql->num_rows();
        if ($cek_email > 0) {
            $this->response(array('status' => 'fail', 'message' => 'Email sudah terdaftar'));
            } else {
                $insert = $this->db->insert('user_pendaftar', $data);
                $this->db->insert('user_token', $user_token);
				// $this->load->config('email');
                // $this->email->from('ismetmaulana17@gmail.com', 'Ismet Maulana');
				// $this->email->to($email);
		
				// $this->email->subject('Konfirmasi Email');
				// $this->email->message('Klik button Active untuk mengaktifkan Akun Anda. <a href="http://localhost/ismet/Artikel_Code/sendmail/$email/$random_id">AKTIF</a>');
		
				// $this->email->set_mailtype('html');
				// $this->email->send();
        	}

		
		if ($insert) {
			$this->response([
				'status' => TRUE,
				'message' => 'Register successful.',
				// 'data' => $data,
				'activation_link' => base_url() . 'daftar/aktivasi?email=' .  $this->post('email') . '&token=' . urlencode($token),
			], RestController::HTTP_OK);
		} else {
			$this->response(array('status' => 'fail', 502));
		}
	}


}
