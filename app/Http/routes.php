<?php

Route::group(['middlewareGroup'=>['web']], function(){
	route::resource('Productos','ControllerProductos\ProductosController');

});
// Rutas del Sistema
Route::any('/', array('as'=>'Index','uses'=>'ControllerUsuarios\UsuariosController@Login'))->middleware('guest');
Route::any('Index', array('as'=>'Index','uses'=>'ControllerIndex\IndexController@Index'))->middleware('auth');
Route::any('Login', array('as'=>'Login','uses'=>'ControllerUsuarios\UsuariosController@Logueo'))->middleware('guest');
Route::any('Salir', array('as'=>'Salir','uses'=>'ControllerUsuarios\UsuariosController@Salir'));
Route::any('Cerrar_Sesion_X_Tiempo', array('as'=>'Cerrar_Sesion_X_Tiempo','uses'=>'ControllerUsuarios\UsuariosController@Cerrar_Sesion_X_Tiempo'));
// Consultar Email Usuario antes de loguearse
Route::any('ConsultarEmail', array('as'=>'ConsultarEmail','uses'=>'ControllerUsuarios\UsuariosController@Consultar_email_Usuario_Logueo'));
// Carga las notificaciones, ultimas ventas y perfil de usuario en div
Route::any('cargar_div', array('as'=>'cargar_div','uses'=>'ControllerIndex\IndexController@CargarBarNotificaciones'));
// Ruta Para Configuracion de la cuenta de usuario
Route::any('account', array('as'=>'account','uses'=>'ControllerUsuarios\UsuariosController@account'))->middleware('auth');
// Ruta consulta los datos de la empresa con Ajax
Route::any('Consultar_Datos_Empresa', array('as'=>'Consultar_Datos_Empresa','uses'=>'ControllerUsuarios\UsuariosController@Consultar_Datos_Empresa'))->middleware('auth');
// Ruta para configuracion de la cuenta de usuario
Route::any('ConfiguracionCuentaComercio', array('as'=>'ConfiguracionCuentaComercio','uses'=>'ControllerUsuarios\UsuariosController@ConfiguracionCuentaComercio'))->middleware('auth');

// Ruta para configuracion de la cuenta de usuario
Route::any('ActualizacionCuentaComercio', array('as'=>'ActualizacionCuentaComercio','uses'=>'ControllerUsuarios\UsuariosController@ActualizacionCuentaComercio'))->middleware('auth');

// Rutas del Sistema

// Rutas Index - Menú Principal
// Cargar Graficas en DIV
Route::any('cargar_grafica_estadistica', array('as'=>'cargar_grafica_estadistica','uses'=>'ControllerIndex\IndexController@Cargar_grafica_estadistica'))->middleware('auth');
// Ruta para cargar las consultas de las ventas en todo el index por fecha
Route::any('consultar_x_Fecha', array('as'=>'consultar_x_Fecha','uses'=>'ControllerIndex\IndexController@Consultar_Ventas_X_Fecha'))->middleware('auth');
// Exportar Reportes excel - BALANCE
Route::any('exportar_report_excel', array('as'=>'exportar_report_excel','uses'=>'ControllerIndex\IndexController@ExportarReportBalanceExcel'))->middleware('auth');
// Exportar Reportes pdf - BALANCE
Route::any('exportar_report_pdf', array('as'=>'exportar_report_pdf','uses'=>'ControllerIndex\IndexController@ExportarReportBalancePdf'))->middleware('auth');

// Ruta Eliminar Excel Archivo Exportado
Route::any('delete_archivo', array('as'=>'delete_archivo','uses'=>'ControllerIndex\IndexController@DeleteExportFile'))->middleware('auth');
// 


//ruta para Index Venta de un Producto
Route::any('RegistrarVenta', array('as'=>'RegistrarVenta','uses'=>'ControllerIndex\IndexController@Cargar_Ventas'))->middleware('auth');

Route::post('cargar_nombres_productos', array('as'=>'cargar_nombres_productos','uses'=>'ControllerProductos\ProductosController@cargar_nombres_productos'))->middleware('auth');


// Ruta para consultar Productos en ultimas ventas hechas

