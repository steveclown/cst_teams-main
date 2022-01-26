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
					<a href="<?php echo base_url();?>SystemUser">
						User List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>SystemUser/editSystemUser">
						Edit User
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<h3 class="page-title">
			Form Edit User 
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
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
							echo form_open_multipart('SystemUser/processEditSystemUser',array('id' => 'myform','class' => 'horizontal-form')); 
						?>	

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="region_name" id="region_name"  value="<?php echo $this->SystemUser_model->getRegionName($systemuser['region_id']);?>" readonly/>
									<label class="control-label">Region Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="branch_name" id="branch_name"  value="<?php echo $this->SystemUser_model->getBranchName($systemuser['branch_id']);?>" readonly/>
									<label class="control-label">Branch Name</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="location_name" id="location_name"  value="<?php echo $this->SystemUser_model->getLocationName($systemuser['location_id']);?>" readonly/>
									<label class="control-label">Location Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="division_name" id="division_name"  value="<?php echo $this->SystemUser_model->getDivisionName($systemuser['division_id']);?>" readonly/>
									<label class="control-label">Division Name</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="department_name" id="department_name"  value="<?php echo $this->SystemUser_model->getDepartmentName($systemuser['department_id']);?>" readonly/>
									<label class="control-label">Department Name</label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" name="section_name" id="section_name"  value="<?php echo $this->SystemUser_model->getSectionName($systemuser['section_id']);?>" readonly/>
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
							<div class="col-md-2">
								<div class="form-group form-md-line-input">
									<div class="fileinput fileinput-new" data-provides="fileinput">		
										<div class="fileinput-preview" style="width: 200px; height: 150px; max-width: 200px; max-height: 150px;">
											<!-- <img src="<?php echo base_url().'assets/img/200X150_no_image.png'?>" alt=""/> -->
										<?php if(!empty($systemuser['avatar'])){?>							
											<img src="<?php echo base_url().'img/user_photo/'.$systemuser['avatar'].''?>" alt="avatar" width='100' height='95'/>									
										<?php }else{ ?>
											<img src="<?php echo base_url().'img/user_photo/default_profile.png'?>" alt="avatar" width='100' height='95'/>									
										
										<?php } ?>
										</div>	
										<label>Avatar Lama</label>	
									</div>									
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group form-md-line-input">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; max-width: 200px; max-height: 150px;">
											<img src="<?php echo base_url().'assets/img/200X150_no_image.png'?>" alt=""/>										
										</div>
										<!-- <img src="<?php echo base_url().'img/user_photo/'.$systemuser['avatar'].''?>" alt="" width='100' height='95'/> -->
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

									<label>Upload Avatar Baru<span class="required">*maks size 1 MB</span></label>
								</div>
							</div>
						</div>


						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('user_group_id', $systemusergroup ,set_value('user_group_id',$systemuser['user_group_id']),'id="user_group_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label class="control-label">Group User Name
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$systemuser['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label class="control-label">Working Status
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('user_status', $userstatus ,set_value('user_status',$systemuser['user_status']),'id="user_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label class="control-label">User Status
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
						</div>

						<input type="hidden" class="form-control" name="user_id" id="user_id"  value="<?php echo $systemuser['user_id'];?>" readonly/>

						<div class="form-actions right">
							<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
