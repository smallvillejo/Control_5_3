<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.2
Version: 3.7.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title>Bienvenido a Merchandise Control</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="global/master/css.css" rel="stylesheet" type="text/css">

  <link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
  <link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
  <link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME STYLES -->
  <link href="global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
  <link id="style_color" href="global/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<script type="text/javascript">
  function deshabilitaRetroceso(){
    window.location.hash=" ";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash=" ";}
  }
</script>


<body class="page-md login" onload="ini();deshabilitaRetroceso();">
  <input type="hidden" name="_token_logueo" id="_token_logueo">
  <!-- BEGIN LOGO -->
  <div class="logo">
    <a href="#">
      <img src="global/images/LogoLogin.png" alt=""/>
    </a>
  </div>
  <!-- END LOGO -->
  <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
  <div class="menu-toggler sidebar-toggler">
  </div>
  <!-- END SIDEBAR TOGGLER BUTTON -->
  <!-- BEGIN LOGIN -->
  <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="Login" method="post">
      <h3 class="form-title">Inicia Sesión</h3>

      
      
      @if(session()->has("messagee") or (session()->has("message")))
      <div class="alert alert-danger info2" id="success-alert2"> 
        <strong>
          <ul2>{{Session::get("messagee")}}{{Session::get("message")}}</ul2>
        </strong>
      </div>
      @endif
      @if(session()->has("Session_Expired"))
      <div class="alert alert-danger info2" id="success-alert2"> 
        <strong>
          <ul2>{{Session::get("Session_Expired")}}</ul2><i class="fa fa-clock-o fa-2x" aria-hidden="true" style="margin-left: 80px;"></i>
        </strong>
      </div>
      @endif

      <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span>
          Ingresa tu Email y Password. </span>
        </div>
        <div class="form-group">
          <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
          <label class="control-label visible-ie8 visible-ie9">Email</label>
          <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="correo" id="correo" />
          </div>
        </div>
        <div class="form-group">
          <label class="control-label visible-ie8 visible-ie9">Password</label>
          <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password" />
          </div>
        </div>
        <div class="form-actions">          
      <!-- <label class="checkbox">
      <input type="checkbox" name="remember" value="1"/> Remember me </label> -->
      {{Form::input("hidden", "_token", csrf_token())}}
      <button type="submit" class="btn blue pull-right" onclick="RenovarToken()">
        Login <i class="m-icon-swapright m-icon-white"></i>
      </button>
    </div>
    <!-- <div class="login-options">
      <h4>Or login with</h4>
      <ul class="social-icons">
        <li>
          <a class="facebook" data-original-title="facebook" href="javascript:;">
          </a>
        </li>
        <li>
          <a class="twitter" data-original-title="Twitter" href="javascript:;">
          </a>
        </li>
        <li>
          <a class="googleplus" data-original-title="Goole Plus" href="javascript:;">
          </a>
        </li>
        <li>
          <a class="linkedin" data-original-title="Linkedin" href="javascript:;">
          </a>
        </li>
      </ul>
    </div> -->
    <div class="forget-password">
      <h4>¿ Olvidaste tu Contraseña ?</h4>
      <p>
       No te preocupes, presiona click <a href="javascript:;" id="forget-password">
       aqui </a>
       para restablecer su contraseña.
     </p>
   </div>

   <!--  <div class="create-account">
      <p>
         Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
        Create an account </a>
      </p>
    </div> -->
  </form>
  <!-- END LOGIN FORM -->
  <!-- BEGIN FORGOT PASSWORD FORM -->
  <form class="forget-form" action="index.html" method="post">
    <h3>¿ Olvidaste tu Contraseña ?</h3>
    <p>
     Ingresa tu Email para restablecer tu Contraseña.
   </p>
   <div class="form-group">
    <div class="input-icon">
      <i class="fa fa-envelope"></i>
      <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" id="email" />
    </div>
  </div>
  <div class="form-actions">
    <button type="button" id="back-btn" class="btn">
      <i class="m-icon-swapleft"></i> Back </button>
      <button type="button" class="btn blue pull-right Recuperar_Email"  id="Recuperaremail" disabled="">
        Recuperar <i class="m-icon-swapright m-icon-white"></i>
      </button>
    </div>
  </form>
  <!-- END FORGOT PASSWORD FORM -->
  <!-- BEGIN REGISTRATION FORM -->
