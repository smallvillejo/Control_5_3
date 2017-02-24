<?php

namespace App\Http\Controllers\ControllerGastosInversion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\Gastos\Gasto;
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


class AdministrarGastosInversionController extends Controller {

	public function __construct(){
		Carbon::setLocale('es');

	}

	public function AdministrarGastos(){
		return view('AdministrarGastosInversion.Index_GastosInversion');
	}

	public function Cargar_Tabla_Gastos(){
		$fecha= Carbon::today()->toDateString();		
		$id_comercio=Auth::user()->id_comercio; 

		$Gasto=Gasto::Where('fecha_gasto',$fecha)
		->Where('id_comercio',$id_comercio)->paginate(2);

		$Valor_Gasto=Gasto::Where('fecha_gasto',$fecha)
		->Where('id_comercio',$id_comercio)
		->sum('valor_gasto');

		return view('AdministrarGastosInversion/Tablas.Tabla_Ingreso_GastosInversion')
		->with('Gasto',$Gasto)
		->with('Valor_Gasto',$Valor_Gasto);
	}

	public function Registrar_Gasto(){

		$id_comercio=Auth::user()->id_comercio;
		$rules = array
		(
			'Fecha_Ingreso_Gasto'			=> 'required',
			'Valor_Ingreso_Gasto_oculto'	=> 'required',
			'Descripcion_Ingreso_Gasto'	=> 'required|max:300'					
			);

		$message = array
		(
			'Fecha_Ingreso_Gasto.required' => ' Se requiere Fecha de Gasto.',	
			'Valor_Ingreso_Gasto_oculto.required' => ' Se Requiere Valor de la Gasto.',
			'Descripcion_Ingreso_Gasto.required' => ' Se requiere descripción de la Gasto.',
			'Descripcion_Ingreso_Gasto.max' => ' Son 300 Caracteres Máximo Permitidos para la descripción de la Gasto.'
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Gastos = Input::all();
			$Fecha_Registro=Input::get('Fecha_Ingreso_Gasto');
			$HoraRegistro=Carbon::now()->toTimeString();

			$datos_registro = array(
				'fecha_gasto' 			=> $Gastos['Fecha_Ingreso_Gasto'],
				'descripcion_gasto' 	=> $Gastos['Descripcion_Ingreso_Gasto'],
				'valor_gasto' 			=> $Gastos['Valor_Ingreso_Gasto_oculto'],
				'id_comercio' 			=> $id_comercio,
				'hora_gasto' 			=> $Fecha_Registro.' '.$HoraRegistro	
				);
			$check = DB::table('gasto_inversion')			
			->insert($datos_registro);

			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}

	public function Editar_Gasto(){
		$Id_Gasto_Editar=Input::get('Id_Gasto_Editar');
		$Fecha_Ingreso_Gasto_Editar=Input::get('Fecha_Ingreso_Gasto_Editar');
		$Valor_Ingreso_Gasto_Oculto_Editar=Input::get('Valor_Ingreso_Gasto_Oculto_Editar');
		$Descripcion_Ingreso_Gasto_Editar=Input::get('Descripcion_Ingreso_Gasto_Editar');
		$id_comercio=Auth::user()->id_comercio; 
		
		$rules = array
		(
			'Valor_Ingreso_Gasto_Oculto_Editar'	=> 'required',
			'Fecha_Ingreso_Gasto_Editar'			=> 'required',
			'Descripcion_Ingreso_Gasto_Editar'		=> 'required|max:300'				
			);

		$message = array
		(
			'Fecha_Ingreso_Gasto_Editar.required' => ' Se requiere Fecha de Gasto.',	
			'Valor_Ingreso_Gasto_Oculto_Editar.required' => ' Se Requiere Valor del Gasto.',
			'Descripcion_Ingreso_Gasto_Editar.required' => ' Se requiere descripción del Gasto.',
			'Descripcion_Ingreso_Gasto_Editar.max' => ' Son 300 Caracteres Máximo Permitidos para la descripción del Gasto.'
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Fecha_Registro=Input::get('Fecha_Ingreso_Gasto_Editar');
			$HoraRegistro=Carbon::now()->toTimeString();

			$datos_registro = array(
				'fecha_gasto' 		    => $Fecha_Registro,
				'descripcion_gasto'     => $Descripcion_Ingreso_Gasto_Editar,
				'valor_gasto'   		=> $Valor_Ingreso_Gasto_Oculto_Editar,
				'hora_gasto' 		    => $Fecha_Registro.' '.$HoraRegistro
				);
			$check = DB::table('gasto_inversion')
			->Where('id_gasto',$Id_Gasto_Editar)
			->Where('id_comercio',$id_comercio)
			->update($datos_registro);

			
			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}


	public function Eliminar_Gasto(){
		$id_gasto_eliminar=Input::get('id_gasto_eliminar');
		$id_comercio=Auth::user()->id_comercio; 
		$check = DB::table('gasto_inversion')
		->where('id_gasto',$id_gasto_eliminar)
		->where('id_comercio',$id_comercio)
		->delete();

		if($check >0){
			return 0;
		}else{
			return 1;	
		}
	}	

}
