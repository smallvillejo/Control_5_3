<meta http-equiv="Content-type" content="text/html; charset=utf-8">
@if($VentaProducto->total()==0)
<div class="col-md-10">
	<img src="global/images/Error_No_Foundd.png" alt="logo" class="img-thumbnail img-responsive" >
	<script type="text/javascript">
		$('#id_div_venta_producto').hide();	
		$('#idBuscarProducto').hide();
		$('#id_div_venta_producto').hide();
		$('#idTotalProductoVendido').hide();
	</script>
</div>
@else
<script type="text/javascript">
	$('#id_div_venta_producto').show();	
	$('#idBuscarProducto').show();
	$('#id_div_venta_producto').show();
	$('#idTotalProductoVendido').show();
</script>
<!-- Diseño Panels Para ver el producto en el panel -->
<img src="global/images/ImagenVacio.png" alt="logo" height="0" width="0" >
<center>{{$VentaProducto->links()}}</center>
@foreach ($VentaProducto as $value)
<div class="col-xs-12 col-sm-6 col col-md-6 col-lg-4">
	<div class="panel panel-info">
		<div class="panel-heading">
			<span class="badge btn-md btn-danger" title="{{strtoupper($nombre_producto=$value->Producto->nombre_producto)}}">
				<b><strong> <font size ="2">{{strtoupper($nombre_producto=$value->Producto->nombre_producto)}}
				</font></strong></b></span>
			</div>
			<div class="panel-body">
				@if($value->Producto->ruta_imagen_producto==null)
				<center><img class="cuadradoFoto" src="global/images/ProductoNoDisponible.png" width="80px" height="80px"/></center>
				@else
				@if(File::exists($value->Producto->ruta_imagen_producto))
				<center><img class="cuadradoFoto FotoGrande" src="{{$value->Producto->ruta_imagen_producto}}" Imagen="{{$value->Producto->ruta_imagen_producto}}" width="80px" height="80px"/></center>	
				@else		
				<center><img class="cuadradoFoto" src="global/images/ProductoNoDisponible.png" width="80px" height="80px"/></center>
				@endif
				@endif
				<h4><p class="text-muted credit"></p></h4>
				<div class="panel panel-info">
					<div class="panel-heading"></div>				
					<table class="table table-user-information">
						<div class="row">
							<tbody>
								<tr>
									<td>								
										<b><strong><font size ="2", color="#000000" face="Arial Black">Cant.Vendido</font></strong></b>
									</td>
									<td>								
										<span class="badge btn-md btn-success">
											<b><strong> <font size ="2">{{$value->cantidad_producto_venta}}</font></strong></b>
										</span>
									</td>
								</tr>
								<tr>
									<td>					
										<b><strong> <font size ="2", color="#000000" face="Arial Black">Valor Producto:</font></strong>
										</b>
									</td>
									<td>
										<span class="badge btn-md btn-success"><b><strong> <font size ="2">
											$ {{$value->precio_producto_venta}} 
										</font></strong></b>
									</span>
								</td>								
							</tr>
							<tr>
								<td>
									<b><strong> <font size ="2", color="#000000" face="Arial Black">Valor Vendido:</font></strong></b>
								</td>
								<td>
									<span class="badge btn-md btn-success"><b><strong><font size ="2">
										$ {{number_format($value->total_producto_venta)}} 
									</font></strong></b>
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
					
					<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" id="{{$value->id}}" class="Eliminar_Venta" data-backdrop="static" data-keyboard="false" title="Eliminar" Producto_Venta="{{$value->Producto->nombre_producto}}" id_venta="{{$value->id}}" canti_vendido="{{$value->cantidad_producto_venta}}" id_producto_venta="{{$value->producto_id}}">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-trash-o fa-2x"></span></font></strong>
					</a>						|
					<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Editar" id="{{$value->id}}" class="Editar_Venta" data-backdrop="static" data-keyboard="false" title="Editar" Producto_Venta="{{$value->Producto->nombre_producto}}" id_venta="{{$value->id}}" canti_vendido="{{$value->cantidad_producto_venta}}" id_producto_venta="{{$value->producto_id}}">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-pencil-square fa-2x"></span></font></strong>
					</a>		

				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer">
		Venta Registrada Por: <strong>{{ucwords($value->NombreUsuario->nombre).' '.ucwords($value->NombreUsuario->apellido)}}</strong><br><i class="fa fa-clock-o" title="Hora Venta" aria-hidden="true"></i></strong> {{Carbon::parse($value->hora_venta_producto)->diffForHumans()}}
	</div>
