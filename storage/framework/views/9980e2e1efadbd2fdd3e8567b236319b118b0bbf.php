	
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
	<div class="alert alert-danger" style="display: none;" id="Error_al_Eliminar">		
		<h3><strong><label id="Id_Eliminar_Plan"></label></strong></h3>	
	</div>
	<!-- Modal Para Confirmacion al Eliminar -->
	<div class="panel-body" data-backdrop="static" data-keyboard="false">      
		<div class="modal fade" id="Eliminar_Registro_VentaMinuto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="myModalLabel">¿Esta Seguro de Eliminar el Registro?</h4>
						<input type="hidden" name="Id_Registro_Minuto" id="Id_Registro_Minuto" class="form-control">
						<input type="hidden" name="Cantidad_Minutos_Restantes_Plan" id="Cantidad_Minutos_Restantes_Plan" class="form-control">
						<input type="hidden" name="Cantidad_Minutos_Vendidos" id="Cantidad_Minutos_Vendidos" class="form-control">
						<input type="hidden" name="id_plan_reingresoMinuto" id="id_plan_reingresoMinuto" class="form-control">						
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
		<div id="tabla_id" class="col-xs-12 col-sm-12 col-md-8 col-lg-8">				
		</div>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4" onmousemove="Validar_Seleccion_Plan_Ingres_Minutos()" style="display: none" id="Panel_1">
			<div class="panel panel-danger">
				<div class="panel-heading">				
					<h3 class="panel-title"><b><strong>Panel de Minutos</strong></b></h3>	
				</div>					
				<div class="panel-body">			
					<div class="form-group ">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
						<font size ="2", color ="#000000"><?php echo e(Form::label("Seleccione un plan:")); ?></font>
						<select class="form-control selectpicker PlanesCombobox" data-live-search="true" id="plan_id" class="">
							<option></option>
						</select>
					</div>
					<p></p>
					<button type="button" class="btn btn-success RegistrarIngresoMinutos" data-toggle="modal" data-target="#ModalRegistrarMinutos" id="BtnIngresarMinutos" title="Ingresar Minutos">
						<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Ingresar Minutos</span></font></strong>
						<span class="fa fa-plus-square"></span></button>					
					</div>
				</div>
			</div>			
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-4" onmousemove="Validar_Seleccion_Plan_Ingres_Minutos()" style="display: none" id="Panel_2">
				<div class="panel panel-success">
					<div class="panel-heading">							
						<h3 class="panel-title"><b><strong>Panel del plan</strong></b></h3>		
					</div>	
					<div class="panel-body">
						<center>
							<button type="button" class="btn btn-succes" id="BtnRegistrarPlan" style="background-color: #317a2e" title="Registrar Nuevo Plan" data-toggle="modal" data-target="#ModalRegistrar_NuevoPlan" data-backdrop="static" data-keyboard="false">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Registrar</span></font></strong>
								<strong> <font size ="2", color ="#ffffff"><span class="fa fa-plus-square"></span></font></strong>
							</button>


							<button type="button" class="btn btn-info ModificarPlanMinutos" style="background-color: #05cffc" id="BtnModificarPlan" title="Modificar Plan" data-toggle="modal" data-target="#ModalEditarPlanMinutos" data-backdrop="static" data-keyboard="false">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Modificar</span></font></strong>
								<strong> <font size ="2", color ="#ffffff"><span class="fa fa-pencil-square-o"></span></font></strong>
							</button>
							<br>
							<br>
							<button type="button" class="btn btn-danger" id="BtnEliminarPlan" style="background-color: #fc0521" title="Eliminar Plan">
								<strong> <font size ="2", color ="#ffffff" face="Lucida Sans"><span>Eliminar</span></font></strong>
								<strong> <font size ="2", color ="#ffffff"><span class="fa fa-trash-o"></span></font></strong>
							</button>	
						</center>						
					</div>	
				</div>
			</div>			
		</div>		
		<!-- MODAL REGISTRAR MINUTOS -->
		<div class="panel-body" id="formulario_RegistrarMinutos">
			<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistrarMinutos" onmousemove="Validar_Cantidad_Minutos_Ingresados()"data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">										
							<h4 class="modal-title" id="TitleModal2">
								<b><strong> <font size ="4", color="#53a4ee" face="Arial Black">
									<i class="fa fa-plus fa-2x" aria-hidden="true"></i>Ingresar Minutos</font></strong></b>
									<div class="pull-right">	
										<span class="badge btn-md btn-success" title="Número Plan">
											<b><strong><font size ="2">								<i class="fa fa-phone-square" aria-hidden="true"></i>
												<label id="NumeroCelularIngresoMinutos"></label>
											</font></strong></b>
										</span>
									</div>
								</h4>
							</div>
							<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
								<input type="hidden" name="comercio_id" id="comercio_id" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
								<input type="hidden" name="id_oculto_ingreso_minutos" id="id_oculto_ingreso_minutos">
								<input type="hidden" name="
								" id="
								" class="form-control">
								<input type="hidden" name="Valor_Total_Minutos_Vendidoss" id="Valor_Total_Minutos_Vendidoss" class="form-control">
								<table class="table table-user-information">
									<div class="row">
										<tbody>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Registro</font></strong></b>
												</td>
												<td>								
													<div class="form-group col-sm-8">					
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="Fecha_Ingreso_Minutoss" id="Fecha_Ingreso_Minutoss"   placeholder="Fecha Registro" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
															<span class="input-group-btn">
																<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Plan:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	<label type="text"  name="nombre_plan_registrar" id="nombre_plan_registrar"></label> 		
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Cantidad Minutos Plan:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	<label type="text"  name="cantidad_minutos_plan" id="cantidad_minutos_plan"></label> 		
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Minuto:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	$ <label type="text"  name="valor_minuto_plan_registrar" id="valor_minuto_plan_registrar"></label>
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Minutos Restantes:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	<label type="text"  name="cantidad_minutos_restantes_plan_registrar" id="cantidad_minutos_restantes_plan_registrar"></label> 		
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color="#089bd1" face="Tahoma">Minutos Vendidos:</font></strong></b>
												</td>
												<td>								
													<input type="number" name="Cantidad_Minutos_Vendidos_Registrar" id="Cantidad_Minutos_Vendidos_Registrar" class="form-control">
													<div class="panel panel-danger" style="display:none" id="id_estilo3">
														<div class="panel-heading" id="Validar_Cantidad_Minutos" style="display:none">
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Vendido:</font></strong></b>
												</td>
												<td>
													<span class="badge btn-md btn-success" style="background: #dd5816;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	$<label type="text"  name="Valor_Total_Minutos_Vendidos" id="Valor_Total_Minutos_Vendidos"></label>
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
										</tbody>
									</div>
								</table>
							</div>						
							<div class="modal-footer">
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirm-update" id="BtnRegistrarMinutosVendidos">Guardar Registro</button>
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
				<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditarPlanMinutos">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">							
								<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>Editar Plan Minutos</font></strong></b></h4>
							</div>
							<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
								<input type="hidden" name="comercio_id_modificar" id="comercio_id_modificar" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">

								<input type="hidden" name="id_plan_modificar" id="id_plan_modificar" class="form-control">	

								<table class="table table-user-information">
									<div class="row">
										<tbody>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Nombre del Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="text" class="form-control" name="NombrePlan_Editar" id="NombrePlan_Editar">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Número del Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="NumeroPlan_Editar" id="NumeroPlan_Editar">
													<input type="hidden" name="NumeroPlan_Oculto_Editar" id="NumeroPlan_Oculto_Editar" class="form-control">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Cantidad Minutos Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="CantidadMinutosPlan_Editar" id="CantidadMinutosPlan_Editar">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Cantidad Minutos Restantes Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="CantidadMinutosRestantesPlan_Editar" id="CantidadMinutosRestantesPlan_Editar">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Valor Venta Minuto:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="ValorVentaPlan_Editar" id="ValorVentaPlan_Editar">
												</td>
											</tr>											
											<tr>
												<div class="panel panel-danger" style="display:none" id="id_estilo6">
													<div class="panel-heading" id="mensaje_valida_editar" style="display:none">
													</div>
												</div>
											</tr>
										</tbody>
									</div>
								</table>											
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" id="Btn_modificar_plan_minutos">Guardar</button>
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
							<button  class="btn btn-primary Editar_Plan_Minutoss">Si</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" type="button">No</button>
						</div>
					</div>
				</div>     
			</div>
			<!-- TERMINA MODAL EDITAR PLAN MINUTOS -->
			<!-- MODAL PARA REGISTRAR NUEVO PLAN -->
			<div class="panel-body" id="formulario_Registrar_NuevoPlan" data-backdrop="static" data-keyboard="false">
				<div class="modal fade" tabindex="-1" role="dialog" id="ModalRegistrar_NuevoPlan">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">								
								<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black"><i class="fa fa-file-o fa-2x" aria-hidden="true"></i>Registrar Nuevo Plan</font></strong></b></h4>
							</div>
							<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
								<input type="hidden" name="comercio_id_oculto_nuevo_Plan" id="comercio_id_oculto_nuevo_Plan" value="<?php echo e(Auth::user()->id_comercio); ?>">						
								<table class="table table-user-information">
									<div class="row">
										<tbody>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Nombre del Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="text" class="form-control" name="Nombre_Nuevo_Plan" id="Nombre_Nuevo_Plan">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Número del Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="Numero_Nuevo_Plan" id="Numero_Nuevo_Plan">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Cantidad Minutos Plan:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="Cantidad_Minutos_Nuevo_Plan" id="Cantidad_Minutos_Nuevo_Plan">
												</td>
											</tr>
											<tr>
												<td>
													<span class="badge btn-md btn-success" style="background: #12aed1;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	Valor Venta Minuto:
																</font>
															</strong>
														</b>
													</span>
												</td>
												<td>
													<input type="number" class="form-control" name="Valor_Venta_Minutos_Nuevo_Plan" id="Valor_Venta_Minutos_Nuevo_Plan">
												</td>
											</tr>											
											<tr>
												<td></td>
												<td>
													<div class="panel panel-danger" style="display:none" id="id_estilo">
														<div class="panel-heading" id="mensaje_valida_datos_nuevo_plan" style="display:none">
														</div>
													</div> 
												</td>
											</tr>											
										</tbody>
									</div>
								</table>											
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success" 
								id="BtnConfirmarNuevoPlan">Guardar</button>
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
							<input type="text" name="id_plan_eliminar" id="id_plan_eliminar" class="form-control">
							<input type="text" name="comercio_id_eliminar" id="comercio_id_eliminar" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">
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
			<div class="panel-body" id="formulario_Editar_Registro_Minutos" onmousemove="Validar_Datos_Formulario_Editar_Ingreso_Minutos();">
				<div class="modal fade" tabindex="-1" role="dialog" id="ModalEditar_Registro_Minutos">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="TitleModal2"><b><strong> <font size ="4", color="#53a4ee" face="Arial Black"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i>Editar Ingreso Minutos</font></strong></b></h4>
							</div>
							<div class="modal-body" id="CuerpoMensaje_Venta_Manual">
								<input type="hidden" name="comercio_id_oculto" id="comercio_id_oculto" value="<?php echo e(Auth::user()->id_comercio); ?>" class="form-control">

								<input type="hidden" name="id_plan_minutos" id="id_plan_minutos" class="form-control">
								<input type="hidden" name="id_detalle_plan_minutos" id="id_detalle_plan_minutos" class="form-control">
								<input type="hidden" name="cantidad_oculta" id="cantidad_oculta" class="form-control">
								<input type="hidden" name="Valor_Total_Minutos_Vendidosss" id="Valor_Total_Minutos_Vendidosss" class="form-control">
								<table class="table table-user-information">
									<div class="row">
										<tbody>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Nombre Plan:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	<label type="text"  name="NombrePlan_MinutosIngresados" id="NombrePlan_MinutosIngresados"></label> 		
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Minuto:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	$ <label type="text"  name="ValorMinuto_MinutosIngresados" id="ValorMinuto_MinutosIngresados"></label>
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Minutos Restantes:</font></strong></b>
												</td>
												<td>								
													<span class="badge btn-md btn-success">
														<b>
															<strong>
																<font size ="2">
																	<label type="text"  name="MinutosRestantes_MinutosIngresados" id="MinutosRestantes_MinutosIngresados"></label> 		
																</font>
															</strong>
														</b>
													</span>
												</td>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Minutos Vendidos:</font></strong></b>
												</td>
												<td>								
													<input type="number" name="MinutosVendidos_MinutosIngresados" id="MinutosVendidos_MinutosIngresados" class="form-control">
												</td>
												<div class="panel panel-danger" style="display:none" id="id_estilo2">
													<div class="panel-heading" id="Validar_Cantidad_Minutos_Modificar" style="display:none">
													</div>
												</div>
												<div class="panel panel-danger" style="display:none" id="id_estilo22">
													<div class="panel-heading" id="Validar_Cantidad_Minutos_Modificar2" style="display:none">
													</div>
												</div>
											</tr>
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Fecha Registro</font></strong></b>
												</td>
												<td>								
													<div class="form-group col-sm-8">						
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="FechaMinutosVenta_Editar" id="FechaMinutosVenta_Editar"   placeholder="Fecha Registro" value="<?php echo e(Carbon::today()->toDateString()); ?>" readonly>
															<span class="input-group-btn">
																<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</div>
												</td>
											</tr>										
											<tr>
												<td>								
													<b><strong><font size ="2", color color="#000000" face="Tahoma">Valor Vendido:</font></strong></b>
												</td>
												<td>
													<span class="badge btn-md btn-success" style="background: #dd5816;">
														<b>
															<strong>
																<font size ="2", color color="#000000" face="Tahoma">
																	$<label type="text"  name="TotalVenta_MinutosIngresados" id="TotalVenta_MinutosIngresados"></label>
																</font>
															</strong>
														</b>
													</span>								
												</td>												
											</tr>										
										</tbody>
									</div>
								</table>
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
				Cargar_Tabla_Minutos_Ingresados();
