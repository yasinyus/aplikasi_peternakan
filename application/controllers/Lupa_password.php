<?php
defined('BASEPATH') or exit('No direct script access allowed');

class lupa_password extends CI_Controller
{

	// Load database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	public function index()
    {

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com';
            $this->load->view('login/lupa_password', $data);
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->User_model->getUserInfoByEmail($clean);

            if (!$userInfo) {
                $this->session->set_flashdata('sukses', 'email address salah, silakan coba lagi.');
                redirect(site_url('login'), 'refresh');
            }

            //build token   

            $token = $this->User_model->insertToken($userInfo->id);
            $qstring = $this->base64url_encode($token);
            $url = site_url() . '/lupa_password/reset_password/token/' . $qstring;
            $link = '<a href="' . $url . '">' . $url . '</a>';

            $message = '';
            $message .= '<strong>Hai, anda menerima email ini karena ada permintaan untuk memperbaharui  
                 password anda.</strong><br>';
            $message .= '<strong>Silakan klik link ini:</strong> ' . $link;

            echo $message; //send this through mail  
            exit;
        }
    }

    public function reset_password()
    {
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->User_model->isTokenValid($cleanToken); //either false or array();          

        if (!$user_info) {
            $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');
            redirect(site_url('login'), 'refresh');
        }

        $data = array(
            'title' => 'Halaman Reset Password | Tutorial reset password CodeIgniter @ https://recodeku.blogspot.com',
            'nama' => $user_info->nama,
            'email' => $user_info->email,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'callback_valid_password');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/reset_password', $data);
        } else {

            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = password_hash($cleanPost['password'], PASSWORD_DEFAULT);
            $cleanPost['password'] = $hashed;
            $cleanPost['id'] = $user_info->id;
            unset($cleanPost['konfirmasi_password']);
            if (!$this->User_model->updatePassword($cleanPost)) {
                $this->session->set_flashdata('message', 'Update password gagal.');
            } else {
                $this->session->set_flashdata('message', '<p class="text text-success">Password anda sudah diperbaharui. Silakan login</p>');
				redirect(site_url('login'), 'refresh');
            }
            
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

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
		

}
