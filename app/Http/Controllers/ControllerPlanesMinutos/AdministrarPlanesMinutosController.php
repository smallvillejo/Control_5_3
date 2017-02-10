<?php

namespace App\Http\Controllers\ControllerPlanesMinutos;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\PlanesCelular\MinutosPlanes;
use App\Models\PlanesCelular\DetallePlanMinutos;
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


class AdministrarPlanesMinutosController extends Controller{

	public function AdministrarPlanes(){
		return view('AdministrarPlanes.Index_Minutos');
	}
// Cargan los nombres de todos los planes Registrados
	function cargar_nombres_planes_combox(){

		$id_comercio=Auth::user()->id_comercio;

		$plan = MinutosPlanes::where('id_comercio',$id_comercio)->get();	

		$nombre_plan=[];
		$nombre_plan[0] = "";

		foreach ($plan as $planes) {
			$nombre_plan[$planes->id] = strtoupper($planes->nombre_plan_minutos).' #'.$planes->NumeroPlan;
		}

		return Response::json(['success' =>true,			
			'nombre_plan'=>$nombre_plan			
			]);
	}
// se consultan todos los datos del plan seleccionado
	public function Consultar_Datos_PlanMinutos(){
		$plan_id=Input::get('plan_id');

		$plan = MinutosPlanes::where('id',$plan_id)->get();	

		foreach ($plan as $key => $value) {
			$nombre_plan_minutos=strtoupper($value->nombre_plan_minutos);
			$cantidad_minutos=strtoupper($value->cantidad_minutos);
			$cantidad_minutos_restantes=strtoupper($value->cantidad_minutos_restantes);
			$valor_venta_minutos=strtoupper($value->valor_venta_minutos);
		}

		return Response::json([			
			'nombre_plan_minutos'=>$nombre_plan_minutos,
			'cantidad_minutos'=>$cantidad_minutos,
			'cantidad_minutos_restantes'=>$cantidad_minutos_restantes,
			'valor_venta_minutos'=>$valor_venta_minutos		
			]);
	}

