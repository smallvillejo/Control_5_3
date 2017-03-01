<?php

namespace App\Http\Controllers\ControllerUsuarios;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuarios\Usuario;
use App\Models\Productos\Producto;
use App\Models\Alimentos\Alimento;
use App\Models\Perfiles\Perfil;
use Control_5_3\Models\Cargo\Cargo;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Support\Facades\Validator;
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserTrait;

use Redirect;

class UsuariosController extends Controller {


	public function __construct(){
		Carbon::setLocale('es');
		
	}

	public function verifity(){

		$perfil_logueado=Auth::user()->perfil_id;

		$nombre_perfil=Usuario::where('perfil_id',$perfil_logueado)->get();

		foreach ($nombre_perfil as $key => $value) {
			$nombre_perfil=$value->RolUser->nombre_perfil;
		}		

		return View('Index.LoadingLogin')->with('nombre_perfil',$nombre_perfil);
	}

	public function Salir()	{
		Auth::logout();
		return Redirect::to('/');

	}

	public function Cerrar_Sesion_X_Tiempo()	{
		$mensajee="Tu sesión ha expirado.";
		Auth::logout();
		return Redirect::to('/')->with('Session_Expired',$mensajee);

	}


	public function Login()	{	
		return View('Index.login');
	}

	public function Consultar_email_Usuario_Logueo(){
		$correo = Input::get('correo');
		$usuarios= Usuario::Where('correo',$correo)->get();
		
		$NombresUsuario="";
		$UrlFoto="";
		foreach ($usuarios as $key => $value) {

			$NombresUsuario=$value->nombre.' '.$value->apellido;
			$CorreoUsuario=$value->correo;
			$UrlFoto=$value->photo_perfil;
		}
		

		if($NombresUsuario!==""){	

			if($UrlFoto==""){
				$UrlFoto="global/login/login/photo.jpg";	
			}

			$PrimeraMayuscula = $NombresUsuario;
			$PrimeraMayuscula = ucwords($PrimeraMayuscula); 

			return Response::json(['Resultado' =>'oK',
				'NombreUsuario'=>$PrimeraMayuscula,
				'CorreoUsuario'=>$CorreoUsuario,
				'FotoUsuario'=>$UrlFoto]); 
		}else{
			return Response::json(['Resultado' =>"Error",
				'ErrorEnEmail'=>"Merchandise no reconoce la dirección de correo electrónico."]); 
		}		
		
	}

	public function Logueo(){

		$usuario = Input::all();


		$rules = array
		(
			"correo" => "required|email|exists:usuarios",
			'password' => 'required',  
		// 'g-recaptcha-response' => 'required'          
			);

		$messages = array
		(
			'correo.required' => 'Ingrese el Email.',
			'correo.exists' => 'El email Ingresado No Se Encuentra Registrado',
			'correo.email' => 'El Formato Email Esta Incorrecto.',
			'password.required' => 'Ingrese el password.',
			'password.exists' => 'El email o password estan incorrectos.',
		// 'g-recaptcha-response.required'=>'El campo Captcha es requerido.',

			);

		$validator = Validator::make(Input::All(), $rules, $messages);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{			

			// $Pass_Encriptado = Hash::make(Input::get('password'));

			$user = array(
				'correo' => Input::get('correo'),
				'password' => Input::get('password'), 
				'estado' => 'Activo' 				              
				);

			// dd($user);
			
			if (Auth::guard()->attempt($user)==true){ 				
				return 'ok';   

			}else{
				$message = '<center>La contraseña es incorrecta. Inténtalo de nuevo.</center>';			

				return Response::json(['ErrorEnPass' =>false,
					'errors'=>$message]); 
			}

		}
	}

	public function Cargar_Perfil_Usuario(){		
		return View('Usuarios.Perfil_Usuario');
	}

	public function account(){
		return View('Usuarios.Account');
	}

