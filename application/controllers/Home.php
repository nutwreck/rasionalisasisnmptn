<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	public function index(){
		$this->load->view('user/partials_/header');
		$this->load->view('user/home/css_front');
		$this->load->view('user/home/front');
		$this->load->view('user/partials_/footer');
		$this->load->view('user/home/js_front');
	}

	public function terms_condition(){
		$this->load->view('user/partials_/header');
		$this->load->view('user/home/css_terms_condition');
		$this->load->view('user/home/terms_condition');
		$this->load->view('user/partials_/footer');
		$this->load->view('user/home/js_terms_condition');
	}

	public function home()
	{
        $this->load->view('user/partials_/header');
		$this->load->view('user/home/home');
		$this->load->view('user/partials_/footer');
	}
}
