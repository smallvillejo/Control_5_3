	
	<?php $__env->startSection('title'); ?>
	Administrar Planes
	<?php $__env->stopSection(); ?>
	<?php $__env->startSection('content'); ?>	
	<div class="page-bar col-xs-12 col-sm-12 col-md-12 col-lg-12">	
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-phone-square" aria-hidden="true"></i>
				<a href="#">Administrar Planes</a>
				<i class="fa fa-angle-right"></i>
			</li>				
		</ul>			
	</div>
	<!-- Modal Para Confirmacion al Eliminar -->
	<div class="panel-body" id="confirm-delete" data-backdrop="static" data-keyboard="false">      
		<div class="modal fade" id="confirm-delete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Eliminar el Registro?</h4>
					</div>				
					<div class="modal-footer">
						<button  class="btn btn-primary Eliminar_Registro" type="button">Si</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
					</div>
				</div>
			</div>     
		</div>
	</div>
	<!-- Termina Modal Para Confirmacion al Eliminar -->

	<div class="row">
		<div class="panel panel-danger col-lg-8" style="display:none" id="id_estilo5">
			<div class="panel-heading" id="NoseEncontroData" style="display:none">
			</div>															
		</div>

		<div class="col-lg-8"  id="mostrarTabla" style="display:none">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="row">
						<div class="form-group col-sm-6">
							<h3 class="panel-title"><b><strong>Registro de Minutos</strong></b></h3>
						</div>														
					</div>
				</div>
				<div class="panel-body">
					<div class="row">									
						<div class=" col-md-9 col-lg-12">
							<form class="form-horizontal" id="formulario_productos">
								<div class="table-responsive">
									<table class="table table-user-information">					
										<thead class="thead-inverse">
											<tr>						
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">#</font></strong></b></th>	<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Nombre Plan</font></strong></b></th>
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Min Vendidos</font></strong></b></th>	
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Minuto</font></strong></b></th>	
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Total</font></strong></b></th>	
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Fecha Registro</font></strong></b></th>	
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Hora Registro</font></strong></b></th>	
												<th><b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Acciones</font></strong></b></th>					
											</tr>
										</thead>
										<tbody class="searchable" id="myTable">					
											<tr></tr>
										</tbody>											
									</table>
								</div>													
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<div class="row" onmousemove="Validar_Seleccion_Plan_Ingres_Minutos()">
		<div class="col-lg-4">
			<div class="panel panel-danger">
				<div class="panel-heading">
					<div class="row">
						<div class="form-group col-sm-8">
							<h3 class="panel-title"><b><strong>Panel de Minutos</strong></b></h3>		
						</div>																	
					</div>
				</div>
				<div class="panel-body">			
					<div class="form-group ">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
						<font size ="2", color ="#000000"><?php echo e(Form::label("Seleccione un plan:")); ?></font>
						<select id="plan_id" name="plan_id" class="form-control">						
						</select>
					</div>
					<p></p>
					<button type="button" class="btn btn-success RegistrarIngresoMinutos" data-toggle="modal" data-target="#ModalRegistrarMinutos" id="BtnIngresarMinutos" title="Ingresar Minutos">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Ingresar Minutos</span></font></strong>
						<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square">
						</button>
					</div>	
				</div>
			</div>
			<form id="Formulario_Venta_Minutos">
				<div class="col-sm-5 col-md-offset-3" id="cuadrado_valor_minutos" style="display:none">
					<div class="table-responsive">
						<table class="table" border="0">
							<tr>
								<td>
									<div class="info-box bg-purple">
										<span class="info-box-icon"><i class="fa fa-usd"></i></span>
										<div class="info-box-content">
											<span class="info-box-text">Valor Venta</span>

											<b><strong><font size ="5", color="#ffffff" face="Arial"><label id="Valor_Venta_Minutos" name="Valor_Venta_Minutos">0</label></font></strong></b>
											<div class="progress">
												<div class="progress-bar"></div>
											</div> 
											<span class="progress-description">
												Total Minutos Vendidos:<b><strong> <font size ="3", color="#ffffff" face="Arial Black"><label id="total_minutos_vendidos" name="total_minutos_vendidos">0</label></font></strong></b>
											</span>       
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</form>
		</div>
		<div class="row" onmousemove="Validar_Seleccion_Plan_Ingres_Minutos()">
			<div class="col-lg-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="form-group col-sm-8">								
								<h3 class="panel-title"><b><strong>Panel del plan</strong></b></h3>				
							</div>																	
						</div>
					</div>
					<div class="panel-body">
						<p></p>
						<button type="button" class="btn btn-success" id="BtnRegistrarPlan" title="Registrar Nuevo Plan" data-toggle="modal" data-target="#ModalRegistrar_NuevoPlan" data-backdrop="static" data-keyboard="false">
							<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
							<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square">
							</button>
							<button type="button" class="btn btn-primary ModificarPlanMinutos" id="BtnModificarPlan" title="Modificar Plan" data-toggle="modal" data-target="#ModalEditarPlanMinutos" data-backdrop="static" data-keyboard="false">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Modificar</span></font></strong>
								<strong> <font size ="2", color ="#ffffff"><span class="fa fa-pencil-square-o">
								</button>
								<button type="button" class="btn btn-danger" id="BtnEliminarPlan" title="Eliminar Plan" data-toggle="modal" data-target="#Eliminar_Plan" data-backdrop="static" data-keyboard="false">
									<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Eliminar</span></font></strong>
									<strong> <font size ="2", color ="#ffffff"><span class="fa fa-trash-o">
									</button>							
								</div>	
							</div>
						</div>
					</div>
					<!-- MODAL REGISTRAR MINUTOS -->
					<div class="panel-body" id="formulario_RegistrarMinutos">
						<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistrarMinutos" onmousemove="Validar_Cantidad_Minutos_Ingresados()"data-backdrop="static" data-keyboard="false">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">										<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black">Ingresar Minutos</font></strong></b></h4>
									</div>
									<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
										<input type="hidden" name="comercio_id" id="comercio_id" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
										<input type="hidden" name="id_plan2" id="id_plan2" class="form-control">
										<!-- Fecha Registro -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><?php echo e(Form::label("Fecha Registro:")); ?></font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" name="birthdate" value="10/24/1984"  class="form-control" />																						
											</div>
										</div> 
										<!-- Fecha Registro -->

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Nombre del Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="nombre_plan_registrar" id="nombre_plan_registrar"></label></font></strong></b>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="cantidad_minutos_plan" id="cantidad_minutos_plan"></label></font></strong></b>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Restantes:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="cantidad_minutos_restantes_plan_registrar" id="cantidad_minutos_restantes_plan_registrar"></label></font></strong></b>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Minuto:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="valor_minuto_plan_registrar" id="valor_minuto_plan_registrar"></label></font></strong></b>
											</div>
										</div>
										<!-- INPUT -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Vendidos:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input class="form-control" id="Cantidad_Minutos_Vendidos_Registrar" name="Cantidad_Minutos_Vendidos_Registrar" type="number">											
												<div class="panel panel-danger" style="display:none" id="id_estilo3">
													<div class="panel-heading" id="Validar_Cantidad_Minutos" style="display:none">
													</div>															
												</div>
											</div>
										</div>
										<!-- INPUT -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Total:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="4", color="#ff0000" face="Arial Black"><label type="text" name="pesos" id="pesos"></label></font></strong></b><b><strong> <font size ="4", color="#ff0000" face="Arial Black"><label type="text"  name="Valor_Total_Minutos_Vendidos" id="Valor_Total_Minutos_Vendidos"></label></font></strong></b>
											</div>
											<input type="hidden" class="form-control" name="Valor_Total_Minutos_Vendidoss" id="Valor_Total_Minutos_Vendidoss">
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm-update" id="BtnRegistrarMinutosVendidos">Guardar</button>
										<button type="button" class="btn btn-primary cerrarMensaje" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="confirm-update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Registrar los minutos?</h4>
								</div>
								<div class="modal-footer">
									<button  class="btn btn-primary RegistrarMinutos" data-toggle="modal" data-target="#confirm-update" type="button" id="confirmar_venta_manual">Si</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
								</div>
							</div>
						</div>     
					</div>

					<!-- MODAL PARA EDITAR PLAN MINUTOS -->
					<div class="panel-body" id="formulario_EditarPlanMinutos" data-backdrop="static" data-keyboard="false">
						<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarPlanMinutos" onmousemove="Validar_editar_plan()">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close cerrarMensaje" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black">Editar Plan Minutos</font></strong></b></h4>
									</div>
									<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
										<input type="hidden" name="comercio_id_modificar" id="comercio_id_modificar" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">

										<input type="hidden" name="id_plan_modificar" id="id_plan_modificar" class="form-control">																	
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Nombre del Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" name="nombre_plan_editar" id="nombre_plan_editar" class="form-control">
											</div>
										</div>									

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="number" name="cantidad_minutos_editar" id="cantidad_minutos_editar" class="form-control">
											</div>
										</div>

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Restantes:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">											
												<input type="number" name="cantidad_minutos_restantes_plan_editar" id="cantidad_minutos_restantes_plan_editar" class="form-control">
											</div>
										</div>

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Minuto:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="number" name="valor_minuto_plan_editar" id="valor_minuto_plan_editar" class="form-control">
												<div class="panel panel-danger" style="display:none" id="id_estilo6">
													<div class="panel-heading" id="mensaje_valida_editar" style="display:none">
													</div>															
												</div>
											</div>

										</div>							

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmar_editar_plan" id="Btn_modificar_plan_minutos">Guardar</button>
										<button type="button" class="btn btn-primary cerrarMensaje" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="confirmar_editar_plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Editar el Plan?</h4>
								</div>
								<div class="modal-footer">
									<button  class="btn btn-primary Editar_Plan_Minutoss" data-toggle="modal" data-target="#confirmar_editar_plan" type="button" id="confirmar_venta_manual">Si</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
								</div>
							</div>
						</div>     
					</div>
					<!-- TERMINA MODAL EDITAR PLAN MINUTOS -->
					<!-- MODAL PARA REGISTRAR NUEVO PLAN -->
					<div class="panel-body" id="formulario_Registrar_NuevoPlan" data-backdrop="static" data-keyboard="false">
						<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistrar_NuevoPlan" onmousemove="Validar_Datos_Nuevo_Plan()">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close cerrarMensaje" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black">Registrar Nuevo Plan</font></strong></b></h4>
									</div>
									<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
										<input type="hidden" name="comercio_id_oculto_nuevo_Plan" id="comercio_id_oculto_nuevo_Plan" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">								
										<!-- Fecha Registro -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><?php echo e(Form::label("Fecha Registro:")); ?></font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" id="Fecha_Nuevo_Plan" name="Fecha_Nuevo_Plan" class="form-control" readonly>										
											</div>
										</div> 
										<!-- Fecha Registro -->									
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Nombre del Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" class="form-control" name="Nombre_Nuevo_Plan" id="Nombre_Nuevo_Plan">
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="number" class="form-control" name="Cantidad_Minutos_Nuevo_Plan" id="Cantidad_Minutos_Nuevo_Plan">
											</div>
										</div>

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Venta Minuto:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="number" class="form-control" name="Valor_Venta_Minutos_Nuevo_Plan" id="Valor_Venta_Minutos_Nuevo_Plan">

												<div class="panel panel-danger" style="display:none" id="id_estilo">
													<div class="panel-heading" id="mensaje_valida_datos_nuevo_plan" style="display:none">														
													</div>															
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#registrar_nuevo_plan" id="BtnConfirmarNuevoPlan">Guardar</button>
										<button type="button" class="btn btn-primary cerrarMensaje" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="registrar_nuevo_plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Registrar el nuevo Plan?</h4>
								</div>
								<div class="modal-footer">
									<button  class="btn btn-primary RegistrarNuevoPlan" data-toggle="modal" data-target="#registrar_nuevo_plan" type="button" id="confirmar_venta_manual">Si</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
								</div>
							</div>
						</div>     
					</div>
					<!-- TERMINA MODAL REGISTRAR NUEVO PLAN -->
					<!-- Confirmacion para eliminar Planes -->
					<div class="modal fade" id="Eliminar_Plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Eliminar el Plan?</h4>
									<div class="modal-body">									
										* Se borrará toda la información asociada al plan: <b><strong> <font size ="2", color="#ff3300" face="Arial Black"><label id="nombre_plan_eliminar" name="nombre_plan_eliminar"></label></font></strong></b>
									</div>
									<input type="hidden" name="id_plan_eliminar" id="id_plan_eliminar" class="form-control">
									<input type="hidden" name="comercio_id_eliminar" id="comercio_id_eliminar" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
								</div>
								<div class="modal-footer">
									<button  class="btn btn-primary EliminarPlan" data-toggle="modal" data-target="#Eliminar_Plan" type="button" id="confirmar_venta_manual">Si</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
								</div>
							</div>
						</div>     
					</div>
					<!-- Termina Confirmacion Para eliminacion de planes -->

					<!-- MODAL PARA EDITAR REGISTRO DE MINUTOS -->
					<div class="panel-body" id="formulario_Editar_Registro_Minutos">
						<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditar_Registro_Minutos" onmousemove="Validar_Cantidad_Minutos_Modificar()">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close cerrarMensaje" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black">Editar Ingreso Minutos</font></strong></b></h4>
									</div>
									<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
										<input type="hidden" name="comercio_id_oculto" id="comercio_id_oculto" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">

										<input type="hidden" name="id_plan3" id="id_plan3" class="form-control">
										<input type="hidden" name="cantidad_oculta" id="cantidad_oculta" class="form-control">
										<input type="hidden" name="id_plan_minutos" id="id_plan_minutos" class="form-control">

										<!-- Fecha Registro -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black"><?php echo e(Form::label("Fecha Registro:")); ?></font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input type="text" id="Fecha_Editar_Ingreso_Minutos" name="Fecha_Editar_Ingreso_Minutos" class="form-control" readonly>												
											</div>
										</div> 
										<!-- Fecha Registro -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Nombre del Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="Nombre_Plan_Editar" id="Nombre_Plan_Editar"></label></font></strong></b>
											</div>
										</div>
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Plan:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="Cantidad_Minutos_Plan_Modificar" id="Cantidad_Minutos_Plan_Modificar"></label></font></strong></b>
											</div>
										</div>

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Restantes:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="cantidad_minutos_restantes_plan_modificar" id="cantidad_minutos_restantes_plan_modificar"></label></font></strong></b>
											</div>
										</div>

										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Minuto:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="2", color="#000000" face="Arial Black"><label type="text"  name="valor_minuto_plan_modificar" id="valor_minuto_plan_modificar"></label></font></strong></b>
											</div>
										</div>
										<!-- INPUT -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Cantidad Minutos Vendidos:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<input class="form-control" id="Cantidad_Minutos_Vendidos_Modificar" name="Cantidad_Minutos_Vendidos_Modificar" type="number">												
												<div class="panel panel-danger" style="display:none" id="id_estilo2">
													<div class="panel-heading" id="Validar_Cantidad_Minutos_Modificar" style="display:none">
													</div>															
												</div>
											</div>
										</div>
										<!-- INPUT -->
										<div class="row">
											<div class="form-group col-sm-4">
												<b><strong> <font size ="2", color="#53a4ee" face="Arial Black">Valor Total:
												</font></strong></b>
											</div>
											<div class="form-group col-sm-8">
												<b><strong> <font size ="4", color="#ff0000" face="Arial Black"><label type="text" name="pesos" id="pesos"></label></font></strong></b><b><strong> <font size ="4", color="#ff0000" face="Arial Black"><label type="text"  name="Valor_Total_Minutos_Vendidos_Modificar" id="Valor_Total_Minutos_Vendidos_Modificar"></label></font></strong></b>
											</div>
											<input type="hidden" class="form-control" name="Valor_Total_Minutos_Vendidosss" id="Valor_Total_Minutos_Vendidosss">
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm-update2" id="BtnModificarMinutosVendidos">Guardar</button>
										<button type="button" class="btn btn-primary cerrarMensaje" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="confirm-update2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Modificar los minutos?</h4>
								</div>
								<div class="modal-footer">
									<button  class="btn btn-primary ModificarRegistroMinutos" type="button" id="confirmar_venta_manual">Si</button>
									<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
								</div>
							</div>
						</div>     
					</div>
					<!-- TERMINA MODAL PARA EDITAR REGISTRO DE MINUTOS -->

					<!-- Modal Para Confirmaciones -->
					<div class="modal fade" tabindex="-1" role="dialog" id="ModalConfirmacion" data-backdrop="static" data-keyboard="false">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close cerrarMensaje" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="TitleModal"></h4>
								</div>
								<div class="modal-body" id="CuerpoMensaje">
									<strong> <font size ="4", color ="#01080f" face="Lucida Sans"><p2></p2></font></strong>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-primary cerrarMensaje" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Termina Modal Para Confirmaciones -->

					<script type="text/javascript">
						$(function() {
							$('input[name="birthdate"]').daterangepicker({
								singleDatePicker: true,
								showDropdowns: true
							}, 
							function(start, end, label) {
								var years = moment().diff(start, 'years');
								alert("You are " + years + " years old.");
							});
						});
					</script>

					<script type="text/javascript">

						cargar_combox();
						document.getElementById('BtnIngresarMinutos').disabled=true;
						document.getElementById('BtnModificarPlan').disabled=true;
						document.getElementById('BtnEliminarPlan').disabled=true;				


						$('#fecha_oculta').val($('#fecha_actual').val());
						$(function () {
							$('#datetimepicker12').datetimepicker({

								inline: true,

								defaultDate: new Date()
							}).on('dp.change',function(event){	

								$('#fecha_oculta').val(event.date.format('YYYY-MM-DD'));
								Cargar_datos_en_cuadrado($('#fecha_oculta').val());		

							});	
						});	


			// $('#Fecha_Ingreso_Minutos').datepicker().on('changeDate', function (e) { 
			// 	dateString = $.datepicker.formatDate('yy-mm-dd', new Date(e.target.value));				

			// 	$('#Fecha_Ingreso_Minutos').val(dateString);

			// });	

			// $('#Fecha_Editar_Ingreso_Minutos').datepicker().on('changeDate', function (e) { 
			// 	dateString = $.datepicker.formatDate('yy-mm-dd', new Date(e.target.value));					

			// 	$('#Fecha_Editar_Ingreso_Minutos').val(dateString);

			// });

			// $('#Fecha_Nuevo_Plan').datepicker().on('changeDate', function (e) { 
			// 	dateString = $.datepicker.formatDate('yy-mm-dd', new Date(e.target.value));					

			// 	$('#Fecha_Nuevo_Plan').val(dateString);

			// });

			function Validar_Datos_Nuevo_Plan(){
				var Fecha_Nuevo_Plan 				= $('#Fecha_Nuevo_Plan').val();
				var Nombre_Nuevo_Plan				= $('#Nombre_Nuevo_Plan').val();
				var Cantidad_Minutos_Nuevo_Plan		= $('#Cantidad_Minutos_Nuevo_Plan').val();
				var Cantidad_Minutos_Nuevo_Plan2	= parseInt($('#Cantidad_Minutos_Nuevo_Plan').val());
				var Valor_Venta_Minutos_Nuevo_Plan	= $('#Valor_Venta_Minutos_Nuevo_Plan').val();
				var Valor_Venta_Minutos_Nuevo_Plan2	= parseInt($('#Valor_Venta_Minutos_Nuevo_Plan').val());

				if(Fecha_Nuevo_Plan==''){
					document.getElementById('BtnConfirmarNuevoPlan').disabled=true;	
					$('#id_estilo').show();								
					document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "La fecha no puede estar vacio.";
					document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";						
				}else{
					if(Nombre_Nuevo_Plan==''){
						document.getElementById('BtnConfirmarNuevoPlan').disabled=true;	
						document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El nombre del plan no puede estar vacio.";
						document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
						$('#id_estilo').show();	
					}else{
						if(Cantidad_Minutos_Nuevo_Plan==''){
							document.getElementById('BtnConfirmarNuevoPlan').disabled=true;	
							document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "La cantidad de minutos no puede estar vacio";
							document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
							$('#id_estilo').show();	
						}else{											
							if(Cantidad_Minutos_Nuevo_Plan2==0){
								document.getElementById('BtnConfirmarNuevoPlan').disabled=true;
								document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "La cantidad de minutos no puede ser igual a 0";
								document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
								$('#id_estilo').show();	
							}else{
								if(Valor_Venta_Minutos_Nuevo_Plan==''){
									document.getElementById('BtnConfirmarNuevoPlan').disabled=true;
									document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El valor de venta del minuto no puede estar vacio.";
									document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
									$('#id_estilo').show();	
								}else{
									if(Valor_Venta_Minutos_Nuevo_Plan2==0){
										document.getElementById('BtnConfirmarNuevoPlan').disabled=true;
										document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El valor de venta del minuto no puede ser igual a 0.";
										document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
										$('#id_estilo').show();	
									}else{
										document.getElementById('BtnConfirmarNuevoPlan').disabled=false;
										document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "";	
										$('#id_estilo').hide();															
									}

								}
							}
						}
					}
				}
			}

			function Validar_editar_plan(){

				var id_plan_modificar						= $('#id_plan_modificar').val();
				var nombre_plan_editar 						= $('#nombre_plan_editar').val();
				var cantidad_minutos_editar 				= $('#cantidad_minutos_editar').val();
				var cantidad_minutos_restantes_plan_editar 	= $('#cantidad_minutos_restantes_plan_editar').val();
				var valor_minuto_plan_editar 				= $('#valor_minuto_plan_editar').val();

				var cantidad_minutos_editar2				= parseInt($('#cantidad_minutos_editar').val());
				var cantidad_minutos_restantes_plan_editar2	= parseInt($('#cantidad_minutos_restantes_plan_editar').val());
				var valor_minuto_plan_editar2				= parseInt($('#valor_minuto_plan_editar').val());


				if(nombre_plan_editar==''){
					document.getElementById('Btn_modificar_plan_minutos').disabled=true;
					$('#id_estilo6').show();								
					document.getElementById("mensaje_valida_editar").innerText = "El nombre del plan no puede estar vacio.";
					document.getElementById("mensaje_valida_editar").style.display = "block";	
				}else{
					if(cantidad_minutos_editar==''){
						document.getElementById('Btn_modificar_plan_minutos').disabled=true;
						$('#id_estilo6').show();								
						document.getElementById("mensaje_valida_editar").innerText = "La cantidad no puede estar vacia.";
						document.getElementById("mensaje_valida_editar").style.display = "block";	
					}else{
						if(cantidad_minutos_editar2<0){
							document.getElementById('Btn_modificar_plan_minutos').disabled=true;
							$('#id_estilo6').show();								
							document.getElementById("mensaje_valida_editar").innerText = "La cantidad no puede ser menor a 0.";
							document.getElementById("mensaje_valida_editar").style.display = "block";	
						}else{
							if(cantidad_minutos_restantes_plan_editar==''){
								document.getElementById('Btn_modificar_plan_minutos').disabled=true;
								$('#id_estilo6').show();								
								document.getElementById("mensaje_valida_editar").innerText = "La cantidad de minutos restantes no puede estar vacio.";
								document.getElementById("mensaje_valida_editar").style.display = "block";	
							}else{
								if(cantidad_minutos_restantes_plan_editar<0){
									document.getElementById('Btn_modificar_plan_minutos').disabled=true;
									$('#id_estilo6').show();								
									document.getElementById("mensaje_valida_editar").innerText = "La cantidad de minutos restantes no puede ser menor a 0.";
									document.getElementById("mensaje_valida_editar").style.display = "block";	
								}else{
									if(valor_minuto_plan_editar==''){
										document.getElementById('Btn_modificar_plan_minutos').disabled=true;
										$('#id_estilo6').show();								
										document.getElementById("mensaje_valida_editar").innerText = "El valor de venta de minutos no puede estar vacio.";
										document.getElementById("mensaje_valida_editar").style.display = "block";	
									}else{	
										if(valor_minuto_plan_editar<0){
											document.getElementById('Btn_modificar_plan_minutos').disabled=true;
											$('#id_estilo6').show();								
											document.getElementById("mensaje_valida_editar").innerText = "El valor del minuto no puede ser menor a 0.";
											document.getElementById("mensaje_valida_editar").style.display = "block";	
										}else{										
											document.getElementById('Btn_modificar_plan_minutos').disabled=false;
											$('#id_estilo6').hide();								
											document.getElementById("mensaje_valida_editar").innerText = "";

										}
									}
								}
							}
						}
					}
				}
			}


			function Limpiar_data_Despues_de_Registrar_Plan(){
				$('#Fecha_Nuevo_Plan').val('');	
				$('#Nombre_Nuevo_Plan').val('');
				$('#Cantidad_Minutos_Nuevo_Plan').val('');
				$('#Valor_Venta_Minutos_Nuevo_Plan').val('');					

			}




			function Validar_Seleccion_Plan_Ingres_Minutos(){

				var plan_id = document.getElementById('plan_id').value;						

				if(plan_id==0){
					document.getElementById('BtnIngresarMinutos').disabled=true;
					document.getElementById('BtnModificarPlan').disabled=true;
					document.getElementById('BtnEliminarPlan').disabled=true;

				}else{								
					document.getElementById('BtnIngresarMinutos').disabled=false;
					document.getElementById('BtnModificarPlan').disabled=false;
					document.getElementById('BtnEliminarPlan').disabled=false;


					var nombre_plan =$("#plan_id option:selected").text();	
					var str = nombre_plan;
					var resultado = str.toUpperCase();
					$('#nombre_plan_eliminar').text(resultado);	
					$('#id_plan_eliminar').val(plan_id);
				}
			}

			$('.EliminarPlan').click(function(){


				var id_plan_eliminar 					=	$('#id_plan_eliminar').val();	
				var comercio_id_eliminar 				=	$('#comercio_id_eliminar').val();						

				$.ajax({
					url   : "<?= URL::to('Eliminar_Plan_Minutos') ?>",
					type  : "POST",
					async : false,
					data  :{
						'id_plan_eliminar'             		: id_plan_eliminar,
						'comercio_id_eliminar'             	: comercio_id_eliminar													

					},  
					success:function(re){


						if(!re.success){					
							$("#ModalRegistrar_NuevoPlan").modal('hide');	
							$("#formulario_Registrar_NuevoPlan").modal('hide');						
							$('#CuerpoMensaje').html('');				
							$('#ModalConfirmacion').modal('show');					
							$('#TitleModal').html('<p>Error al Eliminar el plan de minutos.</p>');  
							$.each(re.errors,function(index, error){       
								$('#CuerpoMensaje').append('<p>'+error+'</p>');          
							});     
						}
						if(re == 0){
							$("#ModalRegistrar_NuevoPlan").modal('hide');	
							$("#formulario_Registrar_NuevoPlan").modal('hide');	 
							$('#CuerpoMensaje').html('');					
							$('#ModalConfirmacion').modal('show');
							$('#TitleModal').html('<p>Plan Eliminado.</p>');
							$('#CuerpoMensaje').html('<p>El plan fue eliminado con Exito.!!</p>');


							cargar_combox();
							Validar_Seleccion_Plan_Ingres_Minutos();
							Cargar_datos_en_cuadrado($('#fecha_oculta').val());
							cargar_minutos_tabla();									

						}	
					},
					error:function(re){  
						$("#ModalRegistrar_NuevoPlan").modal('hide');	
						$("#formulario_Registrar_NuevoPlan").modal('hide');		
						$('#CuerpoMensaje').html('');				
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error</p>');
						$('#CuerpoMensaje').html('<p>'+re+'</p>');
					}
				});
			});	



			function Validar_Cantidad_Minutos_Modificar(){

				var Cantidad_Minutos_Plan_Modificar =parseInt($('#Cantidad_Minutos_Vendidos_Modificar').val());
				var Cantidad_Minutos_Plan_Modificar2 =$('#Cantidad_Minutos_Vendidos_Modificar').val();
				var cantidad_minutos_restantes_plan_modificar =parseInt($('#cantidad_minutos_restantes_plan_modificar').text());
				var valor_minuto_plan_modificar =parseInt($('#valor_minuto_plan_modificar').text());

				var Fecha_Modificar_Minutos  =$('#Fecha_Editar_Ingreso_Minutos').val();

				var cantidad_oculta  =$('#cantidad_oculta').val();
				var Valor_Total_Minutos_Vendidosss  =$('#Valor_Total_Minutos_Vendidosss').val();



				if(cantidad_oculta==Valor_Total_Minutos_Vendidosss){
					$('#id_estilo2').hide();
					document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "";								
					document.getElementById('BtnModificarMinutosVendidos').disabled=false;								
				}else{				
					if(Fecha_Modificar_Minutos==''){
						$('#id_estilo2').show();
						document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
						document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La fecha no puede estar vacia.";
						document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
						$('#VValor_Total_Minutos_Vendidos_Modificar').text('0');
						$('#Valor_Total_Minutos_Vendidosss').val('0');
						$('#pesos').text('$');

					}else{	
						if(Cantidad_Minutos_Plan_Modificar>cantidad_minutos_restantes_plan_registrar){
							$('#id_estilo2').show();
							document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
							document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada es mayor a la cantidad de minutos restantes.";
							document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
							$('#VValor_Total_Minutos_Vendidos_Modificar').text('0');
							$('#Valor_Total_Minutos_Vendidosss').val('0');
							$('#pesos').text('$');
						}else{
							if(Cantidad_Minutos_Plan_Modificar==0){ 
								$('#id_estilo2').show();
								document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
								document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser igual a 0.";
								document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
								$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
								$('#Valor_Total_Minutos_Vendidosss').val('0');
								$('#pesos').text('$');
							}else{
								if(Cantidad_Minutos_Plan_Modificar2==''){
									$('#id_estilo2').show();
									document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
									document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede estar vacia.";
									document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
									$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
									$('#Valor_Total_Minutos_Vendidosss').val('0');
									$('#pesos').text('$');
								}else{												
									if(Cantidad_Minutos_Plan_Modificar>cantidad_minutos_restantes_plan_modificar){
										$('#id_estilo2').show();
										document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
										document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser mayor a los minutos restantes.";
										document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
										$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
										$('#Valor_Total_Minutos_Vendidosss').val('0');
										$('#pesos').text('$');
									}else{
										if(Cantidad_Minutos_Plan_Modificar2<0){
											$('#id_estilo2').show();
											document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
											document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser menor a 0.";
											document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
											$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
											$('#Valor_Total_Minutos_Vendidosss').val('0');
											$('#pesos').text('$');

										}else{
											document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "";
											document.getElementById('BtnModificarMinutosVendidos').disabled=false;
											$('#id_estilo2').hide();
											total=Cantidad_Minutos_Plan_Modificar2*valor_minuto_plan_modificar;
											$('#Valor_Total_Minutos_Vendidos_Modificar').text(ConvertirDecimales(total));

											$('#Valor_Total_Minutos_Vendidosss').val(total);
											$('#pesos').text('$');
										}
									}
								}
							}
						}
					}
				}
			}


			function Validar_Cantidad_Minutos_Ingresados(){
				var Cantidad_Minutos_Ingresar =parseInt($('#Cantidad_Minutos_Vendidos_Registrar').val());
				var Cantidad_Minutos_Ingresar2 =$('#Cantidad_Minutos_Vendidos_Registrar').val();
				var cantidad_minutos_restantes_plan_registrar =parseInt($('#cantidad_minutos_restantes_plan_registrar').text());
				var Fecha_Ingreso_Minutos =$('#Fecha_Ingreso_Minutos').val();

				var valor_minuto_plan_registrar =parseInt($('#valor_minuto_plan_registrar').text());

				var total;


				if(Fecha_Ingreso_Minutos==''){
					$('#id_estilo3').show();
					document.getElementById('BtnRegistrarMinutosVendidos').disabled=true;	
					document.getElementById("Validar_Cantidad_Minutos").innerText = "La fecha no puede estar vacia.";
					document.getElementById("Validar_Cantidad_Minutos").style.display = "block";
					$('#Valor_Total_Minutos_Vendidos').text('0');
					$('#Valor_Total_Minutos_Vendidoss').val('0');
					$('#pesos').text('$');
				}else{	
					if(Cantidad_Minutos_Ingresar>cantidad_minutos_restantes_plan_registrar){
						$('#id_estilo3').show();
						document.getElementById('BtnRegistrarMinutosVendidos').disabled=true;	
						document.getElementById("Validar_Cantidad_Minutos").innerText = "La cantidad ingresada es mayor a la cantidad de minutos restantes.";
						document.getElementById("Validar_Cantidad_Minutos").style.display = "block";
						$('#Valor_Total_Minutos_Vendidos').text('0');
						$('#Valor_Total_Minutos_Vendidoss').val('0');
						$('#pesos').text('$');
					}else{
						if(Cantidad_Minutos_Ingresar==0){ 
							$('#id_estilo3').show();
							document.getElementById('BtnRegistrarMinutosVendidos').disabled=true;	
							document.getElementById("Validar_Cantidad_Minutos").innerText = "La cantidad ingresada no puede ser igual a 0.";
							document.getElementById("Validar_Cantidad_Minutos").style.display = "block";
							$('#Valor_Total_Minutos_Vendidos').text('0');
							$('#Valor_Total_Minutos_Vendidoss').val('0');
							$('#pesos').text('$');
						}else{
							if(Cantidad_Minutos_Ingresar2==''){
								$('#id_estilo3').show();
								document.getElementById('BtnRegistrarMinutosVendidos').disabled=true;	
								document.getElementById("Validar_Cantidad_Minutos").innerText = "La cantidad no puede estar vacia";
								document.getElementById("Validar_Cantidad_Minutos").style.display = "block";
								$('#Valor_Total_Minutos_Vendidos').text('0');
								$('#Valor_Total_Minutos_Vendidoss').val('0');
								$('#pesos').text('$');
							}else{
								$('#id_estilo3').hide();
								document.getElementById("Validar_Cantidad_Minutos").innerText = "";
								document.getElementById('BtnRegistrarMinutosVendidos').disabled=false;

								total=Cantidad_Minutos_Ingresar2*valor_minuto_plan_registrar;

								$('#Valor_Total_Minutos_Vendidos').text(ConvertirDecimales(total));

								$('#Valor_Total_Minutos_Vendidoss').val(total);
								$('#pesos').text('$');


							}
						}
					}
				}

			}
			function ConvertirDecimales(n, dp) {
				var s = ''+(Math.floor(n)), d = n % 1, i = s.length, r = '';
				while ( (i -= 3) > 0 ) { r = ',' + s.substr(i, 3) + r; }
				return s.substr(0, i + 3) + r + (d ? '.' + Math.round(d * Math.pow(10,dp||2)) : '');
			}

			function RemoverDataCombobox(selectbox)
			{
				var i;
				for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
				{
					selectbox.remove(i);
				}
			}

			function cargar_combox(){
				$el =$('#plan_id');
				$.ajax({
					url   : "<?= URL::to('Cargar_Nombre_Planes') ?>",
					type  : "GET",
					async : false,
					data  :{													

					},  
					success:function(re){

						if(!re.success){					
							$("#ModalRegistrar_NuevoPlan").modal('hide');	
							$("#formulario_Registrar_NuevoPlan").modal('hide');						
							$('#CuerpoMensaje').html('');				
							$('#ModalConfirmacion').modal('show');					
							$('#TitleModal').html('<p>No se encontro ningun plan registrado.</p>');  
							$.each(re.errors,function(index, error){       
								$('#CuerpoMensaje').append('<p>'+error+'</p>');          
							});     
						}else{
// Limpiamos todo lo que halla para que no se repita la info despues de agregar nuevo plan.
RemoverDataCombobox(document.getElementById("plan_id"));
var option = $('<option />');									
$.each(re.nombre_plan, function(key,value) {
	$el.append($("<option></option>")
		.attr("value", key).text(value));
});
}
}
});
			}

			$('.RegistrarIngresoMinutos').click(function(){

				var plan_id = document.getElementById('plan_id').value;	

				$('#Cantidad_Minutos_Vendidos_Registrar').val('');
				$('#Fecha_Ingreso_Minutos').val('');
				$('#Valor_Total_Minutos_Vendidos').text('0');


				$.ajax({
					type:'get',
					data:{
						'plan_id':plan_id
					},
					url:'<?php echo e(url('Consultar_Datos_PlanMinutos')); ?>',

					success: function(data){
						$('#nombre_plan_registrar').empty().html(data.nombre_plan_minutos);
						$('#cantidad_minutos_plan').empty().html(data.cantidad_minutos);
						$('#cantidad_minutos_restantes_plan_registrar').empty().html(data.cantidad_minutos_restantes);
						$('#valor_minuto_plan_registrar').empty().html(data.valor_venta_minutos);

					}
				});
			});


			$('.ModificarPlanMinutos').click(function(){

				var plan_id = document.getElementById('plan_id').value;	
				var faction = "<?php echo URL::to('consultar_datos_plan_minutos/data'); ?>";
				var fdata = $('#plan_id').val(plan_id);								
				$('#load').show();
				$.post(faction, fdata, function(json) {
					if (json.success) { 
						$('#formulario_EditarPlanMinutos input[name="id_plan_modificar"]').val(json.id);
						$('#formulario_EditarPlanMinutos input[name="nombre_plan_editar"]').val(json.nombre_plan_minutos);		
						$('#formulario_EditarPlanMinutos input[name="cantidad_minutos_editar"]').val(json.cantidad_minutos);	
						$('#formulario_EditarPlanMinutos input[name="cantidad_minutos_restantes_plan_editar"]').val(json.cantidad_minutos_restantes);	
						$('#formulario_EditarPlanMinutos input[name="valor_minuto_plan_editar"]').val(json.valor_venta_minutos);

					} else {
						$('#errorMessage').html(json.message);
						$('#errorMessage').show();
					}
				});

			});



			$('.Editar_Plan_Minutoss').click(function(){

				var comercio_id_modificar 						=	$('#comercio_id_modificar').val();	
				var id_plan_modificar 						=	$('#id_plan_modificar').val();	
				var nombre_plan_editar 							=	$('#nombre_plan_editar').val();	
				var cantidad_minutos_editar 					=	$('#cantidad_minutos_editar').val();						
				var cantidad_minutos_restantes_plan_editar 		=	$('#cantidad_minutos_restantes_plan_editar').val();					
				var valor_minuto_plan_editar 					=	$('#valor_minuto_plan_editar').val();

				$.ajax({
					url   : "<?= URL::to('Modificar_Plan_Minutos') ?>",
					type  : "POST",
					async : false,
					data  :{
						'comercio_id_modificar'             		: comercio_id_modificar,
						'id_plan_modificar'             			: id_plan_modificar,
						'nombre_plan_editar'             			: nombre_plan_editar,
						'cantidad_minutos_editar'             		: cantidad_minutos_editar,								
						'cantidad_minutos_restantes_plan_editar'    : cantidad_minutos_restantes_plan_editar,
						'valor_minuto_plan_editar'         			: valor_minuto_plan_editar						

					},  
					success:function(re){


						if(!re.success){					
							$("#ModalEditarPlanMinutos").modal('hide');	
							$("#formulario_EditarPlanMinutos").modal('hide');						
							$('#CuerpoMensaje').html('');				
							$('#ModalConfirmacion').modal('show');					
							$('#TitleModal').html('<p>Error al Modificar el nuevo plan de minutos.</p>');  
							$.each(re.errors,function(index, error){       
								$('#CuerpoMensaje').append('<p>'+error+'</p>');          
							});     
						}
						if(re == 0){
							$("#ModalEditarPlanMinutos").modal('hide');	
							$("#formulario_EditarPlanMinutos").modal('hide');	 
							$('#CuerpoMensaje').html('');					
							$('#ModalConfirmacion').modal('show');
							$('#TitleModal').html('<p>Plan Modificado.</p>');
							$('#CuerpoMensaje').html('<p>El plan fue modificado con Exito.!!</p>');


							Cargar_datos_en_cuadrado($('#fecha_oculta').val());
							cargar_minutos_tabla();
							cargar_combox();
							Limpiar_data_Despues_de_Registrar_Plan();

						}	
					},
					error:function(re){  
						$("#ModalEditarPlanMinutos").modal('hide');	
						$("#formulario_EditarPlanMinutos").modal('hide');		
						$('#CuerpoMensaje').html('');				
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error</p>');
						$('#CuerpoMensaje').html('<p>'+re+'</p>');
					}
				});
			});	

			cargar_minutos_tabla();		


			$('.RegistrarNuevoPlan').click(function(){

				var Fecha_Nuevo_Plan 					=	$('#Fecha_Nuevo_Plan').val();	
				var Nombre_Nuevo_Plan 					=	$('#Nombre_Nuevo_Plan').val();
				var Cantidad_Minutos_Nuevo_Plan 		=	$('#Cantidad_Minutos_Nuevo_Plan').val();
				var Valor_Venta_Minutos_Nuevo_Plan 		=	$('#Valor_Venta_Minutos_Nuevo_Plan').val();						
				var comercio_id 						=	$('#comercio_id_oculto_nuevo_Plan').val();

				$.ajax({
					url   : "<?= URL::to('Registrar_Nuevo_Plan') ?>",
					type  : "POST",
					async : false,
					data  :{
						'Fecha_Nuevo_Plan'             		: Fecha_Nuevo_Plan,
						'Nombre_Nuevo_Plan'             	: Nombre_Nuevo_Plan,
						'Cantidad_Minutos_Nuevo_Plan'   	: Cantidad_Minutos_Nuevo_Plan,
						'Valor_Venta_Minutos_Nuevo_Plan'    : Valor_Venta_Minutos_Nuevo_Plan,
						'comercio_id'         				: comercio_id						

					},  
					success:function(re){


						if(!re.success){					
							$("#ModalRegistrar_NuevoPlan").modal('hide');	
							$("#formulario_Registrar_NuevoPlan").modal('hide');						
							$('#CuerpoMensaje').html('');				
							$('#ModalConfirmacion').modal('show');					
							$('#TitleModal').html('<p>Error al Registrar el nuevo plan de minutos.</p>');  
							$.each(re.errors,function(index, error){       
								$('#CuerpoMensaje').append('<p>'+error+'</p>');          
							});     
						}
						if(re == 0){
							$("#ModalRegistrar_NuevoPlan").modal('hide');	
							$("#formulario_Registrar_NuevoPlan").modal('hide');	 
							$('#CuerpoMensaje').html('');					
							$('#ModalConfirmacion').modal('show');
							$('#TitleModal').html('<p>Plan Registrado.</p>');
							$('#CuerpoMensaje').html('<p>El plan fue registrado con Exito.!!</p>');


							Cargar_datos_en_cuadrado($('#fecha_oculta').val());
							cargar_minutos_tabla();
							cargar_combox();
							Limpiar_data_Despues_de_Registrar_Plan();

						}	
					},
					error:function(re){  
						$("#ModalRegistrar_NuevoPlan").modal('hide');	
						$("#formulario_Registrar_NuevoPlan").modal('hide');		
						$('#CuerpoMensaje').html('');				
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error</p>');
						$('#CuerpoMensaje').html('<p>'+re+'</p>');
					}
				});
			});					

			$('.RegistrarMinutos').click(function(){


				var Fecha_Ingreso_Minutos 				=	$('#Fecha_Ingreso_Minutos').val();	
				var id_plan2 							=	$('#id_plan2').val();
				var Cantidad_Minutos_Vendidos_Registrar =	$('#Cantidad_Minutos_Vendidos_Registrar').val();
				var Valor_Total_Minutos_Vendidoss 		=	$('#Valor_Total_Minutos_Vendidoss').val();	
				var Cantidad_Minutos_Restantes			=	$('#cantidad_minutos_restantes_plan_registrar').text();
				var comercio_id 						=	$('#comercio_id').val();							


				$.ajax({
					url   : "<?= URL::to('Registrar_Ingreso_Minutos') ?>",
					type  : "POST",
					async : false,
					data  :{
						'Fecha_Ingreso_Minutos'             	: Fecha_Ingreso_Minutos,
						'id_plan2'             					: id_plan2,
						'Cantidad_Minutos_Vendidos_Registrar'   : Cantidad_Minutos_Vendidos_Registrar,
						'Valor_Total_Minutos_Vendidoss'         : Valor_Total_Minutos_Vendidoss,
						'Cantidad_Minutos_Restantes'         	: Cantidad_Minutos_Restantes,
						'comercio_id'             				: comercio_id			

					},  
					success:function(re){


						if(!re.success){					
							$("#ModalRegistrarMinutos").modal('hide');	
							$("#formulario_RegistrarMinutos").modal('hide');						
							$('#CuerpoMensaje').html('');				
							$('#ModalConfirmacion').modal('show');					
							$('#TitleModal').html('<p>Error al Registrar el ingreso de minutos.</p>');  
							$.each(re.errors,function(index, error){       
								$('#CuerpoMensaje').append('<p>'+error+'</p>');          
							});     
						}
						if(re == 0){
							$("#ModalRegistrarMinutos").modal('hide');	
							$("#formulario_RegistrarMinutos").modal('hide');	 
							$('#CuerpoMensaje').html('');					
							$('#ModalConfirmacion').modal('show');
							$('#TitleModal').html('<p>Minutos Registrados.</p>');
							$('#CuerpoMensaje').html('<p>Los minutos fueron ingresados con Exito.!!</p>');


							Cargar_datos_en_cuadrado($('#fecha_oculta').val());
							cargar_minutos_tabla();

						}	
					},
					error:function(re){  
						$("#ModalRegistrarMinutos").modal('hide');	
						$("#formulario_RegistrarMinutos").modal('hide');		
						$('#CuerpoMensaje').html('');				
						$('#ModalConfirmacion').modal('show');
						$('#TitleModal').html('<p>Error</p>');
						$('#CuerpoMensaje').html('<p>'+re+'</p>');
					}
				});
			});

			function cargar_minutos_tabla(){	

				var fecha_oculta=$('#fecha_oculta').val();							

				$.ajax({
					url   : "<?= URL::to('Cargar_Tabla_Registro_Minutos_X_Dia')?>",
					type  : "POST",
					async : false,
					data  :{
						'data'  		: 1,
						'fecha_oculta'	:fecha_oculta
					},  
					success:function(re){


						if(re==''){											

						}else{
							$('.searchable').html(re); 

						}
					},
					error:function(re){  

					}
				});
			}




			Cargar_datos_en_cuadrado($('#fecha_oculta').val());
