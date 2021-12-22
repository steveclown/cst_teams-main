
<?php
	$this->load->view('payrollleaverequestapproval/formeditpayrollleaverequestapproval_view');

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
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Leave Type</th>
											<th>Leave Description</th>
											<th>Leave Date</th>
											<th>Leave Duration</th>
											<th>Leave Approved</th>
											<th>Leave Approved Date</th>
											<th>Leave Approved On</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollleaverequestapproval_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollleaverequestapproval_data as $key=>$val){
												$leave_request_id = $val['leave_request_id'];
												echo"
													<tr>
														<td>".$this->payrollleaverequestapproval_model->getAnnualleaveName($val['annual_leave_id'])."</td>
														<td>".$val['leave_request_description']."</td>
														<td>".tgltoview($val['leave_request_date'])."</td>
														<td>".$val['leave_request_duration']."</td>
														<td>".$this->configuration->Approved[$val['leave_request_approved']]."</td>
														<td>".$val['leave_request_approved_date']."</td>
														<td>".$val['leave_request_approved_on']."</td>";

														if ($val['leave_request_approved'] == 0){
															echo "<td>
																<a class='btn default btn-xs red' data-toggle='modal' href='#myModal' data-target='#edit-modal' id='".$val['leave_request_id']."'><i class='fa fa-pencil'></i> Approval
																</a>
															</td>";
														}
														echo"
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
</div>
<!-- <div><a href="#myModal" data-toggle="modal" id="1" data-target="#edit-modal">Edit 1</a></div>
 -->
<script>
        $('#edit-modal').on('show.bs.modal', function(e) {
            
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                alert(esseyId);
            
//            $.ajax({
//                cache: false,
//                type: 'POST',
//                url: 'backend.php',
//                data: 'EID='+essay_id,
//                success: function(data) 
//                {
                    $modal.find('.edit-content').html(esseyId);
//                }
//            });
            
        })
    </script>


<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body edit-content">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
	

