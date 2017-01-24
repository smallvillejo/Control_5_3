@extends('layouts.master')
@section('title')
Menú Principal
@stop
@section('content')
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="{{URL::route('Index')}}">Inicio</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Panel de Inicio</a>			
		</li>		
	</ul>
	<div class="page-toolbar">
		<div id="reportrange" on="Cambio();" class="pull-right reportrange" style="background: #14B9D6;color:white; cursor: pointer; padding: 5px 10px; border: 1px solid #f9f8f8; width: 100%">
			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
			<span></span> <b class="caret"></b>
		</div>
	</div>
</div> 


<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue-madison">
			<div class="visual">
				<i class="fa fa-archive" aria-hidden="true"></i>
			</div>
			<div class="details">
				<div class="number" id="TotalProducto">
					
				</div>
				<div class="desc">
					Total Ventas Productos
				</div>
			</div>
			<a class="more" href="javascript:;">
				Cantidad Vendida: <label id="CantidadVendidaProductos"></label>
			</a>
		</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="dashboard-stat red-intense">
			<div class="visual">
				<i class="fa fa-cutlery"></i>
			</div>
			<div class="details">
				<div class="number" id="TotalAlimento">					
				</div>
				<div class="desc">
					Total Ventas Alimentos
				</div>
			</div>
			<a class="more" href="javascript:;">
				Cantidad Vendida: <label id="CantidadVendidaAlimentos"></label>
			</a>
		</div>
	</div>	