	function Registrar_Ingreso_Minutos (){
		$rules = array
		(
			'Fecha_Ingreso_Minutos'					=> 'required',
			'id_plan2'								=> 'required',	
			'Cantidad_Minutos_Vendidos_Registrar'	=> 'required|min:1|numeric',
			'Valor_Total_Minutos_Vendidoss'			=> 'required|min:1|numeric',			
			'comercio_id'							=> 'required'			
			);

		$message = array
		(
			'Fecha_Ingreso_Minutos.required' 				=> ' Se requiere la fecha de registro.',
			'id_plan2.required' 							=> ' Se requiere un plan.',	
			'Cantidad_Minutos_Vendidos_Registrar.required' 	=> ' Se requiere una cantidad de minutos.',
			'Cantidad_Minutos_Vendidos_Registrar.min' 		=> ' Se requiere una cantidad de minutos.',
			'Cantidad_Minutos_Vendidos_Registrar.numeric' 	=> ' La cantidad debe ser numerica.',

			'Valor_Total_Minutos_Vendidoss.required' 		=> ' Se requiere el total de minutos.',
			'Valor_Total_Minutos_Vendidoss.min' 			=> ' Se requiere el total de minutos.',
			'Valor_Total_Minutos_Vendidoss.numeric' 		=> ' El valor total debe ser numerico.',	
			'comercio_id.required' 	=> ' Porfavor Ingrese la fecha de la venta.'
			);
		
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {
			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);		
		}else{
			$plan = Input::all();
			$Cantidad_Minutos_Restantes			=$plan['Cantidad_Minutos_Restantes'];
			$Cantidad_Minutos_Vendidos 			=$plan['Cantidad_Minutos_Vendidos_Registrar'];
			$Total 							 	=$Cantidad_Minutos_Restantes-$Cantidad_Minutos_Vendidos;
			$datos_registro = array(
				'cantidad_minutos_restantes' => $Total			
				);	
			$check = DB::table('minutos_planes')
			->where('id',$plan['id_plan2'])
			->where('id_comercio',$plan['comercio_id'])
			->update($datos_registro);
			$hora_venta_recarga= Carbon::today()->now();
			$datos_registro = array(
				'fecha_registro' 			 		=> $plan['Fecha_Ingreso_Minutos'],
				'id_minutos_planes' 	 			=> $plan['id_plan2'],	
				'cantidad_minutos_vendidos' 	 	=> $plan['Cantidad_Minutos_Vendidos_Registrar'],
				'total_minutos_venta' 	   		 	=> $plan['Valor_Total_Minutos_Vendidoss'],
				'hora_registro' 					=> $hora_venta_recarga,
				'id_comercio' 	   		 			=> $plan['comercio_id'],	
				);
			$check = DB::table('detalle_plan_minutos')->insert($datos_registro );
			if($check >0){
				return 0;
			}else{
				return 1;	
			}			
		}
	}

	public function Cargar_Tabla_Minutos_Ingresados(){
		$fecha= Carbon::today()->toDateString();
		$id_comercio=Auth::user()->id_comercio; 

		$MinutosRegistrados=DetallePlanMinutos::Where('fecha_registro',$fecha)
		->Where('id_comercio',$id_comercio)->paginate(5);

		$valor_venta_minutos=DetallePlanMinutos::Where('fecha_registro',$fecha)
		->Where('id_comercio',$id_comercio)
		->sum('total_minutos_venta');

		return view('AdministrarPlanes/Tablas.Tabla_Ingreso_Minutos')
		->with('MinutosRegistrados',$MinutosRegistrados)
		->with('valor_venta_minutos',$valor_venta_minutos);
	}

	public function Cargar_datos_Minutos_Ingresados(){
		$Id_Minutos_Ingresados=Input::get('id');
		$id_comercio=Auth::user()->id_comercio; 

		$MinutosRegistrados=DetallePlanMinutos::Where('id_detalle_plan',$Id_Minutos_Ingresados)
		->Where('id_comercio',$id_comercio)->get();

		foreach ($MinutosRegistrados as $key => $value) {

			$NombrePlanMinutos=strtoupper($value->PlanMinutos->nombre_plan_minutos).'  #'.$value->PlanMinutos->NumeroPlan;
			$ValorMinutoPlan=$value->PlanMinutos->valor_venta_minutos;
			$MinutosRestantes=$value->PlanMinutos->cantidad_minutos_restantes;
			$MinutosVendidos=$value->cantidad_minutos_vendidos;
			$TotalVenta=$value->total_minutos_venta;
			$IdPlanMinutos=$value->PlanMinutos->id;
		}

		return Response::json([			
			'NombrePlanMinutos'=>$NombrePlanMinutos,
			'ValorMinutoPlan'=>$ValorMinutoPlan,
			'MinutosRestantes'=>$MinutosRestantes,
			'MinutosVendidos'=>$MinutosVendidos,
			'TotalVenta'=>$TotalVenta,
			'IdPlanMinutos'=>$IdPlanMinutos	
			]);

	}

	public function Modificar_Registro_Minutos(){
		$Minutos = Input::all();

		$Cantidad_Minutos_Restantes			=$Minutos['MinutosRestantes_MinutosIngresados'];
		$Cantidad_Minutos_Vendidos 			=$Minutos['MinutosVendidos_MinutosIngresados'];
		$cantidad_oculta 					=$Minutos['cantidad_oculta'];
		$Valor_Total_Minutos_Vendidosss		=$Minutos['Valor_Total_Minutos_Vendidosss'];
		$id_plan_minutos					=$Minutos['id_plan_minutos'];
		$id_detalle_plan_minutos			=$Minutos['id_detalle_plan_minutos'];

		$Total=$Cantidad_Minutos_Restantes+$cantidad_oculta-$Cantidad_Minutos_Vendidos;	
		

		$datos_registro = array(
			'cantidad_minutos_restantes' 			 		=> $Total
			);
		$datos_registro2 = array(			
			
			'cantidad_minutos_vendidos' 			 		=> $Cantidad_Minutos_Vendidos,
			'total_minutos_venta' 			 				=> $Valor_Total_Minutos_Vendidosss
			);
		$check = DB::table('minutos_planes')
		->where('id',$id_plan_minutos)
		->where('id_comercio',$Minutos['comercio_id_oculto'])
		->update($datos_registro);

		$check = DB::table('detalle_plan_minutos')
		->where('id_detalle_plan',$id_detalle_plan_minutos)
		->where('id_comercio',$Minutos['comercio_id_oculto'])
		->update($datos_registro2);

		if($check >0){
			return 0;
		}else{
			return 1;	
		}
	}

	public function Eliminar_Registro_Minutos(){

		$Minutos = Input::all();

		$Cantidad_Minutos_Restantes_Plan	=$Minutos['Cantidad_Minutos_Restantes_Plan'];
		$Cantidad_Minutos_Vendidos 			=$Minutos['Cantidad_Minutos_Vendidos'];

		$Total=$Cantidad_Minutos_Restantes_Plan+$Cantidad_Minutos_Vendidos;


		$datos_registro = array(
			'cantidad_minutos_restantes' 			 		=> $Total			
			);	

		$check = DB::table('minutos_planes')
		->where('id',$Minutos['id_plan_reingresoMinuto'])
		->where('id_comercio',$Minutos['comercio_id'])
		->update($datos_registro);

		$check = DB::table('detalle_plan_minutos')
		->where('id_detalle_plan',$Minutos['Id_Registro_Minuto'])
		->where('id_comercio',$Minutos['comercio_id'])
		->delete();

		if($check >0){
			return 0;
		}else{
			return 1;	
		}
	}

	public function Registrar_Nuevo_Plan(){
		
		$rules = array
		(
			'Nombre_Nuevo_Plan'						=> 'required|max:20',
			'Numero_Nuevo_Plan'						=> 'required|min:10',	
			'Cantidad_Minutos_Nuevo_Plan'			=> 'required|min:1|numeric',
			'Valor_Venta_Minutos_Nuevo_Plan'		=> 'required|min:1|numeric'					
			);

		$message = array
		(
			'Nombre_Nuevo_Plan.required' 					=> ' Se requiere un plan.',
			'Nombre_Nuevo_Plan.max' 						=> ' El nombre del plan no debe ser mayor a 20 caracteres.',
			'Numero_Nuevo_Plan.required' 					=> ' Se requiere un plan.',
			'Numero_Nuevo_Plan.min' 						=> ' El Numero del plan  debe ser igual a 10 caracteres.',
			'Cantidad_Minutos_Nuevo_Plan.required' 			=> ' Se requiere una cantidad de minutos.',
			'Cantidad_Minutos_Nuevo_Plan.min' 				=> ' La cantidad de numeros minimo son 1.',
			'Cantidad_Minutos_Nuevo_Plan.numeric' 			=> ' La cantidad debe ser numerica.',

			'Valor_Venta_Minutos_Nuevo_Plan.required' 		=> ' Se requiere el total de minutos.',
			'Valor_Venta_Minutos_Nuevo_Plan.min' 			=> ' Se requiere el total de minutos.',
			'Valor_Venta_Minutos_Nuevo_Plan.numeric' 		=> ' El valor total debe ser numerico.'				

			);
		
		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {

			return Response::json(['success' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{

			$Minutos = Input::all();
			$FechaActual=Carbon::today()->toDateString();
			$datos_registro = array(

				'nombre_plan_minutos' 			 	=> $Minutos['Nombre_Nuevo_Plan'],
				'NumeroPlan' 			 			=> $Minutos['Numero_Nuevo_Plan'],
				'cantidad_minutos' 	 				=> $Minutos['Cantidad_Minutos_Nuevo_Plan'],	
				'cantidad_minutos_restantes' 	 	=> $Minutos['Cantidad_Minutos_Nuevo_Plan'],
				'valor_venta_minutos' 	   		 	=> $Minutos['Valor_Venta_Minutos_Nuevo_Plan'],
				'fecha_registro' 					=> $FechaActual,
				'id_comercio' 	   		 			=> $Minutos['comercio_id'],	
				);			

			$check = DB::table('minutos_planes')->insert($datos_registro);


			if($check >0){
				return 0;
			}else{

				return 1;	
			}
		}
	}

}
