@if($VentaInternet->total()==0)
<script type="text/javascript">
	$('#Panel_1').show();
	$('#Panel_2').show();
</script>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<div class="panel panel-primary">
		<div class="panel-heading" style="background-color: #1292da">
			<h3 class="panel-title">
				<strong>ÚLTIMAS VENTAS INTERNET</strong>
				<div class="pull-right">
					<strong>Total Venta Internet:</strong>
					<label><font size ="3", color color="#000000" face="Tahoma"><strong>${{number_format($Valor_Venta_Internet)}}</strong></font></label>
				</div>
			</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img src="global/images/Error_No_Found_Venta_Internet.png" alt="logo" class="img-thumbnail img-responsive" >	
			</div>
		</div>
	</div>
</div>
@else
<script type="text/javascript">
	$('#Panel_1').show();
	$('#Panel_2').show();
</script>
<div class="panel panel-primary">
	<div class="panel-heading" style="background-color: #321a7c">
		<h3 class="panel-title">
			<strong>ÚLTIMAS VENTAS</strong>
			<div class="pull-right">
				<strong>Total Venta Internet:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>${{number_format($Valor_Venta_Internet)}}</strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		<center>{{$VentaInternet->links()}}</center>
		@foreach($VentaInternet as $value)	
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #321a7c">					
					<h3 class="panel-title">
						<b>
							<strong>
								<font color ="#fff200">VENTA INTERNET </font>
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
										<b><strong><font size ="2", color color="#000000" face="Tahoma">Venta Internet:</font></strong></b>
									</td>
									<td>								
										<span class="badge btn-md btn-success" style="background: #dd5816;">
											<b>
												<strong>
													<font size ="2">						
														$ {{number_format($value->venta_total_dia)}}		
													</font>
												</strong>
											</b>
										</span>
									</td>
									<tr>
										<td>
											<b><strong><font size ="2", color color="#000000" face="Tahoma"><i class="fa fa-clock-o" aria-hidden="true"></i>Hora Venta:</font></strong></b>

										</td>
										<td>
											<span class="badge btn-md btn-success">
												<b>
													<strong>
														<font size ="2">					
															{{Carbon::parse($value->hora_venta_internet)->diffForHumans()}} ({{$value->	fecha_internet_venta}})			
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
							<a href="#" class="Editar_Venta_Recarga" id_Venta_Internet_Editar="{{$value->id_venta_internet}}" title="Editar">  
								<strong> <font size ="3", color ="#0d96ea" face="Lucida Sans">
									<span class= "fa fa-pencil-square fa-2x"></span></font>
								</strong>
							</a>
							<a href="#" class="Eliminar_Venta_Recarga" id_Venta_Internet_Eliminar="{{$value->id_venta_internet}}"  title="Eliminar"> 
								<strong> <font size ="3", color ="#0d96ea" face="Lucida Sans">
									<span class= "fa fa-trash-o fa-2x"></span></font>
								</strong>
							</a>	
						</div>
					</div>
				</div>
			</div>
		</div>		
		@endforeach	
	</div>		
</div>
@endif