// Carga todos los datos al modal modificar ngreso de minutos
$('body').delegate('.Editar_Minutos_Registrados','click',function(){					
	var id =($(this).attr('id_minuto_registrado'));

	$.ajax({
		type:'get',
		data:{
			'id':id
		},
		url:'<?php echo e(url('Cargar_datos_Minutos_Ingresados')); ?>',
		success: function(data){      
			$('#NombrePlan_MinutosIngresados').empty().html(data.NombrePlanMinutos);
			$('#ValorMinuto_MinutosIngresados').empty().html(data.ValorMinutoPlan);
			$('#MinutosRestantes_MinutosIngresados').empty().html(data.MinutosRestantes);
			$('#MinutosVendidos_MinutosIngresados').empty().val(data.MinutosVendidos);
			$('#TotalVenta_MinutosIngresados').empty().html(data.TotalVenta);	
			$('#cantidad_oculta').empty().val(data.MinutosVendidos);
			$('#id_plan_minutos').empty().val(data.IdPlanMinutos);	
			$('#id_detalle_plan_minutos').empty().val(id);
		}
	});			

});
// Cargamos el id del detalle del plan al modal para poder eliminar por id
$('body').delegate('.Eliminar_Venta_Minuto','click',function(){					
	var id =($(this).attr('id'));
	var Cantidad_Minutos_Restantes_Plan =($(this).attr('Cantidad_Minutos_Restantes_Plan'));
	var Cantidad_Minutos_Vendidos 		=($(this).attr('Cantidad_Minutos_Vendidos'));
	var id_plan_reingresoMinuto 		=($(this).attr('id_plan_reingresoMinuto'));	
	$('#Id_Registro_Minuto').val(id);
	$('#Cantidad_Minutos_Restantes_Plan').val(Cantidad_Minutos_Restantes_Plan);
	$('#Cantidad_Minutos_Vendidos').val(Cantidad_Minutos_Vendidos);
	$('#id_plan_reingresoMinuto').val(id_plan_reingresoMinuto);	
});

