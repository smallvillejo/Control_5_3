<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Configuración</title>
<br>

<div class="panel panel-primary  col-xs-12 col-sm-12 col-md-10 col-md-offset-1" onmousemove="Valida_Registro2();" onchange="Valida_Registro2();">
	<div class="panel-heading" style="background-color:#32045e">
		<h2 class="panel-title">
			<strong>Configuración Cuenta</strong>
			<div class="btn-group pull-right">		
				<div class="form-group col-sm-12">
					<button type="button" class="btn btn-succes BtnRegistrar" style="background-color: #d65314; display: none;" title="Registrar Cambios">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
					</button> 
					<button type="button" class="btn btn-succes BtnActualizar" style="background-color: #d65314;display: none;" title="Guardar Cambios">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Actualizar</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-pencil-square-o"></span></font></strong>
					</button>
					<button type="button" class="btn btn-succes BtnCancelar" style="background-color: #d65314;display: none;" title="Cancelar">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Cancelar</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-times"></span></font></strong>
					</button>
				</div> 
			</div>			
		</h2>
	</div>
	<div class="panel-body">
		<input type="hidden" name="haylogo" id="haylogo">
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

<div class="modal fade" id="Modal_Actualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">						
				<h4 class="modal-title" id="myModalLabel">Esperando Confirmación</h4>
			</div>
			<div class="modal-body">
				¿ Esta seguro de Actualizar la información Ingresada ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary ActualizarInformacion" id="btn_registrar_producto">Actualizar</button>
				<button type="button" class="btn btn-danger" id="btn_cancelar_formulario_productos" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<script>
	Cargar_Datos_Empresa();

	function Cargar_Datos_Empresa(){

		var src= $('input[type=file]').val();
		$.ajax({
			type:'GET',
			// data: {
			// 	'id_maquina' 	: id_maquina,
			// 	'Fecha_Inicial' : Fecha_Inicial,
			// 	'Fecha_Final' 	: Fecha_Final	
			// },
			url:'{{ url('Consultar_Datos_Empresa')}}',
			success: function(respuesta){      
				if(respuesta.NombreEmpresa!=""){ 				 
					$('#NombreEmpresa').val(respuesta.NombreEmpresa);
					$('#DireccionEmpresa').val(respuesta.direccion_empresa);
					$('#TelefonoEmpresa').val(respuesta.telefono_empresa);
					$('#EmailEmpresa').val(respuesta.correo_empresa);	
					src=respuesta.logo_empresa;
					$('#ImagenLogoEmpresa').val(respuesta.logo_empresa);
					$('#img_destino').attr('src', respuesta.logo_empresa);	
					$('#div_photo_producto').show();
					$('#div_peso_imagen').show();		
					$('#id_img_destino').show();
					$('#haylogo').val(respuesta.Valida);
					$('.BtnRegistrar').hide();
					$('.BtnActualizar').show();
					$('.BtnCancelar').show();
					Valida_Registro();	

				}else{
					$('#NombreEmpresa').val("");
					$('#DireccionEmpresa').val("");
					$('#TelefonoEmpresa').val("");
					$('#EmailEmpresa').val("");	
					$('#img_destino').val("");
					$('.BtnRegistrar').show();
					$('.BtnActualizar').hide();
					$('.BtnCancelar').hide();
					$("#NombreEmpresa").focus();
					$('#haylogo').val(respuesta.Valida);
				}
			}	
		});
	}

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
					$("#estilo_mensaje").attr("class", "panel panel-success");
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 	
					$('#estilo_mensaje').show();			
					$('#id_validacion').html('<center> Datos registrados con Éxito.</center>');	
					$('#id_validacion').show();
					$('#Modal_Registro').modal('hide');
					setTimeout('document.location.href = "{{ route('Index')}}"',2000);
				}				

				if(respuesta.error==false){
					$.each(respuesta.errors,function(index, error){ 
						$("#estilo_mensaje").attr("class", "panel panel-danger");
						$("#id_validacion").css("fontSize", 15);						
						$("#id_validacion").css("font-weight","Bold"); 	
						$('#estilo_mensaje').show();			
						$('#id_validacion').html('<center> ERROR: '+error+'</center>');	
						$('#id_validacion').show();
					}); 
					$('#Modal_Registro_Productos').scrollTop(0);
				}
				
			}
		});
	});

	$('.ActualizarInformacion').click(function(){
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
					$("#estilo_mensaje").attr("class", "panel panel-success");
					$("#id_validacion").css("fontSize", 15);						
					$("#id_validacion").css("font-weight","Bold"); 	
					$('#estilo_mensaje').show();			
					$('#id_validacion').html('<center> Datos actualizados con Éxito.</center>');	
					$('#id_validacion').show();
					$('#Modal_Actualizar').modal('hide');
					setTimeout('document.location.href = "{{ route('Index')}}"',2000);
				}				

				if(respuesta.error==false){
					$.each(respuesta.errors,function(index, error){ 
						$("#estilo_mensaje").attr("class", "panel panel-danger");
						$("#id_validacion").css("fontSize", 15);						
						$("#id_validacion").css("font-weight","Bold"); 	
						$('#estilo_mensaje').show();			
						$('#id_validacion').html('<center> ERROR: '+error+'</center>');	
						$('#id_validacion').show();
					}); 
					$('#Modal_Registro_Productos').scrollTop(0);
				}
				
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
		var haylogo= $('#haylogo').val();

		
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
											

											if(haylogo=="no" && src==""){
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
		var haylogo= $('#haylogo').val();
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
		if(haylogo=="no" && espacio_blanco.test(src)){
			campos++;
		}else{
			if(haylogo=="si"){
				campos++;
			}		
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

	$('.BtnActualizar').click(function(){
		if(Valida_Registro()!=true){
			$('#Modal_Actualizar').modal('show');
		}
	});


	$('.BtnCancelar').click(function(){
		setTimeout('document.location.href = "{{ route('Index')}}"',1);
	});


	function subir() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	}

</script>
