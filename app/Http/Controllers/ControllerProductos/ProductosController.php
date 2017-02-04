<?php

namespace App\Http\Controllers\ControllerProductos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Productos\Producto;
use App\Models\Alimentos\Alimento;
use App\Models\Usuarios\Empresa;
use App\Models\Productos\VentaProducto;
use Control_5_3\Models\Cargo\Cargo;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Carbon\Carbon;
use File;
use Excel;
use PHPExcel_Style_Alignment;
use App;
use PDF;




class ProductosController extends Controller{


  public function __construct(){
    Carbon::setLocale('es');

  } 

  public function Actualizar_Total_Inversion_Productos(){
    $Productos=Producto::all();
    $id_comercio=Auth::user()->id_comercio; 
    foreach ($Productos as $key => $value) {

     $id=$value->id;
     $cantidad_producto=$value->cantidad_producto;
     $valor_inversion_producto=$value->valor_inversion_producto;     

     $ValorTotalInversion=$cantidad_producto*$valor_inversion_producto;

     $productos = array(
      'valor_total_inversion'               => $ValorTotalInversion         
      );

     $check = DB::table('producto_producto')
     ->where('id',$id)
     ->where('id_comercio',$id_comercio)
     ->update($productos);

   }
 }

 public function CargarCantidadStockAcabarseProducto(){
  $NotificacionProductos=Producto::Where('cantidad_producto','<=',3)->count();

  if($NotificacionProductos==0){
    $NotificacionProductos=0;
  }

  return $NotificacionProductos;

}

public function ProductosConPocoStock(){

  $Productos=Producto::Where('cantidad_producto','<=',3)
  ->orderBy('nombre_producto','asc')->paginate(9);  

  return view('Administrar/Productos/Tablas.Tabla_Administrar_Productos_Poco_Stock')->with('Productos',$Productos);
}

public function Cargar_ProductosConPocoStock(){

    // $NotificacionProductos=Producto::Where('cantidad_producto','<=',3)->count();
    // $NotificacionAlimentos=Alimento::Where('cantidad_alimento','<=',3)->count();

  return view('Administrar/Productos/Poco_Stock/Poco_Stock_Productos');
    // ->with('NotificacionProductos',$NotificacionProductos)
    // ->with('NotificacionAlimentos',$NotificacionAlimentos);
}

public function  Exportar_PDF_Total_Productos(){
  $id_comercio=Auth::user()->id_comercio; 
  $nombreArchivo='Comercio_ID:'.$id_comercio.'-Listado Productos';

  $Productos=Producto::Where('id_comercio',$id_comercio)
  ->orderBy('nombre_producto','asc')->get(); 


  $id_usuario_logueado=Auth::user()->id;

  $nombre_empresa=Empresa::where('comercio_id',$id_comercio)->get();

  foreach ($nombre_empresa as $key => $value) {
    $nombre_empresa=$value->nombre_empresa;
  }     

  $TotalInversion=DB::table('producto_producto')
  ->where('id_comercio',$id_comercio)
  ->sum('valor_total_inversion');
  $TotalInversion=number_format($TotalInversion); 

  $pdf = App::make('dompdf.wrapper');
    // $pdf->loadHTML('<h1>Test</h1>');

  $pdf = PDF::loadView('Administrar/Productos/Reporte_PDF/Reporte_PDF_Total_Productos',compact('Productos','nombre_empresa','TotalInversion'))->setPaper('letter', 'landscape');

     // $pdf = PDF::loadView('Administrar/Productos/Reporte_PDF/Reporte_PDF_Total_Productos',compact('Productos','nombre_empresa'))->setPaper('letter', 'portrait');
  return $pdf->download($nombreArchivo.'.pdf');
}

public function Exportar_Excel_Total_Productos(){
 $id_comercio=Auth::user()->id_comercio; 


 $Productos = DB::table('producto_producto')
 ->where('id_comercio',$id_comercio)
 ->orderBy('nombre_producto','asc')   
 ->get();

 $TotalInversion=DB::table('producto_producto')
 ->where('id_comercio',$id_comercio)
 ->sum('valor_total_inversion');
 $TotalInversion=number_format($TotalInversion); 

 $TotalProductos= Producto::Where('id_comercio',$id_comercio)
 ->count('id');   
 $TotalProductos=number_format($TotalProductos);

 $nombreArchivo='Comercio_ID:'.$id_comercio.'-Listado Productos';

 Excel::create($nombreArchivo, function($excel) use($Productos,$TotalInversion,$TotalProductos) {
    // Título
  $excel->setTitle('Listado de Productos');
    // $excel->setOrientation('landscape');

  $excel->sheet('Página 1', function($sheet) use($Productos,$TotalInversion,$TotalProductos) {
    $data = [];
    $sheet->setFontFamily('Comic Sans MS');
    $sheet->setFontSize(15);

    $style = array(
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )          
      );


    $sheet->getDefaultStyle()->applyFromArray($style);  
    $sheet->mergeCells('A1:E1');
      // $sheet->setBackground('#000000');

    array_push($data, ['Listado de Productos Registrados']);  
    array_push($data, ['']);  
    array_push($data, ['Nombre Producto','Stock', 'Valor Venta','Valor Inversión', 'Valor Total']);
    foreach ($Productos as $key => $value) {

     $Valor_Inversion=number_format($value->valor_total_inversion); 
     $Valor_Venta=number_format($value->valor_venta_producto);
     $Valor_Inversion_Total=number_format($value->valor_inversion_producto);


       // $sheet->setColumnFormat(array(
       //  'B4:E4' => '0000'
       //  ));
     array_push($data, [(string) $value->nombre_producto,(string) $value->cantidad_producto,(string) '$'.$Valor_Venta, (string) '$'.$Valor_Inversion_Total , (string) '$'.$Valor_Inversion]);
   }
   array_push($data, ['']);    
   array_push($data, ['','', '','Total Inversion:','$'.$TotalInversion]);
   array_push($data, ['','', '','Total Productos:',$TotalProductos]);



   $sheet->fromArray($data, null, 'A1', false, false);
   $sheet->setStyle(array(
    'font' => array(
      'name'      =>  'Tahoma',
      'size'      =>  12,
      'bold'      =>  false
      )
    ));
 });
})->export('xlsx');

}

