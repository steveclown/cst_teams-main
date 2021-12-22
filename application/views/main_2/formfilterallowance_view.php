<?php	
	$sesi = $this->session->userdata('filter-allowance');
	if(!is_array($sesi)){
		$sesi['allowance_id']	='';
		$sesi['start_period']		='';
		$sesi['end_period']			='';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterallowance";
	}	
	
	function openform5(){
		var a = document.getElementById("abc").style;
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
<?php echo form_open("main/filterallowance", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openform5()">Advanced Search</button>
<div class="form-body" style="display:none;" id='abc'>
	<h3 class="form-section">Allowance</h3>		
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
				<label class="control-label">Allowance Name</label>
				<?php echo form_dropdown('allowance_id', $allowance ,set_value('allowance_id',$data['allowance_id']),'id="allowance_id", class="form-control select2me"');?>
			</div>
		</div>
	</div>		
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

<?php echo form_close(); ?>