$('.Eliminar_Registro').click(function(){
	var comercio_id       					= $('#comercio_id').val();
	var id_plan_reingresoMinuto       		= $('#id_plan_reingresoMinuto').val();	
	var Id_Registro_Minuto       			= $('#Id_Registro_Minuto').val();
	var Cantidad_Minutos_Restantes_Plan     = $('#Cantidad_Minutos_Restantes_Plan').val();
	var Cantidad_Minutos_Vendidos     		= $('#Cantidad_Minutos_Vendidos').val();

	$.ajax({
		url   : "<?= URL::to('Eliminar_Registro_Minutos') ?>",
		type  : "GET",
		async : false,
		data  :{
			'comercio_id'        				: comercio_id,
			'id_plan_reingresoMinuto'  			: id_plan_reingresoMinuto,		
			'Id_Registro_Minuto'  				: Id_Registro_Minuto,
			'Cantidad_Minutos_Restantes_Plan'  	: Cantidad_Minutos_Restantes_Plan,
			'Cantidad_Minutos_Vendidos'  		: Cantidad_Minutos_Vendidos				
		},  
		success:function(re){
			if(re == 0){         
				$('#CuerpoMensaje').html('');
				$("#Eliminar_Registro_VentaMinuto").modal('hide');				 
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Registro Eliminado.</p>');
				$('#CuerpoMensaje').html('<p>El registro de minutos fue Eliminado Exitosamente.</p>'); 
			}
		},
		error:function(re){
			$('#CuerpoMensaje').html('');
			$("#Eliminar_Registro_VentaMinuto").modal('hide'); 
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error al Eliminar el Registro.</p>');  
			$.each(re.errors,function(index, error){       
				$('#CuerpoMensaje').append('<p>'+error+'</p>');          
			});        
		}
	});
});


