 <html lang="en">
 <!--<![endif]-->
 <!-- BEGIN HEAD -->
 <link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
 <head>
 	<meta charset="utf-8"/>
 	<title>Verificando Cuenta | Merchandise Control</title>
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
 	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
 	<meta content="" name="description"/>
 	<meta content="" name="author"/>
 </head>
 <body onload="">
 	<link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 	<link href="global/master/css.css" rel="stylesheet" type="text/css">
 	<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">


 	<div style="text-align: center;">
 		<div style="width: 500px; margin: 150 auto; ">
 			<div class="panel panel-success">
 				<div class="panel-heading">Bienvenido a <b> Merchandise Control</b></div>
 				<div class="panel-body">
 					<b><strong> <font size ="2", color="#800000" face="Arial Black"><i class="fa fa-spinner fa-spin  fa-5x fa-fw"></i></font></strong></b> 				
 					<label><h3><?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></h3></label><br> 				
 					<label><h5><b><strong> <font size ="2", color="#800000" face="Arial Black"><?php echo e($nombre_perfil); ?></font></strong></b></h5></label>
 				</div>
 				En un momento serás re direccionado al Menú Principal.
 			</div>
 		</div>
 	</div>

 	<script type="text/javascript">
//  		function {
//  			window.location.hash="";
//   window.location.hash="" //chrome
//   window.onhashchange=function(){window.location.hash="";}

// }
Tiempo_Inactividad2=setTimeout('document.location.href = "<?php echo e(route('Index')); ?>"',5000);

</script>

</body>
</html>