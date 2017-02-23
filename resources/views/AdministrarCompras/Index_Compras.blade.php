	@extends('layouts.master')
	@section('title')
	Administrar Compras
	@stop
	@section('content')	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-money" aria-hidden="true"></i> 
				<a href="#">Administrar Compras</a>
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
				<div class="panel-heading" style="background-color: #0270f7">
					<h3 class="panel-title">
						<strong>INGRESO COMPRAS</strong>						
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
											#0270f7;">
											<b>
												<strong>
													<font size ="2", color color="#000000" face="Tahoma">
														Fecha Compra:
													</font>
												</strong>
											</b>
										</span>
									</div>
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Compra" id="Fecha_Ingreso_Compra"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#0270f7;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Valor Compra:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="number" name="Valor_Ingreso_Compra" id="Valor_Ingreso_Compra" class="form-control" placeholder="Valor Compra" autofocus>
								<input type="hidden" name="Valor_Ingreso_Compra_oculto" id="Valor_Ingreso_Compra_oculto" class="form-control">
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
				#0270f7;">
				<b>
					<strong>
						<font size ="2", color color="#000000" face="Tahoma">
							Descripción Compra:
						</font>
					</strong>
				</b>
			</span>
		</div>	
		<div class="form-group">						
			<textarea name="Descripcion_Ingreso_Compra" id="Descripcion_Ingreso_Compra" class="form-control" style="overflow:auto;resize:none;" rows="5" placeholder="Ingresa Descripción de la Compra">
			</textarea>
		</div>
		<div class="panel panel-danger" style="display:none" id="estilo">
			<div class="panel-heading" id="mensaje" style="display:none">
				<strong></strong>
			</div>
		</div>
		<button type="button" class="btn btn-circle Registrar_Ingreso_Compra"  style="background-color:#0270f7"
		id="BtnIngresarRecarga" title="Ingresar Recargas">
		<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar Compra</span>
			<span class="fa fa-plus-square"></span>
		</font></strong>
	</button>
</div>
</div>
</div>
<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">			
</div>
</div>

<!-- Confirmar Registro de Compra -->
<div class="modal fade" id="Modal_Confirmar_Ingreso_Compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de registrar la compra?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarIngresoCompra" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Registro de Compra -->

