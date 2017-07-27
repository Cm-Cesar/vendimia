<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>La Vendimia - Ventas</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="<?php echo base_url();?>jQuery-Autocomplete/dist/jquery.autocomplete.js"></script>
   <script src="<?php echo base_url();?>jQuery-Autocomplete/dist/jquery.autocomplete.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../../css/estilos.css">
</head>
<body onUnLoad="javascript:actualizar();">

    <div class="principal_fondo"></div>
  <div class="principal">
  <div id="alertas"></div>
      <img src="../../img/logo_vendimia.png" class="logo">
      <div class="contenido_principal" id="lista">
          <p class="leyenda">Ventas Activas</p>
          <button type="button" class="btn btn-primary botonnuevo" onclick="nuevaventa();"><img src="../../img/plus.png" class="plus">&nbsp;Nueva Venta</button>
          <hr class="hr">
          <table class="tabla_ventas"> 
              <thead>
                  <th width="10%" style="text-align:center;">Folio Venta</th>
                  <th width="12%" style="text-align:center;">Clave Cliente</th>
                  <th width="28%">Nombre</th>
                  <th width="15%">Total</th>
                  <th width="25%">Fecha</th>
                  <th width="10%">Estatus</th>
              </thead>
              <tbody id="lista_ventas_tbody">
              </tbody>
          </table>
          <br><br><br><br><br><br>
          <hr class="hrn">
      </div>
      <div class="nueva_venta" id="nueva_venta" style="display:none;">
          <div class="encabezado">Registro de Ventas</div>
          <div class="folio">Folio Venta: <b id="folio_venta"></b></div>
          <input type="hidden" id="folio_venta_hidden" value="">
          <div class="clientediv">
             <label class="clientelabel">Cliente</label>&nbsp;&nbsp; 
             <input type="text" class="form-control cliente readonly" id="cliente" onfocus="limpia()" placeholder="Buscar cliente..." autocomplete="off" > &nbsp;&nbsp;&nbsp; 
             <div id="suggesstion-boxcliente" style="display:inline !important;"></div>
             <label class="rfcliente" id="rfc"></label>&nbsp;&nbsp; 
             <input type="hidden" id="idcliente" value="">
          <hr class="hr">
          </div>
          <div class="articulodiv">
             <label class="articulolabel">Articulo</label>&nbsp;&nbsp;
             <!--<input type="text" class="form-control articulo" id="articulo" placeholder="Buscar articulo..."> -->
                <input type="text" class="form-control articulo readonly" id="articulo" onfocus="limpiararticulo();" placeholder="Buscar articulo..." autocomplete="off" >
                <div id="suggesstion-box" style="display:inline !important;"></div>
             <img src="../../img/agregar.png" class="btn plus2" onclick="agregar_articulo();">
             <input type="hidden" id="idarticulo" value="">
          </div>
          <hr class="hrn">
          <div>
              <table class="tabla_registro">
                  <thead>
                      <th  width="40%">Descripción Articulo</th>
                      <th  width="18%">Modelo</th>
                      <th  width="10%">Cantidad</th>
                      <th  width="15%">Precio</th>
                      <th  width="15%">Importe</th>
                      <th  width="2%"></th>
                  </thead>
                  <tbody id="lista_articulos_venta">
                  </tbody>
              </table>
          </div>
          <hr class="hrn">
          <div>
              <table  class="totales">
                  <tr>
                      <td width="50%" style="text-align:right"><label class="enganchelabel">Enganche</label></td>
                      <td id="enganche" width="50%" style="text-align:right">0.00</td>
                      <input type="hidden" id="enganche_hidden" value="0.00">
                  </tr>
                  <tr>
                      <td width="50%" style="text-align:right"><label class="bonificacionlabel">Bonificación Enganche</label></td>
                      <td id="bonificacion_enganche" width="50%" style="text-align:right">0.00</td>
                      <input type="hidden" id="bonificacion_enganche_hidden" value="0.00">
                  </tr>
                  <tr>
                      <td width="50%" style="text-align:right"><label class="totallabel">Total</label></td>
                      <td id="total" width="50%" style="text-align:right">0.00</td>
                      <input type="hidden" id="total_hidden" value="0.00">
                  </tr>
              </table>
          </div>
          <hr class="hr">
          
          <div id="pagos" class="pagos" style="display:none;">
              <div class="encabezadopago">ABONOS MENSUALES</div>
              <table class="tablapagos">
                  <tr onclick="$('#radio_3').prop('checked',true);">
                      <td>3 ABONOS DE</td>
                      <td id="abonos_de_3">$0.00</td>
                      <td id="total_de_3">TOTAL A PAGAR $0.00</td>
                      <td id="ahorro_de_3">SE AHORA $0.00</td>
                      <td><input id="radio_3" type="radio" name="plazo" value="3"></td>
                  </tr>
                  <tr onclick="$('#radio_6').prop('checked',true);">
                      <td>6 ABONOS DE</td>
                      <td id="abonos_de_6">$0.00</td>
                      <td id="total_de_6">TOTAL A PAGAR $0.00</td>
                      <td id="ahorro_de_6">SE AHORA $0.00</td>
                      <td><input id="radio_6" type="radio" name="plazo" value="6"></td>
                  </tr>
                  <tr onclick="$('#radio_9').prop('checked',true);">
                      <td>9 ABONOS DE</td>
                      <td id="abonos_de_9">$0.00</td>
                      <td id="total_de_9">TOTAL A PAGAR $0.00</td>
                      <td id="ahorro_de_9">SE AHORA $0.00</td>
                      <td><input id="radio_9" type="radio" name="plazo" value="9"></td>
                  </tr>
                  <tr onclick="$('#radio_12').prop('checked',true);">
                      <td>12 ABONOS DE</td>
                      <td id="abonos_de_12">$0.00</td>
                      <td id="total_de_12">TOTAL A PAGAR $0.00</td>
                      <td id="ahorro_de_12">SE AHORA $0.00</td>
                      <td><input id="radio_12" type="radio" name="plazo" value="12"></td>
                  </tr>
                  
              </table>
          </div>
          <div class="botones">
              <button type="button" class="btn btn-success" onclick="limpia(); limpiararticulo(); cambiar_div('nueva_venta','lista'); recuperacion_por_cancelacion();">Canelar</button>
              <button id="siguiente" type="button" class="btn btn-success" onclick="siguiente();">Siguiente</button>
              <button id="guardar" type="button" class="btn btn-success" style="display:none;" onclick="guardar();">Guardar</button>
          </div>
          <br><br><br>
          <hr class="hrn">
      </div>
  </div>
