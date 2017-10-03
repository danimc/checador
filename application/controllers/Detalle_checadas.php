<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle_checadas extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('bars');
    }

        public function index()
    {
        if ($this->session->userdata('logueado')) {

            if ($this->session->userdata('tipo') == 'A' || $this->session->userdata('tipo') == 'C'){
                $this->load->view('detalle_checadas');
            } else {
                redirect(base_url() . 'principal');   
            }
            
            
        } else {
            redirect(base_url() . 'principal');   
        }
    }

}