<!-- Modal Editar Compra -->
<div class="modal fade" id="Modal_Editar_Compra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-internet-explorer fa-2x" aria-hidden="true"></i> Editar Compra</font></strong>
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
										#0270f7;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Fecha Compra:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<div class="form-group">				
									<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
										<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Compra_Editar" id="Fecha_Ingreso_Compra_Editar"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
										<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</td>
							<td>
								<div class="form-group">
									<span class="badge btn-md btn-success" style="background: 
									#0270f7;">
									<b>
										<strong>
											<font size ="2", color color="#000000" face="Tahoma">
												Valor Compra:
											</font>
										</strong>
									</b>
								</span>
							</div>
							<input type="number" name="Valor_Ingreso_Compra" id="Valor_Ingreso_Compra" class="form-control" placeholder="Valor Compra" autofocus>
							<input type="hidden" name="Valor_Ingreso_Compra_oculto_Editar" id="Valor_Ingreso_Compra_oculto_Editar" class="form-control">
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<span class="badge btn-md btn-success" style="background: 
								#0270f7;">
								<b>
									<strong>
										<font size ="2", color color="#000000" face="Tahoma">
											Descripción Compra:
										</font>
									</strong>
								</b>
							</span>
						</div>
					</td>
					<td>	
						<div class="form-group">						
							<textarea name="Descripcion_Ingreso_Compra_Editar" id="Descripcion_Ingreso_Compra_Editar" class="form-control" style="overflow:auto;resize:none;" rows="5" placeholder="Ingresa Descripción de la Compra">
							</textarea>
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
	Cargar_Tabla_Compras();	



	$('#Descripcion_Ingreso_Compra').val('');	
	// $('#descripcion_compra_ingreso').css("height",200);
	// $('#descripcion_compra_ingreso').css("width",410);

	$('.CerrarMensaje').click(function(){
		$('#estilo').hide();
		$('#estilo2').hide();
		$('#estilo3').hide();
		Cargar_Tabla_Compras();
		$('#Valor_Ingreso_Compra').val('');
		$('#Valor_Ingreso_Compra_oculto').val('');	
		$('#Descripcion_Ingreso_Compra').val('');	
		document.getElementById("Valor_Ingreso_Compra").focus();
		$("#Fecha_Ingreso_Compra").datepicker("destroy");	
		$('#Fecha_Ingreso_Compra').val('{{Carbon::today()->toDateString()}}');	
		$("#Fecha_Ingreso_Compra").datepicker("refresh");	

	});

	function Cargar_Tabla_Compras(){
		$.ajax({
			type:'get',
			url:'{{ url('Cargar_Tabla_Compras')}}',
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

	function Validar_Ingreso_Compra(){
		var patron =/[0-9]/;
		var patron2 =/[a-z]/;
		var Valor_Ingreso_Compra=$('#Valor_Ingreso_Compra').val();
		var Descripcion_Ingreso_Compra=$('#Descripcion_Ingreso_Compra').val();
		var Valor_Ingreso_Compra_oculto=parseInt($('#Valor_Ingreso_Compra_oculto').val());

		$("#estilo").fadeTo(5000, 500).slideUp(500, function(){
			$("#estilo").hide();
		});


		if(!patron.test(Valor_Ingreso_Compra)){
			$('#estilo').show();
			document.getElementById("mensaje").innerText = "El valor de la compra no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje").style.display = "block";
			$('#Valor_Ingreso_Compra').val('');      
			document.getElementById("Valor_Ingreso_Compra").focus();
			return true;
		}else{
			if(Valor_Ingreso_Compra==""){
				$('#estilo').show();
				document.getElementById("mensaje").innerText = "El valor de compra no puede estar vacio.";
				document.getElementById("mensaje").style.display = "block";
				$('#Valor_Ingreso_Compra').val('');      
				document.getElementById("Valor_Ingreso_Compra").focus();
				return true;
			}else{
				if(!patron2.test(Descripcion_Ingreso_Compra)){
					$('#estilo').show();
					document.getElementById("mensaje").innerText = "La descripción de la compra no puede estar vacia o contener espacios en blanco.";
					document.getElementById("mensaje").style.display = "block";
					$('#Descripcion_Ingreso_Compra').val('');      
					document.getElementById("Descripcion_Ingreso_Compra").focus();
					return true;
				}else{
					if(Descripcion_Ingreso_Compra==""){
						$('#estilo').show();
						document.getElementById("mensaje").innerText = "La descripción de la compra no puede estar vacio.";
						document.getElementById("mensaje").style.display = "block";
						$('#Descripcion_Ingreso_Compra').val('');      
						document.getElementById("Descripcion_Ingreso_Compra").focus();
						return true;
					}else{		
						Valor_Ingreso_Compra=Valor_Ingreso_Compra.replace(".","");
						$('#Valor_Ingreso_Compra_oculto').val(Valor_Ingreso_Compra);
						$('#estilo').hide();
						return false;
					}
				}
			}
		}		
	}

	$('.Registrar_Ingreso_Compra').click(function(){
		if(Validar_Ingreso_Compra()!=true){
			$('#Modal_Confirmar_Ingreso_Compra').modal('show');	
		}
	});

	$('.RegistrarIngresoCompra').click(function(){
		var Fecha_Ingreso_Compra =	$('#Fecha_Ingreso_Compra').val();
		var Valor_Ingreso_Compra_oculto =$('#Valor_Ingreso_Compra_oculto').val();
		var Descripcion_Ingreso_Compra =$('#Descripcion_Ingreso_Compra').val();
		
		$.ajax({
			url   : "<?= URL::to('Registrar_Compra') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'Fecha_Ingreso_Compra': Fecha_Ingreso_Compra,
				'Valor_Ingreso_Compra_oculto': Valor_Ingreso_Compra_oculto,
				'Descripcion_Ingreso_Compra': Descripcion_Ingreso_Compra
			},  
			success:function(data){
				$("#Modal_Confirmar_Ingreso_Compra").modal('hide');
				$('#mensaje').html('');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#estilo').show();
						$('#mensaje').append('<p><strong>'+error+'</strong></p>');    
						document.getElementById("mensaje").style.display = "block";
					});  
				}
				if(data == 0){
					$("#Modal_Confirmar_Ingreso_Compra").modal('hide');			
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Compra Registrada.</p>');
					$('#CuerpoMensaje').html('<p>La Compra se registro con Exito.!!</p>');					
				}

			},
			error:function(data){  
				$("#Modal_Confirmar_Ingreso_Compra").modal('hide');				
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
	$('body').delegate('.Editar_Compra','click',function(){
		var id_Venta_Internet_Editar =($(this).attr('id_Venta_Internet_Editar'));
		var Valor_Venta_Internet_Editar =($(this).attr('Valor_Venta_Internet_Editar'));
		var Fecha_Venta_Internet_Editar =($(this).attr('Fecha_Venta_Internet_Editar'));

		$('#Fecha_Ingreso_Venta_Internet_editar').val(Fecha_Venta_Internet_Editar);
		$('#valor_venta_internet_editar').val(Valor_Venta_Internet_Editar);
		$('#valor_venta_internet_editar_oculto').val(Valor_Venta_Internet_Editar);
		$('#id_venta_internet_oculto').val(id_Venta_Internet_Editar);

		$('#Modal_Editar_Compra').modal('show');		
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