<script src="<?php echo base_url();?>js/drilldown/highstock.js"></script>
<script src="<?php echo base_url();?>js/drilldown/drilldown.src.js"></script>
<style>
	.dr {
		height: 5px;
		margin: 7px 0px !important;
	}
	
	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 12px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	
	@media (max-width: 2000px) {
  .table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: scroll;
    overflow-y: scroll;
    border: 1px solid #dddddd;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    -webkit-overflow-scrolling: touch;
  }
  .table-responsive > .table {
    margin-bottom: 0;
  }
  .table-responsive > .table > thead > tr > th,
  .table-responsive > .table > tbody > tr > th,
  .table-responsive > .table > tfoot > tr > th,
  .table-responsive > .table > thead > tr > td,
  .table-responsive > .table > tbody > tr > td,
  .table-responsive > .table > tfoot > tr > td {
    white-space: nowrap;
  }
  .table-responsive > .table-bordered {
    border: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:first-child,
  .table-responsive > .table-bordered > tbody > tr > th:first-child,
  .table-responsive > .table-bordered > tfoot > tr > th:first-child,
  .table-responsive > .table-bordered > thead > tr > td:first-child,
  .table-responsive > .table-bordered > tbody > tr > td:first-child,
  .table-responsive > .table-bordered > tfoot > tr > td:first-child {
    border-left: 0;
  }
  .table-responsive > .table-bordered > thead > tr > th:last-child,
  .table-responsive > .table-bordered > tbody > tr > th:last-child,
  .table-responsive > .table-bordered > tfoot > tr > th:last-child,
  .table-responsive > .table-bordered > thead > tr > td:last-child,
  .table-responsive > .table-bordered > tbody > tr > td:last-child,
  .table-responsive > .table-bordered > tfoot > tr > td:last-child {
    border-right: 0;
  }
  .table-responsive > .table-bordered > tbody > tr:last-child > th,
  .table-responsive > .table-bordered > tfoot > tr:last-child > th,
  .table-responsive > .table-bordered > tbody > tr:last-child > td,
  .table-responsive > .table-bordered > tfoot > tr:last-child > td {
    border-bottom: 0;
  }
}

	@media (max-width: 2000px) {
  .table-responsive2 {
    width: 100%;
    margin-bottom: 15px;
    overflow-x: none;
    overflow-y: none;
    border: 1px solid #dddddd;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    -webkit-overflow-scrolling: touch;
  }
}
</style>

<?php 
	/* print_r("IQ Per Participant Drill Down ");
	print_r($iqperparticipant);
	print_r("<BR>");
	
	print_r("IQ Classification Drill Down ");
	print_r($iqclassification);
	print_r("<BR>"); */
?>

<div class="row">
	<!--<div class="col-md-12 ">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Sales Report per District
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="table-responsive ">
						<table width="100%">
							<tr>
								<td width="35%">
									<div id="container1" style="height: 350px"></div>
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>
	</div>-->

	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>IQ Per Participant
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="table-responsive ">
						<table width="100%">
							<tr>
								<td width="20%">
									<div id="container2" style="height: 350px;">
									</div>
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
	
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>IQ Classification
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="table-responsive ">
						<table width="100%">
							<tr>
								<td width="20%">
									<div id="container1" style="height: 350px;">
									</div>
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>

	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Intellectual
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="table-responsive ">
						<table width="100%">
							<tr>
								<td width="20%">
									<div id="container3" style="height: 350px;">
									</div>
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>

<!--<div class="row">
	<div class="col-md-6 col-sm-6">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>Account Receivable per District
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="table-responsive ">
						<table width="100%">
							<tr>
								<td width="35%">
									<div id="container3" style="height: 350px"></div>
								</td>
							</tr>
						</table>
					</div>
	
				</div>
			</div>
		</div>	
	</div>
</div>-->

<script>
	
	function convertToCurrency(angka){
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+',';
		return rupiah.split('',rupiah.length-1).reverse().join('');
	}

	// Internationalization
	Highcharts.setOptions({
		lang: {
			drillUpText: '◁ Back {series.name}'
		}
	});

	var options1 = {

		chart: {
			height: 300
		},
		
		title: {
			text: 'Total Participant Per IQ Classification'
		},

		xAxis: {
			categories: true
		},
		
		legend: {
			enabled: false
		},
		
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true
				},
				shadow: false
			},
			pie: {
				size: '80%'
			}
		},
		
		series: [{
			name		: 'IQ',
			colorByPoint: true,
			data		: <?php echo $iqclassification; ?>
		}]
	};
	
	var options2 = {

		chart: {
			height: 300
		},
		
		title: {
			text: 'IQ Per Participant'
		},

		xAxis: {
			categories: true
		},
		
		legend: {
			enabled: false
		},
		
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true
				},
				shadow: false
			},
			pie: {
				size: '80%'
			}
		},
		
		series: [{
			name		: 'IQ',
			colorByPoint: true,
			data		: <?php echo $iqperparticipant; ?>
		}]
	};
	
	var options3 = {

		chart: {
			height: 300
		},
		
		title: {
			text: 'Intellectual'
		},

		xAxis: {
			categories: true
		},
		
		legend: {
			enabled: false
		},
		
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true
				},
				shadow: false
			},
			pie: {
				size: '80%'
			}
		},
		
		series: [{
			name		: 'Intellectual',
			colorByPoint: true,
			data		: <?php echo $participantintellectual; ?>
		}]
	};
	/* var options3 = {

		chart: {
			height: 300
		},
		
		title: {
			text: 'Account Receivable'
		},

		xAxis: {
			categories: true
		},
		
		legend: {
			enabled: false
		},
		
		plotOptions: {
			series: {
				dataLabels: {
					enabled: true
				},
				shadow: false
			},
			pie: {
				size: '80%'
			}
		},
		
		series: [{
			name		: 'Total Amount',
			colorByPoint: true,
			data		: <?php echo $arperdistrict; ?>
		}]
	}; */
	
	// Column chart
	options1.chart.renderTo 	= 'container1';
	options1.chart.type 		= 'column';
	var chart1					= new Highcharts.Chart(options1);
	
	options2.chart.renderTo 	= 'container2';
	options2.chart.type 		= 'column';
	var chart2					= new Highcharts.Chart(options2);
	
	options3.chart.renderTo 	= 'container3';
	options3.chart.type 		= 'column';
	var chart3					= new Highcharts.Chart(options3);
	 
</script>
