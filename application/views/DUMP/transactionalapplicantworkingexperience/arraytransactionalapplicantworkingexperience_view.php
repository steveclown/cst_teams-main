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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<?php 
	echo form_open('transactionalapplicantworkingexperience/processaddtransactionalapplicantworkingexperience',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addtransactionalapplicantworkingexperience-'.$sesi['unique']);
	$applicantworkingexperience_item	= $this->session->userdata("dataitemaddtransactionalapplicantworkingexperience-".$header['created_on']);
	// print_r($applicantworkingexperience_item);exit;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>List Working Experience
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
											<thead>
											<tr>
												<th>
													Company Name
												</th>
												<th>
													Company Address
												</th>
												<th>
													Job Title
												</th>
												<th>
													From Period
												</th>
												<th>
													To Period
												</th>
												<th>
													Last Salary
												</th>
												<th>
													Resign Reason
												</th>
												<th>
													Resign Letter
												</th>
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($applicantworkingexperience_item)){
												foreach ($applicantworkingexperience_item as $key=>$val){
													
													echo"
														<tr>									
															<td>$val[company_name]</td>
															<td>$val[company_address]</td>
															<td>$val[working_experience_job_title]</td>
															<td>$val[working_experience_from_period]</td>
															<td>$val[working_experience_to_period]</td>
															<td>".nominal($val[working_experience_last_salary])."</td>
															<td>$val[working_experience_resign_reason]</td>
															<td>".$this->configuration->ResignLetter[($val[working_experience_resign_letter])]."</td>
															<td>
																<a href='".$this->config->item('base_url').'transactionalapplicantworkingexperience/delete/'.$val[applicant_working_experience_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																	<i class='fa fa-trash-o'></i> Delete
																</a>
															</td>
														</tr>
													";
												} 
											} 
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-actions right">
									<a href="<?php echo base_url();?>transactionalapplicantworkingexperience/resetapplicantworkingexperience" class="btn red"><i class="fa fa-times"></i> Reset</a>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<a href="<?php echo base_url();?>transactionalapplicantaccidentexperience" class="btn dark button-previous"><i class="m-icon-swapleft"></i> Back</a>
									<button type="submit" class="btn green"></i> Next <i class="m-icon-swapright m-icon-white"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>