</div>


</div>
@endforeach		
@endif
<!-- Termina Diseño Panel Producto -->
<script type="text/javascript">
	$('body').delegate('.FotoGrande','click',function(){
		var ruta_imagen_producto =($(this).attr('Imagen'));	
		$("#id_photo_preview").attr("src",ruta_imagen_producto);		
		$('#Modal_See_Producto').modal('show');

	});
</script>
<!-- Modal See Producto-->
<div class="modal fade" id="Modal_See_Producto" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">	
			<center><img class="cuadradoFoto" id="id_photo_preview" width="100%" height="100%"/></center>		
		</div>
	</div>
</div>
<!-- Termina Modal See Producto-->

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
				<!--   <button type="button" class="btn btn-primary Cerrar_Mensaje" data-dismiss="modal" onclick="limpiar_Datos()">Cerrar</button> -->

				<button type="button" class="btn btn-primary Cerrar_Mensaje" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div id="Modal_Confirmacion_Delete" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">¿ Esta seguro de eliminar esta venta ?</font></strong></b></h3>
			</div>
			<div class="modal-body">
				<b><strong> <font size ="3", color="#0b6ef6" face="Arial Black">Se va a eliminar la venta del producto:</font></strong></b>
				<b><strong> <font size ="3", color="#000000" face="Arial Black"><label name="Producto_Venta" id="numero_venta_producto""></label></font></strong></b>
				<input type="hidden" name="id_venta" id="id_venta">
				<input type="hidden" name="cantidad_producto_vendido" id="cantidad_producto_vendido">
				<input type="hidden" name="id_producto_venta" id="id_producto_venta">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success EliminarVentaProducto" >Si</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></div>
			</div>
		</div>
	</div>
	<!-- Editar Venta -->
	<div id="Modal_Confirmacion_Editar" class="modal fade" role="dialog" onmousemove="CalcularValorTotal()" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">Editar Venta</font></strong></b></h3>
					<input type="hidden" name="id_venta_producto_editar" id="id_venta_producto_editar" class="form-control">
					<input type="hidden" name="id_producto_leido" id="id_producto_leido" class="form-control">
					<input type="hidden" name="cantidad_producto_vendido2" id="cantidad_producto_vendido2" class="form-control">
					<input type="hidden" name="cantidad_producto_stock" id="cantidad_producto_stock" class="form-control">					
				</div>
				<div class="modal-body">
					<div class="col-md-7">
						<input type="hidden" name="comercio_id" id="comercio_id" value="{{Auth::user()->id_comercio}}" class="form-control">
						<input type="hidden" name="Fecha_Actual" id="Fecha_Actual" value="{{$today = Carbon::today()->toDateString()}}" class="form-control">
						<input type="hidden" name="Hora_Venta" id="Hora_Venta" value="{{$today = Carbon::today()->now()}}" class="form-control">
						<div class="form-group">
							<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Seleccione un Producto</font></strong></b></label>
							<div class="input-icon right">
								<select class="form-control selectpicker" data-live-search="true" id="id_producto_editar" onchange="seleccion()" >
									<option></option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-5">
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Stock:</font></strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<b><strong><font size ="5", color="#fd0000" face="Arial Black"><label name="stock_producto" id="stock_producto"></label></font></strong></b>
							</div>
						</div>
						<div class="panel panel-danger" style="display:none" id="id_estilo9">
							<div class="panel-heading" id="stock_valida" style="display:none">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-5">
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Venta:</font></strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<b><strong><font size ="4", color="#fd0000" face="Arial Black">
									<label id="SignoPesos"></label>
									<label type="text"  name="valor_venta" id="valor_venta" value="0"></label></font></strong></b>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-4">
									<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad:</font></strong></b></label>
								</div>
								<div class="form-group col-sm-10">
									<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><input class="form-control" id="cantidad_productos_venta" name="cantidad_productos_venta" id="cantidad_productos_venta" type="number" onchange="CalcularValorTotal()" ></font></strong></b>
									<div class="panel panel-danger" style="display:none" id="id_estilo">
										<div class="panel-heading" id="valida_cantidad" style="display:none">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Imagen Producto -->
						<div class="row">
							<div class="form-group col-sm-5">
								<!-- <div class="col-lg-5 col-md-offset-1"> -->
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Vista Previa Producto:</font>
								</strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<img alt="User Pic" src="global/images/ImagenVacio.png" class="img-thumbnail img-responsive" title="Venta de Productos" id="img_destino" name="img_destino" width="150" height="5" border="5">
								<br>
							</div>
							<!-- Termina Imagen Producto -->
							<!-- Valor Total -->
							<div class="form-group col-sm-5">
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Total:</font></strong></b></label>
								<b><strong><font size ="5", color="#fd0000" face="Arial Black"><label type="text"  name="valor_total" id="valor_total" value="0"></label></font></strong></b>
								<input type="hidden" name="valor_total2" id="valor_total2" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="form-actions">
							<div class="row">
								<button type="button" class="btn btn-circle blue EditarVentaProduco" id="boton_editar_venta">
									<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-floppy-o"></span></font></strong>
									<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Editar</span></font></strong></button>
									<button type="button" class="btn btn-circle red" id="Cancelar_Venta_Producto" data-dismiss="modal">
										<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-times-circle"></span></font></strong>
										<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Cancelar</span></font></strong></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					cargar_nombres_productos();
					$('.Editar_Venta').click(function(){
						var id_venta =($(this).attr ('id_venta'));
						var _token=$('#_token').val();
						var $NoDisponible= 'global/images/ProductoNoDisponible.png';
						$.ajax({
							url   : "<?= URL::to('Cargar_datos_Modal_editar_venta_productos') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       : _token,
								'id_venta'     : id_venta
							},
							success:function(re){

								$("#id_producto_editar option:selected").text(re.name).val(re.producto_id);
								$("#id_producto_editar").selectpicker("refresh");
								$('#stock_producto').text(re.stock);
								$('#valor_venta').text(re.precio_producto_venta);
								$('#cantidad_productos_venta').val(re.cantidad_producto_venta);
								$('#valor_total').text(re.total_producto_venta);
								$('#valor_total2').val(re.total_producto_venta);

								$('#id_venta_producto_editar').val(id_venta);
								$('#id_producto_leido').val(re.producto_id);
								$('#cantidad_producto_vendido2').val(re.cantidad_producto_venta);
								$('#cantidad_producto_stock').val(re.stock);



								if(re.ruta_imagen_producto="No Disponible"){
									$("#img_destino").attr("src",$NoDisponible);
								}else{
									$("#img_destino").attr("src",re.RutaImagen);
								}
								document.getElementById("cantidad_productos_venta").focus();
							}
						});
					});
					function cargar_nombres_productos(){
						$el =$('#id_producto_editar');
						var _token=$('#_token').val();
						$.ajax({
							url   : "<?= URL::to('cargar_nombres_productos') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       	  : _token
							},
							success:function(re){
								var option = $('<option />');
								$.each(re, function(key,value) {
									$el.append($("<option></option>")
										.attr("value", key).text(value));
								});
							}
						});
					}

					function seleccion(){						
						var t = document.getElementById("id_producto_editar");
						var $NoDisponible= 'global/images/ProductoNoDisponible.png';
						var id_producto  = document.getElementById('id_producto_editar').value;
						var _token=$('#_token').val();
						$.ajax({
							url   : "<?= URL::to('Cargar_detalles_Productos_Venta') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       	  : _token,
								'id_producto'     : id_producto
							},
							success:function(re){
								$('#stock_producto').text(re.stock);
								$('#valor_venta').text(re.valor_venta_producto);
								$('#cantidad_productos_venta').val('');
								$('#valor_total').text('');
								$('#valor_total2').val('');						

								CalcularValorTotal();
								document.getElementById("cantidad_productos_venta").focus();

								if(re.ruta_imagen_producto="No Disponible"){
									$("#img_destino").attr("src",$NoDisponible);
								}else{
									$("#img_destino").attr("src",re.RutaImagen);
								}								
							}
						});
					}
					
					function ConvertirDecimales(n, dp) {
						var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
						while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
						return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
					}
					function CalcularValorTotal(){
						var stock =parseInt($('#stock_producto').text());
						var Cantidad_Productos_Venta =parseInt($('#cantidad_productos_venta').val());
						var valor_unitario =parseInt($('#valor_venta').text());
						var id_producto = document.getElementById("id_producto_editar").value;

						var cantidad_producto_stock=parseInt($('#cantidad_producto_stock').val());

						var cantidad_producto_vendido2=parseInt($('#cantidad_producto_vendido2').val());

						if(id_producto==0){
							document.getElementById('cantidad_productos_venta').disabled=true;
							$('#cantidad_productos_venta').val('');
							$('#stock_producto').text('');
							$('#valor_venta').text('');
							$('#valor_total').text('');
						}else{
							document.getElementById('cantidad_productos_venta').disabled=false;
						}
						if(stock!=="" || Cantidad_Productos_Venta!==""){
							if(Cantidad_Productos_Venta<=0){
								$('#id_estilo').show();
								document.getElementById('boton_editar_venta').disabled=true;
								document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es menor al Stock.";
								document.getElementById("valida_cantidad").style.display = "block";
							}else{
								if(cantidad_producto_stock+cantidad_producto_vendido2>=Cantidad_Productos_Venta){
									var valor_total=(Cantidad_Productos_Venta)*(valor_unitario);
									$('#valor_total2').val(valor_total);
									$('#valor_total').text('$'+ConvertirDecimales(valor_total));
									$('#id_estilo').hide();
									document.getElementById('boton_editar_venta').disabled=false;
									document.getElementById("valida_cantidad").innerText = "";
								}else{									
									if(Cantidad_Productos_Venta>stock){
										$('#id_estilo').show();
										document.getElementById('boton_editar_venta').disabled=true;
										document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es mayor al Stock.";
										document.getElementById("valida_cantidad").style.display = "block";
										var valor_total=(Cantidad_Productos_Venta)*(valor_unitario);
										$('#valor_total').text('$'+ConvertirDecimales(valor_total));
									}else{
										$('#id_estilo').hide();
										document.getElementById('boton_editar_venta').disabled=false;
										document.getElementById("valida_cantidad").innerText = "";
										if($('#cantidad_productos_venta').val()=="" || $('#cantidad_productos_venta').val()=="0"){
											$('#SignoPesos').text('$');
											$('#SignoPesos2').text('$');
											document.getElementById('boton_editar_venta').disabled=true;
										}else{
											var valor_total=(Cantidad_Productos_Venta)*(valor_unitario);
											$('#valor_total2').val(valor_total);
											$('#valor_total').text('$'+ConvertirDecimales(valor_total));
										}
									}
								}
							}
						}
						if(stock==0){
							$('#id_estilo9').show();
							document.getElementById('cantidad_productos_venta').disabled=true;
							document.getElementById("stock_valida").innerText = "No hay stock suficiente para esta venta.";
							document.getElementById("stock_valida").style.display = "block";
						}else{
							$('#id_estilo9').hide();
							document.getElementById("stock_valida").innerText = "";
						}
					}


					$('.EditarVentaProduco').click(function(){

						var id_producto_venta			=$("#id_venta_producto_editar").val();
						var id_producto_leido			=$("#id_producto_leido").val();
						var cantidad_producto_stock		=$('#cantidad_producto_stock').val();
						var cantidad_producto_vendido2	=$('#cantidad_producto_vendido2').val();
						
						var valor_venta 				=$('#valor_venta').text();
						var cantidad_productos_venta 	=$('#cantidad_productos_venta').val();
						var valor_total 				=$('#valor_total2').val();
						var producto_id_editar			=$("#id_producto_editar").val();

						var stock_producto				=$("#stock_producto").text(); 



						var _token=$('#_token').val();
						$.ajax({
							url   : "<?= URL::to('Editar_Venta_Producto') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       	  				: _token,
								'id_producto_venta'       	  	: id_producto_venta,
								'id_producto_leido'       	  	: id_producto_leido,
								'cantidad_producto_stock'       : cantidad_producto_stock,
								'cantidad_producto_vendido2'    : cantidad_producto_vendido2,
								'valor_venta'       	  		: valor_venta,
								'cantidad_productos_venta'      : cantidad_productos_venta,
								'valor_total'       	 	 	: valor_total,
								'producto_id_editar'       	  	: producto_id_editar,
								'stock_producto'       	  		: stock_producto


							},
							success:function(re){

								if(re==0){
									$('#CuerpoMensaje').html('');  
									$("#Modal_Confirmacion_Editar").modal('hide');
									$('#ModalConfirmacion').modal('show');
									$('#TitleModal').html('<p>Venta Editada.</p>');
									$('#CuerpoMensaje').append('<p>La venta fue editada exitosamente.</p>'); 
								}

							}
						});
					});

					$('.Cerrar_Mensaje').click(function() { 
						var variable=$('#CuerpoMensaje').text();

						if(variable=="La venta fue editada exitosamente."){
							Listar_Venta_Productos();
							refresPagina();
						}else if(variable=="La venta se elimino exitosamente."){
							Listar_Venta_Productos();
							refresPagina();
						}

					});
				</script>			

