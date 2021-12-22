<script>
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
		   url  : "<?php echo base_url(); ?>hroemployeemedicalcoverage/getcoverageamount",
		   data: {'medical_coverage_id' : value},
		   success: function(msg){
				// alert(msg);
				document.getElementById("medical_coverage_amount_view").value = toRp(msg);
				document.getElementById("medical_coverage_amount").value = msg;
		   }
		});	
	}

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeemedicalcoverage/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeemedicalcoverage/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeemedicalcoverage/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
					
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeemedicalcoverage">
									Medical Coverage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeemedicalcoverage/addHROEmployeeMedicalCoverage/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Medical Coverage
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Medical Coverage - <?php echo $hroemployeedata['employee_name']?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->hroemployeemedicalcoverage_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->hroemployeemedicalcoverage_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->hroemployeemedicalcoverage_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>hroemployeemedicalcoverage" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeemedicalcoverage/processAddHROEmployeeMedicalCoverage',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHroEmployeeMedicalCoverage');
										$employee_id =  $this->session->userdata('employee_id');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('medical_coverage_id', $coremedicalcoverage, $data['medical_coverage_id'], 'id ="medical_coverage_id" class="form-control select2me" onChange="getcoverageamount(this.value)"');?>

												<label class="control-label">Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="medical_coverage_amount_view" id="medical_coverage_amount_view" value="<?php echo $data['medical_coverage_amount_view'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<input type="hidden" name="medical_coverage_amount" id="medical_coverage_amount" value="<?php echo $data['medical_coverage_amount'];?>" class="form-control" readonly>
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Amount</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="medical_coverage_remark" id="medical_coverage_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['medical_coverage_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
											
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
