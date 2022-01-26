<script>
	function ulang(){
		document.getElementById("tax_id").value = "<?php echo $result['tax_id'] ?>";
		document.getElementById("tax_name").value = "<?php echo $result['tax_name'] ?>";
		document.getElementById("tax_code").value = "<?php echo $result['tax_code'] ?>";
	}
</script>

	<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Edit Tax 
		</h3>
		<ul class="page-breadcrumb breadcrumb">
		<li class="btn-group">
			<div class="actions">
				<a href="<?php echo base_url();?>tax" class="btn green yellow-stripe">
					<i class="fa fa-angle-left"></i>
					<span class="hidden-480">
						 Back
					</span>
				</a>
			</div>
		</li>
		<li>
			<i class="fa fa-home"></i>
			<a href="<?php echo base_url();?>">
				Master
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>tax">
				Tax List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">
				Edit Tax
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Form Edit
					</div>
				</div>
				<div class="portlet-body">
<?php 
	echo form_open('tax/processEditTax',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
		$taxtype = array(	
							0 => 'TK', 
							1 => 'K0',
							2 => 'K1',
							3 => 'K2',
							4 => 'K3',
						);
?>
					<div class="form-body">
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tax Period</label>
									
									<input type="text" autocomplete="off"  name="tax_period" id="tax_period" class="form-control" value="<?php echo $result['tax_period']?>" placeholder="Tax Period">
								</div>
							</div>
						
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tax Type</label>
								
									<input type="text" autocomplete="off"  name="tax_type" id="tax_type" class="form-control" value="<?php echo $result['tax_type']?>" placeholder="Tax Type">
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">Tax Non Taxable Income</label>
								
									<input type="text" autocomplete="off"  name="tax_non_taxable_income" id="tax_non_taxable_income" class="form-control" value="<?php echo $result['tax_non_taxable_income']?>" placeholder="Tax Non Taxable Income">
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
					</div>
	<input type="hidden" name="tax_id" value="<?php echo $result['tax_id']; ?>"/>
<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
