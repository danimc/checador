<?php

class Modifica extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /************************************* INICIA EQUIPO ***************************************/

    public function guardar_empleado($num_empleado, $nom_empleado, $nom_depto, $hora_entrada, $hora_salida) {
        $query = $this->db->query('CALL sp_agregar_empleado('.$num_empleado.',"'.$nom_empleado.'", "'.$nom_depto.'","'.$hora_entrada.'","'.$hora_salida.'");');
        return $query->result();
    }


 /************************************* FIN EQUIPO ***************************************/
}
?>