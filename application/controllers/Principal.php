<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('bars');
    }


	public function index()
	{
        if ($this->session->userdata('logueado')) {
            $this->load->view('principal');
        } else {
            redirect(base_url() . 'login');
        }
	}
}
