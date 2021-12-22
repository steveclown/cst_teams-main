<script>
	base_url = '<?php base_url()?>';
	
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeperformance/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeperformance/function_state_add');?>",
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
					<a href="hroemployeeperformance">
						Employee Performance List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>hroemployeeperformance/detailHROEmployeePerformance">
						Detail Employee Performance
					</a>
				</li>
			</ul>
		</div>
		
		<h3 class="page-title">
			Form Employee Perfomance - <?php echo $hroemployeedata['employee_name'];?> -
		</h3>

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<?php 
	$employee_id = $this->uri->segment(3);	
	echo form_open('hroemployeeperformance/filter',array('id' => 'myform', 'class' => '')); 

?>
<?php
	$data=$this->session->userdata('filter-invtwarehouseoutrequisition');
	if(!is_array($data)){
		$data['start_date']				= date('d-m-Y');
		$data['end_date']				= date('d-m-Y');
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<input class="form-control" type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>"/>

							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">End Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division Name</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section Name</label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php echo form_close(); ?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeeperformance" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body  ">
				<?php
					$sesi 	= $this->session->userdata('unique');
					$auth	= $this->session->userdata('auth');
					$data 	= $this->session->userdata('addapplicantdata-'.$sesi['unique']);
				?>
				<div class="tabbable-line boxless tabbable-reversed ">
					<ul class="nav nav-tabs">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="hroemployeelate"){
								$tabemployeelate = "<li class='active'><a href='#tabemployeelate' name='hroemployeelate' data-toggle='tab' onClick='function_state_add(this.name);'><b>Late</b></a></li>";
							}else{
								$tabemployeelate = "<li><a href='#tabemployeelate' data-toggle='tab' name='hroemployeelate' onClick='function_state_add(this.name);'><b>Late</b></a></li>";
							}

							if($data['active_tab']=="hroemployeepermit"){
								$tabemployeepermit = "<li class='active'><a href='#tabemployeepermit' name='hroemployeepermit' data-toggle='tab' onClick='function_state_add(this.name)'><b>Permit</b></a></li>";
							}else{
								$tabemployeepermit = "<li><a href='#tabemployeepermit' data-toggle='tab' name='hroemployeepermit' onClick='function_state_add(this.name)'><b>Permit</b></a></li>";
							}

							if($data['active_tab']=="hroemployeeabsence"){
								$tabemployeeabsence = "<li class='active'><a href='#tabemployeeabsence' name='hroemployeeabsence' data-toggle='tab' onClick='function_state_add(this.name)'><b>Absence</b></a></li>";
							}else{
								$tabemployeeabsence = "<li><a href='#tabemployeeabsence' data-toggle='tab' name='hroemployeeabsence' onClick='function_state_add(this.name)'><b>Absence</b></a></li>";
							}

							if($data['active_tab']=="hroemployeehomeearly"){
								$tabemployeehomeearly = "<li class='active'><a href='#tabemployeehomeearly' name='hroemployeehomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Home Early</b></a></li>";
							}else{
								$tabemployeehomeearly = "<li><a href='#tabemployeehomeearly' name='hroemployeehomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Home Early</b></a></li>";
							}

							if($data['active_tab']=="hroemployeeworkingdayoff"){
								$tabemployeeworkingdayoff = "<li class='active'><a href='#tabemployeeworkingdayoff' name='hroemployeeworkingdayoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Day Off</b></a></li>";
							}else{
								$tabemployeeworkingdayoff = "<li><a href='#tabemployeeworkingdayoff' name='hroemployeeworkingdayoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Day Off</b></a></li>";
							}

							if($data['active_tab']=="payrollovertimerequest"){
								$tabovertimerequest = "<li class='active'><a href='#tabovertimerequest' name='payrollovertimerequest' data-toggle='tab' onClick='function_state_add(this.name)'>Overtime</a></li>";
							}else{
								$tabovertimerequest = "<li><a href='#tabovertimerequest' name='payrollovertimerequest' data-toggle='tab' onClick='function_state_add(this.name)'><b>Overtime</b></a></li>";
							}

							if($data['active_tab']=="payrollleaverequest"){
								$tableaverequest = "<li class='active'><a href='#tableaverequest' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Leave</b></a></li>";
							}else{
								$tableaverequest = "<li><a href='#tableaverequest' name='medical' data-toggle='tab' onClick='function_state_add(this.name)'><b>Leave</b></a></li>";
							}

							if($data['active_tab']=="hroemployeetransfer"){
								$tabemployeetransfer = "<li class='active'><a href='#tabemployeetransfer' name='hroemployeetransfer' data-toggle='tab' onClick='function_state_add(this.name)'><b>Transfer</b></a></li>";
							}else{
								$tabemployeetransfer = "<li><a href='#tabemployeetransfer' name='hroemployeetransfer' data-toggle='tab' onClick='function_state_add(this.name)'><b>Transfer</b></a></li>";
							}

							if($data['active_tab']=="payrollemployeemonthly"){
								$tabemployeemonthly = "<li class='active'><a href='#tabemployeemonthly' name='payrollemployeemonthly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Monthly</b></a></li>";
							}else{
								$tabemployeemonthly = "<li><a href='#tabemployeemonthly' name='payrollemployeemonthly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Monthly</b></a></li>";
							}
							
							echo $tabemployeelate;
							echo $tabemployeepermit;
							echo $tabemployeeabsence;
							echo $tabemployeehomeearly;
							echo $tabemployeeworkingdayoff;
							echo $tabovertimerequest;
							echo $tableaverequest;
							echo $tabemployeetransfer;			
							echo $tabemployeemonthly;				
						?>
					</ul>
					<div class="tab-content">
						<?php
							if($data['active_tab']=="" || $data['active_tab']=="hroemployeelate"){
								$statemployeelate = "active";
							}else{
								$statemployeelate = "";
							}

							if($data['active_tab']=="hroemployeepermit"){
								$statemployeepermit = "active";
							}else{
								$statemployeepermit = "";
							}

							if($data['active_tab']=="hroemployeeabsence"){
								$statemployeeabsence = "active";
							}else{
								$statemployeeabsence = "";
							}

							if($data['active_tab']=="hroemployeehomeearly"){
								$statemployeehomeearly = "active";
							}else{
								$statemployeehomeearly = "";
							}

							if($data['active_tab']=="hroemployeeworkingdayoff"){
								$statemployeeworkingdayoff = "active";
							}else{
								$statemployeeworkingdayoff = "";
							}

							if($data['active_tab']=="payrollovertimerequest"){
								$statovertimerequest = "active";
							}else{
								$statovertimerequest = "";
							}

							if($data['active_tab']=="payrollleaverequest"){
								$statleaverequest = "active";
							}else{
								$statleaverequest = "";
							}

							if($data['active_tab']=="hroemployeetransfer"){
								$statemployeetransfer = "active";
							}else{
								$statemployeetransfer = "";
							}

							if($data['active_tab']=="hroemployeemonthly"){
								$statemployeemonthly = "active";
							}else{
								$statemployeemonthly = "";
							}
							
							echo"<div class='tab-pane ".$statemployeelate."' id='tabemployeelate'>";
								$this->load->view("hroemployeeperformance/detailhroemployeelate_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeepermit."' id='tabemployeepermit'>";
								$this->load->view("hroemployeeperformance/detailhroemployeepermit_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeeabsence."' id='tabemployeeabsence'>";
								$this->load->view("hroemployeeperformance/detailhroemployeeabsence_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeehomeearly."' id='tabemployeehomeearly'>";
								$this->load->view("hroemployeeperformance/detailhroemployeehomeearly_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeeworkingdayoff."' id='tabemployeeworkingdayoff'>";
								$this->load->view("hroemployeeperformance/detailhroemployeeworkingdayoff_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statovertimerequest."' id='tabovertimerequest'>";
								$this->load->view("hroemployeeperformance/detailpayrollovertimerequest_view");
							echo"</div>";

							echo"<div class='tab-pane ".$statleaverequest."' id='tableaverequest'>";
								$this->load->view("hroemployeeperformance/detailpayrollleaverequest_view");									
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeetransfer."' id='tabemployeetransfer'>";
								$this->load->view("hroemployeeperformance/detailhroemployeetransfer_view");									
							echo"</div>";

							echo"<div class='tab-pane ".$statemployeemonthly."' id='tabemployeemonthly'>";
								$this->load->view("hroemployeeperformance/detailpayrollemployeemonthly_view");									
							echo"</div>";
						?>
					</div>
				</div>			
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>