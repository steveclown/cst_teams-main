<script>
	function ulang(){
		document.getElementById("tax_id").value = "";
		document.getElementById("tax_name").value = "";
		document.getElementById("tax_code").value = "";
	}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Tax 
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
							Add Tax
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
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
								<?php 
									echo form_open('tax/processAddTax',array('id' => 'myform', 'class' => 'horizontal-form')); 
									echo $this->session->userdata('message');
									$this->session->unset_userdata('message');
									$data = $this->session->userdata('AddTax');
									
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
											
												<input type="text" name="tax_period" id="tax_period" class="form-control" value="<?php echo $data['tax_period']?>" placeholder="Tax Period">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tax Type
												<span class="required">
												*
												</span></label>
											
												<?php echo form_dropdown('tax_type', $taxtype, $data['tax_type'], 'id ="tax_type", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tax Non Taxable Income</label>
											
												<input type="text" name="tax_non_taxable_income" id="tax_non_taxable_income" class="form-control" value="<?php echo $data['tax_non_taxable_income']?>" placeholder="Tax Non Taxable Income">
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>