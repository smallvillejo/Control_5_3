<?php if($VentaAlimento->total()==0): ?>
<div class="col-md-10">
	<img src="global/images/Error_No_Foundd.png" alt="logo" class="img-thumbnail img-responsive" >
	<script type="text/javascript">
	// $('.panelsito_ventas_alimentos').hide();
	$('#id_div_venta_alimento').hide();
	$('#id_div_venta_alimento_cuadro').hide();
</script>
</div>
<?php else: ?>
<script type="text/javascript">
	// $('.panelsito_ventas_alimentos').hide();
	$('#id_div_venta_alimento').show();
	$('#id_div_venta_alimento_cuadro').show();
</script>
<img src="global/images/ImagenVacio.png" alt="logo" height="1" width="1" >
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-usd" aria-hidden="true"></i>Últimas Ventas -- Alimentos
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse">
					</a>
					<a href="#portlet-config" data-toggle="modal" class="config">
					</a>
					<a href="javascript:;" class="reload">
					</a>
					<a href="javascript:;" class="remove">
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th class="column-title">Nombre Alimento</th>
								<th class="column-title">Cantidad</th>
								<th class="column-title">Valor/Uni</th>
								<th class="column-title">Valor/Total</th>
								<th class="column-title">Hora Venta</th>
								<th class="column-title">Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($VentaAlimento as $value): ?>
							<input type="hidden" value="<?php echo e($ValorVenta=$value->total_alimento_venta); ?>">
							<input type="hidden" value="<?php echo e($ValorVenta=number_format($ValorVenta)); ?>">
							<tr class="even pointer">
								<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->Alimento->nombre_alimento); ?></font></strong></b></td>
								<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->cantidad_alimento_venta); ?></font></strong></b></td>
								<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e($value->precio_alimento_venta); ?></font></strong></b></td>
								<td class=" "><b><strong> <font size ="2", color="#fb0c48" face="Arial Black">$<?php echo e($ValorVenta); ?></font></strong></b></td>
								<td class=" "><b><strong> <font size ="2", color="#000000" face="Arial Black"><?php echo e(Carbon::parse($value->hora_venta_alimento)->diffForHumans()); ?> <!-- (A las: <?php echo e(Carbon::parse($value->hora_venta_alimento)->toTimeString()); ?>) -->
								</font></strong></b></td>
								<td class=" ">
									<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Delete" id="<?php echo e($value->id); ?>" class="Eliminar_Venta" data-backdrop="static" data-keyboard="false" title="Eliminar" Alimento_Venta="<?php echo e($value->Alimento->nombre_alimento); ?>" id_venta="<?php echo e($value->id); ?>" canti_vendido="<?php echo e($value->cantidad_alimento_venta); ?>" id_alimento_venta="<?php echo e($value->alimento_id); ?>">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-trash-o"></span></font></strong>
									</a>						|
									<a href="#" data-toggle = 'modal' data-target="#Modal_Confirmacion_Editar" id="<?php echo e($value->id); ?>" class="Editar_Venta" data-backdrop="static" data-keyboard="false" title="Editar" Alimento_Venta="<?php echo e($value->Alimento->nombre_alimento); ?>" id_venta="<?php echo e($value->id); ?>" canti_vendido="<?php echo e($value->cantidad_alimento_venta); ?>" id_alimento_venta="<?php echo e($value->alimento_id); ?>">  <strong> <font size ="3", color ="#0d96ea" face="Lucida Sans"><span class= "fa fa-pencil-square"></span></font></strong>
									</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<center><?php echo e($VentaAlimento->links()); ?></center>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
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
				<b><strong> <font size ="3", color="#0b6ef6" face="Arial Black">Se va a eliminar la venta del alimento:</font></strong></b>
				<b><strong> <font size ="3", color="#000000" face="Arial Black"><label name="Alimento_Venta" id="numero_venta_alimento""></label></font></strong></b>
				<input type="hidden" name="id_venta" id="id_venta">
				<input type="hidden" name="cantidad_alimento_vendido" id="cantidad_alimento_vendido">
				<input type="hidden" name="id_alimento_venta" id="id_alimento_venta">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success EliminarVentaAlimento" >Si</button>
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
					<input type="hidden" name="id_venta_alimento_editar" id="id_venta_alimento_editar" class="form-control">
					<input type="hidden" name="id_alimento_leido" id="id_alimento_leido" class="form-control">
					<input type="hidden" name="cantidad_alimento_vendido2" id="cantidad_alimento_vendido2" class="form-control">
					<input type="hidden" name="cantidad_alimento_stock" id="cantidad_alimento_stock" class="form-control">					
				</div>
				<div class="modal-body">
					<div class="col-md-7">
						<input type="hidden" name="comercio_id" id="comercio_id" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
						<input type="hidden" name="Fecha_Actual" id="Fecha_Actual" value="<?php echo e($today = Carbon::today()->toDateString()); ?>" class="form-control">
						<input type="hidden" name="Hora_Venta" id="Hora_Venta" value="<?php echo e($today = Carbon::today()->now()); ?>" class="form-control">
						<div class="form-group">
							<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Seleccione un Alimento</font></strong></b></label>
							<div class="input-icon right">
								<select class="form-control selectpicker" data-live-search="true" id="id_alimento_editar" onchange="seleccion()" >
									<option></option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-sm-5">
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Stock:</font></strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<b><strong><font size ="5", color="#fd0000" face="Arial Black"><label name="stock_alimento" id="stock_alimento"></label></font></strong></b>
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
									<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><input class="form-control" id="cantidad_alimentos_venta" name="cantidad_alimentos_venta" type="number" onchange="CalcularValorTotal()" ></font></strong></b>
									<div class="panel panel-danger" style="display:none" id="id_estilo">
										<div class="panel-heading" id="valida_cantidad" style="display:none">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Imagen Alimento -->
						<div class="row">
							<div class="form-group col-sm-5">
								<!-- <div class="col-lg-5 col-md-offset-1"> -->
								<label><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Vista Previa Alimento:</font>
								</strong></b></label>
							</div>
							<div class="form-group col-sm-5">
								<img alt="User Pic" src="global/images/ImagenVacio.png" class="img-thumbnail img-responsive" title="Venta de Alimentos" id="img_destino" name="img_destino" width="150" height="5" border="5">
								<br>
							</div>
							<!-- Termina Imagen Alimento -->
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
									<button type="button" class="btn btn-circle red" id="Cancelar_Venta_Alimento" data-dismiss="modal">
										<strong> <font size ="2", color ="#f9f9f9"> <span class= "fa fa-times-circle"></span></font></strong>
										<strong> <font size ="2", color ="#f9f9f9" face="Lucida Sans"><span>Cancelar</span></font></strong></button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					cargar_nombres_alimentos();
					$('.Editar_Venta').click(function(){
						var id_venta =($(this).attr ('id_venta'));
						var _token=$('#_token').val();
						var $NoDisponible= 'global/images/AlimentoNoDisponible.png';
						$.ajax({
							url   : "<?= URL::to('Cargar_datos_Modal_editar_venta_alimentos') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       : _token,
								'id_venta'     : id_venta
							},
							success:function(re){

								$("#id_alimento_editar option:selected").text(re.name).val(re.alimento_id);
								$("#id_alimento_editar").selectpicker("refresh");
								$('#stock_alimento').text(re.stock);
								$('#valor_venta').text(re.precio_alimento_venta);
								$('#cantidad_alimentos_venta').val(re.cantidad_alimento_venta);
								$('#valor_total').text(re.total_alimento_venta);
								$('#valor_total2').val(re.total_alimento_venta);

								$('#id_venta_alimento_editar').val(id_venta);
								$('#id_alimento_leido').val(re.alimento_id);
								$('#cantidad_alimento_vendido2').val(re.cantidad_alimento_venta);
								$('#cantidad_alimento_stock').val(re.stock);

								

								if(re.ruta_imagen_alimento="No Disponible"){
									$("#img_destino").attr("src",$NoDisponible);
								}else{
									$("#img_destino").attr("src",re.RutaImagen);
								}
								document.getElementById("cantidad_alimentos_venta").focus();								
							}
						});
					});
					function cargar_nombres_alimentos(){
						$el =$('#id_alimento_editar');
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

					function seleccion(){						
						var t = document.getElementById("id_alimento_editar");
						var $NoDisponible= 'global/images/AlimentoNoDisponible.png';
						var id_alimento  = document.getElementById('id_alimento_editar').value;
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
								$('#valor_venta').text(re.valor_venta_alimento);
								$('#cantidad_alimentos_venta').val('');
								$('#valor_total').text('');
								$('#valor_total2').val('');				
								CalcularValorTotal();
								document.getElementById("cantidad_alimentos_venta").focus();
								if(re.ruta_imagen_alimento="No Disponible"){
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
						var stock =parseInt($('#stock_alimento').text());
						var cantidad_alimentos_venta =parseInt($('#cantidad_alimentos_venta').val());
						var valor_unitario =parseInt($('#valor_venta').text());
						var id_alimento = document.getElementById("id_alimento_editar").value;

						var cantidad_alimento_stock=parseInt($('#cantidad_alimento_stock').val());

						var cantidad_alimento_vendido2=parseInt($('#cantidad_alimento_vendido2').val());

						if(id_alimento==0){
							document.getElementById('cantidad_alimentos_venta').disabled=true;
							$('#cantidad_alimentos_venta').val('');
							$('#stock_alimento').text('');
							$('#valor_venta').text('');
							$('#valor_total').text('');
						}else{
							document.getElementById('cantidad_alimentos_venta').disabled=false;
						}
						if(stock!=="" || cantidad_alimentos_venta!==""){
							if(cantidad_alimentos_venta<=0){
								$('#id_estilo').show();
								document.getElementById('boton_editar_venta').disabled=true;
								document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es menor al Stock.";
								document.getElementById("valida_cantidad").style.display = "block";
							}else{
								if(cantidad_alimento_stock+cantidad_alimento_vendido2>=cantidad_alimentos_venta){
									var valor_total=(cantidad_alimentos_venta)*(valor_unitario);
									$('#valor_total2').val(valor_total);
									$('#valor_total').text('$'+ConvertirDecimales(valor_total));
									$('#id_estilo').hide();
									document.getElementById('boton_editar_venta').disabled=false;
									document.getElementById("valida_cantidad").innerText = "";
								}else{									
									if(cantidad_alimentos_venta>stock){
										$('#id_estilo').show();
										document.getElementById('boton_editar_venta').disabled=true;
										document.getElementById("valida_cantidad").innerText = "La cantidad Ingresada es mayor al Stock.";
										document.getElementById("valida_cantidad").style.display = "block";
										var valor_total=(cantidad_alimentos_venta)*(valor_unitario);
										$('#valor_total').text('$'+ConvertirDecimales(valor_total));
									}else{
										$('#id_estilo').hide();
										document.getElementById('boton_editar_venta').disabled=false;
										document.getElementById("valida_cantidad").innerText = "";
										if($('#cantidad_alimentos_venta').val()=="" || $('#cantidad_alimentos_venta').val()=="0"){
											$('#SignoPesos').text('$');
											$('#SignoPesos2').text('$');
											document.getElementById('boton_editar_venta').disabled=true;
										}else{
											var valor_total=(cantidad_alimentos_venta)*(valor_unitario);
											$('#valor_total2').val(valor_total);
											$('#valor_total').text('$'+ConvertirDecimales(valor_total));
										}
									}
								}
							}
						}
						if(stock==0){
							$('#id_estilo9').show();
							document.getElementById('cantidad_alimentos_venta').disabled=true;
							document.getElementById("stock_valida").innerText = "No hay stock suficiente para esta venta.";
							document.getElementById("stock_valida").style.display = "block";
						}else{
							$('#id_estilo9').hide();
							document.getElementById("stock_valida").innerText = "";
						}
					}


					$('.EditarVentaProduco').click(function(){

						var id_alimento_venta			=$("#id_venta_alimento_editar").val();
						var id_alimento_leido			=$("#id_alimento_leido").val();
						var cantidad_alimento_stock		=$('#cantidad_alimento_stock').val();
						var cantidad_alimento_vendido2	=$('#cantidad_alimento_vendido2').val();
						
						var valor_venta 				=$('#valor_venta').text();
						var cantidad_alimentos_venta 	=$('#cantidad_alimentos_venta').val();
						var valor_total 				=$('#valor_total2').val();
						var alimento_id_editar			=$("#id_alimento_editar").val();

						var stock_alimento				=$("#stock_alimento").text(); 



						var _token=$('#_token').val();
						$.ajax({
							url   : "<?= URL::to('Editar_Venta_Alimento') ?>",
							type  : "POST",
							async : false,
							data  :{
								'_token'       	  				: _token,
								'id_alimento_venta'       	  	: id_alimento_venta,
								'id_alimento_leido'       	  	: id_alimento_leido,
								'cantidad_alimento_stock'       : cantidad_alimento_stock,
								'cantidad_alimento_vendido2'    : cantidad_alimento_vendido2,
								'valor_venta'       	  		: valor_venta,
								'cantidad_alimentos_venta'      : cantidad_alimentos_venta,
								'valor_total'       	 	 	: valor_total,
								'alimento_id_editar'       	  	: alimento_id_editar,
								'stock_alimento'       	  		: stock_alimento


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
							Listar_Venta_Alimentos();
						}

					});
				</script>			

