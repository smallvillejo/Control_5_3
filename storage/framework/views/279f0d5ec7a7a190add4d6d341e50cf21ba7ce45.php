<?php if($Compras->total()==0): ?>
<script type="text/javascript">
	$('#Panel_1').show();
	$('#Panel_2').show();
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading" style="background-color: #1c6a9e">
			<h3 class="panel-title">
				<strong>ÚLTIMAS COMPRAS</strong>
				<div class="pull-right">
					<strong>Total Compras:</strong>
					<label><font size ="3", color color="#000000" face="Tahoma"><strong>$<?php echo e(number_format($Valor_Compras)); ?></strong></font></label>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img src="global/images/Error_No_Found_Compras.png" alt="logo" class="img-thumbnail img-responsive" >	
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
	<div class="panel-heading" style="background-color: #321a7c">
		<h3 class="panel-title">
			<strong>ÚLTIMAS COMPRAS</strong>
			<div class="pull-right">
				<strong>Total Compras:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>$<?php echo e(number_format($Valor_Compras)); ?></strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<center><?php echo e($Compras->links()); ?></center>
		<?php foreach($Compras as $value): ?>	
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #321a7c">		<h3 class="panel-title">
					<b>
						<strong>
							<font color ="#fff200">COMPRAS</font>
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
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Descripción Compra:</font></strong></b>
								</td>
								<td>
									<span class="badge btn-md btn-success" style="background-color: #0270f7">
										<b>
											<strong>
												<font size ="2"><?php echo e($value->	descripcion_compra); ?>

												</font>
											</strong>
										</b>
									</span>									
								</td>
							</tr>
							<tr>
								<td>								
									<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Compra:</font></strong></b>
								</td>
								<td>								
									<span class="badge btn-md btn-success" style="background: #dd5816;">
										<b>
											<strong>
												<font size ="2">
													$ <?php echo e(number_format($value->valor_total_compra)); ?>		
												</font>
											</strong>
										</b>
									</span>
								</td>
								<tr>
									<td>
										<b><strong><font size ="2", color color="#000000" face="Tahoma"><i class="fa fa-clock-o" aria-hidden="true"></i>Hora Compra:</font></strong></b>
									</td>
									<td>
										<span class="badge btn-md btn-success">
											<b>
												<strong>
													<font size ="2"><?php echo e(Carbon::parse($value->hora_compra)->diffForHumans()); ?> (<?php echo e($value->	fecha_compra); ?>)
													</font>
												</strong>
											</b>
										</span>									
									</td>
								</tr>
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
						<a href="#" class="Editar_Venta_Recarga" Id_Compra_Editar="<?php echo e($value->id_compra); ?>" Valor_Compra_Editar="<?php echo e($value->valor_total_compra); ?>" Fecha_Compra_Editar="<?php echo e($value->fecha_compra); ?>" title="Editar">  
							<strong> <font size ="3", color ="#0d96ea" face="Lucida Sans">
								<span class= "fa fa-pencil-square fa-2x"></span></font>
							</strong>
						</a>
						<a href="#" class="Eliminar_Compra" Id_Compra_Eliminar="<?php echo e($value->id_compra); ?>"  title="Eliminar"> 
							<strong> <font size ="3", color ="#0d96ea" face="Lucida Sans">
								<span class= "fa fa-trash-o fa-2x"></span></font>
							</strong>
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