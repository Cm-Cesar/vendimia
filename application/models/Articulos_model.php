<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Articulos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
     function autocompletearticulos($like){
        $sql = "select id,descripcion from articulos where descripcion like '%".$like."%';";
        return $this->db->query($sql);
    } 
    function damearticulo($idarticulo){
        $sql = "select * from articulos where id =".$idarticulo;
        $query = $this->db->query($sql)->row(0);
        $exitencia = $query->existencia;
        if($exitencia>0){
            $sql = "update articulos set existencia=(existencia-1) where id=".$idarticulo;
            $this->db->query($sql);
        }
        return $query;
    }
    function recuperacion_por_cancelacion($articulosJSON){
        $articulos = json_decode($articulosJSON);
        foreach($articulos as $row){
            $sql = "update articulos set existencia = (existencia+".$row->cantidad.") where id=".$row->idproducto;
            $this->db->query($sql);
        }
    }
    function recuperacion_por_eliminacion($data){
            $sql = "update articulos set existencia = (existencia+".$data['cantidad'].") where id=".$data['idproducto'];
            $this->db->query($sql);
    }
    function articulodisponible($data){
        $sql = "select if(existencia>=".$data["cantidad"].",'S','N') as disponible from articulos where id=".$data['idproducto'];
        $query = $this->db->query($sql)->row(0)->disponible;
        if($query=="S"){
            $sql = "update articulos set existencia=(existencia-".$data["cantidad"].") where id=".$data['idproducto'];
            $this->db->query($sql);
        }
        return $query;
    }
}