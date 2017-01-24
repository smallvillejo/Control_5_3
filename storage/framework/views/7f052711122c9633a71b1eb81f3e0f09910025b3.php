
<!-- Modal Registrar Producto -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro Nuevo Producto</h4>
      </div>
      <div class="modal-body">

       <form class="form-horizontal" enctype="multipart/form-data" id="upload_form" role="form" method="POST" action="" >
         <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">   

         <div class="form-group">
          <label class="col-sm-3 control-label"></label>
          <div class="col-sm-9">
           <div class="panel panel-danger" style="display:none" id="estilo_mensaje">
            <div class="panel-heading" id="id_validacion" style="display:none">
            </div>
          </div>
        </div>
      </div>
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="form-group">
        <label class="col-sm-3 control-label">Nombre Producto:</label>
        <div class="col-sm-9">
         <input type="text" id="nombre_producto" name="nombre_producto" placeholder="Nombre Producto" class="form-control" autofocus>
         <!-- <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span> -->
       </div>
     </div>
     <div class="form-group">
      <label class="col-sm-3 control-label">Stock Producto:</label>
      <div class="col-sm-9">
       <input type="number" id="cantidad_producto" name="cantidad_producto" placeholder="Stock Producto" class="form-control">      
     </div>
   </div>  

   <div class="form-group">
    <label class="col-sm-3 control-label">Valor Inversión:</label>
    <div class="col-sm-9">
     <input type="number" id="valor_inversion_producto" name="valor_inversion_producto" placeholder="Valor Inversión Producto" class="form-control">      
   </div>
 </div>

 <div class="form-group">
  <label class="col-sm-3 control-label">Valor Total Inversión:</label>
  <div class="col-sm-9">
   <input type="text" id="valor_total_inversion" name="valor_total_inversion" placeholder="Valor Total Inversión Producto" class="form-control" readonly>     
 </div>
</div>

<div class="form-group">
  <label class="col-sm-3 control-label">Valor Venta Producto:</label>
  <div class="col-sm-9">
   <input type="number" id="valor_venta_producto" name="valor_venta_producto" placeholder="Valor Venta Producto" class="form-control">    
   <div class="panel panel-danger" style="display:none" id="id_estilo">
    <div class="panel-heading" id="valida_valor_venta_producto" style="display:none">
    </div>
  </div>  
</div>
</div>

<div class="form-group">    
  <label class="col-sm-3 control-label">Imagen Producto:</label>  
  <div class="col-sm-9">   
    <input type="file" name="imagenProducto" class="form-control" id="catagry_logo">
    <span class="help-block">Solo se permiten formatos: JPG, JPEG y PNG</span>        
  </div>
</div>

<div class="form-group" id="div_photo_producto" style="display: none">    
  <label class="col-sm-3 control-label">Vista Previa:</label> 
  <div class="col-sm-9">  
   <img id="img_destino" name="img_destino" height="200" width="300">     
 </div>
</div>
</form>
<div class="col-sm-offset-4">
  <div class="col-sm-3">    
    <button type="button" class="btn btn-primary btn-block Registrar_Producto addbtn">Registrar</button>
  </div>
  <div class="col-sm-3"> 
   <button type="button" class="btn btn-danger btn-block" id="btn_cancelar_formulario_productos">Cancelar</button>
 </div>
