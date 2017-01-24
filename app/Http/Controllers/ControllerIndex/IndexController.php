<?php

namespace App\Http\Controllers\ControllerIndex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use App\Models\Alimentos\Alimento;
use App\Models\Productos\Producto;
use App\Models\Productos\VentaProducto;
use App\Models\Alimentos\VentaAlimento;
use Control_5_3\Models\Cargo\Cargo;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use Hash;



class IndexController extends Controller{



	public function Index(){
		return view('Index.index');
	}

	public function Cargar_Ventas(){	
		return view('Ventas.Cargar_Ventas');
	}

	public function Cargar_grafica_estadistica(){

		return view('Index/GraficaEstadisticas.Grafica_Estadistica_Index');
	}

	public function Consultar_Ventas_X_Fecha(){
		$id_comercio=Auth::user()->id_comercio;
		$Fecha_Inicial=Input::get('Fecha_Inicial');
		$Fecha_Final=Input::get('Fecha_Final');


		$TotalVentaProducto=VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_producto_venta');
		$TotalVentaProducto=number_format($TotalVentaProducto); 

		$TotalVentaAlimento=VentaAlimento::whereBetween('fecha_alimento_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->sum('total_alimento_venta');
		$TotalVentaAlimento=number_format($TotalVentaAlimento);


		$TotalProductos= VentaProducto::whereBetween('fecha_producto_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->count('id');   
		$TotalProductos=number_format($TotalProductos);


		$TotalAlimentos=VentaAlimento::whereBetween('fecha_alimento_venta', array($Fecha_Inicial, $Fecha_Final))
		->Where('id_comercio',$id_comercio)
		->count('id');   
		$TotalAlimentos=number_format($TotalAlimentos);



		return Response::json(['TotalVentaProducto'=>$TotalVentaProducto,
			'TotalVentaAlimento'=>$TotalVentaAlimento,
			'TotalProductos'=>$TotalProductos,
			'TotalAlimentos'=>$TotalAlimentos]);
	}

}
