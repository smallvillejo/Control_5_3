<?php $__env->startSection('title'); ?>
Últimas Ventas - Productos
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="panel panel-primary">
	<div class="panel-heading"><b><strong><font size ="3", color="#ffffff" face="Arial Black">Últimas Ventas - Productos</font></strong></b>
		<div class="btn-group pull-right" style="display: none;" id="idTotalProductoVendido">			
			<h4>Total Vendido:<label id="TotalVendido"></label></h4>
		</div>
		<div id="idBuscarProducto" style="display: none;">
			<br>Buscar Producto:<b><strong><font size ="3", color="#ea0000" face="Arial Black"><select class="selectpicker" data-live-search="true" id="producto_id_venta_consulta" onchange="Seleccion_Busqueda()">
			<option></option>
		</select>
	</font></strong></b>
	<button type="button" class="btn btn-danger" id="btnBuscarProducto" style="display: none;" onclick="refresPagina()">Limpiar<i class="fa fa-eraser" aria-hidden="true"></i></button>
</div>
</div>
<div class="panel-body">	
	<div id="Tabla_Venta_Productos_X_Fecha"></div>
</div>
</div>


<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
<!-- <button onclick="funcionea();">CLICKO</button> -->
<script type="text/javascript">

	Listar_Venta_Productos();
	cargar_nombres_productos();
	
	function cargar_nombres_productos(){
		$el =$('#producto_id_venta_consulta');
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('cargar_nombres_productos') ?>",
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
		var producto_id_venta_consulta  = document.getElementById('producto_id_venta_consulta').value;
		var _token=$('#_token').val();
		$.ajax({
			url   : "<?= URL::to('Consultar_Producto_x_Busqueda') ?>",
			type  : "POST",
			async : false,
			data  :{
				'_token'       	  : _token,
				'producto_id_venta_consulta'     : producto_id_venta_consulta
			},
			success:function(resultado){
				$('#Tabla_Venta_Productos_X_Fecha').empty().html(resultado);
			}
		});
	}
	function  Listar_Venta_Productos(){
		Cargar_Valor_Vendido_Productos_Cuadrado();
		var Hora_Venta = "<?php echo e(Carbon::today()->toDateString()); ?>";
		$.ajax({
			type:'get',
			url:'<?php echo e(url('Tabla_Venta_Productos_X_Fecha')); ?>',
			data:{
				'Hora_Venta' : Hora_Venta
			},
			success: function(data){
				$('#Tabla_Venta_Productos_X_Fecha').empty().html(data);
				Notificaciones_PocoStock();
			}
		});
	}
	$(document).on("click",".pagination li a",function(e) {
		e.preventDefault();
		var Hora_Venta = "<?php echo e($today = Carbon::now()); ?>";
		var url = $(this).attr("href");
		$.ajax({
			type:'get',
			url:url,
			data:{
				'Hora_Venta' : Hora_Venta
			},
			success: function(data){
				$('#Tabla_Venta_Productos_X_Fecha').empty().html(data);
			}
		});
	});
	$('body').delegate('.Eliminar_Venta','click',function(){
		var Producto_Venta =($(this).attr ('Producto_Venta'));
		Producto_Venta = Producto_Venta.toUpperCase();
		$('#numero_venta_producto').text(Producto_Venta);
		$('#id_venta').val($(this).attr ('id_venta'));
		$('#cantidad_producto_vendido').val($(this).attr ('canti_vendido'));
		$('#id_producto_venta').val($(this).attr ('id_producto_venta'));
	});
	$('body').delegate('.EliminarVentaProducto','click',function(){
		var id_venta_producto = $('#id_venta').val();
		var cantidad_producto_vendido = $('#cantidad_producto_vendido').val();
		var id_producto_venta = $('#id_producto_venta').val();
		$.ajax({
			type:'get',
			url:'<?php echo e(url('Eliminar_Venta_Producto_X_Fecha')); ?>',
			data:{
				'id_venta_producto' 		: id_venta_producto,
				'id_producto_venta' 		: id_producto_venta,
				'cantidad_producto_vendido' : cantidad_producto_vendido
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
	// $('.date').datepicker('setDate', null);
	// $('#FechaInicial *').prop('disabled',false);
	// $('#FechaFinal *').prop('disabled',false);
	Listar_Venta_Productos();
	$('#producto_id_venta_consulta').val('').selectpicker('refresh');
	$('#btnBuscarProducto').hide();
}
// ---------------------------------------------------------------------------------------------------
// function BuscarXFecha(){
// 	var info3   = $('.info3');
// 	$('#_token').val('<?php echo e(csrf_token()); ?>');
// 	Cargar_Valor_Vendido_Productos_Cuadrado_Calendario();
// 	var Fecha_Inicial = $('#Fecha_Inicial').val();
// 	var Fecha_Final   = $('#Fecha_Final').val();
// 	var _token		  =	$('#_token').val();
// 	var startDate = new Date($('#Fecha_Inicial').val());
// 	var endDate = new Date($('#Fecha_Final').val());
// 	if (startDate < endDate|| Fecha_Inicial==""|| Fecha_Final==""){
// 		$('#success-alert3').hide();
// 		$.ajax({
// 			type:'POST',
// 			url:'<?php echo e(url('Buscar_Venta_Producto_X_Fecha')); ?>',
// 			data:{
// 				'Fecha_Inicial' : Fecha_Inicial,
// 				'Fecha_Final'   : Fecha_Final,
// 				'_token'   		: _token
// 			},
// 			success: function(data){
// 				if(data.errores){
// 					$('#success-alert3').show();
// 					info3.find('ul2').empty();
// 					$.each(data.errores,function(index, error){
// 							// $('#CuerpoMensaje').append('<p>'+error+'</p>');
// 							info3.find('ul2').append('<li>'+error+'</li>');
// 						});
// 					info3.slideDown();
// 				}else{
// 					$('#Tabla_Venta_Productos_X_Fecha').empty().html(data);
// 					$('#FechaInicial *').prop('disabled',true);
// 					$('#FechaFinal *').prop('disabled',true);
// 					$('#FechaFinal *').prop('disabled',true);
// 					document.getElementById('btn_buscarProducto').disabled=true;
// 				}
// 			}
// 		});
// 	}else{
// 		if(Fecha_Inicial==Fecha_Final){
// 			$('#success-alert3').hide();
// 			$.ajax({
// 				type:'POST',
// 				url:'<?php echo e(url('Buscar_Venta_Producto_X_Fecha')); ?>',
// 				data:{
// 					'Fecha_Inicial' : Fecha_Inicial,
// 					'Fecha_Final'   : Fecha_Final,
// 					'_token'   		: _token
// 				},
// 				success: function(data){
// 					if(data.errores){
// 						$('#success-alert3').show();
// 						info3.find('ul2').empty();
// 						$.each(data.errores,function(index, error){
// 							// $('#CuerpoMensaje').append('<p>'+error+'</p>');
// 							info3.find('ul2').append('<li>'+error+'</li>');
// 						});
// 						info3.slideDown();
// 					}else{
// 						$('#Tabla_Venta_Productos_X_Fecha').empty().html(data);
// 						$('#FechaInicial *').prop('disabled',true);
// 						$('#FechaFinal *').prop('disabled',true);
// 						$('#FechaFinal *').prop('disabled',true);
// 						document.getElementById('btn_buscarProducto').disabled=true;
// 					}
// 				}
// 			});
// 		}else{
// 			$('#success-alert3').show();
// 			info3.find('ul2').html('<li>La fecha final no puede ser mayor a la fecha inicial.</li>');
// 			info3.slideDown();
// 		}
// 	}
// }
// ---------------------------------------------------------------------------------------------------
function  Cargar_Valor_Vendido_Productos_Cuadrado(){
	$.ajax({
		type:'get',
		url:'<?php echo e(url('Cuadrado_Venta_Productos_X_Fecha')); ?>',
		success: function(data){
			$('#TotalVendido').empty().html(data);
		}
	});
// console.clear();
}
function  Cargar_Valor_Vendido_Productos_Cuadrado_Calendario(){
	var Fecha_Inicial = $('#Fecha_Inicial').val();
	var Fecha_Final   = $('#Fecha_Final').val();
	var _token		  =	$('#_token').val();
	$.ajax({
		type:'get',
		url:'<?php echo e(url('Cuadrado_Venta_Productos_X_BusquedaCalendario')); ?>',
		data:{
			'Fecha_Inicial' : Fecha_Inicial,
			'Fecha_Final'   : Fecha_Final,
			'_token'   		: _token
		},
		success: function(data){
			$('#Cuadro_Venta_Productos_X_Fecha').empty().html(data);
		}
	});
// console.clear();
}
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>