</div>	
<div class="row">			
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		<div class="panel panel-primary">
			<div class="panel-heading"><h4><strong>Balance General</strong></h4></div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-8 control-label"><i class="fa fa-mobile" title="Titulo" aria-hidden="true"></i>
						<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Venta Minutos:</font></strong></label>
						<div class="col-sm-4">					
							<strong>
								<font size ="3", color ="#f72900" face="Tahoma">
									$ <label>2,000</label>
								</font>
							</strong>			
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-8 control-label"><i class="fa fa-desktop" aria-hidden="true"></i>
							<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Venta Internet:</font></strong></label>
							<div class="col-sm-4">					
								<strong>
									<font size ="3", color ="#f72900" face="Tahoma">
										$ <label>2,000</label>
									</font>
								</strong>			
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-8 control-label"><i class="fa fa-usd" title="Titulo" aria-hidden="true"></i>
								<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Venta Recargas:</font></strong></label>
								<div class="col-sm-4">					
									<strong>
										<font size ="3", color ="#f72900" face="Tahoma">
											$ <label>2,000</label>
										</font>
									</strong>			
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-8 control-label"><i class="fa fa-shopping-cart" title="Titulo" aria-hidden="true"></i>
									<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Compras:</font></strong></label>
									<div class="col-sm-4">					
										<strong>
											<font size ="3", color ="#f72900" face="Tahoma">
												$ <label>2,000</label>
											</font>
										</strong>			
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-8 control-label"><i class="fa fa-hand-o-right" aria-hidden="true"></i>
										<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Gastos & Inversión:</font></strong></label>
										<div class="col-sm-4">					
											<strong>
												<font size ="3", color ="#f72900" face="Tahoma">
													$ <label>2,000</label>									
												</font>
											</strong>	
											<br>
											<br>						
										</div>

									</div>
									<div class="form-group">
										<label class="col-sm-8 control-label"><i class="fa fa-money" aria-hidden="true"></i>
											<strong> <font size ="2", color ="#151aaf" face="Tahoma">TOTAL GANANCIA:</font></strong></label>
											<div class="col-sm-4">					
												<strong>
													<font size ="3", color ="#f72900" face="Tahoma">
														$ <label>2,000</label>
													</font>
												</strong>			
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-md-offset">
								<div class="panel panel-primary">
									<div class="panel-heading"><h4><strong>Estadisticas Ganancia - <label id="label_fecha"></label></strong></h4></div>
									<div class="panel-body">
										<div id="grafica_estadistica"></div>
									</div>
								</div>	
							</div>
						</div>
						<input type="hidden" name="_token" value="{{ csrf_token()}}"> 	

						<script src="https://code.highcharts.com/highcharts.js"></script>
						<script src="https://code.highcharts.com/modules/exporting.js"></script>

						<script type="text/javascript">


							$(function() {
								Cargar_Grafica();

								moment.locale('es');

								var start =moment();
								var end = moment();

								$('#label_fecha').text(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));


								function cb(start, end) {
									$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
								}		
								$('#reportrange').daterangepicker({
									startDate: start,
									endDate: end,
									ranges: {
										'Hoy': [moment(), moment()],
										'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
										'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
										'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
										'Mes Actual': [moment().startOf('month'), moment().endOf('month')],
										'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
									}
								}, cb);

								cb(start, end);	

								Consultar_X_Fecha(moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'))

							});	



							function Cargar_Grafica(){
								$.ajax({
									url   : "<?= URL::to('cargar_grafica_estadistica') ?>",
									type  : "GET",
									async : false,									
									success:function(data){
										$('#grafica_estadistica').empty().html(data);	
									}
								});
							}

							function Consultar_X_Fecha($Fecha_Inicial, $Fecha_Final){
								var _token=$('#_token').val();
								var Fecha_Inicial=$Fecha_Inicial;
								var Fecha_Final=$Fecha_Final;
								$.ajax({
									url   : "<?= URL::to('consultar_x_Fecha') ?>",
									type  : "POST",
									async : false,		
									data: {
										'Fecha_Inicial' :Fecha_Inicial, 
										'Fecha_Final' 	:Fecha_Final,
										'_token' 		:_token
									},							
									success:function(data){										
										$('#TotalProducto').empty().html('$ '+data.TotalVentaProducto);	
										$('#TotalAlimento').empty().html('$ '+data.TotalVentaAlimento);
										$('#CantidadVendidaProductos').empty().html(data.TotalProductos);
										$('#CantidadVendidaAlimentos').empty().html(data.TotalAlimentos);
										
									}
								});	
							}


							function Calendario1(){		
								var Hoy=[moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];
								console.log('Seleciono Hoy: ' +Hoy);
							}

							function Calendario2(){
								var Ayer=[moment().subtract(1, 'days').format('YYYY-MM-DD'), moment().subtract(1, 'days').format('YYYY-MM-DD')];

								$('#label_fecha').text([moment().subtract(1, 'days').format('MMMM D, YYYY') + ' - ' + moment().subtract(1, 'days').format('MMMM D, YYYY')]);
							}

							function Calendario3(){
								var Ultimos7Dias=[moment().subtract(6, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];
								console.log('Seleciono Ultimos 7 Dias: '+Ultimos7Dias);
							}

							function Calendario4(){
								var Ultimos30Dias=[moment().startOf('month').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];
								console.log('Seleciono Ultimos 30 Dias: '+Ultimos30Dias);
							}

							function Calendario5(){
								var MesActual=[moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD')];
								console.log('Seleciono Mes Actual: '+MesActual);
							}

							function Calendario6(){
								var MesAnterior=[moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD'), moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD')];
								console.log('Seleciono Mes Anterior: '+MesAnterior);
							}







							function BuscarRango(){			

								var Fecha_Inicial = moment($('#daterangepicker_start').val()).format('YYYY-MM-DD');
								var Fecha_Final = moment($('#daterangepicker_end').val()).format('YYYY-MM-DD');

								var Hoy=[moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

								var Ayer=[moment().subtract(1, 'days').format('YYYY-MM-DD').format('YYYY-MM-DD'), moment().subtract(1, 'days')];

								var Ultimos7Dias=[moment().subtract(6, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

								var Ultimos7Dias=[moment().subtract(6, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];
								var Ultimos30Dias=[moment().startOf('month').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];
								var MesActual=[moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD')];
								var MesAnterior=[moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD'), moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD')];


								alert('Ultimos 7 Dias '+Ultimos7Dias);
								alert('Ultimos 30 Dias '+Ultimos30Dias);
								alert('Mes Actual '+MesActual);
								alert('Mes Anterior '+MesAnterior);


							}
						</script>






						

						@stop