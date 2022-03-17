<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='https://cdn.amcharts.com/lib/4/core.js'></script>
<script src='https://cdn.amcharts.com/lib/4/charts.js'></script>
<script src='https://cdn.amcharts.com/lib/4/themes/animated.js'></script>

<div style="position: relative;text-align: center;">
	<img style="width: 100%; min-height: 200px;" src="<?php echo base_url();?>aset/img/ds.jpg"/>
	<div class="col-md-5" style="position: absolute; top: 10px; right: 8px;">
		<div style="background-color: #f2f2f2">
			<p style="text-align: center; font-weight:bold; text-align: center; font-size: 12pt; font-family: century gothic"><strong>Grafik Penyerapan Dana Pekerjaan</strong></p>
	        <style>
	        #chartdiv {
	          width: 100%;
	          height: 350px;
	        }
	        </style>
	        <div id='chartdiv'></div>
		</div>		
	</div>
</div>

<!-- srcipt keuangan grafik pie -->
<script>
  $(function () {
  // am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create('chartdiv', am4charts.PieChart);
    chart.data = [
    <?php
    	$data = "SELECT new_pekerjaan_detail.proyek as proyek, budgeting.biaya_total, terminal.nama FROM `new_pekerjaan_detail` JOIN terminal ON new_pekerjaan_detail.fk_id_terminal = terminal.id JOIN budgeting ON budgeting.proyek = new_pekerjaan_detail.proyek";
        $query = $this->db->query($data);
        foreach ($query->result() as $data) {
            
    ?>
    	{
	      'kategori': '<?= $data->nama; ?>',
	      'persen': '<?= $data->biaya_total; ?>'
    	},

    <?php
        }
    ?>

    ];
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    // pieSeries.radius = am4core.percent(100);
    pieSeries.dataFields.value = 'persen';
    pieSeries.dataFields.category = 'kategori';
    pieSeries.slices.template.stroke = am4core.color('#fff');
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    
    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;
    
    pieSeries.labels.template.disabled = true;
    pieSeries.labels.template.fill = am4core.color("#fff");
    pieSeries.ticks.template.disabled = true;

    pieSeries.slices.template.propertyFields.fill = 'color';
    chart.legend = new am4charts.Legend();

  });
</script>
<!-- srcipt keuangan grafik pie -->