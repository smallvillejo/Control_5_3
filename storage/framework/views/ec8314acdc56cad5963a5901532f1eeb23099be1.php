<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="formulario_VentaAlimentos">
	<div class="panel panel-default" style="width:90%" onmousemove="CalcularValorTotal_Alimentos()">
		<div class="panel-heading"><i class="fa fa-cutlery fa-2x">Venta de Alimentos</i></div>
		<div class="panel-body">
			<div class="panel panel-success" style="margin: 20 auto;width:100% ">
				<div class="panel-heading">Datos de la Venta</div>
				<div class="panel-body">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">	
						<input type="hidden" name="comercio_id" id="comercio_id" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
						<input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>" class="form-control">	
						<input type="hidden" name="Fecha_Actual_Venta_Alimento" id="Fecha_Actual_Venta_Alimento" value="<?php echo e($today = Carbon::today()->toDateString()); ?>" class="form-control">
						<input type="hidden" name="Hora_Venta" id="Hora_Venta" value="<?php echo e(Carbon::now()); ?>" class="form-control">
						<div class="form-group">
							<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Seleccione un Alimento:</font></strong></b></label>
							<div class="input-icon right">
								<select class="form-control selectpicker AlimentosCombobox" data-live-search="true" id="id_alimento" onchange="seleccion_alimentos()" >
									<option></option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-5">
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Stock:</font></strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<b><strong><font size ="5", color="#fd0000" face="Arial Black">
									<label name="stock_alimento" id="stock_alimento"></label></font></strong></b>
								</div>
							</div>
							<div class="panel panel-danger" style="display:none" id="id_estilo_stock_alimentos">
								<div class="panel-heading" id="stock_valida_venta_alimentos" style="display:none">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-sm-5">
									<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Venta:</font></strong></b></label>
								</div>
								<div class="form-group col-sm-5">
									<b><strong><font size ="4", color="#fd0000" face="Arial Black">
										<label id="SignoPesos"></label>
										<label type="text"  name="valor_venta_alimento" id="valor_venta_alimento" value="0"></label></font></strong></b>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-4">
										<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad:</font></strong></b></label>
									</div>
									<div class="form-group col-sm-10">
										<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><input class="form-control" id="Cantidad_Alimentos_Venta" name="Cantidad_Alimentos_Venta" type="number" onchange="CalcularValorTotal_Alimentos()" ></font></strong></b>
										<div class="panel panel-danger" style="display:none" id="id_estilo_alimentos">
											<div class="panel-heading" id="valida_cantidad_venta_alimentos" style="display:none">
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
									<img alt="User Pic" src="global/images/ImagenVacio.png" class="img-thumbnail img-responsive" title="Venta de Productos" id="imagen_destino_alimentos" name="imagen_destino_alimentos" width="150" height="5" border="5">
									<br>
								</div>
								<!-- Termina Imagen Producto -->
								<!-- Valor Total -->
								<div class="form-group col-sm-5">
									<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Total:</font></strong></b></label>
									<b><strong><font size ="5", color="#fd0000" face="Arial Black">
										<label type="text"  name="valor_total_venta_alimentos" id="valor_total_venta_alimentos" value="0"></label></font></strong></b>
										<input type="hidden" name="valor_total_venta_alimentos2" id="valor_total_venta_alimentos2" class="form-control">
									</div>
								</div>
								<!--Termina Valor Total -->
								<div class="form-actions">
									<div class="row">
										<button type="button" class="btn btn-circle blue RegistrarVenta_Alimentos" disabled="" id="btn_registrar_venta_alimentos">
											<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-floppy-o"></span></font></strong>
											<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Registrar</span></font></strong></button>
											<button type="button" class="btn btn-circle red" id="Cancelar_Venta_Alimento">
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

						cargar_nombres_alimentos();

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

									var options = $('.AlimentosCombobox option');
									var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
									arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
									options.each(function(i, o) {
										o.value = arr[i].v;
										$(o).text(arr[i].t);
									});
								}
							});
						}

						function seleccion_alimentos(){	
							var $NoDisponible= 'global/images/AlimentoNoDisponible.png';
							var id_alimento  = document.getElementById('id_alimento').value;
							var _token=$('#_token').val();
							$.ajax({
								url   : "<?= URL::to('Cargar_detalles_Alimentos_Venta') ?>",
								type  : "POST",
								async : false,
								data  :{
									'_token'       	  : _token,
									'id_alimento'     : id_alimento
								},
								success:function(re){									
									$('#stock_alimento').text(re.stock);
									$('#valor_venta_alimento').text(re.valor_venta_alimento);
									console.log(re.ruta_imagen_alimento);
									if(re.ruta_imagen_alimento=="No Disponible"){
										$("#imagen_destino_alimentos").attr("src",$NoDisponible);
									}else{
										$("#imagen_destino_alimentos").attr("src",re.ruta_imagen_alimento);
									}									

								}
							});
						}
						function ConvertirDecimales(n, dp) {
							var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
							while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
							return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
						}

						$('.RegistrarVenta_Alimentos').click(function(){

							var user_id 			=	$('#user_id').val();
							var NumeroComercio 		=	$('#comercio_id').val();
							var stock_alimento =parseInt($('#stock_alimento').text());
							var Cantidad_Alimentos_Venta =$('#Cantidad_Alimentos_Venta').val();
							var valor_venta_alimento =$('#valor_venta_alimento').text();
							var id_alimento = document.getElementById("id_alimento").value;
							var valor_total_venta_alimentos2 = $('#valor_total_venta_alimentos2').val();
							var  Hora_Venta_Alimentos=$('#Hora_Venta').val();
							var _token				=	$('#_token').val();
							var Fecha_Actual_Venta_Alimento =	$('#Fecha_Actual_Venta_Alimento').val();


							$.ajax({
								url   : "<?= URL::to('RegistrarVentaAlimentos') ?>",
								type  : "POST",
								async : false,
								data  :{
									'_token'       	  			 	: _token,
									'user_id'               	 	: user_id,
									'NumeroComercio'                : NumeroComercio,
									'stock_alimento'            	: stock_alimento,
									'Cantidad_Alimentos_Venta'    	: Cantidad_Alimentos_Venta,
									'valor_venta_alimento'      	: valor_venta_alimento,
									'id_alimento'    	 			: id_alimento,
									'valor_total_venta_alimentos2'  : valor_total_venta_alimentos2,
									'Hora_Venta_Alimentos'      	: Hora_Venta_Alimentos,
									'Fecha_Actual_Venta_Alimento'   : Fecha_Actual_Venta_Alimento
								},
								success:function(re){
									if(re == 0){
										Listar_Ultimas_Ventas_Alimentos();
										LimpiarData_Venta_Alimentos();
										Sin_Inactividad_Venta();
										Notificaciones_PocoStock();

									}
								},
								error:function(re){
								}
							});
						});


						$('body').delegate('.EliminarVentaAlimento','click',function(){
							var id_venta_alimento = $('#id_venta').val();
							var Hora_Venta = $('#Hora_Venta').val();
							var cantidad_alimento_vendido = $('#cantidad_alimento_vendido').val();
							var id_alimento_venta = $('#id_alimento_venta').val();
							$.ajax({
								type:'get',
								url:'<?php echo e(url('Eliminar_Venta_Alimento')); ?>',
								data:{
									'id_venta_alimento' 		: id_venta_alimento,
									'Hora_Venta' 				: Hora_Venta,
									'id_alimento_venta' 		: id_alimento_venta,
									'cantidad_alimento_vendido' : cantidad_alimento_vendido

								},
								success: function(data){
									$('#Tabla_Venta_Alimentos').empty().html(data);
									LimpiarData_Venta_Alimentos();
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


						function CalcularValorTotal_Alimentos(){
							var stock_alimento =parseInt($('#stock_alimento').text());
							var Cantidad_Alimentos_Venta =parseInt($('#Cantidad_Alimentos_Venta').val());
							var valor_unitario =parseInt($('#valor_venta_alimento').text());
							var id_alimento = document.getElementById("id_alimento").value;	

							if(id_alimento==0){
								document.getElementById('Cantidad_Alimentos_Venta').disabled=true;
								$('#Cantidad_Alimentos_Venta').val('');
								$('#stock_alimento').text('');
								$('#valor_venta').text('');
								$('#valor_total_venta_alimentos').text('');
							}else{
								document.getElementById('Cantidad_Alimentos_Venta').disabled=false;
							}
							if(stock_alimento!=="" || Cantidad_Alimentos_Venta!==""){
								if(Cantidad_Alimentos_Venta<=0){
									$('#id_estilo_alimentos').show();
									document.getElementById('btn_registrar_venta_alimentos').disabled=true;
									document.getElementById("valida_cantidad_venta_alimentos").innerText = "La cantidad Ingresada es menor al Stock.";
									document.getElementById("valida_cantidad_venta_alimentos").style.display = "block";
								}else{
									if(Cantidad_Alimentos_Venta>stock_alimento){
										$('#id_estilo_alimentos').show();
										document.getElementById('btn_registrar_venta_alimentos').disabled=true;
										document.getElementById("valida_cantidad_venta_alimentos").innerText = "La cantidad Ingresada es mayor al Stock.";
										document.getElementById("valida_cantidad_venta_alimentos").style.display = "block";
										var valor_total_venta_alimentos=(Cantidad_Alimentos_Venta)*(valor_unitario);
										$('#valor_total_venta_alimentos').text('$'+ConvertirDecimales(valor_total_venta_alimentos));
									}else{
										$('#id_estilo_alimentos').hide();
										document.getElementById('btn_registrar_venta_alimentos').disabled=false;
										document.getElementById("valida_cantidad_venta_alimentos").innerText = "";
										if($('#Cantidad_Alimentos_Venta').val()=="" || $('#Cantidad_Alimentos_Venta').val()=="0"){
											$('#SignoPesos').text('$');
											$('#SignoPesos2').text('$');
											document.getElementById('btn_registrar_venta_alimentos').disabled=true;
										}else{
											var valor_total_venta_alimentos=(Cantidad_Alimentos_Venta)*(valor_unitario);
											$('#valor_total_venta_alimentos2').val(valor_total_venta_alimentos);
											$('#valor_total_venta_alimentos').text('$'+ConvertirDecimales(valor_total_venta_alimentos));
										}
									}
								}
							}
							if(stock_alimento==0){

								$('#id_estilo_stock_alimentos').show();
								document.getElementById('Cantidad_Alimentos_Venta').disabled=true;
								document.getElementById("stock_valida_venta_alimentos").innerText = "No hay stock suficiente para esta venta.";
								document.getElementById("stock_valida_venta_alimentos").style.display = "block";
							}else{
								$('#id_estilo_stock_alimentos').hide();
								document.getElementById("stock_valida_venta_alimentos").innerText = "";
							}
						}						


						function Sin_Inactividad_Venta(){
							window.clearTimeout(Tiempo_Inactividad2);
							Tiempo_Inactividad=setTimeout('document.location.href = "<?php echo e(route('RegistrarVenta')); ?>"',120000);
						}
						function Sin_Inactividad_Venta2(){

							window.clearTimeout(Tiempo_Inactividad);
							Tiempo_Inactividad2=setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',80000);
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



						function  Listar_Ultimas_Ventas_Alimentos(){
							var Hora_Venta = $('#Hora_Venta').val();
							$.ajax({
								type:'get',
								url:'<?php echo e(url('Ultimos_alimentos_vendidos')); ?>',
								data:{
									'Hora_Venta' : Hora_Venta
								},
								success: function(data){
									$('.panelsito_ventas_alimentos').show();
									$('#Tabla_Venta_Alimentos').empty().html(data);
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
										$('#Tabla_Venta_Alimentos').empty().html(data);
									}
								});
							});

						}

						$('#boton_registrar_venta_alimento').click(function(){
							$('#Cargar_Formulario_Venta_Alimentos').show(1000);
							$('#boton_registrar_venta_alimento').hide(1000);
							$('#boton_registrar_venta_producto').hide();
						});
						$('#Cancelar_Venta_Alimento').click(function(){
							$('#Cargar_Formulario_Venta_Alimentos').hide(1000);
							$('.panelsito_ventas_alimentos').hide(1000);
							$('#boton_registrar_venta_alimento').show(1000);
							$('#boton_registrar_venta_producto').show();

						});
						$('#Cerrar_X_VentaAlimento').click(function(e){
							e.preventDefault();
							$('#Cargar_Formulario_Venta_Alimentos').hide(1000);
							$('#boton_registrar_venta_alimento').show(1000);
							$('#boton_registrar_venta_producto').show();
						});
					</script>	






					<script src="global/plugins/select/js/bootstrap-select.min.js" type="text/javascript"></script>
					<script type="text/javascript">
						$('#id_alimento').selectpicker({
							size: 8
						});