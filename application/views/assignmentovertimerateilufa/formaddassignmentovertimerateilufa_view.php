<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"assignmentovertimerateilufa/reset_add";
	}
	

	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentovertimerateilufa/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentovertimerateilufa/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function reset_data(){
		document.location = "<?php echo base_url();?>assignmentovertimerateilufa/reset_data";
	}
</script>

<?php 
	$unique 	= $this->session->userdata('unique');
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	if($this->uri->segment(3)!=''){
		$uri = $this->uri->segment(3);
	}else{
		$uri = '';
	}
	$data 	= $this->session->userdata('addassignmentovertimerateilufa-'.$unique['unique']);	

	if (empty($data)){
		$data['overtime_rate_effective_date'] = date("Y-m-d");
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
							<a href="<?php echo base_url();?>assignmentovertimerateilufa">
								Overtime Rate List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>assignmentovertimerateilufa/addAssignmentOvertimeRate">
								Add Overtime Rate
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Add Overtime Rate
				</h1>
				<!-- END PAGE TITLE & BREADCRUMB-->
				
			<?php 
				echo $this->session->userdata('message');
				$this->session->unset_userdata('message');
			?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>assignmentovertimerateilufa" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('assignmentovertimerateilufa/processAddAssignmentOvertimeRate',array('id' => 'myform', 'class' => 'horizontal-form')); 

									?>
									<div class="row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('job_title_id', $corejobtitle, $data['job_title_id'], 'id ="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value)"');
												?>

												<label class="control-label">Job Title Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="overtime_rate_effective_date" id="overtime_rate_effective_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['overtime_rate_effective_date']);?>"/>
												<label class="control-label">Effective Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="overtime_rate_amount" id="overtime_rate_amount" value="<?php echo $data['overtime_rate_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Overtime Rate Amount (Day)<span class="required">*</span></label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="overtime_rate_trip_amount" id="overtime_rate_trip_amount" value="<?php echo $data['overtime_rate_trip_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Overtime Rate Amount<span class="required">*</span></label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="overtime_rate_description" id="overtime_rate_description" value="<?php echo $data['overtime_rate_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Overtime Rate Description<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<input name="created_on" id="created_on" type="hidden" value="<?php if (empty($data['created_on'])){echo date('Ymdhis');}else{echo $data['created_on'];}?>" />

									<div class="form-actions right">
										<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Reset</button>
										<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
