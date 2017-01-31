
<link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
<!-- <link href="global/login/login/estilo_login.css" rel="stylesheet" type="text/css"/> -->
<style type="text/css">
  body  {
    height: 100%;
    background-repeat: no-repeat;
    /*background-image: linear-gradient(135deg, rgba(31,123,229,1) 0%, rgba(58,139,232,1) 47%, rgba(70,153,234,1) 92%, rgba(72,156,234,1) 100%);*/
    background-image: url("global/login/login/fondo.jpg"); 
    background-size: 100% 100%;    
    /*background-repeat: no-repeat;*/
  } 
</style>
<title>Bienvenido a Merchandise Control</title>

<br>
<br>
<br>
<div class="col-xs-12 col-sm-12 col col-md-4 col-lg-4 col-md-offset-4">
  <center><img src="global/login/login/logo.png" /></center>
  <br>
  <h4><font color ="#ffffff">Inicia sesión para acceder a <strong>Merchandise Control</strong></font></h4>
  <div class="panel panel-default"> 
    <!-- style="background: #082f59"   -->
    <div class="panel-body">
      <center><img id="profile-img" class="img-circle" alt="Cinque Terre" width="150" height="150" src="global/login/login/photo.jpg" /></center>
      <br>
      <center>
        <label id="NombreUser"></label><br>
        <label id="EmailUser"></label>
      </center>    
      <form class="form-signin">
        <span id="reauth-email" class="reauth-email"></span>
        <input type="email" id="correo" name="correo" class="form-control" placeholder="Ingresa tu Correo Electrónico" required autofocus>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu Contraseña" style="display: none" required autofocus>
        <br>
        <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">  
        <div class="panel panel-danger" style="display:none" id="mensaje">
          <div class="panel-heading" id="valida" style="display:none">        
          </div>
        </div>         
        <button class="btn btn-lg btn-success btn-block btn-signin btnSiguiente" type="button" id="Siguiente">Siguiente</button>
        <button class="btn btn-lg btn-success btn-block btn-signin IniciarSesion" type="button" style="display: none" id="Iniciar">Iniciar Sesión</button>

      </form><!-- /form -->
      <a href="#" class="forgot-password">
        ¿Olvide mi contraseña?
      </a>
    </div>
  </div>
  <center><a href=""><h4><font color ="#ffffff">Inciar Sesión con otra cuenta</font></h4></a></center>
</div>

<script src='global/plugins/jquery/jquery-3.1.0.min.js'></script>


<script type="text/javascript">

  function validar_login(){
    var email = $('#correo').val();   
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; 
    var str =  email;
    var resultado = str.toLowerCase();
    if(email==""){
      $('#valida').html('');
      $('#mensaje').show();
      $('#valida').append('<p><strong>Introduce tu correo electrónico.</strong></p>'); 
      document.getElementById("valida").style.display = "block";
      return true;
    }else{
      $('#valida').html('');
      if (emailRegex.test(resultado)){       
      }else{
        $('#valida').html('');
        $('#mensaje').show();
        $('#valida').append('<p><strong>Lo sentimos, La dirección de correo es incorrecta.</strong></p>'); 
        document.getElementById("valida").style.display = "block";
        return true;
      }
      $('#mensaje').hide();
      return false;
    }
  }

  function validar_login2(){
    var email = $('#EmailUser').text();   
    var password = $('#password').val();
    emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i; 
    var str =  email;
    var resultado = str.toLowerCase();
    if(email==""){
      $('#valida').html('');
      $('#mensaje').show();
      $('#valida').append('<p><strong>Introduce tu correo electrónico.</strong></p>'); 
      document.getElementById("valida").style.display = "block";
      return true;
    }else{
      $('#valida').html('');
      if (emailRegex.test(resultado)){
        if(password==""){
         $('#mensaje').show();
         $('#valida').append('<p><strong>El password no puede estar vacio.</strong></p>'); 
         document.getElementById("valida").style.display = "block";
         return true;
       }
     }else{
      $('#valida').html('');
      $('#mensaje').show();
      $('#valida').append('<p><strong>Lo sentimos, La dirección de correo es incorrecta.</strong></p>'); 
      document.getElementById("valida").style.display = "block";
      return true;
    }
    $('#mensaje').hide();
    return false;
  }
}

