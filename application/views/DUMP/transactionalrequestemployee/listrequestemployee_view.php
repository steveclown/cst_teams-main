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
<script>
base_url = '<?php echo base_url();?>';
function reset_all(){
	document.location = base_url+"transactionalrequestemployee/resetrequestemployee";
}
</script>
<?php 
	echo form_open('transactionalrequestemployee/processaddtransactionalrequestemployee',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addrequestemployee-'.$sesi['unique']);
	// print_r($header);exit;
	$requestemployee_item	= $this->session->userdata("dataitemaddrequestemployee-".$header['created_by']);
	// print_r($requestemployee_item);exit;
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Selected Applicant
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
											<thead>
											<tr>
												<th>
													Applicant Name
												</th>
												<th>
													City
												</th>
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($requestemployee_item)){
												foreach ($requestemployee_item as $key=>$val){
													
													echo"
														<tr>									
															<td>".$this->transactionalrequestemployee_model->getapplicantname($val[applicant_id])."</td>
															<td>".$this->transactionalrequestemployee_model->getapplicantcity($val[applicant_id])."</td>
															<td>
																<a href='".$this->config->item('base_url').'transactionalrequestemployee/deletearrayrequestemployeeitem/'.$key."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
									<button type="button" class="btn red" onClick="reset_all();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>