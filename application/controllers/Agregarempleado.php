<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agregarempleado extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('bars');
        $this->load->model('guarda');
    }

        public function index()
    {
        if ($this->session->userdata('logueado')) {

            if ($this->session->userdata('tipo') == 'A'){
                $this->load->view('agregarempleado');
            } else {
                redirect(base_url() . 'principal');   
            }            
            
            
        } else {
            redirect(base_url() . 'principal');   
        }
    }


    function guardar_empleado() {
        extract($_POST);

        $datos = $this->guarda->insertar_empleado($num_empleado, $nom_empleado, $nom_depto, $hora_ent, $hora_sal);
        $res = $datos[0]->STATUS;
        if($res == 'TRUE')
        {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        }
        else
        {
            echo json_encode(array('status' => FALSE, 'data' => ($datos)));
        }
    }
}
