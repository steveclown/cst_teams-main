<?php	
	$sesi = $this->session->userdata('filter-expertise');
	if(!is_array($sesi)){
		$sesi['expertise_id']				='';
		$sesi['employee_expertise_name']	= '';
		$sesi['start_period']				='';
		$sesi['end_period']					='';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterexpertise";
	}	
	
	function openformexpertise(){
		var a = document.getElementById("form-expertise").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<?php echo form_open("main/filterexpertise", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openformexpertise()">Advanced Search</button>
<div class="form-body" style="display:none;" id='form-expertise'>
	<h3 class="form-section">Expertise</h3>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Expertise Name</label>
				<?php echo form_dropdown('expertise_id', $expertise ,set_value('expertise_id',$sesi['expertise_id']),'id="expertise_id", class="form-control select2me"');?>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Employee Expertise Name</label>
				<input type="text" name="employee_expertise_name" id="employee_expertise_name" value="<?php echo $sesi['employee_expertise_name']?>" class="form-control" placeholder="Employee Expertise Name">
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