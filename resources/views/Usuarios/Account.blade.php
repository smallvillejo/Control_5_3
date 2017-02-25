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
				<input type="text" name="TelefonoEmpresa" id="TelefonoEmpresa" class="form-control" placeholder="Ingresa el número telefónico de la empresa">
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
				<i class="fa fa-wrench" aria-hidden="true"></i>
				Ruta Carpeta Descarga:
				<a href="#" data-toggle="popover" data-placement="top" title="Se recomienda seleccionar un lugar seguro como DROPBOX donde pueda almacenar datos de su empresa como imágenes de sus mercancías y copias de seguridad del sistema. ">?</a>
			</div>
			<div class="form-group col-sm-8">				
				<input type="file" name="RutaArchivo" class="form-control" id="catagry_logo" webkitdirectory directory multiple placeholder="Selcciona Ruta de Archivos" style="background-color: #32045e; color:#ffffff; " />					        
			</div>								
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-8 col-md-offset-4">
			<button type="button" class="btn btn-succes" id="BtnRegistrar" style="background-color: #32045e" title="Guardar Cambios">
				<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
				<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
			</button> 
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
</script>
