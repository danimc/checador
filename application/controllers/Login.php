<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        if ($this->session->userdata('logueado')) {
            redirect(base_url() . 'principal');
        } else {
            $this->load->view('login');
        }
	}
}