// console.log($('#fecha_oculta').val());

function Cargar_datos_en_cuadrado(fecha){
	cargar_minutos_tabla();

	var $total_minutos_vendidos = $("#total_minutos_vendidos");
	var $Valor_Venta_Minutos  = $("#Valor_Venta_Minutos");


	$.ajax({
		url   : "<?= URL::to('Cargar_Registros_En_Cuadro')?>",
		type  : "POST",
		async : false,
		data  :{
			'fecha'  : fecha
		},  
		success:function(re){									

			if(re.Total_Minutos_Vendidos==0){
				$Valor_Venta_Minutos.append($('#Formulario_Venta_Minutos label[name="Valor_Venta_Minutos"]').text('$0'));     
				$total_minutos_vendidos.append($('#Formulario_Venta_Minutos label[name="total_minutos_vendidos"]').text('0'));

				$('.progress-bar').css('width', '' + (0+ '%')); 
				$('#mostrarTabla').hide();
				$('#cuadrado_valor_minutos').hide();
				$('#id_estilo5').show();
				document.getElementById("NoseEncontroData").innerText = "No se encontró ningún registro de venta.";
				document.getElementById("NoseEncontroData").style.display = "block";										
			}else{
				$('#mostrarTabla').show();
				$('#cuadrado_valor_minutos').show();
				$('#id_estilo5').hide();											
				document.getElementById("NoseEncontroData").innerText = "";
				$total_minutos_vendidos.empty(); 
				$Valor_Venta_Minutos.empty();          
				$Valor_Venta_Minutos.append($('#Formulario_Venta_Minutos label[name="Valor_Venta_Minutos"]').text('$'+re.Valor_Venta_Minutos));     
				$total_minutos_vendidos.append($('#Formulario_Venta_Minutos label[name="total_minutos_vendidos"]').text(re.Total_Minutos_Vendidos));

				$('.progress-bar').css('width', '' + (re.Valor_Venta_Minutos2+ '%'));  
			}
		},
		error:function(re){  

		}
	});
}

