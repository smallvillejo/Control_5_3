	
	<?php $__env->startSection('title'); ?>
	Administrar Productos
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('content'); ?>	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-folder-open-o"></i>
				<a href="#">Administrar</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<i class="fa fa-plus-circle"></i>
				<a href="<?php echo e(URL::route('AdministrarProductos')); ?>">Administrar Productos</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<i class="fa fa-file-o"></i>
				<a href="#" id="btn_nuevo_producto">Registrar Nuevo Producto</a>
				<i class="fa fa-angle-right"></i>	
			</li>
			<li id="busqueda_producto" class="busqueda_producto">
				<i class="fa fa-binoculars" aria-hidden="true"></i>
				<a href="#" id="btn_buscar_producto">Buscar Producto</a>
				<i class="fa fa-angle-right"></i>	
			</li>

			<li class="dropdown" id="reportes" class="reportes">
				<i class="fa fa-book" aria-hidden="true"></i>	
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes - Listado de Productos
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>							
							<a href="<?php echo e(URL::route('Exportar_Excel_Total_Productos')); ?>" title="Exportar Excel" id="btn_reporte_excel_producto"><i class="fa fa-file-excel-o" aria-hidden="true"></i>EXCEL</a>	
						</li>
						<li>
							<a href="<?php echo e(URL::route('Exportar_PDF_Total_Productos')); ?>" title="Exportar PDF" id="btn_reporte_pdf_producto"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>PDF</a>	
						</li>						
					</ul>
				</li>	
			</ul>
		</div>	
		<br>
		<br>
		<br>		
		<div class="panel panel-default" id="Panel_Tabla_Administrar_Productos" style="display: none">
			<div class="panel-heading"><center><i class="fa fa-cube fa-2x"><font face="Lucida Sans">Hay <label id="PocoStockProductos"><font face="Lucida Sans", font size ="5"><strong></strong></font></label> con poco STOCK</font></i></center>
			</div>
			<div class="panel-body">			
				<div class="alert alert-success" style="display: none;" id="success-alerta1">				
					<h3><span class="fa fa-thumbs-up fa-2x"></span> <strong>El producto se registró con éxito!!.</strong></h3>					
				</div>
				<div class="alert alert-danger" style="display: none;" id="success-alerta2">					
					<h3><span class="fa fa-thumbs-up fa-2x"></span>
						<strong>El producto se elimino con éxito!!.</strong></h3>	
					</div>
					<div class="alert alert-info" style="display: none;" id="success-alerta3">					
						<h3><span class="fa fa-thumbs-up fa-2x"></span>
							<strong>El producto se actualizo con éxito!!.</strong></h3>	
						</div>
						<div class="alert alert-danger" style="display: none;" id="success-alerta4">					
							<h3><span class="fa fa-thumbs-down fa-2x"></span>
								<strong>ERROR: No hay nada nuevo a modificar.</strong></h3>	
							</div>
							<div id="Tabla_Administrar_Productos">						
							</div>				
						</div>
					</div>			
					<script type="text/javascript">
						Listar_Productos();

						Cargar_Cantidad_Stock_Producto_Acabarse();

						function Cargar_Cantidad_Stock_Producto_Acabarse(){
							$.ajax({
								type:'get',
								url:'<?php echo e(url('CargarCantidadStockAcabarseProducto')); ?>',
								success: function(data){
									var x = Number(data);				
									if(x<=1){
										$('#PocoStockProductos').text(data+' Producto'); 
									}else{
										$('#PocoStockProductos').text(data+' Productos'); 
									}
									$("#PocoStockProductos").css("fontSize", 23);									
									$("#PocoStockProductos").css("font-weight","Bold");
								}					
							});
						}


						function Listar_Productos(){
							$.ajax({
								type:'get',
								url:'<?php echo e(url('ProductosConPocoStock')); ?>',
								success: function(data){
									$('#Panel_Tabla_Administrar_Productos').show();  
									$('#Panel_Formulario_Administrar_Photos_Productos').hide(); 
									$('#Tabla_Administrar_Productos').empty().html(data);
									subir();
									Cargar_Cantidad_Stock_Producto_Acabarse();
									Notificaciones_PocoStock();

								}					
							});

							$(document).on("click",".pagination li a",function(e) {
								e.preventDefault();		
								var url = $(this).attr("href");
								$.ajax({
									type:'get',
									url:url,			
									success: function(data){
										$('#Tabla_Administrar_Productos').empty().html(data);
										subir();
									}
								});
							});				
						}

						$('#btn_nuevo_producto').click(function(){					
							$('#Modal_Registro_Productos').modal('show');			
						});

						$('#btn_buscar_producto').click(function(){	

							$('#id_producto').selectpicker('toggle');
							$('#id_producto').val('').selectpicker('refresh');
							$('#id_producto').focus()
							$('#Modal_buscar_producto').modal('show');						

						});	

					</script>	



					<!-- Empieza Registro Productos -->
					<!-- Modal Registrar Producto -->
					<div class="modal fade" id="Modal_Registro_Productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">						
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
												<input type="file" name="imagenProducto" class="form-control btn btn-primary" id="catagry_logo" accept="image/jpeg, image/jpg" />
												<span class="help-block">Solo se permiten formatos: JPG y JPEG.</span>        
											</div>
										</div>

										<div class="form-group" id="div_photo_producto" style="display: none">    
											<label class="col-sm-3 control-label">Vista Previa:</label> 
											<div class="col-sm-9">  
												<img id="img_destino" name="img_destino" height="200" width="300"> 
												<span class="help-block">Capacidad Máxima 1 MB.</span>    
											</div>
										</div>
										<div class="form-group" id="div_peso_imagen" style="display: none">    
											<label class="col-sm-3 control-label">Peso Imagen:</label> 
											<label class="col-sm control-label" id="totalPeso"></label></div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary Registrar_Producto addbtn" id="btn_registrar_producto">Registrar</button>
										<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_productos" data-dismiss="modal">Cancelar</button>
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


							function Obtener_Imagen_Registro_Producto(input) {
								var size=2097152;
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									var file_size=document.getElementById('catagry_logo').files[0].size;
									if(file_size>=size){
										$('#estilo_mensaje').show();
										document.getElementById("id_validacion").innerText = "La imagen que intentas subir es muy pesada.";
										document.getElementById("id_validacion").style.display = "block";
										$('#Modal_Registro_Productos').scrollTop(0);					
										document.getElementById('btn_registrar_producto').disabled=true;
										$('#catagry_logo').val('');	
										$('#div_photo_producto').hide();
										$('#div_peso_imagen').hide();				
										return false;
									}
									document.getElementById('btn_registrar_producto').disabled=false;
									$('#estilo_mensaje').hide();
									document.getElementById("id_validacion").innerText = "";			reader.onload = function (e) {
										$('#img_destino').attr('src', e.target.result);
										$('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
									}
									reader.readAsDataURL(input.files[0]);
								}else{
									$('#div_photo_producto').hide();
									$('#div_peso_imagen').hide();
								}
							}

							$("#catagry_logo").change(function(){
								$('#div_photo_producto').show();
								$('#div_peso_imagen').show();
								Obtener_Imagen_Registro_Producto(this);
							});


							$("#valor_inversion_producto").change(function(){
								var valor_inversion_productoo =$('#valor_inversion_producto').val();
								valor_inversion_productoo=valor_inversion_productoo.replace(".","");	
								$('#valor_inversion_producto').val(valor_inversion_productoo);
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


								cantidad_productoo=cantidad_productoo.replace(".","");	
								$('#cantidad_producto').val(cantidad_productoo);  

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
								valor_venta_producto=valor_venta_producto.replace(".","");	
								$('#valor_venta_producto').val(valor_venta_producto);
							});


							$("#valor_venta_producto").change(function(){
								var valor_venta_producto =$('#valor_venta_producto').val();			
								if(valor_venta_producto==""){
									$('#valor_venta_producto').val('0');
								}
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
		$('#Modal_Registro_Productos').scrollTop(0);     
	}else{
		$('#ModalConfirmacion2').modal('show');
		$('#TitleModal2').text('Esperando Confirmación...');  
		$('#CuerpoMensaje2').text('¿Esta seguro de registrar el Producto?');
	}   
});
$('.RegistrarProducto').click(function(){
	cadena=$('#valor_total_inversion').val();  
	cadena=cadena.replace(".","");	
	$('#valor_total_inversion').val(cadena);
	var nombre_producto=$('#nombre_producto').val(); 
	var nombre_productoo = nombre_producto.toLowerCase();
	$('#nombre_producto').val(nombre_productoo); 
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
				Listar_Productos();				
				$(document).ready (function(){  
					$('#Modal_Registro_Productos').modal('hide');                             
					$("#success-alerta1").hide(); 
					$("#success-alerta1").alert();     
					$("#success-alerta1").fadeTo(4500, 500).slideUp(500, function(){
						$("#success-alerta1").hide();
					});  
				});
				LimpiarModal();
			}

			if(respuesta==1){				 
				$('#estilo_mensaje').show();
				document.getElementById("id_validacion").innerText = 'ERROR: La imagen ingresada ya esta asociada a otro producto.';
				document.getElementById("id_validacion").style.display = "block";
				$('#Modal_Registro_Productos').scrollTop(0);
			}

			if(respuesta.error==false){
				$.each(respuesta.errors,function(index, error){  
					$('#estilo_mensaje').show();
					document.getElementById("id_validacion").innerText = 'ERROR: '+error;
					document.getElementById("id_validacion").style.display = "block";   
				}); 
				$('#Modal_Registro_Productos').scrollTop(0);
			}
			Listar_Productos();
			cargar_nombres_productos();
		},
		error:function(respuesta){
			// console.log(respuesta);
		}
	});
}); 


