
<?php
		$this->load->view('hroemployeecontractextending/formaddhroemployeecontractextending_view');
		 
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
											<th style='text-align:center' width="5%">No.</th>
											<th style='text-align:center' width="30%">Contract Name</th>
											<th style='text-align:center' width="15%">Contract Description</th>
											<th style='text-align:center' width="15%">Extending Date</th>
											<th style='text-align:center' width="15%">Extending Last Date</th>
											<th style='text-align:center' width="15%">Extending Next Date</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!empty($hroemployeecontractextending_data)){
											foreach($hroemployeecontractextending_data as $key=>$val){
												echo"
													<tr class='odd gradeX'>
														<td style='text-align:center'>$no.</td>
														<td>".$this->hroemployeecontractextending_model->getContractName($val['contract_id'])."</td>
														<td>".$val['contract_extending_description']."</td>
														<td>".tgltoview($val['contract_extending_date'])."</td>
														<td>".tgltoview($val['contract_extending_last_date'])."</td>
														<td>".tgltoview($val['contract_extending_next_date'])."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url').'hroemployeecontractextending/deleteHROEmployeeContractExtending_Data/'.$val['employee_id']."/".$val['contract_extending_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>";
														echo "
														</td>
													</tr>
												";
												$no++;
											}
										}else{
											echo"
												<tr class='odd gradeX'>
													<td colspan='12' style='text-align:center;'>
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
				</div>
			</div>
		</div>
	</div>
</div>

