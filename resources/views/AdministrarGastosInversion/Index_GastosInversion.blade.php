	@extends('layouts.master')
	@section('title')
	Administrar Gastos Inversión
	@stop
	@section('content')	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-handshake-o" aria-hidden="true"></i>
				<a href="#">Administrar Gastos Inversión</a>
				<i class="fa fa-angle-right"></i>
			</li>				
		</ul>			
	</div>
	<br>
	<br>
	<br>
	<div class="row form-group">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" id="Panel_2">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #04a329">
					<h3 class="panel-title">
						<strong>INGRESO GASTOS & INVERSIÓN</strong>						
					</h3>
				</div>				
				<div class="panel-body">
					<table class="table table-user-information">
						<div class="row">
							<tbody>
								<tr>
									<td>
										<div class="form-group">
											<span class="badge btn-md btn-success" style="background: 
											#04a329;">
											<b>
												<strong>
													<font size ="2", color color="#000000" face="Tahoma">
														Fecha GASTO:
													</font>
												</strong>
											</b>
										</span>
									</div>
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Gasto" id="Fecha_Ingreso_Gasto"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#04a329;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Valor Gasto:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="number" name="Valor_Ingreso_Gasto" id="Valor_Ingreso_Gasto" class="form-control" placeholder="Valor Gasto" autofocus>
								<input type="hidden" name="Valor_Ingreso_Gasto_oculto" id="Valor_Ingreso_Gasto_oculto" class="form-control">
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>						
					</tbody>
				</div>
			</table>
			<div class="form-group">
				<span class="badge btn-md btn-success" style="background: 
				#04a329;">
				<b>
					<strong>
						<font size ="2", color color="#000000" face="Tahoma">
							Descripción Gasto:
						</font>
					</strong>
				</b>
			</span>
		</div>	
		<div class="form-group">						
			<textarea name="Descripcion_Ingreso_Gasto" id="Descripcion_Ingreso_Gasto" class="form-control" style="overflow:auto;resize:none;" rows="5" placeholder="Ingresa Descripción del Gasto">
			</textarea>
		</div>
		<div class="panel panel-danger" style="display:none" id="estilo">
			<div class="panel-heading" id="mensaje" style="display:none">
				<strong></strong>
			</div>
		</div>
		<button type="button" class="btn btn-circle Registrar_Ingreso_Gasto"  style="background-color:#04a329"
		id="BtnIngresarRecarga" title="Ingresar Recargas">
		<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar Gasto</span>
			<span class="fa fa-plus-square"></span>
		</font></strong>
	</button>
</div>
</div>
</div>
<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">			
</div>
</div>

<!-- Confirmar Registro de Gasto -->
<div class="modal fade" id="Modal_Confirmar_Ingreso_Gasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de registrar el Gasto?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarIngresoGasto" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Registro de Gasto -->

