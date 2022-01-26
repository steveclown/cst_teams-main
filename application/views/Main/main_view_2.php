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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<?php 
	$selectedemployee=$this->session->userdata('selectedemployee');
	//session tab aktif
	$tabatas=$this->session->userdata('tabatas');
	$tabbawah=$this->session->userdata('tabbawah');
	// $tabatas="coverage";
	// $tabbawah="glassescoverage";
	
?>
<script>
function reload(value) {
	var employee_id = document.getElementById("employee_id").value;
	
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>main/setselectedindexsession",
	   data: {'employee_id' : employee_id},
	   success: function(data){
			window.location = "<?php echo base_url(); ?>main";
	   }
	});	
}
function setselectedtab(value) {
	// alert(value);
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>main/setselectedtab",
	   data: {'selectedtab' : value},
	   success: function(data){
	   }
	});	
}

</script>
<?php
	// $msg = "<div class='alert alert-success'>
	// Transaksional yang sudah : <br>
	// Coverage/Medical Claim <br>
	// Coverage/Glasses Claim <br>
	// Coverage/Hospital Claim <br>
	// Coverage/Medical Adjustment <br>
	// Coverage/Glasses Adjustment <br>
	// Coverage/Hospital Adjustment <br>
	// Award & Warning/Award</br>
	// Award & Warning/Warning</br>
	// <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
	// $this->session->set_userdata('message',$msg);
	// echo $this->session->userdata('message');
	// $this->session->unset_userdata('message');

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<!--
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					
				</div>
				<div class="actions">
					<a href="main/addemployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i>Add
					</a>
					<a data-toggle="modal" href="#mainfilter" class="btn default btn-sm">
						<i class="fa fa-search icon-black"></i>Search
					</a>
					<a href="main/reset_filter" class="btn default btn-sm">
						<i class="fa fa-search-minus icon-black"></i>Reset
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<div class="row">
	<!-- <div class="col-md-3">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Employee List
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-group">
					<select class="form-control" size="35" name="employee_id" id="employee_id" onChange="reload(this.value)">
						<?php 
						$employee_id = $this->session->userdata('employee_id');
						foreach ($listemployee as $key=>$val){ 
						?>
							echo"
							<option <?php if($val[employee_id]==$employee_id){echo 'selected="selected"'; }?> value="<?php echo $val[employee_id]; ?>"><?php echo $val[employee_name]; ?></option>
							";
						<?php 
						}
						?>
					</select>
				</div>
			</div>
		</div>
	</div> -->
