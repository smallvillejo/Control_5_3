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
		<li class="dropdown" id="reportes" class="reportes">
			<i class="fa fa-book" aria-hidden="true"></i>	
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes - Balance
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li>							
						<a href="#" title="Exportar Excel" id="btn_reporte_excel_producto" class="ExportarExcel"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Exporta en EXCEL</a>	
					</li>
					<li>
						<a href="#" title="Exportar PDF" id="btn_reporte_pdf_producto" class="ExportarPdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Exporta en PDF</a>	
					</li>						
				</ul>
			</li>		
		</ul>
		<div class="page-toolbar">
			<div id="reportrange" on="Cambio();" class="pull-right reportrange" style="background: #14B9D6;color:white; cursor: pointer; padding: 5px 10px; border: 1px solid #f9f8f8; width: 100%">
				<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
				<span></span> <b class="caret"></b>
			</div>
		</div>
	</div> 
	<input type="hidden" name="fecha_oculta_inicial" id="fecha_oculta_inicial">
	<input type="hidden" name="fecha_oculta_final" id="fecha_oculta_final">
	<!-- <center><div id="content" class="cargando"> -->
	<center><div id="loadinfo" style="display: none" class="cargando"></div></center>
	<div id="content" style="display: none">
		<div class="row">
			<div class="col-sm-6 col-xs-12 col-md-6 col-lg-6">
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
			<div class="col-sm-12 col-xs-12 col-lg-6 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading"><h4><strong>Balance General</strong></h4></div>
					<div class="panel-body">
						<div class="form-group">
							<label class="col-sm-8 control-label"><i class="fa fa-mobile" title="Titulo" aria-hidden="true"></i>
								<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Venta Minutos:</font></strong></label>
								<div class="col-sm-4">					
									<strong>
										<font size ="3", color ="#f72900" face="Tahoma">
											$ <label id="TotalVentaMinutos"></label>
										</font>
									</strong>			
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-8 control-label"><i class="fa fa-internet-explorer" aria-hidden="true"></i>
									<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Venta Internet:</font></strong></label>
									<div class="col-sm-4">					
										<strong>
											<font size ="3", color ="#f72900" face="Tahoma">
												$ <label id="TotalVentaInternet"></label>
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
													$ <label id="TotalVentaRecargas"></label>
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
														$ <label id="TotalCompras"></label>
													</font>
												</strong>			
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-8 control-label"><i class="fa fa-balance-scale" aria-hidden="true"></i>
												<strong> <font size ="2", color ="#151aaf" face="Tahoma">Total Gastos & Inversión:</font></strong></label>
												<div class="col-sm-4">					
													<strong>
														<font size ="3", color ="#f72900" face="Tahoma">
															$ <label id="TotalGastos"></label>									
														</font>
													</strong>	
													<br>
													<br>						
												</div>

											</div>
											<div class="form-group">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background: #000000;">
													<label class="col-sm-8 control-label">
														<strong> <font size ="4", color ="#16bf07" face="Tahoma">
															<i class="fa fa-money" aria-hidden="true"></i>
															TOTAL:</font></strong></label>
															<div class="col-sm-4">					
																<strong>
																	<font size ="5", color ="#16bf07" face="Tahoma">
																		$ <label id="TotalGanancia"></label>
																	</font>
																</strong>			
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-sm-12 col-xs-12 col-lg-6 col-md-6 col-md-offset">
											<div class="panel panel-primary">
												<div class="panel-heading"><h4><strong>Estadisticas Ganancia - <label id="label_fecha"></label></strong></h4></div>
												<div class="panel-body">
													<div id="grafica_estadistica"></div>
												</div>
											</div>	
										</div>
									</div>			
								</div>
								<input type="hidden" name="_token" value="{{ csrf_token()}}"> 	

								<style type="text/css">
									div.cargando:before {
										content:url(global/images/cargando.gif);
										background-repeat: no-repeat;
									}
								</style>	


								<script src="https://code.highcharts.com/highcharts.js"></script>
								<script src="https://code.highcharts.com/modules/exporting.js"></script>

								<script type="text/javascript">


									$(function() {								

										moment.locale('es');

										var start =moment();
										var end = moment();

										$('#label_fecha').text(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
										$('#fecha_oculta_inicial').val(start.format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(end.format('YYYY-MM-DD'));								


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

										Consultar_X_Fecha(moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));								
									});	



									function Cargar_Grafica($Fecha_Inicial, $Fecha_Final){
										var Fecha_Inicial=$Fecha_Inicial;
										var Fecha_Final=$Fecha_Final;
										$.ajax({
											url   : "<?= URL::to('cargar_grafica_estadistica') ?>",
											type  : "GET",
											async : false,	
											data: {
												'Fecha_Inicial' :Fecha_Inicial, 
												'Fecha_Final' 	:Fecha_Final									
											},								
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
											beforeSend: function(){
												$('#loadinfo').show();
											},
											complete: function(){
												$('#loadinfo').hide();
												$('#content').show();										
											},
											success:function(data){										
												$('#TotalProducto').empty().html('$ '+data.TotalVentaProducto);	
												$('#TotalAlimento').empty().html('$ '+data.TotalVentaAlimento);
												$('#CantidadVendidaProductos').empty().html(data.TotalProductos);
												$('#CantidadVendidaAlimentos').empty().html(data.TotalAlimentos);
												$('#TotalVentaMinutos').empty().html(data.TotalVentaMinutos);
												$('#TotalVentaRecargas').empty().html(data.TotalVentaRecarga);
												$('#TotalVentaInternet').empty().html(data.TotalVentaInternet);
												$('#TotalCompras').empty().html(data.TotalCompra);
												$('#TotalGastos').empty().html(data.TotalGasto);
												$('#TotalGanancia').empty().html(data.TotalGanancia);
												$("#TotalGanancia").css("fontSize", 23);						
												$("#TotalGanancia").css("font-weight","Bold");
												console.clear();					


											}
										});	

										Cargar_Grafica(Fecha_Inicial, Fecha_Final);
									}

									function Calendario1(){		
										var Hoy=[moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

										$('#label_fecha').text([moment().format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY')]);
										Consultar_X_Fecha(moment().format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));
										$('#fecha_oculta_inicial').val(moment().format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().format('YYYY-MM-DD'));		


									}

									function Calendario2(){
										var Ayer=[moment().subtract(1, 'days').format('YYYY-MM-DD'), moment().subtract(1, 'days').format('YYYY-MM-DD')];

										$('#label_fecha').text([moment().subtract(1, 'days').format('MMMM D, YYYY') + ' - ' + moment().subtract(1, 'days').format('MMMM D, YYYY')]);

										Consultar_X_Fecha(moment().subtract(1, 'days').format('YYYY-MM-DD'), moment().subtract(1, 'days').format('YYYY-MM-DD'));

										$('#fecha_oculta_inicial').val(moment().subtract(1, 'days').format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().subtract(1, 'days').format('YYYY-MM-DD'));
									}

									function Calendario3(){
										var Ultimos7Dias=[moment().subtract(6, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

										$('#label_fecha').text([moment().subtract(6, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY')]);

										Consultar_X_Fecha(moment().subtract(6, 'days').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));

										$('#fecha_oculta_inicial').val(moment().subtract(6, 'days').format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().format('YYYY-MM-DD'));
									}

									function Calendario4(){
										var Ultimos30Dias=[moment().startOf('month').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD')];

										$('#label_fecha').text([moment().startOf('month').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY')]);

										Consultar_X_Fecha(moment().startOf('month').format('YYYY-MM-DD'), moment().format('YYYY-MM-DD'));

										$('#fecha_oculta_inicial').val(moment().startOf('month').format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().format('YYYY-MM-DD'));

									}

									function Calendario5(){
										var MesActual=[moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD')];


										$('#label_fecha').text([moment().startOf('month').format('MMMM D, YYYY') + ' - ' + moment().endOf('month').format('MMMM D, YYYY')]);

										Consultar_X_Fecha(moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD'));

										$('#fecha_oculta_inicial').val(moment().startOf('month').format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().endOf('month').format('YYYY-MM-DD'));

									}

									function Calendario6(){
										var MesAnterior=[moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD'), moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD')];


										$('#label_fecha').text([moment().subtract(1, 'month').startOf('month').format('MMMM D, YYYY') + ' - ' + moment().subtract(1, 'month').endOf('month').format('MMMM D, YYYY')]);

										Consultar_X_Fecha(moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD'), moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD'));

										$('#fecha_oculta_inicial').val(moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD'));
										$('#fecha_oculta_final').val(moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD'));
									}


									function BuscarRango(){			

										var Fecha_Inicial = moment($('#daterangepicker_start').val()).format('YYYY-MM-DD');
										var Fecha_Final = moment($('#daterangepicker_end').val()).format('YYYY-MM-DD');

										Consultar_X_Fecha(Fecha_Inicial,Fecha_Final);

										$('#label_fecha').text([moment($('#daterangepicker_start').val()).format('MMMM D, YYYY') + ' - ' + moment($('#daterangepicker_end').val()).format('MMMM D, YYYY')]);

										$('#fecha_oculta_inicial').val(Fecha_Inicial);
										$('#fecha_oculta_final').val(Fecha_Final);

									}

									$('.ExportarExcel').click(function(){						
										var _token=$('#_token').val();
										var Fecha_Inicial=$('#fecha_oculta_inicial').val();
										var Fecha_Final=$('#fecha_oculta_final').val();

										$.ajax({
											url   : "<?= URL::to('exportar_report_excel') ?>",
											type  : "POST",
											async : false,		
											data: {
												'Fecha_Inicial' :Fecha_Inicial, 
												'Fecha_Final' 	:Fecha_Final,
												'_token' 		:_token
											},											
											success:function(data){
												var ruta= data.path;                 
												location.href = ruta;
												window.setTimeout(function(){ElminiarArchivoExportado(data.RutaArchivo);},10);
												console.clear();
											}
										});
									});

									function ElminiarArchivoExportado($ruta){
										$.ajax({
											url   : "<?= URL::to('delete_archivo') ?>",
											type  : "GET",
											async : false,		
											data: {
												'ruta' :$ruta												
											}

										});
										console.clear();
									}
									console.clear();

									$('.ExportarPdf').click(function(){	
										var _token=$('#_token').val();
										var Fecha_Inicial=$('#fecha_oculta_inicial').val();
										var Fecha_Final=$('#fecha_oculta_final').val();

										$.ajax({
											url   : "<?= URL::to('exportar_report_pdf') ?>",
											type  : "POST",
											async : false,		
											data: {
												'Fecha_Inicial' :Fecha_Inicial, 
												'Fecha_Final' 	:Fecha_Final,
												'_token' 		:_token
											},											
											success:function(data){
												var ruta= data.path;                 
												location.href = ruta;
												window.setTimeout(function(){ElminiarArchivoExportado(data.RutaArchivo);},10);
												console.clear();
											}
										});
									});
								</script>

								@stop