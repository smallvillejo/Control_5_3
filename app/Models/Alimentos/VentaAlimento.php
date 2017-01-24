<?php


namespace App\Models\Alimentos;


use Illuminate\Database\Eloquent\Model;

class VentaAlimento extends Model{
	
	protected $table = 'venta_alimento';

	public $timestamps = false;

	public function Alimento()	{		
		return $this->belongsto(Alimento::class,'alimento_id');
	}

}