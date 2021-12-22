<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');

$data=$this->session->userdata('filter-scheduleemployeeschedule');
if(!is_array($data)){
		$data['employee_schedule_date_start'] 	= '';
		$data['employee_schedule_date_end']		= '';
	}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Employee Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Last Employee Schedule List <small>Manage Last Employee Schedule</small>
</h1>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered table-advance table-hover">
					<thead>
						<tr>
							<th>No</th>
							<th>Employee Shift Code</th>
							<th>Location Name</th>
							<th>Division Name</th>
							<th>Last Schedule</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach ($scheduleemployeeschedule as $key => $val){
								$today 	= date("Y-m-d");
                            	$date 	= date_create($today);
								date_add($date, date_interval_create_from_date_string("7 days"));
								$start_from	= date_format($date, "Y-m-d");

								if ($val['employee_shift_last_schedule_date'] <= $start_from){
									echo"
										<tr>
											<td style='color: red;'>".$no."</td>
											<td style='color: red;'>".$val['employee_shift_code']."</td>
											<td style='color: red;'>".$val['location_name']."</td>
											<td style='color: red;'>".$val['division_name']."</td>
											<td style='color: red;'>".tgltoview($val['employee_shift_last_schedule_date'])."</td>
										</tr>
									";

								} else {
									echo"
										<tr>	
											<td>".$no."</td>
											<td>".$val['employee_shift_code']."</td>
											<td>".$val['location_name']."</td>
											<td>".$val['division_name']."</td>
											<td>".tgltoview($val['employee_shift_last_schedule_date'])."</td>
										</tr>
									";
	
								}
								$no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>