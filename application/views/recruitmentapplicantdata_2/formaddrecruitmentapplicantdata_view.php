<script>
	base_url = '<?php base_url()?>';
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('transactionalapplicantdata/function_elements_add');?>",
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
				url : "<?php echo site_url('transactionalapplicantdata/function_state_add');?>",
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
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>recruitmentapplicantdata">
						Applicant Data
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>recruitmentapplicantdata/addRecruitmentApplicantData">
						Add Applicant Data
					</a>
				</li>
			</ul>
		</div>
		
		<h3 class="page-title">
			Form Add Applicant 
		</h3>

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box red-flamingo">
			<div class="portlet-title">
				<div class="caption">
					Form Add Applicant 
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>recruitmentapplicantdata" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body">
				<?php
					echo form_open_multipart('recruitmentapplicantdata/processAddRecruitmentApplicantData',array('id' => 'myform', 'class' => '', 'role' => 'form'));
					$sesi 	= $this->session->userdata('unique');
					$auth	= $this->session->userdata('auth');
					$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);
				?>
				<div class="tabbable tabbable-custom tabbable-full-width">
					<ul class="nav nav-tabs">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="personaldata"){
								$tabpersonal = "<li class='active'><a href='#tabpersonal' name='personaldata' data-toggle='tab' onClick='function_state_add(this.name);'><b>Personal</b></a></li>";
							}else{
								$tabpersonal = "<li><a href='#tabpersonal' data-toggle='tab' name='personaldata' onClick='function_state_add(this.name);'><b>Personal</b></a></li>";
							}
							if($data['active_tab']=="education"){
								$tabeducation = "<li class='active'><a href='#tabeducation' name='education' data-toggle='tab' onClick='function_state_add(this.name)'><b>Educations</b></a></li>";
							}else{
								$tabeducation = "<li><a href='#tabeducation' data-toggle='tab' name='education' onClick='function_state_add(this.name)'><b>Educations</b></a></li>";
							}
							if($data['active_tab']=="family"){
								$tabfamily = "<li class='active'><a href='#tabfamily' name='family' data-toggle='tab' onClick='function_state_add(this.name)'><b>Family</b></a></li>";
							}else{
								$tabfamily = "<li><a href='#tabfamily' data-toggle='tab' name='family' onClick='function_state_add(this.name)'><b>Family</b></a></li>";
							}
							if($data['active_tab']=="working"){
								$tabworking = "<li class='active'><a href='#tabworking' name='working' data-toggle='tab' onClick='function_state_add(this.name)'><b>Working Experience</b></a></li>";
							}else{
								$tabworking = "<li><a href='#tabworking' name='working' data-toggle='tab' onClick='function_state_add(this.name)'><b>Working Experience</b></a></li>";
							}
							if($data['active_tab']=="law"){
								$tablaw = "<li class='active'><a href='#tablaw' name='law' data-toggle='tab' onClick='function_state_add(this.name)'><b>Law Experience</b></a></li>";
							}else{
								$tablaw = "<li><a href='#tablaw' name='law' data-toggle='tab' onClick='function_state_add(this.name)'><b>Law Experience</b></a></li>";
							}
							if($data['active_tab']=="organization"){
								$taborganization = "<li class='active'><a href='#taborganization' name='organization' data-toggle='tab' onClick='function_state_add(this.name)'>Organization</a></li>";
							}else{
								$taborganization = "<li><a href='#taborganization' name='organization' data-toggle='tab' onClick='function_state_add(this.name)'><b>Organization</b></a></li>";
							}
							if($data['active_tab']=="medical"){
								$tabmedical = "<li class='active'><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Medical Record</b></a></li>";
							}else{
								$tabmedical = "<li><a href='#tabmedical' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Medical Record</b></a></li>";
							}
							if($data['active_tab']=="personality"){
								$tabpersonality = "<li class='active'><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_add(this.name)'><b>Personality</b></a></li>";
							}else{
								$tabpersonality = "<li><a href='#tabpersonality' name='personality' data-toggle='tab' onClick='function_state_add(this.name)'><b>Personality</b></a></li>";
							}
							if($data['active_tab']=="subject"){
								$tabsubject = "<li class='active'><a href='#tabsubject' name='subject' data-toggle='tab' onClick='function_state_add(this.name)'><b>Subject</b></a></li>";
							}else{
								$tabsubject = "<li><a href='#tabsubject' name='subject' data-toggle='tab' onClick='function_state_add(this.name)'><b>Subject</b></a></li>";
							}
							if($data['active_tab']=="colleagues"){
								$tabcolleagues = "<li class='active'><a href='#tabcolleagues' name='colleagues' data-toggle='tab' onClick='function_state_add(this.name)'><b>Colleagues</b></a></li>";
							}else{
								$tabcolleagues = "<li><a href='#tabcolleagues' name='colleagues' data-toggle='tab' onClick='function_state_add(this.name)'><b>Colleagues</b></a></li>";
							}
							
							
							echo $tabpersonal;
							echo $tabeducation;
							echo $tabfamily;
							echo $tabworking;
							echo $tablaw;
							echo $taborganization;
							echo $tabmedical;
							echo $tabpersonality;
							echo $tabsubject;
							echo $tabcolleagues;							
							
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
							if($data['active_tab']=="working"){
								$statworking = "active";
							}else{
								$statworking = "";
							}
							if($data['active_tab']=="law"){
								$statlaw = "active";
							}else{
								$statlaw = "";
							}
							if($data['active_tab']=="organization"){
								$statorganization = "active";
							}else{
								$statorganization = "";
							}
							if($data['active_tab']=="medical"){
								$statmedical = "active";
							}else{
								$statmedical = "";
							}
							if($data['active_tab']=="personality"){
								$statpersonality = "active";
							}else{
								$statpersonality = "";
							}
							if($data['active_tab']=="subject"){
								$statsubject = "active";
							}else{
								$statsubject = "";
							}
							if($data['active_tab']=="colleagues"){
								$statcolleagues = "active";
							}else{
								$statcolleagues = "";
							}
							
							echo"<div class='tab-pane ".$statpersonal."' id='tabpersonal'>";
								$this->load->view("recruitmentapplicantdata/addpersonaldata_view");
							echo"</div>";
							echo"<div class='tab-pane ".$stateducation."' id='tabeducation'>";
								$this->load->view("recruitmentapplicantdata/addeducation_view");
							echo"</div>";
							echo"<div class='tab-pane ".$statfamily."' id='tabfamily'>";
								$this->load->view("recruitmentapplicantdata/addfamily_view");
							echo"</div>";
							echo"<div class='tab-pane ".$statworking."' id='tabworking'>";
								$this->load->view("recruitmentapplicantdata/addworkingexperience_view");
							echo"</div>";
							echo"<div class='tab-pane ".$statlaw."' id='tablaw'>";
								$this->load->view("recruitmentapplicantdata/addlawexperience_view");
							echo"</div>";
							echo"<div class='tab-pane ".$statorganization."' id='taborganization'>";
								$this->load->view("recruitmentapplicantdata/addorganizationexperience_view");
							echo"</div>";
							echo"<div class='tab-pane ".$statmedical."' id='tabmedical'>";
								$this->load->view("recruitmentapplicantdata/addmedicalrecord_view");									
							echo"</div>";
							echo"<div class='tab-pane ".$statpersonality."' id='tabpersonality'>";
								$this->load->view("recruitmentapplicantdata/addpersonality_view");									
							echo"</div>";
							echo"<div class='tab-pane ".$statsubject."' id='tabsubject'>";
								$this->load->view("recruitmentapplicantdata/addsubject_view");									
							echo"</div>";
							echo"<div class='tab-pane ".$statcolleagues."' id='tabcolleagues'>";
								$this->load->view("recruitmentapplicantdata/addcolleagues_view");									
							echo"</div>";
						?>
					</div>
				</div>
			<div class="form-actions" style="text-align  : right !important;">
				<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
				<input type="submit" name="Save" id="Save" value="Save" class="btn green" title="Simpan Data">
			</div>
			<?php
				echo form_close();
			?>				
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>