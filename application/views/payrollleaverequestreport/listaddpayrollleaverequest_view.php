
<?php
		$this->load->view('payrollleaverequest/formaddpayrollleaverequest_view');

?>

<div class="row">
	<div class="col-md-12">	
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width = "10%">Leave Type</th>
										<th width = "30%">Leave Description</th>
										<th width = "10%">Leave Date</th>
										<th width = "10%">Start Date</th>
										<th width = "10%">End Date</th>
										<th width = "10%">Leave Duration</th>
										<th width = "20%">Action</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if(!is_array($payrollleaverequest_data)){
										echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
									} else {
										foreach ($payrollleaverequest_data as $key=>$val){
											$leave_request_id = $val['leave_request_id'];
											echo"
												<tr>
													<td>".$this->payrollleaverequest_model->getAnnualLeaveName($val['annual_leave_id'])."</td>
													<td>".$val['leave_request_description']."</td>
													<td>".tgltoview($val['leave_request_date'])."</td>
													<td>".tgltoview($val['leave_request_start_date'])."</td>
													<td>".tgltoview($val['leave_request_end_date'])."</td>
													<td>".$val['leave_request_duration']."</td>
													<td>
														<a class='btn default btn-xs yellow' data-toggle='modal' href='#myModal' data-target='#detail-modal".$val['leave_request_id']."' id='".$val['leave_request_id']."'><i class='fa fa-pencil'></i> Detail
														</a>
														<a href='".$this->config->item('base_url').'payrollleaverequest/deletePayrollLeaveRequest_Data/'.$val['employee_id']."/".$val['leave_request_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	foreach ($payrollleaverequest_data as $keyDetail=>$valDetail){
		echo "<div id='detail-modal".$valDetail['leave_request_id']."' class='modal fade' tabindex='-1' role='dialog' aria-hidden='true'>";
?>
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	                <h4 class="modal-title">Leave Request Detail - <?php echo $valDetail['leave_request_description']?> -</h4>
	            </div>
	            <div class="modal-body">
	                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
	                    <div class="row">
	                        <div class="col-md-12">
	                        	<?php 
	                        		$payrollleaverequestdetail_data = $this->payrollleaverequest_model->getPayrollLeaveRequestDetail_Data($valDetail['leave_request_id']);
	                        	?>
	                        	<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
									<thead>
										<tr>
											<th width = "10%">Leave Date</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollleaverequestdetail_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollleaverequestdetail_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['leave_request_detail_date'])."</td>
													</tr>
												";
											}
										}
									?>	
									</tbody>
								</table>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
	            </div>
	        </div>
	    </div>
	</div>
<?php
	}
?>
