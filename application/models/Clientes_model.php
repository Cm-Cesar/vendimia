<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function autocompleteclientes($like){
        $sql = "select id,clave,concat(nombre,' ',ape_pat,' ',ape_mat) as nombre,rfc from clientes where concat(nombre,' ',ape_pat,' ',ape_mat) like '%".$like."%';";
        return $this->db->query($sql);
    }
}