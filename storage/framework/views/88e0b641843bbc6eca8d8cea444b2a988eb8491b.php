

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


<script type="text/javascript">
    $(function () {
        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Reporte Gancia'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: []
            },
            yAxis: {
                title: {
                    text: 'Miles ($)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    enableMouseTracking: true
                }
            },


            series: [

            {name: 'Venta Productos',                
            data:[<?php echo e($TotalVentaProducto); ?>]},

            {name: 'Venta Alimentos',                
            data:[<?php echo e($TotalVentaAlimento); ?>]},

            {name: 'Venta Minutos',                
            data:[<?php echo e($TotalVentaMinutos); ?>]},

            {name: 'Venta Internet',
            data:[<?php echo e($TotalVentaInternet); ?>]},

            {name: 'Venta Recargas',
            data:[<?php echo e($TotalVentaRecarga); ?>]},

            {name: 'Compras',
            data:[<?php echo e($TotalCompra); ?>]},

            {name: 'Gastos & Inversión',
            data:[<?php echo e($TotalGasto); ?>]}]
        });
    });  
</script>