$('.btnSiguiente').click(function(){
  if(validar_login()==true){
  }else{
    var correo =$('#correo').val();  
    var _token=$('#_token').val();
    $.ajax({
      url   : "<?= URL::to('ConsultarEmail') ?>",
      type  : "POST",
      async : false,   
      data  :{
        '_token'  : _token,
        'correo'   : correo        
      },    
      success:function(data){
        $('#valida').html('');
        if(data.Resultado=="Error"){         
          $('#mensaje').show();
          $('#valida').append('<p><strong>'+data.ErrorEnEmail+'</strong></p>');     
          document.getElementById("valida").style.display = "block";   
          
        }else{
         if(data.Resultado=="oK"){
          $('#NombreUser').text(data.NombreUsuario);
          $('#EmailUser').text(data.CorreoUsuario);
          $("#NombreUser").css("font-weight","Bold");
          $("#NombreUser").css("fontSize", 23);          
          $('#correo').hide();
          $('#Siguiente').hide();
          $('#password').show();
          $('#Iniciar').show();
          $("#profile-img").attr("src",data.FotoUsuario);         
          
        }
      }   
    }    
  });
  }

});
$('.IniciarSesion').click(function(){
  if(validar_login2()==true){
  }else{
   var correo =$('#EmailUser').text();   
   var password =$('#password').val();
   var _token=$('#_token').val();

   $.ajax({
    url   : "<?= URL::to('Login') ?>",
    type  : "POST",
    async : false,   
    data  :{
      '_token'  : _token,
      'correo'   : correo,
      'password': password
    },    
    success:function(data){
      $('#valida').html('');
      if(data.error==false){
        $.each(data.errors,function(index, error){ 
          $('#mensaje').show();
          $('#valida').append('<p><strong>'+error+'</strong></p>');     
          document.getElementById("valida").style.display = "block";      
        });  
      }else{           
        if(data.ErrorEnPass==false){               
          $('#mensaje').show();           
          $('#valida').append('<p><strong>'+data.errors+'</strong></p>'); 
          document.getElementById("valida").style.display = "block"; 
        }else{
          if(data=='ok'){
           $('#mensaje').hide();
           $('#valida').html('');
           document.getElementById("valida").style.display = "block";  
           document.location.href = "<?php echo e(route('Index')); ?>";                
         }
       }
     }
   }
 });      
 }
});



<?php if(Session::has('mensaje')): ?>
Mostrar_Mensaje_Verificacion_Email();
<?php endif; ?>

<?php if(Session::has('mensaje2')): ?>
Mostrar_Mensaje_Verificacion_Email2();
<?php endif; ?>


<?php if(Session::has('mensaje_inactivo')): ?>
Mostrar_Mensaje_Cuenta_Inactiva();
<?php endif; ?>

function Mostrar_Mensaje_Verificacion_Email(){
  $('#ModalConfirmacion').modal('show');
  $('#TitleModal').html('<p>Cuenta Verificada.</p>');
  $('#CuerpoMensaje').html('<p><?php echo e(Session::get('mensaje')); ?></p>');   

}

function Mostrar_Mensaje_Verificacion_Email2(){

  $('#ModalConfirmacion').modal('show');
  $('#TitleModal').html('<p>Error al verificar la cuenta.</p>');
  $('#CuerpoMensaje').html('<p><?php echo e(Session::get('mensaje2')); ?></p>');   

}


function Mostrar_Mensaje_Cuenta_Inactiva(){

  $('#ModalConfirmacion').modal('show');
  $('#TitleModal').html('<p>Cuenta Inactiva.</p>');
  $('#CuerpoMensaje').html('<p><?php echo e(Session::get('mensaje_inactivo')); ?></p>');   

}

function Mostrar_Mensaje_Verificacion_Email2(){

  $('#ModalConfirmacion').modal('show');
  $('#TitleModal').html('<p>Error al verificar la cuenta.</p>');
  $('#CuerpoMensaje').html('<p><?php echo e(Session::get('mensaje2')); ?></p>');  


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
  var Token="<?php echo e(csrf_token()); ?>";
  $('#_token_logueo').val(Token);

}

</script>
<!-- END JAVASCRIPTS -->


</body>
<!-- END BODY -->
</html>