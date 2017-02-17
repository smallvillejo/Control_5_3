<?php

namespace App\Models\Recargas;

use Illuminate\Database\Eloquent\Model;
use App\Models\Recargas\CategoriaRecarga;

class VentaRecarga extends Model{
	
	protected $table = 'venta_recarga';

	public $timestamps = false;	


	public function Recarga()	{		
		return $this->belongsto(CategoriaRecarga::class,'fk_categoria_recarga');
	}

}