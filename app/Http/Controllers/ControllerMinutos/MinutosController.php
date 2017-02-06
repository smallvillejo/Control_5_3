<?php

namespace App\Http\Controllers\ControllerMinutos;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MinutosController extends Controller{

	public function AdministrarPlanes(){
		return view('Minutos.Index_Minutos');
	}
  
}
