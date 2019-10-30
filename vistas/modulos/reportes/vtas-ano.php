<div class="box box-solid bg-black-gradient">
	
	<div class="box-header">
		
 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Gráfico de Ventas</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart" style="height: 250px;"></div>

  </div>

</div>

<script>

    var data = [
        { y: '2014', a: 50,  b: 90, c: 95},
        { y: '2015', a: 65,  b: 75, c: 85},
        { y: '2016', a: 50,  b: 50, c: 65},
        { y: '2017', a: 75,  b: 60, c: 75},
        { y: '2018', a: 80,  b: 65, c: 85},
        { y: '2019', a: 90,  b: 70, c: 75},
        { y: '2020', a: 100, b: 75, c: 85},
        { y: '2021', a: 115, b: 75, c: 65},
        { y: '2022', a: 120, b: 85, c: 75},
        { y: '2023', a: 145, b: 85, c: 95},
        { y: '2024', a: 160, b: 95, c: 75}
        ],
        config = {
        data: data,
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Total Income', 'Total Outcome', 'Prueba'],
        fillOpacity: 0.9,
        hideHover: 'auto',
        gridTextColor    : '#fff',
        behaveLikeLine: true,
        resize: true,
        pointFillColors:['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors:['gray','red', 'purple']
    };

    config.element = 'line-chart';
    Morris.Line(config);


</script>