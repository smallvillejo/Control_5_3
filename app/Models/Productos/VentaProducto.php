<?php


namespace App\Models\Productos;


use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model{
	
	protected $table = 'venta_producto';

	public $timestamps = false;

	public function Producto()	{		
		return $this->belongsto(Producto::class,'producto_id');
	}

}