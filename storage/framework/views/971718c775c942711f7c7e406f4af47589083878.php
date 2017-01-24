<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
?>
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
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title><?php echo $__env->yieldContent('title'); ?> | Merchandise Control</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <!-- Para que no guarde en cache -->
  <meta http-equiv="no-cache">
  <meta http-equiv="Expires" content="-1">
  <meta http-equiv="Cache-Control" content="no-cache">
  <!-- Para que no guarde en cache -->
  
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"> -->
  <!-- <link href="global/master/css.css" rel="stylesheet" type="text/css"> -->
  <link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
  <link type="text/css" rel="stylesheet" href="global/plugins/zoom/style.css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN THEME STYLES -->
  <link href="global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
  <link href="global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datepicker/css/datepicker.css"/>
  <link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
  <link href="global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
  <link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
  <link href="global/plugins/select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
  <script src="global/plugins/jquery/jquery-3.1.0.min.js"></script>
  

</head>
<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="_token">
  <!--  <script type="text/javascript">
  window.onbeforeunload = function exitAlert()
  {
  var textillo = L"os datos que no se han guardado se perderan.";
  return textillo;
  }
</script> -->
<script type="text/javascript">
  var timer;
  var Variable_Tiempo;
  
  function ini() {
 
  // Variable_Tiempo= window.setTimeout(function(){ContadorSesion();},300000);//Tiempo en milesegundos en que carga la funcion contador    300000=5 Minutos
 
}
function CancelarContador() {
  $('#success-alert2').hide();
  window.clearTimeout(timer);
  window.clearTimeout(Variable_Tiempo);
  ini();
  // clearInterval(timer);
}
function ContadorSesion(){
  var info2   = $('.info2');
  var mensaje;
  // var time = "00:02:30",
  var time = "00:02:00",
  parts = time.split(':'),
  hours = +parts[0],
  minutes = +parts[1],
  seconds = +parts[2],
  span = $('#countdown');
  function correctNum(num) {
    return (num<10)? ("0"+num):num;
  }
  timer = setInterval(function(){
    $('#success-alert2').show();
    seconds--;
    if(seconds == -1) {
      seconds = 59;
      minutes--;
      if(minutes == -1) {
        minutes = 59;
        hours--;
        if(hours==-1) {
  // alert("timer finished");
  clearInterval(timer);
  $mensajee="Su sesión ha expirado.";
  Variable_Tiempo = setTimeout('document.location.href = "<?php echo e(route('Cerrar_Sesion_X_Tiempo')); ?>"',1);
  return  ;
}
}
}
info2.find('ul2').html('<li><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i>'+''+correctNum(hours) + ":" + correctNum(minutes) + ":" + correctNum(seconds)+' '+'<button type="button" class="btn btn-danger btn-xs" onclick="CancelarContador()">Cancelar</button></li>');
info2.slideDown();
  // span.text('Tu Sesión Se Cerrara En:'+' '+correctNum(hours) + ":" + correctNum(minutes) + ":" + correctNum(seconds)+'<button> </button>');
}, 1000);
}
</script>
<script type="text/javascript">

  function deshabilitaRetroceso(){
    window.location.hash=" ";
  window.location.hash="Again-No-back-button" //chrome
  window.onhashchange=function(){window.location.hash=" ";}
}
</script>

<script type="text/javascript">

  function Notificaciones_PocoStock(){


    var $notifica = $('.notifica');
    var $MensajeNotifica = $('.MensajeNotifica');
    var count = Number($notifica.text());
    var $MensajeNotificacionStockAlimentos = $('.MensajeNotificacionStockAlimentos');
    var $MensajeNotificacionStockProductos = $('.MensajeNotificacionStockProductos');

    $.ajax({
      type:'get',
      url:'<?php echo e(url('Notificaciones_PocoStock')); ?>',
      success: function(data){
        $('#pulsate-regular').pulsate("destroy");
        if(data.NumeroNotificacion>0){
          $('#ID_notifica').show();         
        }else{
         $('#ID_notifica').hide();                   
       }
       $notifica.text(data.NumeroNotificacion);
       $MensajeNotifica.html(data.MensajeNotificacion);
       $MensajeNotificacionStockAlimentos.html(data.MensajeAlimento);  
       $MensajeNotificacionStockProductos.html(data.MensajeProducto); 
     }         
   });
  }
