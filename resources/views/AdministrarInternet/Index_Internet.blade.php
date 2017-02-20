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
								<input type="hidden" name="Valor_Venta_Ingresar_Internet_oculto" id="Valor_Venta_Ingresar_Internet_oculto" class="form-control">
							</td>
						</tr>
						<tr>
							
						</tr>						
					</tbody>
				</div>
			</table>
			<div class="panel panel-danger" style="display:none" id="estilo">
				<div class="panel-heading" id="mensaje" style="display:none">
					<strong></strong>
				</div>
			</div>
			<button type="button" class="btn btn-circle RegistrarIngresoInternet"  style="background-color:#a50a0a"
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

<!-- Confirmar Registro de Categoria -->
<div class="modal fade" id="Confirmar_Ingreso_Venta_Internet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">¿Está seguro de registrar la venta de internet?</h4>
			</div>
			<div class="modal-footer">
				<button  class="btn btn-primary RegistrarIngresoVentaInternet" type="button" id="confirmar_venta_manual">Si</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
			</div>
		</div>
	</div>     
</div>
<!-- Termina Confirmar Registro Categoria -->
<!-- Modal Para Confirmaciones -->
<div class="modal fade" tabindex="-1" role="dialog" id="ModalConfirmacion" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="TitleModal"></h4>
			</div>
			<div class="modal-body" id="CuerpoMensaje">
				<strong> <font size ="4", color ="#01080f" face="Lucida Sans"><p2></p2></font></strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary CerrarMensaje" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- Termina Modal Para Confirmaciones -->





<script type="text/javascript">
	Cargar_Tabla_Ventas_Internet();	

	$('.CerrarMensaje').click(function(){
		$('#estilo').hide();
		$('#estilo2').hide();
		Cargar_Tabla_Ventas_Internet();
		$('#Valor_Venta_Ingresar_Internet').val('');
		$('#Valor_Venta_Ingresar_Internet_oculto').val('');
		document.getElementById("Valor_Venta_Ingresar_Internet").focus();
	});

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

	function Validar_Ingreso_Venta_Internet(){
		var patron =/[0-9]/;
		var Valor_Venta_Ingresar_Internet=$('#Valor_Venta_Ingresar_Internet').val();
		var Valor_Venta_Ingresar_Internet_oculto=parseInt($('#Valor_Venta_Ingresar_Internet_oculto').val());


		if(!patron.test(Valor_Venta_Ingresar_Internet)){
			$('#estilo').show();
			document.getElementById("mensaje").innerText = "El valor de la venta de internet no puede estar vacio o contener caracteres.";
			document.getElementById("mensaje").style.display = "block";
			$('#Valor_Venta_Ingresar_Internet').val('');      
			document.getElementById("Valor_Venta_Ingresar_Internet").focus();
			return true;
		}else{
			if(Valor_Venta_Ingresar_Internet==""){
				$('#estilo3').show();
				document.getElementById("mensaje").innerText = "El valor de la venta de internet no puede estar vacio.";
				document.getElementById("mensaje").style.display = "block";
				$('#Valor_Venta_Ingresar_Internet').val('');      
				document.getElementById("Valor_Venta_Ingresar_Internet").focus();
				return true;
			}else{			
				Valor_Venta_Ingresar_Internet=Valor_Venta_Ingresar_Internet.replace(".","");
				$('#Valor_Venta_Ingresar_Internet_oculto').val(Valor_Venta_Ingresar_Internet);
				$('#estilo').hide();
				return false;
			}
		}
	}

	$('.RegistrarIngresoInternet').click(function(){
		if(Validar_Ingreso_Venta_Internet()!=true){
			$('#Confirmar_Ingreso_Venta_Internet').modal('show');	
		}
	});

	$('.RegistrarIngresoVentaInternet').click(function(){
		var Fecha_Ingreso_Venta_Recarga =	$('#Fecha_Ingreso_Venta_Recarga').val();
		var Valor_Venta_Ingresar_Internet_oculto =	$('#Valor_Venta_Ingresar_Internet_oculto').val();

		$.ajax({
			url   : "<?= URL::to('Registrar_Venta_Internet') ?>",
			type  : "GET",
			async : false,
			data  :{		
				'Fecha_Ingreso_Venta_Recarga': Fecha_Ingreso_Venta_Recarga,		
				'Valor_Venta_Ingresar_Internet_oculto': Valor_Venta_Ingresar_Internet_oculto
			},  
			success:function(data){
				$("#Confirmar_Ingreso_Venta_Internet").modal('hide');
				$('#mensaje').html('');
				if(data.success==false){
					$.each(data.errors,function(index, error){ 
						$('#estilo').show();
						$('#mensaje').append('<p><strong>'+error+'</strong></p>');    
						document.getElementById("mensaje").style.display = "block";
					});  
				}
				if(data == 0){
					$("#Confirmar_Ingreso_Venta_Internet").modal('hide');					
					$('#CuerpoMensaje').html('');					
					$('#ModalConfirmacion').modal('show');
					$('#TitleModal').html('<p>Venta Registrada.</p>');
					$('#CuerpoMensaje').html('<p>La Venta de Internet se registro con Exito.!!</p>');					
				}	
			},
			error:function(data){  
				$("#Confirmar_Ingreso_Venta_Internet").modal('hide');					
				$('#CuerpoMensaje').html('');				
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Error</p>');
				$('#CuerpoMensaje').html('<p>'+data+'</p>');
			}
		});
	});

</script>

@stop