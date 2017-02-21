<?php

namespace App\Http\Controllers\ControllerCompras;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\Internet\VentaInternet;
use Carbon\Carbon;
use File;
use Excel;
use PHPExcel_Style_Alignment;
use App;
use PDF;
use DB;
use View;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;


class AdministrarComprasController extends Controller {

	public function __construct(){
		Carbon::setLocale('es');

	}

	public function AdministrarCompras(){
		return view('AdministrarCompras.Index_Compras');
	}

	public function Cargar_Tabla_Ventas_Internet(){
		$fecha= Carbon::today()->toDateString();		
		$id_comercio=Auth::user()->id_comercio; 

		$VentaInternet=VentaInternet::Where('fecha_internet_venta',$fecha)
		->Where('id_comercio',$id_comercio)->paginate(4);

		$Valor_Venta_Internet=VentaInternet::Where('fecha_internet_venta',$fecha)
		->Where('id_comercio',$id_comercio)
		->sum('venta_total_dia');

		return view('AdministrarInternet/Tablas.Tabla_Ingreso_Internet')
		->with('VentaInternet',$VentaInternet)
		->with('Valor_Venta_Internet',$Valor_Venta_Internet);
	}

	public function Registrar_Venta_Internet(){
		$fecha= Input::get('Fecha_Ingreso_Venta_Internet');
		$id_comercio=Auth::user()->id_comercio;

		$VentaInternet=VentaInternet::Where('fecha_internet_venta',$fecha)
		->Where('id_comercio',$id_comercio)->get();
		$venta_total_dia=0;		
		
		foreach ($VentaInternet as $key => $value) {
			$venta_total_dia=$value->venta_total_dia;
		}

		if($venta_total_dia!=0){
			return Response::json(['ErrorAlRegistrar'=>"Tiene Ventas"]);
		}else{
			$rules = array
			(
				'Valor_Venta_Ingresar_Internet_oculto'		=> 'required',
				'Fecha_Ingreso_Venta_Internet'				=> 'required'					
				);

			$message = array
			(
				'Valor_Venta_Ingresar_Internet_oculto.required' => ' Se requiere Valor Venta.',	
				'Fecha_Ingreso_Venta_Internet.required' => ' Se requiere la fecha de la venta.',
				);

			$validator = Validator::make(Input::All(), $rules, $message);
			if ($validator->fails()) {
				return Response::json(['success' =>false,
					'errors'=>$validator->errors()->toArray()]);		
			}else{
				$VentaInternet = Input::all();


				$Fecha_Registro=Input::get('Fecha_Ingreso_Venta_Internet');
				$HoraRegistro=Carbon::now()->toTimeString();

				$datos_registro = array(
					'fecha_internet_venta' 	=> $VentaInternet['Fecha_Ingreso_Venta_Internet'],
					'venta_total_dia' 		=> $VentaInternet['Valor_Venta_Ingresar_Internet_oculto'],
					'id_comercio' 			=> $id_comercio,
					'hora_venta_internet' 	=> $Fecha_Registro.' '.$HoraRegistro				
					);
				$check = DB::table('venta_internet')			
				->insert($datos_registro);

				if($check >0){
					return 0;
				}else{
					return 1;	
				}
			}
		}
	}

	public function Eliminar_Venta_Internet(){
		$id_venta_internet_eliminar=Input::get('id_venta_internet_eliminar');
		$id_comercio=Auth::user()->id_comercio; 
		$check = DB::table('venta_internet')
		->where('id_venta_internet',$id_venta_internet_eliminar)
		->where('id_comercio',$id_comercio)
		->delete();

		if($check >0){
			return 0;
		}else{
			return 1;	
		}
	}

	public function Editar_Venta_Internet(){
		$id_venta_internet_oculto=Input::get('id_venta_internet_oculto');
		$valor_venta_internet_editar_oculto=Input::get('valor_venta_internet_editar_oculto');
		$Fecha_Ingreso_Venta_Internet_editar=Input::get('Fecha_Ingreso_Venta_Internet_editar');
		$id_comercio=Auth::user()->id_comercio; 
		
		$rules = array
		(
			'valor_venta_internet_editar_oculto'		=> 'required',
			'Fecha_Ingreso_Venta_Internet_editar'		=> 'required'					
			);

		$message = array
		(
			'valor_venta_internet_editar_oculto.required' => ' Se requiere Valor Venta.',	
			'Fecha_Ingreso_Venta_Internet_editar.required' => ' Se requiere la fecha de la venta.',
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Fecha_Registro=Input::get('Fecha_Ingreso_Venta_Internet_editar');
			$HoraRegistro=Carbon::now()->toTimeString();

			$datos_registro = array(
				'fecha_internet_venta' 	=> $Fecha_Registro,
				'venta_total_dia' 		=> $valor_venta_internet_editar_oculto,
				'hora_venta_internet' 	=> $Fecha_Registro.' '.$HoraRegistro				
				);
			$check = DB::table('venta_internet')
			->Where('id_venta_internet',$id_venta_internet_oculto)
			->Where('id_comercio',$id_comercio)
			->update($datos_registro);

			
			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}

}
