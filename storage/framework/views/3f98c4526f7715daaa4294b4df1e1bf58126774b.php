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
			<img src="<?php echo e($logo_empresa); ?>" height="|0%" width="50%">
		</div>
		<h1>BALANCE GENERAL</h1>
		<div id="company" class="clearfix">
			<div>COMERCIO ID:<strong><?php echo e($id_comercio); ?></strong></div>
			<div><?php echo e($nombre_empresa); ?></div>
			<div><?php echo e($direccion_empresa); ?></div>
			<div><?php echo e($telefono_empresa); ?></div>
			<div><a href="mailto:<?php echo e($correo_empresa); ?>"><?php echo e($correo_empresa); ?></a></div>
		</div>
		<div id="project">			
			<div><span>Fecha Inicial:</span> <?php echo e($Fecha_Inicial); ?></div>
			<div><span>Fecha Final:</span> <?php echo e($Fecha_Final); ?></div>
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
				<td class="service"><font size ="3", color ="#0284ff" face="Tahoma">Total Venta Producto</font></td>
				<td class="desc"><font size ="3", color ="#000000" face="Tahoma"><?php echo e($TotalVentaProducto); ?></font></td>				
			</tr>		
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Venta Alimento</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalVentaAlimento); ?></font></td>
			</tr>	
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Venta Minutos</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalVentaMinutos); ?></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Venta Internet</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalVentaInternet); ?></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Venta Recargas</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalVentaRecarga); ?></font></td>
			</tr>
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Compras</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalCompra); ?></font></td>	
			</tr>
			<tr>
				<td class="service"><font size ="2", color ="#0284ff" face="Tahoma">Total Gastos</font></td>
				<td class="desc"><font size ="2", color ="#000000" face="Tahoma"><?php echo e($TotalGasto); ?></font></td>	
			</tr>		
			<tr>
				<td class="final" style="ALIGN=right">TOTAL</td>
				<td class="final" style="ALIGN=right"><?php echo e($TotalGanancia); ?></td>				
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