var arriba;
function subir() {
	if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
		window.scrollBy(0, -2000);
		arriba = setTimeout('subir()', 10);
	}
	else clearTimeout(arriba);
}

function LimpiarModal(){	
	$('#nombre_producto').val(''); 
	$('#cantidad_producto').val('');
	$('#valor_inversion_producto').val('');     
	$('#valor_total_inversion').val('');     
	$('#valor_venta_producto').val('');	
	$('#catagry_logo').val('');	
	$('#div_photo_producto').hide();
}

function LimpiarModal_Modificar_Producto(){	
	$('#nombre_producto_editar').val(''); 
	$('#cantidad_producto_editar').val('');
	$('#valor_inversion_producto_editar').val('');     
	$('#valor_total_inversion_editar').val('');     
	$('#valor_venta_producto_editar').val('');	
	$('#catagry_logo_editar').val('');	
	$('#div_photo_producto_editar').hide();
}

$('#btn_cancelar_formulario_productos').click(function(){
	LimpiarModal();
});

</script>
<!-- Termina Registro Productos -->



<!-- Modal Delete Producto-->
<div class="modal fade" id="Modal_Confirmacion_Delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de eliminar el producto: <b><strong> <font size ="2", color="#68caf1" face="Arial Black"><label id="NombreProductoEliminar"></label></font></strong></b>?.
					<input type="hidden" id="Id_producto_delete" />
				</h4>
			</div>					
			<div class="modal-footer">						
				<button type="button" class="btn btn-primary EliminarProducto" data-dismiss="modal">SI</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal See Producto-->
