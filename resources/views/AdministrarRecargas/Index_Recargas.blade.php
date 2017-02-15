	@extends('layouts.master')
	@section('title')
	Administrar Recargas
	@stop
	@section('content')	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-phone-square" aria-hidden="true"></i>
				<a href="#">Administrar Recargas</a>
				<i class="fa fa-angle-right"></i>
			</li>				
		</ul>			
	</div>
	
	<div class="row form-group">
		<div class="panel-group">
			<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">			
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" id="Panel_2" style="display: none;">
			<div class="panel-group">
				<div class="panel">
					<div class="panel-heading" style="background-color: #8e7d7d"><strong> <font size ="2", color ="#ffffff" face="Lucida Sans">INGRESO VENTA DE RECARGAS</font></strong></div>
					<div class="panel-body">
						<div class="form-group">
							<font size ="2", color ="#000000">{{Form::label("Seleccione una Categoria:")}}</font>
							<select class="form-control selectpicker text-center" data-live-search="true" id="id_categoria_listar">
								<option></option>
							</select>
						</div>
						<button type="button" class="btn btn-circle RegistrarIngresoMinutos"  style="background-color: #00a8db"
						id="BtnIngresarRecarga" title="Ingresar Recargas">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Ingresar Venta Recargas</span>
							<span class="fa fa-plus-square"></span>
						</font></strong>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" id="Panel_1" style="display: none;">
		<div class="panel-group">
			<div class="panel">
				<div class="panel-heading" style="background-color: #8e7d7d"><strong> <font size ="2", color ="#ffffff" face="Lucida Sans">CATEGORIAS</font></strong></div>
				<div class="panel-body">
					<center>
						<div class="form-group">
							<button type="button" class="btn btn-circle" style="background-color: #00a8db" data-toggle="modal" data-target="#Modal_Registrar_Categoria" 
							id="BtnNuevaCategoria" title="Nueva Categoria">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Nueva Categoria</span>
								<span class="fa fa-plus-square"></span>
							</font></strong>
						</button>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-circle BtnModificarCategoria
						BtnModificarCategoria" style="background-color: #ffae00" 
						id="BtnModificarCategoria" title="Modificar Categoria">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Modificar Categoria</span>
							<span class="fa fa-pencil-square-o"></span>
						</font></strong>
					</button>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-circle BtnEliminarCategoria" style="background-color: #ff0037" 
					id="BtnEliminarCategoria" title="Eliminar Categoria">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Eliminar Categoria</span>
						<span class="fa fa-trash-o"></span>
					</font></strong>
				</button>
			</div>
		</center>
	</div>
</div>
</div>
</div>
</div>

<!-- Modal Nueva Categoria -->
<div class="modal fade" id="Modal_Registrar_Categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-file-text fa-2x" aria-hidden="true"></i> Nueva Categoria</font></strong>
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="estilo">
					<div class="panel-heading" id="mensaje" style="display:none">
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
													Nombre Categoria:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="text" name="Nombre_Nueva_Categoria" id="Nombre_Nueva_Categoria" class="form-control" placeholder="Ingresa Nombre Categoria">
							</td>
						</tr>						
					</tbody>
				</div>
			</table>
		</div>			
		<div class="modal-footer">
			<button type="button" class="btn btn-default CerrarMensaje" data-dismiss="modal">Cerrar</button>
			<button type="button" class="btn btn-primary Registrar_Nueva_Categoria">Registrar</button>
		</div>
	</div>