</div>  
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
  2016 Merchandise Control By Jorge Muñoz.
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="global/plugins/respond.min.js"></script>
<script src="global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="global/scripts/metronic.js" type="text/javascript"></script>
<script src="global/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="global/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="global/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
  jQuery(document).ready(function() {     
  Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Login.init();
Demo.init();
       // init background slide images
       $.backstretch([
        "global/admin/pages/media/bg/1.jpg",
        "global/admin/pages/media/bg/2.jpg",
        "global/admin/pages/media/bg/3.jpg",
        "global/admin/pages/media/bg/4.jpg"
        ], {
          fade: 1000,
          duration: 8000
        }
        );
     });
   </script>
   <script type="text/javascript">

     @if (Session::has('mensaje'))
     Mostrar_Mensaje_Verificacion_Email();
     @endif

     @if (Session::has('mensaje2'))
     Mostrar_Mensaje_Verificacion_Email2();
     @endif


     @if (Session::has('mensaje_inactivo'))
     Mostrar_Mensaje_Cuenta_Inactiva();
     @endif

     function Mostrar_Mensaje_Verificacion_Email(){
      $('#ModalConfirmacion').modal('show');
      $('#TitleModal').html('<p>Cuenta Verificada.</p>');
      $('#CuerpoMensaje').html('<p>{{Session::get('mensaje')}}</p>');   

    }

    function Mostrar_Mensaje_Verificacion_Email2(){

      $('#ModalConfirmacion').modal('show');
      $('#TitleModal').html('<p>Error al verificar la cuenta.</p>');
      $('#CuerpoMensaje').html('<p>{{Session::get('mensaje2')}}</p>');   

    }


    function Mostrar_Mensaje_Cuenta_Inactiva(){

      $('#ModalConfirmacion').modal('show');
      $('#TitleModal').html('<p>Cuenta Inactiva.</p>');
      $('#CuerpoMensaje').html('<p>{{Session::get('mensaje_inactivo')}}</p>');   

    }

    function Mostrar_Mensaje_Verificacion_Email2(){

      $('#ModalConfirmacion').modal('show');
      $('#TitleModal').html('<p>Error al verificar la cuenta.</p>');
      $('#CuerpoMensaje').html('<p>{{Session::get('mensaje2')}}</p>');  


    }

  </script>

  <script type="text/javascript">

    function Validar_Email_Existente(){


      var email       = $('#email').val();  


      if(email==""){
        document.getElementById("Recuperaremail").disabled=true;
      }else{
        document.getElementById("Recuperaremail").disabled=false;    
      }
    }


    function validarEmail(){
      var email = $('#email').val();    
      emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;   
      var str =  email;
      var resultado = str.toLowerCase();

      if(email==''){
        $('#id_estilo').hide();
        $('#id_estilo2').hide();
        document.getElementById("mensaje_valida").innerText = ""; 
        document.getElementById("Recuperaremail").disabled=true;   
      }else{    
        if (emailRegex.test(resultado)) {
          $('#id_estilo').hide();
          $('#id_estilo2').hide();
          document.getElementById("mensaje_valida").innerText = ""; 
          verificar_email_existe(resultado);
          document.getElementById("Recuperaremail").disabled=false;   
        } else {
          $('#id_estilo').show();
          $('#id_estilo2').hide();
          document.getElementById("mensaje_valida").innerText = "Error: La dirección de correo es incorrecta.";   
          document.getElementById("mensaje_valida").style.display = "block";
          document.getElementById("Recuperaremail").disabled=true;
        }
      }
    }

    function verificar_email_existe(email){

     $.ajax({
      url   : "<?= URL::to('consultar_email_usuario') ?>",
      type  : "POST",
      async : false,
      data  :{ 
        'email'  : email                       

      },  
      success:function(re){  

        if(re.correo=="Disponible"){         
          $('#id_estilo2').hide(); 
          $('#id_estilo').show(); 
          document.getElementById("mensaje_valida").innerText = "El correo no se encuentra registrado en nuestro sistema."; 
          document.getElementById("mensaje_valida").style.display = "block";
          document.getElementById("Recuperaremail").disabled=true;  


        }else{  
         $('#id_estilo').hide();      

         document.getElementById("mensaje_valida").innerText = "";
         document.getElementById("Recuperaremail").disabled=false;
       // document.getElementById("mensaje_valida").style.display = "block";
     }
   }

 });
   } 

   $('.Recuperar_Email').click(function() {  
    Generar_Password_Aleatorio(10);

    var email =$("#email").val();  
    var password =$("#password_email").val();  
    var info2   = $('.info2');

    $.ajax({
      url   : "<?= URL::to('Recuperar_Password_Email') ?>",
      type  : "POST",
      async : false,
      data  :{ 
        'email'          : email,        
        'password'       : password                        
      },  
      success:function(re){
        info2.hide().find('ul2').empty();
        if(re == 0){        
         info2.find('ul2').append('<li>Se ha enviado un correo a la dirección Ingresada para recuperar tu contraseña.!!</li>'); 
         info2.slideDown();              

         $("#success-alert2").hide(); 
         $("#success-alert2").alert();   
         $("#success-alert2").fadeTo(6000, 500).slideUp(500, function(){
          info2.hide().find('ul2').empty();
          $("#ModalRecuperarPassword").modal('hide'); 
        });

       }
     },
     error:function(re){             
     }
   });
  });

   function Generar_Password_Aleatorio(longitud)
   {
    long=parseInt(longitud);
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    for (i=0; i<long; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));   

     $('#password_email').val(contraseña);

 }

 function ini() { 
  pepe = setTimeout(RenovarToken(),10000); // 5 segundos
  RenovarToken();
}

function RenovarToken(){
  var Token="{{ csrf_token()}}";
  $('#_token_logueo').val(Token);

}

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>