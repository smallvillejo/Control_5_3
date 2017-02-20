	@extends('layouts.master')
	@section('title')
	Administrar Internet
	@stop
	@section('content')	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-internet-explorer" aria-hidden="true"></i>
				<a href="#">Administrar Internet</a>
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
				<div class="panel-heading" style="background-color: #a50a0a">
					<h3 class="panel-title">
						<strong>INGRESO VENTA DE INTERNET</strong>						
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
											#23475a;">
											<b>
												<strong>
													<font size ="2", color color="#000000" face="Tahoma">
														Fecha Venta Internet:
													</font>
												</strong>
											</b>
										</span>
									</div>
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Venta_Internet" id="Fecha_Ingreso_Venta_Internet"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#23475a;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Valor Venta Internet:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="number" name="Valor_Venta_Ingresar_Internet" id="Valor_Venta_Ingresar_Internet" class="form-control" placeholder="Ingrese el valor venta de internet" autofocus>
								<input type="hidden" name="Valor_Venta_Ingresar_Internet_oculto" id="Valor_Venta_Ingresar_Internet_oculto" class="form-control">
							</td>
						</tr>
						<tr>
							
						</tr>						
					</tbody>
				</div>
			</table>
			<div class="panel panel-danger" style="display:none" id="estilo">
				<div class="panel-heading" id="mensaje" style="display:none">
					<strong></strong>
				</div>
			</div>
			<button type="button" class="btn btn-circle RegistrarIngresoInternet"  style="background-color:#a50a0a"
			id="BtnIngresarRecarga" title="Ingresar Recargas">
			<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar Venta</span>
				<span class="fa fa-plus-square"></span>
			</font></strong>
		</button>
	</div>
</div>
</div>
<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">			
</div>
</div>

<!-- Modal Editar Venta Internet -->
<div class="modal fade" id="Modal_Editar_Venta_Internet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-internet-explorer fa-2x" aria-hidden="true"></i> Editar Venta Internet</font></strong>
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
							<tr>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#0699d8;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Fecha Venta:
												</font>
											</strong>
										</b>
									</span>
								</div>
							</td>
							<td>
								<div class="form-group">
									<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
										<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Venta_Internet_editar" id="Fecha_Ingreso_Venta_Internet_editar"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
										<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="form-group">
									<span class="badge btn-md btn-success" style="background: 
									#0699d8;">
									<b>
										<strong>
											<font size ="2", color color="#000000" face="Tahoma">
												Valor Venta:
											</font>
										</strong>
									</b>
								</span>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input type="number" name="valor_venta_internet_editar" id="valor_venta_internet_editar" class="form-control">
								<input type="hidden" name="valor_venta_internet_editar_oculto" id="valor_venta_internet_editar_oculto" class="form-control">
								<input type="hidden" name="id_venta_internet_oculto" id="id_venta_internet_oculto" class="form-control">
							</div>
						</td>
					</tr>	
					<tr><td></td><td></td></tr>					
				</tbody>
			</div>
		</table>
	</div>			
	<div class="modal-footer">
		<button type="button" class="btn btn-default CerrarMensaje" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary Editar_Venta_Internet">Editar</button>
	</div>
</div>
</div>
</div>
<!-- Termina Modal Editar Venta Internet -->
<!-- Confirmar Editar Venta Internet -->
<div class="modal fade" id="Confirmar_Editar_Venta_Internet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de editar la venta de internet?</h4>
				<input type="hidden" name="id_venta_internet_eliminar" id="id_venta_internet_eliminar" class="form-control">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EditarVentaInternet" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Editar Venta Internet -->

