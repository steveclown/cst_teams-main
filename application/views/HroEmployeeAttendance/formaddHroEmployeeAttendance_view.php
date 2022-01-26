<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"HroEmployeeAttendance/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendance/function_elements_add');?>",
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
				url : "<?php echo site_url('HroEmployeeAttendance/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo form_open('HroEmployeeAttendance/processAddHROEmployeeAttendance',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addarrayHroEmployeeAttendance-'.$unique['unique']);
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
								<a href="<?php echo base_url();?>HroEmployeeAttendance">
									Daftar Kehadiran Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>HroEmployeeAttendance/AddHROEmployeeAttendance/<?php echo $data['employee_id']?>">
									Tambah Kehadiran Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						 Kehadiran Karyawan
					</h1>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $data['employee_rfid_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" autofocus>
												<label class="control-label">Kode RFID Karyawan</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<h3 class="form-section" ><b><?php echo $data['employee_name']?></b></h3>
										</div>
									</div>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
		