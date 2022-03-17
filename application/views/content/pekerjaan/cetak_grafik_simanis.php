<html>

<head>
	<title>Line Chart</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<canvas id="myChart"></canvas>
</body>

<script>
	var datarencana = [];
	var datarealisasi = [];
	var dataminggu = [];

	$.each(<?= json_encode($datarencanaa) ?>, function(test, item){
	    if (item.persentase_total_acuan_komulatif == 0) {
		  	item.persentase_total_acuan_komulatif = null;
		}
	    datarencana.push(item.persentase_total_acuan_komulatif);
	})
	$.each(<?= json_encode($datarealisasia) ?>, function(test, item){
		if (item.persentase_total == 0) {
		  	item.persentase_total = null;
		}
	    datarealisasi.push(item.persentase_total);
	})

	$.each(<?= json_encode($dataminggua) ?>, function(test, item){
	    dataminggu.push(item.minggu);
	})

	var ctx = document.getElementById('myChart').getContext('2d');

	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels: dataminggu,
	        datasets: [{
	            label: 'Realisasi',
	            data: datarealisasi,
	            backgroundColor: ['rgba(255, 99, 132, 0.2)'],
	            borderColor: ['rgba(255, 99, 132, 1)'],
	            borderWidth: 1
	        },{
				label: 'Rencana',
	            data: datarencana,
				backgroundColor: ['rgba(54, 162, 235, 1)'],
	            borderColor: ['rgba(75, 192, 192, 1)'],
	            borderWidth: 1
				}
	        ]
	    },
	    options: {
			responsive: true,
			title: {
				display: true,
				text: 'Grafik Jadwal Rencana dan Realisasi'
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Minggu'
					}
				}],
	            
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Bobot'
					}
				}]
			}
		}
	});
</script>

</html>