</div>


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="ModalConfirmacion2" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">        
        <center><b><strong> <font size ="3", color="#fb0c48" face="Arial Black"><label id="TitleModal2"></label></font></strong></b></center>
      </div>
      <div class="modal-body">
        <b><strong> <font size ="3", color="#000000" face="Arial Black"><label id="CuerpoMensaje2"></label></font></strong></b>     
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-primary RegistrarProducto" data-dismiss="modal">Si</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('#btn_cancelar_formulario_productos').click(function(){
    Listar_Productos();
  });
  function Listar_Productos(){
    $.ajax({
      type:'get',
      url:'<?php echo e(url('Cargar_Productos_En_Administrar')); ?>',
      success: function(data){
        $('#Panel_Tabla_Administrar_Productos').show();
        $('#btn_nuevo_producto').show();
        $('#Panel_Formulario_Registro_Productos').hide(); 
        $('#Tabla_Administrar_Productos').empty().html(data);
      }
    });
  }
  function mostrarImagen(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#img_destino').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }else{
      $('#div_photo_producto').hide();
    }
  }

  $("#catagry_logo").change(function(){
    $('#div_photo_producto').show();
    mostrarImagen(this);
  });

  $("#valor_inversion_producto").change(function(){
    var cantidad_productoo =$('#cantidad_producto').val();
    var valor_inversion_productoo =$('#valor_inversion_producto').val();    
    var cantidad_producto =parseInt($('#cantidad_producto').val());
    var valor_inversion_producto =parseInt($('#valor_inversion_producto').val());
    var valor_venta_productoo =parseInt($('#valor_venta_producto').val());
    var total;
    total=(cantidad_producto*valor_inversion_producto);
    $('#valor_total_inversion').val(ConvertirDecimales(total));   
    if(valor_inversion_productoo==""){
      $('#valor_total_inversion').val('0');
    } 

    if(valor_inversion_productoo==""){
      $('#valor_inversion_producto').val('0');
    }

    if(valor_total_inversion=="NaN"){
      $('#valor_total_inversion').val('0');
    }


    if(valor_inversion_producto>=valor_venta_productoo){
      $('#id_estilo').show();
      document.getElementById("valida_valor_venta_producto").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
      document.getElementById("valida_valor_venta_producto").style.display = "block";
    }else{
      document.getElementById("valida_valor_venta_producto").innerText = "";
      $('#id_estilo').hide();
    }


  });

  $("#cantidad_producto").change(function(){    
    var cantidad_productoo =$('#cantidad_producto').val();    
    var cantidad_producto =parseInt($('#cantidad_producto').val());
    var valor_inversion_producto =parseInt($('#valor_inversion_producto').val());
    var valor_total_inversion =$('#valor_total_inversion').val();   
    var total;
    total=(cantidad_producto*valor_inversion_producto);
    $('#valor_total_inversion').val(ConvertirDecimales(total));   
    if(cantidad_productoo==""){
      $('#valor_total_inversion').val('0');
    }
    if(valor_total_inversion==""){
      $('#valor_total_inversion').val('0');
    } 

    if(valor_total_inversion=="NaN"){
      $('#valor_total_inversion').val('0');
    }
    if(cantidad_productoo=="0"){
      $('#valor_total_inversion').val('0');
    }

    if(cantidad_producto<0){
      $('#estilo_mensaje').show();
      document.getElementById("id_validacion").innerText = "El stock del producto no puede ser negativo.";
      document.getElementById("id_validacion").style.display = "block";
    }
  });
  $("#valor_total_inversion").change(function(){
    var valor_total_inversion =$('#valor_total_inversion').val();
    if(valor_total_inversion==""){
      $('#valor_total_inversion').val('0');
    }   
  });

  $("#valor_venta_producto").change(function(){
    var valor_venta_producto =$('#valor_venta_producto').val();
    var valor_venta_productoo =parseInt($('#valor_venta_producto').val());
    var valor_inversion_producto =parseInt($('#valor_inversion_producto').val());
    if(valor_venta_producto==""){
      $('#valor_venta_producto').val('0');
    }

    // if(valor_inversion_producto>=valor_venta_productoo){
    //  $('#id_estilo').show();
    //  document.getElementById("valida_valor_venta_producto").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
    //  document.getElementById("valida_valor_venta_producto").style.display = "block";
    // }else{
    //  document.getElementById("valida_valor_venta_producto").innerText = "";
    //  $('#id_estilo').hide();
    // }
  });

  function ConvertirDecimales(n, dp) {
    var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
    while ( (i -= 3) > 0 ) { r = '.' + s.substr(i, 3) + r; }
    return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
  }

  function Validacion_Registro(){
    var espacio_blanco    = /[a-z]/i;  //Expresión regular
    var nombre_producto =$('#nombre_producto').val(); 

    var cantidad_producto =$('#cantidad_producto').val(); 
    var cantidad_productoo =parseInt($('#cantidad_producto').val());
    var valor_inversion_producto =$('#valor_inversion_producto').val();     
    var valor_total_inversion =$('#valor_total_inversion').val();       
    var valor_venta_producto =$('#valor_venta_producto').val();
    var valor_venta_productoo =parseInt($('#valor_venta_producto').val());
    var valor_inversion_productoo=parseInt($('#valor_inversion_producto').val());
    var imagenProducto=document.getElementById("catagry_logo");

    if(!espacio_blanco.test(nombre_producto)){
      $('#estilo_mensaje').show();
      document.getElementById("id_validacion").innerText = "El nombre del Producto no puede estar vacio.";
      document.getElementById("id_validacion").style.display = "block";
      $('#nombre_producto').val('');      
      document.getElementById("nombre_producto").focus();
      return true;
    }else{
      if(nombre_producto==""){        
        $('#estilo_mensaje').show();
        document.getElementById("id_validacion").innerText = "El nombre del Producto no puede estar vacio.";
        document.getElementById("id_validacion").style.display = "block";
        return true;

      }else{
        if(cantidad_producto=="" || cantidad_producto=="0"){        
          $('#estilo_mensaje').show();
          document.getElementById("id_validacion").innerText = "La cantidad del Producto no puede estar vacio ni ser 0.";
          document.getElementById("id_validacion").style.display = "block";
          document.getElementById("cantidad_producto").focus();
          return true;

        }else{
          if(cantidad_productoo<0){
            $('#estilo_mensaje').show();
            document.getElementById("id_validacion").innerText = "El stock del producto no puede ser negativo.";
            document.getElementById("id_validacion").style.display = "block";
            return true;

          }else{

            if(valor_inversion_producto=="" || valor_inversion_producto=="0"){
              $('#estilo_mensaje').show();
              document.getElementById("id_validacion").innerText = "El valor de la inversión no puede estar vacio ni ser 0.";
              document.getElementById("id_validacion").style.display = "block";
              document.getElementById("valor_inversion_producto").focus();
              return true;

            }else{
              if(valor_venta_producto=="" || valor_venta_producto=="0"){
                $('#estilo_mensaje').show();
                document.getElementById("id_validacion").innerText = "El valor de venta no puede estar vacio ni ser 0.";
                document.getElementById("id_validacion").style.display = "block";
                document.getElementById("valor_venta_producto").focus();
                return true;

              }else{
                if(valor_inversion_productoo>=valor_venta_productoo){
                  $('#estilo_mensaje').show();
                  document.getElementById("id_validacion").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
                  document.getElementById("id_validacion").style.display = "block";
                  return true;
                }else{
                  if(imagenProducto.value==""){
                    $('#estilo_mensaje').show();
                    document.getElementById("id_validacion").innerText = "Selecciona una imagen para el producto.";
                    document.getElementById("id_validacion").style.display = "block";
                    return true;
                  }else{                    
                    $('#estilo_mensaje').hide();
                    document.getElementById("id_validacion").innerText = "";
                    return false;
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  $('.Registrar_Producto').click(function(){

    if(Validacion_Registro()==true){
      subir();      
    }else{
      $('#ModalConfirmacion2').modal('show');
      $('#TitleModal2').text('Esperando Confirmación...');  
      $('#CuerpoMensaje2').text('¿Esta seguro de registrar el Producto?');
    }   
  });
  $('.RegistrarProducto').click(function(){
    cadena=$('#valor_total_inversion').val();  
    cadena=cadena.replace(".","");
    var mensaje_registro   = $('.mensaje_registro');
    $('#valor_total_inversion').val(cadena);
    $.ajax({
      url:'RegistrarNewProducto',
      data:new FormData($("#upload_form")[0]),
      dataType:'json',
      async:false,
      type:'post',
      processData: false,
      contentType: false,
      success:function(respuesta){
        if(respuesta==0){        
          $('#success-alerta1').show();          
          mensaje_registro.slideDown();   
          Listar_Productos();
          subir();     
          $(document).ready (function(){                               
            $("#success-alerta1").hide(); 
            $("#success-alerta1").alert();     
            $("#success-alerta1").fadeTo(4500, 500).slideUp(500, function(){
              $("#success-alerta1").hide();
            });  
          });
          
        }
      },
    });
  }); 


  var arriba;
  function subir() {
    if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
      window.scrollBy(0, -1000);
      arriba = setTimeout('subir()', 10);
    }
    else clearTimeout(arriba);
  }

  $('.html').change


</script>

<style>
  .html {
    position: relative;
    min-width: 1024px;
    min-height: 768px;
    height: 100%;
  }
</style>
