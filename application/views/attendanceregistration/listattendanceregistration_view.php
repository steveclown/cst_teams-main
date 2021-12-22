<style>
	th{
		font-size: 14px  !important;
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
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
			Register Attendance for : <?php echo $this->attendanceregistration_model->getemployeename($this->session->userdata('employee_id'));?>
			</h3>
		</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
					<div class="actions">
						<a data-toggle="modal" href="#listfilter" class="btn default btn-sm">
							<i class="fa fa-glass icon-black"></i> Filter
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
					<thead>
					<tr>
						<th>
							Machine Name
						</th>
						<th>
							ID
						</th>
						<th>
							Name
						</th>						
						<th>
							Assigned To
						</th>
						<th width="120px">
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						// print_r($attendanceregistration);exit;
						foreach ($attendanceregistration as $key=>$val){
							
							if($val[employee_id]=="" or $val[employee_id]=="0"){
								echo"
									<tr>									
										<td>".$this->attendanceregistration_model->getmachinename($val[machine_id])."</td>
										<td>$val[id]</td>
										<td>$val[name]</td>
										<td>".$this->attendanceregistration_model->getemployeename($val[employee_id])."</td>
										<td>
											<a href='".$this->config->item('base_url').'attendanceregistration/assign/'.$val[attendance_employee_id]."' class='btn default btn-xs blue'>
												<i class='fa fa-check'></i> Assign to currently selected employee
											</a>
										</td>
									</tr>
								";
							}else{
								echo"
									<tr>									
										<td>".$this->attendanceregistration_model->getmachinename($val[machine_id])."</td>
										<td>$val[id]</td>
										<td>$val[name]</td>
										<td>".$this->attendanceregistration_model->getemployeename($val[employee_id])."</td>
										<td>
											<a href='".$this->config->item('base_url').'attendanceregistration/assign/'.$val[attendance_employee_id]."' class='btn default btn-xs default'>
												<i class='fa fa-check'></i> Reassign to currently selected employee
											</a>
											<a href='".$this->config->item('base_url').'attendanceregistration/remove/'.$val[attendance_employee_id]."' class='btn default btn-xs red'>
												<i class='fa fa-times'></i> Remove
											</a>
										</td>
									</tr>
								";
							}
					} ?>
					</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>

<?php
	echo form_open('attendanceregistration/filter',array('id' => 'myform', 'class' => 'horizontal-form'));
	$sesi=$this->session->userdata('filter-attendanceregistration');
	if(!is_array($sesi)){
		$sesi['machine_id'] ='';
		$sesi['attendance_status'] ='';
	}
?>
<div class="modal fade bs-modal-lg" id="listfilter" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Filter List</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12"> 	
						<label class="control-label">Machine Name</label>
						<?php echo form_dropdown('machine_id', $machine, $sesi['machine_id'], 'id ="machine_id", class="form-control select2me"');?>
					</div>
				</div>
				<div class="row">
					<label class="control-label"></label>
				</div>
				<div class="row">
					<div class="col-md-12"> 	
						<label class="control-label">Attendance Status</label>
						<div class="radio-list">
							<label class="radio-inline">
							<input type="radio" name="attendance_status" id="optionsRadios4" value="" <?php if($sesi[attendance_status]==''){echo 'checked';}?>> All </label>
							<label class="radio-inline">
							<input type="radio" name="attendance_status" id="optionsRadios5" value="assigned" <?php if($sesi[attendance_status]=='assigned'){echo 'checked';}?>> Assigned </label>
							<label class="radio-inline">
							<input type="radio" name="attendance_status" id="optionsRadios6" value="unassigned" <?php if($sesi[attendance_status]=='unassigned'){echo 'checked';}?>> Unassigned </label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="attendanceregistration/resetfilter" class="btn red">
						<i class="fa fa-times"></i> Reset
					</a>
					<button type="submit" class="btn blue"><i class="fa fa-search"></i> Filter</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
echo form_close(); 
?>