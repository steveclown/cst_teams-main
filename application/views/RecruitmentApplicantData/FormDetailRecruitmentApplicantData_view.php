<script>
	base_url = '<?php echo base_url()?>';
	
	function reset_recruit(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit/<?php echo $RecruitmentApplicantData['applicant_id']; ?>";
	}

	function function_state_recruit(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_state_recruit');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_elements_recruit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_recruit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
</script>


		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				
				<li>
					<a href="<?php echo base_url();?>">
						Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>RecruitmentApplicantData">
						Data Pelamar
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>RecruitmentApplicantData/addRecruitmentApplicantData">
						Detail Data Pelamar
					</a>
				</li>
			</ul>
		</div>
		
		<h3 class="page-title">
			Form Detail Pelamar 
		</h3>
<?php
	

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$unique 	= $this->session->userdata('unique');

	$data 		= $this->session->userdata('recruitrecruitmentapplicanttab-'.$unique['unique']);
?>

<?php 
	echo form_open('RecruitmentApplicantData/processAddHROEmployeeData_Applicant',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Detail Pelamar 
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>RecruitmentApplicantData" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body  ">
				<div class="tabbable-line boxless tabbable-reversed ">
					<ul class="nav nav-tabs">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="organization"){
								$taborganization = "<li class='active'><a href='#taborganization' name='organization' data-toggle='tab' onClick='function_state_recruit(this.name);'><b>Organisasi</b></a></li>";
							}else{
								$taborganization = "<li><a href='#taborganization' data-toggle='tab' name='organization' onClick='function_state_recruit(this.name);'><b>Organisasi</b></a></li>";
							}

							if($data['active_tab']=="personaldata"){
								$tabpersonal = "<li class='active'><a href='#tabpersonal' name='personaldata' data-toggle='tab' onClick='function_state_recruit(this.name);'><b>Personal</b></a></li>";
							}else{
								$tabpersonal = "<li><a href='#tabpersonal' data-toggle='tab' name='personaldata' onClick='function_state_recruit(this.name);'><b>Personal</b></a></li>";
							}

							// if($data['active_tab']=="working"){
							// 	$tabworking = "<li class='active'><a href='#tabworking' name='working' data-toggle='tab' onClick='function_state_recruit(this.name);'><b>Status Berkerja</b></a></li>";
							// }else{
							// 	$tabworking = "<li><a href='#tabworking' data-toggle='tab' name='working' onClick='function_state_recruit(this.name);'><b>Status Berkerja</b></a></li>";
							// }

							if($data['active_tab']=="family"){
								$tabfamily = "<li class='active'><a href='#tabfamily' name='family' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Keluarga</b></a></li>";
							}else{
								$tabfamily = "<li><a href='#tabfamily' data-toggle='tab' name='family' onClick='function_state_recruit(this.name)'><b>Keluarga</b></a></li>";
							}

							if($data['active_tab']=="education"){
								$tabeducation = "<li class='active'><a href='#tabeducation' name='education' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Pendidikan</b></a></li>";
							}else{
								$tabeducation = "<li><a href='#tabeducation' data-toggle='tab' name='education' onClick='function_state_recruit(this.name)'><b>Pendidikan</b></a></li>";
							}

							if($data['active_tab']=="language"){
								$tablanguage = "<li class='active'><a href='#tablanguage' name='language' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Bahasa</b></a></li>";
							}else{
								$tablanguage = "<li><a href='#tablanguage' data-toggle='tab' name='language' onClick='function_state_recruit(this.name)'><b>Bahasa</b></a></li>";
							}
							
							if($data['active_tab']=="experience"){
								$tabexperience = "<li class='active'><a href='#tabexperience' name='experience' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Pengalaman</b></a></li>";
							}else{
								$tabexperience = "<li><a href='#tabexperience' name='experience' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Pengalaman</b></a></li>";
							}

							if($data['active_tab']=="expertise"){
								$tabexpertise = "<li class='active'><a href='#tabexpertise' name='expertise' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Keahlian</b></a></li>";
							}else{
								$tabexpertise = "<li><a href='#tabexpertise' name='expertise' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Keahlian</b></a></li>";
							}

							if($data['active_tab']=="expectation"){
								$tabexpectation = "<li class='active'><a href='#tabexpectation' name='expectation' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Expectation</b></a></li>";
							}else{
								$tabexpectation = "<li><a href='#tabexpectation' name='expectation' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Expectation</b></a></li>";
							}

							if($data['active_tab']=="other"){
								$tabother = "<li class='active'><a href='#tabother' name='other' data-toggle='tab' onClick='function_state_recruit(this.name)'>Other</a></li>";
							}else{
								$tabother = "<li><a href='#tabother' name='other' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Other</b></a></li>";
							}

							if($data['active_tab']=="medical"){
								$tabmedical = "<li class='active'><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Medical Record</b></a></li>";
							}else{
								$tabmedical = "<li><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Medical Record</b></a></li>";
							}

							if($data['active_tab']=="colleague"){
								$tabcolleague = "<li class='active'><a href='#tabcolleague' name='colleague' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Colleague</b></a></li>";
							}else{
								$tabcolleague = "<li><a href='#tabcolleague' name='colleague' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Colleague</b></a></li>";
							}

							if($data['active_tab']=="personality"){
								$tabpersonality = "<li class='active'><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Personality</b></a></li>";
							}else{
								$tabpersonality = "<li><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Personality</b></a></li>";
							}

							if($data['active_tab']=="question"){
								$tabquestion = "<li class='active'><a href='#tabquestion' name='question' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Question</b></a></li>";
							}else{
								$tabquestion = "<li><a href='#tabquestion' name='question' data-toggle='tab' onClick='function_state_recruit(this.name)'><b>Question</b></a></li>";
							}
							
							echo $taborganization;
							echo $tabpersonal;
							// echo $tabworking;
							echo $tabfamily;
							echo $tabeducation;
							echo $tablanguage;
							echo $tabexperience;
							echo $tabexpertise;				
						?>
					</ul>
					<div class="tab-content">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="organization"){
								$statorganization = "active";
							}else{
								$statorganization = "";
							}

							if($data['active_tab']=="personaldata"){
								$statpersonal = "active";
							}else{
								$statpersonal = "";
							}

							// if($data['active_tab']=="working"){
							// 	$statworking = "active";
							// }else{
							// 	$statworking = "";
							// }

							if($data['active_tab']=="education"){
								$stateducation = "active";
							}else{
								$stateducation = "";
							}

							if($data['active_tab']=="family"){
								$statfamily = "active";
							}else{
								$statfamily = "";
							}

							if($data['active_tab']=="language"){
								$statlanguage = "active";
							}else{
								$statlanguage = "";
							}

							if($data['active_tab']=="experience"){
								$statexperience = "active";
							}else{
								$statexperience = "";
							}

							if($data['active_tab']=="expertise"){
								$statexpertise = "active";
							}else{
								$statexpertise = "";
							}

							echo"<div class='tab-pane ".$statorganization."' id='taborganization'>";
								$this->load->view("RecruitmentApplicantData/formdetailHroEmployeeOrganization_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statpersonal."' id='tabpersonal'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantPersonal_view");
							echo"</div>";

							// echo"<div class='tab-pane ".$statworking."' id='tabworking'>";
							// 	$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantWorking_view");
							// echo"</div>";

							echo"<div class='tab-pane ".$statfamily."' id='tabfamily'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantFamily_view");
							echo"</div>";

							echo"<div class='tab-pane ".$stateducation."' id='tabeducation'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantEducation_view");
							echo"</div>";							

							echo"<div class='tab-pane ".$statlanguage."' id='tablanguage'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantLanguage_view");
							echo"</div>";														

							echo"<div class='tab-pane ".$statexperience."' id='tabexperience'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantExperience_view");
							echo"</div>";							

							echo"<div class='tab-pane ".$statexpertise."' id='tabexpertise'>";
								$this->load->view("RecruitmentApplicantData/formdetailRecruitmentApplicantExpertise_view");
							echo"</div>";							
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 " style="text-align  : right !important;">
						<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_edit()"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Setujui</button>	
					</div>
				</div>

				<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id'];?>">
				<?php echo  form_close(); ?>
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>