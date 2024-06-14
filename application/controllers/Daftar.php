<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{

    // Database
    public function __construct()
    {
        parent::__construct();
		$this->load->database();
        $this->load->model('user_model');
    }

    // Main page kontak
    public function index()
    {
		$data = array('title'		=> 'Halaman Daftar');
		$this->load->view('daftar/list', $data, FALSE);
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
			'smtp_port' => '465',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
        ];
        $this->load->library('email', $config);

        $this->email->initialize($config);

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

    public function submit()
    {
        // START VALIDASI
		$valid = $this->form_validation;
		$valid->set_rules('nama', 'Nama', 'required', array('required'        => 'Form %s tidak boleh kosong'));
		$valid->set_rules('nama_peternakan', 'Nama Peternakan', 'required', array('required'        => 'Form %s tidak boleh kosong'));
		$valid->set_rules('email', 'Email', 'required|valid_email|is_unique[user_pendaftar.email]',
			  array(
					'required'        => 'Form %s tidak boleh kosong', 
					'is_unique'       => 'Email sudah digunakan, silahkan gunakan'));
		$valid->set_rules('no_telp', 'No Telp', 'required|min_length[8]|max_length[20]', array('required' => 'Form %s tidak boleh kosong'));
		$valid->set_rules('password', 'Password', 'callback_valid_password');
		$valid->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|matches[password]', 
			  array(
					'required'        => 'Form %s tidak boleh kosong', 
					'matches'         => '%s tidak sama, silahkan ulangi lagi'));

		if($valid->run()===FALSE)
		{

                  $data = array('title'		=> 'Daftar');
		          $this->load->view('daftar/list', $data, FALSE);
            }
            else
            {
                  $i = $this->input;
                  $data = array(
                        'nama'              => $i->post('nama'),
                        'nama_peternakan'   => $i->post('nama_peternakan'),
                        'email'             => $i->post('email'),
                        'no_telp'           => $i->post('no_telp'),
                        'password'		    => password_hash($i->post('password'), PASSWORD_DEFAULT),
                        'status'            => '1',
                        'tanggal_daftar'    => date('Y-m-d H:i:s')
                  );

				  $token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $this->input->post('email'),
						'token' => $token,
						'date_created' => time()
					];

                  $this->user_model->tambah_user($data);
				//   $this->_sendEmail($token, 'verify');
				//   $this->db->insert('user_token', $user_token);
                  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Daftar, Silahkan cek email anda dan lakukan aktivasi</div>');
			      redirect(base_url('login'),'refresh');
            }
    }

	 public function submit_downline()
    {
        	// START VALIDASI
            $valid = $this->form_validation;
            $valid->set_rules('nama', 'Nama', 'required', array('required'        => 'Form %s tidak boleh kosong'));
            // $valid->set_rules('nama_peternakan', 'Nama Peternakan', 'required', array('required'        => 'Form %s tidak boleh kosong'));
            $valid->set_rules('email', 'Email', 'required|is_unique[user_pendaftar.email]',
                  array(
                        'required'        => 'Form %s tidak boleh kosong', 
                        'is_unique'       => 'Email sudah digunakan, silahkan gunakan email yang lainnya'));
            $valid->set_rules('no_telp', 'No HP', 'required|min_length[8]|max_length[20]', 
				  array(
					'required'        => 'Form %s tidak boleh kosong',
					'min_length'        => 'Minimal 8 angka',
					'max_length'        => 'Maksimal 20 angka',
				));
            $valid->set_rules('password', 'Password', 'required');
            // $valid->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|matches[password]', 
            //       array(
            //             'required'        => 'Form %s tidak boleh kosong', 
            //             'matches'         => '%s tidak sama, silahkan ulangi lagi'));

            if($valid->run()===FALSE)
            {

				$data = array(
					'isi'		=> 'admin/tabel_user/tambah_user'
				);
				$this->load->view('layout/wrapper', $data, FALSE);
            }
            else
            {
                  $i = $this->input;
                  $data = array(
					  	'id_user_downline'  => $i->post('id_user_downline'),
                        'nama'              => $i->post('nama'),
                        'nama_peternakan'   => $i->post('nama_peternakan'),
                        'email'             => $i->post('email'),
                        'no_telp'           => $i->post('no_telp'),
                        'password'		    => password_hash($i->post('password'), PASSWORD_DEFAULT),
                        'status'            => '1',
                        'jenis_akun'        => 'user_downline',
                        'tipe_user'        	=> $i->post('tipe_user'),
                        'tanggal_daftar'    => date('Y-m-d H:i:s')
                  );

				  $token = base64_encode(random_bytes(32));
					$user_token = [
						'email' => $this->input->post('email'),
						'token' => $token,
						'date_created' => time()
					];

                  $this->user_model->tambah_user($data);
				//   $this->_sendEmail($token, 'verify');
				//   $this->db->insert('user_token', $user_token);
                  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil disimpan</div>');
                //   $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Daftar, Silahkan cek email anda dan lakukan aktivasi</div>');
			      redirect(base_url('admin/users/list_downline'),'refresh');
            }
    }

	public function valid_password($password = '')
	{
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if (empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} harus diisi.');

			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} harus mengandung huruf kecil.');

			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} harus mengandung huruf kapital.');

			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', '{field} minimal mengandung 1 nomor.');

			return FALSE;
		}

		// if (preg_match_all($regex_special, $password) < 1)
		// {
		// 	$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));

		// 	return FALSE;
		// }

		if (strlen($password) < 8)
		{
			$this->form_validation->set_message('valid_password', '{field} minimal 8 karakter.');

			return FALSE;
		}

		if (strlen($password) > 32)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

			return FALSE;
		}

		return TRUE;
	}

	public function aktivasi()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user_pendaftar', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
					$this->db->set('status', 1);
					$this->db->where('email', $email);
					$this->db->update('user_pendaftar');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' Telah aktif, Silahkan Login.</div>');
					redirect('login');
				} else {
					$this->db->delete('anggota', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Aktivasi gagal. Token kadarluarsa</div>');
					redirect('masuk');
				}
			} else {
				$this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Aktivasi gagal. Token salah</div>');
				redirect('masuk');
			}
		} else {
			$this->session->set_flashdata('sukses', '<div class="alert alert-danger" role="alert">Aktivasi gagal. Email salah</div>');
			redirect('masuk');
		}
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
}

/* End of file Contact.php */
/* Location: ./application/controllers/Kontak.php */
