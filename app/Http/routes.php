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
// Rutas del Sistema

// Rutas Index - Menú Principal
// Cargar Graficas en DIV
Route::any('cargar_grafica_estadistica', array('as'=>'cargar_grafica_estadistica','uses'=>'ControllerIndex\IndexController@Cargar_grafica_estadistica'))->middleware('auth');
// Ruta para cargar las consultas de las ventas en todo el index por fecha
Route::any('consultar_x_Fecha', array('as'=>'consultar_x_Fecha','uses'=>'ControllerIndex\IndexController@Consultar_Ventas_X_Fecha'))->middleware('auth');
// 


//ruta para Index Venta de un Producto
Route::any('RegistrarVenta', array('as'=>'RegistrarVenta','uses'=>'ControllerIndex\IndexController@Cargar_Ventas'))->middleware('auth');

Route::post('cargar_nombres_productos', array('as'=>'cargar_nombres_productos','uses'=>'ControllerProductos\ProductosController@cargar_nombres_productos'))->middleware('auth');


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
Route::any('Ventas_Productos_X_Fecha', array('as'=>'Ventas_Productos_X_Fecha','uses'=>'ControllerProductos\ProductosController@Ventas_Productos_X_Fecha'))->middleware('auth');
//ruta cargar ventas en tabla de productos del dia
Route::any('Tabla_Venta_Productos_X_Fecha', array('as'=>'Tabla_Venta_Productos_X_Fecha','uses'=>'ControllerProductos\ProductosController@Tabla_Venta_Productos_X_Fecha'))->middleware('auth');
//ruta cargar ventas en cuadrado de productos x Fecha y del dia
Route::any('Cuadrado_Venta_Productos_X_Fecha', array('as'=>'Cuadrado_Venta_Productos_X_Fecha','uses'=>'ControllerProductos\ProductosController@Cuadrado_Venta_Productos_X_Fecha'))->middleware('auth');
//ruta cargar ventas en cuadrado para buscar por fecha
Route::any('Cuadrado_Venta_Productos_X_BusquedaCalendario', array('as'=>'Cuadrado_Venta_Productos_X_BusquedaCalendario','uses'=>'ControllerProductos\ProductosController@Cuadrado_Venta_Productos_X_BusquedaCalendario'))->middleware('auth');
//ruta Buscar Ventas de Productos x Rango de Fecha
Route::any('Buscar_Venta_Producto_X_Fecha', array('as'=>'Buscar_Venta_Producto_X_Fecha','uses'=>'ControllerProductos\ProductosController@Buscar_Venta_Producto_X_Fecha'))->middleware('auth');
// Ruta Carga Datos en el modal Editar Venta Producto
Route::any('Cargar_datos_Modal_editar_venta_productos', array('as'=>'Cargar_datos_Modal_editar_venta_productos','uses'=>'ControllerProductos\ProductosController@Cargar_datos_Modal_editar_venta_productos'))->middleware('auth');
// Ruta Editar Venta Producto
Route::any('Editar_Venta_Producto', array('as'=>'Editar_Venta_Producto','uses'=>'ControllerProductos\ProductosController@Editar_Venta_Producto'))->middleware('auth');
// Consultar Producto en ultimas ventas
Route::any('Consultar_Producto_x_Busqueda', array('as'=>'Consultar_Producto_x_Busqueda','uses'=>'ControllerProductos\ProductosController@Consultar_Producto_x_Busqueda'))->middleware('auth');
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
Route::any('Ventas_Alimentos_X_Fecha', array('as'=>'Ventas_Alimentos_X_Fecha','uses'=>'ControllerAlimentos\AlimentosController@Ventas_Alimentos_X_Fecha'))->middleware('auth');

//ruta cargar consultas ventas en tabla de Alimentos del dia
Route::any('Tabla_Venta_Alimentos_X_Fecha', array('as'=>'Tabla_Venta_Alimentos_X_Fecha','uses'=>'ControllerAlimentos\AlimentosController@Tabla_Venta_Alimentos_X_Fecha'))->middleware('auth');

//ruta cargar consultas ventas en cuadrado de alimentos del dia
Route::any('Cuadrado_Venta_Alimentos_X_Fecha', array('as'=>'Cuadrado_Venta_Alimentos_X_Fecha','uses'=>'ControllerAlimentos\AlimentosController@Cuadrado_Venta_Alimentos_X_Fecha'))->middleware('auth');

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

// Termina Administrar Productos












// Si no no existe la ruta va a la vista error
Route::any('{catchall}', function() {
	return Response::view('errors.503',array(),503);
})->where('catchall', '.*')->middleware('auth');



