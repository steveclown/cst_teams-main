<?php	
	$sesi = $this->session->userdata('filter-language');
	if(!is_array($sesi)){
		$sesi['language_id']				='';
	}
?>
<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filterlanguage";
	}	
	
	function openformlanguage(){
		var a = document.getElementById("form-language").style;
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
<?php echo form_open("main/filterlanguage", array('class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openformlanguage()">Advanced Search</button>
<div class="form-body" style="display:none;" id='form-language'>
	<h3 class="form-section">Language</h3>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Language Name</label>
				<?php echo form_dropdown('language_id', $language ,set_value('language_id',$sesi['language_id']),'id="language_id", class="form-control select2me"');?>
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