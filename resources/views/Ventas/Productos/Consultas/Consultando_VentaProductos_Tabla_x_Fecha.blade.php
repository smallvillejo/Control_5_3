@if($VentaProducto->total()==0)
<script type="text/javascript">
	// $('.panelsito_ventas_productos').hide();
</script>
<div class="col-md-10">
	<img src="global/images/Error_No_Found_Producto.png" alt="logo" class="img-thumbnail img-responsive" >	
</div>
@else
<img src="global/images/ImagenVacio.png" alt="logo" height="1" width="1" >
<div class="row">
	<!-- BEGIN SAMPLE TABLE PORTLET-->
	<div class="portlet box blue table-responsive">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs"></i>Listado Ventas Producto
			</div>
			<div class="tools">
				<a href="javascript:;" class="collapse">
				</a>
				<a href="#portlet-config" data-toggle="modal" class="config">
				</a>
				<a href="javascript:;" class="reload" onclick="epa()" title="Recargar">
				</a>
				<a href="javascript:;" class="remove">
				</a>
			</div>
		</div>
		<div class="portlet-body flip-scroll table-responsive">
			<table class="table table-bordered table-striped table-condensed flip-content">
				<thead class="flip-content">
					<tr>
						<th width="40%">Nombre Producto</th>
						<th width="5%">Cantidad</th>
						<th width="10%">Precio Producto</th>
						<th class="column-title">Valor Total</th>
						<th class="column-title">Hora Venta</th>
						<th class="column-title">Opciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($VentaProducto as $value)
					<input type="hidden" value="{{$ValorVenta=$value->total_producto_venta}}">
					<input type="hidden" value="{{$ValorVenta=number_format($ValorVenta)}}">
					<tr class="even pointer">
						<td class=" "><b><strong> <font size ="3", color="#000000" face="Arial Black">{{$value->Producto->nombre_producto}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$value->cantidad_producto_venta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{$value->precio_producto_venta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">${{$ValorVenta}}</font></strong></b></td>
						<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black">{{Carbon::parse($value->hora_venta_producto)->diffForHumans()}}
						</font></strong></b></td>
						<td class=" ">
							<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" id="{{$value->id}}" class="Eliminar_Venta" data-backdrop="static" data-keyboard="false" title="Eliminar" Producto_Venta="{{$value->Producto->nombre_producto}}" id_venta="{{$value->id}}" canti_vendido="{{$value->cantidad_producto_venta}}" id_producto_venta="{{$value->producto_id}}">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-trash-o"></span></font></strong>
							</a>
							|
							<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Editar" id="{{$value->id}}" class="Editar_Venta" data-backdrop="static" data-keyboard="false" title="Editar" Producto_Venta="{{$value->Producto->nombre_producto}}" id_venta="{{$value->id}}" canti_vendido="{{$value->cantidad_producto_venta}}" id_producto_venta="{{$value->producto_id}}">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-pencil-square"></span></font></strong>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<center>{{$VentaProducto->links()}}</center>
			<br>
		</div>
	</div>
</div>
@endif
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
	<div id="Modal_Confirmacion_Editar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><b><strong> <font size ="3", color="#fb0c48" face="Arial Black">Editar Venta</font></strong></b></h3>
				</div>
				<div class="modal-body">


					<div class="col-md-7">
						<input type="hidden" name="comercio_id" id="comercio_id" value="{{Auth::user()->id_comercio}}" class="form-control">
						<input type="hidden" name="Fecha_Actual" id="Fecha_Actual" value="{{$today = Carbon::today()->toDateString()}}" class="form-control">
						<input type="hidden" name="Hora_Venta" id="Hora_Venta" value="{{$today = Carbon::today()->now()}}" class="form-control">
						<div class="form-group">
							<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Seleccione un Producto</font></strong></b></label>
							<div class="input-icon right">
								<select class="form-control selectpicker" data-live-search="true" id="id_producto" onchange="seleccion()" >
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
								<button type="button" class="btn btn-circle blue RegistrarVenta" disabled="" id="boton_registrar">
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
					<script type="text/javascript">
						// cargar_nombres_productos();

						$('.Editar_Venta').click(function(){
							var id_venta =($(this).attr ('id_venta'));
							var _token=$('#_token').val();
							// console.log(id_venta);

							$.ajax({
								url   : "<?= URL::to('Cargar_datos_Modal_editar_venta') ?>",
								type  : "POST",
								async : false,
								data  :{
									'_token'       	  		: _token,
									'id_venta'     : id_venta
								},
								success:function(re){
									$('#stock_producto').text(re.stock);
									$('#valor_venta').text(re.valor_venta_producto);
									if(re.ruta_imagen_producto="No Disponible"){
										$("#img_destino").attr("src",$NoDisponible);
									}else{
										$("#img_destino").attr("src",re.RutaImagen);
									}
									$('')
								}
							});



						});


						function cargar_nombres_productos(){
							$el =$('#id_producto');
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
						function cargar_nombres_alimentos(){
							$el =$('#id_alimento');
							var _token=$('#_token').val();
							$.ajax({
								url   : "<?= URL::to('cargar_nombres_alimentos') ?>",
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
						// function seleccion(){
						// 	var t = document.getElementById("id_producto");
						// 	var $NoDisponible= 'global/images/ProductoNoDisponible.png';
						// 	var id_producto  = document.getElementById('id_producto').value;
						// 	var _token=$('#_token').val();
						// 	$.ajax({
						// 		url   : "<?= URL::to('Cargar_detalles_Productos_Venta') ?>",
						// 		type  : "POST",
						// 		async : false,
						// 		data  :{
						// 			'_token'       	  : _token,
						// 			'id_producto'     : id_producto
						// 		},
						// 		success:function(re){
						// 			$('#stock_producto').text(re.stock);
						// 			$('#valor_venta').text(re.valor_venta_producto);
						// 			if(re.ruta_imagen_producto="No Disponible"){
						// 				$("#img_destino").attr("src",$NoDisponible);
						// 			}else{
						// 				$("#img_destino").attr("src",re.RutaImagen);
						// 			}
						// 			$('')
						// 		}
						// 	});
						// }
						function ConvertirDecimales(n, dp) {
							var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
							while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
							return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
						}
						function CalcularValorTotal(){
							var stock =parseInt($('#stock_producto').text());
							var Cantidad_Productos_Venta =parseInt($('#cantidad_productos_venta').val());
							var valor_unitario =parseInt($('#valor_venta').text());
							var id_producto = document.getElementById("id_producto").value;
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
									document.getElementById('boton_registrar').disabled=true;
									document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es menor al Stock.";
									document.getElementById("valida_cantidad").style.display = "block";
								}else{
									if(Cantidad_Productos_Venta>stock){
										$('#id_estilo').show();
										document.getElementById('boton_registrar').disabled=true;
										document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es mayor al Stock.";
										document.getElementById("valida_cantidad").style.display = "block";
										var valor_total=(Cantidad_Productos_Venta)*(valor_unitario);
										$('#valor_total').text('$'+ConvertirDecimales(valor_total));
									}else{
										$('#id_estilo').hide();
										document.getElementById('boton_registrar').disabled=false;
										document.getElementById("valida_cantidad").innerText = "";
										if($('#cantidad_productos_venta').val()=="" || $('#cantidad_productos_venta').val()=="0"){
											$('#SignoPesos').text('$');
											$('#SignoPesos2').text('$');
											document.getElementById('boton_registrar').disabled=true;
										}else{
											var valor_total=(Cantidad_Productos_Venta)*(valor_unitario);
											$('#valor_total2').val(valor_total);
											$('#valor_total').text('$'+ConvertirDecimales(valor_total));
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
					</script>
					<script src="global/plugins/select/js/bootstrap-select.min.js" type="text/javascript"></script>
					<script type="text/javascript">
						$('.selectpicker').selectpicker({
// style: 'btn-success',
size: 8
});
</script>