</script> 
<body class="page-md page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile page-footer-fixed1" onload="deshabilitaRetroceso();ini();" onkeypress="CancelarContador()" onclick="CancelarContador()" >
  <!-- BEGIN HEADER -->
  <div class="page-header md-shadow-z-1-i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
      <!-- BEGIN LOGO -->
      <div class="page-logo">
        <a href="<?php echo e(URL::route('Index')); ?>">
          <img src="global/images/titulo2.png" alt="logo" class="logo-default" height="40" width="130">
        </a>
        <div class="menu-toggler sidebar-toggler">
          <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
        </div>
      </div>
      <!-- END LOGO -->
      <!-- BEGIN RESPONSIVE MENU TOGGLER -->
      <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      </a>
      <!-- END RESPONSIVE MENU TOGGLER -->
      <!-- BEGIN PAGE ACTIONS -->
      <!-- DOC: Remove "hide" class to enable the page header actions -->
      <div class="page-actions">
        <div class="btn-group hide">
          <button type="button" class="btn btn-circle red-pink dropdown-toggle" data-toggle="dropdown">
            <i class="icon-bar-chart"></i>&nbsp;<span class="hidden-sm hidden-xs">New&nbsp;</span>&nbsp;<i class="fa fa-angle-down"></i>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li>
              <a href="javascript:;">
                <i class="icon-user"></i> New User </a>
              </li>
              <li>
                <a href="javascript:;">
                  <i class="icon-present"></i> New Event <span class="badge badge-success">4</span>
                </a>
              </li>
              <li>
                <a href="javascript:;">
                  <i class="icon-basket"></i> New order </a>
                </li>
                <li class="divider">
                </li>
                <li>
                  <a href="javascript:;">
                    <i class="icon-flag"></i> Pending Orders <span class="badge badge-danger">4</span>
                  </a>
                </li>
                <li>
                  <a href="javascript:;">
                    <i class="icon-users"></i> Pending Users <span class="badge badge-warning">12</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- END PAGE ACTIONS -->
          <!-- BEGIN PAGE TOP -->
          <div class="page-top">
            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
              <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <!-- Contador -->
                <li style="right:20px;top:10px;">
                  <span id="countdown"></span>
                  <div class="alert alert-success info2" style="display: none;" id="success-alert2"  title="La Sessión se cerrara..."><strong><ul2></ul2></strong>
                  </div>
                </li>
                <!-- Termina Contador -->
                <!-- BEGIN TODO DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-usd" aria-hidden="true"></i>
                    <!-- <span class="badge badge-default"> -->
                    <!-- 7 </span> -->
                  </a>
                  <ul class="dropdown-menu">
                    <li class="external">
                      <h3><span class="bold">Ventas del dia</span></h3>
                      <!-- <a href="extra_profile.html">Ver todas</a> -->
                    </li>
                    <li>
                      <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                        <li>
                          <a href="<?php echo e(URL::route('Ventas_Productos_X_Fecha')); ?>">
                            <!-- <span class="time">just now</span> -->
                            <span class="details">
                              <span class="label label-sm label-icon label-success"> <i class="fa fa-usd fa-2x" aria-hidden="true"></i>
                              </span>
                              Últimas ventas - PRODUCTOS. </span>
                            </a>
                          </li>
                          <li>
                            <a href="<?php echo e(URL::route('Ventas_Alimentos_X_Fecha')); ?>">
                              <!-- <span class="time">just now</span> -->
                              <span class="details">
                                <span class="label label-sm label-icon label-danger"> <i class="fa fa-cutlery" aria-hidden="true"></i>
                                </span>
                                Últimas ventas - ALIMENTOS. </span>
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <!-- END TODO DROPDOWN -->
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    
                    <li class="dropdown dropdown-extended dropdown-notification" id="pulsate-regular">
                      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i> 
                        <span class="badge badge-default notifica" id="ID_notifica">
                        </span> 
                        <script type="text/javascript">
                          $('#ID_notifica').hide();
                        </script>                    
                      </a>
                      <ul class="dropdown-menu">                            
                        <li class="external MensajeNotifica">                            
                        </li>                           
                        <li>
                          <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                            <li class="MensajeNotificacionStockProductos"></li>
                            <li class="MensajeNotificacionStockAlimentos"></li>
                          </ul>
                        </li>
                      </ul>
                      
                    </li>

                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                          <!-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                              <i class="icon-envelope-open"></i>
                              <span class="badge badge-default">
                                4 </span>
                              </a>
                              <ul class="dropdown-menu">
                                <li class="external">
                                  <h3>You have <span class="bold">7 New</span> Messages</h3>
                                  <a href="page_inbox.html">view all</a>
                                </li>
                                <li>
                                  <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                      <a href="inbox.html?a=view">
                                        <span class="photo">
                                          <img src="global/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                        </span>
                                        <span class="subject">
                                          <span class="from">
                                            Lisa Wong </span>
                                            <span class="time">Just Now </span>
                                          </span>
                                          <span class="message">
                                            Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                          </a>
                                        </li>
                                        <li>
                                          <a href="inbox.html?a=view">
                                            <span class="photo">
                                              <img src="global/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                            </span>
                                            <span class="subject">
                                              <span class="from">
                                                Richard Doe </span>
                                                <span class="time">16 mins </span>
                                              </span>
                                              <span class="message">
                                                Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                              </a>
                                            </li>
                                            <li>
                                              <a href="inbox.html?a=view">
                                                <span class="photo">
                                                  <img src="global/admin/layout3/img/avatar1.jpg" class="img-circle" alt="">
                                                </span>
                                                <span class="subject">
                                                  <span class="from">
                                                    Bob Nilson </span>
                                                    <span class="time">2 hrs </span>
                                                  </span>
                                                  <span class="message">
                                                    Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                  </a>
                                                </li>
                                                <li>
                                                  <a href="inbox.html?a=view">
                                                    <span class="photo">
                                                      <img src="global/admin/layout3/img/avatar2.jpg" class="img-circle" alt="">
                                                    </span>
                                                    <span class="subject">
                                                      <span class="from">
                                                        Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                      </span>
                                                      <span class="message">
                                                        Vivamus sed auctor 40% nibh congue nibh... </span>
                                                      </a>
                                                    </li>
                                                    <li>
                                                      <a href="inbox.html?a=view">
                                                        <span class="photo">
                                                          <img src="global/admin/layout3/img/avatar3.jpg" class="img-circle" alt="">
                                                        </span>
                                                        <span class="subject">
                                                          <span class="from">
                                                            Richard Doe </span>
                                                            <span class="time">46 mins </span>
                                                          </span>
                                                          <span class="message">
                                                            Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                          </a>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                  </ul>
                                                </li> -->
                                                <!-- END INBOX DROPDOWN -->
                                                <!-- BEGIN USER LOGIN DROPDOWN -->
                                                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                                <li class="dropdown dropdown-user">
                                                  <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                    <img alt="" class="img-circle" src="<?php echo e(Auth::user()->photo_perfil); ?>"/>
                                                    <span class="username username-hide-on-mobile">
                                                      <?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>
                                                      <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-default">
                                                      <li>
                                                        <a href="<?php echo e(URL::route('perfil_user')); ?>">
                                                          <i class="icon-user"></i> Mi Perfil </a>
                                                        </li>
                                                        <li>
                                                          <a href="page_calendar.html">
                                                            <i class="icon-calendar"></i> My Calendar </a>
                                                          </li>
                                                          <li>
                                                            <a href="inbox.html">
                                                              <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
                                                              3 </span>
                                                            </a>
                                                          </li>
                                                          <li>
                                                            <a href="page_todo.html">
                                                              <i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
                                                              7 </span>
                                                            </a>
                                                          </li>
                                                          <li class="divider">
                                                          </li>
                                                          <li>
                                                            <a href="extra_lock.html">
                                                              <i class="icon-lock"></i> Lock Screen </a>
                                                            </li>
                                                            <li>
                                                              <a href="<?php echo e(URL::route('Salir')); ?>">
                                                                <i class="icon-key"></i> Cerrar Sesión </a>
                                                              </li>
                                                            </ul>
                                                          </li>
                                                          <!-- END USER LOGIN DROPDOWN -->
                                                        </ul>
                                                      </div>
                                                      <!-- END TOP NAVIGATION MENU -->
                                                    </div>
                                                    <!-- END PAGE TOP -->
                                                  </div>
                                                  <!-- END HEADER INNER -->
                                                </div>
                                                <!-- END HEADER -->
                                                <div class="clearfix">
                                                </div>
                                                <!-- BEGIN CONTAINER -->
                                                <div class="page-container">
                                                  <!-- BEGIN SIDEBAR -->
                                                  <div class="page-sidebar-wrapper">
                                                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                                                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                                                    <div class="page-sidebar navbar-collapse collapse">
                                                      <!-- BEGIN SIDEBAR MENU -->
                                                      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                                                      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                                                      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                                                      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                                                      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                                                      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                                                      <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                                                        <?php
                                                        $vista = Route::currentRouteName();
                                                        $current = array
                                                        (
                                                          'Index' => '',
                                                          'RegistrarVenta' => '',
                                                          'Administrar' => '',

                                                          );
                                                        if ($vista == '' || $vista == 'Index')
                                                        {
                                                          $current['Index'] = 'active';
                                                        }
                                                        else if ($vista == '' || $vista == 'RegistrarVenta')
                                                        {
                                                          $current['RegistrarVenta'] = 'active';
                                                        }
                                                        else if ($vista == '' || $vista == 'AdministrarProductos' || $vista == 'AdministrarAlimentos')
                                                        {
                                                          $current['Administrar'] = 'active';
                                                        }                                                                      
                                                        ?>
                                                        <li class="<?php echo e($current['Index']); ?>">
                                                          <a href="<?php echo e(URL::route('Index')); ?>">
                                                            <i class="icon-home"></i>
                                                            <span class="title">Index</span>
                                                          </a>
                                                        </li>
                                                        <li class="<?php echo e($current['RegistrarVenta']); ?>">
                                                          <a href="javascript:;">
                                                            <i class="icon-basket"></i>
                                                            <span class="title">Vender</span>
                                                            <span class="arrow "></span>
                                                          </a>
                                                          <ul class="sub-menu">
                                                            <li>
                                                              <a href="<?php echo e(URL::route('RegistrarVenta')); ?>">
                                                                <i class="fa fa-plus"></i>
                                                                Registrar Venta</a>
                                                              </li>
                                                            </ul>
                                                          </li>
                                                          <li class="<?php echo e($current['Administrar']); ?>">
                                                            <a href="javascript:;">
                                                              <i class="fa fa-folder-open" aria-hidden="true"></i>
                                                              <span class="title">Administrar</span>
                                                              <span class="arrow "></span>
                                                            </a>
                                                            <ul class="sub-menu">
                                                              <li>
                                                                <a href="<?php echo e(URL::route('AdministrarProductos')); ?>">
                                                                 <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                 Administrar Productos</a>
                                                               </li>                                                                 
                                                               <li>
                                                                 <a href="<?php echo e(URL::route('AdministrarAlimentos')); ?>">
                                                                  <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                                  Administrar Alimentos</a>
                                                                </li>
                                                              </ul>
                                                            </li>
            <!-- <li>
              <a href="ecommerce_orders.html">
                <i class="icon-basket"></i>
              Orders</a>
            </li>
            <li>
              <a href="ecommerce_orders_view.html">
                <i class="icon-tag"></i>
              Order View</a>
            </li>
            <li>
              <a href="ecommerce_products.html">
                <i class="icon-handbag"></i>
              Products</a>
            </li>
            <li>
              <a href="ecommerce_products_edit.html">
                <i class="icon-pencil"></i>
              Product Edit</a>
            </li>
          </ul>
        </li>
        <li class="#">
          <a href="javascript:;">
            <i class="icon-rocket"></i>
            <span class="title">Page Layouts</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="layout_fontawesome_icons.html">
                <span class="badge badge-roundless badge-danger">new</span>Layout with Fontawesome Icons</a>
              </li>
              <li>
                <a href="layout_glyphicons.html">
                Layout with Glyphicon</a>
              </li>
              <li>
                <a href="layout_full_height_content.html">
                  <span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
                </li>
                <li>
                  <a href="layout_sidebar_reversed.html">
                    <span class="badge badge-roundless badge-warning">new</span>Right Sidebar Page</a>
                  </li>
                  <li>
                    <a href="layout_sidebar_fixed.html">
                    Sidebar Fixed Page</a>
                  </li>
                  <li>
                    <a href="layout_sidebar_closed.html">
                    Sidebar Closed Page</a>
                  </li>
                  <li>
                    <a href="layout_ajax.html">
                    Content Loading via Ajax</a>
                  </li>
                  <li>
                    <a href="layout_disabled_menu.html">
                    Disabled Menu Links</a>
                  </li>
                  <li>
                    <a href="layout_blank_page.html">
                    Blank Page</a>
                  </li>
                  <li class="#">
                    <a href="layout_fluid_page.html">
                    Fluid Page</a>
                  </li>
                  <li>
                    <a href="layout_language_bar.html">
                    Language Switch Bar</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="javascript:;">
                  <i class="icon-diamond"></i>
                  <span class="title">UI Features</span>
                  <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="ui_general.html">
                    General Components</a>
                  </li>
                  <li>
                    <a href="ui_buttons.html">
                    Buttons</a>
                  </li>
                  <li>
                    <a href="ui_icons.html">
                      <span class="badge badge-roundless badge-danger">new</span>Font Icons</a>
                    </li>
                    <li>
                      <a href="ui_colors.html">
                      Flat UI Colors</a>
                    </li>
                    <li>
                      <a href="ui_typography.html">
                      Typography</a>
                    </li>
                    <li>
                      <a href="ui_tabs_accordions_navs.html">
                      Tabs, Accordions & Navs</a>
                    </li>
                    <li>
                      <a href="ui_tree.html">
                        <span class="badge badge-roundless badge-danger">new</span>Tree View</a>
                      </li>
                      <li>
                        <a href="ui_page_progress_style_1.html">
                          <span class="badge badge-roundless badge-warning">new</span>Page Progress Bar</a>
                        </li>
                        <li>
                          <a href="ui_blockui.html">
                          Block UI</a>
                        </li>
                        <li>
                          <a href="ui_bootstrap_growl.html">
                            <span class="badge badge-roundless badge-warning">new</span>Bootstrap Growl Notifications</a>
                          </li>
                          <li>
                            <a href="ui_notific8.html">
                            Notific8 Notifications</a>
                          </li>
                          <li>
                            <a href="ui_toastr.html">
                            Toastr Notifications</a>
                          </li>
                          <li>
                            <a href="ui_alert_dialog_api.html">
                              <span class="badge badge-roundless badge-danger">new</span>Alerts & Dialogs API</a>
                            </li>
                            <li>
                              <a href="ui_session_timeout.html">
                              Session Timeout</a>
                            </li>
                            <li>
                              <a href="ui_idle_timeout.html">
                              User Idle Timeout</a>
                            </li>
                            <li>
                              <a href="ui_modals.html">
                              Modals</a>
                            </li>
                            <li>
                              <a href="ui_extended_modals.html">
                              Extended Modals</a>
                            </li>
                            <li>
                              <a href="ui_tiles.html">
                              Tiles</a>
                            </li>
                            <li>
                              <a href="ui_datepaginator.html">
                                <span class="badge badge-roundless badge-success">new</span>Date Paginator</a>
                              </li>
                              <li>
                                <a href="ui_nestable.html">
                                Nestable List</a>
                              </li>
                            </ul>
                          </li>
                          <li>
                            <a href="javascript:;">
                              <i class="icon-puzzle"></i>
                              <span class="title">UI Components</span>
                              <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                              <li>
                                <a href="components_pickers.html">
                                Date & Time Pickers</a>
                              </li>
                              <li>
                                <a href="components_context_menu.html">
                                Context Menu</a>
                              </li>
                              <li>
                                <a href="components_dropdowns.html">
                                Custom Dropdowns</a>
                              </li>
                              <li>
                                <a href="components_form_tools.html">
                                Form Widgets & Tools</a>
                              </li>
                              <li>
                                <a href="components_form_tools2.html">
                                Form Widgets & Tools 2</a>
                              </li>
                              <li>
                                <a href="components_editors.html">
                                Markdown & WYSIWYG Editors</a>
                              </li>
                              <li>
                                <a href="components_ion_sliders.html">
                                Ion Range Sliders</a>
                              </li>
                              <li>
                                <a href="components_noui_sliders.html">
                                NoUI Range Sliders</a>
                              </li>
                              <li>
                                <a href="components_jqueryui_sliders.html">
                                jQuery UI Sliders</a>
                              </li>
                              <li>
                                <a href="components_knob_dials.html">
                                Knob Circle Dials</a>
                              </li>
                            </ul> -->
                            <!-- </li> -->
                            <!-- BEGIN ANGULARJS LINK -->
                          <!-- <li class="tooltips" data-container="body" data-placement="right" data-html="true" data-original-title="AngularJS version demo">
                            <a href="angularjs" target="_blank">
                              <i class="icon-paper-plane"></i>
                              <span class="title">
                              AngularJS Version </span>
                            </a>
                          </li> -->
                          <!-- END ANGULARJS LINK -->
                          <!--  <li> -->
                           <!--  <a href="javascript:;">
                              <i class="icon-settings"></i>
                              <span class="title">Form Stuff</span>
                              <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                              <li>
                                <a href="form_controls_md.html">
                                  <span class="badge badge-roundless badge-danger">new</span>Material Design<br>
                                Form Controls</a>
                              </li>
                              <li>
                                <a href="form_controls.html">
                                  Bootstrap<br>
                                Form Controls</a>
                              </li>
                              <li>
                                <a href="form_icheck.html">
                                iCheck Controls</a>
                              </li>
                              <li>
                                <a href="form_layouts.html">
                                Form Layouts</a>
                              </li>
                              <li>
                                <a href="form_editable.html">
                                  <span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
                                </li>
                                <li>
                                  <a href="form_wizard.html">
                                  Form Wizard</a>
                                </li>
                                <li>
                                  <a href="form_validation.html">
                                  Form Validation</a>
                                </li>
                                <li>
                                  <a href="form_image_crop.html">
                                    <span class="badge badge-roundless badge-danger">new</span>Image Cropping</a>
                                  </li>
                                  <li>
                                    <a href="form_fileupload.html">
                                    Multiple File Upload</a>
                                  </li>
                                  <li>
                                    <a href="form_dropzone.html">
                                    Dropzone File Upload</a>
                                  </li>
                                </ul>
                              </li>
                              <li>
                                <a href="javascript:;">
                                  <i class="icon-briefcase"></i>
                                  <span class="title">Data Tables</span>
                                  <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                  <li>
                                    <a href="table_basic.html">
                                    Basic Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_tree.html">
                                    Tree Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_responsive.html">
                                    Responsive Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_managed.html">
                                    Managed Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_editable.html">
                                    Editable Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_advanced.html">
                                    Advanced Datatables</a>
                                  </li>
                                  <li>
                                    <a href="table_ajax.html">
                                    Ajax Datatables</a>
                                  </li>
                                </ul>
                              </li>
                              <li>
                                <a href="javascript:;">
                                  <i class="icon-wallet"></i>
                                  <span class="title">Portlets</span>
                                  <span class="arrow "></span>
                                </a>
                                <ul class="sub-menu">
                                  <li>
                                    <a href="portlet_general.html">
                                    General Portlets</a>
                                  </li>
                                  <li>
                                    <a href="portlet_general2.html">
                                      <span class="badge badge-roundless badge-danger">new</span>New Portlets #1</a>
                                    </li>
                                    <li>
                                      <a href="portlet_general3.html">
                                        <span class="badge badge-roundless badge-danger">new</span>New Portlets #2</a>
                                      </li>
                                      <li>
                                        <a href="portlet_ajax.html">
                                        Ajax Portlets</a>
                                      </li>
                                      <li>
                                        <a href="portlet_draggable.html">
                                        Draggable Portlets</a>
                                      </li>
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="javascript:;">
                                      <i class="icon-bar-chart"></i>
                                      <span class="title">Charts</span>
                                      <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                      <li>
                                        <a href="charts_amcharts.html">
                                        amChart</a>
                                      </li>
                                      <li>
                                        <a href="charts_flotcharts.html">
                                        Flotchart</a>
                                      </li>
                                    </ul>
                                  </li>
                                  <li>
                                    <a href="javascript:;">
                                      <i class="icon-docs"></i>
                                      <span class="title">Pages</span>
                                      <span class="arrow "></span>
                                    </a>
                                    <ul class="sub-menu">
                                      <li>
                                        <a href="page_timeline.html">
                                          <i class="icon-paper-plane"></i>
                                          <span class="badge badge-warning">2</span>New Timeline</a>
                                        </li>
                                        <li>
                                          <a href="extra_profile.html">
                                            <i class="icon-user-following"></i>
                                            <span class="badge badge-success badge-roundless">new</span>New User Profile</a>
                                          </li>
                                          <li>
                                            <a href="page_todo.html">
                                              <i class="icon-hourglass"></i>
                                              <span class="badge badge-danger">4</span>Todo</a>
                                            </li>
                                            <li>
                                              <a href="inbox.html">
                                                <i class="icon-envelope"></i>
                                                <span class="badge badge-danger">4</span>Inbox</a>
                                              </li>
                                              <li>
                                                <a href="extra_faq.html">
                                                  <i class="icon-info"></i>
                                                FAQ</a>
                                              </li>
                                              <li>
                                                <a href="page_portfolio.html">
                                                  <i class="icon-feed"></i>
                                                Portfolio</a>
                                              </li>
                                              <li>
                                                <a href="page_coming_soon.html">
                                                  <i class="icon-flag"></i>
                                                Coming Soon</a>
                                              </li>
                                              <li>
                                                <a href="page_calendar.html">
                                                  <i class="icon-calendar"></i>
                                                  <span class="badge badge-danger">14</span>Calendar</a>
                                                </li>
                                                <li>
                                                  <a href="extra_invoice.html">
                                                    <i class="icon-flag"></i>
                                                  Invoice</a>
                                                </li>
                                                <li>
                                                  <a href="page_blog.html">
                                                    <i class="icon-speech"></i>
                                                  Blog</a>
                                                </li>
                                                <li>
                                                  <a href="page_blog_item.html">
                                                    <i class="icon-link"></i>
                                                  Blog Post</a>
                                                </li>
                                                <li>
                                                  <a href="page_news.html">
                                                    <i class="icon-eye"></i>
                                                    <span class="badge badge-success">9</span>News</a>
                                                  </li>
                                                  <li>
                                                    <a href="page_news_item.html">
                                                      <i class="icon-bell"></i>
                                                    News View</a>
                                                  </li>
                                                  <li>
                                                    <a href="page_timeline_old.html">
                                                      <i class="icon-paper-plane"></i>
                                                      <span class="badge badge-warning">2</span>Old Timeline</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_profile_old.html">
                                                        <i class="icon-user"></i>
                                                      Old User Profile</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                <li>
                                                  <a href="javascript:;">
                                                    <i class="icon-present"></i>
                                                    <span class="title">Extra</span>
                                                    <span class="arrow "></span>
                                                  </a>
                                                  <ul class="sub-menu">
                                                    <li>
                                                      <a href="page_about.html">
                                                      About Us</a>
                                                    </li>
                                                    <li>
                                                      <a href="page_contact.html">
                                                      Contact Us</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_search.html">
                                                      Search Results</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_pricing_table.html">
                                                      Pricing Tables</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_404_option1.html">
                                                      404 Page Option 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_404_option2.html">
                                                      404 Page Option 2</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_404_option3.html">
                                                      404 Page Option 3</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_500_option1.html">
                                                      500 Page Option 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_500_option2.html">
                                                      500 Page Option 2</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                <li>
                                                  <a href="javascript:;">
                                                    <i class="icon-folder"></i>
                                                    <span class="title">Multi Level Menu</span>
                                                    <span class="arrow "></span>
                                                  </a>
                                                  <ul class="sub-menu">
                                                    <li>
                                                      <a href="javascript:;">
                                                        <i class="icon-settings"></i> Item 1 <span class="arrow"></span>
                                                      </a>
                                                      <ul class="sub-menu">
                                                        <li>
                                                          <a href="javascript:;">
                                                            <i class="icon-user"></i>
                                                            Sample Link 1 <span class="arrow"></span>
                                                          </a>
                                                          <ul class="sub-menu">
                                                            <li>
                                                              <a href="#"><i class="icon-power"></i> Sample Link 1</a>
                                                            </li>
                                                            <li>
                                                              <a href="#"><i class="icon-paper-plane"></i> Sample Link 1</a>
                                                            </li>
                                                            <li>
                                                              <a href="#"><i class="icon-star"></i> Sample Link 1</a>
                                                            </li>
                                                          </ul>
                                                        </li>
                                                        <li>
                                                          <a href="#"><i class="icon-camera"></i> Sample Link 1</a>
                                                        </li>
                                                        <li>
                                                          <a href="#"><i class="icon-link"></i> Sample Link 2</a>
                                                        </li>
                                                        <li>
                                                          <a href="#"><i class="icon-pointer"></i> Sample Link 3</a>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                    <li>
                                                      <a href="javascript:;">
                                                        <i class="icon-globe"></i> Item 2 <span class="arrow"></span>
                                                      </a>
                                                      <ul class="sub-menu">
                                                        <li>
                                                          <a href="#"><i class="icon-tag"></i> Sample Link 1</a>
                                                        </li>
                                                        <li>
                                                          <a href="#"><i class="icon-pencil"></i> Sample Link 1</a>
                                                        </li>
                                                        <li>
                                                          <a href="#"><i class="icon-graph"></i> Sample Link 1</a>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                    <li>
                                                      <a href="#">
                                                        <i class="icon-bar-chart"></i>
                                                      Item 3 </a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                <li>
                                                  <a href="javascript:;">
                                                    <i class="icon-user"></i>
                                                    <span class="title">Login Options</span>
                                                    <span class="arrow "></span>
                                                  </a>
                                                  <ul class="sub-menu">
                                                    <li>
                                                      <a href="login.html">
                                                      Login Form 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="login_2.html">
                                                      Login Form 2</a>
                                                    </li>
                                                    <li>
                                                      <a href="login_3.html">
                                                      Login Form 3</a>
                                                    </li>
                                                    <li>
                                                      <a href="login_soft.html">
                                                      Login Form 4</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_lock.html">
                                                      Lock Screen 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="extra_lock2.html">
                                                      Lock Screen 2</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                <li>
                                                  <a href="javascript:;">
                                                    <i class="icon-envelope-open"></i>
                                                    <span class="title">Email Templates</span>
                                                    <span class="arrow "></span>
                                                  </a>
                                                  <ul class="sub-menu">
                                                    <li>
                                                      <a href="email_template1.html">
                                                      New Email Template 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="email_template2.html">
                                                      New Email Template 2</a>
                                                    </li>
                                                    <li>
                                                      <a href="email_template3.html">
                                                      New Email Template 3</a>
                                                    </li>
                                                    <li>
                                                      <a href="email_template4.html">
                                                      New Email Template 4</a>
                                                    </li>
                                                    <li>
                                                      <a href="email_newsletter.html">
                                                      Old Email Template 1</a>
                                                    </li>
                                                    <li>
                                                      <a href="email_system.html">
                                                      Old Email Template 2</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                                <li class="last ">
                                                  <a href="javascript:;">
                                                    <i class="icon-pointer"></i>
                                                    <span class="title">Maps</span>
                                                    <span class="arrow "></span>
                                                  </a>
                                                  <ul class="sub-menu">
                                                    <li>
                                                      <a href="maps_google.html">
                                                      Google Maps</a>
                                                    </li>
                                                    <li>
                                                      <a href="maps_vector.html">
                                                      Vector Maps</a>
                                                    </li>
                                                  </ul>
                                                </li>
                                              </ul> -->
                                              <!-- END SIDEBAR MENU -->
                                            </div>
                                          </div>
                                          <!-- END SIDEBAR -->
                                          <!-- BEGIN CONTENT -->
                                          <div class="page-content-wrapper">
                                            <div class="page-content">
                                              <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                                              <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                      <h4 class="modal-title">Modal title</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      Widget settings form goes here
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn blue">Save changes</button>
                                                      <button type="button" class="btn default" data-dismiss="modal">Close</button>
                                                    </div>
                                                  </div>
                                                  <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                              </div>
                                              <!-- /.modal -->
                                              <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                                              <!-- BEGIN STYLE CUSTOMIZER -->
                                              <!-- END STYLE CUSTOMIZER -->
                                              <!-- BEGIN PAGE HEADER-->
                                              <!-- <b><strong><font size ="5", color="#000000" face="Arial Black"><?php echo $__env->yieldContent('forma'); ?></font></strong></b> -->
                                              <!--  <div class="page-bar">
                                                <ul class="page-breadcrumb">
                                                  <li>
                                                    <i class="fa fa-home"></i>
                                                    <a href="index.html">Home</a>
                                                    <i class="fa fa-angle-right"></i>
                                                  </li>
                                                  <li>
                                                    <a href="#">Dashboard</a>
                                                  </li>
                                                </ul>
                                                <div class="page-toolbar">
                                                  <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
                                                    <i class="icon-calendar"></i>&nbsp; <span class="uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
                                                  </div>
                                                </div>
                                              </div>  -->
                                              <!-- END PAGE HEADER-->
                                              <!-- BEGIN PAGE CONTENT-->
                                              <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                  <?php echo $__env->yieldContent('content'); ?>
                                                </div>
                                              </div>
                                              <!-- END PAGE CONTENT-->
                                            </div>
                                          </div>
                                          <!-- END CONTENT -->
                                          <!-- BEGIN QUICK SIDEBAR -->
                                          <!--Cooming Soon...-->
                                          <!-- END QUICK SIDEBAR -->
                                        </div>
                                        <!-- END CONTAINER -->
                                        <!-- BEGIN FOOTER -->
                                        <div class="page-footer">
                                          <div class="page-footer-inner">
                                            2016 &copy; Merchandise Control by Jorge Muñoz.
                                          </div>
                                          <div class="scroll-to-top">
                                            <i class="icon-arrow-up"></i>
                                          </div>
                                        </div>
                                        <!-- END FOOTER -->
                                        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                                        <!-- BEGIN CORE PLUGINS -->
                                        <!--[if lt IE 9]>
                                        <script src="global/plugins/respond.min.js"></script>
                                        <script src="global/plugins/excanvas.min.js"></script>
                                        <![endif]-->
                                        <script src="global/plugins/jquery.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
                                        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
                                        <script src="global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
                                        <!-- END CORE PLUGINS -->
                                        <script src="global/scripts/metronic.js" type="text/javascript"></script>
                                        <script src="global/admin/layout2/scripts/layout.js" type="text/javascript"></script>
                                        <script src="global/admin/layout2/scripts/demo.js" type="text/javascript"></script>
                                        <script src="global/plugins/bootstrap-daterangepicker/moment.min.js" type="text/javascript"></script>
                                        <script src="global/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
                                        <script type="text/javascript" src="global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
                                        <script type="text/javascript" src="global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
                                        <script src="global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
                                        <script src="global/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                                        <script src="global/admin/pages/scripts/index.js" type="text/javascript"></script>
                                        <script type="text/javascript" src="global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
                                        <script type="text/javascript" src="global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
                                        <script type="text/javascript" src="global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
                                        <script src="global/scripts/datatable.js"></script>
                                        <script src="global/admin/pages/scripts/ecommerce-orders-view.js"></script>
                                        <script>
                                          jQuery(document).ready(function() {
                                        Metronic.init(); // init metronic core componets
                                        Layout.init(); // init layout
                                        QuickSidebar.init(); // init quick sidebar
                                        Demo.init(); // init demo features
                                        Index.init();
                                        Index.initDashboardDaterange();
                                        Index.initCalendar(); // init index page's custom scripts
                                        EcommerceOrdersView.init();
                                      });
                                    </script>
                                    <!-- END JAVASCRIPTS -->
                                    <script src="global/plugins/select/js/bootstrap-select.min.js" type="text/javascript"></script>
                                    <script type="text/javascript">
                                      $('#id_producto').selectpicker({
                                        size: 8
                                      });
                                      Notificaciones_PocoStock();
                                    </script>
                                    <script src="jquery.pulsate.min.js">
                                    </script>
                                    

                                  </body>
                                  <!-- END BODY -->
                                  </html>
