@if($VentaProducto->total()==0)
<script type="text/javascript">	
	$('.panelsito_ventas_productos').hide();
</script>
@else
<div class="row">	
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box blue">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i>Listado Ventas Producto
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse">
				</a>
				<a href="#portlet-config" data-toggle="modal" class="config">
				</a>
				<a href="javascript:;" class="reload" onclick="epa()" title="Recargar">
				</a>
				<a href="javascript:;" class="remove">
				</a>
			</div>
		</div>
		<div class="portlet-body flip-scroll table-responsive">
			<table class="table table-bordered table-striped table-condensed flip-content">
				<thead class="flip-content">
					<tr>
						<th class="column-title">#</th>
						<th class="column-title">Nombre Producto</th>
						<th class="column-title">Cantidad Venta</th>
						<th class="column-title">Precio Producto</th>
						<th class="column-title">Valor Total</th>
						<th class="column-title">Hora Venta</th>
						<th class="column-title">Remover</th>
					</tr>	
				</thead>
				<tbody>
					<input type="hidden" value="{{$numero = 1}}" onclick="">	
					@foreach ($VentaProducto as $value)
					<input type="hidden" value="{{$ValorVenta=$value->total_producto_venta}}">	
					<input type="hidden" value="{{$ValorVenta=number_format($ValorVenta)}}">	
					<tr class="even pointer">							
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$numero++}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$value->Producto->nombre_producto}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$value->cantidad_producto_venta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$value->precio_producto_venta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$ValorVenta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{Carbon::parse($value->hora_venta_producto)->diffForHumans()}}
						</font></strong></b></td>
						<td class=" ">							
							<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" id="{{$value->id}}" class="Eliminar_Venta_Producto" data-backdrop="static" data-keyboard="false" title="Eliminar" Producto_Venta="{{$value->Producto->nombre_producto}}" id_venta="{{$value->id}}" canti_vendido="{{$value->cantidad_producto_venta}}" id_producto_venta="{{$value->producto_id}}">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-times fa-2x"></span></font></strong>
							</a>	
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div align="left"><h3><span class="label label-info">Total Vendido:</span><span class="label label-danger">${{$TotalVendido}}</span></h3></div>
			<center>{{$VentaProducto->links()}}</center>
			<br>		
		</div>
	</div>
</div>


@endif

<div id="Modal_Confirmacion_Delete" class="modal fade" role="dialog">
	<div class="modal-dialog">		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">¿ Esta seguro de eliminar esta venta ?</font></strong></b></h3>
			</div>
			
			<div class="modal-body">
				<b><strong> <font size ="3", color="#0b6ef6" face="Arial Black">Se va a eliminar la venta del producto:</font></strong></b><b><strong> <font size ="3", color="#000000" face="Arial Black"><label name="Producto_Venta" id="numero_venta_producto""></font></strong></b></label><input type="hidden" name="id_venta" id="id_venta">
				<input type="hidden" name="cantidad_producto_vendido" id="cantidad_producto_vendido">
				<input type="hidden" name="id_producto_venta" id="id_producto_venta">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success EliminarVentaProducto" >Si</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>
			</div>

		</div>
	</div>



	<script type="text/javascript">
		$('body').delegate('.Eliminar_Venta_Producto','click',function(){			
			var Producto_Venta =($(this).attr ('Producto_Venta'));
			Producto_Venta = Producto_Venta.toUpperCase();
			$('#numero_venta_producto').text(Producto_Venta);
			$('#id_venta').val($(this).attr ('id_venta'));
			$('#cantidad_producto_vendido').val($(this).attr ('canti_vendido'));
			$('#id_producto_venta').val($(this).attr ('id_producto_venta'));		
			
		});	

	</script>