public function Consultar_Producto_Modificar(){
  $Id_productoEditar=Input::get('Id_productoEditar');

  $Productos=Producto::Where('id',$Id_productoEditar)->get();

  foreach ($Productos  as $resultado) {      

    $id_producto_editarr=$resultado->id;
    $nombre_producto=$resultado->nombre_producto;
    $stock=$resultado->cantidad_producto;
    $valor_venta_producto=$resultado->valor_venta_producto; 
    $valor_inversion_producto=$resultado->valor_inversion_producto; 
    $valor_total_inversion=$resultado->valor_total_inversion; 
    $ruta_imagen_producto=$resultado->ruta_imagen_producto;   
  }


  if($ruta_imagen_producto==null){
    $ruta_imagen_producto="No Disponible";
  }

  return Response::json([
   'id_producto_editarr'=>$id_producto_editarr,
   'nombre_producto'=>$nombre_producto,
   'stock'=>$stock,
   'valor_venta_producto'=>$valor_venta_producto,
   'valor_inversion_producto'=>$valor_inversion_producto,
   'valor_total_inversion'=>$valor_total_inversion,
   'ruta_imagen_producto'=>$ruta_imagen_producto]);

} 

public function ModificarProducto(){

 $rules = array
 (
  'nombre_producto_editar'   => 'required|min:3',
  'cantidad_producto_editar'   => 'required|min:1|numeric',
  'valor_inversion_producto_editar'   => 'required|numeric',
  'valor_venta_producto_editar' => 'required|numeric',
  'valor_total_inversion_editar' => 'required|numeric',
  'imagenProducto_editar' => 'max:2000|mimes:jpg,jpeg,png',     
  );

 $message = array
 (
  'nombre_producto_editar.required'          => ' Porfavor Ingrese un nombre de producto.',
  'nombre_producto_editar.min'               => ' El campo Nombre Producto es de minimo 3 caracteres.',
  'cantidad_producto_editar.required'        => ' Porfavor Ingrese una Cantidad.',
  'cantidad_producto_editar.min'             => ' El campo Cantidad es de minimo 1 caracteres.',
  'cantidad_producto_editar.numeric'         => ' El campo Cantidad es numerico.',      
  'valor_inversion_producto_editar.required' => ' Porfavor Ingrese el valor Inversión.',
  'valor_inversion_producto_editar.numeric'  => ' El campo Valor Inversión es numerico.',
  'valor_venta_producto_editar.required'     => ' Porfavor Ingrese el valor Total de Inversion.',
  'valor_venta_producto_editar.numeric'      => ' El campo Valor Inversion debe ser Numerico.',

  'valor_total_inversion_editar.required'     => ' Porfavor Ingrese el valor de Total de la Inversion.',

  'valor_total_inversion_editar.numeric'      => ' El campo Valor Total de la Inversion debe ser Numerico.',

  'imagenProducto_editar.max'                => 'El tamaño maximo debe la imagen es de 1 MB.',
  'imagenProducto_editar.mimes'              => 'El archivo que pretendes subir, no es una imagen.',
  );


 $validator = Validator::make(Input::All(), $rules, $message);
 if ($validator->fails()) {

  return Response::json(['error' =>false,
    'errors'=>$validator->errors()->toArray()]);
}else{

  $id_comercio=Auth::user()->id_comercio;  
  $src = $_FILES['imagenProducto_editar'];
  $producto=Input::all();

  if ($src["size"] > 0){

    $Productos=Producto::Where('id',$producto['id_producto_editarr'])
    ->where('id_comercio',$id_comercio)->get();

    foreach ($Productos as $key => $value) {
      $DireccionURLFoto=$value->ruta_imagen_producto;       
    }      

    $ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Productos/';
    File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

    $imagen=rand(1000,999)."-".$src["name"];

    $Productos=Producto::Where('ruta_imagen_producto',$ruta_imagen.$imagen)
    ->where('id_comercio',$id_comercio)->get();
    $DireccionURLFoto_Consultada="";
    foreach ($Productos as $key => $value) {
      $DireccionURLFoto_Consultada=$value->ruta_imagen_producto;       
    }

    if($DireccionURLFoto!==$ruta_imagen.$imagen){
      if (File::exists($DireccionURLFoto_Consultada)) {
        return 2;
      }
    }

    if (File::exists($DireccionURLFoto)) {
      File::delete($DireccionURLFoto);
    }


    move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


    $productos = array(
      'id_comercio'               => $id_comercio,
      'nombre_producto'           => $producto['nombre_producto_editar'],
      'cantidad_producto'         => $producto['cantidad_producto_editar'],
      'valor_venta_producto'      => $producto['valor_venta_producto_editar'],
      'valor_inversion_producto'  => $producto['valor_inversion_producto_editar'],
      'valor_total_inversion'     => $producto['valor_total_inversion_editar'],
      'ruta_imagen_producto'      => $ruta_imagen.$imagen     
      );

    $check = DB::table('producto_producto')
    ->where('id',$producto['id_producto_editarr'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);

    if($check >0){
      return 0;
    }

  }else{         
    $productos = array(
      'id_comercio'               => $id_comercio,
      'nombre_producto'           => $producto['nombre_producto_editar'],
      'cantidad_producto'         => $producto['cantidad_producto_editar'],
      'valor_venta_producto'      => $producto['valor_venta_producto_editar'],
      'valor_inversion_producto'  => $producto['valor_inversion_producto_editar'],
      'valor_total_inversion'     => $producto['valor_total_inversion_editar']       
      );

    $check = DB::table('producto_producto')
    ->where('id',$producto['id_producto_editarr'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);      


    if($check >0){
      return 0;
    }else{
     return 1;
   }

 }
}
}


public function Eliminar_Productos(){
  $Id_Producto_Eliminar=Input::get('Id_producto_delete');   

  $id_comercio=Auth::user()->id_comercio;

  $Productos=Producto::Where('id',$Id_Producto_Eliminar)
  ->where('id_comercio',$id_comercio)->get();

  foreach ($Productos as $key => $value) {
    $DireccionURLFoto=$value->ruta_imagen_producto;
  }

  $filename = $DireccionURLFoto;

  if (File::exists($filename)) {
    File::delete($filename);
  } 

  $check = DB::table('producto_producto')
  ->where('id',$Id_Producto_Eliminar)
  ->where('id_comercio',$id_comercio)
  ->delete();

  if($check >0){
    return 0;
  }
}


public function RegistrarNewProducto(){   
  $rules = array
  (
    'nombre_producto'   => 'required|min:3',
    'cantidad_producto'   => 'required|min:1|numeric',
    'valor_inversion_producto'   => 'required|numeric',
    'valor_venta_producto' => 'required|numeric',
    'valor_total_inversion' => 'required|numeric',
    'imagenProducto' => 'max:2000|mimes:jpg,jpeg,png',     
    );

  $message = array
  (
    'nombre_producto.required'          => ' Porfavor Ingrese un nombre de producto.',
    'nombre_producto.min'               => ' El campo Nombre Producto es de minimo 3 caracteres.',
    'cantidad_producto.required'        => ' Porfavor Ingrese una Cantidad.',
    'cantidad_producto.min'             => ' El campo Cantidad es de minimo 1 caracteres.',
    'cantidad_producto.numeric'         => ' El campo Cantidad es numerico.',      
    'valor_inversion_producto.required' => ' Porfavor Ingrese el valor Inversión.',
    'valor_inversion_producto.numeric'  => ' El campo Valor Inversión es numerico.',
    'valor_venta_producto.required'     => ' Porfavor Ingrese el valor Total de Inversion.',
    'valor_venta_producto.numeric'      => ' El campo Valor Inversion debe ser Numerico.',

    'valor_total_inversion.required'     => ' Porfavor Ingrese el valor de Total de la Inversion.',

    'valor_total_inversion.numeric'      => ' El campo Valor Total de la Inversion debe ser Numerico.',

    'imagenProducto.max'                => 'El tamaño maximo debe la imagen es de 1 MB.',
    'imagenProducto.mimes'              => 'El archivo que pretendes subir, no es una imagen.',
    );


  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {

    return Response::json(['error' =>false,
      'errors'=>$validator->errors()->toArray()]);
  }else{


    $id_comercio=Auth::user()->id_comercio;      

    $src = $_FILES['imagenProducto'];

    if ($src["size"] > 0){


      $ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Productos/';
      File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

      $imagen=rand(1000,999)."-".$src["name"];


      $Productos=Producto::Where('ruta_imagen_producto',$ruta_imagen.$imagen)
      ->where('id_comercio',$id_comercio)->get();

      $DireccionURLFoto="";

      foreach ($Productos as $key => $value) {
        $DireccionURLFoto=$value->ruta_imagen_producto;
      }

      $filename = $DireccionURLFoto;

      if (File::exists($filename)) {

        return 1;      

      } 


      move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


      $producto=Input::all();

      $productos = array(
        'id_comercio'               => $id_comercio,
        'nombre_producto'           => $producto['nombre_producto'],
        'cantidad_producto'         => $producto['cantidad_producto'],
        'valor_venta_producto'      => $producto['valor_venta_producto'],
        'valor_inversion_producto'  => $producto['valor_inversion_producto'],
        'valor_total_inversion'     => $producto['valor_total_inversion'],
        'ruta_imagen_producto'      => $ruta_imagen.$imagen     
        );
      $check = DB::table('producto_producto')->insert($productos);
      if($check >0){
        return 0;
      }

    }else{

      $NoDisponible= 'images/ProductoNoDisponible.png';

      $producto=Input::all();

      $productos = array(
        'id_comercio'               => $id_comercio,
        'nombre_producto'           => $producto['nombre_producto'],
        'cantidad_producto'         => $producto['cantidad_producto'],
        'valor_venta_producto'      => $producto['valor_venta_producto'],
        'valor_inversion_producto'  => $producto['valor_inversion_producto'],
        'valor_total_inversion'     => $producto['valor_total_inversion'],
        'ruta_imagen_producto'      => $NoDisponible      
        );
      $check = DB::table('producto_producto')->insert($productos);
      if($check >0){
        return 0;
      }
    }

  }
}




public function Formulario_Venta_Productos(){

  return view('Ventas/Productos/Formularios.Registrar_Venta_Productos');
}

public function RegistrarProducto(){


  $rules = array
  (
    'Nombre_Producto'   => 'required|min:3',
    'Cantidad_Producto'   => 'required|min:1|numeric',  
    'Valor_Producto'    => 'required|min:1|numeric',
    'Valor_Inversion'   => 'required|numeric',
    'Valor_Total_Inversion' => 'required|numeric',
    'src' => 'max:1500|mimes:jpg,jpeg,png,gif',     
    );

  $message = array
  (
    'Nombre_Producto.required'      => ' Porfavor Ingrese un nombre de producto.',
    'Nombre_Producto.min'         => ' El campo Nombre Producto es de minimo 3 caracteres.                ',
    'Cantidad_Producto.required'    => ' Porfavor Ingrese una Cantidad.',
    'Cantidad_Producto.min'       => ' El campo Cantidad es de minimo 1 caracteres.',
    'Cantidad_Producto.numeric'     => ' El campo Cantidad es numerico.',

    'Valor_Producto.required'       => ' Porfavor Ingrese el Valor del producto.',
    'Valor_Producto.min'        => ' El campo Valor Producto es de minimo 1 caracteres.'                 ,
    'Valor_Producto.numeric'      => ' El campo Valor Producto es numerico.',

    'Valor_Inversion.required'       => ' Porfavor Ingrese el valor Inversión.',

    'Valor_Inversion.numeric'        => ' El campo Valor Inversión es numerico.',

    'Valor_Total_Inversion.required'   => ' Porfavor Ingrese el valor Total de Inversion.',

    'Valor_Total_Inversion.numeric'    => ' El campo Valor Inversion es Numerico es numerico.',
    'src.max'                => 'El tamaño maximo debe la imagen es de 10000k.',
    'src.mimes'              => 'El archivo que pretendes subir, no es una imagen.',
    );


  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {

    return Redirect::back()->withInput()->withErrors($validator); 
  }else{


    $id_comercio=Auth::user()->get()->id_comercio;

    $src = $_FILES['src'];

    if ($src["size"] > 0){

      $ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Productos/';
      File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

      $imagen=rand(1000,999)."-".$src["name"];

      move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


      $producto=Input::all();




      $productos = array(
        'id_comercio'   => $producto['NumeroComercio'],
        'nombre_producto' => $producto['Nombre_Producto'],
        'cantidad_producto'       => $producto['Cantidad_Producto'],
        'valor_venta_producto'  => $producto['Valor_Producto'],
        'valor_inversion_producto'  => $producto['Valor_Inversion'],
        'valor_total_inversion' => $producto['Valor_Total_Inversion'],  
        'ruta_imagen_producto'  => $ruta_imagen.$imagen     
        );
      $check = DB::table('producto_producto')->insert($productos);
      if($check >0){

        Session::flash('mensaje', 'Producto Registrado ExitosaMente');
        return Redirect::to('admProductos');

      }

    }else{

      $NoDisponible= 'images/ProductoNoDisponible.png';

      $producto=Input::all();

      $productos = array(
        'id_comercio'   => $producto['NumeroComercio'],
        'nombre_producto' => $producto['Nombre_Producto'],
        'cantidad_producto'       => $producto['Cantidad_Producto'],
        'valor_venta_producto'  => $producto['Valor_Producto'],
        'valor_inversion_producto'  => $producto['Valor_Inversion'],
        'valor_total_inversion' => $producto['Valor_Total_Inversion'],  
        'ruta_imagen_producto'  => $NoDisponible      
        );
      $check = DB::table('producto_producto')->insert($productos);
      if($check >0){

        Session::flash('mensaje', 'Producto Registrado ExitosaMente');
        return Redirect::to('admProductos');

      }
    }

  }
}


public function Cargar_nombres_productos(){
 $id_comercio=Auth::user()->id_comercio; 

 $resultado =Producto::where('id_comercio', $id_comercio)  
 ->get();

 $Productos=[]; 

 foreach ($resultado  as $resultados) {    
  $Productos[$resultados->id] = strtoupper($resultados->nombre_producto).' ---- $'.number_format($resultados->valor_venta_producto);
}   
return $Productos;

}


public function Cargar_detalles_Productos_Venta(){

  $id=Input::get('id_producto');

  $resultados =Producto::where('id',$id)->get();

  foreach ($resultados  as $resultado) {       
   $stock=$resultado->cantidad_producto;
   $valor_venta_producto=$resultado->valor_venta_producto; 
   $ruta_imagen_producto=$resultado->ruta_imagen_producto;   
 }


 if($ruta_imagen_producto==null){
  $ruta_imagen_producto="No Disponible";
}

return Response::json(['stock'=>$stock,'valor_venta_producto'=>$valor_venta_producto,'ruta_imagen_producto'=>$ruta_imagen_producto]);

}

public function Ultimos_productos_vendidos(){

  $id_comercio=Auth::user()->id_comercio;
  $fecha= Input::get('Hora_Venta');

  // $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  $VentaProducto=VentaProducto::where('hora_venta_producto',$fecha)
  ->where('id_comercio',$id_comercio)
  ->paginate(5);
  

  $TotalVendido =VentaProducto::where('hora_venta_producto',$fecha)
  ->where('id_comercio',$id_comercio)
  ->sum('total_producto_venta');

  $TotalVendido=number_format($TotalVendido);  

  // $Productos=Producto::where('hora_venta_producto', '>=', date('Y-m-d').' 00:00:00'));

  return view('Ventas/Productos/Tablas/VentaProductosTabla')
  ->with('VentaProducto',$VentaProducto)
  ->with('TotalVendido',$TotalVendido);
}

public function Eliminar_Venta_Producto(){


  $id_venta_producto=Input::get('id_venta_producto'); 
  $cantidad_vendido=Input::get('cantidad_producto_vendido'); 
  $id_producto=Input::get('id_producto_venta');  
  $id_comercio=Auth::user()->id_comercio;
  $fecha= Input::get('Hora_Venta');  
  
  $check = DB::table('venta_producto')
  ->where('id',$id_venta_producto)
  ->where('id_comercio',$id_comercio)
  ->delete();

  $check2 = DB::table('producto_producto')
  ->where('id',$id_producto)->first();     

  $productos = array(

    'cantidad_producto'       => $check2->cantidad_producto+$cantidad_vendido            
    ); 

  $check = DB::table('producto_producto')
  ->where('id',$id_producto)
  ->where('id_comercio',$id_comercio)
  ->update($productos);

  $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->paginate(5);

  $TotalVendido =VentaProducto::where('hora_venta_producto', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->sum('total_producto_venta');

  $TotalVendido=number_format($TotalVendido);  

  return view('Ventas/Productos/Tablas/VentaProductosTabla')
  ->with('VentaProducto',$VentaProducto)
  ->with('TotalVendido',$TotalVendido);
}

public function Eliminar_Venta_Producto_X_Fecha(){
  $fecha= Carbon::today()->toDateString();
  $id_venta_producto=Input::get('id_venta_producto'); 
  $cantidad_vendido=Input::get('cantidad_producto_vendido'); 
  $id_producto=Input::get('id_producto_venta');  
  $id_comercio=Auth::user()->id_comercio;  

  // dd($id_venta_producto,$cantidad_vendido,$id_producto,$id_comercio);

  
  $check = DB::table('venta_producto')
  ->where('id',$id_venta_producto)
  ->where('id_comercio',$id_comercio)
  ->delete();

  $check2 = DB::table('producto_producto')
  ->where('id',$id_producto)->first();     

  $productos = array(

    'cantidad_producto'       => $check2->cantidad_producto+$cantidad_vendido            
    ); 

  $check = DB::table('producto_producto')
  ->where('id',$id_producto)
  ->where('id_comercio',$id_comercio)
  ->update($productos);

  $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->paginate(10);
  

  return view('Ventas/Productos/Tablas/Ultimas_Ventas_Productos_Tabla_x_Fecha')
  ->with('VentaProducto',$VentaProducto);
  
}

public function Eliminar_Venta_Producto_X_Fecha_Calendario(){
  $Fecha_Inicial=Input::get('Fecha_Inicial');
  $Fecha_Final=Input::get('Fecha_Final');

  $id_venta_producto=Input::get('id_venta_producto'); 
  $cantidad_vendido=Input::get('cantidad_producto_vendido'); 
  $id_producto=Input::get('id_producto_venta');  
  $id_comercio=Auth::user()->id_comercio;  

  
  $check = DB::table('venta_producto')
  ->where('id',$id_venta_producto)
  ->where('id_comercio',$id_comercio)
  ->delete();

  $check2 = DB::table('producto_producto')
  ->where('id',$id_producto)->first();  



  $productos = array(

    'cantidad_producto'       => $check2->cantidad_producto+$cantidad_vendido            
    ); 

  $check = DB::table('producto_producto')
  ->where('id',$id_producto)
  ->where('id_comercio',$id_comercio)
  ->update($productos);

  $VentaProducto=VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
  ->where('id_comercio',$id_comercio)
  ->paginate(10);
  

  return view('Ventas/Productos/Tablas/Ultimas_Ventas_Productos_Tabla_x_Fecha')
  ->with('VentaProducto',$VentaProducto);
  
}

public function Ventas_Productos_X_Fecha(){  

  return view('Ventas/Productos/Consultas/Ventas_Productos_X_Fecha');
}

public function Tabla_Venta_Productos_X_Fecha(){

  $fecha= Carbon::today()->toDateString();
  $id_comercio=Auth::user()->id_comercio;

  // dd($fecha);

  // $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  $VentaProducto=VentaProducto::where('fecha_producto_venta',$fecha)
  ->where('id_comercio',$id_comercio)
  ->orderBy('id','desc')
  ->paginate(10);

  return view('Ventas/Productos/Tablas/Ultimas_Ventas_Productos_Tabla_x_Fecha')->with('VentaProducto',$VentaProducto);
}

public function Cuadrado_Venta_Productos_X_Fecha(){

 $fecha= Carbon::today()->toDateString();
 $id_comercio=Auth::user()->id_comercio;

 $TotalVendido =VentaProducto::where('hora_venta_producto', '>=',$fecha)
 ->where('id_comercio',$id_comercio)
 ->sum('total_producto_venta');

 $CantidadVendida =VentaProducto::where('hora_venta_producto', '>=',$fecha)
 ->where('id_comercio',$id_comercio)
 ->count('id');

 $TotalVendido=number_format($TotalVendido); 

 return view('Ventas/Productos/Cuadros.Cuadro_Ventas_Productos_X_Fecha')->with('TotalVendido',$TotalVendido)->with('CantidadVendida',$CantidadVendida);
}

public function CantidadVendidaProductos(){

 $fecha= Carbon::today()->toDateString();
 $id_comercio=Auth::user()->id_comercio;
 
 $CantidadVendida =VentaProducto::where('hora_venta_producto', '>=',$fecha)
 ->where('id_comercio',$id_comercio)
 ->count('id');

 return view('Ventas/Productos/Cuadros.Cantidad_Productos_Vendido')->with('CantidadVendida',$CantidadVendida);
}
// Para Buscar porfecha seleccionada las ventas en las ventas del dia 
public function Cuadrado_Venta_Productos_X_BusquedaCalendario(){

  $Fecha_Inicial=Input::get('Fecha_Inicial');
  $Fecha_Final=Input::get('Fecha_Final');
  $id_comercio=Auth::user()->id_comercio;

  $TotalVendido = VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
  ->where('id_comercio',$id_comercio)
  ->sum('total_producto_venta');

  $TotalVendido=number_format($TotalVendido); 

  $CantidadVendida = VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
  ->where('id_comercio',$id_comercio)
  ->count('id');

  return view('Ventas/Productos/Cuadros.Cuadro_Ventas_Productos_X_Fecha')->with('TotalVendido',$TotalVendido)->with('CantidadVendida',$CantidadVendida);
}

public function Buscar_Venta_Producto_X_Fecha(){
  $Fecha_Inicial=Input::get('Fecha_Inicial');
  $Fecha_Final=Input::get('Fecha_Final');
  $id_comercio=Auth::user()->id_comercio;

  $rules = array
  (
    'Fecha_Inicial'   => 'required',
    'Fecha_Final'    => 'required'       
    );

  $message = array
  (
    'Fecha_Inicial.required' => 'Ingrese Fecha Inicial.',
    'Fecha_Final.required'   => 'Ingrese Fecha Final.'         
    );

  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {

    return Response::json(['success' =>false,
      'errores'=>$validator->errors()->toArray()]);
  }else{

    $VentaProducto = VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
    ->where('id_comercio',$id_comercio)
    ->orderBy('fecha_producto_venta','desc')
    ->paginate(10);
    return view('Ventas/Productos/Tablas/Ultimas_Ventas_Productos_Tabla_x_Fecha')->with('VentaProducto',$VentaProducto);

  }

}

public function Cargar_datos_Modal_editar_venta_productos(){

  $id=Input::get('id_venta');
  $resultados =VentaProducto::where('id',$id)->get();  
  
  foreach ($resultados  as $resultado) {     
    $producto_id=$resultado->producto_id;
    $precio_producto_venta=$resultado->precio_producto_venta; 
    $cantidad_producto_venta=$resultado->cantidad_producto_venta; 
    $total_producto_venta=$resultado->total_producto_venta; 
    $ruta_imagen_producto=$resultado->ruta_imagen_producto;   
  }
  $nombre_producto =Producto::where('id',$producto_id)->first();
  $stock=$nombre_producto->cantidad_producto;
  $name=$nombre_producto->nombre_producto;

  if($ruta_imagen_producto="null"){
    $ruta_imagen_producto="No Disponible";
  }

  // return Response::json(['stock'=>$stock,'valor_venta_producto'=>$valor_venta_producto,'ruta_imagen_producto'=>$ruta_imagen_producto]);
  return Response::json(['stock'=>$stock,
    'producto_id'=>$producto_id,
    'name'=>$name,
    'ruta_imagen_producto'=>$ruta_imagen_producto,
    'precio_producto_venta'=>$precio_producto_venta,
    'cantidad_producto_venta'=>$cantidad_producto_venta,
    'total_producto_venta'=>$total_producto_venta
    ]);

}


public function Consultar_Producto_x_Busqueda(){

  $id_producto=Input::get('producto_id_venta_consulta');
  $fecha= Carbon::today()->toDateString();
  $id_comercio=Auth::user()->id_comercio;

  $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->where('producto_id',$id_producto)
  ->paginate(10);


  return view('Ventas/Productos/Consultas/Consultando_VentaProductos_Tabla_x_Fecha')->with('VentaProducto',$VentaProducto);


}


function Editar_Venta_Producto(){
  $Datos=Input::all();
  $id_comercio=Auth::user()->id_comercio;

  if($Datos['id_producto_leido']==$Datos['producto_id_editar']){

    // Se reingresa la cantidad del producto al stock
    $productos = array(
      'cantidad_producto'    => $Datos['cantidad_producto_stock']+$Datos['cantidad_producto_vendido2']                      
      );
    $check = DB::table('producto_producto')
    ->where('id',$Datos['id_producto_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);

// Se descuentan los productos del stock de la nueva venta.    
    $productos2 = array(
      'cantidad_producto'    => $productos['cantidad_producto']-$Datos['cantidad_productos_venta']                      
      );

    $check = DB::table('producto_producto')
    ->where('id',$Datos['id_producto_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($productos2);

    $productos = array(
      'cantidad_producto_venta'    => $Datos['cantidad_productos_venta'],
      'total_producto_venta'       => $Datos['valor_total']                 
      ); 
    $check = DB::table('venta_producto')
    ->where('id',$Datos['id_producto_venta'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);

    if($check >0){
      return 0;
    }else{
      return 1; 
    }
  }else{
// Se reingresa la cantidad del producto al stock

    $productos = array(
      'cantidad_producto'    => $Datos['cantidad_producto_stock']+$Datos['cantidad_producto_vendido2']                      
      );
    $check = DB::table('producto_producto')
    ->where('id',$Datos['id_producto_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);

// Se descuentan los productos del stock de la nueva venta.    
    $productos2 = array(
      'cantidad_producto'    => $Datos['stock_producto']-$Datos['cantidad_productos_venta']               
      );    
    $check = DB::table('producto_producto')
    ->where('id',$Datos['producto_id_editar'])
    ->where('id_comercio',$id_comercio)
    ->update($productos2);

    $productos = array(
      'producto_id'                => $Datos['producto_id_editar'],
      'cantidad_producto_venta'    => $Datos['cantidad_productos_venta'],
      'precio_producto_venta'      => $Datos['valor_venta'],
      'total_producto_venta'       => $Datos['valor_total']                 
      ); 
    $check = DB::table('venta_producto')
    ->where('id',$Datos['id_producto_venta'])
    ->where('id_comercio',$id_comercio)
    ->update($productos);

    if($check >0){
      return 0;
    }else{
      return 1; 
    }
  }  

}

public function AdministrarProductos(){
  return view('Administrar/Productos/Administrar_Productos');
}

public function Cargar_Productos_En_Administrar(){

  $this->Actualizar_Total_Inversion_Productos();

  $Productos=Producto::orderBy('nombre_producto','asc')->paginate(9);

  return view('Administrar/Productos/Tablas.Tabla_Administrar_Productos')->with('Productos',$Productos);

}

public function Consultar_Producto_Por_ID(){
  $id_producto=Input::get('id_producto');
  $Productos=Producto::Where('id',$id_producto)->orderBy('nombre_producto','asc')->paginate(9);
  return view('Administrar/Productos/Tablas.Tabla_Administrar_Productos')->with('Productos',$Productos);

}

















public function Cargar_Ventas_Productos(){


  $Fecha_Actual= Carbon::today()->toDateString();  

  $id_comercio=Auth::user()->id_comercio;

  $VentaProducto =VentaProducto::where('fecha_producto_venta',$Fecha_Actual)
  ->where('id_comercio',$id_comercio)
  ->orderBy('hora_venta_producto','desc')
  ->paginate(5);

  return view('Productos/Tablas/VentaProductosTabla')->with('VentaProducto',$VentaProducto)->render();
}
public function Cargar_Ventas_Productos_Cuadrado(){


  $Fecha_Actual= Carbon::today()->toDateString();  

  $id_comercio=Auth::user()->id_comercio;

  $VentaProducto =VentaProducto::where('fecha_producto_venta',$Fecha_Actual)
  ->where('id_comercio',$id_comercio)
  ->sum('total_producto_venta');

  $VentaProducto=number_format($VentaProducto);  

  $CantidadProductoVendido =VentaProducto::where('fecha_producto_venta',$Fecha_Actual)
  ->where('id_comercio',$id_comercio)
  ->count('id');

  return view('Productos/Cuadros/CuadroVentaProductos')->with('VentaProducto',$VentaProducto)->with('CantidadProductoVendido',$CantidadProductoVendido);
}


public function RegistarVentaProducto(){

  $rules = array
  (
    'user_id'           => 'required',
    'id_comercio'       => 'required',
    'producto_id'       => 'required|numeric',  
    'cantidad_producto_venta' => 'required|min:1|numeric',
    'precio_producto_venta'   => 'required|min:1|numeric',
    'total_producto_venta'    => 'required|min:1|numeric',
    'fecha_producto_venta'    => 'required',
    'hora_venta_producto'   => 'required'     
    );

  $message = array
  (
    'user_id.required'            => ' Se requiere el id del usuario',
    'id_comercio.required'        => ' Se requiere el id de comercio',
    'producto_id.required'        => ' Seleccione un producto de la lista.',

    'producto_id.numeric'         => ' Seleccione un producto de la lista.',

    'cantidad_producto_venta.required'  => ' Porfavor Ingrese una Cantidad.',
    'cantidad_producto_venta.min'     => ' Porfavor Ingrese una Cantidad.',
    'cantidad_producto_venta.numeric'   => ' Porfavor Ingrese una Cantidad.',

    'precio_producto_venta.required'  => ' Porfavor Ingrese un precio de venta.',
    'precio_producto_venta.min'     => ' Porfavor Ingrese un precio de venta.',
    'precio_producto_venta.numeric'   => ' Porfavor Ingrese un precio de venta.',

    'total_producto_venta.required'   => ' Porfavor Ingrese un total de producto.',
    'total_producto_venta.min'      => ' Porfavor Ingrese un total de producto.',
    'total_producto_venta.numeric'    => ' Porfavor Ingrese un total de producto.',

    'fecha_producto_venta.required'   => ' Porfavor Ingrese la fecha de la venta.',
    'hora_venta_producto.required'  => ' Porfavor Ingrese la fecha de la venta.'      
    );

  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {

    return Response::json(['success' =>false,
      'errors'=>$validator->errors()->toArray()]);
  }else{
    $venta_producto = Input::all();
    $id_producto =$venta_producto['producto_id'];
    $hora_venta_producto =$venta_producto['hora_venta_producto'];
    $cantidad_producto_venta =$venta_producto['cantidad_producto_venta'];
    $total_producto_venta=$venta_producto['total_producto_venta'];

    // dd($id_producto,$hora_venta_producto,$cantidad_producto_venta);

    $check = DB::table('venta_producto')
    ->where('producto_id',$id_producto)
    ->where('hora_venta_producto',$hora_venta_producto)->first();


    if($check==null){

      $CantidadVentaProducto    = Input::get('cantidad_producto_venta');
      $StockVentaProducto     = Input::get('stock_producto');

      $StockVentaProducto=(int)$StockVentaProducto;
      $CantidadVentaProducto=(int)$CantidadVentaProducto;

      $TotalProducto=$StockVentaProducto-$CantidadVentaProducto;


      $productos = array(

        'cantidad_producto'       => $TotalProducto       
        );      

      $check = DB::table('producto_producto')
      ->where('id',$venta_producto['producto_id'])
      ->where('id_comercio',$venta_producto['id_comercio'])
      ->update($productos);

      $venta_productos = array(        
        'id_usuario'                => $venta_producto['user_id'],
        'id_comercio'               => $venta_producto['id_comercio'],
        'producto_id'               => $venta_producto['producto_id'],
        'cantidad_producto_venta'   => $venta_producto['cantidad_producto_venta'],
        'precio_producto_venta'     => $venta_producto['precio_producto_venta'],
        'total_producto_venta'      => $venta_producto['total_producto_venta'],       
        'fecha_producto_venta'      => $venta_producto['fecha_producto_venta'],
        'hora_venta_producto'       => $hora_venta_producto   
        );

      $check = DB::table('venta_producto')->insert($venta_productos);
      if($check >0){
        return 0;
      }else{
        return 1; 
      }

    }else{
      $check2 = DB::table('venta_producto')
      ->where('producto_id',$id_producto)
      ->where('hora_venta_producto',$hora_venta_producto)->first();     

      $productos = array(

        'cantidad_producto_venta'       => $check->cantidad_producto_venta+$cantidad_producto_venta,
        'total_producto_venta'          => $check->total_producto_venta+$total_producto_venta         
        ); 

      $check = DB::table('venta_producto')
      ->where('producto_id',$id_producto)
      ->where('hora_venta_producto',$hora_venta_producto)
      ->update($productos);
    }
  }
}

public function store(){
 $Fecha_Actual= Carbon::today()->toDateString();  

 $id_comercio=Auth::user()->id_comercio;

 $VentaProducto =VentaProducto::where('fecha_producto_venta',$Fecha_Actual)
 ->where('id_comercio',$id_comercio)
 ->orderBy('hora_venta_producto','desc')
 ->paginate(5);

 return view('Productos/Tablas/VentaProductosTabla')->with('VentaProducto',$VentaProducto)->render();
}
}