Route::post('Consultar_Producto_x_Busqueda', array('as'=>'Consultar_Producto_x_Busqueda','uses'=>'ControllerProductos\ProductosController@Consultar_Producto_x_Busqueda'))->middleware('auth');
// Carga el Detalle de los productos cuando se selecciona del combox
Route::post('Cargar_detalles_Productos_Venta', array('as'=>'Cargar_detalles_Productos_Venta','uses'=>'ControllerProductos\ProductosController@Cargar_detalles_Productos_Venta'))->middleware('auth');


// Carga formulario cuadraro Ventas Productos
Route::any('Cargar_Ventas_Productos_Cuadrado', array('as'=>'Cargar_Ventas_Productos_Cuadrado','uses'=>'ControllerProductos\ProductosController@Cargar_Ventas_Productos_Cuadrado'))->middleware('auth');


//ruta para Registrar Una Venta de Producto
Route::post('RegistarVentaProducto', array('as'=>'RegistarVentaProducto','uses'=>'ControllerProductos\ProductosController@RegistarVentaProducto'))->middleware('auth');

//ruta para mostrar ultimas Ventas en productos
Route::any('Ultimos_productos_vendidos', array('as'=>'ultimos_productos_vendidos','uses'=>'ControllerProductos\ProductosController@ultimos_productos_vendidos'))->middleware('auth');

//ruta para eliminar ventas de productos
Route::any('Eliminar_Venta_Producto', array('as'=>'Eliminar_Venta_Producto','uses'=>'ControllerProductos\ProductosController@Eliminar_Venta_Producto'))->middleware('auth');
//ruta para eliminar ventas de productos x Fecha
Route::any('Eliminar_Venta_Producto_X_Fecha', array('as'=>'Eliminar_Venta_Producto_X_Fecha','uses'=>'ControllerProductos\ProductosController@Eliminar_Venta_Producto_X_Fecha'))->middleware('auth');
//ruta para eliminar ventas de productos x Fecha Calendario
Route::any('Eliminar_Venta_Producto_X_Fecha_Calendario', array('as'=>'Eliminar_Venta_Producto_X_Fecha_Calendario','uses'=>'ControllerProductos\ProductosController@Eliminar_Venta_Producto_X_Fecha_Calendario'))->middleware('auth');
//ruta para mostrar Ventas de Productos del dia
Route::any('Ultimas_Ventas_Productos', array('as'=>'Ultimas_Ventas_Productos','uses'=>'ControllerProductos\ProductosController@Ultimas_Ventas_Productos'))->middleware('auth');
//ruta cargar ventas en tabla de productos del dia
Route::any('Tabla_Venta_Productos_X_Fecha', array('as'=>'Tabla_Venta_Productos_X_Fecha','uses'=>'ControllerProductos\ProductosController@Tabla_Venta_Productos_X_Fecha'))->middleware('auth');
//ruta cargar ventas en cuadrado de productos x Fecha y del dia
Route::any('ValorVendidoUltimasVentasProductos', array('as'=>'ValorVendidoUltimasVentasProductos','uses'=>'ControllerProductos\ProductosController@ValorVendidoUltimasVentasProductos'))->middleware('auth');
//ruta cargar ventas en cuadrado de productos x Fecha y del dia x Usuario Seleccionado
Route::any('ValorVendidoUltimasVentasProductos_X_usuario', array('as'=>'ValorVendidoUltimasVentasProductos_X_usuario','uses'=>'ControllerProductos\ProductosController@ValorVendidoUltimasVentasProductos_X_usuario'))->middleware('auth');
//ruta cargar ventas en cuadrado de productos x Fecha y del dia 
Route::any('CantidadVendidaProductos', array('as'=>'CantidadVendidaProductos','uses'=>'ControllerProductos\ProductosController@CantidadVendidaProductos'))->middleware('auth');
//ruta cargar ventas en cuadrado de productos x Fecha y del dia  x Usuario Seleccionado
Route::any('CantidadVendidaProductos_X_usuario', array('as'=>'CantidadVendidaProductos_X_usuario','uses'=>'ControllerProductos\ProductosController@CantidadVendidaProductos_X_usuario'))->middleware('auth');
//ruta cargar ventas en cuadrado para buscar por fecha
Route::any('Cuadrado_Venta_Productos_X_BusquedaCalendario', array('as'=>'Cuadrado_Venta_Productos_X_BusquedaCalendario','uses'=>'ControllerProductos\ProductosController@Cuadrado_Venta_Productos_X_BusquedaCalendario'))->middleware('auth');
//ruta Buscar Ventas de Productos x Rango de Fecha
Route::any('Buscar_Venta_Producto_X_Fecha', array('as'=>'Buscar_Venta_Producto_X_Fecha','uses'=>'ControllerProductos\ProductosController@Buscar_Venta_Producto_X_Fecha'))->middleware('auth');
// Ruta Carga Datos en el modal Editar Venta Producto
Route::any('Cargar_datos_Modal_editar_venta_productos', array('as'=>'Cargar_datos_Modal_editar_venta_productos','uses'=>'ControllerProductos\ProductosController@Cargar_datos_Modal_editar_venta_productos'))->middleware('auth');
// Ruta Editar Venta Producto
Route::any('Editar_Venta_Producto', array('as'=>'Editar_Venta_Producto','uses'=>'ControllerProductos\ProductosController@Editar_Venta_Producto'))->middleware('auth');
// Carga el nombre en el combobox - Consultar Producto en ultimas ventas
Route::any('Consultar_Producto_x_Nombre_Usuario', array('as'=>'Consultar_Producto_x_Nombre_Usuario','uses'=>'ControllerProductos\ProductosController@Consultar_Ultimas_Ventas_Producto_x_Nombre_Usuario'))->middleware('auth');
// Carga el nombre de los usuarios que registraron la veenta en el combobox - Consultar Producto en ultimas ventas
Route::any('cargar_nombres_usuarios_ultimas_ventas_productos', array('as'=>'cargar_nombres_usuarios_ultimas_ventas_productos','uses'=>'ControllerProductos\ProductosController@cargar_nombres_usuarios_ultimas_ventas_productos'))->middleware('auth');
//Carga Formulario Venta de Productos
Route::any('Formulario_Venta_Productos', array('as'=>'Formulario_Venta_Productos','uses'=>'ControllerProductos\ProductosController@Formulario_Venta_Productos'))->middleware('auth');

