<?php	
	$sesi = $this->session->userdata('filter-family');
	if(!is_array($sesi)){
		$sesi['family_status_id']		='';
		$sesi['employee_family_name']	='';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterfamily";
	}	
	
	function openformfamily(){
		var a = document.getElementById("family").style;
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
<?php echo form_open("main/filterfamily", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openformfamily()">Advanced Search</button>
<div class="form-body" style="display:none;" id='family'>
	<h3 class="form-section">Family Data</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Family Status</label>
				<?php echo form_dropdown('family_status_id', $status ,set_value('family_status_id',$sesi['family_status_id']),'id="family_status_id", class="form-control select2me"');?>
			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Family Name</label>
				<input type="text" name="employee_family_name" id="employee_family_name" value="<?php echo $sesi['employee_family_name']?>" class="form-control" placeholder="Company Name">
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
