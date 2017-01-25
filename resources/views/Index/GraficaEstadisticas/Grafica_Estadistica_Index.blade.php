

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
            data:[{{$TotalVentaProducto}}]},

            {name: 'Venta Alimentos',                
            data:[{{$TotalVentaAlimento}}]},

            {name: 'Venta Minutos',                
            data:[{{$TotalVentaMinutos}}]},

            {name: 'Venta Internet',
            data:[{{$TotalVentaInternet}}]},

            {name: 'Venta Recargas',
            data:[{{$TotalVentaRecarga}}]},

            {name: 'Compras',
            data:[{{$TotalCompra}}]},

            {name: 'Gastos & Inversión',
            data:[{{$TotalGasto}}]}]
        });
    });  
</script>