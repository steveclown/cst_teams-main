<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>
<script>
	base_url = '<?php base_url()?>';
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
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
						Tambah Data Pelamar
					</a>
				</li>
			</ul>
		</div>
		
		<h3 class="page-title">
			Form Tambah Pelamar
		</h3>

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah Pelamar
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>recruitment-applicant-data" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body  ">
				<?php
					echo form_open_multipart('RecruitmentApplicantData/processAddRecruitmentApplicantData',array('id' => 'myform', 'class' => 'horizontal-form', 'role' => 'form'));
					
					$unique 	= $this->session->userdata('unique');
					$auth		= $this->session->userdata('auth');
					$data 		= $this->session->userdata('addrecruitmentapplicantdata-'.$unique['unique']);
				?>
				<div class="tabbable-line boxless tabbable-reversed ">
					<ul class="nav nav-tabs">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="personaldata"){
								$tabpersonal = "<li class='active'><a href='#tabpersonal' name='personaldata' data-toggle='tab' onClick='function_state_add(this.name);'><b>Personal</b></a></li>";
							}else{
								$tabpersonal = "<li><a href='#tabpersonal' data-toggle='tab' name='personaldata' onClick='function_state_add(this.name);'><b>Personal</b></a></li>";
							}

							if($data['active_tab']=="family"){
								$tabfamily = "<li class='active'><a href='#tabfamily' name='family' data-toggle='tab' onClick='function_state_add(this.name)'><b>Keluarga</b></a></li>";
							}else{
								$tabfamily = "<li><a href='#tabfamily' data-toggle='tab' name='family' onClick='function_state_add(this.name)'><b>Keluarga</b></a></li>";
							}

							if($data['active_tab']=="education"){
								$tabeducation = "<li class='active'><a href='#tabeducation' name='education' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pendidikan</b></a></li>";
							}else{
								$tabeducation = "<li><a href='#tabeducation' data-toggle='tab' name='education' onClick='function_state_add(this.name)'><b>Pendidikan</b></a></li>";
							}

							if($data['active_tab']=="language"){
								$tablanguage = "<li class='active'><a href='#tablanguage' name='language' data-toggle='tab' onClick='function_state_add(this.name)'><b>Bahasa</b></a></li>";
							}else{
								$tablanguage = "<li><a href='#tablanguage' data-toggle='tab' name='language' onClick='function_state_add(this.name)'><b>Bahasa</b></a></li>";
							}
							
							if($data['active_tab']=="experience"){
								$tabexperience = "<li class='active'><a href='#tabexperience' name='experience' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pengalaman</b></a></li>";
							}else{
								$tabexperience = "<li><a href='#tabexperience' name='experience' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pengalaman</b></a></li>";
							}

							if($data['active_tab']=="expertise"){
								$tabexpertise = "<li class='active'><a href='#tabexpertise' name='expertise' data-toggle='tab' onClick='function_state_add(this.name)'><b>Keahlian</b></a></li>";
							}else{
								$tabexpertise = "<li><a href='#tabexpertise' name='expertise' data-toggle='tab' onClick='function_state_add(this.name)'><b>Keahlian</b></a></li>";
							}

							if($data['active_tab']=="expectation"){
								$tabexpectation = "<li class='active'><a href='#tabexpectation' name='expectation' data-toggle='tab' onClick='function_state_add(this.name)'><b>Harapan</b></a></li>";
							}else{
								$tabexpectation = "<li><a href='#tabexpectation' name='expectation' data-toggle='tab' onClick='function_state_add(this.name)'><b>Harapan</b></a></li>";
							}

							if($data['active_tab']=="other"){
								$tabother = "<li class='active'><a href='#tabother' name='other' data-toggle='tab' onClick='function_state_add(this.name)'>Lainnya</a></li>";
							}else{
								$tabother = "<li><a href='#tabother' name='other' data-toggle='tab' onClick='function_state_add(this.name)'><b>Lainnya</b></a></li>";
							}

							if($data['active_tab']=="medical"){
								$tabmedical = "<li class='active'><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Riwayat Kesehatan Record</b></a></li>";
							}else{
								$tabmedical = "<li><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Riwayat Kesehatan</b></a></li>";
							}

							if($data['active_tab']=="colleague"){
								$tabcolleague = "<li class='active'><a href='#tabcolleague' name='colleague' data-toggle='tab' onClick='function_state_add(this.name)'><b>Colleague</b></a></li>";
							}else{
								$tabcolleague = "<li><a href='#tabcolleague' name='colleague' data-toggle='tab' onClick='function_state_add(this.name)'><b>Colleague</b></a></li>";
							}

							if($data['active_tab']=="personality"){
								$tabpersonality = "<li class='active'><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_add(this.name)'><b>Personality</b></a></li>";
							}else{
								$tabpersonality = "<li><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_add(this.name)'><b>Personality</b></a></li>";
							}

							if($data['active_tab']=="question"){
								$tabquestion = "<li class='active'><a href='#tabquestion' name='question' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pertanyaan</b></a></li>";
							}else{
								$tabquestion = "<li><a href='#tabquestion' name='question' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pertanyaan</b></a></li>";
							}
							
							echo $tabpersonal;
							echo $tabfamily;
							echo $tabeducation;
							echo $tablanguage;
							echo $tabexperience;
							echo $tabexpertise;
							echo $tabexpectation;
							// echo $tabother;
							// echo $tabmedical;
							// echo $tabcolleague;
							// echo $tabpersonality;
							// echo $tabquestion;				
						?>
					</ul>
					<div class="tab-content">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="personaldata"){
								$statpersonal = "active";
							}else{
								$statpersonal = "";
							}

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

							if($data['active_tab']=="expectation"){
								$statexpectation = "active";
							}else{
								$statexpectation = "";
							}

							if($data['active_tab']=="other"){
								$statother = "active";
							}else{
								$statother = "";
							}

							if($data['active_tab']=="medical"){
								$statmedical = "active";
							}else{
								$statmedical = "";
							}

							if($data['active_tab']=="question"){
								$statquestion = "active";
							}else{
								$statquestion = "";
							}
							
							echo"<div class='tab-pane ".$statpersonal."' id='tabpersonal'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantPersonal_view");
							echo"</div>";

							echo"<div class='tab-pane ".$stateducation."' id='tabeducation'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantEducation_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statfamily."' id='tabfamily'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantFamily_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statlanguage."' id='tablanguage'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantLanguage_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statexperience."' id='tabexperience'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantExperience_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statexpertise."' id='tabexpertise'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantExpertise_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statexpectation."' id='tabexpectation'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantExpectation_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statother."' id='tabother'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantOther_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statmedical."' id='tabmedical'>";
								$this->load->view("RecruitmentApplicantData/FormAddRecruitmentApplicantMedical_view");								
							echo"</div>";

							echo"<div class='tab-pane ".$statquestion."' id='tabquestion'>";
								$this->load->view("RecruitmentApplicantData/addquestion_view");									
							echo"</div>";
						?>
					</div>
				</div>
				<div align = "right">
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="reset_ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
				</div>
				<?php
					echo form_close();
				?>				
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>