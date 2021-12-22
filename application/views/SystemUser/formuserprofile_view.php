
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>
    
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>systemuser/userprofile">User Profile</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			User Profile <small>Manage User Profile</small>
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->		

			<div class="row">
				<div class="col-md-3">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								
							</div>
						</div>
						<div class="portlet-body">
							<div>
								<?php
									$default_folder = $this->configuration->PhotoDirectory;

									$region_code = $hroemployeedata['region_code'];
									$branch_code = $hroemployeedata['branch_code'];
									$location_code = $hroemployeedata['location_code'];
									$employee_code = $hroemployeedata['employee_code'];

									$photo_folder = $default_folder.$region_code.'/'.$branch_code.'/'.$location_code.'/';

									echo "<img src=\"".base_url()."".$photo_folder."".$hroemployeedata['employee_photo']."\" class=\"img-responsive\" alt=\"\"> ";

								?>
								
							</div>
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                             	<div class="profile-usertitle-name"> <?php echo $hroemployeedata['employee_name']?> </div>
							</div>
                            <!-- END SIDEBAR USER TITLE -->
						</div>
					</div>
					<!-- END Portlet PORTLET-->
				</div>

			
				<div class="col-md-9">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Profile Account
							</div>
						</div>
						<div class="portlet-body">
							<div class="portlet light bordered">
								<div class="portlet-title tabbable-line">
									<ul class="nav nav-tabs">
                                    	<li class="active">
                                        	<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                      	</li>
                                        <li>
                                        	<a href="#tab_1_2" data-toggle="tab">Change Photo</a>
                                        </li>
                                        <li>
                                        	<a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                        </li>
                                   	</ul>
                                </div>
								
								<div class="portlet-body form">
                                	<div class="tab-content">
                                    	<!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">
                                        	<?php 
												echo form_open('systemuser/processChangeUserProfile',array('id' => 'myform', 'class' => 'horizontal-form')); 
												$data = $this->session->userdata('addaward');
											?>
                                                <div class="form-group form-md-line-input">
													<input type="text" class="form-control" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name'];?>" readonly/>
													<label class="control-label">Employee Name<span class="required">*</span></label>
												</div>		

												<div class="form-group form-md-line-input">
													<input type="text" class="form-control" name="username" id="username" value="<?php echo $systemuser['username'];?>" />
													<label class="control-label">Username<span class="required">*</span></label>
												</div>

												<div class="form-group form-md-line-input">
													<input type="text" class="form-control" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $hroemployeedata['employee_mobile_phone'];?>" />
													<label class="control-label">Mobile Phone</label>
												</div>

												<div class="form-actions right">
													<button type="button" class="btn red" ><i class="fa fa-times"></i> Reset</button>
													<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
												</div>

												<input type="hidden" class="form-control" name="employee_id" id="employee_id" value="<?php echo $hroemployeedata['employee_id'];?>" />

												<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $systemuser['user_id'];?>" />

											<?php echo form_close(); ?>
										</div>
                                        
                                        <div class="tab-pane" id="tab_1_2">
                                        	<p> Change Your Photo </p>
                                        	<?php 
												echo form_open_multipart('systemuser/changeEmployeePhoto');
												$data = $this->session->userdata('addaward');
											?>
                                        		<div class="form-group">
                                        			<div class="fileinput fileinput-new" data-provides="fileinput">
                                        				<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        					
	                                        			</div>
	                                        			<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
	                                        			</div>
	                                        			<div>
	                                        				<span class="btn default btn-file">
	                                        				<span class="fileinput-new"> Select image </span>
	                                        				<span class="fileinput-exists"> Change </span>
	                                        				<input type="file" name="employee_photo" id="employee_photo"> </span>
	                                        				<a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
	                                        			</div>
	                                        		</div>
                                        		</div>

                                        		<div class="form-actions right">
													<button type="button" class="btn red" ><i class="fa fa-times"></i> Cancel</button>
													<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Submit</button>
												</div>
                                        	<?php echo form_close(); ?>
                                        </div>


                                        <!-- END CHANGE AVATAR TAB -->
                                        <!-- CHANGE PASSWORD TAB -->
                                        <div class="tab-pane" id="tab_1_3">
                                        	<?php 
												echo form_open('systemuser/processChangePassword',array('id' => 'myform', 'class' => 'horizontal-form')); 
												$data = $this->session->userdata('addaward');
											?>
                                        		<div class="form-group form-md-line-input">
													<input type="password" class="form-control" name="current_password" id="current_password" />
													<label class="control-label">Current Password</label>
												</div>

												<div class="form-group form-md-line-input">
													<input type="password" class="form-control" name="new_password" id="new_password" />
													<label class="control-label">New Password</label>
												</div>

												<div class="form-group form-md-line-input">
													<input type="password" class="form-control" name="retype_password" id="retype_password" />
													<label class="control-label">Re-type New Password</label>
												</div>

                                        		<div class="form-actions right">
													<button type="button" class="btn red" ><i class="fa fa-times"></i> Cancel</button>
													<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Change Password</button>
												</div>

												<div class="form-group form-md-line-input">
													<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $systemuser['user_id']?>"/>
												</div>
                                        	<?php echo form_close(); ?>
                                        </div>
                                        <!-- END CHANGE PASSWORD TAB -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	