<script>
   var productosJSON=[];
   function cambiar_div(anterior,nuevo){
       $("#"+anterior).hide();
       $("#"+nuevo).show();
   }
   function nuevaventa(){
        $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/damefolio',
           type: 'POST',
           success : function(data){
               $("#folio_venta").empty();
               $("#folio_venta").html(data);
               $("#folio_venta_hidden").val('');
               $("#folio_venta_hidden").val(data);
               cambiar_div("lista","nueva_venta");
               limpiargeneral()
           }
        });
       
   }
    $(document).ready(function(){
        $("#cliente").keyup(function(){
            if($(this).val().length<3){
                return false;
            }
            $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>index.php/Ventas/autocompleteclientes',
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#cliente").css("background","#FFF url(../../img/LoaderIcon.gif) no-repeat 275px");
            },
            success: function(data){
                $("#suggesstion-boxcliente").show();
                $("#suggesstion-boxcliente").html(data);
                $("#cliente").css("background","#FFF");
            }
            });
        });
        $("#articulo").keyup(function(){
            if($(this).val().length<3){
                return false;
            }
            $.ajax({
            type: "POST",
            url: '<?php echo base_url();?>index.php/Ventas/autocompletearticulos',
            data:'keyword='+$(this).val(),
            beforeSend: function(){
                $("#articulo").css("background","#FFF url(<?php echo base_url();?>../../img/LoaderIcon.gif) no-repeat 275px");
            },
            success: function(data){
                $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
                $("#articulo").css("background","#FFF");
            }
            });
        });
    });
    function seleccionaarticulo(id,val) {
        $("#idarticulo").val(id);
        $("#articulo").val(val);
        $("#suggesstion-box").hide();
    }
    function seleccionacliente(id,folio,val,rfc) {
        $("#idcliente").val(id);
        $("#cliente").val(folio+' - '+val);
        $("#rfc").empty();
        $("#rfc").html('RFC: '+rfc);
        $("#suggesstion-boxcliente").hide();
    }
    function limpia(){
        $("#rfc").empty();
        $("#idcliente").val("");
        $("#cliente").val("");
    }
    function limpiararticulo(){
        $("#idarticulo").val("");
        $("#articulo").val("");
    }
    function limpiargeneral(){
        productosJSON=[];
        $("#lista_articulos_venta").empty();
        $("#enganche").html('0.00');
        $("#enganche_hidden").val('0.00');
        $("#bonificacion_enganche").html('0.00');
        $("#bonificacion_enganche_hidden").val('0.00');
        $("#total").html('0.00');
        $("#total_hidden").val('0.00');
        $("#pagos").hide();
        $("#guardar").hide();
        $("#siguiente").show();
        $(".readonly").removeAttr("readonly");
        $("#cliente").attr("onfocus","limpia()");
        $("#articulo").attr("onfocus","limpiararticulo()");
        $(".disabled").show();
    }
    function agregar_articulo(){
        if($("#idarticulo").val()==""){
            $("#alertas").empty();
            $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong> Debe buscar el articulo primero, favor de verificar.</div>');
            return false;
        }
        if(productosJSON.length>0){
            for(var x=0; x<productosJSON.length;x++){
            if(productosJSON[x]['idproducto']==$("#idarticulo").val()){
                $("#alertas").empty();
                $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong> El articulo Seleccionado ya esta en la lista, favor de verificar.</div>');
                return false;
            }
        }
        }
        $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/damearticulo',
           type: 'POST',
           data: 'idarticulo='+$("#idarticulo").val(),
           success : function(data){
               if(data.trim()!='N'){
                   $("#lista_articulos_venta").append(data);
                   limpiararticulo();
               }else{
                   $("#alertas").empty();
                   $("#alertas").html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong> El articulo seleccionado no cuenta con existencia, favor de verificar.</div>');
               }
           }
        });
    }
    function verificaproducto(id){
        var cantidad = parseFloat($("#cantidad_"+id).val());
        var precio=0;
        var posicion =0;
        var cant_ant=0;
        var idproducto=0;
        for(var x=0; x<productosJSON.length;x++){
            if(productosJSON[x]['idproducto']==id){
                idproducto=productosJSON[x]['idproducto'];
                precio=productosJSON[x]['precio'];
                cant_ant=productosJSON[x]['cantidad'];
                posicion=x;
            }
        }
        if(cantidad<1){
            $("#cantidad_"+id).val(cant_ant);
            $("#alertas").empty();
            $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong> La cantidad minima es 1 por articulo, favor de verificar.</div>');
            return false;
        }
        if(cantidad<cant_ant){
          var cant_dif=(cant_ant-cantidad);
           $.ajax({
               url: '<?php echo base_url();?>index.php/Ventas/recuperacion_por_eliminacion',
               type: 'POST',
               data: 'idproducto='+idproducto+'&cantidad='+cant_dif,
               success : function(data){
                   productosJSON[posicion]['cantidad']=cantidad;
                   $("#importe_"+idproducto).empty();
                   var importe = (precio*cantidad);
                   productosJSON[posicion]['importe']=importe;
                   $("#importe_"+idproducto).html(importe.toFixed(2));
                   calcula();
               }
           });
          
          return false;
        }
        if(cantidad>cant_ant){
            var cant_dif=(cantidad-cant_ant);
            $.ajax({
               url: '<?php echo base_url();?>index.php/Ventas/articulodisponible',
               type: 'POST',
               data: 'idproducto='+idproducto+'&cantidad='+cant_dif,
               success : function(data){
                   if(data.trim()=='S'){
                      productosJSON[posicion]['cantidad']=cantidad;
                      $("#importe_"+idproducto).empty();
                      var importe = (precio*cantidad);
                      productosJSON[posicion]['importe']=importe;
                      $("#importe_"+idproducto).html(importe.toFixed(2));
                      calcula();
                   }else{
                       $("#alertas").empty();
                       $("#alertas").html('<div class="alert alert-danger alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong>El articulo seleccionado no cuenta con '+cantidad+' unidades en existencia, favor de verificar.</div>');
                       $("#cantidad_"+id).val(cant_ant);
                   }
               }
            });
        }
       
    }
    function calcula(){
        if(productosJSON.length>0){
        var sumaimporte=0,enganche=0,bonificacion_enganche=0,total=0;
        for(var x=0; x<productosJSON.length;x++){
            sumaimporte += parseFloat(productosJSON[x]['importe']);
        }
        var porce_enganche=<?php echo $_SESSION['vendimia_porce_enganche'];?>;
        var plazo_maximo=<?php echo $_SESSION['vendimia_plazo_maximo'];?>;
        var tasa_financiamiento=<?php echo $_SESSION['vendimia_tasa_financiamiento'];?>;
        enganche = (parseFloat(porce_enganche/100)*sumaimporte);
        bonificacion_enganche = (enganche*((parseFloat(tasa_financiamiento)*parseFloat(plazo_maximo))/100));
        total = (sumaimporte-enganche-bonificacion_enganche);
        $("#enganche").html(enganche.toFixed(2));
        $("#enganche_hidden").val(enganche.toFixed(2));
        $("#bonificacion_enganche").html(bonificacion_enganche.toFixed(2));
        $("#bonificacion_enganche_hidden").val(bonificacion_enganche.toFixed(2));
        $("#total").html(total.toFixed(2));
        $("#total_hidden").val(total.toFixed(2));
        }else{
            $("#enganche").html('0.00');
            $("#enganche_hidden").val('0.00');
            $("#bonificacion_enganche").html('0.00');
            $("#bonificacion_enganche_hidden").val('0.00');
            $("#total").html('0.00');
            $("#total_hidden").val('0.00');
        }
    }
    function eliminar(id){
        var idproducto=0;
        var cantidad=0;
        $("#tr_"+id).remove();
        for(var x=0; x<productosJSON.length;x++){
            if(productosJSON[x]['idproducto']==id){
                idproducto=productosJSON[x]['idproducto']
                cantidad=productosJSON[x]['cantidad']
                productosJSON.splice(x,1);
            }
        }
         $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/recuperacion_por_eliminacion',
           type: 'POST',
           data: 'idproducto='+idproducto+'&cantidad='+cantidad
        });
        calcula();
        
    }
    function recuperacion_por_cancelacion(){
        if(productosJSON.length==0){
          return false;
        }
        $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/recuperacion_por_cancelacion',
           type: 'POST',
           data: 'articulosJSON='+JSON.stringify(productosJSON),
           success : function(data){
                   limpia();
                   limpiararticulo();
                   limpiargeneral()
           }
        });
    }
    function actualizar(){
        recuperacion_por_cancelacion()
    }
    function siguiente(){
        if($("#idcliente").val()==""){
             $("#alertas").empty();
             $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong>Debe seleccionar cliente antes de continuar, favor de verificar.</div>');
             return false;
        }
         if(productosJSON.length==0){
           $("#alertas").empty();
           $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong>Debe agregar al menos un articulo antes de continuar, favor de verificar.</div>');
           return false;
        }
        $(".readonly").prop("readonly",true);
        $(".readonly").removeAttr("onfocus");
        $(".disabled").hide();
        var porce_enganche=<?php echo $_SESSION['vendimia_porce_enganche'];?>;
        var plazo_maximo=<?php echo $_SESSION['vendimia_plazo_maximo'];?>;
        var tasa_financiamiento=<?php echo $_SESSION['vendimia_tasa_financiamiento'];?>;
        var totaladeudo = $("#total_hidden").val();
        var preciocontado = 0;
        var totalapagar3=0,totalapagar6=0,totalapagar9=0,totalapagar12=0;
        var importeabono3=0, importeabono6=0, importeabono9=0, importeabono12=0;
        var importeahorro3=0, importeahorro6=0, importeahorro9=0, importeahorro12=0;
        preciocontado = (parseFloat(totaladeudo)/(1+((parseFloat(tasa_financiamiento)*parseFloat(plazo_maximo))/100)));
        totalapagar3 = (preciocontado*(1+((parseFloat(tasa_financiamiento)*3)/100)));
        totalapagar6 = (preciocontado*(1+((parseFloat(tasa_financiamiento)*6)/100)));
        totalapagar9 = (preciocontado*(1+((parseFloat(tasa_financiamiento)*9)/100)));
        totalapagar12 = (preciocontado*(1+((parseFloat(tasa_financiamiento)*12)/100)));
        importeabono3 = (totalapagar3/3);
        importeabono6 = (totalapagar6/6);
        importeabono9 = (totalapagar9/9);
        importeabono12 = (totalapagar12/12);
        importeahorro3 = (parseFloat(totaladeudo)-totalapagar3);
        importeahorro6 = (parseFloat(totaladeudo)-totalapagar6);
        importeahorro9 = (parseFloat(totaladeudo)-totalapagar9);
        importeahorro12 = (parseFloat(totaladeudo)-totalapagar12);
        $("#abonos_de_3").html("$"+importeabono3.toFixed(2));
        $("#total_de_3").html("TOTAL A PAGAR $"+totalapagar3.toFixed(2));
        $("#ahorro_de_3").html("SE AHORA $"+importeahorro3.toFixed(2));
        $("#abonos_de_6").html("$"+importeabono6.toFixed(2))
        $("#total_de_6").html("TOTAL A PAGAR $"+totalapagar6.toFixed(2));
        $("#ahorro_de_6").html("SE AHORA $"+importeahorro6.toFixed(2));
        $("#abonos_de_9").html("$"+importeabono9.toFixed(2))
        $("#total_de_9").html("TOTAL A PAGAR $"+totalapagar9.toFixed(2));
        $("#ahorro_de_9").html("SE AHORA $"+importeahorro9.toFixed(2));
        $("#abonos_de_12").html("$"+importeabono12.toFixed(2))
        $("#total_de_12").html("TOTAL A PAGAR $"+totalapagar12.toFixed(2));
        $("#ahorro_de_12").html("SE AHORA $"+importeahorro12.toFixed(2));
        $("#pagos").show();
        $("#siguiente").hide();
        $("#guardar").show();
        
    }
    function guardar(){
        if($("#idcliente").val()==""){
             $("#alertas").empty();
             $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong>Debe seleccionar cliente antes de continuar, favor de verificar.</div>');
             return false;
        }
        if(productosJSON.length==0){
           $("#alertas").empty();
           $("#alertas").html('<div class="alert alert-warning alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Espere!</strong>Debe agregar al menos un articulo antes de continuar, favor de verificar.</div>');
           return false;
        }
        var folioventa = $("#folio_venta_hidden").val();
        var idcliente=$("#idcliente").val();
        var plazo=parseFloat($('input:radio[name=plazo]:checked').val());
        var porce_enganche=<?php echo $_SESSION['vendimia_porce_enganche'];?>;
        var plazo_maximo=<?php echo $_SESSION['vendimia_plazo_maximo'];?>;
        var tasa_financiamiento=<?php echo $_SESSION['vendimia_tasa_financiamiento'];?>;
        var totaladeudo = $("#total_hidden").val();
        var enganche = $("#enganche_hidden").val();
        var bonificacion_enganche = $("#bonificacion_enganche_hidden").val();
        var preciocontado = 0;
        var totalapagar=0;
        var importeabono=0;
        var importeahorro=0;
        preciocontado = (parseFloat(totaladeudo)/(1+((parseFloat(tasa_financiamiento)*parseFloat(plazo_maximo))/100)));
        totalapagar = (preciocontado*(1+((parseFloat(tasa_financiamiento)*plazo)/100)));
        importeabono = (totalapagar/plazo);
        importeahorro = (parseFloat(totaladeudo)-totalapagar);
        $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/guardar_venta',
           type: 'POST',
           data: 'folio_venta='+folioventa+'&idcliente='+idcliente+'&total='+totaladeudo+'&enganche='+enganche+
                 '&bonificacion_enganche='+bonificacion_enganche+'&plazo='+plazo+'&abono='+importeabono+
                 '&totalapagar='+totalapagar+'&ahorro='+importeahorro+'&articulosJSON='+JSON.stringify(productosJSON),
           success : function(data){
                   limpia();
                   limpiararticulo();
                   limpiargeneral();
                   cambiar_div('nueva_venta','lista');
                   carga_tabla_ventas();
                   $("#alertas").empty();
                   $("#alertas").html('<div class="alert alert-success alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Bien Hecho!</strong> Tu venta ha sido registrada correctamente.</div>');
           }
        });
        
    }
    function carga_tabla_ventas(){
         $.ajax({
           url: '<?php echo base_url();?>index.php/Ventas/carga_tabla_ventas',
           type: 'POST',
           success : function(data){
                 $("#lista_ventas_tbody").html(data);  
           }
        });
    }
    carga_tabla_ventas();
</script>
</body>
</html>