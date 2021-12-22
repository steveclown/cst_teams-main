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
<script>
	function empty(){
		document.getElementById("region_id").value = "";
		document.getElementById("branch_id").value = "";
		document.getElementById("division_id").value = "";
		document.getElementById("department_id").value = "";
		document.getElementById("section_id").value = "";
		document.getElementById("location_id").value = "";
		document.getElementById("applicant_request_date").value = "";
		document.getElementById("applicant_request_due_date").value = "";
		document.getElementById("applicant_request_title").value = "";
		document.getElementById("applicant_request_remark").value = "";
	}
</script>
<?php 
	echo form_open('transactionalrequestemployee/arrayaddrequestemployee', array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$data		= $this->session->userdata('addrequestemployee');
	$header		= $this->session->userdata('addrequestemployee-'.$sesi['unique']);
	// print_r($header);exit;
	$requestemployee_item	= $this->session->userdata("dataitemaddrequestemployee-".$header['created_by']);
	// print_r($requestemployee_item);exit;
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Request Employee
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Request
				</div>
				<div class="actions">
					<a href="#search" class="btn default btn-sm" data-toggle="modal">
						<i class="fa fa-glass"></i> Filter Applicant
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Region</label>
						<div class="col-md-8">
							<?php 
							if(is_array($header)){
							?>
							<input type="text" name="region_name" value="<?php echo $this->transactionalrequestemployee_model->getregionname($header['region_id']);?>" class="form-control" readonly>
							<input type="hidden" name="region_id" value="<?php echo $header['region_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('region_id', $region, $header['region_id'], 'id ="region_id", class="form-control select2me"');
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
							<input type="text" name="branch_name" value="<?php echo $this->transactionalrequestemployee_model->getbranchname($header['branch_id']);?>" class="form-control" readonly>
							<input type="hidden" name="branch_id" value="<?php echo $header['branch_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('branch_id', $branch, $header['branch_id'], 'id ="branch_id", class="form-control select2me"');
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
							<input type="text" name="division_name" value="<?php echo $this->transactionalrequestemployee_model->getdivisionname($header['division_id']);?>" class="form-control" readonly>
							<input type="hidden" name="division_id" value="<?php echo $header['division_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('division_id', $division, $header['division_id'], 'id ="division_id", class="form-control select2me"');
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
							<input type="text" name="department_name" value="<?php echo $this->transactionalrequestemployee_model->getdepartmentname($header['department_id']);?>" class="form-control" readonly>
							<input type="hidden" name="department_id" value="<?php echo $header['department_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('department_id', $department, $header['department_id'], 'id ="department_id", class="form-control select2me"');
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
							<input type="text" name="section_name" value="<?php echo $this->transactionalrequestemployee_model->getsectionname($header['section_id']);?>" class="form-control" readonly>
							<input type="hidden" name="section_id" value="<?php echo $header['section_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('section_id', $section, $header['section_id'], 'id ="section_id", class="form-control select2me"');
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
							<input type="text" name="location_name" value="<?php echo $this->transactionalrequestemployee_model->getlocationname($header['location_id']);?>" class="form-control" readonly>
							<input type="hidden" name="location_id" value="<?php echo $header['location_id'];?>" readonly>
							<?php
							}else{
							echo form_dropdown('location_id', $location, $header['location_id'], 'id ="location_id", class="form-control select2me"');
							}
							?>
						</div>
					</div>


					<div class="form-actions right">
						<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
						<button type="submit" class="btn green"></i><i class="fa fa-plus"></i> Add</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php echo form_close(); ?>


