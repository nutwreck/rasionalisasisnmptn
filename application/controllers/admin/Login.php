<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('encryption');
		$this->load->model('Core_model','core');
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }
    
    public function login(){
        $this->load->view('admin/login');
    }

    public function submit_login(){
        $data['username'] = $this->input->post('username', TRUE);
        $data['password'] = $this->input->post('password', TRUE);

		$data['login_admin'] = $this->core->login_admin($data);

        $decode = $this->encryption->decrypt($data['login_admin'][0]['password']);

		if($data['login_admin'] && $decode == $data['password']){
            $this->session->set_flashdata('success', 'Selamat Datang Administrator');
            
			$newdata = array(
					'id' => $data['login_admin'][0]['id'],
					'username' => $data['login_admin'][0]['username'],
					'has_login' => 1
			);

			$this->session->set_userdata($newdata);
			session_start();

			redirect("admin");
		}else{
			$this->session->set_flashdata('error', 'Email atau password salah!');
			redirect("admin/login");
		}
    }

}