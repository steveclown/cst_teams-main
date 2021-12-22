<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterlanguage_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeelanguage">
					<thead>
					<tr>
						<th>Name</th>
						<th>Listening</th>
						<th>Reading</th>
						<th>Writing</th>
						<th>Speaking</th>
					</tr>
					</thead>
					<tbody>
					<?php
						// if(empty($hroemployeelanguage)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='5' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeelanguage as $key=>$val){
								
								echo"
								<tr>									
									<td>".$this->main_model->getlanguagename($val[language_id])."</td>
									<td>".$this->configuration->listeningskill[($val[employee_language_listen])]."</td>
									<td>".$this->configuration->readingskill[($val[employee_language_read])]."</td>
									<td>".$this->configuration->writingskill[($val[employee_language_skill_write])]."</td>
									<td>".$this->configuration->speakingskill[($val[employee_language_skill_speak])]."</td>
								</tr>
								";
							} 
						// } 
					?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php echo form_close(); ?>