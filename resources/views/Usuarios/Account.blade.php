@extends('layouts.master')
@section('title')
Configuracion de Cuenta
@stop
@section('content')
@if($Actualizacion_Datos=Auth::user()->Actualizacion_Datos=='Si')
<h3>Hola, Para poder disfrutar de nuestros servicios, debes actualizar todos tus datos.</h3>
@else
<h3>Hola, Aquí podrás modificar tus datos personales.</h3>
@endif

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Comercio ID:{{Auth::user()->id_comercio}}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			@if(Auth::user()->photo_perfil==null)		
			<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="global/images/photo.jpg" class="img-circle img-responsive" title="Imagen de Perfil">
				@else				
				@if(File::exists(Auth::user()->photo_perfil))
				<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{Auth::user()->photo_perfil}}" class="img-circle img-responsive" title="Imagen de Perfil">
					@else
					<div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="global/images/photo.jpg" class="img-circle img-responsive" title="Imagen de Perfil">
						@endif
						@endif
						<br>
						<button class="btn btn-primary" type="file">
							Cambiar Foto</button>
							<!-- <input id="sortpicture" type="file" name="src" id="src" class="form-group"  />  -->
						</div>

						<div class=" col-md-9 col-lg-9 "> 
							<table class="table table-user-information">
								<div class="row">
									<div class="col-lg-12">
										<div class="alert alert-success info2" style="display: none;" id="success-alert2">  <strong><ul2></ul2></strong>  
										</div>
										<div class="alert alert-danger info1" style="display: none;" id="success-alert1"> <strong><ul></ul></strong>  
										</div>  

									</div>
								</div>
								<tbody>
									<font size ="4", color="#53a4ee" face="Arial Black"><h3>Datos del Usuario:</h3></font>
									<tr>
										<td>Nombre Usuario:</td>
										<td>{{Auth::user()->nombre}}</td>
									</tr>
									<tr>
										<td>Apellido Usuario:</td>
										<td>{{Auth::user()->apellido}}</td>
									</tr>
									<tr>
										<td>Telefono Usuario:</td>
										<td>{{Auth::user()->telefono}}</td>
									</tr>
									<tr>
										<td>Email:</td>
										<td><a href="mailto:{{Auth::user()->correo}}">{{Auth::user()->correo}}</a></td>
									</tr>											

								</tbody>
							</table>
							<a href="#Formulario_editar_perfil" data-toggle = 'modal' id="{{Auth::user()->id}}" class="firmar_sesion" data-backdrop="static" data-keyboard="false">
								<button class="btn btn-primary" type="button" title="Editar Perfil">
									<strong> <font size ="3", color ="#f9f9f9"> <span class= "fa fa-pencil"></span></font></strong>
									<strong> <font size ="3", color ="#f9f9f9" face="Lucida Sans"><span>Editar Perfil</span></font></strong>
								</button> 
							</a> 
							<a href="<?=URL::to('index');?>" data-toggle = 'modal' id="{{Auth::user()->id}}" class="firmar_sesion" data-backdrop="static" data-keyboard="false">
								<button class="btn btn-danger" type="button" title="Cancelar">
									<strong> <font size ="3", color ="#f9f9f9"> <span class= "fa fa-times-circle"></span></font></strong>
									<strong> <font size ="3", color ="#f9f9f9" face="Lucida Sans"><span>Cancelar</span></font></strong>
								</button> 
							</a>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal Registrar Sesion -->
			<form autocomplete="off">
				<div class="panel-body" id="formulario_sesion" data-backdrop="static" data-keyboard="false">
					<div class="modal fade" id="Formulario_editar_perfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel"><b><font size ="5", color="#ff0033" face="Britannic Bold">Editar Perfil</font></b></h4>
									<label name="numero_sesion"></label>
									<div class="modal-body">
										<div class="panel-body">	

											<input type="hidden" id="id_user" name="id_user" class="form-control" value="{{Auth::user()->id}}">			<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Nombre Usuario:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="text" id="nombre_user" name="nombre_user" class="form-control" value="{{Auth::user()->nombre}}"></font>
										</div>
										<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Apellido Usuario:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="text" id="apellido_user" name="apellido_user" class="form-control" value="{{Auth::user()->apellido}}">
											</font>
										</div>

										<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Email Usuario:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="email" id="email_user" name="email_user" class="form-control" value="{{Auth::user()->correo}}"></font>
										</div>	
										<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Telefono Usuario:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="number" id="telefono_user" name="telefono_user" class="form-control" value="{{Auth::user()->telefono}}"></font>
										</div>														
										<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Password User:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="password" id="password_user" name="password_user" class="form-control"></font>
										</div>  
										<div class="form-group">
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Confirmar Password:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="password" id="confirmar_Password_user" name="confirmar_Password_user" class="form-control"></font>
										</div>
										<div class="form-group">								
											<font size ="3", color="#53a4ee" face="Arial Black">{{Form::label("Aceptar los términos:")}}</font>
											<font size ="3", color="#53a4ee" face="Arial Black"><input type="checkbox" name="terminos" id="terminos"></font>
										</div>	
									</div>							
									<div class="panel-footer">
										<div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
											<a class="btn btn-primary" data-toggle="modal" data-target="#confirm-delete">Guardar Cambios</a><br>                        
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>









		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Confirmación Guardar Cambios</h4>
					</div>

					<div class="modal-body">
						<p>¿Está seguro de acutalizar la información?</p>							
						<p class="debug-url"></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button  class="btn btn-primary saverecord" type="button" data-toggle="modal" data-target="#confirm-delete" >Guardar Cambios</button>

					</div>
				</div>
			</div>
		</div>




		<script type="text/javascript">
			var info1   = $('.info1');
			var info2   = $('.info2');
			var info3   = $('.info3');

			info1.hide().find('ul').empty();
			info2.hide().find('ul2').empty();

			$('.saverecord').click(function(){

				var id_usuario         = $('#id_user').val(); 
				var nombre_user        = $('#nombre_user').val(); 
				var apellido_user      = $('#apellido_user').val();
				var correo         	   = $('#email_user').val();
				var telefono_user      = $('#telefono_user').val();
				var password           = $('#password_user').val();  
				var confipassword      = $('#confirmar_Password_user').val();
				var terminos           = $('#terminos').val();   



				var terminos = document.getElementById("terminos").checked;
				if(terminos==true){ 
					var terminos=1;								
				}else{
					var terminos='firma';   
				}

				$.ajax({
					url   : "<?= URL::to('actualizar_data_user') ?>",
					type  : "POST",
					async : false,
					data  :{
						'id_usuario'    : id_usuario,
						'nombre_user'   : nombre_user, 
						'apellido_user' : apellido_user, 
						'correo'    	: correo,   
						'telefono_user' : telefono_user,    
						'password'      : password,
						'confipassword' : confipassword,  
						'terminos' 		: terminos				
					},  
					success:function(re){
						if(!re.success){        

							$.each(re.errors,function(index, error){
								info1.find('ul').append('<li>'+error+'</li>');
								info1.slideDown();
							}); 
							$("#formulario_sesion").modal('hide');
							$("#Formulario_editar_perfil").modal('hide'); 
							$("#success-alert1").hide(); 
							$("#success-alert1").alert();    
							$("#success-alert1").fadeTo(4500, 500).slideUp(500, function(){
								info1.hide().find('ul').empty();
							});
						}

						if(re == 0){        
							info2.find('ul2').append('<li>Perfil Actualizado Con Éxito..!!</li>');
							info1.hide().find('ul2').empty();
							info2.slideDown(); 
							$("#formulario_sesion").modal('hide');
							$("#Formulario_editar_perfil").modal('hide');          
							$("#success-alert2").hide(); 
							$("#success-alert2").alert();   
							$("#success-alert2").fadeTo(2500, 500).slideUp(500, function(){
								info2.hide().find('ul2').empty();
								refresh_pagina(); 

							});
						}
					},
					error:function(re){  
					}
				});
			});	

			function refresh_pagina(){
				location.reload();
			}
		</script>
		@stop