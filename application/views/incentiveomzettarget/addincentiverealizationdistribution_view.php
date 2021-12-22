<script>
	base_url = '<?= base_url()?>';	

	$(document).ready(function(){
        $("#branch_id_realization").change(function(){
            var branch_id = $("#branch_id_realization").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id_realization").html(data);
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

					
									<?php 

										$sesi 	= $this->session->userdata('unique');
										$data	= $this->session->userdata('addincentiveomzettarget-'.$sesi['unique']);

										print_r("data");
										print_r($data);

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
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('branch_id_realization', $corebranch ,set_value('branch_id',$data['branch_id_realization']),'id="branch_id_realization", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Branch Name</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['location_id'])){
														$corelocation = create_double($this->incentiverealizationdistribution_model->getCoreLocation($data['branch_id_realization']),'location_id','location_name');

														echo form_dropdown('location_id_realization', $corelocation ,set_value('location_id',$data['location_id_realization']),'id="location_id_realization", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?> 
													<select name="location_id_realization" id="location_id_realization" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" class="form-control" id="realization_distribution_branch_percentage" name="realization_distribution_branch_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_branch_percentage'];?>">
												<label class="control-label">Branch Percentage </label>
											</div>	
										</div>

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="realization_distribution_group_percentage" name="realization_distribution_group_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_group_percentage'];?>">
												<label class="control-label">Group Percentage </label>
											</div>	
										</div>

										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="realization_distribution_individual_percentage" name="realization_distribution_individual_percentage" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['realization_distribution_individual_percentage'];?>">
												<label class="control-label">Individual Percentage </label>
											</div>	
										</div>
									</div>
								

				