$('.cerrarMensaje').click(function(){
	Cargar_Tabla_Minutos_Ingresados();	
	cargar_combox();	
	$('#plan_id').val('').selectpicker('refresh');
	$('#id_estilo').hide();
	$('#id_estilo2').hide();
	$('#id_estilo3').hide();
	$('#id_estilo6').hide();
	$('#id_estilo22').hide();	
});

function Cargar_Tabla_Minutos_Ingresados(){
	$.ajax({
		type:'get',
		url:'<?php echo e(url('Cargar_Tabla_Minutos_Ingresados')); ?>',
		success: function(data){      
			$('#tabla_id').empty().html(data);			
		}
	});	
	
}

cargar_combox();
document.getElementById('BtnIngresarMinutos').disabled=true;
document.getElementById('BtnModificarPlan').disabled=true;
document.getElementById('BtnEliminarPlan').disabled=true;				



function Validar_Datos_Nuevo_Plan(){
	var Nombre_Nuevo_Plan				= $('#Nombre_Nuevo_Plan').val();
	var Numero_Nuevo_Plan				= $('#Numero_Nuevo_Plan').val();
	var Cantidad_Minutos_Nuevo_Plan		= $('#Cantidad_Minutos_Nuevo_Plan').val();
	var Cantidad_Minutos_Nuevo_Plan2	= parseInt($('#Cantidad_Minutos_Nuevo_Plan').val());
	var Valor_Venta_Minutos_Nuevo_Plan	= $('#Valor_Venta_Minutos_Nuevo_Plan').val();
	var Valor_Venta_Minutos_Nuevo_Plan2	= parseInt($('#Valor_Venta_Minutos_Nuevo_Plan').val());

	
	if(Nombre_Nuevo_Plan==''){
		document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El nombre del plan no puede estar vacio.";
		document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
		$('#id_estilo').show();	
		document.getElementById("Nombre_Nuevo_Plan").focus();	
		$('#id_estilo').show();	
		return true;
	}else{
		if(Numero_Nuevo_Plan==''){
			document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El numero del plan no puede estar vacio.";
			document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
			$('#id_estilo').show();	
			document.getElementById("Numero_Nuevo_Plan").focus();	
			$('#id_estilo').show();	
			return true;
		}else{
			if(Cantidad_Minutos_Nuevo_Plan==''){
				document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "La cantidad de minutos no puede estar vacio";
				document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
				$('#id_estilo').show();	
				document.getElementById("Cantidad_Minutos_Nuevo_Plan").focus();
				return true;
			}else{											
				if(Cantidad_Minutos_Nuevo_Plan2==0){
					document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "La cantidad de minutos no puede ser igual a 0";
					document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
					document.getElementById("Cantidad_Minutos_Nuevo_Plan").focus();	
					$('#id_estilo').show();	
					return true;
				}else{
					if(Valor_Venta_Minutos_Nuevo_Plan==''){
						document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El valor de venta del minuto no puede estar vacio.";
						document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";
						document.getElementById("Valor_Venta_Minutos_Nuevo_Plan").focus();		
						$('#id_estilo').show();	
						return true;
					}else{
						if(Valor_Venta_Minutos_Nuevo_Plan2==0){
							document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "El valor de venta del minuto no puede ser igual a 0.";
							document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";	
							$('#id_estilo').show();	
							document.getElementById("Valor_Venta_Minutos_Nuevo_Plan").focus();	
							return true;
						}else{
							document.getElementById('BtnConfirmarNuevoPlan').disabled=false;
							document.getElementById("mensaje_valida_datos_nuevo_plan").innerText = "";$('#id_estilo').hide();
							return false;															
						}

					}
				}
			}
		}
	}
}

$('#Btn_modificar_plan_minutos').click(function(){
	if(Validar_editar_plan()!=true){
		$('#confirmar_editar_plan').modal('show');
	}	
});


