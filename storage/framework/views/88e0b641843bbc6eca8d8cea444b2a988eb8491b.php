

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


<script type="text/javascript">
    // $(function () {
    //     Highcharts.chart('container', {
    //         chart: {
    //             type: 'line'
    //         },
    //         title: {
    //             text: 'Reporte Gancia'
    //         },
    //         subtitle: {
    //             text: ''
    //         },
    //         xAxis: {
    //             categories: []
    //         },
    //         yAxis: {
    //             title: {
    //                 text: 'Miles ($)'
    //             }
    //         },
    //         plotOptions: {
    //             line: {
    //                 dataLabels: {
    //                     enabled: false
    //                 },
    //                 enableMouseTracking: true
    //             }
    //         },


    //         series: [

    //         {name: 'Venta Productos',                
    //         data:[<?php echo e($TotalVentaProducto); ?>]},

    //         {name: 'Venta Alimentos',                
    //         data:[<?php echo e($TotalVentaAlimento); ?>]},

    //         {name: 'Venta Minutos',                
    //         data:[<?php echo e($TotalVentaMinutos); ?>]},

    //         {name: 'Venta Internet',
    //         data:[<?php echo e($TotalVentaInternet); ?>]},

    //         {name: 'Venta Recargas',
    //         data:[<?php echo e($TotalVentaRecarga); ?>]},

    //         {name: 'Compras',
    //         data:[<?php echo e($TotalCompra); ?>]},

    //         {name: 'Gastos & Inversión',
    //         data:[<?php echo e($TotalGasto); ?>]}]
    //     });
    // });  

    $(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Reportes Venta'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Miles ($)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: '<b>{point.y:.1f} Mil</b>'
        },
        series: [{
            name: 'Population',
            data: [
                ['Venta Productos',     <?php echo e($TotalVentaProducto); ?>],
                ['Venta Alimentos',    <?php echo e($TotalVentaAlimento); ?>],
                ['Venta Minutos',      <?php echo e($TotalVentaMinutos); ?>],
                ['Venta Internet',     <?php echo e($TotalVentaInternet); ?>],
                ['Venta Recargas',     <?php echo e($TotalVentaRecarga); ?>],
                ['Compras',            <?php echo e($TotalCompra); ?>],
                ['Gastos & Inversión', <?php echo e($TotalGasto); ?>]
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>