<script>
	// mappia = "<?php echo site_url('item/add'); ?>";
	
	
	function deletesessionarrays(value,session_name){
//			alert(array_name);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('transactionalapplicantdata/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			}
		});
	}
	
	function formaddarrayworking(){
		var company_name 					= document.getElementById("company_name").value;
		var company_address 		= document.getElementById("company_address").value;
		var working_experience_job_title		= document.getElementById("working_experience_job_title").value;
		var working_experience_from_period	= document.getElementById("working_experience_from_period").value;
		var working_experience_to_period	= document.getElementById("working_experience_to_period").value;
		var working_experience_last_salary	= document.getElementById("working_experience_last_salary").value;
		var working_experience_resign_reason		= document.getElementById("working_experience_resign_reason").value;
		var working_experience_resign_letter	= document.getElementById("working_experience_resign_letter").value;
		var working_experience_remark		= document.getElementById("working_experience_remark").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarrayworking');?>",
			  data: {'company_name' : company_name, 'company_address' : company_address, 'working_experience_job_title' : working_experience_job_title, 'applicant_education_city':applicant_education_city,
			  'working_experience_from_period' :working_experience_from_period, 'working_experience_to_period' : working_experience_to_period, 'working_experience_resign_reason' : working_experience_resign_reason,
			  'working_experience_last_salary' : working_experience_last_salary, 'working_experience_resign_letter' : working_experience_resign_letter, 'working_experience_remark' : working_experience_remark, 'session_name' : "addarrayworking-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			 }
			});
	}
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
?>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="company_name" name="company_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['company_name'];?>">
			<label>Company Name sadsasdsadsadsa</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Address</label>
			<textarea rows="3" name="company_address" id="company_address" class="form-control" placeholder="Address"><?php echo $data['company_address'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Job Title</label>
			<input type="text" autocomplete="off"  class="form-control" id="working_experience_job_title" name="working_experience_job_title" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_experience_job_title'];?>" placeholder="Job Title">
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label>Last Salary</label>
			<input type="text" autocomplete="off"  class="form-control" id="working_experience_last_salary" name="working_experience_last_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_experience_last_salary'];?>" placeholder="Last Salary">
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>From Period</label>
			<input type="text" autocomplete="off"  class="form-control" id="working_experience_from_period" name="working_experience_from_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_experience_from_period'];?>" placeholder="From Period">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>To Period</label>
			<input type="text" autocomplete="off"  class="form-control" id="working_experience_to_period" name="working_experience_to_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_experience_to_period'];?>" placeholder="TO Period">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Resign Reason</label>
			<textarea rows="3" name="working_experience_resign_reason" id="working_experience_resign_reason" class="form-control" placeholder="Reason"><?php echo $data['working_experience_resign_reason'];?></textarea>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Resign Letter</label>
			<?php
				echo form_dropdown('working_experience_resign_letter', $status,set_value('working_experience_resign_letter',$data['working_experience_resign_letter']),'id="working_experience_resign_letter" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Remark</label>
			<textarea rows="3" name="working_experience_remark" id="working_experience_remark" class="form-control" placeholder="Remark"><?php echo $data['working_experience_remark'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add" id="add" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayworking();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$working	= $this->session->userdata('addarrayworking-'.$sesi['unique']);
?>

<!--div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Name</th>
									<th style='text-align:center' width="10%">Address</th>
									<th style='text-align:center' width="10%">Job Title</th>
									<th style='text-align:center' width="10%">From Period</th>
									<th style='text-align:center' width="10%">To Period</th>
									<th style='text-align:center' width="10%">Last Salary</th>
									<th style='text-align:center' width="10%">Resign Reason</th>
									<th style='text-align:center' width="10%">Resign Letter</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($working)){
									foreach($working as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['company_name']."</td>
												<td>".$val[company_address]."</td>
												<td>".$val[working_experience_job_title]."</td>
												<td>".$val[working_experience_from_period]."</td>
												<td>".$val[working_experience_to_period]."</td>
												<td>".$val[working_experience_last_salary]."</td>
												<td>".$val[working_experience_resign_reason]."</td>
												<td>".$status[$val[working_experience_resign_letter]]."</td>
												<td>".$val[working_experience_remark]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[company_name].'-'.$val[company_name].'-'.$val[company_address]
													.'-'.$val[working_experience_job_title].'-'.$val[working_experience_from_period].'-'.$val[working_experience_to_period].'-'.$val[working_experience_last_salary].'-'.$val[working_experience_resign_reason]
													.'-'.$val[working_experience_resign_letter].'-'.$val[working_experience_remark]; ?>","addarrayworking-");'>
															<i class='fa fa-trash-o'></i> Delete </button>
													<?php
												echo"
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='11' style='text-align:center;'>
												<b>No Data</b>
											</td>
										</tr>
									";
								}
							?>		
							<tbody>
						</table>
					</div>
				</div>
			</div>


<label></label>