// Administrar Productos
//Ruta Administrar Productos
Route::any('AdministrarProductos', array('as'=>'AdministrarProductos','uses'=>'ControllerProductos\ProductosController@AdministrarProductos'))->middleware('auth');

//Ruta Administrar Productos - Cargar Productos en Tabla
Route::any('Cargar_Productos_En_Administrar', array('as'=>'Cargar_Productos_En_Administrar','uses'=>'ControllerProductos\ProductosController@Cargar_Productos_En_Administrar'))->middleware('auth');

//Ruta Administrar Productos - Cargar Productos en Tabla Consultados
Route::any('Consultar_Producto_Por_ID', array('as'=>'Consultar_Producto_Por_ID','uses'=>'ControllerProductos\ProductosController@Consultar_Producto_Por_ID'))->middleware('auth');
//Ruta Administrar Productos - Consultar Productos a Modificar Productos
Route::any('Consultar_Producto_Modificar', array('as'=>'Consultar_Producto_Modificar','uses'=>'ControllerProductos\ProductosController@Consultar_Producto_Modificar'))->middleware('auth');

//ruta para Registrar Nuevo Producto
Route::any('RegistrarNewProducto', array('as'=>'RegistrarNewProducto','uses'=>'ControllerProductos\ProductosController@RegistrarNewProducto'))->middleware('auth');

//Ruta Administrar Productos - Modificar Productos
Route::any('ModificarProducto', array('as'=>'ModificarProducto','uses'=>'ControllerProductos\ProductosController@ModificarProducto'))->middleware('auth');

// Ruta Eliminar Productos Registrados
Route::any('Eliminar_Productos', array('as'=>'Eliminar_Productos','uses'=>'ControllerProductos\ProductosController@Eliminar_Productos'))->middleware('auth');
// Ruta Exportar Excel Total Productos Registrados
Route::any('Exportar_Excel_Total_Productos', array('as'=>'Exportar_Excel_Total_Productos','uses'=>'ControllerProductos\ProductosController@Exportar_Excel_Total_Productos'))->middleware('auth');
// Ruta Exportar PDF Total Productos Registrados
Route::any('Exportar_PDF_Total_Productos', array('as'=>'Exportar_PDF_Total_Productos','uses'=>'ControllerProductos\ProductosController@Exportar_PDF_Total_Productos'))->middleware('auth');
// Ruta Productos con Poco Stock
Route::any('ProductosConPocoStock', array('as'=>'ProductosConPocoStock','uses'=>'ControllerProductos\ProductosController@ProductosConPocoStock'))->middleware('auth');
// Ruta Carga Vista Productos con Poco Stock
Route::any('Cargar_ProductosConPocoStock', array('as'=>'Cargar_ProductosConPocoStock','uses'=>'ControllerProductos\ProductosController@Cargar_ProductosConPocoStock'))->middleware('auth');

