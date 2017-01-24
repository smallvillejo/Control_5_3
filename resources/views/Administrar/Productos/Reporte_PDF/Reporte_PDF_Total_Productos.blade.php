<?php
date_default_timezone_set('America/Bogota');
use Carbon\Carbon;
Carbon::setLocale('es');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reporte - Listado de Productos</title>
  {!! Html::style('global/estilo_reporte_pdf/style.css') !!}
  {!! Html::style('global/estilo_reporte_pdf/css.css') !!}
  <!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="content-type" content="text-html; charset=utf-8">
  <link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
  
  
</head>

<body>
  <header class="clearfix">  
    <div class="container">
      <div align="right"><b><small>Fecha Reporte: {{Carbon::now()->toDayDateTimeString()}}</small></b></div>

      <figure>
        <img class="logo" src="global/estilo_reporte_pdf/logo.png" alt="">
      </figure>

      <div class="company-info">
        <h2 class="title">{{$nombre_empresa = strtoupper($nombre_empresa)}}</h2>
        <b><strong> <font size ="5", color="#000000" face="Arial Black"><span>Dirección Contacto:{{Auth::user()->direccion}}</span></font></strong></b>
        <span></span>
        <span></span> 
        <b><strong> <font size ="5", color="#000000" face="Arial Black"><span>Telefono Contacto:{{Auth::user()->telefono}}</span></font></strong></b>
        <span></span>
        <span></span> 
        <b><strong> <font size ="5", color="#000000" face="Arial Black"><span>Email Contacto:{{Auth::user()->correo}}</span></font></strong></b>
      </div> 

    </div>

  </header>

  <section>   
    <div class="container">
      <div class="table-wrapper">
        <table>
          <tbody class="head">
            <tr>
              <th class="no">#</th>
              <th class="desc"><div>Producto</div></th>
              <th class="qty"><div>Stock</div></th>
              <th class="qty"><div>Valor/Venta</div></th>
              <th class="qty"><div>Valor/Inversión</div></th>
              <th class="total"><div>Valor/Total</div></th>   
            </tr>
          </tbody>
          <input type="hidden" value="{{$numero = 1}}"> 
          <tbody class="body">

            @foreach ($Productos as $value)
            <tr>
              <td class="no">{{$numero++}}</td>
              <td class="desc"><b><strong><font size ="5", face="Arial Black">{{$value->nombre_producto}}</font></strong></b></td>
              <td class="qty">{{$value->cantidad_producto}} </td>
              <td class="qty">${{$Valor_Venta=number_format($value->valor_venta_producto)}}</td>
              <td class="qty">${{$Valor_Inversion_Total=number_format($value->valor_inversion_producto)}} </td>
              <td class="total">${{$Valor_Inversion=number_format($value->valor_total_inversion)}} </td>
            </tr>
            @endforeach           
          </tbody>
        </table>
      </div>
      <div class="no-break">
        <table class="grand-total">
          <tbody>
            <tr>
              <td class="no"></td>
              <td class="desc"></td>
              <td class="qty"></td>
              <td class="qty"></td>
              <td class="qty"></td>
              <td class="unit">TOTAL INVERSIÓN:</td>
              <td class="total"><b><strong><font size ="5", face="Arial Black">${{$TotalInversion}}</font></strong></b></td>
            </tr>           
            <tr>
              <!-- <td class="grand-total" colspan="7"><div><span>GRAND TOTAL:</span>$6,500.00</div></td> -->
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">     
      <br>
      <br>
      <br>
      <div class="end">Reporte Generado por Merchandise Control.</div>
    </div>
  </footer>

</body>

</html>
