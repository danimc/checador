<?php

class Auth extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function usuario_por_nombre_contrasena($nombre, $contrasena) {
        $consulta = $this->db->query("CALL sp_ingresar ('$nombre', '$contrasena')");
        $res = $consulta->result()[0]->STATUS;
        if($res == 'TRUE')
        {
            $resultado = $consulta->row();
            $this->session->set_userdata("valido", TRUE);
            return $resultado;
        }

    }

    public function valido() {
        //$this->load->library('session');
        if ($this->session->userdata("valido") === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
