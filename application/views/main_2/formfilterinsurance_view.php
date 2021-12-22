<?php	
	$sesi = $this->session->userdata('filter-insurance');
	if(!is_array($sesi)){
		$sesi['insurance_id']	='';
		$sesi['insurance_premi_id']	= '';
		$sesi['start_period']		='';
		$sesi['end_period']			='';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterinsurance";
	}	
	
	function openform7(){
		var a = document.getElementById("insurance").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<?php echo form_open("main/filterinsurance", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openform7()">Advanced Search</button>
<div class="form-body" style="display:none;" id='insurance'>
	<h3 class="form-section">Insurance</h3>		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="<?php if (empty($sesi['start_period'])){
						echo date('Y-m');
					}else{
						echo $sesi['start_period'];
					}?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="<?php if (empty($sesi['end_period'])){
						echo date('Y-m');
					}else{
						echo $sesi['end_period'];
					}?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Insurance Name</label>
				<?php echo form_dropdown('insurance_id', $insurance ,set_value('insurance_id',$data['insurance_id']),'id="insurance_id", class="form-control select2me"');?>
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Insurance Premi Name</label>
				<?php echo form_dropdown('insurance_premi_id', $insurancepremi ,set_value('insurance_premi_id',$data['insurance_premi_id']),'id="insurance_premi_id", class="form-control select2me"');?>
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