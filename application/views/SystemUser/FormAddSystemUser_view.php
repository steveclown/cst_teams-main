<script>
	function ulang(){
		document.getElementById("username").value = "";
		document.getElementById("password").value = "";
		document.getElementById("user_group_id").value = "";
	}

	base_url = '<?php echo base_url();?>';

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id = $("#region_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>SystemUser/getCoreBranch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);				   
               }
            });			
        });
    });

    $(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>SystemUser/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);				   
               }
            });			
        });
    });

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>SystemUser/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });			
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>SystemUser/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
        	var region_id 		= $("#region_id").val();
        	var branch_id 		= $("#branch_id").val();
        	var location_id 	= $("#location_id").val();
        	var division_id 	= $("#division_id").val();
            var department_id 	= $("#department_id").val();
            var section_id 		= $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>SystemUser/getHROEmployeeData",
               data : {region_id: region_id, branch_id: branch_id, location_id: location_id, division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('SystemUser/function_elements_add');?>",
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
				url : "<?php echo site_url('SystemUser/function_state_add');?>",
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
					<a href="<?php echo base_url();?>SystemUser">
						User List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>SystemUser/AddSystemUser">
						Add User
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
			Form Add User 
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->
	
<?php	
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addsystemuser');

	$auth = $this->session->userdata('auth');

	$user_group_id = $auth['user_group_level'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>

				<div class="actions">
					<a href="<?php echo base_url();?>SystemUser" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
						</span>
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
						echo form_open_multipart('SystemUser/processAddSystemUser',array('id' => 'myform','class' => 'horizontal-form'));
					?>		
					<div class= "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('user_group_id', $systemusergroup ,set_value('user_group_id',$data['user_group_id']),'id="user_group_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Group User Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>	
					</div>

					<?php if($user_group_id == 1){ ?>
						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('region_id', $coreregion ,set_value('region_id',$data['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
									<label class="control-label">Region Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>	
						</div>

						<div class= "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<select name="branch_id" id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose One--</option>
									</select>
									<label class="control-label">Branch Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>	

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<select name="location_id" id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose One--</option>
									</select>
									<label class="control-label">Location Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>	
						</div>
					<?php } ?>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('division_id', $coredivision ,set_value('division_id',$data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Division Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>	
					</div>

					<div class= "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Department Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>	

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Section Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>	
					</div>

					<div class= "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Employee Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>	
						<div class="col-md-4">
							<div class="form-group form-md-line-input">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; max-width: 200px; max-height: 150px;">
										<img src="<?php echo base_url().'assets/img/200X150_no_image.png'?>" alt=""/>										
									</div>									
									<div>
										<span class="btn default btn-file">
											<span class="fileinput-new">
													Pilih Gambar
											</span>
											<span class="fileinput-exists">
													Ganti
											</span>
											<input type="file" name="user_photo">
										</span>
										<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
												Hapus
										</a>
									</div>
								</div>

								<label>Upload Avatar <span class="required">*maks size 1 MB</span></label>
							</div>
						</div>
					</div>
					

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="username" id="username"  value="<?php echo set_value('username',$data['username']);?>"/>
								<label class="control-label">User Name</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="password" id="password"  value="<?php echo set_value('password',$data['password']);?>"/>
								<label class="control-label">Password</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
