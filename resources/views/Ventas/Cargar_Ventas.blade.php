@extends('layouts.master')
@section('title')
Registrar Venta
@stop
@section('content')
<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-usd"></i>
			<a href="#">Vender</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<i class="fa fa-cart-arrow-down"></i>
			<a href="{{URL::route('RegistrarVenta')}}">Registrar Venta</a>
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
		</div>
		<div id="Cargar_Formulario_Venta_Productos" style="display: none;">			
		</div>

		<div class="panel panel-default col-xs-12 col-sm-12 col-md-6 col-lg-6 panelsito_ventas_productos" style="display: none;" id="id_panel_tabla_venta_productos">
			<div class="panel-heading"><i class="fa fa-clock-o fa-2x">Últimos Productos Vendidos</i></div>
			<div class="panel-body">
				<div id="Tabla_Venta_Productos"></div>
			</div>
		</div>

		<input type="hidden" name="hora_venta_oculta" id="hora_venta_oculta" value="{{$today = Carbon::now()}}">

		<!-- Aqui va todo de Alimentos -->
		<div id="Cargar_Formulario_Venta_Alimentos" style="display: none;">			
		</div>		
		<div class="panel panel-default col-xs-12 col-sm-12 col-md-6 col-lg-6 panelsito_ventas_alimentos" style="display: none;" id="id_panel_tabla_venta_alimentos">
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
				Tiempo_Inactividad=setTimeout('document.location.href = "{{ route('RegistrarVenta')}}"',120000);
			}
			function Sin_Inactividad_Venta2(){

				window.clearTimeout(Tiempo_Inactividad);
				Tiempo_Inactividad2=setTimeout('document.location.href = "{{ route('Index')}}"',80000);
			}
	
		Sin_Inactividad_Venta2();

		$('#boton_registrar_venta_producto').click(function(){
			$.ajax({
				type:'get',
				url:'{{ url('Formulario_Venta_Productos')}}',
				success: function(data){      
					$('#Cargar_Formulario_Venta_Productos').empty().html(data);
				}
			});			
		});

		$('#boton_registrar_venta_alimento').click(function(){
			$.ajax({
				type:'get',
				url:'{{ url('Formulario_Venta_Alimentos')}}',
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


	
	@stop