<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filtereducation";
	}	
	
	function openform8(){
		var a = document.getElementById("education").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<?php
	$educationtype = array ('0' => 'Formal', '1' => 'Non Formal');

	$sesi = $this->session->userdata('filter-salaryhistory');
	if(!is_array($sesi)){
		$sesi['education_id']		='';
		$sesi['education_type']		='';
	}
?>
<?php echo form_open('main/filtereducation',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openform8()">Advanced Search</button>
<div class="form-body" style="display:none;" id='education'>
	<h3 class="form-section">Education</h3>			
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Education Name</label>
				<?php echo form_dropdown('education_id', $education,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me"');?>
			</div>
		</div>		
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Education Type</label>
				<?php echo form_dropdown('education_type', $educationtype, set_value('education_type',$data['education_type']),'id="education_type", class="form-control select2me"');?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>