$('.Eliminar_Registro').click(function(){

	var comercio_id       			= $('#comercio_id').val();
	var id_registro_minutos   		= $('#id_detalle_plan').val();  
	var Cantidad_Minutos   			= $('#Cantidad_Minutos').val();
	var Cantidad_Minutos_Vendidos   = $('#Cantidad_Minutos_Vendidos').val();
	var id_plan   					= $('#id_plan').val();

	$.ajax({
		url   : "<?= URL::to('Eliminar_Registro_Minutos') ?>",
		type  : "POST",
		async : false,
		data  :{
			'comercio_id'        			: comercio_id,        
			'id_registro_minutos'  			: id_registro_minutos,
			'Cantidad_Minutos'  			: Cantidad_Minutos,
			'Cantidad_Minutos_Vendidos'  	: Cantidad_Minutos_Vendidos,
			'id_plan'  						: id_plan



		},  
		success:function(re){

			if(!re.success){
				$('#CuerpoMensaje').html('');
				$("#confirm-delete").modal('hide');  
				$("#confirm-delete2").modal('hide');         
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Se presentaron algunos erores al Eliminar el registro de minutos.</p>');  
				$.each(re.errors,function(index, error){       
					$('#CuerpoMensaje').append('<p>'+error+'</p>');          
				});              
			}

			if(re == 0){         
				$('#CuerpoMensaje').html('');
				$("#confirm-delete").modal('hide');
				$("#confirm-delete2").modal('hide');      
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Registro Eliminado.</p>');
				$('#CuerpoMensaje').html('<p>El registro de minutos fue Eliminado Exitosamente.</p>');            


				Cargar_datos_en_cuadrado($('#fecha_oculta').val());
				cargar_minutos_tabla();
			}


		},
		error:function(re){
			$('#CuerpoMensaje').html('');
			$("#confirm-delete").modal('hide');  
			$("#confirm-delete2").modal('hide');         
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error al Eliminar el Registro.</p>');  
			$.each(re.errors,function(index, error){       
				$('#CuerpoMensaje').append('<p>'+error+'</p>');          
			});        
		}
	});
});