<div class="modal fade" id="Modal_See_Producto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">	
			<center><img class="cuadradoFoto" id="id_photo_preview" width="100%" height="100%"/></center>			
		</div>
	</div>
</div>


<!-- Modal Buscar Producto-->
<div class="modal fade" id="Modal_buscar_producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar Producto:</h4>

				<select class="form-control selectpicker" data-live-search="true" id="id_producto" onchange="seleccion_productos()" >
					<option></option>
				</select>
				
			</div>			
		</div>
	</div>
</div>

<!-- carga la imagen del producto -->
<script type="text/javascript">
	$('body').delegate('.FotoGrande','click',function(){
		var ruta_imagen_producto =($(this).attr('Imagen'));	
		$("#id_photo_preview").attr("src",ruta_imagen_producto);		
		$('#Modal_See_Producto').modal('show');

	});	

	cargar_nombres_productos();

	function cargar_nombres_productos(){
		$el =$('#id_producto');
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('cargar_nombres_productos') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	  : _token
			},
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});							

				var options = $('.selectpicker option');
				var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
				arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
				options.each(function(i, o) {
					o.value = arr[i].v;
					$(o).text(arr[i].t);
				});
			}
		});
	}

	function seleccion_productos(){
		var id_producto  = document.getElementById('id_producto').value;     
		var _token=$('#_token').val();

		$.ajax({
			url   : "<?= URL::to('Consultar_Producto_Por_ID') ?>",
			type  : "POST",
			async : false,   
			data  :{
				'_token'       	  : _token,
				'id_producto'     : id_producto
			},    
			success:function(data){
				$('#Panel_Tabla_Administrar_Productos').show();  
				$('#Panel_Formulario_Administrar_Photos_Productos').hide(); 
				$('#Tabla_Administrar_Productos').empty().html(data);
				subir();
				$('#Modal_buscar_producto').modal('hide');							
			}
		});
	}

