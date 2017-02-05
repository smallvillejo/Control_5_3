@extends('layouts.master')
@section('title')
Últimas Ventas - Alimentos
@stop
@section('content')

<div class="panel panel-primary">
	<div class="panel-heading"><b><strong><font size ="3", color="#ffffff" face="Arial Black">Últimas Ventas - Alimentos</font></strong></b>
		<div class="btn-group pull-right" style="display: none;" id="idTotalAlimentoVendido">		<h4>Total Vendido:<label id="TotalVendido"></label></h4>
			<h4>Cantidad:<label id="CantidadVendida"></label></h4>
		</div>
		<div id="idBuscarAlimento" style="display: none;">
			<br>Buscar Alimento:<b><strong><font size ="3", color="#ea0000" face="Arial Black"><select class="selectpicker" data-live-search="true" id="alimento_id_venta_consulta" onchange="Seleccion_Busqueda()">
			<option></option>
		</select>
	</font></strong></b>
	@if(Auth::user()->perfil_id==2)
	Ventas por Usuario:<b><strong><font size ="3", color="#ea0000" face="Arial Black">
	<select class="selectpicker" data-live-search="true" id="alimento_id_venta_consulta_usuario" onchange="Seleccion_Busqueda_X_Usuario()">
		<option></option>
	</select>
</font></strong></b>
@endif
<button type="button" class="btn btn-danger" id="btnBuscarAlimento" style="display: none;" onclick="refresPagina()">Limpiar<i class="fa fa-eraser" aria-hidden="true"></i></button>
</div>
</div>
<div class="panel-body">		
	<div class="col-xs-1 col-sm-2">
	</div>
	<div id="Tabla_Venta_Alimentos_X_Fecha"></div>
</div>
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">

<script type="text/javascript">

	Listar_Venta_Alimentos();
	cargar_nombres_alimentos();
	cargar_nombres_usuarios();

	function cargar_nombres_usuarios(){
		$el =$('#alimento_id_venta_consulta_usuario');
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('cargar_nombres_usuarios_ultimas_ventas_alimentos') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	  : _token
			},
			success:function(re){
				var option = $('<option />');
				$.each(re, function(key,value) {
					$el.append($("<option></option>")
						.attr("value", key).text(value));
				});
			}
		});
	}

	function Seleccion_Busqueda_X_Usuario(){
		var alimento_id_venta_consulta_usuario  = document.getElementById('alimento_id_venta_consulta_usuario').value;
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Consultar_Ultimas_Ventas_Alimento_x_Nombre_Usuario') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	  : _token,
				'alimento_id_venta_consulta_usuario'     : alimento_id_venta_consulta_usuario
			},
			success:function(resultado){
				$('#Tabla_Venta_Alimentos_X_Fecha').empty().html(resultado);
				Cargar_Valor_Vendido_Alimentos_Cuadrado_X_Usuario();
				Cargar_Cantidad_Vendido_Alimentos_X_Usuario();
			}
		});
	}

	// Cargar Los valores de cantidad y valor vendidos x Usuario Seleccionado
	function  Cargar_Valor_Vendido_Alimentos_Cuadrado_X_Usuario(){
		var alimento_id_venta_consulta_usuario  = document.getElementById('alimento_id_venta_consulta_usuario').value;
		$.ajax({
			type:'get',		
			url:'{{ url('ValorVendidoUltimasVentasAlimentos_X_usuario')}}',
			data:{
				'alimento_id_venta_consulta_usuario'     : alimento_id_venta_consulta_usuario
			},
			success: function(data){
				$('#TotalVendido').empty().html(data);
			}
		});
// console.clear();
}

function  Cargar_Cantidad_Vendido_Alimentos_X_Usuario(){
	var alimento_id_venta_consulta_usuario  = document.getElementById('alimento_id_venta_consulta_usuario').value;
	$.ajax({
		type:'get',
		url:'{{ url('CantidadVendidaAlimentos_X_usuario')}}',
		data:{
			'alimento_id_venta_consulta_usuario'     : alimento_id_venta_consulta_usuario
		},
		success: function(data){
			$('#CantidadVendida').empty().html(data);
		}
	});
// console.clear();
}