$('body').delegate('.edit','click',function(){
	var id = $(this).data('id');
	console.log(id);
	var faction = "<?php echo URL::to('consultar_datos_minutos_modificar/data'); ?>";
	var fdata = $('#id_venta').val(id);		
	$('#load').show();
	$.post(faction, fdata, function(json) {
		if (json.success) {
			$('#formulario_Editar_Registro_Minutos input[name="id_plan3"]').val(json.id_detalle_plan);	

			$('#formulario_Editar_Registro_Minutos input[name="id_plan3"]').val(json.id_detalle_plan);						
			$('#formulario_Editar_Registro_Minutos input[name="Fecha_Editar_Ingreso_Minutos"]').val(json.fecha_registro);
			$('#formulario_Editar_Registro_Minutos label[name="Nombre_Plan_Editar"]').text(json.nombre_plan_minutos);
			$('#formulario_Editar_Registro_Minutos label[name="Cantidad_Minutos_Plan_Modificar"]').text(json.cantidad_minutos);								
			$('#formulario_Editar_Registro_Minutos label[name="cantidad_minutos_restantes_plan_modificar"]').text(json.cantidad_minutos_restantes);
			$('#formulario_Editar_Registro_Minutos label[name="valor_minuto_plan_modificar"]').text(json.valor_venta_minutos);							
			$('#formulario_Editar_Registro_Minutos input[name="Cantidad_Minutos_Vendidos_Modificar"]').val(json.cantidad_minutos_vendidos);
			$('#formulario_Editar_Registro_Minutos label[name="Valor_Total_Minutos_Vendidos_Modificar"]').text(json.total_minutos_venta);

			$('#formulario_Editar_Registro_Minutos  input[name="cantidad_oculta"]').val(json.cantidad_minutos_vendidos);

			$('#formulario_Editar_Registro_Minutos  input[name="id_plan_minutos"]').val(json.id_plan_minutos);



		} else {
			$('#errorMessage').html(json.message);
			$('#errorMessage').show();
		}
	});
});