// Consultar Carga la cantidad de productos sin stosck PocoStockProductos
Route::any('CargarCantidadStockAcabarseProducto', array('as'=>'CargarCantidadStockAcabarseProducto','uses'=>'ControllerProductos\ProductosController@CargarCantidadStockAcabarseProducto'))->middleware('auth');

// Termina Administrar Productos



// Ruta Perfil Usuario
Route::any('perfil_user', array('as'=>'perfil_user','uses'=>'ControllerUsuarios\UsuariosController@Cargar_Perfil_Usuario'))->middleware('auth');

Route::any('verifity', array('as'=>'verifity','uses'=>'ControllerUsuarios\UsuariosController@verifity'))->middleware('auth');

// Ruta para notificaciones de stock producto y alimentos
Route::any('Notificaciones_PocoStock', array('as'=>'Notificaciones_PocoStock','uses'=>'ControllerAlimentos\AlimentosController@Notificaciones_PocoStock'))->middleware('auth');





// Alimentos
//Carga Formulario Venta de Alimentos
Route::any('Formulario_Venta_Alimentos', array('as'=>'Formulario_Venta_Alimentos','uses'=>'ControllerAlimentos\AlimentosController@Formulario_Venta_Alimentos'))->middleware('auth');

//ruta para eliminar ventas de productos
Route::any('Eliminar_Venta_Alimento', array('as'=>'Eliminar_Venta_Alimento','uses'=>'ControllerAlimentos\AlimentosController@Eliminar_Venta_Alimento'))->middleware('auth');

// Cargar Nombre de alimentos en la venta en el combox
Route::post('cargar_nombres_alimentos', array('as'=>'cargar_nombres_alimentos','uses'=>'ControllerAlimentos\AlimentosController@cargar_nombres_alimentos'))->middleware('auth');

// Carga el Detalle de los productos cuando se selecciona del combox
Route::post('Cargar_detalles_Alimentos_Venta', array('as'=>'Cargar_detalles_Alimentos_Venta','uses'=>'ControllerAlimentos\AlimentosController@Cargar_detalles_Alimentos_Venta'))->middleware('auth');
// Registrar venta de alimentos
Route::post('RegistrarVentaAlimentos', array('as'=>'RegistrarVentaAlimentos','uses'=>'ControllerAlimentos\AlimentosController@RegistrarVentaAlimentos'))->middleware('auth');

//ruta para mostrar ultimas Ventas en Alimentos
Route::any('Ultimos_alimentos_vendidos', array('as'=>'Ultimos_alimentos_vendidos','uses'=>'ControllerAlimentos\AlimentosController@Ultimos_alimentos_vendidos'))->middleware('auth');

//ruta para mostrar Ventas de Alimentos del dia
Route::any('Ultimas_Ventas_Alimentos', array('as'=>'Ultimas_Ventas_Alimentos','uses'=>'ControllerAlimentos\AlimentosController@Ultimas_Ventas_Alimentos'))->middleware('auth');

//ruta cargar consultas ventas en tabla de Alimentos del dia
Route::any('Tabla_Venta_Alimentos_X_Fecha', array('as'=>'Tabla_Venta_Alimentos_X_Fecha','uses'=>'ControllerAlimentos\AlimentosController@Tabla_Venta_Alimentos_X_Fecha'))->middleware('auth');

//ruta cargar consultas ventas en cuadrado de alimentos del dia
Route::any('Ultimas_Ventas_Alimentoss_TotalVendido', array('as'=>'Ultimas_Ventas_Alimentoss_TotalVendido','uses'=>'ControllerAlimentos\AlimentosController@Ultimas_Ventas_Alimentoss_TotalVendido'))->middleware('auth');

// Ruta Carga Datos en el modal Editar Venta Alimento
Route::any('Cargar_datos_Modal_editar_venta_alimentos', array('as'=>'Cargar_datos_Modal_editar_venta_alimentos','uses'=>'ControllerAlimentos\AlimentosController@Cargar_datos_Modal_editar_venta_alimentos'))->middleware('auth');

