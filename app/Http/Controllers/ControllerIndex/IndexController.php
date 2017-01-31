<?php

namespace App\Http\Controllers\ControllerIndex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use App\Models\Alimentos\Alimento;
use App\Models\Productos\Producto;
use App\Models\Productos\VentaProducto;
use App\Models\Alimentos\VentaAlimento;
use App\Models\MinutosCelular\DetallePlanMinutos;
use App\Models\Internet\VentaInternet;
use App\Models\Recargas\VentaRecarga;
use App\Models\Compras\Compra;
use App\Models\Gastos\Gasto;
use Control_5_3\Models\Cargo\Cargo;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Hash;
use Excel;
use PHPExcel_Style_Alignment;
use App;
use PDF;
use File;



class IndexController extends Controller{



	public function Index(){
		return view('Index.index');
	}

	public function Cargar_Ventas(){	
		return view('Ventas.Cargar_Ventas');
	}

	public function Cargar_grafica_estadistica(){

		$id_comercio=Auth::user()->id_comercio;
		$Fecha_Inicial=Input::get('Fecha_Inicial');
		$Fecha_Final=Input::get('Fecha_Final');


		$TotalVentaProducto=VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_producto_venta');


		$TotalVentaAlimento=VentaAlimento::whereBetween('fecha_alimento_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_alimento_venta');	


		$TotalVentaMinutos=DetallePlanMinutos::whereBetween('fecha_registro', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_minutos_venta');		 

		$TotalVentaInternet=VentaInternet::whereBetween('fecha_internet_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('venta_total_dia');

		$TotalVentaRecarga=VentaRecarga::whereBetween('fecha_venta_recarga', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_venta_recarga');


		$TotalCompra=Compra::whereBetween('fecha_compra', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_total_compra');


		$TotalGasto=Gasto::whereBetween('fecha_gasto', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_gasto');


		if($TotalVentaProducto==null){
			$TotalVentaProducto=0;
		}
		if($TotalVentaAlimento==null){
			$TotalVentaAlimento=0;
		}
		if($TotalVentaMinutos==null){
			$TotalVentaMinutos=0;
		}
		if($TotalVentaInternet==null){
			$TotalVentaInternet=0;
		}
		if($TotalVentaRecarga==null){
			$TotalVentaRecarga=0;
		}
		if($TotalCompra==null){
			$TotalCompra=0;
		}
		if($TotalGasto==null){
			$TotalGasto=0;
		}		

		
		return view('Index/GraficaEstadisticas.Grafica_Estadistica_Index')
		->with('TotalVentaProducto',$TotalVentaProducto)
		->with('TotalVentaAlimento',$TotalVentaAlimento)
		->with('TotalVentaMinutos',$TotalVentaMinutos)
		->with('TotalVentaInternet',$TotalVentaInternet)
		->with('TotalVentaRecarga',$TotalVentaRecarga)
		->with('TotalCompra',$TotalCompra)
		->with('TotalGasto',$TotalGasto);
	}

	public function Consultar_Ventas_X_Fecha(){
		$id_comercio=Auth::user()->id_comercio;
		$Fecha_Inicial=Input::get('Fecha_Inicial');
		$Fecha_Final=Input::get('Fecha_Final');


		$TotalVentaProducto=VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_producto_venta');


		$TotalVentaAlimento=VentaAlimento::whereBetween('fecha_alimento_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_alimento_venta');	


		$TotalProductos= VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->count('id');   
		$TotalProductos=number_format($TotalProductos);


		$TotalAlimentos=VentaAlimento::whereBetween('fecha_alimento_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->count('id');   
		$TotalAlimentos=number_format($TotalAlimentos);


		$TotalVentaMinutos=DetallePlanMinutos::whereBetween('fecha_registro', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_minutos_venta');		 

		$TotalVentaInternet=VentaInternet::whereBetween('fecha_internet_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('venta_total_dia');

		$TotalVentaRecarga=VentaRecarga::whereBetween('fecha_venta_recarga', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_venta_recarga');


		$TotalCompra=Compra::whereBetween('fecha_compra', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_total_compra');


		$TotalGasto=Gasto::whereBetween('fecha_gasto', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('valor_gasto');


		$TotalGanancia=$TotalVentaProducto+$TotalVentaAlimento+$TotalVentaMinutos+$TotalVentaInternet+$TotalVentaRecarga-$TotalCompra-$TotalGasto;

		$TotalVentaProducto=number_format($TotalVentaProducto); 
		$TotalVentaAlimento=number_format($TotalVentaAlimento);
		$TotalVentaMinutos=number_format($TotalVentaMinutos);
		$TotalVentaInternet=number_format($TotalVentaInternet); 
		$TotalVentaRecarga=number_format($TotalVentaRecarga); 
		$TotalCompra=number_format($TotalCompra);
		$TotalGasto=number_format($TotalGasto);
		$TotalGanancia=number_format($TotalGanancia);




		return Response::json(['TotalVentaProducto'=>$TotalVentaProducto,
			'TotalVentaAlimento'=>$TotalVentaAlimento,
			'TotalProductos'=>$TotalProductos,
			'TotalAlimentos'=>$TotalAlimentos,
			'TotalVentaMinutos'=>$TotalVentaMinutos,
			'TotalVentaInternet'=>$TotalVentaInternet,
			'TotalVentaRecarga'=>$TotalVentaRecarga,
			'TotalCompra'=>$TotalCompra,
			'TotalGasto'=>$TotalGasto,
			'TotalGanancia'=>$TotalGanancia]);
	}

	public function ExportarReportBalanceExcel(){
		$nombreArchivo='Laravel_Excel';

		Excel::create($nombreArchivo, function($excel) {

			$excel->sheet('Excel sheet', function($sheet) {

				$sheet->setOrientation('landscape');


			});

		// })->export('xls');


		})->store('xlsx','exports');

		$RutaArchivo='Control_5_3/public/exports/'.$nombreArchivo.'.xlsx';


						


		// Para que funcione local
		return Response::json([
			'success' =>true,
			'path'=>'/Control_5_3/public/exports/'.$nombreArchivo.'.xlsx']);


 				// Para que funcione web
	// 	return Response::json([
	// 		'success' =>true,
	// 		'path'=>'/exports/'.$nombreArchivo.'.xlsx']);
	// }


	}

	public function ExportarReportBalancePdf(){
		dd(Input::all());
	}

}
