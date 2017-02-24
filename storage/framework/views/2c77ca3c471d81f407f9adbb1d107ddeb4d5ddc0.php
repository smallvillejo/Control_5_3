<ul class="nav navbar-nav pull-right">
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
            <a href="<?php echo e(URL::route('Ultimas_Ventas_Productos')); ?>">
              <!-- <span class="time">just now</span> -->
              <span class="details">
                <span class="label label-sm label-icon label-success"> <i class="fa fa-usd fa-2x" aria-hidden="true"></i>
                </span>
                Últimas ventas - PRODUCTOS. </span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(URL::route('Ultimas_Ventas_Alimentos')); ?>">
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
      <li class="dropdown dropdown-user">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
          <?php if(Auth::user()->photo_perfil==""): ?>
          <img src="global/login/login/photo.jpg" class="img-circle" alt="">               
          <?php elseif(File::exists(Auth::user()->photo_perfil)): ?>
          <img src="<?php echo e(Auth::user()->photo_perfil); ?>" class="img-circle" alt="">
          <?php else: ?>
          <img src="global/login/login/photo.jpg" class="img-circle" alt="">   
          <?php endif; ?>
          <span class="username username-hide-on-mobile">
            <?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>
            <i class="fa fa-angle-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="<?php echo e(URL::route('perfil_user')); ?>">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> Mi Perfil </a>
              </li>
              <li class="divider">
              </li> 
              <li>
                <a href="<?php echo e(URL::route('account')); ?>">
                <i class="fa fa-key" aria-hidden="true"></i> Mi Cuenta </a>
                </li>
                <li class="divider">
                </li>              
                <li>
                  <a href="<?php echo e(URL::route('Salir')); ?>">
                    <i class="fa fa-power-off" aria-hidden="true"></i> Cerrar Sesión </a>
                  </li>
                </ul>
              </li>
              <!-- END USER LOGIN DROPDOWN -->
            </ul>

            <script type="text/javascript">
              Notificaciones_PocoStock();  
            </script>