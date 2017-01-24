<?php if($VentaAlimento->total()==0): ?>
<script type="text/javascript">	
	$('.panelsito_ventas_alimentos').hide();
</script>
<?php else: ?>
<div class="row">	
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box green">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i>Listado Ventas Alimento
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
						<th class="column-title">Nombre Alimento</th>
						<th class="column-title">Cantidad Venta</th>
						<th class="column-title">Precio Alimento</th>
						<th class="column-title">Valor Total</th>
						<th class="column-title">Hora Venta</th>
						<th class="column-title">Remover</th>
					</tr>	
				</thead>
				<tbody>
					<input type="hidden" value="<?php echo e($numero = 1); ?>" onclick="">	
					<?php foreach($VentaAlimento as $value): ?>
					<input type="hidden" value="<?php echo e($ValorVenta=$value->total_alimento_venta); ?>">	
					<input type="hidden" value="<?php echo e($ValorVenta=number_format($ValorVenta)); ?>">	
					<tr class="even pointer">							
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($numero++); ?></font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->Alimento->nombre_alimento); ?></font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->cantidad_alimento_venta); ?></font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->precio_alimento_venta); ?></font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($ValorVenta); ?></font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e(Carbon::parse($value->hora_venta_alimento)->diffForHumans()); ?>

						</font></strong></b></td>
						<td class=" ">							
							<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" id="<?php echo e($value->id); ?>" class="Eliminar_Venta_Alimento" data-backdrop="static" data-keyboard="false" title="Eliminar" Alimento_Venta="<?php echo e($value->Alimento->nombre_alimento); ?>" id_venta="<?php echo e($value->id); ?>" canti_vendido="<?php echo e($value->cantidad_alimento_venta); ?>" id_alimento_venta="<?php echo e($value->alimento_id); ?>">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-times fa-2x"></span></font></strong>
							</a>	
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div align="left"><h3><span class="label label-info">Total Vendido:</span><span class="label label-danger">$<?php echo e($TotalVendido); ?></span></h3></div>
			<center><?php echo e($VentaAlimento->links()); ?></center>
			<br>		
		</div>
	</div>
</div>


<?php endif; ?>

<div id="Modal_Confirmacion_Delete" class="modal fade" role="dialog">
	<div class="modal-dialog">		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">¿ Esta seguro de eliminar esta venta?</font></strong></b></h3>
			</div>
			
			<div class="modal-body">
				<b><strong> <font size ="3", color="#0b6ef6" face="Arial Black">Se va a eliminar la venta del alimento:</font></strong></b><b><strong> <font size ="3", color="#000000" face="Arial Black"><label name="Alimento_Venta" id="numero_venta_alimento""></font></strong></b></label><input type="hidden" name="id_venta" id="id_venta">
				<input type="hidden" name="cantidad_alimento_vendido" id="cantidad_alimento_vendido">
				<input type="hidden" name="id_alimento_venta" id="id_alimento_venta">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success EliminarVentaAlimento" >Si</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>
			</div>

		</div>
	</div>



	<script type="text/javascript">
		$('body').delegate('.Eliminar_Venta_Alimento','click',function(){			
			var Alimento_Venta =($(this).attr ('Alimento_Venta'));
			Alimento_Venta = Alimento_Venta.toUpperCase();
			$('#numero_venta_alimento').text(Alimento_Venta);
			$('#id_venta').val($(this).attr ('id_venta'));
			$('#cantidad_alimento_vendido').val($(this).attr ('canti_vendido'));
			$('#id_alimento_venta').val($(this).attr ('id_alimento_venta'));		
			
		});	

	</script>