function Validar_editar_plan(){

	var NombrePlan_Editar 						= $('#NombrePlan_Editar').val();
	var NumeroPlan_Editar						= $('#NumeroPlan_Editar').val();
	var id_plan_modificar						= $('#id_plan_modificar').val();
	
	var CantidadMinutosPlan_Editar 				= $('#CantidadMinutosPlan_Editar').val();
	var CantidadMinutosRestantesPlan_Editar 	= $('#CantidadMinutosRestantesPlan_Editar').val();
	var ValorVentaPlan_Editar 				= $('#ValorVentaPlan_Editar').val();

	var CantidadMinutosPlan_Editar2				= parseInt($('#CantidadMinutosPlan_Editar').val());
	var CantidadMinutosRestantesPlan_Editar2	= parseInt($('#CantidadMinutosRestantesPlan_Editar').val());
	var ValorVentaPlan_Editar2				= parseInt($('#ValorVentaPlan_Editar').val());


	if(NombrePlan_Editar==''){		
		$('#id_estilo6').show();								
		document.getElementById("mensaje_valida_editar").innerText = "El nombre del plan no puede estar vacio.";
		document.getElementById("mensaje_valida_editar").style.display = "block";
		document.getElementById("NombrePlan_Editar").focus();
		return true;	
	}else{
		if(NumeroPlan_Editar==''){			
			$('#id_estilo6').show();								
			document.getElementById("mensaje_valida_editar").innerText = "El número del plan no puede estar vacio.";
			document.getElementById("mensaje_valida_editar").style.display = "block";	
			document.getElementById("NumeroPlan_Editar").focus();
			return true;
		}else{
			if(CantidadMinutosPlan_Editar==''){				
				$('#id_estilo6').show();								
				document.getElementById("mensaje_valida_editar").innerText = "La cantidad no puede estar vacia.";
				document.getElementById("mensaje_valida_editar").style.display = "block";	
				document.getElementById("CantidadMinutosPlan_Editar").focus();
				return true;
			}else{
				if(CantidadMinutosPlan_Editar2<0){					
					$('#id_estilo6').show();								
					document.getElementById("mensaje_valida_editar").innerText = "La cantidad no puede ser menor a 0.";
					document.getElementById("mensaje_valida_editar").style.display = "block";	
					document.getElementById("CantidadMinutosPlan_Editar").focus();
					return true;
				}else{
					if(CantidadMinutosRestantesPlan_Editar==''){						
						$('#id_estilo6').show();								
						document.getElementById("mensaje_valida_editar").innerText = "La cantidad de minutos restantes no puede estar vacio.";
						document.getElementById("mensaje_valida_editar").style.display = "block";
						document.getElementById("CantidadMinutosRestantesPlan_Editar").focus();	
						return true;
					}else{
						if(CantidadMinutosRestantesPlan_Editar<0){							
							$('#id_estilo6').show();								
							document.getElementById("mensaje_valida_editar").innerText = "La cantidad de minutos restantes no puede ser menor a 0.";
							document.getElementById("mensaje_valida_editar").style.display = "block";
							document.getElementById("CantidadMinutosRestantesPlan_Editar").focus();	
							return true;
						}else{
							if(ValorVentaPlan_Editar==''){								
								$('#id_estilo6').show();								
								document.getElementById("mensaje_valida_editar").innerText = "El valor de venta de minutos no puede estar vacio.";
								document.getElementById("mensaje_valida_editar").style.display = "block";
								document.getElementById("ValorVentaPlan_Editar").focus();
								return true;	
							}else{	
								if(ValorVentaPlan_Editar<0){									
									$('#id_estilo6').show();								
									document.getElementById("mensaje_valida_editar").innerText = "El valor del minuto no puede ser menor a 0.";
									document.getElementById("mensaje_valida_editar").style.display = "block";
									document.getElementById("ValorVentaPlan_Editar").focus();	
									return true;
								}else{										
									$('#id_estilo6').hide();								
									document.getElementById("mensaje_valida_editar").innerText = "";
									return false;
								}
							}
						}
					}
				}
			}
		}
	}
}