<!-- Modal Editar Gasto -->
<div class="modal fade" id="Modal_Editar_Gasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-handshake-o fa-2x" aria-hidden="true"></i> Editar Gasto</font></strong>
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="estilo3">
					<div class="panel-heading" id="mensaje3" style="display:none">
						<strong></strong>
					</div>
				</div>
				<table class="table table-user-information">
					<div class="row">
						<tbody>
							<input type="hidden" name="Id_Gasto_Editar" id="Id_Gasto_Editar" class="form-control">
							<tr>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#04a329;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Fecha Gasto:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<div class="form-group">				
									<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
										<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Gasto_Editar" id="Fecha_Ingreso_Gasto_Editar"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
										<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<span class="badge btn-md btn-success" style="background: 
									#04a329;">
									<b>
										<strong>
											<font size ="2", color color="#000000" face="Tahoma">
												Valor Gasto:
											</font>
										</strong>
									</b>
								</span>
							</div>							
							<input type="number" name="Valor_Ingreso_Gasto_Editar" id="Valor_Ingreso_Gasto_Editar" class="form-control" placeholder="Valor Gasto" autofocus>
							<input type="hidden" name="Valor_Ingreso_Gasto_Oculto_Editar" id="Valor_Ingreso_Gasto_Oculto_Editar" class="form-control">
						</td>
					</tr>						
					<tr><td></td><td></td></tr>					
				</tbody>
			</div>
		</table>
		<tr>
			<div class="form-group">
				<span class="badge btn-md btn-success" style="background: 
				#04a329;">
				<b>
					<strong>
						<font size ="2", color color="#000000" face="Tahoma">
							Descripción Gasto:
						</font>
					</strong>
				</b>
			</span>
		</div>
		<div class="form-group">						
			<textarea name="Descripcion_Ingreso_Gasto_Editar" id="Descripcion_Ingreso_Gasto_Editar" class="form-control" style="overflow:auto;resize:none;" rows="5" placeholder="Ingresa Descripción de la Gasto">
			</textarea>
		</div>
	</tr>
	<table class="table table-user-information">
		<div class="row">
			<tbody>
				<tr><td></td><td></td></tr>	
			</tbody>
		</div>
	</table>
</div>			
<div class="modal-footer">	
	<button type="button" class="btn btn-primary EditarGasto">Editar</button>
	<button type="button" class="btn btn-default CerrarMensaje" data-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>
<!-- Termina Modal Editar Venta Internet -->
<!-- Confirmar Editar Gasto -->
<div class="modal fade" id="Confirmar_Editar_Gasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de editar el Gasto?</h4>
				<input type="hidden" name="id_venta_internet_eliminar" id="id_venta_internet_eliminar" class="form-control">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary ConfirmarEditarGasto" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Editar Gasto -->

<!-- Confirmar Elminar Gasto -->
<div class="modal fade" id="Confirmar_Eliminar_Gasto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">
					<span class="badge btn-md btn-success" style="background-color: #04a329">
						<b>
							<strong>
								<font size ="2">
									¿Está seguro de eliminar el Gasto # 
								</font>
							</strong>
						</b>
						<b>
							<strong>
								<font size ="2">
									<label id="id_label_gasto_eliminar" name="id_label_gasto_eliminar"></label> ?
								</font>
							</strong>
						</b>						
					</span>				
				</h4>
				<input type="hidden" name="id_gasto_eliminar" id="id_gasto_eliminar" class="form-control">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EliminarGasto" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Elminar Gasto -->
<!-- Modal Para Confirmaciones -->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalConfirmacion" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="TitleModal"></h4>
			</div>
			<div class="modal-body" id="CuerpoMensaje">
				<strong> <font size ="4", color ="#01080f" face="Lucida Sans"><p2></p2></font></strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary CerrarMensaje" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Para Confirmaciones -->





