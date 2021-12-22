<script>
	base_url = '<?php base_url()?>';
	
</script>
<div class="workplace" style="padding:5px !important;"> 
<?php
	$this->load->view('assignmentovertimerate/formaddassignmentovertimerate_view');		 
?>
<?php 
	echo form_open('assignmentovertimerate/processAddAssignmentOvertimeRate'); 
	$sesi 							= $this->session->userdata('unique');
	$data							= $this->session->userdata('assignmentovertimerate-'.$sesi['unique']);
	$assignmentovertimeratetitle	= $this->session->userdata($data['created_on']);
?>
				
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">									
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Division Name</th>
									<th>Department Name</th>
									<th>Section Name</th>
									<th>Job Title Name</th>
									<th>Allowance Name</th>
									<th>Allowance Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($assignmentovertimeratetitle)){
									foreach($assignmentovertimeratetitle as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->assignmentovertimerate_model->getDivisionName($val['division_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getDepartmentName($val['department_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getSectionName($val['section_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getJobTitleName($val['job_title_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getAllowanceName($val['allowance_id'])."</td>
												<td>".nominal($val['overtime_rate_allowance_amount'])."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'assignmentovertimerate/deleteArrayOvertimeRateTitle/'.$val['created_on'].'/'.$val['overtime_rate_title_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='11' style='text-align:center;'>
												<b>No Data</b>
											</td>
										</tr>
									";
								}
							?>		
							<tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>

		