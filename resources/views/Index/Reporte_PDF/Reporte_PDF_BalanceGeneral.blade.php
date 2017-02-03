<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BALANCE GENERAL PDF</title>
	<link rel="stylesheet" href="global/estilo_reporte_pdf/BalanceGeneral/EstiloPDF_Balance.css" media="all" />
	<link rel="shortcut icon" href="global/images/LogoEmpresa.ico"/>
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="{{$logo_empresa}}" height="10%" width="50%">
		</div>
		<h1>BALANCE GENERAL</h1>
		<div id="company" class="clearfix">
			<div>COMERCIO ID:<strong>{{$id_comercio}}</strong></div>
			<div>{{$nombre_empresa}}</div>
			<div>{{$direccion_empresa}}</div>
			<div>{{$telefono_empresa}}</div>
			<div><a href="mailto:{{$correo_empresa}}">{{$correo_empresa}}</a></div>
		</div>
		<div id="project">			
			<div><span>Fecha Inicial:</span> {{$Fecha_Inicial}}</div>
			<div><span>Fecha Final:</span> {{$Fecha_Final}}</div>
		</div>
	</header>

	<br>
	<br>	
	<table>
		<thead>
			<tr>
				<th class="service">DETALLE</th>
				<th class="desc">VALOR</th>
				<!-- <th>PRICE</th>
				<th>QTY</th>
				<th>TOTAL</th> -->
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Venta Producto</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalVentaProducto}}</strong></font></td>				
			</tr>		
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Venta Alimento</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalVentaAlimento}}</strong></font></td>
			</tr>	
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Venta Minutos</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalVentaMinutos}}</strong></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Venta Internet</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalVentaInternet}}</strong></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Venta Recargas</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalVentaRecarga}}</strong></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Compras</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalCompra}}</strong></font></td>	
			</tr>
			<tr>
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma"><strong>Total Gastos</strong></font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma">$ <strong>{{$TotalGasto}}</strong></font></td>	
			</tr>		
			<tr>
				<td class="final" style="text-align: left"><strong>TOTAL</strong></td>
				<td class="final" style="text-align: left"><font size ="3", color ="#008435" face="Tahoma"><strong>$ {{$TotalGanancia}}</strong></font></td>				
			</tr>
		</tbody>
	</table>
	<div id="notices">
		<br>		
	</div>
	<footer>
		Reporte Generado Automáticamente por MERCHANDISE CONTROL
	</footer>
</body>
</html>