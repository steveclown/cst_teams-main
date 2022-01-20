<script>
	function ulang(){
		document.getElementById("department_code").value = "";
		document.getElementById("department_name").value = "";
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
								<a href="<?php echo base_url();?>coredepartment">
									Departemen List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coredepartment/AddCoreDepartment">
									Tambah Department
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Departemen 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>department" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('department/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreDepartment-'.$unique['unique']);
										$department_token	= $this->session->userdata('CoreDepartmentToken-'.$unique['unique']);

										if(empty($data['department_code'])){
											$data['department_code'] 					= '';
										}

										if(empty($data['department_name'])){
											$data['department_name'] 					= '';
										}
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision, $data['division_id'], 'id ="division_id", class="form-control select2me"');?>
												<label class="control-label">Nama Divisi
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
												<input type="text" name="department_code" id="department_code" value="<?php echo $data['department_code']?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Departemen
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="department_name" id="department_name" value="<?php echo $data['department_name']?>" class="form-control">
												<input type="hidden" name="department_token" id="department_token" class="form-control" value="<?php echo $department_token?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Departemen
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>								
							</div>
						</div>
					</div>
				</div>