	
	<?php $__env->startSection('title'); ?>
	Administrar Alimentos
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
				<a href="<?php echo e(URL::route('AdministrarAlimentos')); ?>">Administrar Alimentos</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<i class="fa fa-file-o"></i>
				<a href="#" id="btn_nuevo_alimento">Registrar Nuevo Alimento</a>
				<i class="fa fa-angle-right"></i>	
			</li>
			<li id="busqueda_alimento" class="busqueda_alimento">
				<i class="fa fa-binoculars" aria-hidden="true"></i>
				<a href="#" id="btn_buscar_alimento">Buscar Alimento</a>
				<i class="fa fa-angle-right"></i>	
			</li>

			<li class="dropdown" id="reportes" class="reportes">
				<i class="fa fa-book" aria-hidden="true"></i>	
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes - Listado de Alimentos
					<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>							
							<a href="<?php echo e(URL::route('Exportar_Excel_Total_Alimentos')); ?>" title="Exportar Excel" id="btn_reporte_excel_alimento"><i class="fa fa-file-excel-o" aria-hidden="true"></i>EXCEL</a>	
						</li>
						<li>
							<a href="<?php echo e(URL::route('Exportar_PDF_Total_Alimentos')); ?>" title="Exportar PDF" id="btn_reporte_pdf_alimento"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>PDF</a>	
						</li>						
					</ul>
				</li>	
			</ul>
		</div>	
		<br>
		<br>
		<br>	
		<!-- <button class="btn btn-primary clicko">CLICKO</button>	 -->
		<!-- <button class="btn btn-primary clicko2">CLICKO2</button> -->
		<div class="panel panel-default" id="Panel_Tabla_Administrar_Alimentos" style="display: none">
			<div class="panel-heading"><center><i class="fa fa-cube fa-2x"><font face="Lucida Sans">Hay <label id="PocoStockAlimentos"><font face="Lucida Sans", font size ="5"><strong></strong></font></label> Alimentos con poco STOCK</font></i></center>
			</div>
			<div class="panel-body">			
				<div class="alert alert-success" style="display: none;" id="success-alerta1">				
					<h3><span class="fa fa-thumbs-up fa-2x"></span> <strong>El alimento se registró con éxito!!.</strong></h3>					
				</div>
				<div class="alert alert-danger" style="display: none;" id="success-alerta2">					
					<h3><span class="fa fa-thumbs-up fa-2x"></span>
						<strong>El alimento se elimino con éxito!!.</strong></h3>	
					</div>
					<div class="alert alert-info" style="display: none;" id="success-alerta3">					
						<h3><span class="fa fa-thumbs-up fa-2x"></span>
							<strong>El Alimento se actualizo con éxito!!.</strong></h3>	
						</div>
						<div class="alert alert-danger" style="display: none;" id="success-alerta4">					
							<h3><span class="fa fa-thumbs-down fa-2x"></span>
								<strong>ERROR: No hay nada nuevo a modificar.</strong></h3>	
							</div>
							<div id="Tabla_Administrar_Alimentos">						
							</div>				
						</div>
					</div>			
					<script type="text/javascript">
						Listar_Alimentos();
						Cargar_Cantidad_Stock_Alimento_Acabarse();
						
						function Cargar_Cantidad_Stock_Alimento_Acabarse(){
							$.ajax({
								type:'get',
								url:'<?php echo e(url('CargarCantidadStockAcabarseAlimento')); ?>',
								success: function(data){
									$('#PocoStockAlimentos').text(data); 
									$("#PocoStockAlimentos").css("fontSize", 23);									
									$("#PocoStockAlimentos").css("font-weight","Bold");
								}					
							});
						}
						function Listar_Alimentos(){
							$.ajax({
								type:'get',
								url:'<?php echo e(url('AlimentosConPocoStock')); ?>',
								success: function(data){
									$('#Panel_Tabla_Administrar_Alimentos').show();  
									$('#Panel_Formulario_Administrar_Photos_Alimentos').hide(); 
									$('#Tabla_Administrar_Alimentos').empty().html(data);
									subir();
									Cargar_Cantidad_Stock_Alimento_Acabarse();
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
										$('#Tabla_Administrar_Alimentos').empty().html(data);
										subir();
									}
								});
							});				
						}

						$('#btn_nuevo_alimento').click(function(){					
							$('#Modal_Registro_Alimentos').modal('show');			
						});

						$('#btn_buscar_alimento').click(function(){	

							$('#id_alimento').selectpicker('toggle');
							$('#id_alimento').val('').selectpicker('refresh');
							$('#id_alimento').focus()
							$('#Modal_buscar_alimento').modal('show');						

						});	

					</script>	



					<!-- Empieza Registro Alimentos -->
					<!-- Modal Registrar Alimento -->
					<div class="modal fade" id="Modal_Registro_Alimentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">						
									<h4 class="modal-title" id="myModalLabel">Registro Nuevo Alimento</h4>
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
											<label class="col-sm-3 control-label">Nombre Alimento:</label>
											<div class="col-sm-9">
												<input type="text" id="nombre_alimento" name="nombre_alimento" placeholder="Nombre Alimento" class="form-control" autofocus>
												<!-- <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span> -->
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">Stock Alimento:</label>
											<div class="col-sm-9">
												<input type="number" id="cantidad_alimento" name="cantidad_alimento" placeholder="Stock Alimento" class="form-control">      
											</div>
										</div>  

										<div class="form-group">
											<label class="col-sm-3 control-label">Valor Inversión:</label>
											<div class="col-sm-9">
												<input type="number" id="valor_inversion_aliemnto" name="valor_inversion_aliemnto" placeholder="Valor Inversión Aliemnto" class="form-control">      
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Valor Total Inversión:</label>
											<div class="col-sm-9">
												<input type="text" id="valor_total_inversion" name="valor_total_inversion" placeholder="Valor Total Inversión Alimento" class="form-control" readonly>     
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Valor Venta Alimento:</label>
											<div class="col-sm-9">
												<input type="number" id="valor_venta_alimento" name="valor_venta_alimento" placeholder="Valor Venta Alimento" class="form-control">    
												<div class="panel panel-danger" style="display:none" id="id_estilo">
													<div class="panel-heading" id="valida_valor_venta_alimento" style="display:none">
													</div>
												</div>  
											</div>
										</div>

										<div class="form-group">    
											<label class="col-sm-3 control-label">Imagen Alimento:</label>  
											<div class="col-sm-9">   
												<input type="file" name="imagenAlimento" class="form-control btn btn-primary" id="catagry_logo" accept="image/jpeg, image/jpg" />
												<span class="help-block">Solo se permiten formatos: JPG y JPEG.</span>        
											</div>
										</div>

										<div class="form-group" id="div_photo_alimento" style="display: none">    
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
										<button type="button" class="btn btn-primary Registrar_Alimento addbtn" id="btn_registrar_alimento">Registrar</button>
										<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_alimentos" data-dismiss="modal">Cancelar</button>
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
										<button type="button" class="btn btn-primary RegistrarAlimento" data-dismiss="modal">Si</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									</div>
								</div>
							</div>
						</div>


						<script type="text/javascript">		


							function Obtener_Imagen_Registro_Alimento(input) {
								var size=2097152;
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									var file_size=document.getElementById('catagry_logo').files[0].size;
									if(file_size>=size){
										$('#estilo_mensaje').show();
										document.getElementById("id_validacion").innerText = "La imagen que intentas subir es muy pesada.";
										document.getElementById("id_validacion").style.display = "block";
										$('#Modal_Registro_Alimentos').scrollTop(0);					
										document.getElementById('btn_registrar_alimento').disabled=true;
										$('#catagry_logo').val('');	
										$('#div_photo_alimento').hide();
										$('#div_peso_imagen').hide();				
										return false;
									}
									document.getElementById('btn_registrar_alimento').disabled=false;
									$('#estilo_mensaje').hide();
									document.getElementById("id_validacion").innerText = "";			reader.onload = function (e) {
										$('#img_destino').attr('src', e.target.result);
										$('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
									}
									reader.readAsDataURL(input.files[0]);
								}else{
									$('#div_photo_alimento').hide();
									$('#div_peso_imagen').hide();
								}
							}

							$("#catagry_logo").change(function(){
								$('#div_photo_alimento').show();
								$('#div_peso_imagen').show();
								Obtener_Imagen_Registro_Alimento(this);
							});


							$("#valor_inversion_alimento").change(function(){
								var valor_inversion_alimentoo =$('#valor_inversion_alimento').val();
								valor_inversion_alimentoo=valor_inversion_alimentoo.replace(".","");	
								$('#valor_inversion_alimento').val(valor_inversion_alimentoo);
							});



							$("#valor_inversion_alimento").change(function(){
								var cantidad_alimentoo =$('#cantidad_alimento').val();
								var valor_inversion_alimentoo =$('#valor_inversion_alimento').val();    
								var cantidad_alimento =parseInt($('#cantidad_alimento').val());
								var valor_inversion_alimento =parseInt($('#valor_inversion_alimento').val());
								var valor_venta_alimentoo =parseInt($('#valor_venta_alimento').val());
								var total;			 




								total=(cantidad_alimento*valor_inversion_alimento);
								$('#valor_total_inversion').val(ConvertirDecimales(total));   
								if(valor_inversion_alimentoo==""){
									$('#valor_total_inversion').val('0');
								} 

								if(valor_inversion_alimentoo==""){
									$('#valor_inversion_alimento').val('0');
								}

								if(valor_total_inversion=="NaN"){
									$('#valor_total_inversion').val('0');
								}


								if(valor_inversion_alimento>=valor_venta_alimentoo){
									$('#id_estilo').show();
									document.getElementById("valida_valor_venta_alimento").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
									document.getElementById("valida_valor_venta_alimento").style.display = "block";
								}else{
									document.getElementById("valida_valor_venta_alimento").innerText = "";
									$('#id_estilo').hide();
								}


							});

							$("#cantidad_alimento").change(function(){    
								var cantidad_alimentoo =$('#cantidad_alimento').val();    
								var cantidad_alimento =parseInt($('#cantidad_alimento').val());
								var valor_inversion_alimento =parseInt($('#valor_inversion_alimento').val());
								var valor_total_inversion =$('#valor_total_inversion').val();   
								var total;


								cantidad_alimentoo=cantidad_alimentoo.replace(".","");	
								$('#cantidad_alimento').val(cantidad_alimentoo);  

								total=(cantidad_alimento*valor_inversion_alimento);
								$('#valor_total_inversion').val(ConvertirDecimales(total));   
								if(cantidad_alimentoo==""){
									$('#valor_total_inversion').val('0');
								}
								if(valor_total_inversion==""){
									$('#valor_total_inversion').val('0');
								} 

								if(valor_total_inversion=="NaN"){
									$('#valor_total_inversion').val('0');
								}
								if(cantidad_alimentoo=="0"){
									$('#valor_total_inversion').val('0');
								}

								if(cantidad_alimento<0){
									$('#estilo_mensaje').show();
									document.getElementById("id_validacion").innerText = "El stock del alimento no puede ser negativo.";
									document.getElementById("id_validacion").style.display = "block";
								}
							});
							$("#valor_total_inversion").change(function(){
								var valor_total_inversion =$('#valor_total_inversion').val();		

								if(valor_total_inversion==""){
									$('#valor_total_inversion').val('0');
								}   
							});

							$("#valor_venta_alimento").change(function(){
								var valor_venta_alimento =$('#valor_venta_alimento').val();
								valor_venta_alimento=valor_venta_alimento.replace(".","");	
								$('#valor_venta_alimento').val(valor_venta_alimento);
							});


							$("#valor_venta_alimento").change(function(){
								var valor_venta_alimento =$('#valor_venta_alimento').val();			
								if(valor_venta_alimento==""){
									$('#valor_venta_alimento').val('0');
								}
							});

							function ConvertirDecimales(n, dp) {
								var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
								while ( (i -= 3) > 0 ) { r = '.' + s.substr(i, 3) + r; }
								return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
							}

							function Validacion_Registro(){
    var espacio_blanco    = /[a-z]/i;  //Expresión regular
    var nombre_alimento =$('#nombre_alimento').val(); 

    var cantidad_alimento =$('#cantidad_alimento').val(); 
    var cantidad_alimentoo =parseInt($('#cantidad_alimento').val());
    var valor_inversion_alimento =$('#valor_inversion_alimento').val();     
    var valor_total_inversion =$('#valor_total_inversion').val();       
    var valor_venta_alimento =$('#valor_venta_alimento').val();
    var valor_venta_alimentoo =parseInt($('#valor_venta_alimento').val());
    var valor_inversion_alimentoo=parseInt($('#valor_inversion_alimento').val());
    var imagenAlimento=document.getElementById("catagry_logo");

    if(!espacio_blanco.test(nombre_alimento)){
    	$('#estilo_mensaje').show();
    	document.getElementById("id_validacion").innerText = "El nombre del Alimento no puede estar vacio.";
    	document.getElementById("id_validacion").style.display = "block";
    	$('#nombre_alimento').val('');      
    	document.getElementById("nombre_alimento").focus();
    	return true;
    }else{
    	if(nombre_alimento==""){        
    		$('#estilo_mensaje').show();
    		document.getElementById("id_validacion").innerText = "El nombre del Alimento no puede estar vacio.";
    		document.getElementById("id_validacion").style.display = "block";
    		return true;

    	}else{
    		if(cantidad_alimento=="" || cantidad_alimento=="0"){        
    			$('#estilo_mensaje').show();
    			document.getElementById("id_validacion").innerText = "La cantidad del Alimento no puede estar vacio ni ser 0.";
    			document.getElementById("id_validacion").style.display = "block";
    			document.getElementById("cantidad_alimento").focus();
    			return true;

    		}else{
    			if(cantidad_alimentoo<0){
    				$('#estilo_mensaje').show();
    				document.getElementById("id_validacion").innerText = "El stock del alimento no puede ser negativo.";
    				document.getElementById("id_validacion").style.display = "block";
    				return true;

    			}else{

    				if(valor_inversion_alimento=="" || valor_inversion_alimento=="0"){
    					$('#estilo_mensaje').show();
    					document.getElementById("id_validacion").innerText = "El valor de la inversión no puede estar vacio ni ser 0.";
    					document.getElementById("id_validacion").style.display = "block";
    					document.getElementById("valor_inversion_alimento").focus();
    					return true;

    				}else{
    					if(valor_venta_alimento=="" || valor_venta_alimento=="0"){
    						$('#estilo_mensaje').show();
    						document.getElementById("id_validacion").innerText = "El valor de venta no puede estar vacio ni ser 0.";
    						document.getElementById("id_validacion").style.display = "block";
    						document.getElementById("valor_venta_alimento").focus();
    						return true;

    					}else{
    						if(valor_inversion_alimentoo>=valor_venta_alimentoo){
    							$('#estilo_mensaje').show();
    							document.getElementById("id_validacion").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
    							document.getElementById("id_validacion").style.display = "block";
    							return true;
    						}else{
    							if(imagenAlimento.value==""){
    								$('#estilo_mensaje').show();
    								document.getElementById("id_validacion").innerText = "Selecciona una imagen para el alimento.";
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
$('.Registrar_Alimento').click(function(){

	if(Validacion_Registro()==true){
		$('#Modal_Registro_Alimentos').scrollTop(0);     
	}else{
		$('#ModalConfirmacion2').modal('show');
		$('#TitleModal2').text('Esperando Confirmación...');  
		$('#CuerpoMensaje2').text('¿Esta seguro de registrar el Alimento?');
	}   
});
$('.RegistrarAlimento').click(function(){
	cadena=$('#valor_total_inversion').val();  
	cadena=cadena.replace(".","");	
	$('#valor_total_inversion').val(cadena);
	var nombre_alimento=$('#nombre_alimento').val(); 
	var nombre_alimentoo = nombre_alimento.toLowerCase();
	$('#nombre_alimento').val(nombre_alimentoo); 
	$.ajax({
		url:'RegistrarNewAlimento',
		data:new FormData($("#upload_form")[0]),
		dataType:'json',
		async:false,
		type:'post',
		processData: false,
		contentType: false,
		success:function(respuesta){
			if(respuesta==0){        
				$('#success-alerta1').show();        
				Listar_Alimentos();				
				$(document).ready (function(){  
					$('#Modal_Registro_Alimentos').modal('hide');                             
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
				document.getElementById("id_validacion").innerText = 'ERROR: La imagen ingresada ya esta asociada a otro alimento.';
				document.getElementById("id_validacion").style.display = "block";
				$('#Modal_Registro_Alimentos').scrollTop(0);
			}

			if(respuesta.error==false){
				$.each(respuesta.errors,function(index, error){  
					$('#estilo_mensaje').show();
					document.getElementById("id_validacion").innerText = 'ERROR: '+error;
					document.getElementById("id_validacion").style.display = "block";   
				}); 
				$('#Modal_Registro_Alimentos').scrollTop(0);
			}
			Listar_Alimentos();
			cargar_nombres_alimentos();
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
	$('#nombre_alimento').val(''); 
	$('#cantidad_alimento').val('');
	$('#valor_inversion_alimento').val('');     
	$('#valor_total_inversion').val('');     
	$('#valor_venta_alimento').val('');	
	$('#catagry_logo').val('');	
	$('#div_photo_alimento').hide();
}

function LimpiarModal_Modificar_Alimento(){	
	$('#nombre_alimento_editar').val(''); 
	$('#cantidad_alimento_editar').val('');
	$('#valor_inversion_alimento_editar').val('');     
	$('#valor_total_inversion_editar').val('');     
	$('#valor_venta_alimento_editar').val('');	
	$('#catagry_logo_editar').val('');	
	$('#div_photo_alimento_editar').hide();
}

$('#btn_cancelar_formulario_alimentos').click(function(){
	LimpiarModal();
});

</script>
<!-- Termina Registro Alimentos -->



<!-- Modal Delete Alimento-->
<div class="modal fade" id="Modal_Confirmacion_Delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">¿ Esta seguro de eliminar el alimento: <b><strong> <font size ="2", color="#68caf1" face="Arial Black"><label id="NombreAlimentoEliminar"></label></font></strong></b>?.
					<input type="hidden" id="Id_alimento_delete" />
				</h4>
			</div>					
			<div class="modal-footer">						
				<button type="button" class="btn btn-primary EliminarAlimento" data-dismiss="modal">SI</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal See Alimento-->
<div class="modal fade" id="Modal_See_Alimento" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">	
			<center><img class="cuadradoFoto" id="id_photo_preview" width="100%" height="100%"/></center>			
		</div>
	</div>
</div>


<!-- Modal Buscar Alimento-->
<div class="modal fade" id="Modal_buscar_alimento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Buscar Alimento:</h4>

				<select class="form-control selectpicker" data-live-search="true" id="id_alimento" onchange="seleccion_alimentos()" >
					<option></option>
				</select>
				
			</div>			
		</div>
	</div>
</div>

<!-- carga la imagen del alimento -->
<script type="text/javascript">
	$('body').delegate('.FotoGrande','click',function(){
		var ruta_imagen_alimento =($(this).attr('Imagen'));	
		$("#id_photo_preview").attr("src",ruta_imagen_alimento);		
		$('#Modal_See_Alimento').modal('show');

	});	

	cargar_nombres_alimentos();

	function cargar_nombres_alimentos(){
		$el =$('#id_alimento');
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('cargar_nombres_alimentos') ?>",
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

	function seleccion_alimentos(){
		var id_alimento  = document.getElementById('id_alimento').value;     
		var _token=$('#_token').val();

		$.ajax({
			url   : "<?= URL::to('Consultar_Alimento_Por_ID') ?>",
			type  : "POST",
			async : false,   
			data  :{
				'_token'       	  : _token,
				'id_alimento'     : id_alimento
			},    
			success:function(data){
				$('#Panel_Tabla_Administrar_Alimentos').show();  
				$('#Panel_Formulario_Administrar_Photos_Alimentos').hide(); 
				$('#Tabla_Administrar_Alimentos').empty().html(data);
				subir();
				$('#Modal_buscar_alimento').modal('hide');							
			}
		});
	}

</script>


<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
<script type="text/javascript">
	$('body').delegate('.Delete_Aliment','click',function(){					
		var nombre_alimento =($(this).attr('NombreAlimento'));
		var Id_alimento_delete =($(this).attr('Id_alimentoEliminar'));	

		$('#NombreAlimentoEliminar').text(nombre_alimento);	
		$('#Id_alimento_delete').val(Id_alimento_delete);		

	});	
	$('.EliminarAlimento').click(function(){
		var Id_alimento_delete=$('input[id="Id_alimento_delete"]').val()
		var _token=$('#_token').val();							

		$.ajax({
			type:'POST',
			url:'<?php echo e(url('Eliminar_Alimentos')); ?>',
			async : false,
			data:{
				'Id_alimento_delete' 	: Id_alimento_delete,
				'_token' 				: _token						
			},
			success: function(respuesta){						
				if(respuesta==0){        
					$('#success-alerta2').show();        
					
					Listar_Alimentos();	

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

<!-- Modificar Alimento -->

<script type="text/javascript">	
	$('body').delegate('.Edit_Aliment','click',function(){			
		var Id_alimentoEditar =($(this).attr('Id_alimentoEditar'));	
		var _token 				=$('#_token').val();
		var $NoDisponible= 'global/images/AlimentoNoDisponible.png';
		$.ajax({
			type:'POST',
			url:'<?php echo e(url('Consultar_Alimento_Modificar')); ?>',
			async : false,
			data:{
				'Id_alimentoEditar' 	: Id_alimentoEditar,
				'_token' 				: _token						
			},
			success: function(respuesta){	

				$('#nombre_alimento_editar').val(respuesta.nombre_alimento);
				$('#cantidad_alimento_editar').val(respuesta.stock);
				$('#valor_inversion_alimento_editar').val(respuesta.valor_inversion_alimento);
				$('#valor_total_inversion_editar').val(respuesta.valor_total_inversion);
				$('#valor_venta_alimento_editar').val(respuesta.valor_venta_alimento);				
				$('#div_photo_alimento_editar').show();
				$('#id_alimento_editarr').val(respuesta.id_alimento_editarr);
				
				// existeUrl(respuesta.ruta_imagen_);
				// try {
				// 	if(fs.accessSync(respuesta.ruta_imagen_)) {
				// 		$('#img_destino_editar').attr('src', respuesta.ruta_imagen_);
				// 	}
				// } catch (e) {
				// 	console.log(e);
				// 	$('#img_destino_editar').attr("src",$NoDisponible);
				// }
				console.log(respuesta.ruta_imagen_alimento);
				$.get(respuesta.ruta_imagen_alimento)
				.done(function() { 
					$('#img_destino_editar').attr('src', respuesta.ruta_imagen_alimento);
				}).fail(function() { 
					console.clear();
					$('#img_destino_editar').attr("src",$NoDisponible);
				})
			}

		});

	});	
</script>

<!-- Modal Modificar Alimento -->
<div class="modal fade" id="Modal_Modificar_Alimentos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Modificar Alimento</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" enctype="multipart/form-data" id="Formulario_Editar_Alimento" role="form" method="POST" action="" >
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"> 
					<input type="hidden" name="id_alimento_editarr" id="id_alimento_editarr">			
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
						<label class="col-sm-3 control-label">Nombre Alimento:</label>
						<div class="col-sm-9">
							<input type="text" id="nombre_alimento_editar" name="nombre_alimento_editar" placeholder="Nombre Alimento" class="form-control" autofocus>
							<!-- <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span> -->
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Stock Alimento:</label>
						<div class="col-sm-9">
							<input type="number" id="cantidad_alimento_editar" name="cantidad_alimento_editar" placeholder="Stock Alimento" class="form-control">      
						</div>
					</div>  

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Inversión:</label>
						<div class="col-sm-9">
							<input type="number" id="valor_inversion_alimento_editar" name="valor_inversion_alimento_editar" placeholder="Valor Inversión Alimento" class="form-control">      
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Total Inversión:</label>
						<div class="col-sm-9">
							<input type="text" id="valor_total_inversion_editar" name="valor_total_inversion_editar" placeholder="Valor Total Inversión Alimento" class="form-control" readonly>     
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Valor Venta Alimento:</label>
						<div class="col-sm-9">
							<input type="number" id="valor_venta_alimento_editar" name="valor_venta_alimento_editar" placeholder="Valor Venta Alimento" class="form-control">    
							<div class="panel panel-danger" style="display:none" id="id_estilo_editar">
								<div class="panel-heading" id="valida_valor_venta_alimento_editar" style="display:none">
								</div>
							</div>  
						</div>
					</div>

					<div class="form-group">    
						<label class="col-sm-3 control-label">Imagen Alimento:</label>  
						<div class="col-sm-9">   
							<input type="file" name="imagenAlimento_editar" class="form-control btn btn-primary" id="catagry_logo_editar" accept="image/jpeg, image/jpg" />
							<span class="help-block">Solo se permiten formatos: JPG y JPEG.</span>        
						</div>
					</div>

					<div class="form-group" id="div_photo_alimento_editar" style="display: none">    
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
					<button type="button" class="btn btn-primary Editar_Alimento addbtn" id="btn_modificar_alimento">Modificar</button>
					<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_alimentos" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Modificar Alimento -->
	<!-- Modal Confirmacion Editar Alimento -->
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
					<button type="button" class="btn btn-primary ModificarAlimento" data-dismiss="modal">Si</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- Termina Modal Confirmacion Editar Alimento -->
	<!-- Validaciones Modificar Alimento -->
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
					$('#Modal_Modificar_Alimentos').scrollTop(0);					
					document.getElementById('btn_modificar_alimento').disabled=true;
					$('#catagry_logo_editar').val('');	
					$('#div_photo_alimento_editar').hide();
					$('#div_peso_imagen_editar').hide();				
					return false;
				}
				document.getElementById('btn_modificar_alimento').disabled=false;
				$('#estilo_mensaje_editar').hide();
				document.getElementById("id_validacion_editar").innerText = "";			reader.onload = function (e) {
					$('#img_destino_editar').attr('src', e.target.result);
					$('#totalPeso_editar').text(Math.round(e.loaded/1024/1024) + "MB");
				}
				reader.readAsDataURL(input.files[0]);
			}else{
				$('#div_photo_alimento').hide();
				$('#div_peso_imagen').hide();
			}
		}

		$("#catagry_logo_editar").change(function(){
			$('#div_photo_alimento_editar').show();
			$('#div_peso_imagen_editar').show();
			readURL(this);
		});





		$("#valor_inversion_alimento_editar").change(function(){
			var valor_inversion_alimentoo =$('#valor_inversion_alimento_editar').val();
			valor_inversion_alimentoo=valor_inversion_alimentoo.replace(".","");	
			$('#valor_inversion_alimento_editar').val(valor_inversion_alimentoo);
		});



		$("#valor_inversion_alimento_editar").change(function(){
			var cantidad_alimentoo =$('#cantidad_alimento_editar').val();
			var valor_inversion_alimentoo =$('#valor_inversion_alimento_editar').val();    
			var cantidad_alimento =parseInt($('#cantidad_alimento_editar').val());
			var valor_inversion_alimento =parseInt($('#valor_inversion_alimento_editar').val());
			var valor_venta_alimentoo =parseInt($('#valor_venta_alimento_editar').val());
			var total;			 




			total=(cantidad_alimento*valor_inversion_alimento);
			$('#valor_total_inversion_editar').val(ConvertirDecimales(total));   
			if(valor_inversion_alimentoo==""){
				$('#valor_total_inversion_editar').val('0');
			} 

			if(valor_inversion_alimentoo==""){
				$('#valor_inversion_alimento_editar').val('0');
			}

			if(valor_total_inversion=="NaN"){
				$('#valor_total_inversion_editar').val('0');
			}


		});

		$("#cantidad_alimento_editar").change(function(){    
			var cantidad_alimentoo =$('#cantidad_alimento_editar').val();    
			var cantidad_alimento =parseInt($('#cantidad_alimento_editar').val());
			var valor_inversion_alimento =parseInt($('#valor_inversion_alimento_editar').val());
			var valor_total_inversion =$('#valor_total_inversion_editar').val();   
			var total;


			cantidad_alimentoo=cantidad_alimentoo.replace(".","");	
			$('#cantidad_alimento_editar').val(cantidad_alimentoo);  

			total=(cantidad_alimento*valor_inversion_alimento);
			$('#valor_total_inversion_editar').val(ConvertirDecimales(total));   
			if(cantidad_alimentoo==""){
				$('#valor_total_inversion_editar').val('0');
			}
			if(valor_total_inversion==""){
				$('#valor_total_inversion_editar').val('0');
			} 

			if(valor_total_inversion=="NaN"){
				$('#valor_total_inversion_editar').val('0');
			}
			if(cantidad_alimentoo=="0"){
				$('#valor_total_inversion_editar').val('0');
			}

			if(cantidad_alimento<0){
				$('#estilo_mensaje_editar').show();
				document.getElementById("id_validacion_editar").innerText = "El stock del alimento no puede ser negativo.";
				document.getElementById("id_validacion_editar").style.display = "block";
			}
		});
		$("#valor_total_inversion_editar").change(function(){
			var valor_total_inversion =$('#valor_total_inversion_editar').val();		

			if(valor_total_inversion==""){
				$('#valor_total_inversion_editar').val('0');
			}   
		});

		$("#valor_venta_alimento_editar").change(function(){
			var valor_venta_alimento =$('#valor_venta_alimento_editar').val();
			valor_venta_alimento=valor_venta_alimento.replace(".","");	
			$('#valor_venta_alimento_editar').val(valor_venta_alimento);
		});


		$("#valor_venta_alimento_editar").change(function(){
			var valor_venta_alimento =$('#valor_venta_alimento_editar').val();			
			if(valor_venta_alimento==""){
				$('#valor_venta_alimento_editar').val('0');
			}
		});


		function Validacion_Modificar_Alimento(){
    var espacio_blanco    = /[a-z]/i;  //Expresión regular
    var nombre_alimento =$('#nombre_alimento_editar').val(); 

    var cantidad_alimento =$('#cantidad_alimento_editar').val(); 
    var cantidad_alimentoo =parseInt($('#cantidad_alimento_editar').val());
    var valor_inversion_alimento =$('#valor_inversion_alimento_editar').val();     
    var valor_total_inversion =$('#valor_total_inversion_editar').val();       
    var valor_venta_alimento =$('#valor_venta_alimento_editar').val();
    var valor_venta_alimentoo =parseInt($('#valor_venta_alimento_editar').val());
    var valor_inversion_alimentoo=parseInt($('#valor_inversion_alimento_editar').val());
    var imagenalimento=document.getElementById("catagry_logo_editar");

    var $NoDisponible= 'global/images/AlimentoNoDisponible.png';
    var src = $('img[id="img_destino_editar"]').attr('src');

    if(!espacio_blanco.test(nombre_alimento)){
    	$('#estilo_mensaje_editar').show();
    	document.getElementById("id_validacion_editar").innerText = "El nombre del alimento no puede estar vacio.";
    	document.getElementById("id_validacion_editar").style.display = "block";
    	$('#nombre_alimento_editar').val('');      
    	document.getElementById("nombre_alimento_editar").focus();
    	return true;
    }else{
    	if(nombre_alimento==""){        
    		$('#estilo_mensaje_editar').show();
    		document.getElementById("id_validacion_editar").innerText = "El nombre del Alimento no puede estar vacio.";
    		document.getElementById("id_validacion_editar").style.display = "block";
    		return true;

    	}else{
    		if(cantidad_alimento=="" || cantidad_alimento=="0"){        
    			$('#estilo_mensaje_editar').show();
    			document.getElementById("id_validacion_editar").innerText = "La cantidad del Alimento no puede estar vacio ni ser 0.";
    			document.getElementById("id_validacion_editar").style.display = "block";
    			document.getElementById("cantidad_alimento_editar").focus();
    			return true;

    		}else{
    			if(cantidad_alimentoo<0){
    				$('#estilo_mensaje_editar').show();
    				document.getElementById("id_validacion_editar").innerText = "El stock del alimento no puede ser negativo.";
    				document.getElementById("id_validacion_editar").style.display = "block";
    				return true;

    			}else{

    				if(valor_inversion_alimento=="" || valor_inversion_alimento=="0"){
    					$('#estilo_mensaje_editar').show();
    					document.getElementById("id_validacion_editar").innerText = "El valor de la inversión no puede estar vacio ni ser 0.";
    					document.getElementById("id_validacion_editar").style.display = "block";
    					document.getElementById("valor_inversion_alimento_editar").focus();
    					return true;

    				}else{
    					if(valor_venta_alimento=="" || valor_venta_alimento=="0"){
    						$('#estilo_mensaje_editar').show();
    						document.getElementById("id_validacion_editar").innerText = "El valor de venta no puede estar vacio ni ser 0.";
    						document.getElementById("id_validacion_editar").style.display = "block";
    						document.getElementById("valor_venta_alimento_editar").focus();
    						return true;

    					}else{
    						if(valor_inversion_alimentoo>=valor_venta_alimentoo){
    							$('#estilo_mensaje_editar').show();
    							document.getElementById("id_validacion_editar").innerText = "El valor de la Venta no puede ser menor o igual al de la Inversión.";
    							document.getElementById("id_validacion_editar").style.display = "block";
    							return true;
    						}else{
    							
    							if($NoDisponible==src){
    								$('#estilo_mensaje_editar').show();
    								document.getElementById("id_validacion_editar").innerText = "Selecciona una imagen para el alimento.";
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
$('.Editar_Alimento').click(function(){

	if(Validacion_Modificar_Alimento()==true){
		$('#Modal_Modificar_Alimentos').scrollTop(0);     
	}else{
		$('#ModalConfirmacion3').modal('show');
		$('#TitleModal3').text('Esperando Confirmación...');  
		$('#CuerpoMensaje3').text('¿Esta seguro de modificar el Alimento?');
	}   
});
$('.ModificarAlimento').click(function(){
	cadena=$('#valor_total_inversion_editar').val();  
	cadena=cadena.replace(".","");	
	$('#valor_total_inversion_editar').val(cadena);
	var nombre_alimento=$('#nombre_alimento_editar').val(); 
	var nombre_alimentoo = nombre_alimento.toLowerCase();
	$('#nombre_alimento_editar').val(nombre_alimentoo); 
	$.ajax({
		url:'ModificarAlimento',
		data:new FormData($("#Formulario_Editar_Alimento")[0]),
		dataType:'json',
		async:false,
		type:'post',
		processData: false,
		contentType: false,
		success:function(respuesta){			
			if(respuesta==0){        
				$('#success-alerta3').show();        
				Listar_Alimentos();				
				$(document).ready (function(){  
					$('#Modal_Modificar_Alimentos').modal('hide');                             
					$("#success-alerta3").hide(); 
					$("#success-alerta3").alert();     
					$("#success-alerta3").fadeTo(4500, 500).slideUp(500, function(){
						$("#success-alerta3").hide();
					});  
				});
				LimpiarModal_Modificar_Alimento();
			}else if(respuesta==1){
				$('#success-alerta4').show();        
				Listar_Alimentos();				
				$(document).ready (function(){  
					$('#Modal_Modificar_Alimentos').modal('hide');                             
					$("#success-alerta4").hide(); 
					$("#success-alerta4").alert();     
					$("#success-alerta4").fadeTo(4500, 500).slideUp(500, function(){
						$("#success-alerta4").hide();
					});  
				});
				LimpiarModal_Modificar_Alimento();
			}else{
				if(respuesta.error==false){
					$.each(respuesta.errors,function(index, error){  
						$('#estilo_mensaje_editar').show();
						document.getElementById("id_validacion_editar").innerText = 'ERROR: '+error;
						document.getElementById("id_validacion_editar").style.display = "block";   
					}); 
					$('#Modal_Modificar_Alimentos').scrollTop(0);
				}else{
					if(respuesta==2){				 
						$('#estilo_mensaje_editar').show();
						document.getElementById("id_validacion_editar").innerText = 'ERROR: La imagen ingresada ya esta asociada a otro alimento.';
						document.getElementById("id_validacion_editar").style.display = "block";
						$('#Modal_Modificar_Alimentos').scrollTop(0);
					}	
				}
			}
			cargar_nombres_alimentos();			
		},
		error:function(respuesta){
			// console.log(respuesta);
		}
	});
}); 


</script>
<!-- Termina Validaciones Modificar Alimento -->

<!-- Termina Modificar Alimento -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>