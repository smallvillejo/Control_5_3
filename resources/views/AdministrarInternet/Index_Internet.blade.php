	@extends('layouts.master')
	@section('title')
	Administrar Internet
	@stop
	@section('content')	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-internet-explorer" aria-hidden="true"></i>
				<a href="#">Administrar Internet</a>
				<i class="fa fa-angle-right"></i>
			</li>				
		</ul>			
	</div>
	<br>
	<br>
	<br>

	<div class="row form-group">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4" id="Panel_2">
			<div class="panel panel-primary">
				<div class="panel-heading" style="background-color: #a50a0a">
					<h3 class="panel-title">
						<strong>INGRESO VENTA DE INTERNET</strong>						
					</h3>
				</div>				
				<div class="panel-body">
					<table class="table table-user-information">
						<div class="row">
							<tbody>
								<tr>
									<td>
										<div class="form-group">
											<span class="badge btn-md btn-success" style="background: 
											#23475a;">
											<b>
												<strong>
													<font size ="2", color color="#000000" face="Tahoma">
														Fecha Venta Internet:
													</font>
												</strong>
											</b>
										</span>
									</div>
									<div class="form-group">				
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Venta_Recarga" id="Fecha_Ingreso_Venta_Recarga"   placeholder="Fecha Registro" value="{{Carbon::today()->toDateString()}}" readonly>
											<span class="input-group-btn">
												<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div class="form-group">
										<span class="badge btn-md btn-success" style="background: 
										#23475a;">
										<b>
											<strong>
												<font size ="2", color color="#000000" face="Tahoma">
													Valor Venta Internet:
												</font>
											</strong>
										</b>
									</span>
								</div>
								<input type="number" name="Valor_Venta_Ingresar_Internet" id="Valor_Venta_Ingresar_Internet" class="form-control" placeholder="Ingrese el valor venta de internet" autofocus>
							</td>
						</tr>
						<tr>
							<td></td>
						</tr>						
					</tbody>
				</div>
			</table>
			<button type="button" class="btn btn-circle RegistrarIngresoMinutos"  style="background-color:#a50a0a"
			id="BtnIngresarRecarga" title="Ingresar Recargas">
			<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar Venta</span>
				<span class="fa fa-plus-square"></span>
			</font></strong>
		</button>
	</div>
</div>
</div>
<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">			
</div>
</div>



<script type="text/javascript">
	Cargar_Tabla_Ventas_Internet();	
	function Cargar_Tabla_Ventas_Internet(){
		$.ajax({
			type:'get',
			url:'{{ url('Cargar_Tabla_Ventas_Internet')}}',
			success: function(data){      
				$('#tabla_id').empty().html(data);			
			}
		});	
		$(document).on("click",".pagination li a",function(e) {
			e.preventDefault();		
			var url = $(this).attr("href");
			$.ajax({
				type:'get',
				url:url,			
				success: function(data){
					$('#tabla_id').empty().html(data);					
				}
			});
		});	
	}
</script>

@stop