$('.ModificarRegistroMinutos').click(function(){

	var comercio_id_oculto       					= $('#comercio_id_oculto').val();								
	var Cantidad_Minutos_Vendidos_Modificar   		= $('#Cantidad_Minutos_Vendidos_Modificar').val();
	var id_plan3   									= $('#id_plan3').val();
	var cantidad_oculta   						 	= $('#cantidad_oculta').val();
	var cantidad_minutos_restantes_plan_modificar   = $('#cantidad_minutos_restantes_plan_modificar').text();
	var Valor_Total_Minutos_Vendidosss   			= $('#Valor_Total_Minutos_Vendidosss').val();
	var id_plan_minutos   							= $('#id_plan_minutos').val();


	$.ajax({
		url   : "<?= URL::to('Modificar_Registro_Minutos') ?>",
		type  : "POST",
		async : false,
		data  :{
			'comercio_id_oculto'        				: comercio_id_oculto,										
			'Cantidad_Minutos_Vendidos_Modificar'  		: Cantidad_Minutos_Vendidos_Modificar,
			'id_plan3'  								: id_plan3,
			'cantidad_oculta'  							: cantidad_oculta,
			'cantidad_minutos_restantes_plan_modificar' : cantidad_minutos_restantes_plan_modificar,
			'Valor_Total_Minutos_Vendidosss' 			: Valor_Total_Minutos_Vendidosss,
			'id_plan_minutos' 							: id_plan_minutos


		},  
		success:function(re){

			if(!re.success){
				$('#CuerpoMensaje').html('');
				$("#ModalEditar_Registro_Minutos").modal('hide');  
				$("#confirm-update2").modal('hide');         
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Se presentaron algunos erores al Modificar el registro de minutos.</p>');  
				$.each(re.errors,function(index, error){       
					$('#CuerpoMensaje').append('<p>'+error+'</p>');          
				});              
			}

			if(re == 0){         
				$('#CuerpoMensaje').html('');
				$("#ModalEditar_Registro_Minutos").modal('hide');
				$("#confirm-update2").modal('hide');      
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Registro Modificado.</p>');
				$('#CuerpoMensaje').html('<p>El registro de minutos fue Modificado Exitosamente.</p>');            


				Cargar_datos_en_cuadrado($('#fecha_oculta').val());
				cargar_minutos_tabla();
			}


		},
		error:function(re){
			$('#CuerpoMensaje').html('');
			$("#ModalEditar_Registro_Minutos").modal('hide');  
			$("#confirm-update2").modal('hide');         
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error al Modificar el Registro.</p>');  
			$.each(re.errors,function(index, error){       
				$('#CuerpoMensaje').append('<p>'+error+'</p>');          
			});        
		}
	});
});






</script>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>