// Ruta Editar Venta Alimento
Route::any('Editar_Venta_Alimento', array('as'=>'Editar_Venta_Alimento','uses'=>'ControllerAlimentos\AlimentosController@Editar_Venta_Alimento'))->middleware('auth');

//ruta para eliminar ventas de alimentos x Fecha
Route::any('Eliminar_Venta_Alimento_X_Fecha', array('as'=>'Eliminar_Venta_Alimento_X_Fecha','uses'=>'ControllerAlimentos\AlimentosController@Eliminar_Venta_Alimento_X_Fecha'))->middleware('auth');

// Consultar Alimento en ultimas ventas
Route::any('Consultar_Alimento_x_Busqueda', array('as'=>'Consultar_Alimento_x_Busqueda','uses'=>'ControllerAlimentos\AlimentosController@Consultar_Alimento_x_Busqueda'))->middleware('auth');

// Consultar Carga la cantidad de alimentos sin stosck PocoStockAlimentos
Route::any('CargarCantidadStockAcabarseAlimento', array('as'=>'CargarCantidadStockAcabarseAlimento','uses'=>'ControllerAlimentos\AlimentosController@CargarCantidadStockAcabarseAlimento'))->middleware('auth');

// Ruta para cargar la cantidad de alimentos vendidos en ultimas ventas Alimentos
Route::any('CantidadVendidaAlimentos', array('as'=>'CantidadVendidaAlimentos','uses'=>'ControllerAlimentos\AlimentosController@CantidadVendidaAlimentos'))->middleware('auth');
// Ruta para cargar la cantidad de alimentos vendidos en ultimas ventas Alimentos  x Usuario Seleccionado
Route::any('CantidadVendidaAlimentoss_X_usuario', array('as'=>'CantidadVendidaAlimentoss_X_usuario','uses'=>'ControllerAlimentoss\AlimentossController@CantidadVendidaAlimentoss_X_usuario'))->middleware('auth');


// Administrar Alimentos
//Ruta Administrar Alimentos
Route::any('AdministrarAlimentos', array('as'=>'AdministrarAlimentos','uses'=>'ControllerAlimentos\AlimentosController@AdministrarAlimentos'))->middleware('auth');

//Ruta Administrar Alimentos - Cargar Productos en Tabla
Route::any('Cargar_Alimentos_En_Administrar', array('as'=>'Cargar_Alimentos_En_Administrar','uses'=>'ControllerAlimentos\AlimentosController@Cargar_Alimentos_En_Administrar'))->middleware('auth');

//Ruta Administrar Alimentos - Cargar Alimentos en Tabla Consultados
Route::any('Consultar_Alimento_Por_ID', array('as'=>'Consultar_Alimento_Por_ID','uses'=>'ControllerAlimentos\AlimentosController@Consultar_Alimento_Por_ID'))->middleware('auth');
//Ruta Administrar Alimentos - Consultar Alimentos a Modificar Alimentos
Route::any('Consultar_Alimento_Modificar', array('as'=>'Consultar_Alimento_Modificar','uses'=>'ControllerAlimentos\AlimentosController@Consultar_Alimento_Modificar'))->middleware('auth');

//ruta para Registrar Nuevo Alimento
Route::any('RegistrarNewAlimento', array('as'=>'RegistrarNewAlimento','uses'=>'ControllerAlimentos\AlimentosController@RegistrarNewAlimento'))->middleware('auth');

//Ruta Administrar Alimentos - Modificar Alimentos
Route::any('ModificarAlimento', array('as'=>'ModificarAlimento','uses'=>'ControllerAlimentos\AlimentosController@ModificarAlimento'))->middleware('auth');

