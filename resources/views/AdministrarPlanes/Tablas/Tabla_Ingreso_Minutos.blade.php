<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			<strong>Ultimos minutos Registrados</strong>
			<div class="pull-right">
				<strong>Total Venta Minuto:</strong>
				<label><font size ="3", color color="#000000" face="Tahoma"><strong>${{number_format($valor_venta_minutos)}}</strong></font></label>
			</div>
		</h3>
	</div>
	<div class="panel-body">
		@foreach($MinutosRegistrados as $value)
		<div class="panel panel-primary col-xs-12 col-sm-12 col-md-8 col-lg-6">
			<div class="panel-heading">
				<h3 class="panel-title">
					<b>
						<strong>
							<font color ="#fff200">PLAN </font>{{strtoupper($value->PlanMinutos->nombre_plan_minutos)}} <label title="Minutos Plan">({{$value->PlanMinutos->cantidad_minutos}})</label><br>
							<i class="fa fa-phone" aria-hidden="true"></i> # ({{$value->PlanMinutos->NumeroPlan}})
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
													{{$value->cantidad_minutos_vendidos}}		
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
													$ {{number_format($value->PlanMinutos->	valor_venta_minutos)}}		
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
													{{number_format($value->PlanMinutos->	cantidad_minutos_restantes)}}		
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
												<font size ="2", color color="#000000" face="Tahoma">		$ {{number_format($value->total_minutos_venta)}}
												</font>
											</strong>
										</b>
									</span>								
								</td>
							</tr>
						</tbody>
					</div>
				</table>
			</div>
		</div>	
		@endforeach
	</div>
</div>
