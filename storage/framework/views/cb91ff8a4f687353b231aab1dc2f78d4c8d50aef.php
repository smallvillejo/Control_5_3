<?php $__env->startSection('title'); ?>
Registrar Venta
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-usd"></i>
			<a href="#">Vender</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<i class="fa fa-cart-arrow-down"></i>
			<a href="<?php echo e(URL::route('RegistrarVenta')); ?>">Registrar Venta</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#" id="boton_registrar_venta_producto" onclick="Sin_Inactividad_Venta()"><i class="fa fa-cube"></i>
				Producto</a>
				<i>||</i>
			</li>
			<li>
				<a href="#" id="boton_registrar_venta_alimento"><i class="fa fa-cutlery"></i>
					Alimento</a>
				</li>
			</ul>
			<div class="page-toolbar">
				<div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
					<i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
				</div>
			</div>
		</div>
		<div id="Cargar_Formulario_Venta_Productos" style="display: none;">			
		</div>
		
		<div class="panel panel-default col-md-8 panelsito_ventas_productos" style="width:50%; display: none;" id="id_panel_tabla_venta_productos">
			<div class="panel-heading"><i class="fa fa-clock-o fa-2x">Últimos Productos Vendidos</i></div>
			<div class="panel-body">
				<div id="Tabla_Venta_Productos"></div>
			</div>
		</div>

		<input type="hidden" name="hora_venta_oculta" id="hora_venta_oculta" value="<?php echo e($today = Carbon::now()); ?>">

		<!-- Aqui va todo de Alimentos -->
		<div id="Cargar_Formulario_Venta_Alimentos" style="display: none;">			
		</div>		
		<div class="panel panel-default col-md-8 panelsito_ventas_alimentos" style="width:50%; display: none;" id="id_panel_tabla_venta_alimentos">
			<div class="panel-heading"><i class="fa fa-clock-o fa-2x">Últimos Alimentos Vendidos</i></div>
			<div class="panel-body">
				<div id="Tabla_Venta_Alimentos"></div>
			</div>
		</div>


		<script type="text/javascript">
			var info2 	= $('.info2');
			var Tiempo_Inactividad;
			var Tiempo_Inactividad2;

			function Sin_Inactividad_Venta(){

				window.clearTimeout(Tiempo_Inactividad2);
				Tiempo_Inactividad=setTimeout('document.location.href = "<?php echo e(route('RegistrarVenta')); ?>"',120000);
			}
			function Sin_Inactividad_Venta2(){

				window.clearTimeout(Tiempo_Inactividad);
				Tiempo_Inactividad2=setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',80000);
			}
		// 	AgregarRegistro();
		// });
		// var cont=0;
		// total=0;
		// subtotal=[];
		// function AgregarRegistro(){
		// 	var NumeroComercio 		=	$('#comercio_id').val();
		// 	var producto_id 		=	$('#id_producto').val();
		// 	var NombreProducto 		=	$('#id_producto option:selected').text();
		// 	var stock_producto 	=	$('#cantidad').val();
		// 	var valor_venta 		=	$('#valor_venta').text();
		// 	var valor_total 		=	$('#valor_total2').val();
		// 	var Fecha_Actual 		=	$('#Fecha_Actual').val();
		// 	var Hora_Venta 			=	"<?php echo e($today = Carbon::today()->now()); ?>";
		// 	var StockProducto 		=	$('#stock_producto').text();
		// 	var valor_total2 		=  parseInt($('#valor_total2').val());
		// 	console.log(Hora_Venta);
		// 	subtotal[cont]=(valor_total2);
		// 	total=total+(subtotal[cont]);
		// 	var fila='<tr class="selected even pointer" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');" title="Quitar">X</button></td><td><label name="NombreProducto">'+NombreProducto+'</label></td><td><label name="stock_producto">'+stock_producto+'</label></td><td><label name="valor_venta">'+valor_venta+'</label></td><td><label name="Hora_Venta">'+Hora_Venta+'</label></td><td><label name="valor_total2">'+valor_total2+'</label></td></tr>';
		// 	cont++;
		// 	$('#total_resultado').html('');
		// 	$('#total_resultado').html("$ "+ConvertirDecimales(total));
		// 	$('#tabla_productos').append(fila);
		// }
		// console.clear();
		Sin_Inactividad_Venta2();

		$('#boton_registrar_venta_producto').click(function(){
			$.ajax({
				type:'get',
				url:'<?php echo e(url('Formulario_Venta_Productos')); ?>',
				success: function(data){      
					$('#Cargar_Formulario_Venta_Productos').empty().html(data);
				}
			});			
		});

		$('#boton_registrar_venta_alimento').click(function(){
			$.ajax({
				type:'get',
				url:'<?php echo e(url('Formulario_Venta_Alimentos')); ?>',
				success: function(data){      
					$('#Cargar_Formulario_Venta_Alimentos').empty().html(data);
				}
			});			
		});

		$('#boton_registrar_venta_producto').click(function(){
			$('#Cargar_Formulario_Venta_Productos').show(1000);
			$('#boton_registrar_venta_producto').hide(1000);
			$('#boton_registrar_venta_alimento').hide();
		});
		$('#Cancelar_Venta_Producto').click(function(){
			$('#Cargar_Formulario_Venta_Productos').hide(1000);
			$('.panelsito_ventas_productos').hide(1000);
			$('#boton_registrar_venta_producto').show(1000);
			$('#boton_registrar_venta_alimento').show();
		});
		$('#Cerrar_X_VentaProducto').click(function(){
			$('#Cargar_Formulario_Venta_Productos').hide(1000);
			$('#boton_registrar_venta_producto').show(1000);
			$('#boton_registrar_venta_alimento').show();
		});

		// Alimentos
		$('#boton_registrar_venta_alimento').click(function(){
			$('#Cargar_Formulario_Venta_Alimentos').show(1000);
			$('#boton_registrar_venta_alimento').hide(1000);
			$('#boton_registrar_venta_producto').hide();
		});
		$('#Cancelar_Venta_Alimento').click(function(){
			$('#Cargar_Formulario_Venta_Alimentos').hide(1000);
			$('.panelsito_ventas_alimentos').hide(1000);
			$('#boton_registrar_venta_alimento').show(1000);
			$('#boton_registrar_venta_producto').show();

		});
		$('#Cerrar_X_VentaAlimento').click(function(e){
			e.preventDefault();
			$('#Cargar_Formulario_Venta_Alimentos').hide(1000);
			$('#boton_registrar_venta_alimento').show(1000);
			$('#boton_registrar_venta_producto').show();
		});

	</script>	


	
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>