function Limpiar_data_Despues_de_Registrar_Plan(){
	$('#Numero_Nuevo_Plan').val('');	
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

$('#BtnEliminarPlan').click(function(){
	var plan_id =$('#plan_id').val();	

	$.ajax({
		url   : "<?= URL::to('Consultar_Minutos_Ingresados') ?>",
		type  : "GET",
		async : false,
		data  :{
			'plan_id'             : plan_id			
		},  
		success:function(respuesta){
			$("#Error_al_Eliminar").hide();
			if(respuesta.ErrorAlEliminar!="Tiene Ventas"){
				$('#Eliminar_Plan').modal('show');
			}else{
				$('#Error_al_Eliminar').show();
				$('#Id_Eliminar_Plan').html('<i class="fa fa-phone-square fa-2x" aria-hidden="true"></i> El plan: "'+respuesta.NombrePlanMinutos+'" tiene ventas asociadas, elimine sus ventas y intente de nuevo..'); 
				$("#Id_Eliminar_Plan").css("fontSize", 18);								
				$("#Id_Eliminar_Plan").css("font-weight","Bold"); 
				subir();
				$(document).ready (function(){                              
					$("#Error_al_Eliminar").alert();						    
					$("#Error_al_Eliminar").fadeTo(8000, 500).slideUp(500, function(){
						$("#Error_al_Eliminar").hide();
					});  
				});
			}	
		},
		error:function(respuesta){  
			$("#ModalRegistrar_NuevoPlan").modal('hide');	
			$("#formulario_Registrar_NuevoPlan").modal('hide');		
			$('#CuerpoMensaje').html('');				
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error</p>');
			$('#CuerpoMensaje').html('<p>'+respuesta+'</p>');
		}
	});

});

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
				$('#plan_id').val('').selectpicker('refresh');
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



function Validar_Datos_Formulario_Editar_Ingreso_Minutos(){				

	var MinutosVendidos_MinutosIngresados =parseInt($('#MinutosVendidos_MinutosIngresados').val());
	var MinutosVendidos_MinutosIngresados2 =$('#MinutosVendidos_MinutosIngresados').val();
	var MinutosRestantes_MinutosIngresados =parseInt($('#MinutosRestantes_MinutosIngresados').text());
	var ValorMinuto_MinutosIngresados =parseInt($('#ValorMinuto_MinutosIngresados').text());

	var FechaMinutosVenta_Editar  =$('#FechaMinutosVenta_Editar').val();

	var cantidad_oculta  =$('#cantidad_oculta').val();
	var TotalVenta_MinutosIngresados  =$('#TotalVenta_MinutosIngresados').val();



	if(cantidad_oculta==TotalVenta_MinutosIngresados){
		$('#id_estilo2').hide();
		document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "";		
		document.getElementById('BtnModificarMinutosVendidos').disabled=false;
	}else{				
		if(FechaMinutosVenta_Editar==''){
			$('#id_estilo2').show();
			document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
			document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La fecha no puede estar vacia.";
			document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
			$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
			$('#TotalVenta_MinutosIngresados').val('0');			

		}else{	
			if(MinutosVendidos_MinutosIngresados>MinutosRestantes_MinutosIngresados){		
				$('#id_estilo2').show();
				document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
				document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada es mayor a la cantidad de minutos restantes.";
				document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
				$('#VValor_Total_Minutos_Vendidos_Modificar').text('0');
				$('#TotalVenta_MinutosIngresados').val('0');
				$('#pesos').text('$');
			}else{
				if(MinutosVendidos_MinutosIngresados==0){ 
					$('#id_estilo2').show();
					document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
					document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser igual a 0.";
					document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
					$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
					$('#TotalVenta_MinutosIngresados').val('0');
					$('#pesos').text('$');
				}else{
					if(MinutosVendidos_MinutosIngresados2==''){
						$('#id_estilo2').show();
						document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
						document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede estar vacia.";
						document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
						$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
						$('#TotalVenta_MinutosIngresados').val('0');
						$('#pesos').text('$');
					}else{												
						if(MinutosVendidos_MinutosIngresados>MinutosRestantes_MinutosIngresados){
							$('#id_estilo2').show();
							document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
							document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser mayor a los minutos restantes.";
							document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
							$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
							$('#TotalVenta_MinutosIngresados').val('0');
							$('#pesos').text('$');
						}else{
							if(MinutosVendidos_MinutosIngresados2<0){
								$('#id_estilo2').show();
								document.getElementById('BtnModificarMinutosVendidos').disabled=true;	
								document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "La cantidad ingresada no puede ser menor a 0.";
								document.getElementById("Validar_Cantidad_Minutos_Modificar").style.display = "block";
								$('#Valor_Total_Minutos_Vendidos_Modificar').text('0');
								$('#TotalVenta_MinutosIngresados').val('0');
								$('#pesos').text('$');

							}else{
								document.getElementById("Validar_Cantidad_Minutos_Modificar").innerText = "";
								document.getElementById('BtnModificarMinutosVendidos').disabled=false;
								$('#id_estilo2').hide();
								total=MinutosVendidos_MinutosIngresados2*ValorMinuto_MinutosIngresados;
								$('#TotalVenta_MinutosIngresados').text(ConvertirDecimales(total));
								$('#Valor_Total_Minutos_Vendidosss').val(total);
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
	var Fecha_Ingreso_Minutos =$('#Fecha_Ingreso_Minutoss').val();

	var valor_minuto_plan_registrar =parseInt($('#valor_minuto_plan_registrar').text());

	var total;

	document.getElementById('Cantidad_Minutos_Vendidos_Registrar').focus();

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

var options = $('.PlanesCombobox option');
var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
options.each(function(i, o) {
	o.value = arr[i].v;
	$(o).text(arr[i].t);
});
}
}
});
}

$('.RegistrarIngresoMinutos').click(function(){
	var plan_id = document.getElementById('plan_id').value;	

	$('#Cantidad_Minutos_Vendidos_Registrar').val('1');				
	$('#Valor_Total_Minutos_Vendidos').text('0');
	document.getElementById("Cantidad_Minutos_Vendidos_Registrar").focus();
	$.ajax({
		type:'get',
		data:{
			'plan_id':plan_id
		},
		url:'<?php echo e(url('Consultar_Datos_PlanMinutos')); ?>',

		success: function(data){
			$('#NumeroCelularIngresoMinutos').empty().html(data.NumeroCelularPlan);
			$('#nombre_plan_registrar').empty().html(data.nombre_plan_minutos);
			$('#cantidad_minutos_plan').empty().html(data.cantidad_minutos);
			$('#cantidad_minutos_restantes_plan_registrar').empty().html(data.cantidad_minutos_restantes);
			$('#valor_minuto_plan_registrar').empty().html(data.valor_venta_minutos);
			$('#id_oculto_ingreso_minutos').empty().val(plan_id);

		}
	});
});

// Carga los datos del plan para modificarlo
$('.ModificarPlanMinutos').click(function(){
	var plan_id  = document.getElementById('plan_id').value;
	$.ajax({
		type:'get',		
		data:{
			'plan_id' : plan_id
		},
		url:'<?php echo e(url('DatosPlanModificar')); ?>',
		success: function(data){
			$('#NombrePlan_Editar').empty().val(data.NombrePlan);
			$('#NumeroPlan_Editar').empty().val(data.Numero_Nuevo_Plan);
			$('#NumeroPlan_Oculto_Editar').empty().val(data.Numero_Nuevo_Plan);
			$('#CantidadMinutosPlan_Editar').empty().val(data.cantidad_minutos);
			$('#CantidadMinutosRestantesPlan_Editar').empty().val(data.cantidad_minutos_restantes);
			$('#ValorVentaPlan_Editar').empty().val(data.valor_venta_minutos);
			$('#id_plan_modificar').empty().val(plan_id);
		}
	});	

});



$('.Editar_Plan_Minutoss').click(function(){
	var comercio_id_modificar 					=	$('#comercio_id_modificar').val();	
	var id_plan_modificar 						=	$('#id_plan_modificar').val();	
	var NombrePlan_Editar 						=	$('#NombrePlan_Editar').val();	
	var NumeroPlan_Editar 						=	$('#NumeroPlan_Editar').val();
	var NumeroPlan_Oculto_Editar 				=	$('#NumeroPlan_Oculto_Editar').val();	
	var CantidadMinutosPlan_Editar 				=	$('#CantidadMinutosPlan_Editar').val();	
	var CantidadMinutosRestantesPlan_Editar 	=	$('#CantidadMinutosRestantesPlan_Editar').val();
	var ValorVentaPlan_Editar 					=	$('#ValorVentaPlan_Editar').val();

	$.ajax({
		url   : "<?= URL::to('Modificar_Plan_Minutos') ?>",
		type  : "GET",
		async : false,
		data  :{
			'comercio_id_modificar'             		: comercio_id_modificar,
			'id_plan_modificar'             			: id_plan_modificar,
			'NombrePlan_Editar'             			: NombrePlan_Editar,
			'NumeroPlan_Editar'             			: NumeroPlan_Editar,
			'NumeroPlan_Oculto_Editar'             		: NumeroPlan_Oculto_Editar,
			'CantidadMinutosPlan_Editar'             	: CantidadMinutosPlan_Editar,
			'CantidadMinutosRestantesPlan_Editar'       : CantidadMinutosRestantesPlan_Editar,			
			'ValorVentaPlan_Editar'         			: ValorVentaPlan_Editar
		},  
		success:function(re){
			if(re.success==false){					
				$("#confirmar_editar_plan").modal('hide');	
				$('#id_estilo6').show();
				$.each(re.errors,function(index, error){ 
					$('#mensaje_valida_editar').append('<p><strong>'+error+'</strong></p>');  
				});	  
				document.getElementById("mensaje_valida_editar").style.display = "block";		

			}
			if(re == 0){
				$("#ModalEditarPlanMinutos").modal('hide');	
				$("#formulario_EditarPlanMinutos").modal('hide');
				$("#confirmar_editar_plan").modal('hide');	 
				$('#CuerpoMensaje').html('');					
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Plan Modificado.</p>');
				$('#CuerpoMensaje').html('<p>El plan fue modificado con Exito.!!</p>');
				cargar_combox();
				Limpiar_data_Despues_de_Registrar_Plan();
				$('#plan_id').val('').selectpicker('refresh');
			}

			if(re == 1){         
				$("#confirmar_editar_plan").modal('hide');
				$('#id_estilo6').show();
				$('#mensaje_valida_editar').append('<p><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>ERROR: No se encontró ningún cambio a modificar.</strong></p>');    
				document.getElementById("mensaje_valida_editar").style.display = "block";
			}
			if(re == 2){         
				$("#confirmar_editar_plan").modal('hide');
				$('#id_estilo6').show();
				$('#mensaje_valida_editar').append('<p><strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i>ERROR: El número ingresado esta asociado a otro plan.</strong></p>');    
				document.getElementById("mensaje_valida_editar").style.display = "block";
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

$('#BtnConfirmarNuevoPlan').click(function(){
	if(Validar_Datos_Nuevo_Plan()!=true){		
		$('#registrar_nuevo_plan').modal('show');
	}
});		

$('.RegistrarNuevoPlan').click(function(){

	var Nombre_Nuevo_Plan 					=	$('#Nombre_Nuevo_Plan').val();
	var Numero_Nuevo_Plan 					=	$('#Numero_Nuevo_Plan').val();
	var Cantidad_Minutos_Nuevo_Plan 		=	$('#Cantidad_Minutos_Nuevo_Plan').val();
	var Valor_Venta_Minutos_Nuevo_Plan 		=	$('#Valor_Venta_Minutos_Nuevo_Plan').val();	
	var comercio_id 						=	$('#comercio_id_oculto_nuevo_Plan').val();

	$.ajax({
		url   : "<?= URL::to('Registrar_Nuevo_Plan') ?>",
		type  : "GET",
		async : false,
		data  :{
			'Numero_Nuevo_Plan'             	: Numero_Nuevo_Plan,
			'Nombre_Nuevo_Plan'             	: Nombre_Nuevo_Plan,
			'Cantidad_Minutos_Nuevo_Plan'   	: Cantidad_Minutos_Nuevo_Plan,
			'Valor_Venta_Minutos_Nuevo_Plan'    : Valor_Venta_Minutos_Nuevo_Plan,
			'comercio_id'         				: comercio_id
		},  
		success:function(data){
			$('#mensaje_valida_datos_nuevo_plan').html('');
			if(data.success==false){
				$.each(data.errors,function(index, error){ 
					$('#id_estilo').show();
					$('#mensaje_valida_datos_nuevo_plan').append('<p><strong>'+error+'</strong></p>');    
					document.getElementById("mensaje_valida_datos_nuevo_plan").style.display = "block";
				});  
			}
			if(data == 0){
				$("#ModalRegistrar_NuevoPlan").modal('hide');	
				$("#formulario_Registrar_NuevoPlan").modal('hide');	 
				$('#CuerpoMensaje').html('');					
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Plan Registrado.</p>');
				$('#CuerpoMensaje').html('<p>El plan fue registrado con Exito.!!</p>');
				cargar_combox();
				Limpiar_data_Despues_de_Registrar_Plan();
				$('#plan_id').val('').selectpicker('refresh');
			}	
		},
		error:function(data){  
			$("#ModalRegistrar_NuevoPlan").modal('hide');	
			$("#formulario_Registrar_NuevoPlan").modal('hide');		
			$('#CuerpoMensaje').html('');				
			$('#ModalConfirmacion').modal('show');
			$('#TitleModal').html('<p>Error</p>');
			$('#CuerpoMensaje').html('<p>'+data+'</p>');
		}
	});
});					

$('.RegistrarMinutos').click(function(){

	var Fecha_Ingreso_Minutos 				=	$('#Fecha_Ingreso_Minutoss').val();	
	var id_oculto_ingreso_minutos 			=	$('#id_oculto_ingreso_minutos').val();
	var Cantidad_Minutos_Vendidos_Registrar =	$('#Cantidad_Minutos_Vendidos_Registrar').val();
	var Valor_Total_Minutos_Vendidoss 		=	$('#Valor_Total_Minutos_Vendidoss').val();	
	var Cantidad_Minutos_Restantes			=	$('#cantidad_minutos_restantes_plan_registrar').text();
	var comercio_id 						=	$('#comercio_id').val();							


	$.ajax({
		url   : "<?= URL::to('Registrar_Ingreso_Minutos') ?>",
		type  : "GET",
		async : false,
		data  :{
			'Fecha_Ingreso_Minutos'             	: Fecha_Ingreso_Minutos,
			'id_oculto_ingreso_minutos'             : id_oculto_ingreso_minutos,
			'Cantidad_Minutos_Vendidos_Registrar'   : Cantidad_Minutos_Vendidos_Registrar,
			'Valor_Total_Minutos_Vendidoss'         : Valor_Total_Minutos_Vendidoss,
			'Cantidad_Minutos_Restantes'         	: Cantidad_Minutos_Restantes,
			'comercio_id'             				: comercio_id			

		},  
		success:function(re){
			if(re.success==false){					
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
				$('#plan_id').val('').selectpicker('refresh');
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

$('.ModificarRegistroMinutos').click(function(){
	var comercio_id_oculto       					= $('#comercio_id_oculto').val();					
	var MinutosVendidos_MinutosIngresados   		= $('#MinutosVendidos_MinutosIngresados').val();
	var id_plan_minutos   							= $('#id_plan_minutos').val();
	var id_detalle_plan_minutos   					= $('#id_detalle_plan_minutos').val();
	var cantidad_oculta   						 	= $('#cantidad_oculta').val();
	var MinutosRestantes_MinutosIngresados   		= $('#MinutosRestantes_MinutosIngresados').text();
	var Valor_Total_Minutos_Vendidosss   			= $('#Valor_Total_Minutos_Vendidosss').val();

	$.ajax({
		url   : "<?= URL::to('Modificar_Registro_Minutos') ?>",
		type  : "GET",
		async : false,
		data  :{
			'comercio_id_oculto'        				: comercio_id_oculto,
			'MinutosVendidos_MinutosIngresados'  		: MinutosVendidos_MinutosIngresados,
			'id_plan_minutos'  							: id_plan_minutos,
			'id_detalle_plan_minutos'  					: id_detalle_plan_minutos,
			'cantidad_oculta'  							: cantidad_oculta,
			'MinutosRestantes_MinutosIngresados' 		: MinutosRestantes_MinutosIngresados,
			'Valor_Total_Minutos_Vendidosss' 			: Valor_Total_Minutos_Vendidosss
		},  
		success:function(re){
			if(re == 0){         
				$('#CuerpoMensaje').html('');
				$("#ModalEditar_Registro_Minutos").modal('hide');
				$("#confirm-update2").modal('hide');      
				$('#ModalConfirmacion').modal('show');
				$('#TitleModal').html('<p>Registro Modificado.</p>');
				$('#CuerpoMensaje').html('<p>El registro de minutos fue Modificado Exitosamente.</p>'); 
				$('#plan_id').val('').selectpicker('refresh');
			}

			if(re == 1){
				$("#confirm-update2").modal('hide');
				$('#id_estilo22').show();
				$('#Validar_Cantidad_Minutos_Modificar2').append('<p><strong>No se encontró ningún cambio a modificar.</strong></p>');    
				document.getElementById("Validar_Cantidad_Minutos_Modificar2").style.display = "block";
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
function subir() {
	$("html, body").animate({ scrollTop: 0 }, "slow");
	return false;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>