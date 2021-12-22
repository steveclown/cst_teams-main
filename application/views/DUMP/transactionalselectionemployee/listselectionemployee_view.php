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
uri = '<?php echo $this->uri->segment(3);?>';
function reset_all(){
	document.location = base_url+"transactionalselectionemployee/resetselectionemployee/"+uri;
}
</script>
<?php 
	echo form_open('transactionalselectionemployee/processaddtransactionalselectionemployee',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addselectionemployee-'.$sesi['unique']);
	// print_r($header);exit;
	$selectionemployee_item	= $this->session->userdata("dataitemaddselectionemployee-".$header['created_by']);
	// print_r($selectionemployee_item);exit;
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
													Request Status
												</th>
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($selectionemployee_item)){
												foreach ($selectionemployee_item as $key=>$val){
													
													echo"
														<tr>									
															<td>".$this->transactionalselectionemployee_model->getapplicantname($val[applicant_id])."</td>
															<td>".$this->configuration->RequestStatus[($val[applicant_request_status])]."</td>
															<td>
																<a href='".$this->config->item('base_url').'transactionalselectionemployee/deletearrayselectionemployeeitem/'.$key."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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