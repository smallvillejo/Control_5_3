<?php

namespace App\Http\Controllers\ControllerCompras;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\Compras\Compras;
use App\Models\Empresas\Empresa;
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
		$Empresa=Empresa::all();
		$NombreEmpresa="";
		foreach ($Empresa as $key => $value) {
			$NombreEmpresa=$value->nombre_empresa;      
		}
		if($NombreEmpresa!=""){
			return view('AdministrarCompras.Index_Compras');
		}else{
			return View('Usuarios.Account');
		}
		
	}

	public function Cargar_Tabla_Compras(){
		$fecha= Carbon::today()->toDateString();		
		$id_comercio=Auth::user()->id_comercio; 

		$Compras=Compras::Where('fecha_compra',$fecha)
		->Where('id_comercio',$id_comercio)->paginate(2);

		$Valor_Compras=Compras::Where('fecha_compra',$fecha)
		->Where('id_comercio',$id_comercio)
		->sum('valor_total_compra');

		return view('AdministrarCompras/Tablas.Tabla_Ingreso_Compras')
		->with('Compras',$Compras)
		->with('Valor_Compras',$Valor_Compras);
	}

	public function Registrar_Compra(){

		$id_comercio=Auth::user()->id_comercio;
		$rules = array
		(
			'Fecha_Ingreso_Compra'			=> 'required',
			'Valor_Ingreso_Compra_oculto'	=> 'required',
			'Descripcion_Ingreso_Compra'	=> 'required|max:300'					
			);

		$message = array
		(
			'Fecha_Ingreso_Compra.required' => ' Se requiere Fecha de Compra.',	
			'Valor_Ingreso_Compra_oculto.required' => ' Se Requiere Valor de la Compra.',
			'Descripcion_Ingreso_Compra.required' => ' Se requiere descripción de la Compra.',
			'Descripcion_Ingreso_Compra.max' => ' Son 300 Caracteres Máximo Permitidos para la descripción de la compra.'
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Compras = Input::all();
			$Fecha_Registro=Input::get('Fecha_Ingreso_Compra');
			$HoraRegistro=Carbon::now()->toTimeString();

			$datos_registro = array(
				'fecha_compra' 			=> $Compras['Fecha_Ingreso_Compra'],
				'descripcion_compra' 	=> $Compras['Descripcion_Ingreso_Compra'],
				'valor_total_compra' 	=> $Compras['Valor_Ingreso_Compra_oculto'],
				'id_comercio' 			=> $id_comercio,
				'hora_compra' 			=> $Fecha_Registro.' '.$HoraRegistro	
				);
			$check = DB::table('compras')			
			->insert($datos_registro);

			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}

	public function Editar_Compra(){
		$Id_Compra_Editar=Input::get('Id_Compra_Editar');
		$Fecha_Ingreso_Compra_Editar=Input::get('Fecha_Ingreso_Compra_Editar');
		$Valor_Ingreso_Compra_Oculto_Editar=Input::get('Valor_Ingreso_Compra_Oculto_Editar');
		$Descripcion_Ingreso_Compra_Editar=Input::get('Descripcion_Ingreso_Compra_Editar');
		$id_comercio=Auth::user()->id_comercio; 
		
		$rules = array
		(
			'Valor_Ingreso_Compra_Oculto_Editar'	=> 'required',
			'Fecha_Ingreso_Compra_Editar'			=> 'required',
			'Descripcion_Ingreso_Compra_Editar'		=> 'required|max:300'				
			);

		$message = array
		(
			'Fecha_Ingreso_Compra_Editar.required' => ' Se requiere Fecha de Compra.',	
			'Valor_Ingreso_Compra_Oculto_Editar.required' => ' Se Requiere Valor de la Compra.',
			'Descripcion_Ingreso_Compra_Editar.required' => ' Se requiere descripción de la Compra.',
			'Descripcion_Ingreso_Compra_Editar.max' => ' Son 300 Caracteres Máximo Permitidos para la descripción de la compra.'
			);

		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Fecha_Registro=Input::get('Fecha_Ingreso_Compra_Editar');
			$HoraRegistro=Carbon::now()->toTimeString();

			$datos_registro = array(
				'fecha_compra' 		   => $Fecha_Registro,
				'descripcion_compra'   => $Descripcion_Ingreso_Compra_Editar,
				'valor_total_compra'   => $Valor_Ingreso_Compra_Oculto_Editar,
				'hora_compra' 		   => $Fecha_Registro.' '.$HoraRegistro
				);
			$check = DB::table('compras')
			->Where('id_compra',$Id_Compra_Editar)
			->Where('id_comercio',$id_comercio)
			->update($datos_registro);

			
			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}


	public function Eliminar_Compra(){
		$id_compra_eliminar=Input::get('id_compra_eliminar');
		$id_comercio=Auth::user()->id_comercio; 
		$check = DB::table('compras')
		->where('id_compra',$id_compra_eliminar)
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
