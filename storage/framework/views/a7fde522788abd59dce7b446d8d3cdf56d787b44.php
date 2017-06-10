<?php if($MinutosRegistrados->total()==0): ?>
<script type="text/javascript">
	$('#Panel_1').show();
	$('#Panel_2').show();
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">
				<strong>ÚLTIMOS MINUTOS REGISTRADOS</strong>
				<div class="pull-right">
					<strong>Total Venta Minuto:</strong>
					<label><font size ="3", color color="#000000" face="Tahoma"><strong>$<?php echo e(number_format($valor_venta_minutos)); ?></strong></font></label>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img src="global/images/Error_No_Found_Venta_Minutos.png" alt="logo" class="img-thumbnail img-responsive" >	
			</div>
		</div>
	</div>
</div>
<?php else: ?>
<script type="text/javascript">
	$('#Panel_1').show();
	$('#Panel_2').show();
</script>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<strong>ÚLTIMOS MINUTOS REGISTRADOS</strong>
			<div class="pull-right">
				<strong>Total Venta Minuto:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>$<?php echo e(number_format($valor_venta_minutos)); ?></strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<center><?php echo e($MinutosRegistrados->links()); ?></center>
		<?php foreach($MinutosRegistrados as $value): ?>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading">					
					<h3 class="panel-title">
						<b>
							<strong>
								<font color ="#fff200">PLAN </font><?php echo e(strtoupper($value->PlanMinutos->nombre_plan_minutos)); ?> <label title="Minutos Plan">(<?php echo e($value->PlanMinutos->cantidad_minutos); ?>)</label><br>
								<i class="fa fa-phone" aria-hidden="true"></i> # (<?php echo e($value->PlanMinutos->Numero_Nuevo_Plan); ?>)
							</strong>
						</b>
					</h3>
				</div>
				<div class="panel-body">
					<table class="table table-user-information">
						<div class="row">
							<tbody>
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Minutos Vendidos:</font></strong></b>
									</td>
									<td>								
										<span class="badge btn-md btn-success">
											<b>
												<strong>
													<font size ="2">
														<?php echo e($value->cantidad_minutos_vendidos); ?>	
													</font>
												</strong>
											</b>
										</span>
									</td>
								</tr>
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Minuto:</font></strong></b>
									</td>
									<td>								
										<span class="badge btn-md btn-success">
											<b>
												<strong>
													<font size ="2">
														$ <?php echo e(number_format($value->PlanMinutos->	valor_venta_minutos)); ?>		
													</font>
												</strong>
											</b>
										</span>
									</td>
								</tr>
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Minutos Restantes:</font></strong></b>
									</td>
									<td>								
										<span class="badge btn-md btn-success">
											<b>
												<strong>
													<font size ="2">
														<?php echo e(number_format($value->PlanMinutos->	cantidad_minutos_restantes)); ?>		
													</font>
												</strong>
											</b>
										</span>
									</td>
								</tr>
								<tr>
									<td>								
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Vendido:</font></strong></b>
									</td>
									<td>
										<span class="badge btn-md btn-success" style="background: #dd5816;">
											<b>
												<strong>
													<font size ="2", color color="#000000" face="Tahoma">		$ <?php echo e(number_format($value->total_minutos_venta)); ?>

													</font>
												</strong>
											</b>
										</span>								
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
					<div class="panel-footer">Panel de opciones
						<div class="pull-right">
							<a href="#" data-toggle = 'modal' data-target="#ModalEditar_Registro_Minutos"  class="Editar_Minutos_Registrados" id_minuto_registrado="<?php echo e($value->id_detalle_plan); ?>"  data-backdrop="static" data-keyboard="false" title="Editar">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-pencil-square fa-2x"></span></font></strong>
							</a>
							<a href="#" data-toggle = 'modal' data-target="#Eliminar_Registro_VentaMinuto" id="<?php echo e($value->id_detalle_plan); ?>"  Cantidad_Minutos_Restantes_Plan="<?php echo e($value->PlanMinutos->cantidad_minutos_restantes); ?>" Cantidad_Minutos_Vendidos="<?php echo e($value->cantidad_minutos_vendidos); ?>" id_plan_reingresoMinuto="<?php echo e($value->PlanMinutos->id); ?>" class="Eliminar_Venta_Minuto" data-backdrop="static" data-keyboard="false" title="Eliminar">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-trash-o fa-2x"></span></font></strong>
							</a>	
						</div>
					</div>
				</div>
			</div>
		</div>		
		<?php endforeach; ?>	
	</div>		
</div>
<?php endif; ?>