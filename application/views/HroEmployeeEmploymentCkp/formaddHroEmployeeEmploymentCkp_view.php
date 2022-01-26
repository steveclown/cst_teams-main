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
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>


					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeEmploymentCkp">
									Daftar Pekerjaan karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeEmploymentCkp/addHROEmployeeEmployment/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Pekerjaan karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Pekerjaan karyawan - <?php echo $hroemployeedata['employee_name'];?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Data Karyawan
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
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Devisi</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Bagian </label>
							</div>	
						</div>
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
					Form Tambah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>HroEmployeeEmploymentCkp" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
						$unique 	= $this->session->userdata('unique');
						$auth		= $this->session->userdata('auth');
						$data 		= $this->session->userdata('addHroEmployeeEmploymentCkp-'.$unique['unique']);

						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeaward"){
									$tabemployeeaward = "<li class='active'><a href='#tabemployeeaward' name='employeeaward' data-toggle='tab' onClick='function_state_add(this.name);'><b>Perhargaan Karyawan</b></a></li>";
								}else{
									$tabemployeeaward = "<li><a href='#tabemployeeaward' data-toggle='tab' name='employeeaward' onClick='function_state_add(this.name);'><b>Perhargaan Karyawan </b></a></li>";
								}

								if($data['active_tab']=="employeewarning"){
									$tabemployeewarning = "<li class='active'><a href='#tabemployeewarning' name='employeewarning' data-toggle='tab' onClick='function_state_add(this.name)'><b>Peringatan karyawan</b></a></li>";
								}else{
									$tabemployeewarning = "<li><a href='#tabemployeewarning' data-toggle='tab' name='employeewarning' onClick='function_state_add(this.name)'><b>Peringatan karyawan</b></a></li>";
								}

								if($data['active_tab']=="employeesuspend"){
									$tabemployeesuspend = "<li class='active'><a href='#tabemployeesuspend' name='employeesuspend' data-toggle='tab' onClick='function_state_add(this.name)'><b>Karyawan Tangguhkan</b></a></li>";
								}else{
									$tabemployeesuspend = "<li><a href='#tabemployeesuspend' data-toggle='tab' name='employeesuspend' onClick='function_state_add(this.name)'><b>karyawan Tangguhkan</b></a></li>";
								}

								if($data['active_tab']=="employeeleaverequest"){
									$tabemployeeleaverequest = "<li class='active'><a href='#tabemployeeleaverequest' name='employeeleaverequest' data-toggle='tab' onClick='function_state_add(this.name)'><b>Cuti Karyawan</b></a></li>";
								}else{
									$tabemployeeleaverequest = "<li><a href='#tabemployeeleaverequest' name='employeeleaverequest' data-toggle='tab' onClick='function_state_add(this.name)'><b>Cuti Karyawan </b></a></li>";
								}

								if($data['active_tab']=="employeeworkaccident"){
									$tabemployeeworkaccident = "<li class='active'><a href='#tabemployeeworkaccident' name='employeeworkaccident' data-toggle='tab' onClick='function_state_add(this.name)'><b>Kecelakaan Kerja Karyawan</b></a></li>";
								}else{
									$tabemployeeworkaccident = "<li><a href='#tabemployeeworkaccident' name='employeeworkaccident' data-toggle='tab' onClick='function_state_add(this.name)'><b>Kecelakaan Kerja Karyawan</b></a></li>";
								}

								if($data['active_tab']=="employeeseparation"){
									$tabemployeeseparation = "<li class='active'><a href='#tabemployeeseparation' name='employeeseparation' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pemisahan Karyawan</b></a></li>";
								}else{
									$tabemployeeseparation = "<li><a href='#tabemployeeseparation' name='employeeseparation' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pemisahan Karyawan </b></a></li>";
								}
								
								echo $tabemployeeaward;
								echo $tabemployeewarning;
								echo $tabemployeesuspend;
								echo $tabemployeeleaverequest;
								echo $tabemployeeworkaccident;
								echo $tabemployeeseparation;

							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeaward"){
									$statemployeeaward = "active";
								}else{
									$statemployeeaward = "";
								}

								if($data['active_tab']=="employeewarning"){
									$statemployeewarning = "active";
								}else{
									$statemployeewarning = "";
								}

								if($data['active_tab']=="employeesuspend"){
									$statemployeesuspend = "active";
								}else{
									$statemployeesuspend = "";
								}

								if($data['active_tab']=="employeeleaverequest"){
									$statemployeeleaverequest = "active";
								}else{
									$statemployeeleaverequest = "";
								}

								if($data['active_tab']=="employeeworkaccident"){
									$statemployeeworkaccident = "active";
								}else{
									$statemployeeworkaccident = "";
								}

								if($data['active_tab']=="employeeseparation"){
									$statemployeeseparation = "active";
								}else{
									$statemployeeseparation = "";
								}
								
								echo"<div class='tab-pane ".$statemployeeaward."' id='tabemployeeaward'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddhroemployeeaward_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeewarning."' id='tabemployeewarning'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddhroemployeewarning_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeesuspend."' id='tabemployeesuspend'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddhroemployeesuspend_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeleaverequest."' id='tabemployeeleaverequest'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddpayrollleaverequest_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeworkaccident."' id='tabemployeeworkaccident'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddhroemployeeworkaccident_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeseparation."' id='tabemployeeseparation'>";
									$this->load->view("HroEmployeeEmploymentCkp/formaddhroemployeeseparation_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
