<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Configuración</title>
<br>


@if($NombreEmpresa=="")
<div class="panel panel-primary  col-xs-12 col-sm-12 col-md-10 col-md-offset-1" onmousemove="Valida_Registro2();" onchange="Valida_Registro2();">
	<div class="panel-heading" style="background-color:#32045e">
		<h2 class="panel-title">
			<strong>Configuración Cuenta</strong>
			<div class="btn-group pull-right">		
				<div class="form-group col-sm-2">
					<button type="button" class="btn btn-succes BtnRegistrar" style="background-color: #d65314" title="Guardar Cambios">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
					</button> 
				</div> 
			</div>			
		</h2>
	</div>
	<div class="panel-body">
		<h4>Antes de continuar al sistema, por primera vez debes configurar los siguientes parámetros:</h4>
		<br>
		<div class="col-xs-12 col-sm-12 col-md-12"> 	
			<div class="row">				
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
					<div class="panel-heading" id="id_validacion" style="display:none">
					</div>					
				</div>
				<form class="form-horizontal" enctype="multipart/form-data" id="FormularioRegistroCuenta" role="form" method="POST" action="" >
					<input type="hidden" name="_token" value="{{ csrf_token()}}">  
					<div class="row">	
						<div class="form-group col-sm-2">
							<i class="fa fa-desktop" aria-hidden="true" title="Nombre Empresa"></i> Nombre Empresa
						</div>
						<div class="form-group col-sm-4">
							<input type="text" name="NombreEmpresa" id="NombreEmpresa" class="form-control" placeholder="Ingresa el nombre de la empresa" autofocus>
						</div>				

						<div class="form-group col-sm-2">
							<i class="fa fa-address-card-o" aria-hidden="true"></i> Dirección Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="text" name="DireccionEmpresa" id="DireccionEmpresa" class="form-control" placeholder="Ingresa la dirección de la empresa">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<i class="fa fa-phone-square" aria-hidden="true"></i> Telefono Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="number" name="TelefonoEmpresa" id="TelefonoEmpresa" class="form-control" placeholder="Ingresa el número telefónico de la empresa">
						</div>
						<div class="form-group col-sm-2">
							<i class="fa fa-envelope" aria-hidden="true"></i> Correo Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="email" name="EmailEmpresa" id="EmailEmpresa" class="form-control" placeholder="Ingresa el email de la empresa">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<i class="fa fa-picture-o" aria-hidden="true"></i> Logo Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="file" name="ImagenLogoEmpresa" class="form-control" id="catagry_logo" accept="image/jpeg, image/jpg,image/png" placeholder="Ingresa logo de la empresa" style="background-color: #32045e; color:#ffffff; " />
							<span class="help-block">Solo se permiten formatos: JPG,JPEG y PNG.</span>        
						</div>
					</div>	
					<div class="row">			
						<div class="form-group col-sm-2">
							<div class="form-group" id="div_photo_producto" style="display: none">    
								<i class="fa fa-picture-o" aria-hidden="true"></i> Vista Previa:
							</div> 
						</div>
						<div class="form-group col-sm-4" style="display: none" id="id_img_destino">
							<img id="img_destino" name="img_destino" height="200" width="300"> 
							<span class="help-block">Capacidad Máxima 1 MB.</span>    
						</div>
						<div class="row" style="display: none" id="id_porcentaje_configuracion">
							<div class="form-group col-sm-3">
								<i class="fa fa-cog" aria-hidden="true"></i> Porcentaje Configuración 
							</div>
							<div class="form-group col-sm-3">
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%; background-color: #32045e" >
										<span id="NumeroPorcentaje"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Modal_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Esperando Confirmación</h4>
			</div>
			<div class="modal-body">
				¿ Esta seguro de Registrar la información Ingresada ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary RegistrarInformacion" id="btn_registrar_producto">Registrar</button>
				<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_productos" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

