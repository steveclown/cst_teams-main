<script>
function ulang(){
	document.getElementById("employee_id").value = "";
	document.getElementById("glasses_coverage_id").value = "";
	document.getElementById("glasses_coverage_period").value = "";
	document.getElementById("glasses_coverage_amount").value = "";
	document.getElementById("glasses_coverage_claimed").value = "";
	document.getElementById("glasses_coverage_last_balance").value = "";
	document.getElementById("glasses_coverage_remark").value = "";
}

function toRp(number) {
	var number = number.toString(), 
	rupiah = number.split('.')[0], 
	cents = (number.split('.')[1] || '') +'00';
	rupiah = rupiah.split('').reverse().join('')
		.replace(/(\d{3}(?!$))/g, '$1,')
		.split('').reverse().join('');
	return rupiah + '.' + cents.slice(0, 2);
}

function getcoverageamount(value) {
	// alert(value);
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>hroemployeeglassescoverage/getcoverageamount",
	   data: {'glasses_coverage_id' : value},
	   success: function(msg){
			// alert(msg);
			document.getElementById("glasses_coverage_amount_view").value = toRp(msg);
			document.getElementById("glasses_coverage_amount").value = msg;
	   }
	});	
}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Employee Glasses Coverage
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeglassescoverage" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeglassescoverage">
							Glasses Coverage List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Employee Glasses Coverage
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
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeglassescoverage/processAddHroEmployeeGlassesCoverage',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$data = $this->session->userdata('AddHroEmployeeGlassesCoverage');
										$employee_id =  $this->session->userdata('employee_id');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('glasses_coverage_id', $glassescoverage, $data['glasses_coverage_id'], 'id ="glasses_coverage_id" class="form-control select2me" onChange="getcoverageamount(this.value)"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeglassescoverage_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Period</label>
											<div class="col-md-8">
												<input type="text" name="glasses_coverage_period" id="glasses_coverage_period" value="<?php echo date("Y");?>" class="form-control" placeholder="Period">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount</label>
											<div class="col-md-8">
												<input type="text" name="glasses_coverage_amount_view" id="glasses_coverage_amount_view" value="<?php echo $data['glasses_coverage_amount_view'];?>" class="form-control" placeholder="Coverage Amount" readonly>
												<input type="hidden" name="glasses_coverage_amount" id="glasses_coverage_amount" value="<?php echo $data['glasses_coverage_amount'];?>" class="form-control" placeholder="Coverage Amount" readonly>
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="glasses_coverage_remark" id="glasses_coverage_remark" class="form-control" placeholder="Remark"><?php echo $data['glasses_coverage_remark'];?></textarea>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