// Ruta Eliminar Alimentos Registrados
Route::any('Eliminar_Alimentos', array('as'=>'Eliminar_Alimentos','uses'=>'ControllerAlimentos\AlimentosController@Eliminar_Alimentos'))->middleware('auth');
// Ruta Exportar Excel Total Alimentos Registrados
Route::any('Exportar_Excel_Total_Alimentos', array('as'=>'Exportar_Excel_Total_Alimentos','uses'=>'ControllerAlimentos\AlimentosController@Exportar_Excel_Total_Alimentos'))->middleware('auth');
// Ruta Exportar PDF Total Alimentos Registrados
Route::any('Exportar_PDF_Total_Alimentos', array('as'=>'Exportar_PDF_Total_Alimentos','uses'=>'ControllerAlimentos\AlimentosController@Exportar_PDF_Total_Alimentos'))->middleware('auth');
// Ruta Alimentos con Poco Stock
Route::any('AlimentosConPocoStock', array('as'=>'AlimentosConPocoStock','uses'=>'ControllerAlimentos\AlimentosController@AlimentosConPocoStock'))->middleware('auth');
// Ruta Carga Vista Alimentos con Poco Stock
Route::any('Cargar_AlimentosConPocoStock', array('as'=>'Cargar_AlimentosConPocoStock','uses'=>'ControllerAlimentos\AlimentosController@Cargar_AlimentosConPocoStock'))->middleware('auth');
// Ruta para cargar los nombres de los usuarios que han vendido algun alimento en ultimas ventas
Route::any('cargar_nombres_usuarios_ultimas_ventas_alimentos', array('as'=>'cargar_nombres_usuarios_ultimas_ventas_alimentos','uses'=>'ControllerAlimentos\AlimentosController@cargar_nombres_usuarios_ultimas_ventas_alimentos'))->middleware('auth');

// Carga el nombre en el combobox - Consultar Alimento en ultimas ventas
Route::any('Consultar_Ultimas_Ventas_Alimento_x_Nombre_Usuario', array('as'=>'Consultar_Ultimas_Ventas_Alimento_x_Nombre_Usuario','uses'=>'ControllerAlimentos\AlimentosController@Consultar_Ultimas_Ventas_Alimento_x_Nombre_Usuario'))->middleware('auth');

// Carga la cantidad vendida de alimentos x usuario en ultimas ventas alimentos
Route::any('CantidadVendidaAlimentos_X_usuario', array('as'=>'CantidadVendidaAlimentos_X_usuario','uses'=>'ControllerAlimentos\AlimentosController@CantidadVendidaAlimentos_X_usuario'))->middleware('auth');

// Carga el valor vendida de alimentos x usuario en ultimas ventas alimentos
Route::any('ValorVendidoUltimasVentasAlimentos_X_usuario', array('as'=>'ValorVendidoUltimasVentasAlimentos_X_usuario','uses'=>'ControllerAlimentos\AlimentosController@ValorVendidoUltimasVentasAlimentos_X_usuario'))->middleware('auth');
// Termina Administrar Alimentos

// Comienzan las consultas de Venta de productos
Route::any('ConsultarVentaProducto', array('as'=>'ConsultarVentaProducto','uses'=>'ControllerProductos\ProductosController@ConsultarVentaProducto'))->middleware('auth');
// Terminan Las consultas de  Venta de productos


// Ruta para todo de Minutos
Route::any('AdministrarPlanes', array('as'=>'AdministrarPlanes','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@AdministrarPlanes'))->middleware('auth');
// Carga los nombres de los planes de minutos
Route::any('Cargar_Nombre_Planes', array('as'=>'Cargar_Nombre_Planes','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@cargar_nombres_planes_combox'))->middleware('auth');
// Carga todos los datos del plan de minutos para ingresar los minutos vendidos
Route::any('Consultar_Datos_PlanMinutos', array('as'=>'Consultar_Datos_PlanMinutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Consultar_Datos_PlanMinutos'))->middleware('auth');
// Ruta Para registrar los minutos vendidos del plan seleccionado
Route::any('Registrar_Ingreso_Minutos', array('as'=>'Registrar_Ingreso_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Registrar_Ingreso_Minutos'))->middleware('auth');

// Ruta Para registrar los minutos vendidos del plan seleccionado
Route::any('Cargar_Tabla_Minutos_Ingresados', array('as'=>'Cargar_Tabla_Minutos_Ingresados','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Cargar_Tabla_Minutos_Ingresados'))->middleware('auth');