@else
<script type="text/javascript">
	var NoDisponible= 'global/images/ProductoNoDisponible.png';
	var ImagenLogo="{{$logo_empresa}};"

	console.log(ImagenLogo);

	if(ImagenLogo!=""){
		$('#imagen_destino_editar').attr('src', ImagenLogo);
		$('#div_photo_logo_editar').show();	
		$('#imagen_destino_editar').show();	
		
	}else{
		$('#imagen_destino_editar').attr("src",NoDisponible);
	}



	// $("#catagry_logo").change(function(){
	// 	$('#div_photo_producto').show();
	// 	$('#div_peso_imagen').show();		
	// 	// $('#TotalPeso').show();
	// 	$('#id_img_destino').show();
	// 	Obtener_Imagen_Registro_Producto(this);
	// });
</script>
<div class="panel panel-primary  col-xs-12 col-sm-12 col-md-10 col-md-offset-1" onmousemove="Valida_Registro2();" onchange="Valida_Registro2();">
	<div class="panel-heading" style="background-color:#32045e">
		<h2 class="panel-title">
			<strong>Configuración Cuenta</strong>
			<div class="btn-group pull-right">		
				<div class="form-group col-sm-2">
					<button type="button" class="btn btn-succes BtnRegistrar" style="background-color: #d65314" title="Guardar Cambios">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
					</button> 
				</div> 
			</div>			
		</h2>
	</div>
	<div class="panel-body">
		<h4>Antes de continuar al sistema, por primera vez debes configurar los siguientes parámetros:</h4>
		<br>
		<div class="col-xs-12 col-sm-12 col-md-12"> 	
			<div class="row">				
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
					<div class="panel-heading" id="id_validacion" style="display:none">
					</div>					
				</div>
				<form class="form-horizontal" enctype="multipart/form-data" id="FormularioRegistroCuenta" role="form" method="POST" action="" >
					<input type="hidden" name="_token" value="{{ csrf_token()}}">  
					<div class="row">	
						<div class="form-group col-sm-2">
							<i class="fa fa-desktop" aria-hidden="true" title="Nombre Empresa"></i> Nombre Empresa
						</div>
						<div class="form-group col-sm-4">
							<input type="text" name="NombreEmpresa" id="NombreEmpresa" class="form-control" placeholder="Ingresa el nombre de la empresa" value="{{$NombreEmpresa}}" autofocus>
						</div>				

						<div class="form-group col-sm-2">
							<i class="fa fa-address-card-o" aria-hidden="true"></i> Dirección Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="text" name="DireccionEmpresa" id="DireccionEmpresa" class="form-control" placeholder="Ingresa la dirección de la empresa" value="{{$direccion_empresa}}">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<i class="fa fa-phone-square" aria-hidden="true"></i> Telefono Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="number" name="TelefonoEmpresa" id="TelefonoEmpresa" class="form-control" placeholder="Ingresa el número telefónico de la empresa" value="{{$telefono_empresa}}">
						</div>
						<div class="form-group col-sm-2">
							<i class="fa fa-envelope" aria-hidden="true"></i> Correo Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="email" name="EmailEmpresa" id="EmailEmpresa" class="form-control" placeholder="Ingresa el email de la empresa" value="{{$correo_empresa}}">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-sm-2">
							<i class="fa fa-picture-o" aria-hidden="true"></i> Logo Empresa:
						</div>
						<div class="form-group col-sm-4">
							<input type="file" name="ImagenLogoEmpresa_Editar" class="form-control" id="ImagenLogoEmpresa_Editar" accept="image/jpeg, image/jpg,image/png" placeholder="Ingresa logo de la empresa" style="background-color: #32045e; color:#ffffff; " />
							<span class="help-block">Solo se permiten formatos: JPG,JPEG y PNG.</span>        
						</div>
					</div>	
					<div class="row">			
						<div class="form-group col-sm-2">
							<div class="form-group" id="div_photo_logo_editar" style="display: none">    
								<i class="fa fa-picture-o" aria-hidden="true"></i> Vista Previa:
							</div> 
						</div>
						<div class="form-group col-sm-4" style="display: none" id="id_img_destino">
							<img id="imagen_destino_editar" name="imagen_destino_editar" height="200" width="300"> 
							<span class="help-block">Capacidad Máxima 1 MB.</span>    
						</div>
						<div class="row" style="display: none" id="id_porcentaje_configuracion">
							<div class="form-group col-sm-3">
								<i class="fa fa-cog" aria-hidden="true"></i> Porcentaje Configuración 
							</div>
							<div class="form-group col-sm-3">
								<div class="progress">
									<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%; background-color: #32045e" >
										<span id="NumeroPorcentaje"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Modal_Registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Esperando Confirmación</h4>
			</div>
			<div class="modal-body">
				¿ Esta seguro de Registrar la información Ingresada ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary RegistrarInformacion" id="btn_registrar_producto">Registrar</button>
				<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_productos" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>