</div>
</div>
<!-- Termina Modal Nueva Categoria -->
<!-- Confirmar Registro de Categoria -->
<div class="modal fade" id="Confirmar_Registro_Categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de registrar la nueva categoría?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarNuevaCategoria" data-toggle="modal" data-target="#confirm-update" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Registro Categoria -->
<!-- Modal Modificar Categoria -->
<div class="modal fade" id="Modal_Modificar_Categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-pencil-square fa-2x" aria-hidden="true"></i> Modificar Categoria</font></strong>						
					</b>
				</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-danger" style="display:none" id="estilo2">
					<div class="panel-heading" id="mensaje2" style="display:none">
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
													Nombre Categoria:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="hidden" name="id_categoria_oculto_editar" id="id_categoria_oculto_editar" class="form-control" placeholder="Ingresa Nombre Categoria">
								<input type="text" name="Nombre_Editar_Categoria" id="Nombre_Editar_Categoria" class="form-control" placeholder="Ingresa Nombre Categoria">
							</td>
						</tr>						
					</tbody>
				</div>
			</table>
		</div>			
		<div class="modal-footer">
			<button type="button" class="btn btn-default CerrarMensaje" data-dismiss="modal">Cerrar</button>
			<button type="button" class="btn btn-primary Modificar_Categoria">Modificar</button>
		</div>
	</div>
</div>
</div>
<!-- Termina Modal Modificar Categoria -->
<!-- Confirmar Editar Categoria -->
<div class="modal fade" id="Confirmar_Editar_Categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de editar la categoría?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary EditarCategoria" data-toggle="modal" data-target="#confirm-update" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Editar Categoria -->
<!-- Confirmar Eliminar Categoria -->
<div class="modal fade" id="Confirmar_Eliminar_Categoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de eliminar la categoría?</h4>
			</div>
			<div class="modal-body">									
				* Se borrará toda la información asociada a la Categoria: <b><strong> <font size ="2", color="#ff3300" face="Arial Black"><label id="Nombre_Categoria_Eliminar" name="Nombre_Categoria_Eliminar"></label></font></strong></b>
			</div>
			<input type="hidden" name="Id_Categoria_Eliminar" id="Id_Categoria_Eliminar" class="form-control">
			<div class="modal-footer">
				<button  class="btn btn-primary EliminarCategoria" data-toggle="modal" data-target="#confirm-update" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Eliminar Editar Categoria -->
<!-- Modal Ingresar Venta Recarga-->
<div class="modal fade" id="Modal_Ingresar_VentaRecarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">
					<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
						<i class="fa fa-money fa-2x" aria-hidden="true"></i> Nueva Venta Recarga</font></strong>
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
									<span class="badge btn-md btn-success" style="background: 
									#0699d8;">
									<b>
										<strong>
											<font size ="2", color color="#000000" face="Tahoma">
												Fecha Registro:
											</font>
										</strong>
									</b>
								</span>
							</td>
							<td>								
								<div class="form-group col-sm-8">					
									<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
										<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Minutoss" id="Fecha_Ingreso_Minutoss"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
										<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
										</span>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>								
								<span class="badge btn-md btn-success" style="background: 
								#0699d8;">
								<b>
									<strong>
										<font size ="2", color color="#000000" face="Tahoma">
											Valor Venta Recarga:
										</font>
									</strong>
								</b>
							</span>
						</td>
						<td>								
							<div class="form-group col-sm-8">					
								<input type="number" name="ValorRecargaIngresar" id="ValorRecargaIngresar" class="form-control">
							</div>
						</td>
					</tr>
				</tbody>
			</div>
		</table>
	</div>			
	<div class="modal-footer">
		<button type="button" class="btn btn-default CerrarMensaje" data-dismiss="modal">Cerrar</button>
		<button type="button" class="btn btn-primary Registrar_Venta_Recarga">Registrar</button>
	</div>
