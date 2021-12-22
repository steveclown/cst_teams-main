
<?php
		$this->load->view('hroemployeelanguage/formaddhroemployeelanguage_view');
		 
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
											<th style='text-align:center' width="30%">Language</th>
											<th style='text-align:center' width="15%">Listening Skill</th>
											<th style='text-align:center' width="15%">Reading Skill</th>
											<th style='text-align:center' width="15%">Writing Skill</th>
											<th style='text-align:center' width="15%">Speaking Skill</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!empty($hroemployeelanguage_data)){
											foreach($hroemployeelanguage_data as $key=>$val){
												echo"
													<tr class='odd gradeX'>
														<td style='text-align:center'>$no.</td>
														<td>".$this->hroemployeelanguage_model->getLanguageName($val['language_id'])."</td>
														<td>".$this->configuration->ListeningSkill[$val['employee_language_listen']]."</td>
														<td>".$this->configuration->ReadingSkill[$val['employee_language_read']]."</td>
														<td>".$this->configuration->WritingSkill[$val['employee_language_write']]."</td>
														<td>".$this->configuration->SpeakingSkill[$val['employee_language_speak']]."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url').'hroemployeelanguage/deleteHROEmployeeLanguage_Data/'.$val['employee_id']."/".$val['employee_language_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

