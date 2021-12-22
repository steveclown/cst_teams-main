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
	echo form_open('addnewapplicant/processaddapplicantsubjects',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addapplicantsubjects-'.$sesi['unique']);
	$applicantsubjects_item	= $this->session->userdata("dataitemaddapplicantsubjects-".$header['created_by']);
	// print_r($applicantsubjects_item);exit;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>List Subjects
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">\
											<thead>
											<tr>
												<th>
													Status
												</th>
												<th>
													Subjects Name
												</th>
												<th>
													Remark
												</th>
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($applicantsubjects_item)){
												foreach ($applicantsubjects_item as $key=>$val){
													
													echo"
														<tr>									
															<td>".$this->configuration->SubjectsStatus[($val[applicant_subjects_status])]."</td>
															<td>$val[applicant_subjects_name]</td>
															<td>$val[applicant_subjects_remark]</td>
															<td>
																<a href='".$this->config->item('base_url').'addnewapplicant/deletearrayapplicantsubjectsitem/'.$key."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
									<a href="<?php echo base_url();?>addnewapplicant/resetapplicantsubjects" class="btn red"><i class="fa fa-times"></i> Reset</a>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<a href="<?php echo base_url();?>addnewapplicant/applicantpersonality" class="btn dark button-previous"><i class="m-icon-swapleft"></i> Back</a>
									<button type="submit" class="btn green"></i> Next <i class="m-icon-swapright m-icon-white"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>