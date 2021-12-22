<script>

</script>
<div class="portlet-body form">
	<!-- BEGIN FORM-->
	<?php 
	echo form_open('main/processworkingex',array('id' => 'myform', 'class' => 'horizontal-form'));
	$workingex = $this->session->userdata('workingex');
	?>
		<div class="form-body">
			<h3 class="form-section">Working Experience</h3>
			<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_4">
					<thead>
					<tr>
						<th width="25%">
							Company Name
						</th>
						<th width="25%">
							Company Address
						</th>
						<th width="25%">
							Job Title
						</th>
						<th width="25%">
							From Period
						</th>
						<th width="25%">
							To Period
						</th>
						<th width="25%">
							Last Salary
						</th>
						<th width="25%">
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($hroworkingex as $key=>$val){
							
							echo"
								<tr>									
									<td>$val[company_name]</td>
									<td>$val[company_address]</td>
									<td>$val[working_experience_job_title]</td>
									<td>$val[working_experience_from_period]</td>
									<td>$val[working_experience_to_period]</td>
									<td>$val[working_experience_last_salary]</td>
									<td>
										<a href='".$this->config->item('base_url').'hroworkingex/Edit/'.$val[employee_working_experience_id]."' class='btn default btn-xs yellow'>
											<i class='fa fa-edit'></i> Edit
										</a>
										<a href='".$this->config->item('base_url').'hroworkingex/delete/'.$val[employee_working_experience_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
									</td>
								</tr>
							";
					} ?>
					</tbody>
					</table>
				</div>
				</div>
	<?php
	$this->session->unset_userdata('PersonalData');
	echo form_close(); 
	?>
	<!-- END FORM-->
</div>
