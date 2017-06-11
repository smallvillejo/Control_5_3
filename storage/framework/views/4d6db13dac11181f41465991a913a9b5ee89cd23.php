	
	<?php $__env->startSection('title'); ?>
	Consultas Ventas Productos
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('content'); ?>	
	<div class="panel">
		<div class="panel-heading" style="background: #13378e">
			<h3 class="panel-title">
				<font color="#FFFFFF" face="Tahoma">
					<strong>Buscar Venta Producto</strong>
				</font>						
			</h3>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="form-group col-sm-4">
					<label>Selecciona el Producto:</label>
					<select class="selectpicker" data-live-search="true" id="producto_id_venta_consulta" onchange="Seleccion_Busqueda()">
						<option></option>
					</select>
				</div>
				<div class="col-sm-2">
					<label>Ingresa Fecha Inicial:</label>					
				</div>				
				<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Venta_Recarga" id="Fecha_Ingreso_Venta_Recarga"   placeholder="Fecha Registro" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
					<span class="input-group-btn">
						<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>

				<div class="form-group col-sm-2">
					<label>Ingresa Fecha Final:</label>					
				</div>				
				<div class="input-group date date-picker margin-bottom-1" data-date-format="yyyy-mm-dd">
					<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Venta_Recarga" id="Fecha_Ingreso_Venta_Recarga"   placeholder="Fecha Registro" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
					<span class="input-group-btn">
						<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>
				


				<div class="col-sm-2">
					<button class="btn btn-success" type="button">Buscar</button>				
				</div>	

			</div>
			
		</div>
	</div>


	<script type="text/javascript">
		cargar_nombres_productos();
		function cargar_nombres_productos(){
			$el =$('#producto_id_venta_consulta');
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
	</script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>