</div>
</div>
</div>
<!-- Termina Modal Ingresar Venta Recarga -->
<!-- Confirmar Modal Confirmar Venta Recarga  -->
<div class="modal fade" id="Confirmar_Venta_Recarga" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de Registrar La venta de Recarga?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarVentaRecarga" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Modal Confirmar Venta Recarga -->
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
	$('.CerrarMensaje').click(function(){
		$('#estilo').hide();
		$('#estilo2').hide();
		document.getElementById('BtnIngresarRecarga').disabled=true;			
		document.getElementById('BtnModificarCategoria').disabled=true;
		document.getElementById('BtnEliminarCategoria').disabled=true;	
		$('#id_categoria_listar').val('').selectpicker('refresh');	
	});
	
	document.getElementById('BtnIngresarRecarga').disabled=true;
	document.getElementById('BtnModificarCategoria').disabled=true;
	document.getElementById('BtnEliminarCategoria').disabled=true;
	Cargar_Tabla_Recargas_Ingresados();
	Listar_Categorias();
	function Cargar_Tabla_Recargas_Ingresados(){
		$.ajax({
			type:'get',
			url:'{{ url('Cargar_Tabla_Recargas_Ingresados')}}',
			success: function(data){      
				$('#tabla_id').empty().html(data);			
			}
		});	

	}
	function Listar_Categorias(){
		$el =$('#id_categoria_listar');
		$.ajax({
			url   : "<?= URL::to('Listar_Categorias') ?>",
			type  : "GET",
			async : false,		  
			success:function(re){
				RemoverDataCombobox(document.getElementById("id_categoria_listar"));
				var option = $('<option />');									
				$.each(re.Nombre_Categoria, function(key,value) {
					$el.append($("<option class='text-center'></option>")
						.attr("value", key).text(value));
				});
			}
		});
	}
	function RemoverDataCombobox(selectbox)	{
		var i;
		for(i = selectbox.options.length - 1 ; i >= 0 ; i--){
			selectbox.remove(i);
		}
	}

	$("#id_categoria_listar").change(function(){
		var id_categoria_listar = document.getElementById('id_categoria_listar').value;						

		if(id_categoria_listar==0){			
			document.getElementById('BtnIngresarRecarga').disabled=true;			
			document.getElementById('BtnModificarCategoria').disabled=true;
			document.getElementById('BtnEliminarCategoria').disabled=true;

		}else{	
			document.getElementById('BtnIngresarRecarga').disabled=false;
			document.getElementById('BtnModificarCategoria').disabled=false;
			document.getElementById('BtnEliminarCategoria').disabled=false;


			var nombre_plan =$("#id_categoria_listar option:selected").text();	
			var str = nombre_plan;
			var resultado = str.toUpperCase();
			$('#nombre_plan_eliminar').text(resultado);	
			$('#id_plan_eliminar').val(id_categoria_listar);			
		}
	});


	function Validar_Registro_Nueva_Categoria(){
		var espacio_blanco    = /[a-z]/i;  //Expresión regular
		var Nombre_Nueva_Categoria=$('#Nombre_Nueva_Categoria').val();

		if(!espacio_blanco.test(Nombre_Nueva_Categoria)){
			$('#estilo').show();
			document.getElementById("mensaje").innerText = "El nombre de la categoria no puede estar vacio.";
			document.getElementById("mensaje").style.display = "block";
			$('#Nombre_Nueva_Categoria').val('');      
			document.getElementById("Nombre_Nueva_Categoria").focus();
			return true;
		}else{
			if(Nombre_Nueva_Categoria==""){
				$('#estilo').show();
				document.getElementById("mensaje").innerText = "El nombre de la categoria no puede estar vacio.";
				document.getElementById("mensaje").style.display = "block";
				$('#Nombre_Nueva_Categoria').val('');      
				document.getElementById("Nombre_Nueva_Categoria").focus();
				return true;
			}else{
				$('#estilo').hide();
				return false;
			}
		}
	}

	function Validar_Registro_Editar_Categoria(){
		var espacio_blanco    = /[a-z]/i;  //Expresión regular
		var Nombre_Editar_Categoria=$('#Nombre_Editar_Categoria').val();

		if(!espacio_blanco.test(Nombre_Editar_Categoria)){
			$('#estilo2').show();
			document.getElementById("mensaje2").innerText = "El nombre de la categoria no puede estar vacio.";
			document.getElementById("mensaje2").style.display = "block";
			$('#Nombre_Editar_Categoria').val('');      
			document.getElementById("Nombre_Editar_Categoria").focus();
			return true;
		}else{
			if(Nombre_Editar_Categoria==""){
				$('#estilo2').show();
				document.getElementById("mensaje2").innerText = "El nombre de la categoria no puede estar vacio.";
				document.getElementById("mensaje2").style.display = "block";
				$('#Nombre_Editar_Categoria').val('');      
				document.getElementById("Nombre_Editar_Categoria").focus();
				return true;
			}else{
				$('#estilo2').hide();
				return false;
			}
		}
	}

	

	$('.Registrar_Nueva_Categoria').click(function(){
		if(Validar_Registro_Nueva_Categoria()!=true){
			$('#Confirmar_Registro_Categoria').modal('show');		
			
		}
	});	

	$('.RegistrarNuevaCategoria').click(function(){
		
		var Nombre_Nueva_Categoria =	$('#Nombre_Nueva_Categoria').val();

		$.ajax({
			url   : "<?= URL::to('Registrar_Nueva_Categoria') ?>",
			type  : "GET",
			async : false,
			data  :{				
				'Nombre_Nueva_Categoria'             	: Nombre_Nueva_Categoria
			},  
			success:function(data){
				$("#Confirmar_Registro_Categoria").modal('hide');
				$('#mensaje').html('');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#estilo').show();
						$('#mensaje').append('<p><strong>'+error+'</strong></p>');    
						document.getElementById("mensaje").style.display = "block";
					});  
				}
				if(data == 0){
					$("#Confirmar_Registro_Categoria").modal('hide');
					$("#Modal_Registrar_Categoria").modal('hide');
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Categoria Registrado.</p>');
					$('#CuerpoMensaje').html('<p>La categoria se registro con Exito.!!</p>');
					Listar_Categorias();
					Limpiar_data_Despues_de_Registrar_Categoria();
					$('#id_categoria_listar').val('').selectpicker('refresh');
				}	
			},
			error:function(data){  
				$("#Modal_Registrar_Categoria").modal('hide');						
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});

	$('.Modificar_Categoria').click(function(){
		if(Validar_Registro_Editar_Categoria()!=true){
			$('#Confirmar_Editar_Categoria').modal('show');		
			
		}
	});
