<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit(){
		document.location = base_url+"hroemployeedatailufa/reset_edit/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_elements_edit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_edit(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_state_edit');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	$unique 	= $this->session->userdata('unique');

	$data 		= $this->session->userdata('edithroemployeedatailufa-'.$unique['unique']);
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
								<a href="<?php echo base_url();?>hroemployeedatailufa">
									Employee Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeedatailufa/editHROEmployeeData/<?php echo $hroemployeedata['employee_id']?>">
									Edit Employee Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Employee Data
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			
<?php
	echo form_open('hroemployeedatailufa/processEditHROEmployeeData', array('id' => 'myform', 'class' => 'horizontal-form')); 
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Edit
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeedatailufa" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>	
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$tabemployeeorganization = "<li class='active'><a href='#tabemployeeorganization' name='employeeorganization' data-toggle='tab' onClick='function_state_edit(this.name);'><b>Organization</b></a></li>";
								}else{
									$tabemployeeorganization = "<li><a href='#tabemployeeorganization' data-toggle='tab' name='employeeorganization' onClick='function_state_edit(this.name);'><b>Organization</b></a></li>";
								}

								if($data['active_tab']=="employeepersonal"){
									$tabemployeepersonal = "<li class='active'><a href='#tabemployeepersonal' name='employeepersonal' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Personal</b></a></li>";
								}else{
									$tabemployeepersonal = "<li><a href='#tabemployeepersonal' data-toggle='tab' name='employeepersonal' onClick='function_state_edit(this.name)'><b>Personal</b></a></li>";
								}

								if($data['active_tab']=="employeeworking"){
									$tabemployeeworking = "<li class='active'><a href='#tabemployeeworking' name='employeeworking' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Working Status</b></a></li>";
								}else{
									$tabemployeeworking = "<li><a href='#tabemployeeworking' data-toggle='tab' name='employeeworking' onClick='function_state_edit(this.name)'><b>Working Status</b></a></li>";
								}

								if($data['active_tab']=="employeefamily"){
									$tabemployeefamily = "<li class='active'><a href='#tabemployeefamily' name='employeefamily' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Family</b></a></li>";
								}else{
									$tabemployeefamily = "<li><a href='#tabemployeefamily' name='employeefamily' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Family</b></a></li>";
								}

								if($data['active_tab']=="employeeeducation"){
									$tabemployeeeducation = "<li class='active'><a href='#tabemployeeeducation' name='employeeeducation' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Education</b></a></li>";
								}else{
									$tabemployeeeducation = "<li><a href='#tabemployeeeducation' name='employeeeducation' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Education</b></a></li>";
								}

								if($data['active_tab']=="employeeexpertise"){
									$tabemployeeexpertise = "<li class='active'><a href='#tabemployeeexpertise' name='employeeexpertise' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Expertise</b></a></li>";
								}else{
									$tabemployeeexpertise = "<li><a href='#tabemployeeexpertise' name='employeeexpertise' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Expertise</b></a></li>";
								}

								if($data['active_tab']=="employeeexperience"){
									$tabemployeeexperience = "<li class='active'><a href='#tabemployeeexperience' name='employeeexperience' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Experience</b></a></li>";
								}else{
									$tabemployeeexperience = "<li><a href='#tabemployeeexperience' name='employeeexperience' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Experience</b></a></li>";
								}

								if($data['active_tab']=="employeelanguage"){
									$tabemployeelanguage = "<li class='active'><a href='#tabemployeelanguage' name='employeelanguage' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Language</b></a></li>";
								}else{
									$tabemployeelanguage = "<li><a href='#tabemployeelanguage' name='employeelanguage' data-toggle='tab' onClick='function_state_edit(this.name)'><b>Language</b></a></li>";
								}
								
								echo $tabemployeeorganization;
								echo $tabemployeepersonal;
								echo $tabemployeeworking;
								echo $tabemployeefamily;
								echo $tabemployeeeducation;
								echo $tabemployeeexpertise;
								echo $tabemployeeexperience;
								echo $tabemployeelanguage;

							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$statemployeeorganization = "active";
								}else{
									$statemployeeorganization = "";
								}

								if($data['active_tab']=="employeepersonal"){
									$statemployeepersonal = "active";
								}else{
									$statemployeepersonal = "";
								}

								if($data['active_tab']=="employeeworking"){
									$statemployeeworking = "active";
								}else{
									$statemployeeworking = "";
								}

								if($data['active_tab']=="employeefamily"){
									$statemployeefamily = "active";
								}else{
									$statemployeefamily = "";
								}

								if($data['active_tab']=="employeeeducation"){
									$statemployeeeducation = "active";
								}else{
									$statemployeeeducation = "";
								}

								if($data['active_tab']=="employeeexpertise"){
									$statemployeeexpertise = "active";
								}else{
									$statemployeeexpertise = "";
								}

								if($data['active_tab']=="employeeexperience"){
									$statemployeeexperience = "active";
								}else{
									$statemployeeexperience = "";
								}

								if($data['active_tab']=="employeelanguage"){
									$statemployeelanguage = "active";
								}else{
									$statemployeelanguage = "";
								}
								
								echo"<div class='tab-pane ".$statemployeeorganization."' id='tabemployeeorganization'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeeorganization_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeepersonal."' id='tabemployeepersonal'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeepersonal_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeworking."' id='tabemployeeworking'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeeworking_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeefamily."' id='tabemployeefamily'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeefamily_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeeducation."' id='tabemployeeeducation'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeeeducation_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeexpertise."' id='tabemployeeexpertise'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeeexpertise_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeexperience."' id='tabemployeeexperience'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeeexperience_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeelanguage."' id='tabemployeelanguage'>";
									$this->load->view("hroemployeedatailufa/formedithroemployeelanguage_view");
								echo"</div>";
							?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_edit()"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Save</button>	
						</div>
					</div>
				</div>
			</div>

			<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedatailufa['employee_id'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
