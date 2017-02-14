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
							<button type="button" class="btn btn-circle RegistrarIngresoMinutos" style="background-color: #00a8db" data-toggle="modal" data-target="#Modal_Registrar_Categoria" 
							id="BtnNuevaCategoria" title="Nueva Categoria">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Nueva Categoria</span>
								<span class="fa fa-plus-square"></span>
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
				<div class="form-group">
					<button type="button" class="btn btn-circle RegistrarIngresoMinutos" style="background-color: #ffae00" 
					id="BtnModificarCategoria" title="Modificar Categoria">
					<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Modificar Categoria</span>
						<span class="fa fa-pencil-square-o"></span>
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
												Nombre Categoria:
											</font>
										</strong>
									</b>
								</span>
							</td>
							<td>								
								<div class="form-group col-sm-10">					
									<input type="text" name="Nombre_Nueva_Categoria" id="Nombre_Nueva_Categoria" class="form-control">
								</div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</div>
			</table>
		</div>			
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="button" class="btn btn-primary">Registrar</button>
		</div>
	</div>
</div>
</div>
<!-- Termina Modal Nueva Categoria -->


<script type="text/javascript">
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



</script>
@stop