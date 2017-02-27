<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>Configuración</title>
<br>
<div class="panel panel-primary  col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
	<div class="panel-heading" style="background-color:#32045e">
		<h2 class="panel-title">
			<strong>Configuración Cuenta</strong> 			
		</h2>
	</div>
	<div class="panel-body"> 		
		<h4>Antes de continuar al sistema, por primera vez debes configurar los siguientes parámetros:</h4>
		<br> 		
		<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-desktop" aria-hidden="true" title="Nombre Empresa"></i> Nombre Empresa
			</div>
			<div class="form-group col-sm-8">
				<input type="text" name="NombreEmpresa" id="NombreEmpresa" class="form-control" placeholder="Ingresa el nombre de la empresa">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-address-card-o" aria-hidden="true"></i> Dirección Empresa:
			</div>
			<div class="form-group col-sm-8">
				<input type="text" name="DireccionEmpresa" id="DireccionEmpresa" class="form-control" placeholder="Ingresa la dirección de la empresa">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-phone-square" aria-hidden="true"></i> Telefono Empresa:
			</div>
			<div class="form-group col-sm-8">
				<input type="number" name="TelefonoEmpresa" id="TelefonoEmpresa" class="form-control" placeholder="Ingresa el número telefónico de la empresa">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-envelope" aria-hidden="true"></i> Correo Empresa:
			</div>
			<div class="form-group col-sm-8">
				<input type="text" name="EmailEmpresa" id="EmailEmpresa" class="form-control" placeholder="Ingresa el email de la empresa">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-picture-o" aria-hidden="true"></i> Logo Empresa:
			</div>
			<div class="form-group col-sm-8">
				<input type="file" name="imagenProducto" class="form-control" id="catagry_logo" accept="image/jpeg, image/jpg,image/png" placeholder="Ingresa logo de la empresa" style="background-color: #32045e; color:#ffffff; " />
				<span class="help-block">Solo se permiten formatos: JPG,JPEG y PNG.</span>        
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4">
				<div class="form-group" id="div_photo_producto" style="display: none">    
					<i class="fa fa-picture-o" aria-hidden="true"></i> Vista Previa:
				</div> 
			</div>
			<div class="form-group col-sm-8" style="display: none" id="id_img_destino">
				<img id="img_destino" name="img_destino" height="200" width="300"> 
				<span class="help-block">Capacidad Máxima 1 MB.</span>    
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-4" style="display: none" id="PesoImagen">
				<i class="fa fa-balance-scale" aria-hidden="true"></i> Peso Imagen:
			</div>
			<div class="form-group col-sm-8">
				<div class="form-group" id="div_peso_imagen" style="display: none" id="TotalPeso">
					<label class="col-sm control-label" id="totalPeso"></label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-sm-12">
				<div class="panel panel-danger" style="display:none" id="estilo_mensaje">
					<div class="panel-heading" id="id_validacion" style="display:none">
					</div>
				</div>		
			</div>
		</div>
	<!-- 	<div class="row">
			<div class="form-group col-sm-4">
				<i class="fa fa-wrench" aria-hidden="true"></i>
				Ruta Carpeta Descarga:
				<a href="#" data-toggle="popover" data-placement="top" title="Se recomienda seleccionar un lugar seguro como DROPBOX donde pueda almacenar datos de su empresa como imágenes de sus mercancías y copias de seguridad del sistema. ">?</a>
			</div>
			<div class="form-group col-sm-8">				
				<input type="file" name="RutaArchivo" class="form-control" id="catagry_logo" webkitdirectory directory multiple placeholder="Selcciona Ruta de Archivos" style="background-color: #32045e; color:#ffffff; " />					        
			</div>								
		</div> -->

		<div class="row">
			<div class="form-group col-sm-8 col-md-offset-4">
				<button type="button" class="btn btn-succes BtnRegistrar" style="background-color: #32045e" title="Guardar Cambios">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
					<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
				</button> 
			</div>
		</div> 	
	</div>		
	<div class="progress">
		<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 55%; background-color: #32045e" >
			<span >55% Completado</span>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function(){
		$('[data-toggle="popover"]').popover();   
	});

	$("#catagry_logo").change(function(){
		$('#div_photo_producto').show();
		$('#div_peso_imagen').show();
		$('#PesoImagen').show();
		$('#TotalPeso').show();
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
				$('#PesoImagen').hide();
				$('#TotalPeso').hide();	
				$('#id_img_destino').hide();				
				return false;
			}
			// document.getElementById('BtnRegistrar').disabled=false;
			$('#estilo_mensaje').hide();
			document.getElementById("id_validacion").innerText = "";			
			reader.onload = function (e) {
				$('#img_destino').attr('src', e.target.result);
				$('#totalPeso').text(Math.round(e.loaded/1024/1024) + "MB");
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			$('#div_photo_producto').hide();
			$('#div_peso_imagen').hide();
			$('#PesoImagen').hide();
			$('#TotalPeso').hide();	
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
									}else{
										if(!espacio_blanco.test(EmailEmpresa)){
											$('#estilo_mensaje').show();
											document.getElementById("id_validacion").innerText = "El email de la empresa no puede estar vacio.";
											document.getElementById("id_validacion").style.display = "block";
											document.getElementById("EmailEmpresa").focus();
											$('#EmailEmpresa').val('');
											return true;
										}else{
											if(src==""){
												$('#estilo_mensaje').show();
												document.getElementById("id_validacion").innerText = "Debes seleccionar una imagen.";
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
		}
	}

	$('.BtnRegistrar').click(function(){
		if(Valida_Registro()!=true){

		}
	});

</script>