<script type="text/javascript">
	Cargar_Tabla_Gastos();	



	$('#Descripcion_Ingreso_Gasto').val('');	
	// $('#descripcion_Gasto_ingreso').css("height",200);
	// $('#descripcion_Gasto_ingreso').css("width",410);

	$('.CerrarMensaje').click(function(){
		$('#estilo').hide();
		$('#estilo2').hide();
		$('#estilo3').hide();
		Cargar_Tabla_Gastos();
		$('#Valor_Ingreso_Gasto').val('');
		$('#Valor_Ingreso_Gasto_oculto').val('');	
		$('#Descripcion_Ingreso_Gasto').val('');	
		document.getElementById("Valor_Ingreso_Gasto").focus();
		$("#Fecha_Ingreso_Gasto").datepicker("destroy");	
		$('#Fecha_Ingreso_Gasto').val('{{Carbon::today()->toDateString()}}');	
		$("#Fecha_Ingreso_Gasto").datepicker("refresh");	

	});

	function Cargar_Tabla_Gastos(){
		$.ajax({
			type:'get',
			url:'{{ url('Cargar_Tabla_Gastos')}}',
			success: function(data){      
				$('#tabla_id').empty().html(data);			
			}
		});	
		$(document).on("click",".pagination li a",function(e) {
			e.preventDefault();		
			var url = $(this).attr("href");
			$.ajax({
				type:'get',
				url:url,			
				success: function(data){
					$('#tabla_id').empty().html(data);					
				}
			});
		});	
	}

	function Validar_Ingreso_Gasto(){
		var patron =/[0-9]/;
		var patron2 =/[a-z]/;
		var Valor_Ingreso_Gasto=$('#Valor_Ingreso_Gasto').val();
		var Descripcion_Ingreso_Gasto=$('#Descripcion_Ingreso_Gasto').val();
		var Valor_Ingreso_Gasto_oculto=parseInt($('#Valor_Ingreso_Gasto_oculto').val());

		$("#estilo").fadeTo(5000, 500).slideUp(500, function(){
			$("#estilo").hide();
		});


		if(!patron.test(Valor_Ingreso_Gasto)){
			$('#estilo').show();
			document.getElementById("mensaje").innerText = "El valor del Gasto no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje").style.display = "block";
			$('#Valor_Ingreso_Gasto').val('');      
			document.getElementById("Valor_Ingreso_Gasto").focus();
			return true;
		}else{
			if(Valor_Ingreso_Gasto==""){
				$('#estilo').show();
				document.getElementById("mensaje").innerText = "El valor del Gasto no puede estar vacio.";
				document.getElementById("mensaje").style.display = "block";
				$('#Valor_Ingreso_Gasto').val('');      
				document.getElementById("Valor_Ingreso_Gasto").focus();
				return true;
			}else{
				if(!patron2.test(Descripcion_Ingreso_Gasto)){
					$('#estilo').show();
					document.getElementById("mensaje").innerText = "La descripción del Gasto no puede estar vacia o contener espacios en blanco.";
					document.getElementById("mensaje").style.display = "block";
					$('#Descripcion_Ingreso_Gasto').val('');      
					document.getElementById("Descripcion_Ingreso_Gasto").focus();
					return true;
				}else{
					if(Descripcion_Ingreso_Gasto==""){
						$('#estilo').show();
						document.getElementById("mensaje").innerText = "La descripción del la Gasto no puede estar vacio.";
						document.getElementById("mensaje").style.display = "block";
						$('#Descripcion_Ingreso_Gasto').val('');      
						document.getElementById("Descripcion_Ingreso_Gasto").focus();
						return true;
					}else{		
						Valor_Ingreso_Gasto=Valor_Ingreso_Gasto.replace(".","");
						$('#Valor_Ingreso_Gasto_oculto').val(Valor_Ingreso_Gasto);
						$('#estilo').hide();
						return false;
					}
				}
			}
		}		
	}

	$('.Registrar_Ingreso_Gasto').click(function(){
		if(Validar_Ingreso_Gasto()!=true){
			$('#Modal_Confirmar_Ingreso_Gasto').modal('show');	
		}
	});

	$('.RegistrarIngresoGasto').click(function(){
		var Fecha_Ingreso_Gasto =	$('#Fecha_Ingreso_Gasto').val();
		var Valor_Ingreso_Gasto_oculto =$('#Valor_Ingreso_Gasto_oculto').val();
		var Descripcion_Ingreso_Gasto =$('#Descripcion_Ingreso_Gasto').val();
		
		$.ajax({
			url   : "<?= URL::to('Registrar_Gasto') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'Fecha_Ingreso_Gasto': Fecha_Ingreso_Gasto,
				'Valor_Ingreso_Gasto_oculto': Valor_Ingreso_Gasto_oculto,
				'Descripcion_Ingreso_Gasto': Descripcion_Ingreso_Gasto
			},  
			success:function(data){
				$("#Modal_Confirmar_Ingreso_Gasto").modal('hide');
				$('#mensaje').html('');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#estilo').show();
						$('#mensaje').append('<p><strong>'+error+'</strong></p>');    
						document.getElementById("mensaje").style.display = "block";
					});  
				}
				if(data == 0){
					$("#Modal_Confirmar_Ingreso_Gasto").modal('hide');			
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Gasto Registradao.</p>');
					$('#CuerpoMensaje').html('<p>El Gasto se registro con Exito.!!</p>');					
				}

			},
			error:function(data){  
				$("#Modal_Confirmar_Ingreso_Gasto").modal('hide');				
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});


	$('body').delegate('.Eliminar_Gasto','click',function(){
		var Id_Gasto_Eliminar =($(this).attr('Id_Gasto_Eliminar'));
		$('#id_gasto_eliminar').val(Id_Gasto_Eliminar);
		$('#id_label_gasto_eliminar').text(Id_Gasto_Eliminar);
		$("#id_label_gasto_eliminar").css("fontSize", 15);						
		$("#id_label_gasto_eliminar").css("font-weight","Bold"); 		
		$('#Confirmar_Eliminar_Gasto').modal('show');		
	});

	$('.EliminarGasto').click(function(){
		var id_gasto_eliminar= $('#id_gasto_eliminar').val();
		$.ajax({
			url   : "<?= URL::to('Eliminar_Gasto') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'id_gasto_eliminar': id_gasto_eliminar				
			},  
			success:function(data){
				$("#Confirmar_Eliminar_Gasto").modal('hide');				
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#CuerpoMensaje').html('');					
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error al Eliminar.</p>');
						$('#CuerpoMensaje').html('<p>'+error+'</p>');
					});  
				}
				if(data == 0){
					$("#Confirmar_Eliminar_Gasto").modal('hide');
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Gasto Eliminado.</p>');
					$('#CuerpoMensaje').html('<p>El Gasto se elimino con Exito.!!</p>');					
				}	
			},
			error:function(data){  
				$("#Confirmar_Eliminar_Gasto").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});

	});
	$('body').delegate('.Editar_Gasto','click',function(){
		var Id_Gasto_Editar =($(this).attr('Id_Gasto_Editar'));
		var Fecha_Gasto_Editar =($(this).attr('Fecha_Gasto_Editar'));
		var Valor_Gasto_Editar =($(this).attr('Valor_Gasto_Editar'));
		
		var Descripcion_Gasto_Editar=($(this).attr('Descripcion_Gasto_Editar'));

		$('#Id_Gasto_Editar').val(Id_Gasto_Editar);
		$('#Fecha_Ingreso_Gasto_Editar').val(Fecha_Gasto_Editar);
		$('#Valor_Ingreso_Gasto_Oculto_Editar').val(Valor_Gasto_Editar);
		$('#Valor_Ingreso_Gasto_Editar').val(Valor_Gasto_Editar);
		$('#Descripcion_Ingreso_Gasto_Editar').val(Descripcion_Gasto_Editar);

		$('#Modal_Editar_Gasto').modal('show');		
	});

	function Validar_Editar_Gasto(){
		var patron =/[0-9]/;
		var patron2 =/[a-z]/;
		var Valor_Ingreso_Gasto_Editar=$('#Valor_Ingreso_Gasto_Editar').val();
		var Descripcion_Ingreso_Gasto_Editar=$('#Descripcion_Ingreso_Gasto_Editar').val();
		var Valor_Ingreso_Gasto_oculto=parseInt($('#Valor_Ingreso_Gasto_oculto_Editar').val());

		$("#estilo3").fadeTo(5000, 500).slideUp(500, function(){
			$("#estilo3").hide();
		});


		if(!patron.test(Valor_Ingreso_Gasto_Editar)){
			$('#estilo3').show();
			document.getElementById("mensaje3").innerText = "El valor del Gasto no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje3").style.display = "block";
			$('#Valor_Ingreso_Gasto_Editar').val('');      
			document.getElementById("Valor_Ingreso_Gasto_Editar").focus();
			return true;
		}else{
			if(Valor_Ingreso_Gasto_Editar==""){
				$('#estilo3').show();
				document.getElementById("mensaje3").innerText = "El valor del Gasto no puede estar vacio.";
				document.getElementById("mensaje3").style.display = "block";
				$('#Valor_Ingreso_Gasto_Editar').val('');      
				document.getElementById("Valor_Ingreso_Gasto_Editar").focus();
				return true;
			}else{
				if(!patron2.test(Descripcion_Ingreso_Gasto_Editar)){
					$('#estilo3').show();
					document.getElementById("mensaje3").innerText = "La descripción del Gasto no puede estar vacia o contener espacios en blanco.";
					document.getElementById("mensaje3").style.display = "block";
					$('#Descripcion_Ingreso_Gasto_Editar').val('');      
					document.getElementById("Descripcion_Ingreso_Gasto_Editar").focus();
					return true;
				}else{
					if(Descripcion_Ingreso_Gasto_Editar==""){
						$('#estilo3').show();
						document.getElementById("mensaje3").innerText = "La descripción del Gasto no puede estar vacio.";
						document.getElementById("mensaje3").style.display = "block";
						$('#Descripcion_Ingreso_Gasto_Editar').val('');      
						document.getElementById("Descripcion_Ingreso_Gasto_Editar").focus();
						return true;
					}else{		
						Valor_Ingreso_Gasto_Editar=Valor_Ingreso_Gasto_Editar.replace(".","");
						$('#Valor_Ingreso_Gasto_Oculto_Editar').val(Valor_Ingreso_Gasto_Editar);
						$('#estilo3').hide();
						return false;
					}
				}
			}
		}	

	}

	$('.EditarGasto').click(function(){
		if(Validar_Editar_Gasto()!=true){
			$('#Confirmar_Editar_Gasto').modal('show');	
		}
	});

	$('.ConfirmarEditarGasto').click(function(){

		var Id_Gasto_Editar =$('#Id_Gasto_Editar').val();
		var Fecha_Ingreso_Gasto_Editar =$('#Fecha_Ingreso_Gasto_Editar').val();
		var Valor_Ingreso_Gasto_Oculto_Editar =$('#Valor_Ingreso_Gasto_Oculto_Editar').val();
		var Descripcion_Ingreso_Gasto_Editar =$('#Descripcion_Ingreso_Gasto_Editar').val();

		$.ajax({
			url   : "<?= URL::to('Editar_Gasto') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'Id_Gasto_Editar'			 		: Id_Gasto_Editar,
				'Fecha_Ingreso_Gasto_Editar'		: Fecha_Ingreso_Gasto_Editar,
				'Valor_Ingreso_Gasto_Oculto_Editar':Valor_Ingreso_Gasto_Oculto_Editar,
				'Descripcion_Ingreso_Gasto_Editar' :Descripcion_Ingreso_Gasto_Editar
			},  
			success:function(data){
				$("#Confirmar_Editar_Gasto").modal('hide');
				$("#Modal_Editar_Gasto").modal('hide');					
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#CuerpoMensaje').html('');					
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error al editar el Gasto.</p>');
						$('#CuerpoMensaje').html('<p>'+error+'</p>');
					});  
				}
				if(data == 0){
					$("#Confirmar_Editar_Gasto").modal('hide');
					$("#Modal_Editar_Gasto").modal('hide');
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Gasto Editado.</p>');
					$('#CuerpoMensaje').html('<p>El Gasto se edito con Exito.!!</p>');					
				}
				if(data == 1){
					$('#estilo3').show();
					document.getElementById("mensaje3").innerText = "No se encontro ningun Cambio a Editar.";
					document.getElementById("mensaje3").style.display = "block";
				}	
			},
			error:function(data){  
				$("#Confirmar_Editar_Gasto").modal('hide');
				$("#Modal_Editar_Gasto").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});



</script>

@stop