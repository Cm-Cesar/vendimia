<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Configuracion_general_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function cargaconfiguraciones(){
        $sql="select * from configuracion_general";
        $query=$this->db->query($sql)->row(0);
        $_SESSION['vendimia_tasa_financiamiento']=$query->tasa_financiamiento;
        $_SESSION['vendimia_porce_enganche']=$query->porce_enganche;
        $_SESSION['vendimia_plazo_maximo']=$query->plazo_maximo;
    }
}