// Ruta para cargar los datos por ajax para editar los minutos registrados anteriormente
Route::any('Cargar_datos_Minutos_Ingresados', array('as'=>'Cargar_datos_Minutos_Ingresados','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Cargar_datos_Minutos_Ingresados'))->middleware('auth');
// Ruta para modificar el valor de los minutos vendidos
Route::any('Modificar_Registro_Minutos', array('as'=>'Modificar_Registro_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Modificar_Registro_Minutos'))->middleware('auth');
// Ruta para eliminar el registro de los minutos vendidos
Route::any('Eliminar_Registro_Minutos', array('as'=>'Eliminar_Registro_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Eliminar_Registro_Minutos'))->middleware('auth');
// Ruta para Registrar Nuevos Planes
Route::any('Registrar_Nuevo_Plan', array('as'=>'Registrar_Nuevo_Plan','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Registrar_Nuevo_Plan'))->middleware('auth');
// Ruta Para Cargar Los datos de plan a modificar
Route::any('DatosPlanModificar', array('as'=>'DatosPlanModificar','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@DatosPlanModificar'))->middleware('auth');
// Ruta Para Cargar Los datos de plan a modificar
Route::any('DatosPlanModificar', array('as'=>'DatosPlanModificar','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@DatosPlanModificar'))->middleware('auth');
// Ruta modificar un plan seleccionado
Route::any('Modificar_Plan_Minutos', array('as'=>'Modificar_Plan_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Modificar_Plan_Minutos'))->middleware('auth');
// Ruta para consultar si hay un venta de minutos registrada antes de eliminarla
Route::any('Consultar_Minutos_Ingresados', array('as'=>'Consultar_Minutos_Ingresados','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Consultar_Minutos_Ingresados'))->middleware('auth');
// Ruta para Eliminar un plan de minutos registrado
Route::any('Eliminar_Plan_Minutos', array('as'=>'Eliminar_Plan_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Eliminar_Plan_Minutos'))->middleware('auth');
// Ruta para consultar la venta de minutos si existe antes de ingresar una nueva.
Route::any('Consultar_Venta_Minutos', array('as'=>'Consultar_Venta_Minutos','uses'=>'ControllerPlanesMinutos\AdministrarPlanesMinutosController@Consultar_Venta_Minutos'))->middleware('auth');
// Terminan Ruta para todo de Minutos
// Empienzan Rutas para Modulo de recargas
Route::any('AdministrarRecargas', array('as'=>'AdministrarRecargas','uses'=>'ControllerRecargas\AdministrarRecargasController@AdministrarRecargas'))->middleware('auth');
// Ruta Para cargar el listado de recargas elaboradas del dia
Route::any('Cargar_Tabla_Recargas_Ingresados', array('as'=>'Cargar_Tabla_Recargas_Ingresados','uses'=>'ControllerRecargas\AdministrarRecargasController@Cargar_Tabla_Recargas_Ingresados'))->middleware('auth');
// Ruta Para cargar los nombres de las categorias de recargas
Route::any('Listar_Categorias', array('as'=>'Listar_Categorias','uses'=>'ControllerRecargas\AdministrarRecargasController@Listar_Categorias'))->middleware('auth');
// Ruta para registrar Nueva Categoria
Route::any('Registrar_Nueva_Categoria', array('as'=>'Registrar_Nueva_Categoria','uses'=>'ControllerRecargas\AdministrarRecargasController@Registrar_Nueva_Categoria'))->middleware('auth');
// Ruta para consultar el nombre de la categoria para modificarse
Route::any('Consultar_Categoria', array('as'=>'Consultar_Categoria','uses'=>'ControllerRecargas\AdministrarRecargasController@Consultar_Categoria'))->middleware('auth');
// Ruta para Editar una categoria
Route::any('Editar_Categoria', array('as'=>'Editar_Categoria','uses'=>'ControllerRecargas\AdministrarRecargasController@Editar_Categoria'))->middleware('auth');
// Ruta para Eliminar una categoria
Route::any('Eliminar_Categoria', array('as'=>'Eliminar_Categoria','uses'=>'ControllerRecargas\AdministrarRecargasController@Eliminar_Categoria'))->middleware('auth');
// Ruta para Registrar Una venta de Recargas
Route::any('Registrar_Venta_Recarga', array('as'=>'Registrar_Venta_Recarga','uses'=>'ControllerRecargas\AdministrarRecargasController@Registrar_Venta_Recarga'))->middleware('auth');
// Ruta Para eliminar una venta de Recargas
Route::any('Eliminar_Venta_Recarga', array('as'=>'Eliminar_Venta_Recarga','uses'=>'ControllerRecargas\AdministrarRecargasController@Eliminar_Venta_Recarga'))->middleware('auth');
// Ruta para Modificar una venta de Recargas
Route::any('Modificar_Venta_Recarga', array('as'=>'Modificar_Venta_Recarga','uses'=>'ControllerRecargas\AdministrarRecargasController@Modificar_Venta_Recarga'))->middleware('auth');
// Termina Modulo de Recargas