<!-- </div>
<div class="row"> -->
	<!-- <div class="col-md-9"> -->
		<!-- BEGIN Portlet PORTLET-->
		<!-- <div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>General Information
				</div>
				<div class="actions">
					<a href="main/addemployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i> Add
					</a>
					<a data-toggle="modal" href="#mainsearch" class="btn default btn-sm">
						<i class="fa fa-search icon-black"></i> Search
					</a>
					<a data-toggle="modal" href="#mainfilter" class="btn default btn-sm">
						<i class="fa fa-glass icon-black"></i> Filter
					</a>
					
					<a href="main/newEmployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i> Add Employee
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-minus icon-black"></i> Delete
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-eye icon-black"></i> Find
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-glass icon-black"></i> Sort
					</a>
					
				</div>
			</div>
			<div class="portlet-body">
				<ul class="nav nav-tabs">
					<li <?php if($tabatas=='employee' || $tabatas==''){echo"class='active'";}?>>
						<a href="#tab_employee" id="tab_id_employee" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Employee
						</a>
					</li>
					<li <?php if($tabatas=='payroll'){echo"class='active'";}?>>
						<a href="#tab_payroll" id="tab_id_payroll" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Payroll
						</a>
					</li>
					<li <?php if($tabatas=='coverage'){echo"class='active'";}?>>
						<a href="#tab_coverage" id="tab_id_coverage" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Coverage
						</a>
					</li>
					<li <?php if($tabatas=='competencies'){echo"class='active'";}?>>
						<a href="#tab_competencies" id="tab_id_competencies" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Competencies
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div <?php if($tabatas=='employee' || $tabatas==''){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_employee">
						<ul class="nav nav-tabs">
							<li <?php if($tabbawah=='employment' || $tabbawah=='' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='insurance' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='active'";}?>>
								<a href="#tab_content_employment" id="tab_id_employment" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Employment
								</a>
							</li>
							<li <?php if($tabbawah=='organization'){echo"class='active'";}?>>
								<a href="#tab_content_organization" id="tab_id_organization" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Organization
								</a>
							</li>
							<li <?php if($tabbawah=='leave'){echo"class='active'";}?>>
								<a href="#tab_content_leave" id="tab_id_leave" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Leave
								</a>
							</li>
							<li <?php if($tabbawah=='asset'){echo"class='active'";}?>>
								<a href="#tab_content_asset" id="tab_id_asset" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Asset
								</a>
							</li>
							<li <?php if($tabbawah=='salaryhistory'){echo"class='active'";}?>>
								<a href="#tab_content_salaryhistory" id="tab_id_salaryhistory" onclick="setselectedtab(this.id)" data-toggle="tab">
									Salary History
								</a>
							</li>
							<li <?php if($tabbawah=='personaldata'){echo"class='active'";}?>>
								<a href="#tab_content_personaldata" id="tab_id_personaldata" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Personal Data
								</a>
							</li>
							<li <?php if($tabbawah=='familydata'){echo"class='active'";}?>>
								<a href="#tab_content_familydata" id="tab_id_familydata" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Family
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div <?php if($tabbawah=='employment' || $tabbawah=='' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='insurance' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_employment">
								<?php 
									$this->load->view('main/employment',$data);
								?>
							</div>
							<div <?php if($tabbawah=='organization'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_organization">
								<?php 
									$this->load->view('main/organization',$data);
								?>
							</div>
							<div <?php if($tabbawah=='leave'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_leave">
								<?php 
									 $this->load->view('main/leave',$data);
								?>
							</div>
							<div <?php if($tabbawah=='asset'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_asset">
								<?php 
									 $this->load->view('main/asset',$data);
								?>
							</div>
							<div <?php if($tabbawah=='salaryhistory'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_salaryhistory">
								<?php 
									$this->load->view('main/salaryhistory',$data);
								?>
							</div>
							<div <?php if($tabbawah=='personaldata'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_personaldata">
								<?php 
									$this->load->view('main/personaldata',$data);
								?>
							</div>
							<div <?php if($tabbawah=='familydata'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_familydata">
								<?php 
									$this->load->view('main/familydata',$data);
								?>
							</div>
						</div>
					</div>
					<div <?php if($tabatas=='payroll'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_payroll">
						<ul class="nav nav-tabs">
							<li <?php if($tabbawah=='payment' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='active'";}?>>
								<a href="#tab_content_payment" id="tab_id_payment" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Payment
								</a>
							</li>
							<li <?php if($tabbawah=='allowance'){echo"class='active'";}?>>
								<a href="#tab_content_allowance" id="tab_id_allowance" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Allowances
								</a>
							</li>
							<li <?php if($tabbawah=='deduction'){echo"class='active'";}?>>
								<a href="#tab_content_deduction" id="tab_id_deduction" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Deduction
								</a>
							</li>
							<li <?php if($tabbawah=='loan'){echo"class='active'";}?>>
								<a href="#tab_content_loan" id="tab_id_loan" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Loan
								</a>
							</li>
							<li <?php if($tabbawah=='insurance'){echo"class='active'";}?>>
								<a href="#tab_content_insurance" id="tab_id_insurance" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Insurance
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div <?php if($tabbawah=='payment' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_payment">
								<?php 
									$this->load->view('main/payment',$data);
								?>
							</div>
							<div <?php if($tabbawah=='allowance'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_allowance">
								<?php 
									$this->load->view('main/allowance',$data);
								?>
							</div>
							<div <?php if($tabbawah=='deduction'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_deduction">
								<?php 
									$this->load->view('main/deduction',$data);
								?>
							</div>
							<div <?php if($tabbawah=='loan'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_loan">
								<?php 
									// $this->load->view('main/loan',$data);
								?>
							</div>
							<div <?php if($tabbawah=='insurance'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_insurance">
								<?php 
									$this->load->view('main/insurance',$data);
								?>
							</div>
						</div>
					</div>
					<div <?php if($tabatas=='coverage'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_coverage">
						<ul class="nav nav-tabs">
							<li <?php if($tabbawah=='medicalcoverage' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='loan' || $tabbawah=='insurance' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='active'";}?>>
								<a href="#tab_content_medicalcoverage" id="tab_id_medicalcoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Medical
								</a>
							</li>
							<li <?php if($tabbawah=='glassescoverage'){echo"class='active'";}?>>
								<a href="#tab_content_glassescoverage" id="tab_id_glassescoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Glasses
								</a>
							</li>
							<li <?php if($tabbawah=='hospitalcoverage'){echo"class='active'";}?>>
								<a href="#tab_content_hospitalcoverage" id="tab_id_hospitalcoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Hospital
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div <?php if($tabbawah=='medicalcoverage' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='loan' || $tabbawah=='insurance' || $tabbawah=='education' || $tabbawah=='expertise' || $tabbawah=='language' || $tabbawah=='workingexperience'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_medicalcoverage">
								<?php 
									$this->load->view('main/medicalcoverage',$data);
								?>
							</div>
							<div <?php if($tabbawah=='glassescoverage'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_glassescoverage">
								<?php 
									$this->load->view('main/glassescoverage',$data);
								?>
							</div>
							<div <?php if($tabbawah=='hospitalcoverage'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_hospitalcoverage">
								<?php 
									$this->load->view('main/hospitalcoverage',$data);
								?>
							</div>
						</div>
					</div>
					<div <?php if($tabatas=='competencies'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_competencies">
						<ul class="nav nav-tabs">
							<li <?php if($tabbawah=='education' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='loan' || $tabbawah=='insurance' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage'){echo"class='active'";}?>>
								<a href="#tab_content_education" id="tab_id_education" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Education
								</a>
							</li>
							<li <?php if($tabbawah=='expertise'){echo"class='active'";}?>>
								<a href="#tab_content_expertise" id="tab_id_expertise" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Expertise
								</a>
							</li>
							<li <?php if($tabbawah=='language'){echo"class='active'";}?>>
								<a href="#tab_content_language" id="tab_id_language" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Language
								</a>
							</li>
							<li <?php if($tabbawah=='workingexperience'){echo"class='active'";}?>>
								<a href="#tab_content_workingexperience" id="tab_id_workingexperience" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Experience
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div <?php if($tabbawah=='education' || $tabbawah=='' || $tabbawah=='employment' || $tabbawah=='organization' || $tabbawah=='leave' || $tabbawah=='salaryhistory' || $tabbawah=='personaldata' || $tabbawah=='familydata' || $tabbawah=='payment' || $tabbawah=='allowance' || $tabbawah=='deduction' || $tabbawah=='loan' || $tabbawah=='insurance' || $tabbawah=='medicalcoverage' || $tabbawah=='hospitalcoverage' || $tabbawah=='glassescoverage'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_education">
								<?php 
									$this->load->view('main/education',$data);
								?>
							</div>
							<div <?php if($tabbawah=='expertise'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_expertise">
								<?php 
									$this->load->view('main/expertise',$data);
								?>
							</div>
							<div <?php if($tabbawah=='language'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_language">
								<?php 
									$this->load->view('main/language',$data);
								?>
							</div>
							<div <?php if($tabbawah=='workingexperience'){echo"class='tab-pane fade active in'";}else{echo"class='tab-pane fade'";}?> id="tab_content_workingexperience">
								<?php 
									$this->load->view('main/workingexperience',$data);
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Portlet PORTLET-->
	<!-- </div> -->
</div>

<!-- BEGIN FORM-->
<?php
	echo form_open('main/filter',array('id' => 'myform', 'class' => 'horizontal-form'));
	$sesi=$this->session->userdata('filter-employee');
	if(!is_array($sesi)){
		$sesi['filter_employee_name'] ='';
		$sesi['sort_employee_name'] ='';
	}
?>
	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="mainsearch" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Search Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Employee Name</label>
							<input type="text" autocomplete="off"  name="filter_employee_name" id="filter_employee_name" class="form-control" placeholder="Name" value="<?php echo $sesi['filter_employee_name'];?>">
						</div>
					</div>
				<div class="modal-footer">
					<a href="main/reset_filter" class="btn red">
						<i class="fa fa-times"></i> Reset Search
					</a>
					<button type="submit" class="btn blue"><i class="fa fa-search"></i> Search Data</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->

	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="mainfilter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Filter Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label>Employee Name</label>
							<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios4" value="asc" <?php if($sesi[sort_employee_name]=='asc'){echo 'checked';}?>> Ascending </label>
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios5" value="desc" <?php if($sesi[sort_employee_name]=='desc'){echo 'checked';}?>> Descending </label>
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios6" value="" <?php if($sesi[sort_employee_name]==''){echo 'checked';}?>> None </label>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<a href="main/reset_filter" class="btn red">
						<i class="fa fa-times"></i> Reset Filter
					</a>
					<button type="submit" class="btn blue"><i class="fa fa-search"></i> Filter Data</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->
<?php
echo form_close(); 
?>