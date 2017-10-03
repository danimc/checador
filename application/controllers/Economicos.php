<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Economicos extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('bars');
        $this->load->model('guarda');
    }

        public function index()
    {
        if ($this->session->userdata('logueado')) {

            if ($this->session->userdata('tipo') == 'A'){
                $this->load->view('economicos');
            } else {
                redirect(base_url() . 'principal');   
            }            
            
            
        } else {
            redirect(base_url() . 'principal');   
        }
    }



}
