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
	echo form_open('transactionalapplicantfamily/processaddtransactionalapplicantfamily',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
	$applicantfamily_item	= $this->session->userdata("dataitemaddtransactionalapplicantfamily-".$header['created_on']);
	// print_r($applicantfamily_item);exit;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>List Family
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
											<thead>
											<tr>
												<th>
													Name
												</th>
												<th>
													Status
												</th>
												<th>
													Address
												</th>
												<th>
													City
												</th>
												<th>
													Zip Code
												</th>
												<th>
													RT
												</th>
												<th>
													RW
												</th>
												<th>
													Kecamatan
												</th>
												<th>
													Kelurahan
												</th>
												<th>
													Home Phone
												</th>
												<th>
													Mobile Phone 1
												</th>
												<th>
													Mobile Phone 2
												</th>
												<th>
													Gender
												</th>
												<th>
													Date Of Birth
												</th>
												<th>
													Place Of Birth
												</th>
												<th>
													Education
												</th>
												<th>
													Occupation
												</th>
												<th>
													Marital Status
												</th>
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
												// if(empty($applicantfamily_item)){
													// echo "	<tr class='odd gradeX'>
																// <td colspan='19' style='text-align:center;'>No Data Available</td>
															// </tr>
													// ";						
												// }else{
												if(!empty($applicantfamily_item)){
													foreach ($applicantfamily_item as $key=>$val){
														
														echo"
															<tr>									
																<td>$val[applicant_family_name]</td>
																<td>".$this->transactionalapplicantfamily_model->getfamilystatusname($val[family_status_id])."</td>
																<td>$val[applicant_family_address]</td>
																<td>$val[applicant_family_city]</td>
																<td>$val[applicant_family_zip_code]</td>
																<td>$val[applicant_family_rt]</td>
																<td>$val[applicant_family_rw]</td>
																<td>$val[applicant_family_kecamatan]</td>
																<td>$val[applicant_family_kelurahan]</td>
																<td>$val[applicant_family_home_phone]</td>
																<td>$val[applicant_family_mobile_phone1]</td>
																<td>$val[applicant_family_mobile_phone2]</td>
																<td>".$this->configuration->Gender[($val[applicant_family_gender])]."</td>
																<td>$val[applicant_family_date_of_birth]</td>
																<td>$val[applicant_family_place_of_birth]</td>
																<td>$val[applicant_family_education]</td>
																<td>$val[applicant_family_occupation]</td>
																<td>".$this->transactionalapplicantfamily_model->getmaritalstatusname($val[marital_status_id])."</td>
																<td>
																	<a href='".$this->config->item('base_url').'transactionalapplicantfamily/deletearrayapplicantfamilyitem/'.$val[created_on].'/'.$key."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
									<a href="<?php echo base_url();?>transactionalapplicantfamily/resetapplicantfamily" class="btn red"><i class="fa fa-times"></i> Reset</a>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<a href="<?php echo base_url();?>transactionalapplicanteducation" class="btn dark button-previous"><i class="m-icon-swapleft"></i> Back</a>
									<button type="submit" class="btn green"></i> Next <i class="m-icon-swapright m-icon-white"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>