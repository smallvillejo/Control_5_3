

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
            series: [{
                name: 'Venta Minutos',
                      
                data:[ "<?php foreach($TotalVentaMinutos as $value): ?><?php echo e($value->total_minutos_venta); ?><?php endforeach; ?>"
                
                ]
            // }, 
            // {
            //     name: 'Venta Internet',
            //     data: [6.2, 6.9, 2.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            // },
            // {
            //     name: 'Venta Recargas',
            //     data: [10.2, 7.9, 3.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            // },
            // {
            //     name: 'Compras',
            //     data: [15.2, 8.9, 4.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            // },
            // {
            //     name: 'Gastos & Inversión',
            //     data: [19.9, 9.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3]
            }]
        });
    });  
</script>