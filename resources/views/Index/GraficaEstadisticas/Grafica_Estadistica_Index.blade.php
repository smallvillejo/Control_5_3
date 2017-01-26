

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
    //         data:[{{$TotalVentaProducto}}]},

    //         {name: 'Venta Alimentos',                
    //         data:[{{$TotalVentaAlimento}}]},

    //         {name: 'Venta Minutos',                
    //         data:[{{$TotalVentaMinutos}}]},

    //         {name: 'Venta Internet',
    //         data:[{{$TotalVentaInternet}}]},

    //         {name: 'Venta Recargas',
    //         data:[{{$TotalVentaRecarga}}]},

    //         {name: 'Compras',
    //         data:[{{$TotalCompra}}]},

    //         {name: 'Gastos & Inversión',
    //         data:[{{$TotalGasto}}]}]
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
                ['Venta Productos',     {{$TotalVentaProducto}}],
                ['Venta Alimentos',    {{$TotalVentaAlimento}}],
                ['Venta Minutos',      {{$TotalVentaMinutos}}],
                ['Venta Internet',     {{$TotalVentaInternet}}],
                ['Venta Recargas',     {{$TotalVentaRecarga}}],
                ['Compras',            {{$TotalCompra}}],
                ['Gastos & Inversión', {{$TotalGasto}}]
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