// Empieza Modulo de Internet
Route::any('AdministrarInternet', array('as'=>'AdministrarInternet','uses'=>'ControllerInternet\AdministrarInternetController@AdministrarInternet'))->middleware('auth');
// Ruta para cargar las ventas del dia de internet en tabla
Route::any('Cargar_Tabla_Ventas_Internet', array('as'=>'Cargar_Tabla_Ventas_Internet','uses'=>'ControllerInternet\AdministrarInternetController@Cargar_Tabla_Ventas_Internet'))->middleware('auth');
// Ruta para registrar Venta de Internet
Route::any('Registrar_Venta_Internet', array('as'=>'Registrar_Venta_Internet','uses'=>'ControllerInternet\AdministrarInternetController@Registrar_Venta_Internet'))->middleware('auth');
// Ruta para Eliminar Venta de Internet
Route::any('Eliminar_Venta_Internet', array('as'=>'Eliminar_Venta_Internet','uses'=>'ControllerInternet\AdministrarInternetController@Eliminar_Venta_Internet'))->middleware('auth');
// Ruta Para Editar Venta de Internet
Route::any('Editar_Venta_Internet', array('as'=>'Editar_Venta_Internet','uses'=>'ControllerInternet\AdministrarInternetController@Editar_Venta_Internet'))->middleware('auth');
// Termina Modulo de Internet
// Empieza Modulo de Compras
Route::any('AdministrarCompras', array('as'=>'AdministrarCompras','uses'=>'ControllerCompras\AdministrarComprasController@AdministrarCompras'))->middleware('auth');
// Ruta para cargar todas las compras del dia en una tabla
Route::any('Cargar_Tabla_Compras', array('as'=>'Cargar_Tabla_Compras','uses'=>'ControllerCompras\AdministrarComprasController@Cargar_Tabla_Compras'))->middleware('auth');
// Ruta para registrar compra
Route::any('Registrar_Compra', array('as'=>'Registrar_Compra','uses'=>'ControllerCompras\AdministrarComprasController@Registrar_Compra'))->middleware('auth');
// Ruta para Editar Compra
Route::any('Editar_Compra', array('as'=>'Editar_Compra','uses'=>'ControllerCompras\AdministrarComprasController@Editar_Compra'))->middleware('auth');
// Ruta para Eliminar Compra
Route::any('Eliminar_Compra', array('as'=>'Eliminar_Compra','uses'=>'ControllerCompras\AdministrarComprasController@Eliminar_Compra'))->middleware('auth');
// Termina Modulo De Compras
// EMPIEZA MODULO GASTOS & INVERSION
// Ruta para cargar Index Gastos & Inversion
Route::any('AdministrarGastosInversion', array('as'=>'AdministrarGastosInversion','uses'=>'ControllerGastosInversion\AdministrarGastosInversionController@AdministrarGastos'))->middleware('auth');
// Ruta para cargar Gastos en Tabla
Route::any('Cargar_Tabla_Gastos', array('as'=>'Cargar_Tabla_Gastos','uses'=>'ControllerGastosInversion\AdministrarGastosInversionController@Cargar_Tabla_Gastos'))->middleware('auth');
// Ruta Para Registrar Gasto
Route::any('Registrar_Gasto', array('as'=>'Registrar_Gasto','uses'=>'ControllerGastosInversion\AdministrarGastosInversionController@Registrar_Gasto'))->middleware('auth');
// Ruta Para Eliminar Gasto
Route::any('Eliminar_Gasto', array('as'=>'Eliminar_Gasto','uses'=>'ControllerGastosInversion\AdministrarGastosInversionController@Eliminar_Gasto'))->middleware('auth');
// Ruta Para Editar Gasto
Route::any('Editar_Gasto', array('as'=>'Editar_Gasto','uses'=>'ControllerGastosInversion\AdministrarGastosInversionController@Editar_Gasto'))->middleware('auth');
// TERMINA MODULO GASTO INVERSION






// Si no no existe la ruta va a la vista error
Route::any('{catchall}', function() {
	return Response::view('errors.503',array(),503);
})->where('catchall', '.*')->middleware('auth');



