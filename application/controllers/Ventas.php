<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Configuracion_general_model');
        $this->load->model('Ventas_model');
        $this->load->model('Clientes_model');
        $this->load->model('Articulos_model');
        $this->Configuracion_general_model->cargaconfiguraciones();
    }
	
	public function index()
	{
		$this->load->view('Ventas/Ventas_view');
	}
    
    function carga_tabla_ventas(){
        $data = $this->Ventas_model->carga_tabla_ventas();
        $tabla="";
        if($data->result()){
            foreach($data->result() as $row){
                $tabla.="<tr>";
                $tabla.="<td>".$row->folio."</td>";
                $tabla.="<td>".$row->clavecliente."</td>";
                $tabla.="<td>".$row->nombrecliente."</td>";
                $tabla.="<td>".number_format($row->total,2,'.',',')."</td>";
                $tabla.="<td>".$row->fecha."</td>";
                $tabla.="<td>Activa</td>";
                $tabla.="</tr>";
            }
        }else{
              $tabla.="<tr>";
                $tabla.="<td colspan='6' align='center'><i>Sin Ventas Registradas</i></td>";
                $tabla.="</tr>";
        }
        echo $tabla;
    }
    function damefolio(){
        echo $this->Ventas_model->damefolio();
    }
    function autocompletearticulos(){
        $sugestion="";
        if($this->input->post("keyword")!=""){
            $datos = $this->Articulos_model->autocompletearticulos($this->input->post("keyword"));
            if($datos->result()){
                $sugestion="<ul id='articulo-list'>";
                foreach($datos->result() as $row){
                     $sugestion.='<li onClick="seleccionaarticulo(\''.$row->id.'\',\''.$row->descripcion.'\');">'.$row->descripcion.'</li>';
                }
                $sugestion.="</ul>";
            }
        }
        echo $sugestion;
    }
    function autocompleteclientes(){
        $sugestion="";
        if($this->input->post("keyword")!=""){
            $datos = $this->Clientes_model->autocompleteclientes($this->input->post("keyword"));
            if($datos->result()){
                $sugestion="<ul id='cliente-list'>";
                foreach($datos->result() as $row){
                     $sugestion.='<li onClick="seleccionacliente(\''.$row->id.'\',\''.$row->clave.'\',\''.$row->nombre.'\',\''.$row->rfc.'\');">'.$row->nombre.'</li>';
                }
                $sugestion.="</ul>";
            }
        }
        echo $sugestion;
    }
    function damearticulo(){
        $idarticulo=$this->input->post("idarticulo");
        $data = $this->Articulos_model->damearticulo($idarticulo);
        if($data->existencia==0){
            echo "N";
            return false;
        }
        $precio=($data->precio*(1+($_SESSION['vendimia_tasa_financiamiento']*$_SESSION['vendimia_plazo_maximo'])/100));
        $tabla="<tr id='tr_".$data->id."'>";
        $tabla.="<td width='40%'>".$data->descripcion."</td>";
        $tabla.="<td width='18%'>".$data->modelo."</td>";
        $tabla.="<td width='10%'><input type='number' id='cantidad_".$data->id."' class='input_cantidad readonly' onblur='verificaproducto(".$data->id.");' value='1'></td>";
        $tabla.="<td width='15%'>".number_format($precio,2,'.',',')."</td>";
        $tabla.="<td width='15%' id='importe_".$data->id."'>".number_format($precio,2,'.',',')."</td>";
        $tabla.="<td width='2%'><img src='../../img/eliminar.png' onclick='eliminar(".$data->id.")' style='width:17px; cursor:pointer;' class='disabled'></td>";
        $tabla.="<script>productosJSON.push({idproducto:".$data->id.",precio:".$precio.",cantidad:1,importe:".$precio."});  calcula();</script>";
        $tabla.="</tr>";
        echo $tabla;
        
    }
    function recuperacion_por_cancelacion(){
        $this->Articulos_model->recuperacion_por_cancelacion($this->input->post("articulosJSON"));
    }
    function recuperacion_por_eliminacion(){
        $post['idproducto']=$this->input->post('idproducto');
        $post['cantidad']=$this->input->post('cantidad');
        $this->Articulos_model->recuperacion_por_eliminacion($post);
    }
    function articulodisponible(){
        $post['idproducto']=$this->input->post('idproducto');
        $post['cantidad']=$this->input->post('cantidad');
        echo $this->Articulos_model->articulodisponible($post);
    }
    function guardar_venta(){
        foreach( $_POST as $key => $value ){
          $post[$key] = $this->input->post($key);
        }

        $data=$this->Ventas_model->guardar_venta($post); 
    }
}
