<style>
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

	echo form_open('transactionalselectionemployee/arrayaddselectionemployee', array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addselectionemployee-'.$sesi['unique']);
	// print_r($header);exit;
	$selectionemployee_item	= $this->session->userdata("dataitemaddselectionemployee-".$header['created_by']);
	// print_r($selectionemployee_item);exit;
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Add Selection Applicant
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Add Selection Applicant
				</div>
			</div>
			<div class="portlet-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Region</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="region_name" value="<?php echo $this->transactionalselectionemployee_model->getregionname($header['region_id']);?>" class="form-control" readonly>
							<input type="hidden" name="region_id" value="<?php echo $header['region_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('region_id', $region, $detail['region_id'], 'id ="region_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Branch</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="branch_name" value="<?php echo $this->transactionalselectionemployee_model->getbranchname($header['branch_id']);?>" class="form-control" readonly>
							<input type="hidden" name="branch_id" value="<?php echo $header['branch_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('branch_id', $branch, $detail['branch_id'], 'id ="branch_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Division</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="division_name" value="<?php echo $this->transactionalselectionemployee_model->getdivisionname($header['division_id']);?>" class="form-control" readonly>
							<input type="hidden" name="division_id" value="<?php echo $header['division_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('division_id', $division, $detail['division_id'], 'id ="division_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Department</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="department_name" value="<?php echo $this->transactionalselectionemployee_model->getdepartmentname($header['department_id']);?>" class="form-control" readonly>
							<input type="hidden" name="department_id" value="<?php echo $header['department_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('department_id', $department, $detail['department_id'], 'id ="department_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Section</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="section_name" value="<?php echo $this->transactionalselectionemployee_model->getsectionname($header['section_id']);?>" class="form-control" readonly>
							<input type="hidden" name="section_id" value="<?php echo $header['section_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('section_id', $section, $detail['section_id'], 'id ="section_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Location</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" autocomplete="off"  name="location_name" value="<?php echo $this->transactionalselectionemployee_model->getlocationname($header['location_id']);?>" class="form-control" readonly>
							<input type="hidden" name="location_id" value="<?php echo $header['location_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('location_id', $location, $detail['location_id'], 'id ="location_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Selection Date</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							echo"
								<input type='text' name='applicant_selection_date' value='".$header['applicant_selection_date']."' class='form-control' readonly>
								";
							}else{
								echo "<div class='input-group input-medium date date-picker' data-date='".date('Y-m-d')."' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
									<input type='text' name='applicant_selection_date' id='applicant_selection_date' class='form-control' value='".$header['applicant_selection_date']."' readonly>
									<span class='input-group-btn'>
										<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
									</span>
								</div>
								<span class='help-block'>
									 Select date
								</span>
								";
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Interview Date</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							echo"
								<input type='text' name='applicant_selection_interview_date' value='".$header['applicant_selection_interview_date']."' class='form-control' readonly>
								";
							}else{
								echo "<div class='input-group input-medium date date-picker' data-date='".date('Y-m-d')."' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
									<input type='text' name='applicant_selection_interview_date' id='applicant_selection_interview_date' class='form-control' value='".$header['applicant_selection_interview_date']."' readonly>
									<span class='input-group-btn'>
										<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
									</span>
								</div>
								<span class='help-block'>
									 Select date
								</span>
								";
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							echo"
								<textarea rows='5' name='applicant_selection_remark' id='applicant_selection_remark' class='form-control' placeholder='Remark' readonly>".$header['applicant_selection_remark']."</textarea>
								";
							}else{
								echo "<textarea rows='5' name='applicant_selection_remark' id='applicant_selection_remark' class='form-control' placeholder='Remark' ></textarea>
								";
							}
							?>
						</div>
					</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover table-full-width">
						<thead>
							<tr>
								<th>
									Applicant Name
								</th>
								<th>
									Request Status
								</th>
							</tr>
						</thead>   
						<tbody>
							<tr class='odd gradeX'>
								<td><?php echo form_dropdown('applicant_id', $item, $data['applicant_id'], 'id ="applicant_id", class="form-control select2me"');?></td>
								<td><?php echo form_dropdown('applicant_request_status', $request, $data['applicant_request_status'], 'id ="applicant_request_status", class="form-control select2me"');?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="form-actions right">
					<button type="submit" class="btn green"></i><i class="fa fa-plus"></i> Add</button>
					<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="applicant_request_id" value="<?php echo $detail[applicant_request_id];?>">
<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
<input type="hidden" name="created_by" value="<?php echo $auth[username];?>">
<?php echo form_close(); ?>
<?php $this->load->view('transactionalselectionemployee/listselectionemployee_view');?>