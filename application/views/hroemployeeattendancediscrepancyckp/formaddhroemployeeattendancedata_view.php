<script>
	base_url = '<?php echo base_url();?>';
	mappia = "	<?php 
					$site_url = 'hroemployeeattendancedata/AddHROEmployeeAttendanceData/';
					echo site_url($site_url); 
				?>";

	function processAddArrayHROEmployeeAttendanceData(){
		
		var monthly_period_id 			= document.getElementById("monthly_period_id").value;

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('hroemployeeattendancedata/processAddArrayHROEmployeeAttendanceData');?>",
			  data: {
					'monthly_period_id'						: monthly_period_id,
					'session_name' 							: "addarraysalesinvoiceitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeattendancedata/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancedata/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeattendancedata/function_state_add');?>",
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
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancedata">
									Employee Attendance Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>hroemployeeattendancedata/AddHROEmployeeAttendanceData">
									Add Employee Attendance Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						Employee Attendance Data
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
									Form Add
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeattendancedata/processAddHROEmployeeAttendanceData',array('id' => 'myform', 'class' => 'horizontal-form')); 

										
									?>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('monthly_period_id', $payrollmonthlyperiod, set_value('monthly_period_id', $data['monthly_period_id']), 'id="monthly_period_id" class="form-control select2me" ');
												?>
												<label class="control-label">Payroll Monthly Period</label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12 " style="text-align  : right !important;">
											<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_all()"><i class="fa fa-times"></i> Reset</button>
										<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Save</button>	
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php echo form_close(); ?>

