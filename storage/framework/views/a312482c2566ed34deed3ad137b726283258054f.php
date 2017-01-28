<?php if($Alimentos->total()==0): ?>
<div class="col-md-12">
	<img src="global/images/sin_alimento_registrado.png" alt="logo" class="img-thumbnail img-responsive" >
	<script type="text/javascript">	
		document.getElementById('reportes').disabled=true;	
		document.getElementById('busqueda_alimento').disabled=true;		
	</script>
</div>
<?php else: ?>
<script type="text/javascript">	
	$('#id_div_venta_alimento').show();
	$('#id_div_venta_alimento_cuadro').show();	
	document.getElementById('reportes').disabled=false;	
	document.getElementById('busqueda_alimento').disabled=false;		
</script>
<!-- <?php echo $__env->make('layouts.lupa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
<?php foreach($Alimentos as $value): ?>
<input type="hidden" value="<?php echo e($valor_venta_alimento=number_format($value->valor_venta_alimento)); ?>">
<input type="hidden" value="<?php echo e($valor_total_inversion=number_format($value->valor_total_inversion)); ?>">
<input type="hidden" value="<?php echo e($valor_inversion_alimento=number_format($value->valor_inversion_alimento)); ?>">
<input type="hidden" value="<?php echo e($nombre_alimento=$value->nombre_alimento); ?>">


<div class="col-xs-12 col-sm-6 col col-md-6 col-lg-4">
	<div class="panel panel-info">
		<div class="panel-heading">
			<span class="badge btn-md btn-success" title="<?php echo e($nombre_alimento = strtoupper($nombre_alimento)); ?>"><b><strong> <font size ="2"><?php echo e($nombre_alimento = strtoupper($nombre_alimento)); ?>

			</font></strong></b></span>
		</div>
		<div class="panel-body">
			<?php if($value->ruta_imagen_alimento==null): ?>
			<center><img class="cuadradoFoto" src="global/images/AlimentoNoDisponible.png" width="200px" height="200px"/></center>
			<?php else: ?>
			<?php if(File::exists($value->ruta_imagen_alimento)): ?>
			<center><img class="cuadradoFoto FotoGrande" src="<?php echo e($value->ruta_imagen_alimento); ?>" Imagen="<?php echo e($value->ruta_imagen_alimento); ?>" width="200px" height="200px"/></center>	
			<?php else: ?>		
			<center><img class="cuadradoFoto" src="global/images/AlimentoNoDisponible.png" width="200px" height="200px"/></center>
			<?php endif; ?>
			<?php endif; ?>
			<h4><p class="text-muted credit"></p></h4>
			<div class="panel panel-info">
				<div class="panel-heading"></div>				
				<table class="table table-user-information">
					<div class="row">
						<tbody>
							<tr>
								<td>								
									<b><strong> <font size ="2", color="#000000" face="Arial Black">Stock Almacén:</font></strong></b>
								</td>
								<td>
									<?php if($value->cantidad_alimento==0): ?>
									<span class="badge btn-md btn-danger" title="0 Stock--Debe surtir este alimento."><b><strong> <font size ="2">0 Stock.
									</font></strong></b></span>
									<?php else: ?>
									<?php if($value->cantidad_alimento<=3): ?>
									<span class="badge btn-md btn-warning" title="Poco Stock"><b><strong> <font size ="2"><?php echo e($value->cantidad_alimento); ?>

									</font></strong></b></span>   
									<?php else: ?>
									<span class="badge btn-md btn-success"><b><strong> <font size ="2"><?php echo e($value->cantidad_alimento); ?>

									</font></strong></b></span>					
									<?php endif; ?>
									<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td>					
									<b><strong> <font size ="2", color="#000000" face="Arial Black">Valor Venta Alimento:</font></strong></b>
								</td>
								<td>
									<span class="badge btn-md btn-success"><b><strong> <font size ="2">$<?php echo e($valor_venta_alimento); ?></font></strong></b></span>
								</td>								
							</tr>
							<tr>
								<td>
									<b><strong> <font size ="2", color="#000000" face="Arial Black">Valor Inversión:</font></strong></b>
								</td>
								<td>
									<span class="badge btn-md btn-success"><b><strong> <font size ="2">$<?php echo e($valor_inversion_alimento); ?>

									</font></strong></b></span>

								</td>
							</tr>
							<tr>
								<td>
									<b><strong> <font size ="2", color="#000000" face="Arial Black">Total Inversión:</font></strong></b>
								</td>
								<td>
									<span class="badge btn-md btn-success"><b><strong> <font size ="2">$<?php echo e($valor_total_inversion); ?></font></strong></b></span>
								</td>
							</tr>
							<tr>						
								<td>
								</td>
								<td>
								</td>
							</tr>						
						</tbody>
					</div>
				</table>
			</div>

			<div class="panel-footer">Última actualización: <?php echo e(Carbon::parse($value->Fecha_Creacion)->toDateString()); ?>

				<div class="btn-group pull-right">				
					<a href="#" data-toggle = 'modal' data-target="#Modal_Modificar_Alimentos" title="Modificar" class="Edit_Aliment" Id_alimentoEditar="<?php echo e($value->id); ?>" <strong> <font size ="3", color="#0eacf9" face="Lucida Sans"><span class= "fa fa-pencil-square fa-2x"></span></font></a>

					<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" title="Eliminar" class="Delete_Aliment" NombreAlimento="<?php echo e($nombre_alimento = strtoupper($nombre_alimento)); ?>"  Id_alimentoEliminar="<?php echo e($value->id); ?>" <strong> <font size ="3", color="#0eacf9" face="Lucida Sans"><span class= "fa fa-trash-o fa-2x"></span></font></a>					
				</div>
			</div>
		</div>
	</div>
</div>

<?php endforeach; ?>		
<center><?php echo e($Alimentos->links()); ?></center>
<?php endif; ?>
