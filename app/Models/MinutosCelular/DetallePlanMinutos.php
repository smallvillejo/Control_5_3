<?php


namespace App\Models\MinutosCelular;
use App\Models\MinutosPlanes;


use Illuminate\Database\Eloquent\Model;

class DetallePlanMinutos extends Model{
	
	protected $table = 'detalle_plan_minutos';

	public $timestamps = false;

	public function PlanMinutos()	{		
		return $this->belongsto(MinutosPlanes::class,'id_minutos_planes');
	}
	

}

