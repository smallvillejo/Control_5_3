<?php

namespace App\Http\Controllers\ControllerRecargas;

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


class AdministrarRecargasController extends Controller {

	public function AdministrarRecargas(){
		return view('AdministrarRecargas.Index_Recargas');
	}


}