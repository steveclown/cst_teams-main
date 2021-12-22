<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
<?php
$data=$this->session->userdata('filter-scheduleshiftassignment');
if(!is_array($data)){
		$data['shift_assignment_start_date'] 	= '';
		$data['shift_assignment_end_date']		= '';
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
	Shift Assignment List <small>Manage Shift Assignment</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php echo form_open('scheduleemployeeschedule/filter_scheduleshiftassignment',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date">
								<label for="form_control">Start Date</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_end_date" id="shift_assignment_end_date" >
								<label for="form_control">End Date</label>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<div class="form-action" style="text-align: right !important;">
							<button type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_all();"><i class="fa fa-times"></i>Reset</button>
							<button type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data"><i class="fa fa-search"></i>Find</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>scheduleemployeeschedule/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Shift Pattern Name</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach ($scheduleshiftassignment as $key=>$val){
								echo"
									<tr>	
										<td>".$no."</td>
										<td>$val[shift_pattern_name]</td>							
										<td>$val[shift_assignment_start_date]</td>
										<td>$val[shift_assignment_end_date]</td>
										<td>
											<a href='".$this->config->item('base_url').'scheduleemployeeschedule/addScheduleEmployeeSchedule/'.$val[shift_assignment_id]."' class='btn default btn-xs blue'>
												<i class='fa fa-plus'></i> Add
											</a>
										</td>
									</tr>
								";
								$no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>