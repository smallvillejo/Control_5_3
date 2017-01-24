<?php


namespace App\Models\Usuarios;


use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	// use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'usuarios';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()	{
		return 'remember_token';
	}

	public $timestamps = true;
	

	public function RolUser()	{		
		return $this->belongsto(Perfil::class,'perfil_id');
	}

	public function Empresa()	{		
		return $this->belongsto(Emprea::class,'fk_usuario');
	}
}