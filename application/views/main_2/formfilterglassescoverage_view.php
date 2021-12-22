<?php	
	$sesi = $this->session->userdata('filter-glassescoverage');
	if(!is_array($sesi)){
		$sesi['glasses_coverage_id']	='';
		$sesi['start_period']			='';
		$sesi['end_period']				= '';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterglassescoverage";
	}	
	
	function openformglasses(){
		var a = document.getElementById("glasses").style;
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
<?php echo form_open("main/filterglassescoverage", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openformglasses()">Advanced Search</button>
<div class="form-body" style="display:none;" id='glasses'>
	<h3 class="form-section">Glasses Coverage</h3>
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
				<label class="control-label">Glasses Coverage Name</label>
				<?php echo form_dropdown('glasses_coverage_id', $glassescoverage ,set_value('glasses_coverage_id',$sesi['glasses_coverage_id']),'id="glasses_coverage_id", class="form-control select2me"');?>
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