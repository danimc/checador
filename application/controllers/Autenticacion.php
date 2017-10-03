<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");

class Autenticacion extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('javascript');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('session');
    }

    
    public function iniciar_sesion() {
        $data = array();
        $this->load->view('login', $data);
    }

    public function login() {
        if ($this->input->post()) {
            $nombre = $this->input->post('usuario');
            $contrasena = $this->input->post('pass');
            $contrasena = md5($contrasena);
            $this->load->model('auth');
            $usuario = $this->auth->usuario_por_nombre_contrasena($nombre, $contrasena);
            if ($usuario) {
                $usuario_data = array(
                    'usuario' => $usuario->usuario,
                    'id_user' => $usuario->id_user,
                    'tipo' => $usuario->tipo,
                    'nombre' => $usuario->nombre,
                    'logueado' => TRUE
                );
                $this->session->set_userdata($usuario_data);
                redirect('autenticacion/logueado');
            } else {
                echo json_encode(array('status' => FALSE, 'data' => "error"));
            }
        } else {
            $this->iniciar_sesion();
        }
    }

    public function logueado() {
        if ($this->session->userdata('logueado')) {
            $data = array();
            $data['usuario'] = $this->session->userdata('usuario');
            $data['id_user'] = $this->session->userdata('id_user');
            $data['tipo'] = $this->session->userdata('tipo');
            $data['nombre'] = $this->session->userdata('nombre');
            echo json_encode(array('status' => TRUE, 'data' => $data));
        } else {
            redirect('autenticacion/iniciar_sesion');
        }
    }

    public function cerrar_sesion() {
        $usuario_data = array(
            'logueado' => FALSE
        );
        $this->session->set_userdata($usuario_data);
        redirect('login');
    }

}
