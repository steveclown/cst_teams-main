
<?php
		$this->load->view('hroemployeefamily/formaddhroemployeefamily_view');
		 
?>
<?php 
	echo form_open('hroemployeefamily/processAddHROEmployeeFamily'); 
/*	$sesi 					= $this->session->userdata('unique');
	$data					= $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);
	$hroemployeefamily_data	= $this->session->userdata($data['employee_id']);*/

	$sesi 					= $this->session->userdata('unique');
	$data_family			= $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);
	$hroemployeefamily_data	= $this->session->userdata($data_family['created_on']);

	print_r("sesi ");
	print_r($sesi); 
	print_r("<BR>");
	print_r("hroemployeefamily_data ");
	print_r($hroemployeefamily_data); 
	print_r("<BR>");
	print_r("employee_family_name ");
	print_r($hroemployeefamily_data['employee_family_name']); 
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
											<th>Family Relation</th>
											<th>Family Name</th>
											<th>City</th>
											<th>Mobile Phone</th>
											<th>Education</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeefamily_data)){
											echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeefamily_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->hroemployeefamily_model->getFamilyRelationName($val['family_relation_id'])."</td>
														<td>".$val['employee_family_name']."</td>
														<td>".$val['employee_family_city']."</td>
														<td>".$val['employee_family_mobile_phone']."</td>
														<td>".$val['employee_family_education']."</td>
														<td>
														<a href='".$this->config->item('base_url').'hroemployeefamily/deleteHROEmployeeFamily_Data/'.$val['employee_family_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
															<i class='fa fa-trash-o'></i> Delete
														</a>";
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
					
					<div class = "row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="Reset" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
						</div>

						<label></label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php echo form_close(); ?>
