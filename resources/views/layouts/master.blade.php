<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8"/>
  <title>@yield('title') | Merchandise Control</title>
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
  <link href="global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
  <link href="global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
  <link type="text/css" rel="stylesheet" href="global/plugins/zoom/style.css"/> 
  <link href="global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
  <link href="global/css/components-md.css" id="style_components" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datepicker/css/datepicker.css"/>
  <link rel="stylesheet" type="text/css" href="global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
  <link href="global/css/plugins-md.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
  <link id="style_color" href="global/admin/layout2/css/themes/grey.css" rel="stylesheet" type="text/css"/>
  <link href="global/admin/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
  <link href="global/plugins/select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
  <link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
  <script src="global/plugins/jquery/jquery-3.1.0.min.js"></script>
</head>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
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
  Variable_Tiempo = setTimeout('document.location.href = "{{ route('Cerrar_Sesion_X_Tiempo')}}"',1);
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

  function Cargar_Bar_Notificaciones(){
    $.ajax({
      type:'get',
      url:'{{ url('cargar_div')}}',
      success: function(data){       
        $('#notificaciones_id').empty().html(data);
      }         
    });
  }

  function Notificaciones_PocoStock(){
    var $notifica = $('.notifica');
    var $MensajeNotifica = $('.MensajeNotifica');
    var count = Number($notifica.text());
    var $MensajeNotificacionStockAlimentos = $('.MensajeNotificacionStockAlimentos');
    var $MensajeNotificacionStockProductos = $('.MensajeNotificacionStockProductos');

    $.ajax({
      type:'get',
      url:'{{ url('Notificaciones_PocoStock')}}',
      success: function(data){       
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
        <a href="{{URL::route('Index')}}">
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
          <div class="page-top">
            <div class="top-menu">
              <ul class="nav navbar-nav pull-right">
                <li style="right:20px;top:10px;">
                  <span id="countdown"></span>
                  <div class="alert alert-success info2" style="display: none;" id="success-alert2"  title="La Sessión se cerrara..."><strong><ul2></ul2></strong>
                  </div>
                </li>               
                <div id="notificaciones_id"></div>
              </ul>
            </div>           
          </div>        
        </div>        
      </div>     
      <div class="clearfix">
      </div>
      <div class="page-container">      
        <div class="page-sidebar-wrapper">        
          <div class="page-sidebar navbar-collapse collapse">           
            <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
              <?php
              $vista = Route::currentRouteName();
              $current = array
              (
                'Index' => '',
                'RegistrarVenta' => '',
                'Administrar' => '',
                'Consultas' => '',
                'AdministrarPlanes' => '',
                'AdministrarRecargas' => '',
                'AdministrarInternet' => '',
                'AdministrarCompras' => ''
                );
              if ($vista == '' || $vista == 'Index'){
                $current['Index'] = 'active';
              }
              else if ($vista == '' || $vista == 'RegistrarVenta'){
                $current['RegistrarVenta'] = 'active';
              }
              else if ($vista == '' || $vista == 'AdministrarProductos' || $vista == 'AdministrarAlimentos'){
                $current['Administrar'] = 'active';
              } 
              else if ($vista == '' || $vista == 'ConsultarVentaProducto'){
                $current['Consultas'] = 'active';
              }  
              else if ($vista == '' || $vista == 'AdministrarPlanes'){
                $current['AdministrarPlanes'] = 'active';
              }  
              else if ($vista == '' || $vista == 'AdministrarRecargas'){
                $current['AdministrarRecargas'] = 'active';
              }
              else if ($vista == '' || $vista == 'AdministrarInternet'){
                $current['AdministrarInternet'] = 'active';
              }
              else if ($vista == '' || $vista == 'AdministrarCompras'){
                $current['AdministrarCompras'] = 'active';
              }
              ?>
              <li class="{{$current['Index']}}">
                <a href="{{URL::route('Index')}}">
                  <i class="icon-home"></i>
                  <span class="title">Menú Principal</span>
                </a>
              </li>
              <li class="{{$current['RegistrarVenta']}}">
                <a href="javascript:;">
                  <i class="icon-basket"></i>
                  <span class="title">Vender</span>
                  <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="{{URL::route('RegistrarVenta')}}">
                      <i class="fa fa-plus"></i>
                      Registrar Venta</a>
                    </li>
                  </ul>
                </li>
                <li class="{{$current['Administrar']}}">
                  <a href="javascript:;">
                    <i class="fa fa-folder-open" aria-hidden="true"></i>
                    <span class="title">Administrar</span>
                    <span class="arrow "></span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{URL::route('AdministrarProductos')}}">
                       <i class="fa fa-plus-circle" aria-hidden="true"></i>
                       Administrar Productos</a>
                     </li>                                                                 
                     <li>
                       <a href="{{URL::route('AdministrarAlimentos')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Administrar Alimentos</a>
                      </li>
                    </ul>
                  </li> 
                  <li class="{{$current['AdministrarPlanes']}}">
                    <a href="{{URL::route('AdministrarPlanes')}}">
                      <i class="fa fa-phone-square" aria-hidden="true"></i>
                      <span class="title">Planes Celular</span>
                    </a>
                  </li>
                  <li class="{{$current['AdministrarRecargas']}}">
                    <a href="{{URL::route('AdministrarRecargas')}}">
                     <i class="fa fa-mobile" aria-hidden="true"></i>
                     <span class="title">Recargas</span>
                   </a>
                 </li>
                 <li class="{{$current['AdministrarInternet']}}">
                  <a href="{{URL::route('AdministrarInternet')}}">
                    <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                    <span class="title">Internet</span>
                  </a>
                </li> 
                 <li class="{{$current['AdministrarCompras']}}">
                  <a href="{{URL::route('AdministrarCompras')}}">
                    <i class="fa fa-money" aria-hidden="true"></i> 
                    <span class="title">Compras</span>
                  </a>
                </li>                                  
                <li class="{{$current['Consultas']}}">
                  <a href="javascript:;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <span class="title">Consultas</span>
                    <span class="arrow "></span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Venta Producto</a>
                     </li> 
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Venta Alimento</a>
                     </li>
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Venta Minutos</a>
                     </li>
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Venta Recargas</a>
                     </li>
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Venta Internet</a>
                     </li>
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Compras</a>
                     </li>
                     <li>
                      <a href="{{URL::route('ConsultarVentaProducto')}}">
                       <i class="fa fa-search" aria-hidden="true"></i>
                       Gastos&Inversiones</a>
                     </li>
                   </ul>
                 </li>                    
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
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    @yield('content')
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
                                      Cargar_Bar_Notificaciones();

                                      
                                      // console.clear();
                                    </script>
                                   <!--  <script src="jquery.pulsate.min.js">
                                 </script> -->


                               </body>
                               <!-- END BODY -->
                               </html>
