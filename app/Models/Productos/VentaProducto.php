<?php


namespace App\Models\Productos;


use Illuminate\Database\Eloquent\Model;
use App\Models\Usuarios\Usuario;

class VentaProducto extends Model{
	
	protected $table = 'venta_producto';

	public $timestamps = false;

	public function Producto()	{		
		return $this->belongsto(Producto::class,'producto_id');
	}

	public function NombreUsuario()	{		
		return $this->belongsto(Usuario::class,'id_usuario');
	}

}