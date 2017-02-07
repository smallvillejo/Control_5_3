<?php

namespace App\Http\Controllers\ControllerPlanesMinutos;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;
use App\Models\PlanesCelular\MinutosPlanes;
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
			$nombre_plan[$planes->id] = $planes->nombre_plan_minutos;
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

}
