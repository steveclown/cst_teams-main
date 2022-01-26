<script>
	function ulang(){
		document.getElementById("username").value = "<?php echo $result['username'] ?>";
		document.getElementById("user_group_id").value = "<?php echo $result['user_group_id'] ?>";
		document.getElementById("log_stat").value = "<?php echo $result['log_stat'] ?>";
	}
	
	function openform(){
		var a = document.getElementById("passwordf").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
			document.getElementById("password").value ='';
			document.getElementById("re_password").value ='';
		}
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('systemuser/function_elements_add');?>",
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
				url : "<?php echo site_url('systemuser/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$logstat = array('off'=>'off','on'=>'on');
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
					<a href="<?php echo base_url();?>systemuser">
						User List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>systemuser/resetPasswordSystemUser">
						Reset Password User
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<h3 class="page-title">
			Form Reset Password
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Reset
					</div>

					<div class="actions">
						<a href="<?php echo base_url();?>systemuser" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i>
							<span class="hidden-480">
								 Back
							</span>
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="region_name" id="region_name"  value="<?php echo $this->systemuser_model->getRegionName($systemuser['region_id']);?>" readonly/>
									<label class="control-label">Region Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="branch_name" id="branch_name"  value="<?php echo $this->systemuser_model->getBranchName($systemuser['branch_id']);?>" readonly/>
									<label class="control-label">Branch Name</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="location_name" id="location_name"  value="<?php echo $this->systemuser_model->getLocationName($systemuser['location_id']);?>" readonly/>
									<label class="control-label">Location Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="division_name" id="division_name"  value="<?php echo $this->systemuser_model->getDivisionName($systemuser['division_id']);?>" readonly/>
									<label class="control-label">Division Name</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="department_name" id="department_name"  value="<?php echo $this->systemuser_model->getDepartmentName($systemuser['department_id']);?>" readonly/>
									<label class="control-label">Department Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="section_name" id="section_name"  value="<?php echo $this->systemuser_model->getSectionName($systemuser['section_id']);?>" readonly/>
									<label class="control-label">Section Name</label>
								</div>
							</div>
						</div>	

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="username" id="username"  value="<?php echo $systemuser['username'];?>" readonly/>
									<label class="control-label">User Name</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="user_group_name" id="user_group_name"  value="<?php echo $this->systemuser_model->getUserGroupName($systemuser['user_group_id']);?>" readonly/>
									<label class="control-label">User Group Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="employee_employment_working_status" id="employee_employment_working_status"  value="<?php echo $this->configuration->WorkingStatus[$systemuser['employee_employment_working_status']];?>" readonly/>
									<label class="control-label">Working Status</label>
								</div>
							</div>
						</div>

						<input type="hidden" class="form-control" name="user_id" id="user_id"  value="<?php echo $systemuser['user_id'];?>" readonly/>

						<div class="form-actions right">
							<a class="btn red" data-toggle="modal" href="#modalresetpasswordsystemuser"><i class="fa fa-pencil"></i> Reset Password</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php echo form_open('systemuser/processResetPasswordSystemUser',array('id' => 'myform', 'class' => 'horizontal-form'));?>
<!-- /.modal -->
<script>
	$(document).ready(function(){
        $("#Save").click(function(){
			var reset_password_remark = $("#reset_password_remark").val();
			
		  	if(reset_password_remark!=''){
				return true;
			}else{
				alert('Please insert remark');
				return false;
			}
		});
    });
</script>

<div class="modal fade bs-modal-lg" id="modalresetpasswordsystemuser" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modalresetpasswordsystemuser">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<h3 class="modal-title">Reset Password</h3>
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<textarea rows="5" name="reset_password_remark" id="reset_password_remark" type="text" class="form-control
								"></textarea>
							</div>	
						</div>	
					</div>
					
					<input type="hidden" class="form-control" name="user_id" id="user_id"  value="<?php echo set_value('user_id',$systemuser['user_id']);?>"/>
					<input type="hidden" class="form-control" name="employee_id" id="employee_id"  value="<?php echo set_value('employee_id',$systemuser['employee_id']);?>"/>
					
					<div class="modal-footer">
						<button type="button" class="btn blue" data-dismiss="modal">Close</button>
						<button type="submit" id="Save" class="btn red"><i class="fa fa-check"></i> Save</button>
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