</script>


<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
<script type="text/javascript">
	$('body').delegate('.Delete_Product','click',function(){					
		var nombre_producto =($(this).attr('NombreProducto'));
		var Id_producto_delete =($(this).attr('Id_productoEliminar'));	

		$('#NombreProductoEliminar').text(nombre_producto);	
		$('#Id_producto_delete').val(Id_producto_delete);		

	});	
	$('.EliminarProducto').click(function(){
		var Id_producto_delete=$('input[id="Id_producto_delete"]').val()
		var _token=$('#_token').val();							

		$.ajax({
			type:'POST',
			url:'<?php echo e(url('Eliminar_Productos')); ?>',
			async : false,
			data:{
				'Id_producto_delete' 	: Id_producto_delete,
				'_token' 				: _token						
			},
			success: function(respuesta){						
				if(respuesta==0){        
					$('#success-alerta2').show();        
					
					Listar_Productos();	

					$(document).ready (function(){                              
						$("#success-alerta2").alert();						    
						$("#success-alerta2").fadeTo(4500, 500).slideUp(500, function(){
							$("#success-alerta2").hide();
						});  
					});

				}
			}
		});
	});
</script>

<!-- Modificar Producto -->

<script type="text/javascript">	
	$('body').delegate('.Edit_Product','click',function(){			
		var Id_productoEditar =($(this).attr('Id_productoEditar'));	
		var _token 				=$('#_token').val();
		var $NoDisponible= 'global/images/ProductoNoDisponible.png';
		$.ajax({
			type:'POST',
			url:'<?php echo e(url('Consultar_Producto_Modificar')); ?>',
			async : false,
			data:{
				'Id_productoEditar' 	: Id_productoEditar,
				'_token' 				: _token						
			},
			success: function(respuesta){	

				$('#nombre_producto_editar').val(respuesta.nombre_producto);
				$('#cantidad_producto_editar').val(respuesta.stock);
				$('#valor_inversion_producto_editar').val(respuesta.valor_inversion_producto);
				$('#valor_total_inversion_editar').val(respuesta.valor_total_inversion);
				$('#valor_venta_producto_editar').val(respuesta.valor_venta_producto);				
				$('#div_photo_producto_editar').show();
				$('#id_producto_editarr').val(respuesta.id_producto_editarr);
				
				// existeUrl(respuesta.ruta_imagen_producto);
				// try {
				// 	if(fs.accessSync(respuesta.ruta_imagen_producto)) {
				// 		$('#img_destino_editar').attr('src', respuesta.ruta_imagen_producto);
				// 	}
				// } catch (e) {
				// 	console.log(e);
				// 	$('#img_destino_editar').attr("src",$NoDisponible);
				// }
				console.log(respuesta.ruta_imagen_producto);
				$.get(respuesta.ruta_imagen_producto)
				.done(function() { 
					$('#img_destino_editar').attr('src', respuesta.ruta_imagen_producto);
				}).fail(function() { 
					console.clear();
					$('#img_destino_editar').attr("src",$NoDisponible);
				})




			}

		});

		// 		if(respuesta.ruta_imagen_producto=="No Disponible"){
		// 			$('#img_destino_editar').attr("src",$NoDisponible);
		// 		}else{
		// 			$('#img_destino_editar').attr('src', respuesta.ruta_imagen_producto);
		// 		}	

		// 	}
		// });

		


	});	
