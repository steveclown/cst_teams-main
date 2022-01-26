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
		document.location = base_url+"HroEmployeeAdministrationCkp/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAdministrationCkp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAdministrationCkp/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>
<?php 
	$year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i=($year_now-2); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 
?>

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
								<a href="<?php echo base_url();?>HroEmployeeAdministrationCkp">
									Daftar Administrasi Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAdministrationCkp/editHROEmployeeAdministration/<?php echo $hroemployeedata['employee_id']?>">
									Perbaharui Administrasi Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Perbarui Administrasi Karyawan - <?php echo $hroemployeedata['employee_name'];?> -
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
								<label class="control-label">Nama Karyawan </label>
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
					Form Pembaharuan
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>HroEmployeeAdministrationCkp" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								$unique 	= $this->session->userdata('unique');

								$data 		= $this->session->userdata('addHroEmployeeAdministrationCkp-'.$unique['unique']);

								if($data['active_tab']=="" || $data['active_tab']=="employeelastdayoff"){
									$tabemployeelastdayoff = "<li class='active'><a href='#tabemployeelastdayoff' name='employeelastdayoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Hari Terakhir Libur Pegawai</b></a></li>";
								}else{
									$tabemployeelastdayoff = "<li><a href='#tabemployeelastdayoff' data-toggle='tab' name='employeelastdayoff' onClick='function_state_add(this.name)'><b>Hari Terakhir Libur Pegawai</b></a></li>";
								}

								if($data['active_tab']=="employeechangerfid"){
									$tabemployeechangerfid = "<li class='active'><a href='#tabemployeechangerfid' name='employeechangerfid' data-toggle='tab' onClick='function_state_add(this.name)'><b>Ubah Kode RFID </b></a></li>";
								}else{
									$tabemployeechangerfid = "<li><a href='#tabemployeechangerfid' data-toggle='tab' name='employeechangerfid' onClick='function_state_add(this.name)'><b>Ubah Kode RFID</b></a></li>";
								}

								if($data['active_tab']=="employeereschedule"){
									$tabemployeereschedule = "<li class='active'><a href='#tabemployeereschedule' name='employeereschedule' data-toggle='tab' onClick='function_state_add(this.name)'><b>Penjadwalan Ulang Karyawan</b></a></li>";
								}else{
									$tabemployeereschedule = "<li><a href='#tabemployeereschedule' name='employeereschedule' data-toggle='tab' onClick='function_state_add(this.name)'><b>Penjadwalan Ulang Karyawan</b></a></li>";
								}

								if($data['active_tab']=="employeeupdatedayoff"){
									$tabemployeeupdatedayoff = "<li class='active'><a href='#tabemployeeupdatedayoff' name='employeeupdatedayoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pembaruan Libur Karyawan</b></a></li>";
								}else{
									$tabemployeeupdatedayoff = "<li><a href='#tabemployeeupdatedayoff' name='employeeupdatedayoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pembaruan Libur Karyawan</b></a></li>";
								}
								
								echo $tabemployeelastdayoff;
								echo $tabemployeechangerfid;
								echo $tabemployeereschedule;
								echo $tabemployeeupdatedayoff;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeelastdayoff"){
									$statemployeelastdayoff = "active";
								}else{
									$statemployeelastdayoff = "";
								}

								if($data['active_tab']=="employeechangerfid"){
									$statemployeechangerfid = "active";
								}else{
									$statemployeechangerfid = "";
								}

								if($data['active_tab']=="employeereschedule"){
									$statemployeereschedule = "active";
								}else{
									$statemployeereschedule = "";
								}

								if($data['active_tab']=="employeeupdatedayoff"){
									$statemployeeupdatedayoff = "active";
								}else{
									$statemployeeupdatedayoff = "";
								}

								echo"<div class='tab-pane ".$statemployeelastdayoff."' id='tabemployeelastdayoff'>";
									$this->load->view("HroEmployeeAdministrationCkp/formeditHroEmployeeLastDayOff_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeechangerfid."' id='tabemployeechangerfid'>";
									$this->load->view("HroEmployeeAdministrationCkp/formeditHroEmployeeChangerfid_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeereschedule."' id='tabemployeereschedule'>";
									$this->load->view("HroEmployeeAdministrationCkp/formeditHroEmployeeReschedule_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeupdatedayoff."' id='tabemployeeupdatedayoff'>";
									$this->load->view("HroEmployeeAdministrationCkp/formeditHroEmployeeUpdateDayoff_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