	public function ConfiguracionCuentaComercio(){
		$rules = array
		(
			'NombreEmpresa'   	 => 'required|min:6',
			'DireccionEmpresa'   => 'required|min:6',
			'TelefonoEmpresa'    => 'required|min:6',
			'EmailEmpresa' 		 => 'required|email',
			'ImagenLogoEmpresa'  => 'max:2000|mimes:jpg,jpeg,png'	  
			);

		$message = array
		(
			'NombreEmpresa.required'  => 'Porfavor Ingrese el nombre de la empresa.',
			'NombreEmpresa.min' => ' Minimo son 6 caracteres para el nombre de la empresa',
			'DireccionEmpresa.required'  => 'Porfavor Ingrese la drección de la empresa.',
			'DireccionEmpresa.min' => 'Minimo son 6 caracteres para dirección de la empresa',
			'TelefonoEmpresa.required'  => 'Porfavor Ingrese la drección de la empresa.',
			'TelefonoEmpresa.min'		 => 'Minimo son 6 caracteres para el nombre de la empresa',
			'EmailEmpresa.required'  	=> 'Porfavor Ingrese la drección de la empresa.',
			'EmailEmpresa.email' 		=> 'El correo ingresado no esta correcto',
			'ImagenLogoEmpresa.max'     => 'El tamaño maximo debe la imagen es de 1 MB.',
			'ImagenLogoEmpresa.mimes'   => 'El archivo que pretendes subir, no es una imagen.',
			);


		$validator = Validator::make(Input::All(), $rules, $message);
		if ($validator->fails()) {

			return Response::json(['error' =>false,
				'errors'=>$validator->errors()->toArray()]);
		}else{

			$id_comercio=Auth::user()->id_comercio;  
			$src = $_FILES['ImagenLogoEmpresa'];
			$producto=Input::all();

			if ($src["size"] > 0){				     

				$ruta_imagen = 'global/directorio/Comercio_'.$id_comercio.'/images/Productos/';
				File::makeDirectory($ruta_imagen, $mode = 0777, true, true);

				$imagen=rand(1000,999)."-".$src["name"];

				$Productos=Producto::Where('ruta_imagen_producto',$ruta_imagen.$imagen)
				->where('id_comercio',$id_comercio)->get();
				$DireccionURLFoto_Consultada="";
				foreach ($Productos as $key => $value) {
					$DireccionURLFoto_Consultada=$value->ruta_imagen_producto;       
				}

				if($DireccionURLFoto!==$ruta_imagen.$imagen){
					if (File::exists($DireccionURLFoto_Consultada)) {
						return 2;
					}
				}

				if (File::exists($DireccionURLFoto)) {
					File::delete($DireccionURLFoto);
				}


				move_uploaded_file($src["tmp_name"], $ruta_imagen.$imagen);


				$productos = array(
					'id_comercio'               => $id_comercio,
					'nombre_producto'           => $producto['nombre_producto_editar'],
					'cantidad_producto'         => $producto['cantidad_producto_editar'],
					'valor_venta_producto'      => $producto['valor_venta_producto_editar'],
					'valor_inversion_producto'  => $producto['valor_inversion_producto_editar'],
					'valor_total_inversion'     => $producto['valor_total_inversion_editar'],
					'ruta_imagen_producto'      => $ruta_imagen.$imagen     
					);

				$check = DB::table('producto_producto')
				->where('id',$producto['id_producto_editarr'])
				->where('id_comercio',$id_comercio)
				->update($productos);

				if($check >0){
					return 0;
				}

			}
























			public function IndexUsuarios() { 

				$Rol_Usuario_Logueado=Auth::user()->get()->perfil_id;

				$correo = htmlspecialchars(Input::get("buscar"));

				if($Rol_Usuario_Logueado==1){				

					if (isset($_GET["buscar"]))		{
						$buscar = htmlspecialchars(Input::get("buscar"));
						$paginacion =User::where('correo', 'LIKE', '%'.$correo.'%')
						->where("perfil_id", 2)		
						->orderby("id", "asc")
						->paginate(10);
					}
					else
					{
						$paginacion =User::where('correo', 'LIKE', '%'.$correo.'%')	
						->where("perfil_id", 2)		
						->orderby("id", "asc")
						->paginate(10);
					}

					return View::make('HomeController.Usuarios')
					->with('paginacion',$paginacion);
				}else{

					if (isset($_GET["buscar"]))		{
						$buscar = htmlspecialchars(Input::get("buscar"));
						$paginacion =User::where('correo', 'LIKE', '%'.$correo.'%')
						->where("perfil_id", 3)		
						->orderby("id", "asc")
						->paginate(10);
					}
					else
					{
						$paginacion =User::where('correo', 'LIKE', '%'.$correo.'%')	
						->where("perfil_id", 3)		
						->orderby("id", "asc")
						->paginate(10);
					}
					return View::make('HomeController.Empleados')
					->with('paginacion',$paginacion);
				}


			}


			function Cargar_Rangos_Usuarios(){

		// $id_comercio=Auth::user()->get()->id_comercio;

				$Periles = Perfil::all();


				$Nombre_Perfil=[];
				$Nombre_Perfil[0] = "";

				foreach ($Periles as $perfil) {
					$Nombre_Perfil[$perfil->id] = $perfil->nombre_perfil;
				}

				return Response::json(['success' =>true,			
					'Nombre_Perfil'=>$Nombre_Perfil			
					]);
			}

			function Cargar_Ultimo_Registro_Comercio_ID(){

		// $id_comercio=Auth::user()->get()->id_comercio;

		// $Usuarios = User::orderBy('created_at', 'desc')->first();
		// $Usuarios = User::all()->last()->pluck('id_comercio');
				$Usuarios = User::all()->last()->get();


				foreach ($Usuarios as $value) {

					$id_comercio=$value->id_comercio;

				}		
				return Response::json(['success' =>true,			
					'id_comercio'=>$id_comercio			
					]);
			}

			function consultar_email_usuario(){

				$usuario = Input::all();
				$correo="Disponible";

				$Usuarios = User::where('correo',$usuario['email'])->get();

				foreach ($Usuarios as $value) {
					$correo=$value->correo;
				}			
				return Response::json(['success' =>true,			
					'correo'=>$correo			
					]);
			}


			function contar_clientes(){
				$Periles = Perfil::all();

				$Usuarios =User::where('perfil_id',2)				
				->count('perfil_id');

				return Response::json(['success' =>true,			
					'Usuarios'=>$Usuarios			
					]);
			}


			function cargar_tabla_usuarios(){

			}



			function Registrar_Nuevo_Usuario(){

				$usuario = Input::all();

				$rules = array
				(
					'email'					=> 'required',
					'rol_usuario'			=> 'required|numeric'
					);

				$message = array
				(
					'email.required' 		=> ' Se requiere un email',			
					'rol_usuario.required' 	=> ' Seleccione un rol de Usuario.',					
					'rol_usuario.numeric' 	=> ' Seleccione un rol de Usuario.'
					);

				$validator = Validator::make(Input::All(), $rules, $message);
				if ($validator->fails()) {

					return Response::json(['success' =>false,
						'errors'=>$validator->errors()->toArray()]);
				}else{

					$Usuario = Input::all();
					$Nombre="";	
					$Apellido="";	
					$Telefono="";
					$Estado="Inactivo";	
					$Token="aabbcc";
					$email=$Usuario['email'];

					$password =$Usuario['password'];


					$confirmation_code = str_random(30);			

					Cookie::queue('email', $email, 60*24);

        // Crear la url de confirmación para el mensaje del email
					$msg = "<a href='".URL::to("/confirmregister/$email/$confirmation_code")."'>Confirmar Registro</a>";			

        //Enviar email para confirmar el registro
					$data = array(
						'user' 		=> $email,
						'msg' 		=> $msg,
						'password'  => $password,
						);

					$fromEmail = 'InfoMerchandiseControl@gmail.com';
					$fromName = 'Confirmar Registro en Merchandise Control.';

					Mail::send('emails.register', $data, function($message) use ($fromName, $fromEmail, $email)
					{
						$message->to($email, $email);
						$message->from($fromEmail, $fromName);
						$message->subject('Confirmar registro en Merchandise Control');
					});

					$password = Hash::make($Usuario['password']);

					$hora_registro= Carbon::today()->now();


					$Datos = array(

						'correo' 	 		 	=> $Usuario['email'],
						'password' 	 		 	=> $password,	
						'nombre' 	 		 	=> $Nombre,
						'apellido' 	   		 	=> $Apellido,
						'telefono' 	   		 	=> $Telefono,
						'estado' 	   		 	=> $Estado,			
						'remember_token' 	 	=> $Token,
						'created_at' 		 	=> $hora_registro,
						'updated_at' 	 	 	=> $hora_registro,				
						'id_comercio' 	     	=> $Usuario['comercio_id'],
						'perfil_id' 	   	 	=> $Usuario['rol_usuario'],
						'confirmation_code'  	=> $confirmation_code,
						'Actualizacion_Datos'   => 'Si'

						);			

					$check = DB::table('usuarios')->insert($Datos);	

					if($check >0){
						return 0;
					}else{

						return 1;	
					}

					return Response::json(['success' =>true]);
				}


			}

			function Confirmar_Email($email, $confirmation_code){
		// if (urldecode($email) == Cookie::get("email") && urldecode($key) == Cookie::get("key"))		{
			// $conn = DB::connection("mysql");
			// $sql = "UPDATE users SET active=1 WHERE email=?";
			// $conn->update($sql, array($email));

				$Usuarios =User::where('correo',$email)->get();
				$Estado="Activo";	

				foreach ($Usuarios as $value) {

					$codigo_confirmacion=$value->confirmation_code;

				}	
				if($confirmation_code==$codigo_confirmacion){

					$confirmation_code = str_random(30);	

					$Datos = array(

						'confirmation_code' 	=> $confirmation_code,
						'estado' 				=> $Estado
						);	


					$check = DB::table('usuarios')
					->where('correo',$email)			
					->update($Datos);

					$mensaje = 'La cuenta fue verificada con éxito. Inicia sesión y disfruta de nuestros servicios.';

					return Redirect::to('/')->with("mensaje", $mensaje);


				}else{
					$mensaje2 = 'Esta cuenta ya fue verificada anteriormente, Inicia sesión y disfruta de nuestros servicios.';

					return Redirect::to('/')->with("mensaje2", $mensaje2);
				}

			}

			function Recuperar_Password_Email(){
				$Usuario= Input::all();

				$email=$Usuario['email'];
				$password =$Usuario['password'];
				$confirmation_code = str_random(30);

				$rules = array
				(
					'email'					=> 'required'			
					);

				$message = array
				(
					'email.required' 		=> ' Se requiere un email'		
					);

				$validator = Validator::make(Input::All(), $rules, $message);
				if ($validator->fails()) {

					return Response::json(['success' =>false,
						'errors'=>$validator->errors()->toArray()]);
				}else{

					$msg = "<a href='".URL::to("/recoverpassword/$email/$confirmation_code")."'>Recuperar Password</a>";			


        //Enviar email para confirmar el registro
					$data = array(
						'user' 		=> $email,
						'msg' 		=> $msg,
						'password'  => $password,
						);

					$fromEmail = 'InfoMerchandiseControl@gmail.com';
					$fromName = 'Recuperar Contraseña en Merchandise Control.';

					Mail::send('emails.recover_password', $data, function($message) use ($fromName, $fromEmail, $email)
					{
						$message->to($email, $email);
						$message->from($fromEmail, $fromName);
						$message->subject('Recuperar Contraseña Merchandise Control');
					});



					$password = Hash::make($Usuario['password']);		



					$Datos = array(				
						'password' 	 		 => $password,				
						'confirmation_code'  => $confirmation_code
						);


        //Enviar email para confirmar el registro
					$data = array(
						'user' 		=> $email,
						'msg' 		=> $msg,
						'password'  => $password,
						);

					$fromEmail = 'InfoMerchandiseControl@gmail.com';
					$fromName = 'Recuperar Contraseña en Merchandise Control.';

					Mail::send('emails.recover_password', $data, function($message) use ($fromName, $fromEmail, $email)
					{
						$message->to($email, $email);
						$message->from($fromEmail, $fromName);
						$message->subject('Recuperar Contraseña Merchandise Control');
					});



					$password = Hash::make($Usuario['password']);		



					$Datos = array(				
						'password' 	 		 => $password,				
						'confirmation_code'  => $confirmation_code
						);


					$check = DB::table('usuarios')
					->where('correo',$email)			
					->update($Datos);


					if($check >0){
						return 0;
					}else{

						return 1;	
					}


					return Response::json(['success' =>true]);

				}	


			}

			function Confirmar_Password($email, $confirmation_code){		

				$Usuarios =User::where('correo',$email)->get();

				foreach ($Usuarios as $value) {

					$codigo_confirmacion=$value->confirmation_code;

				}	
				if($confirmation_code==$codigo_confirmacion){

					$confirmation_code = str_random(30);	

					$Datos = array(
						'confirmation_code' 	=> $confirmation_code				
						);	
					$check = DB::table('usuarios')
					->where('correo',$email)			
					->update($Datos);

					$mensaje = 'Enhorabuenaue, Tu Contraseña ha sido cambiada, ya puedes Iniciar Sesión y disfruta de nuestros servicios.';

					return Redirect::to('/')->with("mensaje", $mensaje);


				}else{

					$mensaje2 = 'El enlace de recuperar ya fue verificado, Inicia sesión y disfruta de nuestros servicios.';

					return Redirect::to('/')->with("mensaje2", $mensaje2);
				}

			}


	// public function EditarPerfil(){

	// 	$perfil = Input::all();

	// 	$correo_escrito=$perfil['correo'];

	// 	$correo_logueado=Auth::user()->get()->correo;
	// 	$hora_actualizacion= Carbon::today()->now();


	// 	if($correo_escrito!==$correo_logueado){

	// 		$rules = array
	// 		(
	// 			'nombre_user'			=> 'required|min:3',
	// 			'apellido_user'			=> 'required|min:3',
	// 			'telefono_user' 		=> 'required|numeric',
	// 			'correo' 				=> 'required|email|unique:usuarios|between:3,80',
	// 			'password' 				=> 'required|regex:/^[a-z0-9]+$/i|min:7|max:16',
	// 			'confipassword' 		=> 'required|same:password',
	// 			'terminos' 				=> 'required|numeric'
	// 			);

	// 		$message = array
	// 		(
	// 			'nombre_user.required' 		=> ' Porfavor Ingrese un nombre.',
	// 			'nombre_user.min' 			=> ' El campo Nombre es de minimo 3 caracteres.',
	// 			'apellido_user.required' 	=> ' Porfavor Ingrese un apellido.',
	// 			'apellido_user.min' 		=> ' El campo apellido es de minimo 3 caracteres.',
	// 			'telefono_user.numeric' 	=> ' Ingresa un numer de telefono.',
	// 			'telefono_user.required' 	=> ' Ingresa un numer de telefono.',
	// 			'email.required' 			=> ' Porfavor Ingrese un email.',
	// 			'correo.email' 		    	=> ' El formato Email esta incorrecto.',
	// 			'correo.unique' 			=> ' El email ingresado ya se encuentra registrado.',
	// 			'correo.between' 			=> ' El email debe contener entre 3 y 80 caracteres.',
	// 			'password.required' 		=> ' El campo password es requerido.',
	// 			'password.regex' 			=> ' El campo password sólo acepta letras y números.',
	// 			'password.min' 				=> ' El campo password es de mínimo 7 caracteres.',
	// 			'password.max' 				=> ' El campo password es de maximo 16 caracteres.',
	// 			'confipassword.required' 	=> ' Confirme el password.',
	// 			'confipassword.same'		=> ' Los passwords no coinciden.',
	// 			'terminos.numeric' 			=> ' Tienes que aceptar los términos.',
	// 			'terminos.required' 		=> ' Tienes que aceptar los términos.'
	// 			);
	// 		$validator = Validator::make(Input::All(), $rules, $message);
	// 		if ($validator->fails()) {

	// 			return Response::json(['success' =>false,
	// 				'errors'=>$validator->errors()->toArray()]);
	// 		}else{


	// 			$password = Hash::make(input::get('password'));


	// 			$perfil_user = array(
	// 				'nombre' 					=> $perfil['nombre_user'],
	// 				'apellido'					=> $perfil['apellido_user'],
	// 				'telefono' 	    			=> $perfil['telefono_user'],
	// 				'correo' 	    			=> $perfil['correo'],
	// 				'Actualizacion_Datos' 	    => 'No',
	// 				'password' 					=> $password,
	// 				'updated_at'				=> $hora_actualizacion
	// 				);
	// 			$check = DB::table('usuarios')->where('id',$perfil['id_usuario'])->update($perfil_user);
	// 			if($check >0){
	// 				return 0;
	// 			}else{

	// 				return 1;	
	// 			}

	// 			return Response::json(['success' =>true]);
	// 		}
	// 	}else{
	// 		$rules = array
	// 		(
	// 			'nombre_user'			=> 'required|min:3',
	// 			'apellido_user'			=> 'required|min:3',
	// 			'correo' 				=> 'required|email|between:3,80',
	// 			'telefono_user' 		=> 'required|numeric',
	// 			'password' 				=> 'required|regex:/^[a-z0-9]+$/i|min:7|max:16',
	// 			'confipassword' 		=> 'required|same:password',
	// 			'terminos' 				=> 'required|numeric'
	// 			);

	// 		$message = array
	// 		(
	// 			'nombre_user.required' 		=> ' Porfavor Ingrese un nombre.',
	// 			'nombre_user.min' 			=> ' El campo Nombre es de minimo 3 caracteres.',
	// 			'apellido_user.required' 	=> ' Porfavor Ingrese un apellido.',
	// 			'apellido_user.min' 		=> ' El campo apellido es de minimo 3 caracteres.',
	// 			'telefono_user.numeric' 	=> ' Ingresa un numer de telefono.',
	// 			'telefono_user.required' 	=> ' Ingresa un numer de telefono.',
	// 			'correo.required' 			=> ' Porfavor Ingrese un email.',
	// 			'correo.email' 		    	=> ' El formato Email esta incorrecto.',				
	// 			'correo.between' 			=> ' El email debe contener entre 3 y 80 caracteres.',
	// 			'password.required' 		=> ' El campo password es requerido.',
	// 			'password.regex' 			=> ' El campo password sólo acepta letras y números.',
	// 			'password.min' 				=> ' El campo password es de mínimo 7 caracteres.',
	// 			'password.max' 				=> ' El campo password es de maximo 16 caracteres.',
	// 			'confipassword.required' 	=> ' Confirme el password.',
	// 			'confipassword.same'		=> ' Los passwords no coinciden.',
	// 			'terminos.numeric' 			=> ' Tienes que aceptar los términos.',
	// 			'terminos.required' 		=> ' Tienes que aceptar los términos.'
	// 			);
	// 		$validator = Validator::make(Input::All(), $rules, $message);
	// 		if ($validator->fails()) {

	// 			return Response::json(['success' =>false,
	// 				'errors'=>$validator->errors()->toArray()]);
	// 		}else{				

	// 			$password = Hash::make(input::get('password'));

	// 			$perfil_user = array(
	// 				'nombre' 	    			=> $perfil['nombre_user'],
	// 				'apellido'      			=> $perfil['apellido_user'],
	// 				'telefono' 	    			=> $perfil['telefono_user'],
	// 				'correo' 					=> $perfil['correo'],
	// 				'Actualizacion_Datos' 	    => 'No',
	// 				'password' 					=> $password,
	// 				'updated_at'				=>$hora_actualizacion
	// 				);
	// 			$check = DB::table('usuarios')->where('id',$perfil['id_usuario'])->update($perfil_user);
	// 			if($check >0){
	// 				return 0;
	// 			}else{

	// 				return 1;	
	// 			}

	// 			return Response::json(['success' =>true]);
	// 		}

	// 	}


	// 	$mensaje2 = 'El enlace de recuperar ya fue verificado anteriormente, Inicia sesión y disfruta de nuestros servicios.';

	// 	return Redirect::to('/')->with("mensaje2", $mensaje2);
	// }




			function Modificar_Usuario(){
				$Usuarios = Input::all();

				$passwordUsuario=$Usuarios['checkbox_password'];
				$correoEditar=$Usuarios['Correo_Editar'];
				$correo_oculto=$Usuarios['correo_oculto'];	
				$checkbox_cuenta=$Usuarios['checkbox_cuenta'];	


				$password=$Usuarios['password_modificar'];


				$confirmation_code = str_random(30);	

				$Nueva_Contraseña = Hash::make($password);


				if($passwordUsuario=='Si'){			

					$msg = "<a href='".URL::to("/recoverpassword/$correoEditar/$confirmation_code")."'>Confirmar Cambio de Contraseña.</a>";			

        //Enviar email para cambiar password
					$data = array(
						'user' 		=> $correoEditar,
						'msg' 		=> $msg,
						'password'  => $password,
						);

					$fromEmail = 'InfoMerchandiseControl@gmail.com';
					$fromName = 'Nueva Contraseña en Merchandise Control.';

					Mail::send('emails.reset_password', $data, function($message) use ($fromName, $fromEmail, $correoEditar)
					{
						$message->to($correoEditar, $correoEditar);
						$message->from($fromEmail, $fromName);
						$message->subject('El Administrador ha generado una nueva Contraseña en Merchandise Control.');
					});


					$Datos = array(				
						'password' 	 		 =>$Nueva_Contraseña,				
						'confirmation_code'  => $confirmation_code								
						);

					$check = DB::table('usuarios')->where('id',$Usuarios['usuario_id'])->update($Datos);

					if($check >0){
						return 0;
					}else{

						return 1;	
					}
					return Response::json(['success' =>true]);	


				}else{
					if($correoEditar!==$correo_oculto){

						$Datos = array(
							'correo' 					=> $Usuarios['Correo_Editar']					
							);
						$check = DB::table('usuarios')->where('id',$Usuarios['usuario_id'])->update($Datos);

					}
				}

			}
			public function EditarPerfil(){

				$perfil = Input::all();

				$correo_escrito=$perfil['correo'];

				$correo_logueado=Auth::user()->get()->correo;
				$hora_actualizacion= Carbon::today()->now();


				if($correo_escrito!==$correo_logueado){

					$rules = array
					(
						'nombre_user'			=> 'required|min:3',
						'apellido_user'			=> 'required|min:3',
						'telefono_user' 		=> 'required|numeric',
						'correo' 				=> 'required|email|unique:usuarios|between:3,80',
						'password' 				=> 'required|regex:/^[a-z0-9]+$/i|min:7|max:16',
						'confipassword' 		=> 'required|same:password',
						'terminos' 				=> 'required|numeric'
						);

					$message = array
					(
						'nombre_user.required' 		=> ' Porfavor Ingrese un nombre.',
						'nombre_user.min' 			=> ' El campo Nombre es de minimo 3 caracteres.',
						'apellido_user.required' 	=> ' Porfavor Ingrese un apellido.',
						'apellido_user.min' 		=> ' El campo apellido es de minimo 3 caracteres.',
						'telefono_user.numeric' 	=> ' Ingresa un numer de telefono.',
						'telefono_user.required' 	=> ' Ingresa un numer de telefono.',
						'email.required' 			=> ' Porfavor Ingrese un email.',
						'correo.email' 		    	=> ' El formato Email esta incorrecto.',
						'correo.unique' 			=> ' El email ingresado ya se encuentra registrado.',
						'correo.between' 			=> ' El email debe contener entre 3 y 80 caracteres.',
						'password.required' 		=> ' El campo password es requerido.',
						'password.regex' 			=> ' El campo password sólo acepta letras y números.',
						'password.min' 				=> ' El campo password es de mínimo 7 caracteres.',
						'password.max' 				=> ' El campo password es de maximo 16 caracteres.',
						'confipassword.required' 	=> ' Confirme el password.',
						'confipassword.same'		=> ' Los passwords no coinciden.',
						'terminos.numeric' 			=> ' Tienes que aceptar los términos.',
						'terminos.required' 		=> ' Tienes que aceptar los términos.'
						);
					$validator = Validator::make(Input::All(), $rules, $message);
					if ($validator->fails()) {

						return Response::json(['success' =>false,
							'errors'=>$validator->errors()->toArray()]);
					}else{


						$password = Hash::make(input::get('password'));


						$perfil_user = array(
							'nombre' 					=> $perfil['nombre_user'],
							'apellido'					=> $perfil['apellido_user'],
							'telefono' 	    			=> $perfil['telefono_user'],
							'correo' 	    			=> $perfil['correo'],
							'Actualizacion_Datos' 	    => 'No',
							'password' 					=> $password,
							'updated_at'				=> $hora_actualizacion
							);
						$check = DB::table('usuarios')->where('id',$perfil['id_usuario'])->update($perfil_user);

						if($check >0){
							return 0;
						}else{

							return 1;	
						}

						return Response::json(['success' =>true]);	

					}
				}

				if($checkbox_cuenta=='Si'){

					$Datos = array(			

						'estado'  			 => 'Activo'				
						);

					$check = DB::table('usuarios')->where('id',$Usuarios['usuario_id'])->update($Datos);

					if($check >0){
						return 0;
					}else{

						return 1;	
					}
					return Response::json(['success' =>true]);

				}else{
					$Datos = array(			

						'estado'  			 => 'Inactivo'				
						);

					$check = DB::table('usuarios')->where('id',$Usuarios['usuario_id'])->update($Datos);

					if($check >0){
						return 0;
					}else{

						return 1;	
					}
					return Response::json(['success' =>true]);
				}


			}


			function PerfilUser(){
				return View::make('HomeController.Perfil');

			}

		}
