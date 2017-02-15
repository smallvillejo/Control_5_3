<?php

namespace App\Http\Controllers\ControllerRecargas;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\Recargas\VentaRecarga;
use App\Models\Recargas\CategoriaRecarga;
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


class AdministrarRecargasController extends Controller {

	public function AdministrarRecargas(){
		return view('AdministrarRecargas.Index_Recargas');
	}

	public function Cargar_Tabla_Recargas_Ingresados(){
		$fecha= Carbon::today()->toDateString();
		$id_comercio=Auth::user()->id_comercio; 

		$VentaRecargas=VentaRecarga::Where('fecha_venta_recarga',$fecha)
		->Where('id_comercio',$id_comercio)->paginate(5);

		$Valor_Venta_Recarga=VentaRecarga::Where('fecha_venta_recarga',$fecha)
		->Where('id_comercio',$id_comercio)
		->sum('valor_venta_recarga');

		return view('AdministrarRecargas/Tablas.Tabla_Ingreso_Recargas')
		->with('VentaRecargas',$VentaRecargas)
		->with('Valor_Venta_Recarga',$Valor_Venta_Recarga);
	}

	public function Listar_Categorias(){
		$id_comercio=Auth::user()->id_comercio; 
		$Categorias_Recargas=CategoriaRecarga::where('id_comercio',$id_comercio)->get();	
		$Nombre_Categoria=[];
		$Nombre_Categoria[0] = "";

		foreach ($Categorias_Recargas as $Categorias) {
			$Nombre_Categoria[$Categorias->id] = '---'.strtoupper($Categorias->nombre_categoria).'---';
		}

		return Response::json(['success' =>true,			
			'Nombre_Categoria'=>$Nombre_Categoria			
			]);
	}

	public function Registrar_Nueva_Categoria(){
		$rules = array
		(
			'Nombre_Nueva_Categoria'					=> 'required|max:30'					
			);

		$message = array
		(
			'Nombre_Nueva_Categoria.required' => ' Se requiere un nombre nuevo.',
			'Nombre_Nueva_Categoria.max' 	=> ' La Categoria debe ser maximo de 30 Caracteres.'
			);
		
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$Categorias = Input::all();
			$id_comercio=Auth::user()->id_comercio;

			$datos_registro = array(
				'nombre_categoria' 	=> $Categorias['Nombre_Nueva_Categoria'],
				'id_comercio' 		=> $id_comercio	
				);
			$check = DB::table('categoria_recargas')
			->where('id_comercio',$id_comercio)
			->insert($datos_registro);

			if($check >0){
				return 0;
			}else{
				return 1;	
			}
		}
	}

	public function Consultar_Categoria(){
		$Id_Categoria=Input::get('id_categoria_listar');

		$Categorias=CategoriaRecarga::Where('id',$Id_Categoria)->get();

		foreach ($Categorias as $key => $value) {
			$NombreCategoria=strtoupper($value->nombre_categoria);
		}
		return Response::json(['success' =>true,			
			'NombreCategoria'=>$NombreCategoria			
			]);
	}

	public function Editar_Categoria(){
		$Nombre_Editar_Categoria=Input::get('Nombre_Editar_Categoria');
		$id_categoria_oculto_editar=Input::get('id_categoria_oculto_editar');

		$rules = array
		(
			'Nombre_Editar_Categoria'			=> 'required|max:30'					
			);

		$message = array
		(
			'Nombre_Editar_Categoria.required' => ' Se requiere un nombre nuevo.',
			'Nombre_Editar_Categoria.max' 	=> ' La Categoria debe ser maximo de 30 Caracteres.'
			);		
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$id_comercio=Auth::user()->id_comercio; 
			$datos_registro = array(
				'nombre_categoria' 	=> $Nombre_Editar_Categoria					
				);
			$check = DB::table('categoria_recargas')
			->where('id',$id_categoria_oculto_editar)
			->where('id_comercio',$id_comercio)
			->update($datos_registro);

			if($check >0){
				return 0;
			}else{
				return 1;	
			}

		}
	}

	public function Eliminar_Categoria(){
		$Id_Categoria=Input::get('Id_Categoria_Eliminar');
		$id_comercio=Auth::user()->id_comercio; 

		$check = DB::table('categoria_recargas')
		->where('id',$Id_Categoria)
		->where('id_comercio',$id_comercio)
		->delete();

		if($check >0){
			return 0;
		}else{
			return 1;	
		}
	}

}
