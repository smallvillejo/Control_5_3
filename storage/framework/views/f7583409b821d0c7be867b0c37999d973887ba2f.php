<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="formulario_VentaProductos">
	<div class="panel panel-default" style="width:90%" onmousemove="CalcularValorTotal()">
		<div class="panel-heading"><i class="fa fa-cube fa-2x">Venta de Productos</i></div>
		<div class="panel-body">
			<div class="panel panel-info" style="margin: 20 auto;width:100% ">
				<div class="panel-heading">Datos de la Venta</div>
				<div class="panel-body">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">	
						<input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>" class="form-control">		
						<input type="hidden" name="comercio_id" id="comercio_id" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
						<input type="hidden" name="Fecha_Actual" id="Fecha_Actual" value="<?php echo e($today = Carbon::today()->toDateString()); ?>" class="form-control">
						<input type="hidden" name="Hora_Venta" id="Hora_Venta" value="<?php echo e(Carbon::now()); ?>" class="form-control">
						<div class="form-group">
							<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Seleccione un Producto</font></strong></b></label>
							<div class="input-icon right">
								<select class="form-control selectpicker ProductosCombobox" data-live-search="true" id="id_producto" onchange="seleccion_productos()" >
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
						<!--Termina Valor Total -->
						<div class="form-actions">
							<div class="row">
								<button type="button" class="btn btn-circle blue RegistrarVenta_Productos" disabled="" id="boton_registrar">
									<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-floppy-o"></span></font></strong>
									<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Registrar</span></font></strong></button>
									<button type="button" class="btn btn-circle red" id="Cancelar_Venta_Producto">
										<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-times-circle"></span></font></strong>
										<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Cancelar</span></font></strong></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script type="text/javascript">

				cargar_nombres_productos();

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

							var options = $('.ProductosCombobox option');
							var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
							arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
							options.each(function(i, o) {
								o.value = arr[i].v;
								$(o).text(arr[i].t);
							});
						}
					});
				}
				function seleccion_productos(){
					var t = document.getElementById("id_producto");

					var $NoDisponible= 'global/images/ProductoNoDisponible.png';
					var id_producto  = document.getElementById('id_producto').value;     
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

							if(re.ruta_imagen_producto=="No Disponible"){
								$("#img_destino").attr("src",$NoDisponible);
							}else{
								$("#img_destino").attr("src",re.ruta_imagen_producto);
							}							
						}
					});
				}

				$('body').delegate('.EliminarVentaProducto','click',function(){
					var id_venta_producto = $('#id_venta').val();
					var Hora_Venta = $('#Hora_Venta').val();
					var cantidad_producto_vendido = $('#cantidad_producto_vendido').val();
					var id_producto_venta = $('#id_producto_venta').val();
					$.ajax({
						type:'get',
						url:'<?php echo e(url('Eliminar_Venta_Producto')); ?>',
						data:{
							'id_venta_producto' 		: id_venta_producto,
							'Hora_Venta' 				: Hora_Venta,
							'id_producto_venta' 		: id_producto_venta,
							'cantidad_producto_vendido' : cantidad_producto_vendido

						},
						success: function(data){
							$('#Tabla_Venta_Productos').empty().html(data);
							LimpiarData_Venta_Productos();
						}
					});

				});

				function LimpiarData_Venta_Productos(){

					$('#id_producto').val('').selectpicker('refresh');
					$('#id_producto').selectpicker('toggle');
					$('#cantidad_productos_venta').val('');
					$('#stock_producto').text('');
					$('#valor_venta').text('0');
					$('#valor_total').text('0');
					$('#valor_total2').text('0');
					document.getElementById('cantidad_productos_venta').disabled=true;
					$("#img_destino").attr("src","global/images/ImagenVacio.png");
				}

				function LimpiarData_Venta_Alimentos(){
					$('#id_alimento').val('').selectpicker('refresh');
					$('#id_alimento').selectpicker('toggle');
					$('#Cantidad_Alimentos_Venta').val('');
					$('#stock_alimento').text('');
					$('#valor_venta_alimento').text('0');
					$('#valor_total_venta_alimentos').text('0');
					$('#valor_total_venta_alimentos2').text('0');
					document.getElementById('Cantidad_Alimentos_Venta').disabled=true;
					$("#imagen_destino_alimentos").attr("src","global/images/ImagenVacio.png");	
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

				$('.RegistrarVenta_Productos').click(function(){
					var user_id 			=	$('#user_id').val();
					var NumeroComercio 		=	$('#comercio_id').val();
					var producto_id 		=	$('#id_producto').val();
					var cantidad_producto 	=	$('#cantidad_productos_venta').val();
					var valor_venta 		=	$('#valor_venta').text();
					var valor_total 		=	$('#valor_total2').val();
					var Fecha_Actual 		=	$('#Fecha_Actual').val();
					var Hora_Venta 			=	$('#Hora_Venta').val();
					var StockProducto 		=	$('#stock_producto').text();
					var _token				=	$('#_token').val();
					$.ajax({
						url   : "<?= URL::to('RegistarVentaProducto') ?>",
						type  : "POST",
						async : false,
						data  :{
							'_token'       	  			 : _token,
							'user_id'               	 : user_id,
							'id_comercio'                : NumeroComercio,
							'producto_id'            	 : producto_id,
							'cantidad_producto_venta'    : cantidad_producto,
							'precio_producto_venta'      : valor_venta,
							'total_producto_venta'    	 : valor_total,
							'fecha_producto_venta'       : Fecha_Actual,
							'hora_venta_producto'      	 : Hora_Venta,
							'stock_producto'    		 : StockProducto
						},
						success:function(re){
							if(re == 0){
								Listar_Ultimas_Ventas_Productos();
								LimpiarData_Venta_Productos();
								Sin_Inactividad_Venta();
								Notificaciones_PocoStock();
							}
						},
						error:function(re){
						}
					});
				});


				function Sin_Inactividad_Venta(){
					window.clearTimeout(Tiempo_Inactividad2);
					Tiempo_Inactividad=setTimeout('document.location.href = "<?php echo e(route('RegistrarVenta')); ?>"',120000);
				}
				function Sin_Inactividad_Venta2(){

					window.clearTimeout(Tiempo_Inactividad);
					Tiempo_Inactividad2=setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',80000);
				}

				function  Listar_Ultimas_Ventas_Productos(){
					var Hora_Venta 			=	$('#Hora_Venta').val();
					$.ajax({
						type:'get',
						url:'<?php echo e(url('Ultimos_productos_vendidos')); ?>',
						data:{
							'Hora_Venta' : Hora_Venta
						},
						success: function(data){
							$('.panelsito_ventas_productos').show();
							$('#Tabla_Venta_Productos').empty().html(data);
						}
					});

					$(document).on("click",".pagination li a",function(e) { 
						e.preventDefault();
						var Hora_Venta 			=	$('#Hora_Venta').val();
						var url = $(this).attr("href");
						$.ajax({
							type:'get',
							url:url,
							data:{
								'Hora_Venta' : Hora_Venta
							},
							success: function(data){
								$('#Tabla_Venta_Productos').empty().html(data);
							}
						});
					});
				}

				$('#boton_registrar_venta_producto').click(function(){
					$('#Cargar_Formulario_Venta_Productos').show(1000);
					$('#boton_registrar_venta_producto').hide(1000);
					$('#boton_registrar_venta_alimento').hide();
				});
				$('#Cancelar_Venta_Producto').click(function(){
					$('#Cargar_Formulario_Venta_Productos').hide(1000);
					$('.panelsito_ventas_productos').hide(1000);
					$('#boton_registrar_venta_producto').show(1000);
					$('#boton_registrar_venta_alimento').show();
				});
				$('#Cerrar_X_VentaProducto').click(function(){
					$('#Cargar_Formulario_Venta_Productos').hide(1000);
					$('#boton_registrar_venta_producto').show(1000);
					$('#boton_registrar_venta_alimento').show();
				});

			</script>	

			<script src="global/plugins/select/js/bootstrap-select.min.js" type="text/javascript"></script>
			<script type="text/javascript">
				$('#id_producto').selectpicker({
					size: 8
				});