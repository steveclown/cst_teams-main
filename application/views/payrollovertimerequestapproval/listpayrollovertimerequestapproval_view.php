<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"payrollovertimerequestapproval/reset_search";
	}
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
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
						<a href="<?php echo base_url();?>payrollovertimerequestapproval">
							Employee Suspend List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Employee Overtime Request Approval List <small>Manage Employee Overtime Request Approval</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('payrollovertimerequestapproval/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division</label>
							</div>	
						</div>
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('department_id', $coredepartment, set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me" ');
								?>
								<label class="control-label">Department</label>
							</div>	
						</div>
					</div>
					
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" ');
								?>
								<label class="control-label">Section </label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_id', $hroemployeedata, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" ');
								?>
								<label class="control-label">Employee </label>
							</div>	
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width = "5%">No</th>
								<th width = "20%">Employee Name</th>
								<th width = "10%">Overtime Type</th>
								<th width = "20%">Overtime Description</th>
								<th width = "10%">Overtime Date</th>
								<th width = "5%">Overtime Duration</th>
								<th width = "20%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeedata_overtimeapproval as $key=>$val){
									
									echo"
										<tr>			
											<td>".$no."</td>
											<td>".$val['employee_name']."</td>
											<td>".$val['overtime_type_name']."</td>
											<td>".$val['overtime_request_description']."</td>
											<td>".tgltoview($val['overtime_request_date'])."</td>
											<td>".$val['overtime_request_duration']."</td>
											<td>
												<a class='btn default btn-xs yellow' data-toggle='modal' href='#myModal' data-target='#detail-modal".$val['overtime_request_id']."' id='".$val['overtime_request_id']."'><i class='fa fa-pencil'></i> Approval
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>

<?php
	foreach ($hroemployeedata_overtimeapproval as $keyDetail=>$valDetail){
		echo form_open('payrollovertimerequestapproval/processEditPayrollOvertimeRequestApproval',array('id' => 'myform', 'class' => 'horizontal-form'));
?>
	<script>
		$(document).ready(function(){
	        $("#Save").click(function(){
				var overtime_request_approved_remark = $("#overtime_request_approved_remark").val();
				
			  	if(overtime_request_approved_remark!=''){
					return true;
				}else{
					alert('Please insert remark');
					return false;
				}
			});
	    });
	</script>

<?php
	echo "<div id='detail-modal".$valDetail['overtime_request_id']."' class='modal fade bs-modal-lg' tabindex='-1' role='dialog' aria-hidden='true'>";
?>
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	                <h4 class="modal-title">Overtime Request Approval - <?php echo $valDetail['overtime_request_description']?> - <?php echo $valDetail['overtime_request_id']?></h4>
	            </div>
	            <div class="modal-body">
	                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
	                    <div class="row">
	                    	<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('overtime_request_approved', $overtimerequestapproved, set_value('overtime_request_approved', $data['overtime_request_approved']), 'id="overtime_request_approved" class="form-control select2me" ');
										?>
									<label class="control-label">Overtime Status
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-12">
								<label class="control-label">Remark</label>
								<div class="input-icon right">
									<i class="fa"></i>
									<?php echo form_textarea(array('rows'=>'5','name'=>'overtime_request_approved_remark','class'=>'form-control','id'=>'overtime_request_approved_remark','value'=>set_value('overtime_request_approved_remark',$header['overtime_request_approved_remark'])))?>
								</div>	
							</div>	
						</div>
						
						<input type="hidden" class="form-control" name="overtime_request_id" id="overtime_request_id"  value="<?php echo set_value('overtime_request_id',$valDetail['overtime_request_id']);?>"/>
						<input type="hidden" class="form-control" name="employee_id" id="employee_id"  value="<?php echo set_value('employee_id',$valDetail['employee_id']);?>"/>
					</div>
		       	</div>
	            <div class="modal-footer">
	                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
	                <button type="submit" id="Save" class="btn green"><i class="fa fa-check"></i> Save</button>
	            </div>
	        </div>
	    </div>
	</div>
<?php
	echo form_close(); 
	}
?>