@endif


<script>
	$('.RegistrarInformacion').click(function(){
		$.ajax({
			url:'ConfiguracionCuentaComercio',
			data:new FormData($("#FormularioRegistroCuenta")[0]),
			dataType:'json',
			async:false,
			type:'POST',
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






	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});

	$("#catagry_logo").change(function(){
		$('#div_photo_producto').show();
		$('#div_peso_imagen').show();		
		// $('#TotalPeso').show();
		$('#id_img_destino').show();
		Obtener_Imagen_Registro_Producto(this);
	});

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
				// document.getElementById('BtnRegistrar').disabled=true;
				$('#catagry_logo').val('');	
				$('#div_photo_producto').hide();
				$('#div_peso_imagen').hide();
				// $('#PesoImagen').hide();
				// $('#TotalPeso').hide();	
				$('#id_img_destino').hide();				
				return false;
			}
			// document.getElementById('BtnRegistrar').disabled=false;
			$('#estilo_mensaje').hide();
			document.getElementById("id_validacion").innerText = "";			
			reader.onload = function (e) {
				$('#img_destino').attr('src', e.target.result);
				// $('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
				subir();
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			$('#div_photo_producto').hide();
			$('#div_peso_imagen').hide();		
			// $('#TotalPeso').hide();	
			$('#id_img_destino').hide();	

			
		}
	}

	function Valida_Registro(){
		var espacio_blanco    = /[a-z]/i;  //Expresión regular
		var espacio_blanco2   = /[0-9]/i;  //Expresión regular
		var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;   
		var src= $('input[type=file]').val()
		var NombreEmpresa= $('#NombreEmpresa').val();
		var DireccionEmpresa= $('#DireccionEmpresa').val();
		var TelefonoEmpresa= $('#TelefonoEmpresa').val();
		var EmailEmpresa= $('#EmailEmpresa').val();
		
		
		if(NombreEmpresa==""){
			$('#estilo_mensaje').show();
			document.getElementById("id_validacion").innerText = "El nombre de la empresa no puede estar vacio.";
			document.getElementById("id_validacion").style.display = "block";
			document.getElementById("NombreEmpresa").focus();
			return true;
		}else{
			if(!espacio_blanco.test(NombreEmpresa)){
				$('#estilo_mensaje').show();
				document.getElementById("id_validacion").innerText = "El nombre de la empresa no puede estar vacio.";
				document.getElementById("id_validacion").style.display = "block";
				document.getElementById("NombreEmpresa").focus();
				$('#NombreEmpresa').val('');  
				return true;				
			}else{	
				$('.progress-bar').css('width', '' + (20+ '%'));
				$('#NumeroPorcentaje').text('20% Completado');							
				if(DireccionEmpresa==""){
					$('#estilo_mensaje').show();
					document.getElementById("id_validacion").innerText = "La dirección de la empresa no puede estar vacio.";
					document.getElementById("id_validacion").style.display = "block";	
					document.getElementById("DireccionEmpresa").focus();
					return true;
				}else{
					if(!espacio_blanco.test(DireccionEmpresa)){
						$('#estilo_mensaje').show();
						document.getElementById("id_validacion").innerText = "La dirección de la empresa no puede estar vacio.";
						document.getElementById("id_validacion").style.display = "block";
						document.getElementById("DireccionEmpresa").focus();
						$('#DireccionEmpresa').val('');
						return true;						
					}else{
						$('.progress-bar').css('width', '' + (40+ '%'));
						$('#NumeroPorcentaje').text('40% Completado');
						if(TelefonoEmpresa==""){
							$('#estilo_mensaje').show();
							document.getElementById("id_validacion").innerText = "El telefono de la empresa no puede estar vacio.";
							document.getElementById("id_validacion").style.display = "block";
							document.getElementById("TelefonoEmpresa").focus();
							return true;
						}else{
							if(!espacio_blanco2.test(TelefonoEmpresa)){
								$('#estilo_mensaje').show();
								document.getElementById("id_validacion").innerText = "El telefono de la empresa no puede estar vacio.";
								document.getElementById("id_validacion").style.display = "block";
								document.getElementById("TelefonoEmpresa").focus();
								$('#TelefonoEmpresa').val('');
								return true;								
							}else{
								$('.progress-bar').css('width', '' + (60+ '%'));
								$('#NumeroPorcentaje').text('60% Completado');
								if(EmailEmpresa==""){
									$('#estilo_mensaje').show();
									document.getElementById("id_validacion").innerText = "El email de la empresa no puede estar vacio.";
									document.getElementById("id_validacion").style.display = "block";
									document.getElementById("EmailEmpresa").focus();
									return true;
								}else{
									if (!emailRegex.test(EmailEmpresa)) {
										$('#estilo_mensaje').show();
										document.getElementById("id_validacion").innerText = "El email ingresado esta mal escrito. Ejempo@ejemplo.com";
										document.getElementById("id_validacion").style.display = "block";
										document.getElementById("EmailEmpresa").focus();
										return true;
									}else{
										if(!espacio_blanco.test(EmailEmpresa)){
											$('#estilo_mensaje').show();
											document.getElementById("id_validacion").innerText = "El email de la empresa no puede estar vacio.";
											document.getElementById("id_validacion").style.display = "block";
											document.getElementById("EmailEmpresa").focus();
											$('#EmailEmpresa').val('');
											return true;
											
										}else{
											$('.progress-bar').css('width', '' + (80+ '%'));
											$('#NumeroPorcentaje').text('80% Completado');
											if(src==""){
												$('#estilo_mensaje').show();
												document.getElementById("id_validacion").innerText = "Debes seleccionar una imagen.";
												document.getElementById("id_validacion").style.display = "block";
												return true;
											}else{
												$('.progress-bar').css('width', '' + (100+ '%'));
												$('#NumeroPorcentaje').text('100% Completado')
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
		}
	}

	function Valida_Registro2(){
		var espacio_blanco    = /[a-z]/i;  //Expresión regular
		var espacio_blanco2   = /[0-9]/i;  //Expresión regular
		var emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;   
		var src= $('input[type=file]').val()
		var NombreEmpresa= $('#NombreEmpresa').val();
		var DireccionEmpresa= $('#DireccionEmpresa').val();
		var TelefonoEmpresa= $('#TelefonoEmpresa').val();
		var EmailEmpresa= $('#EmailEmpresa').val();
		
		var campos=0;

		if(espacio_blanco.test(NombreEmpresa)){
			campos++;			
		}
		if(espacio_blanco.test(DireccionEmpresa)){
			campos++;
		}
		if(espacio_blanco2.test(TelefonoEmpresa)){
			campos++;
		}		
		if(emailRegex.test(EmailEmpresa)){
			campos++;
		}		
		if(espacio_blanco.test(src)){
			campos++;
		}		

		x=100/5*campos;

		$('.progress-bar').css('width', '' + (x+ '%'));
		$('#NumeroPorcentaje').text(x+'% Completado');		

		if(x!=0){
			$('#id_porcentaje_configuracion').show();
		}else{
			$('#id_porcentaje_configuracion').hide();
		}

	}


	$('.BtnRegistrar').click(function(){
		if(Valida_Registro()!=true){
			$('#Modal_Registro').modal('show');
		}
	});

	function subir() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	}

</script>
