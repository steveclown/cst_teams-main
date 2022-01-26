<script>
    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrolldailyperiod/function_elements_add');?>",
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
				url : "<?php echo site_url('payrolldailyperiod/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
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
								<a href="<?php echo base_url();?>payrolldailyperiod/addPayrollDailyPeriod">
									Add Daily Period
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Daily Period
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>payrolldailyperiod" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('payrolldailyperiod/processAddPayrollDailyPeriod',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addpayrolldailyperiod');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="daily_period_start_date" id="daily_period_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['daily_period_start_date']);?>">
												<label class="control-label">Daily Period Start Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="daily_period_end_date" id="daily_period_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['daily_period_end_date']);?>">
												<label class="control-label">Daily Period End Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="daily_period_working_days" id="daily_period_working_days" value="<?php echo $data['daily_period_working_days']?>" class="form-control"  onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Working Days
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('daily_period_include_bpjs', $includebpjs ,set_value('daily_period_include_bpjs',$data['daily_period_include_bpjs']),'id="daily_period_include_bpjs", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Include BPJS 
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>