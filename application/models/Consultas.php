<?php

class Consultas extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /************************************* INICIA EQUIPO ***************************************/
    public function llenar_estatus($numero) {
        $query = $this->db->query('CALL sp_traer_empleado('.$numero.');');
        return $query->result();
    }

    public function insertar_entrada($idempleado, $password, $ip) {
        $query = $this->db->query('CALL sp_insertar_entrada('.$idempleado.', "'.$password.'","'.$ip.'");');
        return $query->result();
    }

    public function traer_empleados() {
        $query = $this->db->query('CALL sp_traer_empleados();');
        return $query->result();
    }

    public function traer_listado_empleados() {
        $query = $this->db->query('CALL sp_traer_listado_empleados();');
        return $query->result();
    }

    public function modificar_empleado($num_empleado, $departamento, $hora_entrada, $hora_salida) {
        $query = $this->db->query('CALL sp_modificar_empleado('.$num_empleado.',"'.$departamento.'","'.$hora_entrada.'","'.$hora_salida.'");');
        return $query->result();
    }    

    public function bajar_empleado($num_empleado) {
        $query = $this->db->query('CALL sp_baja_empleado('.$num_empleado.');');
        return $query->result();
    }  

    public function bloqueo_empleado($num_empleado, $activo) {
        $query = $this->db->query('CALL sp_bloqueo_empleado('.$num_empleado.',"'.$activo.'");');
        return $query->result();
    }  

    public function cambiar_contrasena($num_empleado, $password) {
        $query = $this->db->query('CALL sp_cambiar_contrasena('.$num_empleado.', "'.md5($password).'");');
        return $query->result();
    }  

    public function trae_checadas($fechaimpresion) {
        $query = $this->db->query('CALL sp_traer_checadas("'.$fechaimpresion.'");');
        return $query->result();
    } 

    public function totales_entradas($fechaimpresion) {
        $query = $this->db->query('CALL sp_totales_entradas("'.$fechaimpresion.'");');
        return $query->result();
    }  

    public function totales_salidas($fechaimpresion) {
        $query = $this->db->query('CALL sp_totales_salidas("'.$fechaimpresion.'");');
        return $query->result();
    } 

    public function modifica_checada($id_checada,$horanueva,$idusuario,$observaciones) {
        $query = $this->db->query('CALL sp_modificar_checada ('.$id_checada.',"'.$horanueva.'",'.$idusuario.',"'.$observaciones.'");');
        return $query->result();
    } 

    public function borrar_checada($id_checada,$idusuario,$observaciones) {
        $query = $this->db->query('CALL sp_borrar_checada ('.$id_checada.','.$idusuario.',"'.$observaciones.'");');
        return $query->result();
    }  

    public function trae_log($fechadatos) {
        $query = $this->db->query('CALL sp_traer_log("'.$fechadatos.'");');
        return $query->result();
    }  

    public function trae_historial($id_empleado, $fechainicial, $fechafinal) {
        $query = $this->db->query('CALL sp_traer_historial('.$id_empleado.',"'.$fechainicial.'","'.$fechafinal.'");');
        return $query->result();
    }    

    public function trae_historial_semanal($id_empleado, $fechainicial, $fechafinal) {
        $query = $this->db->query('CALL sp_checadas_semanales('.$id_empleado.',"'.$fechainicial.'","'.$fechafinal.'");');
        return $query->result();
    }   

    public function trae_departamentos() {
        $query = $this->db->query('CALL sp_traer_departamentos();');
        return $query->result();
    }  

    public function trae_detalle($fechainicial, $fechafinal) {
        $query = $this->db->query('CALL sp_traer_detalle("'.$fechainicial.'","'.$fechafinal.'");');
        return $query->result();
    } 
    public function trae_total_registros($fechainicial, $fechafinal) {
        $query = $this->db->query('CALL sp_total_faltas_checadas("'.$fechainicial.'","'.$fechafinal.'");');
        return $query->result();
    } 
    public function trae_dias_economicos($fechainicial, $fechafinal) {
        $query = $this->db->query('CALL sp_total_dias_economicos("'.$fechainicial.'","'.$fechafinal.'");');
        return $query->result();
    }      
    public function justificar($fecha, $tipo, $user, $observaciones) {
        $query = $this->db->query('CALL sp_insertar_justificacion("'.$fecha.'","'.$tipo.'","'.$user.'","'.$observaciones.'");');
        return $query->result();
    }  

    public function justifica_empleado($id_empleado, $fecha, $tipo, $observaciones, $user) {
        $query = $this->db->query('CALL sp_justificar_empleado('.$id_empleado.',"'.$fecha.'","'.$tipo.'","'.$observaciones.'","'.$user.'");');
        return $query->result();
    } 

    public function economico($id_empleado, $fecha) {
        $query = $this->db->query('CALL sp_insertar_economico('.$id_empleado.',"'.$fecha.'");');
        return $query->result();
    }  


    public function hora_actual() {
        $query = $this->db->query('CALL sp_hora_actual();');
        return $query->result();
    }        

    public function get_ultimas_checadas() {
        $query = $this->db->query('CALL sp_get_ultimas_checadas();');
        return $query->result();
    }     

 /************************************* FIN EQUIPO ***************************************/
}
?>