<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Consulta extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('consultas');
    }

  
    function llenar_estatus() {

        extract($_GET);

        $datos = $this->consultas->llenar_estatus($numero);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }
    
    function guardar_entrada() {
        extract($_POST);

        $ip = getenv('HTTP_CLIENT_IP')?: getenv('HTTP_X_FORWARDED_FOR')?: getenv('HTTP_X_FORWARDED')?: getenv('HTTP_FORWARDED_FOR')?: getenv('HTTP_FORWARDED')?: getenv('REMOTE_ADDR');
        
        $datos = $this->consultas->insertar_entrada($idempleado, md5($password),$ip);
        $res = $datos[0]->STATUS;

        if($res == 'TRUE')
        {
            $nueva_foto = $datos[0]->foto;
            rename("fotos/".$foto, "fotos/".$nueva_foto);
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        }
        else
        {
            unlink("fotos/".$foto);
            echo json_encode(array('status' => FALSE, 'data' => ($datos)));
        }
    }

    function modifica_empleado() {
        extract($_POST);

        $datos = $this->consultas->modificar_empleado($num_empleado, $departamento, $hora_entrada, $hora_salida);
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

    function baja_empleado() {
        extract($_POST);

        $datos = $this->consultas->bajar_empleado($num_empleado);
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

    function bloqueo_empleado() {
        extract($_POST);

        $datos = $this->consultas->bloqueo_empleado($num_empleado, $activo);
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

    function cambia_contrasena() {
        extract($_POST);

        $datos = $this->consultas->cambiar_contrasena($num_empleado, $password);
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

    function traer_empleados() {

        $datos = $this->consultas->traer_empleados();

        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }

    }

    function traer_listado_empleados() {

        $datos = $this->consultas->traer_listado_empleados();

        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }

    }

    function traer_departamentos() {

        $datos = $this->consultas->trae_departamentos();

        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }

    }
    
    

    function buscar_codigo() {
        extract($_GET);

        $user = $this->session->userdata('id_user');
        $query = $this->db->query("CALL sp_buscar_equipo ('$codigo', $user)");
        
        $res = $query->result()[0]->STATUS;
        if($res == 'TRUE')
        {
            echo json_encode(array('status' => TRUE, 'data' => ($query->result_array())));
        }
        else
        {
            echo json_encode(array('status' => FALSE, 'data' => ($query->result_array())));
        }

    }


    function llenar_estatus2() {

        extract($_GET);

        $datos = $this->consultas->llenar_estatus($numero, md5($password));
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }


    function trae_checadas() {

        extract($_GET);

        $datos = $this->consultas->trae_checadas($fechaimpresion);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

    function totales_entradas() {

        extract($_GET);

        $datos = $this->consultas->totales_entradas($fechaimpresion);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }


    function totales_salidas() {

        extract($_GET);

        $datos = $this->consultas->totales_salidas($fechaimpresion);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }


     function modificar_checadas() {

        extract($_POST);

        $user = $this->session->userdata('id_user');

        $datos = $this->consultas->modifica_checada($id_checada,$horanueva,$user,$observaciones);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

     function borrar_checadas() {

        extract($_POST);

        $user = $this->session->userdata('id_user');

        $datos = $this->consultas->borrar_checada($id_checada,$user,$observaciones);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

    function traer_log() {

        extract($_GET);

        $datos = $this->consultas->trae_log($fechadatos);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

    function traer_historial() {

        extract($_GET);

        $datos = $this->consultas->trae_historial($id_empleado, $fechainicial, $fechafinal);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

    function traer_historial_semanal() {

        extract($_GET);

        $datos = $this->consultas->trae_historial_semanal($id_empleado, $fechainicial, $fechafinal);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }

    function traer_detalle() {

        extract($_GET);

        $datos = $this->consultas->trae_detalle($fechainicial, $fechafinal);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }        
    function traer_total_registros() {

        extract($_GET);

        $datos = $this->consultas->trae_total_registros($fechainicial, $fechafinal);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }     


    function traer_dias_economicos() {

        extract($_GET);

        $datos = $this->consultas->trae_dias_economicos($fechainicial, $fechafinal);
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }   

    function justificar() {
        extract($_POST);

        $user = $this->session->userdata('id_user');

        $datos = $this->consultas->justificar($fecha, $tipo, $user, $observaciones);
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

    function justifica_empleado() {
        extract($_POST);

        $user = $this->session->userdata('id_user');

        $datos = $this->consultas->justifica_empleado($id_empleado, $fecha, $tipo, $observaciones, $user);
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


     function hora_actual() {

        extract($_GET);

        $datos = $this->consultas->hora_actual();
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'hora' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }


    function economico() {
        extract($_POST);

        $datos = $this->consultas->economico($id_empleado, $fecha);
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

    function get_ultimas_checadas() {


        $datos = $this->consultas->get_ultimas_checadas();
        if ($datos) {
            echo json_encode(array('status' => TRUE, 'data' => ($datos)));
        } else {
            echo json_encode(array('status' => FALSE, 'error' => 'Nodata'));
        }
    }    

}
?>