function cargar_nombres_alimentos(){
	$el =$('#alimento_id_venta_consulta');
	var _token=$('#_token').val();
	$.ajax({
		url   : "<?= URL::to('cargar_nombres_alimentos') ?>",
		type  : "POST",
		async : false,
		data  :{
			'_token'       	  : _token
		},
		success:function(re){
			var option = $('<option />');
			$.each(re, function(key,value) {
				$el.append($("<option></option>")
					.attr("value", key).text(value));
			});
		}
	});
}
function Seleccion_Busqueda(){
	var alimento_id_venta_consulta  = document.getElementById('alimento_id_venta_consulta').value;
	var _token=$('#_token').val();
	$.ajax({
		url   : "<?= URL::to('Consultar_Alimento_x_Busqueda') ?>",
		type  : "POST",
		async : false,
		data  :{
			'_token'       	  : _token,
			'alimento_id_venta_consulta'     : alimento_id_venta_consulta
		},
		success:function(resultado){
			$('#Tabla_Venta_Alimentos_X_Fecha').empty().html(resultado);
			$('#btnBuscarAlimento').show();
		}

	});
}
function  Listar_Venta_Alimentos(){
	Cargar_Valor_Vendido_Alimentos_Cuadrado();
	Cargar_Cantidad_Vendido_Alimentos();
	var Hora_Venta = "{{Carbon::today()->toDateString()}}";
	$.ajax({
		type:'get',
		url:'{{ url('Tabla_Venta_Alimentos_X_Fecha')}}',
		data:{
			'Hora_Venta' : Hora_Venta
		},
		success: function(data){
			$('#Tabla_Venta_Alimentos_X_Fecha').empty().html(data);
			Notificaciones_PocoStock();
			subir();				
		}
	});
}
$(document).on("click",".pagination li a",function(e) {
	e.preventDefault();
	var Hora_Venta = "{{$today = Carbon::now()}}";
	var url = $(this).attr("href");
	$.ajax({
		type:'get',
		url:url,
		data:{
			'Hora_Venta' : Hora_Venta
		},
		success: function(data){
			$('#Tabla_Venta_Alimentos_X_Fecha').empty().html(data);
		}
	});
});
$('body').delegate('.Eliminar_Venta','click',function(){
	var Alimento_Venta =($(this).attr ('Alimento_Venta'));
	Alimento_Venta = Alimento_Venta.toUpperCase();
	$('#numero_venta_alimento').text(Alimento_Venta);
	$('#id_venta').val($(this).attr ('id_venta'));
	$('#cantidad_alimento_vendido').val($(this).attr ('canti_vendido'));
	$('#id_alimento_venta').val($(this).attr ('id_alimento_venta'));
});
$('body').delegate('.EliminarVentaAlimento','click',function(){
	var id_venta_alimento = $('#id_venta').val();
	var cantidad_alimento_vendido = $('#cantidad_alimento_vendido').val();
	var id_alimento_venta = $('#id_alimento_venta').val();
	$.ajax({
		type:'get',
		url:'{{ url('Eliminar_Venta_Alimento_X_Fecha')}}',
		data:{
			'id_venta_alimento' 		: id_venta_alimento,
			'id_alimento_venta' 		: id_alimento_venta,
			'cantidad_alimento_vendido' : cantidad_alimento_vendido
		},
		success: function(data){		
			$('#CuerpoMensaje').html('');  
			$("#Modal_Confirmacion_Delete").modal('hide');
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Venta Eliminada.</p>');
			$('#CuerpoMensaje').append('<p>La venta se elimino exitosamente.</p>'); 
		}
	});
// console.clear();
});
// ---------------------------------------------------------------------------------------------------
function refresPagina(){
	Listar_Venta_Alimentos();
	$('#alimento_id_venta_consulta').val('').selectpicker('refresh');
	$('#btnBuscarAlimento').hide();
}
function  Cargar_Valor_Vendido_Alimentos_Cuadrado(){
	$.ajax({
		type:'get',
		url:'{{ url('Ultimas_Ventas_Alimentoss_TotalVendido')}}',
		success: function(data){
			$('#TotalVendido').empty().html(data);
		}
	});
// console.clear();
}
function  Cargar_Cantidad_Vendido_Alimentos(){
	$.ajax({
		type:'get',
		url:'{{ url('CantidadVendidaAlimentos')}}',
		success: function(data){
			$('#CantidadVendida').empty().html(data);
		}
	});
// console.clear();
}
function  Cargar_Valor_Vendido_Alimentos_Cuadrado_Calendario(){
	var Fecha_Inicial = $('#Fecha_Inicial').val();
	var Fecha_Final   = $('#Fecha_Final').val();
	var _token		  =	$('#_token').val();
	$.ajax({
		type:'get',
		url:'{{ url('Cuadrado_Venta_Alimentos_X_BusquedaCalendario')}}',
		data:{
			'Fecha_Inicial' : Fecha_Inicial,
			'Fecha_Final'   : Fecha_Final,
			'_token'   		: _token
		},
		success: function(data){
			$('#Cuadro_Venta_Alimentos_X_Fecha').empty().html(data);
		}
	});
// console.clear();
}

var arriba;
function subir() {
	if (document.body.scrollTop != 0 || document.documentElement.scrollTop != 0) {
		window.scrollBy(0, -2000);
		arriba = setTimeout('subir()', 10);
	}
	else clearTimeout(arriba);
}
</script>


@stop