</script>

<!-- Modal Modificar Producto -->
<div class="modal fade" id="Modal_Modificar_Productos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Modificar Producto</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" enctype="multipart/form-data" id="Formulario_Editar_Producto" role="form" method="POST" action="" >
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
					<input type="hidden" name="id_producto_editarr" id="id_producto_editarr"> 				

					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
							<div class="panel panel-danger" style="display:none" id="estilo_mensaje_editar">
								<div class="panel-heading" id="id_validacion_editar" style="display:none">
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					<div class="form-group">
						<label class="col-sm-3 control-label">Nombre Producto:</label>
						<div class="col-sm-9">
							<input type="text" id="nombre_producto_editar" name="nombre_producto_editar" placeholder="Nombre Producto" class="form-control" autofocus>
							<!-- <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span> -->
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Stock Producto:</label>
						<div class="col-sm-9">
							<input type="number" id="cantidad_producto_editar" name="cantidad_producto_editar" placeholder="Stock Producto" class="form-control">      
						</div>
					</div>  

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Inversión:</label>
						<div class="col-sm-9">
							<input type="number" id="valor_inversion_producto_editar" name="valor_inversion_producto_editar" placeholder="Valor Inversión Producto" class="form-control">      
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Total Inversión:</label>
						<div class="col-sm-9">
							<input type="text" id="valor_total_inversion_editar" name="valor_total_inversion_editar" placeholder="Valor Total Inversión Producto" class="form-control" readonly>     
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Venta Producto:</label>
						<div class="col-sm-9">
							<input type="number" id="valor_venta_producto_editar" name="valor_venta_producto_editar" placeholder="Valor Venta Producto" class="form-control">    
							<div class="panel panel-danger" style="display:none" id="id_estilo_editar">
								<div class="panel-heading" id="valida_valor_venta_producto_editar" style="display:none">
								</div>
							</div>  
						</div>
					</div>

					<div class="form-group">    
						<label class="col-sm-3 control-label">Imagen Producto:</label>  
						<div class="col-sm-9">   
							<input type="file" name="imagenProducto_editar" class="form-control btn btn-primary" id="catagry_logo_editar" accept="image/jpeg, image/jpg" />
							<span class="help-block">Solo se permiten formatos: JPG y JPEG.</span>        
						</div>
					</div>

					<div class="form-group" id="div_photo_producto_editar" style="display: none">    
						<label class="col-sm-3 control-label">Vista Previa:</label> 
						<div class="col-sm-9">  
							<img id="img_destino_editar" name="img_destino_editar" height="200" width="300"> 
							<span class="help-block">Capacidad Máxima 1 MB.</span>    
						</div>
					</div>
					<div class="form-group" id="div_peso_imagen_editar" style="display: none">    
						<label class="col-sm-3 control-label">Peso Imagen:</label> 
						<label class="col-sm control-label" id="totalPeso_editar"></label></div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary Editar_Producto addbtn" id="btn_modificar_producto">Modificar</button>
					<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_productos" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Modificar Producto -->
	<!-- Modal Confirmacion Editar Producto -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="ModalConfirmacion3" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">        
					<center><b><strong> <font size ="3", color="#fb0c48" face="Arial Black"><label id="TitleModal3"></label></font></strong></b></center>
				</div>
				<div class="modal-body">
					<b><strong> <font size ="3", color="#000000" face="Arial Black"><label id="CuerpoMensaje3"></label></font></strong></b>     
				</div>
				<div class="modal-footer">        
					<button type="button" class="btn btn-primary ModificarProducto" data-dismiss="modal">Si</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Termina Modal Confirmacion Editar Producto -->
	<!-- Validaciones Modificar Producto -->
	<script type="text/javascript">

		

		function readURL(input) {
			var size=2097152;
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var file_size=document.getElementById('catagry_logo_editar').files[0].size;
				if(file_size>=size){
					$('#estilo_mensaje_editar').show();
					document.getElementById("id_validacion_editar").innerText = "La imagen que intentas subir es muy pesada.";
					document.getElementById("id_validacion_editar").style.display = "block";
					$('#Modal_Modificar_Productos').scrollTop(0);					
					document.getElementById('btn_modificar_producto').disabled=true;
					$('#catagry_logo_editar').val('');	
					$('#div_photo_producto_editar').hide();
					$('#div_peso_imagen_editar').hide();				
					return false;
				}
				document.getElementById('btn_modificar_producto').disabled=false;
				$('#estilo_mensaje_editar').hide();
				document.getElementById("id_validacion_editar").innerText = "";			reader.onload = function (e) {
					$('#img_destino_editar').attr('src', e.target.result);
					$('#totalPeso_editar').text(Math.round(e.loaded/1024/1024) + "MB");
				}
				reader.readAsDataURL(input.files[0]);
			}else{
				$('#div_photo_producto').hide();
				$('#div_peso_imagen').hide();
			}
		}

		$("#catagry_logo_editar").change(function(){
			$('#div_photo_producto_editar').show();
			$('#div_peso_imagen_editar').show();
			readURL(this);
		});





		$("#valor_inversion_producto_editar").change(function(){
			var valor_inversion_productoo =$('#valor_inversion_producto_editar').val();
			valor_inversion_productoo=valor_inversion_productoo.replace(".","");	
			$('#valor_inversion_producto_editar').val(valor_inversion_productoo);
		});



		$("#valor_inversion_producto_editar").change(function(){
			var cantidad_productoo =$('#cantidad_producto_editar').val();
			var valor_inversion_productoo =$('#valor_inversion_producto_editar').val();    
			var cantidad_producto =parseInt($('#cantidad_producto_editar').val());
			var valor_inversion_producto =parseInt($('#valor_inversion_producto_editar').val());
			var valor_venta_productoo =parseInt($('#valor_venta_producto_editar').val());
			var total;			 




			total=(cantidad_producto*valor_inversion_producto);
			$('#valor_total_inversion_editar').val(ConvertirDecimales(total));   
			if(valor_inversion_productoo==""){
				$('#valor_total_inversion_editar').val('0');
			} 

			if(valor_inversion_productoo==""){
				$('#valor_inversion_producto_editar').val('0');
			}

			if(valor_total_inversion=="NaN"){
				$('#valor_total_inversion_editar').val('0');
			}


				// if(valor_inversion_producto>=valor_venta_productoo){
				// 	$('#id_estilo_editar').show();
				// 	document.getElementById("valida_valor_venta_producto_editar").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
				// 	document.getElementById("valida_valor_venta_producto_editar").style.display = "block";
				// }else{
				// 	document.getElementById("valida_valor_venta_producto_editar").innerText = "";
				// 	$('#id_estilo_editar').hide();
				// }


			});

		$("#cantidad_producto_editar").change(function(){    
			var cantidad_productoo =$('#cantidad_producto_editar').val();    
			var cantidad_producto =parseInt($('#cantidad_producto_editar').val());
			var valor_inversion_producto =parseInt($('#valor_inversion_producto_editar').val());
			var valor_total_inversion =$('#valor_total_inversion_editar').val();   
			var total;


			cantidad_productoo=cantidad_productoo.replace(".","");	
			$('#cantidad_producto_editar').val(cantidad_productoo);  

			total=(cantidad_producto*valor_inversion_producto);
			$('#valor_total_inversion_editar').val(ConvertirDecimales(total));   
			if(cantidad_productoo==""){
				$('#valor_total_inversion_editar').val('0');
			}
			if(valor_total_inversion==""){
				$('#valor_total_inversion_editar').val('0');
			} 

			if(valor_total_inversion=="NaN"){
				$('#valor_total_inversion_editar').val('0');
			}
			if(cantidad_productoo=="0"){
				$('#valor_total_inversion_editar').val('0');
			}

			if(cantidad_producto<0){
				$('#estilo_mensaje_editar').show();
				document.getElementById("id_validacion_editar").innerText = "El stock del producto no puede ser negativo.";
				document.getElementById("id_validacion_editar").style.display = "block";
			}
		});
		$("#valor_total_inversion_editar").change(function(){
			var valor_total_inversion =$('#valor_total_inversion_editar').val();		

			if(valor_total_inversion==""){
				$('#valor_total_inversion_editar').val('0');
			}   
		});

		$("#valor_venta_producto_editar").change(function(){
			var valor_venta_producto =$('#valor_venta_producto_editar').val();
			valor_venta_producto=valor_venta_producto.replace(".","");	
			$('#valor_venta_producto_editar').val(valor_venta_producto);
		});


		$("#valor_venta_producto_editar").change(function(){
			var valor_venta_producto =$('#valor_venta_producto_editar').val();			
			if(valor_venta_producto==""){
				$('#valor_venta_producto_editar').val('0');
			}
		});


		function Validacion_Modificar_Producto(){
    var espacio_blanco    = /[a-z]/i;  //Expresión regular
    var nombre_producto =$('#nombre_producto_editar').val(); 

    var cantidad_producto =$('#cantidad_producto_editar').val(); 
    var cantidad_productoo =parseInt($('#cantidad_producto_editar').val());
    var valor_inversion_producto =$('#valor_inversion_producto_editar').val();     
    var valor_total_inversion =$('#valor_total_inversion_editar').val();       
    var valor_venta_producto =$('#valor_venta_producto_editar').val();
    var valor_venta_productoo =parseInt($('#valor_venta_producto_editar').val());
    var valor_inversion_productoo=parseInt($('#valor_inversion_producto_editar').val());
    var imagenProducto=document.getElementById("catagry_logo_editar");

    var $NoDisponible= 'global/images/ProductoNoDisponible.png';
    var src = $('img[id="img_destino_editar"]').attr('src');

    if(!espacio_blanco.test(nombre_producto)){
    	$('#estilo_mensaje_editar').show();
    	document.getElementById("id_validacion_editar").innerText = "El nombre del Producto no puede estar vacio.";
    	document.getElementById("id_validacion_editar").style.display = "block";
    	$('#nombre_producto_editar').val('');      
    	document.getElementById("nombre_producto_editar").focus();
    	return true;
    }else{
    	if(nombre_producto==""){        
    		$('#estilo_mensaje_editar').show();
    		document.getElementById("id_validacion_editar").innerText = "El nombre del Producto no puede estar vacio.";
    		document.getElementById("id_validacion_editar").style.display = "block";
    		return true;

    	}else{
    		if(cantidad_producto=="" || cantidad_producto=="0"){        
    			$('#estilo_mensaje_editar').show();
    			document.getElementById("id_validacion_editar").innerText = "La cantidad del Producto no puede estar vacio ni ser 0.";
    			document.getElementById("id_validacion_editar").style.display = "block";
    			document.getElementById("cantidad_producto_editar").focus();
    			return true;

    		}else{
    			if(cantidad_productoo<0){
    				$('#estilo_mensaje_editar').show();
    				document.getElementById("id_validacion_editar").innerText = "El stock del producto no puede ser negativo.";
    				document.getElementById("id_validacion_editar").style.display = "block";
    				return true;

    			}else{

    				if(valor_inversion_producto=="" || valor_inversion_producto=="0"){
    					$('#estilo_mensaje_editar').show();
    					document.getElementById("id_validacion_editar").innerText = "El valor de la inversión no puede estar vacio ni ser 0.";
    					document.getElementById("id_validacion_editar").style.display = "block";
    					document.getElementById("valor_inversion_producto_editar").focus();
    					return true;

    				}else{
    					if(valor_venta_producto=="" || valor_venta_producto=="0"){
    						$('#estilo_mensaje_editar').show();
    						document.getElementById("id_validacion_editar").innerText = "El valor de venta no puede estar vacio ni ser 0.";
    						document.getElementById("id_validacion_editar").style.display = "block";
    						document.getElementById("valor_venta_producto_editar").focus();
    						return true;

    					}else{
    						if(valor_inversion_productoo>=valor_venta_productoo){
    							$('#estilo_mensaje_editar').show();
    							document.getElementById("id_validacion_editar").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
    							document.getElementById("id_validacion_editar").style.display = "block";
    							return true;
    						}else{
    							
    							if($NoDisponible==src){
    								$('#estilo_mensaje_editar').show();
    								document.getElementById("id_validacion_editar").innerText = "Selecciona una imagen para el producto.";
    								document.getElementById("id_validacion_editar").style.display = "block";
    								return true;
    							}else{                    
    								$('#estilo_mensaje_editar').hide();
    								document.getElementById("id_validacion_editar").innerText = "";
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
$('.Editar_Producto').click(function(){

	if(Validacion_Modificar_Producto()==true){
		$('#Modal_Modificar_Productos').scrollTop(0);     
	}else{
		$('#ModalConfirmacion3').modal('show');
		$('#TitleModal3').text('Esperando Confirmación...');  
		$('#CuerpoMensaje3').text('¿Esta seguro de modificar el Producto?');
	}   
});
$('.ModificarProducto').click(function(){
	cadena=$('#valor_total_inversion_editar').val();  
	cadena=cadena.replace(".","");	
	$('#valor_total_inversion_editar').val(cadena);
	var nombre_producto=$('#nombre_producto_editar').val(); 
	var nombre_productoo = nombre_producto.toLowerCase();
	$('#nombre_producto_editar').val(nombre_productoo); 
	$.ajax({
		url:'ModificarProducto',
		data:new FormData($("#Formulario_Editar_Producto")[0]),
		dataType:'json',
		async:false,
		type:'post',
		processData: false,
		contentType: false,
		success:function(respuesta){

			if(respuesta==0){        
				$('#success-alerta3').show();        
				Listar_Productos();				
				$(document).ready (function(){  
					$('#Modal_Modificar_Productos').modal('hide');                             
					$("#success-alerta3").hide(); 
					$("#success-alerta3").alert();     
					$("#success-alerta3").fadeTo(4500, 500).slideUp(500, function(){
						$("#success-alerta3").hide();
					});  
				});
				LimpiarModal_Modificar_Producto();
			}else if(respuesta==1){
				$('#success-alerta4').show();        
				Listar_Productos();				
				$(document).ready (function(){  
					$('#Modal_Modificar_Productos').modal('hide');                             
					$("#success-alerta4").hide(); 
					$("#success-alerta4").alert();     
					$("#success-alerta4").fadeTo(4500, 500).slideUp(500, function(){
						$("#success-alerta4").hide();
					});  
				});
				LimpiarModal_Modificar_Producto();
			}else{
				if(respuesta.error==false){
					$.each(respuesta.errors,function(index, error){  
						$('#estilo_mensaje_editar').show();
						document.getElementById("id_validacion_editar").innerText = 'ERROR: '+error;
						document.getElementById("id_validacion_editar").style.display = "block";   
					}); 
					$('#Modal_Modificar_Productos').scrollTop(0);
				}else{
					if(respuesta==2){				 
						$('#estilo_mensaje_editar').show();
						document.getElementById("id_validacion_editar").innerText = 'ERROR: La imagen ingresada ya esta asociada a otro producto.';
						document.getElementById("id_validacion_editar").style.display = "block";
						$('#Modal_Modificar_Productos').scrollTop(0);
					}	
				}
			}
			cargar_nombres_productos();			
		},
		error:function(respuesta){
			// console.log(respuesta);
		}
	});
}); 


</script>
<!-- Termina Validaciones Modificar Producto -->

<!-- Termina Modificar Producto -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>