// Consulta la categoria y la llena en input
$('.BtnModificarCategoria').click(function(){
	var id_categoria_listar = document.getElementById('id_categoria_listar').value;	

	$.ajax({
		type:'get',
		data:{
			'id_categoria_listar':id_categoria_listar
		},
		url:'{{ url('Consultar_Categoria')}}',

		success: function(data){
			$('#Nombre_Editar_Categoria').val(data.NombreCategoria);
			$('#id_categoria_oculto_editar').val(id_categoria_listar);
		}
	});
	$('#Modal_Modificar_Categoria').modal('show');
});

$('.EditarCategoria').click(function(){ 

	var Nombre_Editar_Categoria 	=	$('#Nombre_Editar_Categoria').val();
	var id_categoria_oculto_editar  =	$('#id_categoria_oculto_editar').val();

	$.ajax({
		url   : "<?= URL::to('Editar_Categoria') ?>",
		type  : "GET",
		async : false,
		data  :{				
			'Nombre_Editar_Categoria'             	: Nombre_Editar_Categoria,
			'id_categoria_oculto_editar'            : id_categoria_oculto_editar
		},  
		success:function(data){
			$("#Confirmar_Editar_Categoria").modal('hide');
			$('#mensaje').html('');
			if(data.success==false){
				$.each(data.errors,function(index, error){ 
					$('#estilo2').show();
					$('#mensaje2').append('<p><strong>'+error+'</strong></p>');    
					document.getElementById("mensaje2").style.display = "block";
				});  
			}
			if(data == 0){
				$("#Confirmar_Editar_Categoria").modal('hide');
				$("#Modal_Modificar_Categoria").modal('hide');
				$('#CuerpoMensaje').html('');					
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Categoria Editada.</p>');
				$('#CuerpoMensaje').html('<p>La categoria se edito con Exito.!!</p>');
				Listar_Categorias();
				Limpiar_data_Despues_de_Registrar_Categoria();
				$('#id_categoria_listar').val('').selectpicker('refresh');
			}
			if(data == 1){
				$('#estilo2').show();
				$('#mensaje2').append('<p><strong>No se detectó ningún cambio a modificar.</strong></p>');    
				document.getElementById("mensaje2").style.display = "block";
			}	
		},
		error:function(data){  
			$("#Modal_Modificar_Categoria").modal('hide');						
			$('#CuerpoMensaje').html('');				
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error</p>');
			$('#CuerpoMensaje').html('<p>'+data+'</p>');
		}
	});
});



