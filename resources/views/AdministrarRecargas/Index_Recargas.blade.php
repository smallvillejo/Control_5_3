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
						<button type="button" class="btn btn-circle btnModificar" style="background-color: #ffae00" 
						id="BtnModificarCategoria" title="Modificar Categoria">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Modificar Categoria</span>
							<span class="fa fa-pencil-square-o"></span>
						</font></strong>
					</button>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-circle RegistrarIngresoMinutos" style="background-color: #ff0037" 
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
								<input type="text" name="Nombre_Editar_Categoria" id="Nombre_Editar_Categoria" class="form-control" placeholder="Ingresa Nombre Categoria">
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
<!-- Termina Modal Modificar Categoria -->
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

	
	function Limpiar_data_Despues_de_Registrar_Categoria(){
		$('#Nombre_Nueva_Categoria').val('');							
	}

	

	



</script>
@stop