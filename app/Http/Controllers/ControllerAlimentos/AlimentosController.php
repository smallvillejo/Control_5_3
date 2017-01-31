<?php
namespace App\Http\Controllers\ControllerAlimentos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alimentos\Alimento;
use App\Models\Productos\Producto;
use App\Models\Alimentos\VentaAlimento;
use App\Models\Usuarios\Empresa;
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
class AlimentosController extends Controller{
  public function __construct(){
    Carbon::setLocale('es');
  }

  public function Actualizar_Total_Inversion_Alimentos(){
    $Alimentos=Alimento::all();
    $id_comercio=Auth::user()->id_comercio; 

    foreach ($Alimentos as $key => $value) {
     $id=$value->id;
     $cantidad_alimento=$value->cantidad_alimento;
     $valor_inversion_alimento=$value->valor_inversion_alimento;     

     $ValorTotalInversion=$cantidad_alimento*$valor_inversion_alimento;

     $alimentos = array(
      'valor_total_inversion'               => $ValorTotalInversion         
      );

     $check = DB::table('producto_alimento')
     ->where('id',$id)
     ->where('id_comercio',$id_comercio)
     ->update($alimentos);

   }
 }
 

 public function Notificaciones_PocoStock(){
  $NotificacionAlimentos=Alimento::Where('cantidad_alimento','<=',3)->count();
  $NotificacionProductos=Producto::Where('cantidad_producto','<=',3)->count();

  $NumeroNotificacion="";
  $MensajeNotificacion="";
  $MensajeProducto="";
  $MensajeAlimento="";


  if($NotificacionProductos && $NotificacionAlimentos){
    $NumeroNotificacion=  2;
    $MensajeNotificacion="<h3><span class='bold'>Tienes 2</span> Notificaciones nuevas.</h3>";

  }elseif($NotificacionProductos){
    $NumeroNotificacion=  1;
    $MensajeNotificacion="<h3><span class='bold'>Tienes 1</span> Notificacion nueva.</h3>";

  }elseif($NotificacionAlimentos){
    $NumeroNotificacion= 1;
    $MensajeNotificacion="<h3><span class='bold'>Tienes 1</span> Notificacion nueva.</h3>";
  }else{
    $NumeroNotificacion= "";
    $MensajeNotificacion="<h3><span class='bold'>No hay notificaciones.</span></h3>";

  }

  if($NotificacionProductos==0){
    $MensajeProducto="";
  }elseif($NotificacionProductos<=1){
    $MensajeProducto="<a href='Cargar_ProductosConPocoStock'><span class='details'><span class='label label-sm label-icon label-danger'><i class='fa fa-bolt'></i></span>Hay ".$NotificacionProductos."<strong> Producto</strong> con poco Stock.</span></a>";
  }else{
    $MensajeProducto="<a href='Cargar_ProductosConPocoStock'><span class='details'><span class='label label-sm label-icon label-danger'><i class='fa fa-bolt'></i></span>Hay ".$NotificacionProductos."<strong> Productos</strong> con poco Stock.</span></a>";
  }

  if($NotificacionAlimentos==0){
    $MensajeAlimento="";
  }elseif($NotificacionAlimentos<=1){
    $MensajeAlimento="<a href='Cargar_AlimentosConPocoStock'><span class='details'><span class='label label-sm label-icon label-success'><i class='fa fa-bolt'></i></span>Hay ".$NotificacionAlimentos."<strong> Alimento</strong> con poco Stock.</span></a>";
  }else{
    $MensajeAlimento="<a href='Cargar_AlimentosConPocoStock'><span class='details'><span class='label label-sm label-icon label-success'><i class='fa fa-bolt'></i></span>Hay ".$NotificacionAlimentos."<strong> Alimentos</strong> con poco Stock.</span></a>";
  }

  return Response::json(['NumeroNotificacion'=>$NumeroNotificacion,
    'MensajeNotificacion'=>$MensajeNotificacion,
    'MensajeProducto'=>$MensajeProducto,
    'MensajeAlimento'=>$MensajeAlimento]);
}

public function CargarCantidadStockAcabarseAlimento(){
  $NotificacionAlimentos=Alimento::Where('cantidad_alimento','<=',3)->count();
  if($NotificacionAlimentos==0){
    $NotificacionAlimentos=0;
  }
  return $NotificacionAlimentos;
}
public function AdministrarAlimentos(){
  return view('Administrar/Alimentos/Administrar_Alimentos');
}
public function Cargar_Alimentos_En_Administrar(){
  $this->Actualizar_Total_Inversion_Alimentos();
  $Alimentos=Alimento::orderBy('nombre_alimento','asc')->paginate(9);
  return view('Administrar/Alimentos/Tablas.Tabla_Administrar_Alimentos')->with('Alimentos',$Alimentos);
}
public function Consultar_Alimento_Por_ID(){
  $id_alimento=Input::get('id_alimento');
  $Alimentos=Alimento::Where('id',$id_alimento)->orderBy('nombre_alimento','asc')->paginate(9);
  return view('Administrar/Alimentos/Tablas.Tabla_Administrar_Alimentos')->with('Alimentos',$Alimentos);
}
public function AlimentosConPocoStock(){
  $Alimentos=Alimento::Where('cantidad_alimento','<=',3)
  ->orderBy('nombre_alimento','asc')->paginate(9);
  return view('Administrar/Alimentos/Tablas.Tabla_Administrar_Alimentos_Poco_Stock')->with('Alimentos',$Alimentos);
}
public function Cargar_AlimentosConPocoStock(){    
  return view('Administrar/Alimentos/Poco_Stock/Poco_Stock_Alimentos');    
}
public function  Exportar_PDF_Total_Alimentos(){
  $id_comercio=Auth::user()->id_comercio;
  $nombreArchivo='Comercio_ID:'.$id_comercio.'-Listado Alimentos';
  $Alimentos=Alimento::Where('id_comercio',$id_comercio)
  ->orderBy('nombre_alimento','asc')->get();
  $id_usuario_logueado=Auth::user()->id;
  $nombre_empresa=Empresa::where('fk_usuario',$id_usuario_logueado)->get();
  foreach ($nombre_empresa as $key => $value) {
    $nombre_empresa=$value->nombre_empresa;
  }
  $TotalInversion=DB::table('producto_alimento')
  ->where('id_comercio',$id_comercio)
  ->sum('valor_total_inversion');
  $TotalInversion=number_format($TotalInversion);
  $pdf = App::make('dompdf.wrapper');
// $pdf->loadHTML('<h1>Test</h1>');
  $pdf = PDF::loadView('Administrar/Alimentos/Reporte_PDF/Reporte_PDF_Total_Alimentos',compact('Alimentos','nombre_empresa','TotalInversion'))->setPaper('letter', 'landscape');
// $pdf = PDF::loadView('Administrar/Productos/Reporte_PDF/Reporte_PDF_Total_Productos',compact('Productos','nombre_empresa'))->setPaper('letter', 'portrait');
  return $pdf->download($nombreArchivo.'.pdf');
}
public function Exportar_Excel_Total_Alimentos(){
  $id_comercio=Auth::user()->id_comercio;
  $Alimentos = DB::table('producto_alimento')
  ->where('id_comercio',$id_comercio)
  ->orderBy('nombre_alimento','asc')
  ->get();
  $TotalInversion=DB::table('producto_alimento')
  ->where('id_comercio',$id_comercio)
  ->sum('valor_total_inversion');
  $TotalInversion=number_format($TotalInversion);
  $TotalAlimentos= Alimento::Where('id_comercio',$id_comercio)
  ->count('id');
  $TotalAlimentos=number_format($TotalAlimentos);
  $nombreArchivo='Comercio_ID:'.$id_comercio.'-Listado Alimentos';
  Excel::create($nombreArchivo, function($excel) use($Alimentos,$TotalInversion,$TotalAlimentos) {

    $excel->setTitle('Listado de Alimentos');
// $excel->setOrientation('landscape');
    $excel->sheet('Página 1', function($sheet) use($Alimentos,$TotalInversion,$TotalAlimentos) {
      $data = [];
      $sheet->setFontFamily('Comic Sans MS');
      $sheet->setFontSize(15);
      $sheet->mergeCells('A1:E1');

      array_push($data, ['Listado de Alimentos Registrados']);
      array_push($data, ['']);
      array_push($data, ['Nombre Alimento','Stock', 'Valor Venta','Valor Inversión', 'Valor Total']);
      foreach ($Alimentos as $key => $value) {
        $Valor_Inversion=number_format($value->valor_total_inversion);
        $Valor_Venta=number_format($value->valor_venta_alimento);
        $Valor_Inversion_Total=number_format($value->valor_inversion_alimento);

        array_push($data, [(string) $value->nombre_alimento,(string) $value->cantidad_alimento,(string) '$'.$Valor_Venta, (string) '$'.$Valor_Inversion_Total , (string) '$'.$Valor_Inversion]);
      }
      array_push($data, ['']);
      array_push($data, ['','', '','Total Inversion:','$'.$TotalInversion]);
      array_push($data, ['','', '','Total Alimentos:',$TotalAlimentos]);
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
public function Consultar_Alimento_Modificar(){
  $Id_alimentoEditar=Input::get('Id_alimentoEditar');
  $Alimentos=Alimento::Where('id',$Id_alimentoEditar)->get();
  foreach ($Alimentos  as $resultado) {
    $id_alimento_editarr=$resultado->id;
    $nombre_alimento=$resultado->nombre_alimento;
    $stock=$resultado->cantidad_alimento;
    $valor_venta_alimento=$resultado->valor_venta_alimento;
    $valor_inversion_alimento=$resultado->valor_inversion_alimento;
    $valor_total_inversion=$resultado->valor_total_inversion;
    $ruta_imagen_alimento=$resultado->ruta_imagen_alimento;
  }
  if($ruta_imagen_alimento==null){
    $ruta_imagen_alimento="No Disponible";
  }
  return Response::json([
    'id_alimento_editarr'=>$id_alimento_editarr,
    'nombre_alimento'=>$nombre_alimento,
    'stock'=>$stock,
    'valor_venta_alimento'=>$valor_venta_alimento,
    'valor_inversion_alimento'=>$valor_inversion_alimento,
    'valor_total_inversion'=>$valor_total_inversion,
    'ruta_imagen_alimento'=>$ruta_imagen_alimento]);
}
public function ModificarAlimento(){
  $rules = array
  (
    'nombre_alimento_editar'   => 'required|min:3',
    'cantidad_alimento_editar'   => 'required|min:1|numeric',
    'valor_inversion_alimento_editar'   => 'required|numeric',
    'valor_venta_alimento_editar' => 'required|numeric',
    'valor_total_inversion_editar' => 'required|numeric',
    'imagenAlimento_editar' => 'max:2000|mimes:jpg,jpeg,png',
    );
  $message = array
  (
    'nombre_alimento_editar.required'          => ' Porfavor Ingrese un nombre de alimento.',
    'nombre_alimento_editar.min'               => ' El campo Nombre alimento es de minimo 3 caracteres.',
    'cantidad_alimento_editar.required'        => ' Porfavor Ingrese una Cantidad.',
    'cantidad_alimento_editar.min'             => ' El campo Cantidad es de minimo 1 caracteres.',
    'cantidad_alimento_editar.numeric'         => ' El campo Cantidad es numerico.',
    'valor_inversion_alimento_editar.required' => ' Porfavor Ingrese el valor Inversión.',
    'valor_inversion_alimento_editar.numeric'  => ' El campo Valor Inversión es numerico.',
    'valor_venta_alimento_editar.required'     => ' Porfavor Ingrese el valor Total de Inversion.',
    'valor_venta_alimento_editar.numeric'      => ' El campo Valor Inversion debe ser Numerico.',
    'valor_total_inversion_editar.required'     => ' Porfavor Ingrese el valor de Total de la Inversion.',
    'valor_total_inversion_editar.numeric'      => ' El campo Valor Total de la Inversion debe ser Numerico.',
    'imagenAlimento_editar.max'                => 'El tamaño maximo debe la imagen es de 1 MB.',
    'imagenAlimento_editar.mimes'              => 'El archivo que pretendes subir, no es una imagen.',
    );
  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {
    return Response::json(['error' =>false,
      'errors'=>$validator->errors()->toArray()]);
  }else{
    $id_comercio=Auth::user()->id_comercio;
    $src = $_FILES['imagenAlimento_editar'];
    $alimento=Input::all();
    if ($src["size"] > 0){
      $Alimentos=Alimento::Where('id',$alimento['id_alimento_editarr'])
      ->where('id_comercio',$id_comercio)->get();
      foreach ($Alimentos as $key => $value) {
        $DireccionURLFoto=$value->ruta_imagen_alimento;
      }
      $ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Alimentos/';
      File::makeDirectory($ruta_imagen, $mode = 0777, true, true);
      $imagen=rand(1000,999)."-".$src["name"];
      $Alimentos=Alimento::Where('ruta_imagen_alimento',$ruta_imagen.$imagen)
      ->where('id_comercio',$id_comercio)->get();
      $DireccionURLFoto_Consultada="";
      foreach ($Alimentos as $key => $value) {
        $DireccionURLFoto_Consultada=$value->ruta_imagen_alimento;
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
      $alimentos = array(
        'id_comercio'               => $id_comercio,
        'nombre_alimento'           => $alimento['nombre_alimento_editar'],
        'cantidad_alimento'         => $alimento['cantidad_alimento_editar'],
        'valor_venta_alimento'      => $alimento['valor_venta_alimento_editar'],
        'valor_inversion_alimento'  => $alimento['valor_inversion_alimento_editar'],
        'valor_total_inversion'     => $alimento['valor_total_inversion_editar'],
        'ruta_imagen_alimento'      => $ruta_imagen.$imagen
        );
      $check = DB::table('producto_alimento')
      ->where('id',$alimento['id_alimento_editarr'])
      ->where('id_comercio',$id_comercio)
      ->update($alimentos);
      if($check >0){
        return 0;
      }
    }else{
      $alimentos = array(
        'id_comercio'               => $id_comercio,
        'nombre_alimento'           => $alimento['nombre_alimento_editar'],
        'cantidad_alimento'         => $alimento['cantidad_alimento_editar'],
        'valor_venta_alimento'      => $alimento['valor_venta_alimento_editar'],
        'valor_inversion_alimento'  => $alimento['valor_inversion_alimento_editar'],
        'valor_total_inversion'     => $alimento['valor_total_inversion_editar']
        );
      $check = DB::table('producto_alimento')
      ->where('id',$alimento['id_alimento_editarr'])
      ->where('id_comercio',$id_comercio)
      ->update($alimentos);
      if($check >0){
        return 0;
      }else{
        return 1;
      }
    }
  }
}
public function Eliminar_Alimentos(){
  $Id_Alimento_Eliminar=Input::get('Id_alimento_delete');
  $id_comercio=Auth::user()->id_comercio;

  $Ventas_Alimentos=VentaAlimento::Where('alimento_id',$Id_Alimento_Eliminar)
  ->where('id_comercio',$id_comercio)->paginate(9);

  foreach ($Ventas_Alimentos as $key => $value) {
    $NombreAlimento=$value->Alimento->nombre_alimento;
  }

  if($Ventas_Alimentos->total()==0){
   $Alimentos=Alimento::Where('id',$Id_Alimento_Eliminar)
   ->where('id_comercio',$id_comercio)->get();
   foreach ($Alimentos as $key => $value) {
    $DireccionURLFoto=$value->ruta_imagen_alimento;
  }
  $filename = $DireccionURLFoto;
  if (File::exists($filename)) {
    File::delete($filename);
  }
  $check = DB::table('producto_alimento')
  ->where('id',$Id_Alimento_Eliminar)
  ->where('id_comercio',$id_comercio)
  ->delete();
  if($check >0){
    return 0;
  }
}else{
  return Response::json([
    'ErrorTieneVentasAsociadas'=>"Si",
    'NombreAlimento'=>$NombreAlimento]);
}
}
public function RegistrarNewAlimento(){
  $rules = array
  (
    'nombre_alimento'   => 'required|min:3',
    'cantidad_alimento'   => 'required|min:1|numeric',
    'valor_inversion_alimento'   => 'required|numeric',
    'valor_venta_alimento' => 'required|numeric',
    'valor_total_inversion' => 'required|numeric',
    'imagenAlimento' => 'max:2000|mimes:jpg,jpeg,png',
    );
  $message = array
  (
    'nombre_alimento.required'          => ' Porfavor Ingrese un nombre de alimento.',
    'nombre_alimento.min'               => ' El campo Nombre alimento es de minimo 3 caracteres.',
    'cantidad_alimento.required'        => ' Porfavor Ingrese una Cantidad.',
    'cantidad_alimento.min'             => ' El campo Cantidad es de minimo 1 caracteres.',
    'cantidad_alimento.numeric'         => ' El campo Cantidad es numerico.',
    'valor_inversion_alimento.required' => ' Porfavor Ingrese el valor Inversión.',
    'valor_inversion_alimento.numeric'  => ' El campo Valor Inversión es numerico.',
    'valor_venta_alimento.required'     => ' Porfavor Ingrese el valor Total de Inversion.',
    'valor_venta_alimento.numeric'      => ' El campo Valor Inversion debe ser Numerico.',
    'valor_total_inversion.required'     => ' Porfavor Ingrese el valor de Total de la Inversion.',
    'valor_total_inversion.numeric'      => ' El campo Valor Total de la Inversion debe ser Numerico.',
    'imagenAlimento.max'                => 'El tamaño maximo debe la imagen es de 1 MB.',
    'imagenAlimento.mimes'              => 'El archivo que pretendes subir, no es una imagen.',
    );
  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {
    return Response::json(['error' =>false,
      'errors'=>$validator->errors()->toArray()]);
  }else{
    $id_comercio=Auth::user()->id_comercio;
    $src = $_FILES['imagenAlimento'];
    if ($src["size"] > 0){
      $ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Alimentos/';
      File::makeDirectory($ruta_imagen, $mode = 0777, true, true);
      $imagen=rand(1000,999)."-".$src["name"];
      $Alimentos=Alimento::Where('ruta_imagen_alimento',$ruta_imagen.$imagen)
      ->where('id_comercio',$id_comercio)->get();
      $DireccionURLFoto="";
      foreach ($Alimentos as $key => $value) {
        $DireccionURLFoto=$value->ruta_imagen_alimento;
      }
      $filename = $DireccionURLFoto;
      if (File::exists($filename)) {
        return 1;
      }
      move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);
      $alimento=Input::all();
      $alimentos = array(
        'id_comercio'               => $id_comercio,
        'nombre_alimento'           => $alimento['nombre_alimento'],
        'cantidad_alimento'         => $alimento['cantidad_alimento'],
        'valor_venta_alimento'      => $alimento['valor_venta_alimento'],
        'valor_inversion_alimento'  => $alimento['valor_inversion_alimento'],
        'valor_total_inversion'     => $alimento['valor_total_inversion'],
        'ruta_imagen_alimento'      => $ruta_imagen.$imagen
        );
      $check = DB::table('producto_alimento')->insert($alimentos);
      if($check >0){
        return 0;
      }
    }else{
      $NoDisponible= 'images/AlimentoNoDisponible.png';
      $alimento=Input::all();
      $alimentos = array(
        'id_comercio'               => $id_comercio,
        'nombre_alimento'           => $alimento['nombre_alimento'],
        'cantidad_alimento'         => $alimento['cantidad_alimento'],
        'valor_venta_alimento'      => $alimento['valor_venta_alimento'],
        'valor_inversion_alimento'  => $alimento['valor_inversion_alimento'],
        'valor_total_inversion'     => $alimento['valor_total_inversion'],
        'ruta_imagen_alimento'      => $NoDisponible
        );
      $check = DB::table('producto_alimento')->insert($alimentos);
      if($check >0){
        return 0;
      }
    }
  }
}
public function Formulario_Venta_Alimentos(){
  return view('Ventas/Alimentos/Formularios.Registrar_Venta_Alimentos');
}
public function Ventas_Alimentos_X_Fecha(){    
  return view('Ventas/Alimentos/Consultas/Ventas_Alimentos_X_Fecha');
}
public function Cargar_datos_Modal_editar_venta_alimentos(){
  $id=Input::get('id_venta');
  $resultados =VentaAlimento::where('id',$id)->get();
  foreach ($resultados  as $resultado) {
    $alimento_id=$resultado->alimento_id;
    $precio_alimento_venta=$resultado->precio_alimento_venta;
    $cantidad_alimento_venta=$resultado->cantidad_alimento_venta;
    $total_alimento_venta=$resultado->total_alimento_venta;
    $ruta_imagen_alimento=$resultado->ruta_imagen_alimento;
  }
  $nombre_alimento =Alimento::where('id',$alimento_id)->first();
  $stock=$nombre_alimento->cantidad_alimento;
  $name=$nombre_alimento->nombre_alimento;
  if($ruta_imagen_alimento="null"){
    $ruta_imagen_alimento="No Disponible";
  }
  return Response::json(['stock'=>$stock,
    'alimento_id'=>$alimento_id,
    'name'=>$name,
    'ruta_imagen_alimento'=>$ruta_imagen_alimento,
    'precio_alimento_venta'=>$precio_alimento_venta,
    'cantidad_alimento_venta'=>$cantidad_alimento_venta,
    'total_alimento_venta'=>$total_alimento_venta
    ]);
}
public function Editar_Venta_Alimento(){
  $Datos=Input::all();
  $id_comercio=Auth::user()->id_comercio;
  if($Datos['id_alimento_leido']==$Datos['alimento_id_editar']){
// Se reingresa la cantidad del alimento al stock
    $alimentos = array(
      'cantidad_alimento'    => $Datos['cantidad_alimento_stock']+$Datos['cantidad_alimento_vendido2']
      );
    $check = DB::table('producto_alimento')
    ->where('id',$Datos['id_alimento_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos);
// Se descuentan los alimentos del stock de la nueva venta.
    $alimentos2 = array(
      'cantidad_alimento'    => $alimentos['cantidad_alimento']-$Datos['cantidad_alimentos_venta']
      );
    $check = DB::table('producto_alimento')
    ->where('id',$Datos['id_alimento_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos2);
    $alimentos = array(
      'cantidad_alimento_venta'    => $Datos['cantidad_alimentos_venta'],
      'total_alimento_venta'       => $Datos['valor_total']
      );
    $check = DB::table('venta_alimento')
    ->where('id',$Datos['id_alimento_venta'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos);
    if($check >0){
      return 0;
    }else{
      return 1;
    }
  }else{
// Se reingresa la cantidad del alimento al stock
    $alimentos = array(
      'cantidad_alimento'    => $Datos['cantidad_alimento_stock']+$Datos['cantidad_alimento_vendido2']
      );
    $check = DB::table('producto_alimento')
    ->where('id',$Datos['id_alimento_leido'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos);
// Se descuentan los alimentos del stock de la nueva venta.
    $alimentos2 = array(
      'cantidad_alimento'    => $Datos['stock_alimento']-$Datos['cantidad_alimentos_venta']
      );
    $check = DB::table('producto_alimento')
    ->where('id',$Datos['alimento_id_editar'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos2);
    $alimentos = array(
      'alimento_id'                => $Datos['alimento_id_editar'],
      'cantidad_alimento_venta'    => $Datos['cantidad_alimentos_venta'],
      'precio_alimento_venta'      => $Datos['valor_venta'],
      'total_alimento_venta'       => $Datos['valor_total']
      );
    $check = DB::table('venta_alimento')
    ->where('id',$Datos['id_alimento_venta'])
    ->where('id_comercio',$id_comercio)
    ->update($alimentos);
    if($check >0){
      return 0;
    }else{
      return 1;
    }
  }
}
public function Eliminar_Venta_Alimento_X_Fecha(){
  $fecha= Carbon::today()->toDateString();
  $id_venta_alimento=Input::get('id_venta_alimento');
  $cantidad_vendido=Input::get('cantidad_alimento_vendido');
  $id_alimento=Input::get('id_alimento_venta');
  $id_comercio=Auth::user()->id_comercio;
// dd($id_venta_alimento,$cantidad_vendido,$id_alimento,$id_comercio);
  $check = DB::table('venta_alimento')
  ->where('id',$id_venta_alimento)
  ->where('id_comercio',$id_comercio)
  ->delete();
  $check2 = DB::table('producto_alimento')
  ->where('id',$id_alimento)->first();
  $alimentos = array(
    'cantidad_alimento'       => $check2->cantidad_alimento+$cantidad_vendido
    );
  $check = DB::table('producto_alimento')
  ->where('id',$id_alimento)
  ->where('id_comercio',$id_comercio)
  ->update($alimentos);
  $VentaAlimento=VentaAlimento::where('hora_venta_alimento', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->paginate(8);
  return view('Ventas/Alimentos/Tablas/Ultimas_Ventas_Alimentos_Tabla_x_Fecha')
  ->with('VentaAlimento',$VentaAlimento);
}
public function Consultar_Alimento_x_Busqueda(){
  $id_alimento=Input::get('alimento_id_venta_consulta');
  $fecha= Carbon::today()->toDateString();
  $id_comercio=Auth::user()->id_comercio;
  $VentaAlimento=VentaAlimento::where('hora_venta_alimento', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->where('alimento_id',$id_alimento)
  ->paginate(8);
  return view('Ventas/Alimentos/Consultas/Consultando_VentaAlimentos_Tabla_x_Fecha')->with('VentaAlimento',$VentaAlimento);
}

  // Carga las ultimas Ventas de alimentos en Ventas_Alimentos_X_Fecha#
public function Tabla_Venta_Alimentos_X_Fecha(){
  $fecha= Carbon::today()->toDateString();
  $id_comercio=Auth::user()->id_comercio;
// dd($fecha);
// $VentaProducto=VentaProducto::where('hora_venta_producto', '>=',$fecha)
  $VentaAlimento=VentaAlimento::where('fecha_alimento_venta',$fecha)
  ->where('id_comercio',$id_comercio)
  ->orderBy('id','desc')
  ->paginate(8);
  return view('Ventas/Alimentos/Tablas.Ultimas_Ventas_Alimentos_Tabla_x_Fecha')->with('VentaAlimento',$VentaAlimento);
}
   // Carga el valor de lasultimas Ventas de alimentos en Ventas_Alimentos_X_Fecha#
public function Cuadrado_Venta_Alimentos_X_Fecha(){
  $fecha= Carbon::today()->toDateString();
  $id_comercio=Auth::user()->id_comercio;
  $TotalVendido =VentaAlimento::where('hora_venta_alimento', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->sum('total_alimento_venta');
  $CantidadVendida =VentaAlimento::where('hora_venta_alimento', '>=',$fecha)
  ->where('id_comercio',$id_comercio)
  ->count('id');
  $TotalVendido=number_format($TotalVendido);
  return view('Ventas/Alimentos/Cuadros.Cuadro_Ventas_Alimentos_X_Fecha')->with('TotalVendido',$TotalVendido)->with('CantidadVendida',$CantidadVendida);
}
// Elimina la venta de aliemento en la vista registrar Venta Alimento
public function Eliminar_Venta_Alimento(){
  $id_venta_alimento=Input::get('id_venta_alimento');
  $cantidad_vendido=Input::get('cantidad_alimento_vendido');
  $id_alimento=Input::get('id_alimento_venta');
  $id_comercio=Auth::user()->id_comercio;
  $fecha= Input::get('Hora_Venta');
  $check = DB::table('venta_alimento')
  ->where('id',$id_venta_alimento)
  ->where('id_comercio',$id_comercio)
  ->delete();
  $check2 = DB::table('producto_alimento')
  ->where('id',$id_alimento)->first();
  $alimentos = array(
    'cantidad_alimento'       => $check2->cantidad_alimento+$cantidad_vendido
    );
  $check = DB::table('producto_alimento')
  ->where('id',$id_alimento)
  ->where('id_comercio',$id_comercio)
  ->update($alimentos);
  $VentaAlimento=VentaAlimento::where('hora_venta_alimento',$fecha)
  ->where('id_comercio',$id_comercio)
  ->orderBy('id','desc')
  ->paginate(5);
  $TotalVendido =VentaAlimento::where('hora_venta_alimento',$fecha)
  ->where('id_comercio',$id_comercio)
  ->sum('total_alimento_venta');
  $TotalVendido=number_format($TotalVendido);
  return view('Ventas/Alimentos/Tablas/VentaAlimentosTabla')
  ->with('VentaAlimento',$VentaAlimento)
  ->with('TotalVendido',$TotalVendido);
}
public function Cargar_detalles_Alimentos_Venta(){
  $id=Input::get('id_alimento');
  $resultados =Alimento::where('id',$id)->get();
  foreach ($resultados  as $resultado) {
    $stock=$resultado->cantidad_alimento;
    $valor_venta_alimento=$resultado->valor_venta_alimento;
    $ruta_imagen_alimento=$resultado->ruta_imagen_alimento;
  }

  if($ruta_imagen_alimento==null){
    $ruta_imagen_alimento="No Disponible";
  }

  return Response::json(['stock'=>$stock,'valor_venta_alimento'=>$valor_venta_alimento,'ruta_imagen_alimento'=>$ruta_imagen_alimento]);
}
public function RegistrarVentaAlimentos(){
  $rules = array
  (
    'NumeroComercio'       => 'required',
    'id_alimento'       => 'required|numeric',
    'Cantidad_Alimentos_Venta' => 'required|min:1|numeric',
    'valor_venta_alimento'   => 'required|min:1|numeric',
    'valor_total_venta_alimentos2'    => 'required|min:1|numeric',
    'Hora_Venta_Alimentos'    => 'required',
    'Fecha_Actual_Venta_Alimento'   => 'required'
    );
  $message = array
  (
    'NumeroComercio.required'        => ' Se requiere el id de comercio',
    'id_alimento.required'        => ' Seleccione un producto de la lista.',
    'id_alimento.numeric'         => ' Seleccione un producto de la lista.',
    'Cantidad_Alimentos_Venta.required'  => ' Porfavor Ingrese una Cantidad.',
    'Cantidad_Alimentos_Venta.min'     => ' Porfavor Ingrese una Cantidad.',
    'Cantidad_Alimentos_Venta.numeric'   => ' Porfavor Ingrese una Cantidad.',
    'valor_venta_alimento.required'  => ' Porfavor Ingrese un precio de venta.',
    'valor_venta_alimento.min'     => ' Porfavor Ingrese un precio de venta.',
    'valor_venta_alimento.numeric'   => ' Porfavor Ingrese un precio de venta.',
    'valor_total_venta_alimentos2.required'   => ' Porfavor Ingrese un total de producto.',
    'valor_total_venta_alimentos2.min'      => ' Porfavor Ingrese un total de producto.',
    'valor_total_venta_alimentos2.numeric'    => ' Porfavor Ingrese un total de producto.',
    'Hora_Venta_Alimentos.required'   => ' Porfavor Ingrese la fecha de la venta.',
    'Fecha_Actual_Venta_Alimento.required'  => ' Porfavor Ingrese la fecha de la venta.'
    );
  $validator = Validator::make(Input::All(), $rules, $message);
  if ($validator->fails()) {
    return Response::json(['success' =>false,
      'errors'=>$validator->errors()->toArray()]);
  }else{
    $Venta_Alimentos=Input::all();
    $id_alimento =$Venta_Alimentos['id_alimento'];
    $hora_venta_alimento =$Venta_Alimentos['Hora_Venta_Alimentos'];
    $cantidad_alimento_venta =$Venta_Alimentos['Cantidad_Alimentos_Venta'];
    $total_alimento_venta=$Venta_Alimentos['valor_total_venta_alimentos2'];
// dd($id_producto,$hora_venta_producto,$cantidad_producto_venta);
    $id_comercio=Auth::user()->id_comercio;
    $check = DB::table('venta_alimento')
    ->where('alimento_id',$id_alimento)
    ->where('hora_venta_alimento',$hora_venta_alimento)->first();
    if($check==null){
      $CantidadVentaAlimento    = $Venta_Alimentos['Cantidad_Alimentos_Venta'];
      $StockVentaProducto       = $Venta_Alimentos['stock_alimento'];
      $StockVentaAlimento=(int)$StockVentaProducto;
      $CantidadVentaAlimento=(int)$CantidadVentaAlimento;
      $TotalAlimento=$StockVentaAlimento-$CantidadVentaAlimento;
      $alimentos = array(
        'cantidad_alimento'       => $TotalAlimento
        );
      $check = DB::table('producto_alimento')
      ->where('id',$Venta_Alimentos['id_alimento'])
      ->where('id_comercio',$id_comercio)
      ->update($alimentos);
      $Venta_Alimentos = array(
        'id_comercio'             => $Venta_Alimentos['NumeroComercio'],
        'alimento_id'             => $Venta_Alimentos['id_alimento'],
        'cantidad_alimento_venta' => $Venta_Alimentos['Cantidad_Alimentos_Venta'],
        'precio_alimento_venta'   => $Venta_Alimentos['valor_venta_alimento'],
        'total_alimento_venta'    => $Venta_Alimentos['valor_total_venta_alimentos2'],
        'fecha_alimento_venta'    => $Venta_Alimentos['Fecha_Actual_Venta_Alimento'],
        'hora_venta_alimento'     => $Venta_Alimentos['Hora_Venta_Alimentos'],
        );
      $check = DB::table('venta_alimento')->insert($Venta_Alimentos);
      if($check >0){
        return 0;
      }else{
        return 1;
      }
    }else{
      $check2 = DB::table('venta_alimento')
      ->where('alimento_id',$Venta_Alimentos['id_alimento'])
      ->where('hora_venta_alimento',$Venta_Alimentos['Hora_Venta_Alimentos'])->first();
      $alimentos = array(
        'cantidad_alimento_venta'       => $check->cantidad_alimento_venta+$cantidad_alimento_venta,
        'total_alimento_venta'          => $check->total_alimento_venta+$total_alimento_venta
        );
      $check = DB::table('venta_alimento')
      ->where('alimento_id',$id_alimento)
      ->where('hora_venta_alimento',$hora_venta_alimento)
      ->update($alimentos);
    }
  }
}

public function Ultimos_alimentos_vendidos(){
  $id_comercio=Auth::user()->id_comercio;
  $fecha= Input::get('Hora_Venta');
  $VentaAlimento=VentaAlimento::where('hora_venta_alimento',$fecha)
  ->where('id_comercio',$id_comercio)
  ->orderBy('id','desc')
  ->paginate(5);
  $TotalVendido =VentaAlimento::where('hora_venta_alimento',$fecha)
  ->where('id_comercio',$id_comercio)
  ->sum('total_alimento_venta');
  $TotalVendido=number_format($TotalVendido);
// $alimentos=Producto::where('hora_venta_producto', '>=', date('Y-m-d').' 00:00:00'));
  return view('Ventas/Alimentos/Tablas/VentaAlimentosTabla')
  ->with('VentaAlimento',$VentaAlimento)
  ->with('TotalVendido',$TotalVendido);
}

  // public function ListarDataProductos()   {
  //   $id_comercio=Auth::user()->id_comercio;
  //   $id=Input::get('id');
  //   $productos = Producto::where('id', $id)
  //   ->where('id_comercio',$id_comercio)
  //   ->get();
  //   return $productos;
  // }
public function Cargar_nombres_alimentos(){
  $id_comercio=Auth::user()->id_comercio;
  $resultado =Alimento::where('id_comercio', $id_comercio)->orderBy('nombre_alimento','ASC')->lists('nombre_alimento','id');
  return $resultado;
}
  // public function Cargar_detalles_Productos_Venta(){
  //   $id=Input::get('id_producto');
  //   $resultados =Producto::where('id',$id)->get();

  //   foreach ($resultados  as $resultado) {
  //     $stock=$resultado->cantidad_producto;
  //     $valor_venta_producto=$resultado->valor_venta_producto;
  //     $ruta_imagen_producto=$resultado->ruta_imagen_producto;
  //   }
  //   if($ruta_imagen_producto="null"){
  //     $ruta_imagen_producto="No Disponible";
  //   }
  //   return Response::json(['stock'=>$stock,'valor_venta_producto'=>$valor_venta_producto,'ruta_imagen_producto'=>$ruta_imagen_producto]);
  // }
  // public function Cargar_Ventas_Productos(){
  //   $Fecha_Actual= Carbon::today()->toDateString();
  //   $id_comercio=Auth::user()->id_comercio;
  //   $VentaProducto =VentaProducto::where('fecha_producto_venta',$Fecha_Actual)
  //   ->where('id_comercio',$id_comercio)
  //   ->orderBy('hora_venta_producto','desc')
  //   ->paginate(5);
  //   return view('Productos/Tablas/VentaProductosTabla')->with('VentaProducto',$VentaProducto)->render();
  // }
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
    $CantidadVentaProducto    = Input::get('cantidad_producto_venta');
    $StockVentaProducto     = Input::get('stock_producto');
    $StockVentaProducto=(int)$StockVentaProducto;
    $CantidadVentaProducto=(int)$CantidadVentaProducto;
    $TotalProducto=$StockVentaProducto-$CantidadVentaProducto;
    $HoraVentaActual= $today = Carbon::today()->now();
    $productos = array(
      'cantidad_producto'       => $TotalProducto
      );
    $check = DB::table('producto_producto')
    ->where('id',$venta_producto['producto_id'])
    ->where('id_comercio',$venta_producto['id_comercio'])
    ->update($productos);
    $venta_productos = array(
      'id_comercio'         => $venta_producto['id_comercio'],
      'producto_id'         => $venta_producto['producto_id'],
      'cantidad_producto_venta'   => $venta_producto['cantidad_producto_venta'],
      'precio_producto_venta'   => $venta_producto['precio_producto_venta'],
      'total_producto_venta'    => $venta_producto['total_producto_venta'],
      'fecha_producto_venta'    => $venta_producto['fecha_producto_venta'],
      'hora_venta_producto'   => $HoraVentaActual
      );
    $check = DB::table('venta_producto')->insert($venta_productos);
    if($check >0){
      return 0;
    }else{
      return 1;
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