$('.BtnEliminarCategoria').click(function(){
	var id_categoria_listar = document.getElementById('id_categoria_listar').value;	
	var NombreCategoria =$("#id_categoria_listar option:selected").text();

	var str = NombreCategoria;
	var resultado = str.toUpperCase();
	$('#Nombre_Categoria_Eliminar').text(resultado);	
	$('#Id_Categoria_Eliminar').val(id_categoria_listar);
	$('#Confirmar_Eliminar_Categoria').modal('show');
});

$('.EliminarCategoria').click(function(){
	var Id_Categoria_Eliminar=$('#Id_Categoria_Eliminar').val();
	$.ajax({
		url   : "<?= URL::to('Eliminar_Categoria') ?>",
		type  : "GET",
		async : false,
		data  :{				
			'Id_Categoria_Eliminar'  : Id_Categoria_Eliminar
		},  
		success:function(data){			
			if(data == 0){
				$("#Confirmar_Eliminar_Categoria").modal('hide');				
				$('#CuerpoMensaje').html('');					
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Categoria Eliminada.</p>');
				$('#CuerpoMensaje').html('<p>La categoria se elimino con Exito.!!</p>');
				Listar_Categorias();
				Limpiar_data_Despues_de_Registrar_Categoria();
				$('#id_categoria_listar').val('').selectpicker('refresh');
			}
		}
	});
});


function Limpiar_data_Despues_de_Registrar_Categoria(){
	$('#Nombre_Nueva_Categoria').val('');							
}

$('#BtnIngresarRecarga').click(function(){
	
	
	$('#Modal_Ingresar_VentaRecarga').modal('show');
	// $('#Modal_Ingresar_VentaRecarga').on('shown.bs.modal', function() {
		$('#ValorRecargaIngresar').val('');
		$('#ValorRecargaIngresar').focus();
		document.getElementById("ValorRecargaIngresar").focus();
	});

function Validar_Registro_Venta_Recarga(){
	var patron =/[0-9]/;
	var ValorRecargaIngresar=$('#ValorRecargaIngresar').val();

	if(!patron.test(ValorRecargaIngresar)){
		$('#estilo3').show();
		document.getElementById("mensaje3").innerText = "El valor de la venta de recarga no puede estar vacio o contener caracteres.";
		document.getElementById("mensaje3").style.display = "block";
		$('#ValorRecargaIngresar').val('');      
		document.getElementById("ValorRecargaIngresar").focus();
		return true;
	}else{
		if(ValorRecargaIngresar==""){
			$('#estilo3').show();
			document.getElementById("mensaje3").innerText = "El valor de la venta de recarga no puede estar vacio.";
			document.getElementById("mensaje3").style.display = "block";
			$('#ValorRecargaIngresar').val('');      
			document.getElementById("ValorRecargaIngresar").focus();
			return true;
		}else{

			var str = ValorRecargaIngresar;
			str=str.replace(",","");
			
			// var ValorRecargaIngresar = ValorRecargaIngresar.replace("/./,/", "");			
			$('#ValorRecargaIngresar').val(str);
			
			$('#estilo3').hide();
			return false;
		}
	}
}

$('.Registrar_Venta_Recarga').click(function(){
	if(Validar_Registro_Venta_Recarga()!=true){
		$('#Confirmar_Venta_Recarga').modal('show');
	}

});










</script>
@stop