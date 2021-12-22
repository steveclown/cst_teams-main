<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"PayrollEmployeeAdditionalCkp/reset_add/";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollEmployeeAdditionalCkp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollEmployeeAdditionalCkp/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>

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
								<a href="<?php echo base_url();?>PayrollEmployeeAdditionalCkp">
									Daftar Gaji Tambahan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>PayrollEmployeeAdditionalCkp/addPayrollEmployeeAdditional/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Gaji Tambahan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Tambah Gaji Tambahan Karyawan - <?php echo $hroemployeedata['employee_name'];?> -
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Tambahan Karyawan
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
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_name" id="division_name" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Devisi</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Bagian </label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addPayrollEmployeeAdditionalCkp-'.$unique['unique']);
?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>PayrollEmployeeAdditionalCkp" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Kembali
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

								if($data['active_tab']=="" || $data['active_tab']=="payrolldelivery"){
									$tabpayrolldelivery = "<li class='active'><a href='#tabpayrolldelivery' name='payrolldelivery' data-toggle='tab' onClick='function_state_add(this.name)'><b>Pengiriman</b></a></li>";
								}else{
									$tabpayrolldelivery = "<li><a href='#tabpayrolldelivery' data-toggle='tab' name='payrolldelivery' onClick='function_state_add(this.name)'><b>Pengiriman</b></a></li>";
								}

								if($data['active_tab']=="payrolldeduction"){
									$tabpayrolldeduction = "<li class='active'><a href='#tabpayrolldeduction' name='payrolldeduction' data-toggle='tab' onClick='function_state_add(this.name)'><b>Potongan</b></a></li>";
								}else{
									$tabpayrolldeduction = "<li><a href='#tabpayrolldeduction' data-toggle='tab' name='payrolldeduction' onClick='function_state_add(this.name)'><b>Potongan</b></a></li>";
								}

								if($data['active_tab']=="payrollovertime"){
									$tabpayrollovertime = "<li class='active'><a href='#tabpayrollovertime' name='payrollovertime' data-toggle='tab' onClick='function_state_add(this.name)'><b>Lembur</b></a></li>";
								}else{
									$tabpayrollovertime = "<li><a href='#tabpayrollovertime' data-toggle='tab' name='payrollovertime' onClick='function_state_add(this.name)'><b>Lembur</b></a></li>";
								}
								
								echo $tabpayrolldelivery;
								echo $tabpayrolldeduction;
								echo $tabpayrollovertime;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="payrolldelivery"){
									$statpayrolldelivery = "active";
								}else{
									$statpayrolldelivery = "";
								}

								if($data['active_tab']=="payrolldeduction"){
									$statpayrolldeduction = "active";
								}else{
									$statpayrolldeduction = "";
								}

								if($data['active_tab']=="payrollovertime"){
									$statpayrollovertime = "active";
								}else{
									$statpayrollovertime = "";
								}
								
								echo"<div class='tab-pane ".$statpayrolldelivery."' id='tabpayrolldelivery'>";
									$this->load->view("PayrollEmployeeAdditionalCkp/FormAddPayrollEmployeeDelivery_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrolldeduction."' id='tabpayrolldeduction'>";
									$this->load->view("PayrollEmployeeAdditionalCkp/FormAddPayrollEmployeeDeduction_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollovertime."' id='tabpayrollovertime'>";
									$this->load->view("PayrollEmployeeAdditionalCkp/FormAddPayrollEmployeeOvertime_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			