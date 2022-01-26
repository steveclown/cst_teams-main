<script>
	base_url = '<?= base_url()?>';	

	mappia = "	<?php 
					$site_url = 'incentiverealizationdistribution/addIncentiveRealizationDistribution/';
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiverealizationdistribution/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiverealizationdistribution/function_elements_add');?>",
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
				url : "<?php echo site_url('incentiverealizationdistribution/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();

            alert(branch_id);

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

	
</script>
<?php 
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
								<a href="<?php echo base_url();?>incentiverealizationdistribution">
									Incentive Realization Distribution List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>incentiverealizationdistribution/addIncentiveRealizationDistribution">
									Add Incentive Realization Distribution 
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Incentive Realization Distribution 
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
									<a href="<?php echo base_url();?>incentiverealizationdistribution" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('incentiverealizationdistribution/processAddIncentiveRealizationDistribution',array('id' => 'myform', 'class' => 'horizontal-form')); 

										$sesi 	= $this->session->userdata('unique');
										$data	= $this->session->userdata('addincentiverealizationdistribution-'.$sesi['unique']);

										/*print_r("data");
										print_r($data);*/

										if (empty($data)){
											$data['month_period']				= date("m");
											$data['year_period']				= date("Y");
										}

										if (empty($data['month_period'])){
											$data['month_period']				= date("m");
										}

										if (empty($data['year_period'])){
											$data['year_period']				= date("Y");
										}

										/*print_r("<BR>");
										print_r("data[month_period] ");
										print_r($data['month_period']);
										print_r("<BR>");
										print_r("data[year_period] ");
										print_r($data['year_period']);*/
										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
												// print_r($monthlist);
													echo form_dropdown('month_period', $monthlist,set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Month Name</label>
											</div>	
										</div>
										
										<div class = "col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Year</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('omzet_target_id', $incentiveomzettarget ,set_value('omzet_target_id',$data['omzet_target_id']),'id="omzet_target_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Omzet Target</label>
											</div>
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('branch_id', $corebranch ,set_value('branch_id',$data['branch_id']),'id="branch_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Branch Name</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['branch_id'])){
														$corelocation = create_double($this->incentiverealizationdistribution_model->getCoreLocation($data['branch_id']),'location_id','location_name');

														echo form_dropdown('location_id', $corelocation ,set_value('location_id',$data['location_id']),'id="location_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?> 
													<select name="location_id" id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose Item--</option>
													</select>
												<?php
													}
												?>
												<label class="control-label">Location Name<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="realization_distribution_branch_percentage" name="realization_distribution_branch_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_branch_percentage'];?>">
												<label class="control-label">Branch Percentage </label>
											</div>	
										</div>

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="realization_distribution_group_percentage" name="realization_distribution_group_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_group_percentage'];?>">
												<label class="control-label">Group Percentage </label>
											</div>	
										</div>

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="realization_distribution_individual_percentage" name="realization_distribution_individual_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_individual_percentage'];?>">
												<label class="control-label">Individual Percentage </label>
											</div>	
										</div>
									</div>
								
									<div class="tabbable-line boxless tabbable-reversed ">
										<ul class="nav nav-tabs">
											<?php
												if($data['active_tab']=="" || $data['active_tab']=="title"){
													$tabtitle = "<li class='active'><a href='#tabtitle' name='title' data-toggle='tab' onClick='function_state_add(this.name);'><b>Title</b></a></li>";
												}else{
													$tabtitle = "<li><a href='#tabtitle' data-toggle='tab' name='title' onClick='function_state_add(this.name);'><b>Title</b></a></li>";
												}

												if($data['active_tab']=="employee"){
													$tabemployee = "<li class='active'><a href='#tabemployee' name='employee' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee</b></a></li>";
												}else{
													$tabemployee = "<li><a href='#tabemployee' data-toggle='tab' name='employee' onClick='function_state_add(this.name)'><b>Employee</b></a></li>";
												}
												
												echo $tabtitle;
												echo $tabemployee;
											?>
										</ul>
										<div class="tab-content">
											<?php
												if($data['active_tab']=="" || $data['active_tab']=="title"){
													$stattitle = "active";
												}else{
													$stattitle = "";
												}

												if($data['active_tab']=="employee"){
													$statemployee = "active";
												}else{
													$statemployee = "";
												}
												
												echo"<div class='tab-pane ".$stattitle."' id='tabtitle'>";
													$this->load->view("incentiverealizationdistribution/addincentivetitledistribution_view");
												echo"</div>";

												echo"<div class='tab-pane ".$statemployee."' id='tabemployee'>";
													$this->load->view("incentiverealizationdistribution/addincentiveemployeeomzet_view");
												echo"</div>";
											?>
										</div>
									</div>

									<div class="row">
										<div class="form-actions right">
											<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>