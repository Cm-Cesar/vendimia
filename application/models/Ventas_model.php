<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ventas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   function carga_tabla_ventas(){
       $sql=" select lpad(a.folio,4,'0') as folio, b.clave as clavecliente,concat(b.nombre,' ',b.ape_pat,' ',b.ape_mat) as nombrecliente,".
            " a.total,date_format(a.fecha_venta,'%d/%m/%Y %h:%i:%s %p') as fecha ".
            " from ventas a".
            " left join clientes b on a.idcliente=b.id";
       return $this->db->query($sql); 
   }
   function damefolio(){
       $sql="select if(exists(select * from ventas),(select lpad(ifnull(max(folio),0)+1,4,'0') from ventas),'0001') as folio;";
       return $this->db->query($sql)->row(0)->folio;
   }
   function guardar_venta($data){
       $articulos = json_decode($data['articulosJSON']);
       $sql = " insert into ventas set".
              "             folio='".$data['folio_venta']."',".
              "             idcliente=".$data['idcliente'].",".
              "             total=".$data['total'].",".
              "             enganche=".$data['enganche'].",".
              "             bonificacion_enganche=".$data['bonificacion_enganche'].";";
       $this->db->query($sql);
       $idventa=$this->db->insert_id();
       $sql = "insert into ventas_detalle(idventa,idarticulo,cantidad,precio,importe) values";
       foreach($articulos as $row){
            $sql .= "(".$idventa.",".$row->idproducto.",".$row->cantidad.",".$row->precio.",".$row->importe."),";
       }
       $sql = substr($sql,0,-1);
       $sql .= ";";
       $this->db->query($sql);
       $sql=" insert into ventas_plazo set".
            "             idventa=".$idventa.",".
            "             plazo_meses=".$data['plazo'].",".
            "             cantidad_abono=".$data['abono'].",".
            "             total_a_pagar=".$data['totalapagar'].",".
            "             ahorro=".$data['ahorro'].";";
       $this->db->query($sql);
   }
}