<!-- Confirmar Registro de Categoria -->
<div class="modal fade" id="Confirmar_Ingreso_Venta_Internet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de registrar la venta de internet?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarIngresoVentaInternet" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Registro Categoria -->
<!-- Confirmar Elminar Registro -->
<div class="modal fade" id="Confirmar_Eliminar_Venta_Internet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de eliminar la venta de internet?</h4>
				<input type="hidden" name="id_venta_internet_eliminar" id="id_venta_internet_eliminar" class="form-control">
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EliminarVentaInternet" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Elminar Registro -->
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
	Cargar_Tabla_Ventas_Internet();	

	$('.CerrarMensaje').click(function(){
		$('#estilo').hide();
		$('#estilo2').hide();
		Cargar_Tabla_Ventas_Internet();
		$('#Valor_Venta_Ingresar_Internet').val('');
		$('#Valor_Venta_Ingresar_Internet_oculto').val('');		
		document.getElementById("Valor_Venta_Ingresar_Internet").focus();
		$("#Fecha_Ingreso_Venta_Internet").datepicker("destroy");	
		$('#Fecha_Ingreso_Venta_Internet').val('{{Carbon::today()->toDateString()}}');	
		$("#Fecha_Ingreso_Venta_Internet").datepicker("refresh");	

	});

	function Cargar_Tabla_Ventas_Internet(){
		$.ajax({
			type:'get',
			url:'{{ url('Cargar_Tabla_Ventas_Internet')}}',
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

	function Validar_Ingreso_Venta_Internet(){
		var patron =/[0-9]/;
		var Valor_Venta_Ingresar_Internet=$('#Valor_Venta_Ingresar_Internet').val();
		var Valor_Venta_Ingresar_Internet_oculto=parseInt($('#Valor_Venta_Ingresar_Internet_oculto').val());


		if(!patron.test(Valor_Venta_Ingresar_Internet)){
			$('#estilo').show();
			document.getElementById("mensaje").innerText = "El valor de la venta de internet no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje").style.display = "block";
			$('#Valor_Venta_Ingresar_Internet').val('');      
			document.getElementById("Valor_Venta_Ingresar_Internet").focus();
			return true;
		}else{
			if(Valor_Venta_Ingresar_Internet==""){
				$('#estilo').show();
				document.getElementById("mensaje").innerText = "El valor de la venta de internet no puede estar vacio.";
				document.getElementById("mensaje").style.display = "block";
				$('#Valor_Venta_Ingresar_Internet').val('');      
				document.getElementById("Valor_Venta_Ingresar_Internet").focus();
				return true;
			}else{			
				Valor_Venta_Ingresar_Internet=Valor_Venta_Ingresar_Internet.replace(".","");
				$('#Valor_Venta_Ingresar_Internet_oculto').val(Valor_Venta_Ingresar_Internet);
				$('#estilo').hide();
				return false;
			}
		}
	}

	$('.RegistrarIngresoInternet').click(function(){
		if(Validar_Ingreso_Venta_Internet()!=true){
			$('#Confirmar_Ingreso_Venta_Internet').modal('show');	
		}
	});

	$('.RegistrarIngresoVentaInternet').click(function(){
		var Fecha_Ingreso_Venta_Internet =	$('#Fecha_Ingreso_Venta_Internet').val();
		var Valor_Venta_Ingresar_Internet_oculto =	$('#Valor_Venta_Ingresar_Internet_oculto').val();

		$.ajax({
			url   : "<?= URL::to('Registrar_Venta_Internet') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'Fecha_Ingreso_Venta_Internet': Fecha_Ingreso_Venta_Internet,		
				'Valor_Venta_Ingresar_Internet_oculto': Valor_Venta_Ingresar_Internet_oculto
			},  
			success:function(data){
				$("#Confirmar_Ingreso_Venta_Internet").modal('hide');
				$('#mensaje').html('');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#estilo').show();
						$('#mensaje').append('<p><strong>'+error+'</strong></p>');    
						document.getElementById("mensaje").style.display = "block";
					});  
				}
				if(data == 0){
					$("#Confirmar_Ingreso_Venta_Internet").modal('hide');					
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Venta Registrada.</p>');
					$('#CuerpoMensaje').html('<p>La Venta de Internet se registro con Exito.!!</p>');					
				}

				if(data.ErrorAlRegistrar == "Tiene Ventas"){
					$('#estilo').show();
					$("#estilo").css("fontSize", 14);						
					$("#estilo").css("font-weight","Bold"); 
					$("#estilo").css("background-color:","#321a7c"); 
					$('#mensaje').append('<p><strong>ERROR: Se encontró una venta de internet asociada a la fecha ingresada.</strong></p>');    
					document.getElementById("mensaje").style.display = "block";
					$("#estilo").fadeTo(8000, 500).slideUp(500, function(){
						$("#estilo").hide();
					}); 
				}	
			},
			error:function(data){  
				$("#Confirmar_Ingreso_Venta_Internet").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});
	$('body').delegate('.Eliminar_Venta_Recarga','click',function(){
		var id_Venta_Internet_Eliminar =($(this).attr('id_Venta_Internet_Eliminar'));
		$('#id_venta_internet_eliminar').val(id_Venta_Internet_Eliminar);
		$('#Confirmar_Eliminar_Venta_Internet').modal('show');		
	});

	$('.EliminarVentaInternet').click(function(){
		var id_venta_internet_eliminar= $('#id_venta_internet_eliminar').val();
		$.ajax({
			url   : "<?= URL::to('Eliminar_Venta_Internet') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'id_venta_internet_eliminar': id_venta_internet_eliminar				
			},  
			success:function(data){
				$("#Confirmar_Eliminar_Venta_Internet").modal('hide');				
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#CuerpoMensaje').html('');					
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error al registrar Venta.</p>');
						$('#CuerpoMensaje').html('<p>'+error+'</p>');
					});  
				}
				if(data == 0){
					$("#Confirmar_Eliminar_Venta_Internet").modal('hide');
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Venta Eliminada.</p>');
					$('#CuerpoMensaje').html('<p>La Venta de Internet se elimino con Exito.!!</p>');					
				}	
			},
			error:function(data){  
				$("#Confirmar_Eliminar_Venta_Internet").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});

	});
	$('body').delegate('.Editar_Venta_Recarga','click',function(){
		var id_Venta_Internet_Editar =($(this).attr('id_Venta_Internet_Editar'));
		var Valor_Venta_Internet_Editar =($(this).attr('Valor_Venta_Internet_Editar'));
		var Fecha_Venta_Internet_Editar =($(this).attr('Fecha_Venta_Internet_Editar'));
		
		$('#Fecha_Ingreso_Venta_Internet_editar').val(Fecha_Venta_Internet_Editar);
		$('#valor_venta_internet_editar').val(Valor_Venta_Internet_Editar);
		$('#valor_venta_internet_editar_oculto').val(Valor_Venta_Internet_Editar);
		$('#id_venta_internet_oculto').val(id_Venta_Internet_Editar);

		$('#Modal_Editar_Venta_Internet').modal('show');		
	});

	function Validar_Editar_Venta_Internet(){
		var patron =/[0-9]/;
		var valor_venta_internet_editar=$('#valor_venta_internet_editar').val();
		var valor_venta_internet_editar_oculto=parseInt($('#valor_venta_internet_editar_oculto').val());


		if(!patron.test(valor_venta_internet_editar)){
			$('#estilo3').show();
			document.getElementById("mensaje3").innerText = "El valor de la venta de internet no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje3").style.display = "block";
			$('#valor_venta_internet_editar').val('');      
			document.getElementById("valor_venta_internet_editar").focus();
			return true;
		}else{
			if(valor_venta_internet_editar==""){
				$('#estilo3').show();
				document.getElementById("mensaje3").innerText = "El valor de la venta de internet no puede estar vacio.";
				document.getElementById("mensaje3").style.display = "block";
				$('#valor_venta_internet_editar').val('');      
				document.getElementById("valor_venta_internet_editar").focus();
				return true;
			}else{			
				valor_venta_internet_editar=valor_venta_internet_editar.replace(".","");
				$('#valor_venta_internet_editar_oculto').val(valor_venta_internet_editar);
				$('#estilo3').hide();
				return false;
			}
		}
	}

	$('.Editar_Venta_Internet').click(function(){
		if(Validar_Editar_Venta_Internet()!=true){
			$('#Confirmar_Editar_Venta_Internet').modal('show');	
		}
	});

	$('.EditarVentaInternet').click(function(){
		var valor_venta_internet_editar_oculto= $('#valor_venta_internet_editar_oculto').val();
		var Fecha_Ingreso_Venta_Internet_editar= $('#Fecha_Ingreso_Venta_Internet_editar').val();
		var id_venta_internet_oculto		  = $('#id_venta_internet_oculto').val();
		$.ajax({
			url   : "<?= URL::to('Editar_Venta_Internet') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'valor_venta_internet_editar_oculto': valor_venta_internet_editar_oculto,
				'Fecha_Ingreso_Venta_Internet_editar': Fecha_Ingreso_Venta_Internet_editar,
				'id_venta_internet_oculto'			: id_venta_internet_oculto		
			},  
			success:function(data){
				$("#Confirmar_Editar_Venta_Internet").modal('hide');	
				$("#Modal_Editar_Venta_Internet").modal('hide');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#CuerpoMensaje').html('');					
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error al editar Venta.</p>');
						$('#CuerpoMensaje').html('<p>'+error+'</p>');
					});  
				}
				if(data == 0){
					$("#Confirmar_Editar_Venta_Internet").modal('hide');	
					$("#Modal_Editar_Venta_Internet").modal('hide');
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Venta Editada.</p>');
					$('#CuerpoMensaje').html('<p>La Venta de Internet se edito con Exito.!!</p>');					
				}	
			},
			error:function(data){  
				$("#Confirmar_Editar_Venta_Internet").modal('hide');	
				$("#Modal_Editar_Venta_Internet").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});



</script>

@stop