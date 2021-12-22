<script>
	// mappia = "<?php echo site_url('transactionalapplicantdata/add'); ?>";
		base_url = '<?php echo base_url();?>';
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
	
	function formaddarrayeducation(){
		var education_id 					= document.getElementById("education_id").value;
		var education_type	 				= document.getElementById("education_type").value;
		var applicant_education_name 		= document.getElementById("applicant_education_name").value;
		var applicant_education_city		= document.getElementById("applicant_education_city").value;
		var applicant_education_from_period	= document.getElementById("applicant_education_from_period").value;
		var applicant_education_to_period	= document.getElementById("applicant_education_to_period").value;
		var applicant_education_duration	= document.getElementById("applicant_education_duration").value;
		var applicant_education_passed		= document.getElementById("applicant_education_passed").value;
		var applicant_education_certificate	= document.getElementById("applicant_education_certificate").value;
		var applicant_education_remark		= document.getElementById("applicant_education_remark").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarrayeducation');?>",
			  data: {'education_id' : education_id, 'education_type' : education_type, 'applicant_education_name' : applicant_education_name, 'applicant_education_city':applicant_education_city,
			  'applicant_education_from_period' :applicant_education_from_period, 'applicant_education_to_period' : applicant_education_to_period, 'applicant_education_duration' : applicant_education_duration,
			  'applicant_education_passed' : applicant_education_passed, 'applicant_education_certificate' : applicant_education_certificate, 'applicant_education_remark' : applicant_education_remark, 'session_name' : "addarrayeducation-"},
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
	
	$type = array(
		'1'=> 'Formal Education',
		'0'	=> 'Non Formal Education',
	);
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Education</label>
			<?php
				echo form_dropdown('education_id', $education,set_value('education_id',$data['education_id']),'id="education_id" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Type</label>
			<?php
				echo form_dropdown('education_type', $type,set_value('education_type',$data['education_type']),'id="education_type" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" id="applicant_education_name" name="applicant_education_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_name'];?>" placeholder="Name">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>City</label>
			<input type="text" class="form-control" id="applicant_education_city" name="applicant_education_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_city'];?>" placeholder="City">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>From Period</label>
			<input type="text" class="form-control" id="applicant_education_from_period" name="applicant_education_from_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_from_period'];?>" placeholder="201501">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>To Period</label>
			<input type="text" class="form-control" id="applicant_education_to_period" name="applicant_education_to_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_to_period'];?>" placeholder="201512">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Duration</label>
			<input type="text" class="form-control" id="applicant_education_duration" name="applicant_education_duration" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_duration'];?>" placeholder="Duration">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Passed</label>
			<?php
				echo form_dropdown('applicant_education_passed', $status,set_value('applicant_education_passed',$data['applicant_education_passed']),'id="applicant_education_passed" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Certificate</label>
			<?php
				echo form_dropdown('applicant_education_certificate', $status,set_value('applicant_education_certificate',$data['applicant_education_certificate']),'id="applicant_education_certificate" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Remark</label>
			<textarea rows="3" name="applicant_education_remark" id="applicant_education_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_education_remark'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add" id="add" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayeducation();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$education	= $this->session->userdata('addarrayeducation-'.$sesi['unique']);
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
									<th style='text-align:center' width="10%">Education</th>
									<th style='text-align:center' width="10%">Type</th>
									<th style='text-align:center' width="10%">Name</th>
									<th style='text-align:center' width="10%">City</th>
									<th style='text-align:center' width="10%">From Period</th>
									<th style='text-align:center' width="10%">To Period</th>
									<th style='text-align:center' width="10%">Duration</th>
									<th style='text-align:center' width="10%">Passed</th>
									<th style='text-align:center' width="10%">Certificate</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($education)){
									foreach($education as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->transactionalapplicantdata_model->geteducationname($val['education_id'])."</td>
												<td>".$type[$val[education_type]]."</td>
												<td>".$val[applicant_education_name]."</td>
												<td>".$val[applicant_education_city]."</td>
												<td>".$val[applicant_education_from_period]."</td>
												<td>".$val[applicant_education_to_period]."</td>
												<td>".$val[applicant_education_duration]."</td>
												<td>".$status[$val[applicant_education_passed]]."</td>
												<td>".$status[$val[applicant_education_certificate]]."</td>
												<td>".$val[applicant_education_remark]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[education_id].'-'.$val[education_type].'-'.$val[applicant_education_name]
													.'-'.$val[applicant_education_city].'-'.$val[applicant_education_from_period].'-'.$val[applicant_education_to_period].'-'.$val[applicant_education_duration].'-'.$val[applicant_education_passed]
													.'-'.$val[applicant_education_certificate].'-'.$val[applicant_education_remark]; ?>","addarrayeducationapplicant-");'>
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
											<td colspan='12' style='text-align:center;'>
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
