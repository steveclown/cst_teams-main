<script>
	function ulang(){
		document.getElementById("location_code").value = "";
		document.getElementById("location_name").value = "";
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
								<a href="<?php echo base_url();?>corelocation">
									Location List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corelocation/AddCoreLocation">
									Tambah Location
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Location 
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
									<a href="<?php echo base_url();?>location" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('location/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');

										$unique 		= $this->session->userdata('unique');
										$data 			= $this->session->userdata('addCoreLocation-'.$unique['unique']);
										$location_token	= $this->session->userdata('CoreLocationToken-'.$unique['unique']);

										if(empty($data['location_code'])){
											$data['location_code'] 					= '';
										}

										if(empty($data['location_name'])){
											$data['location_name'] 					= '';
										}
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('branch_id', $corebranch, $data['branch_id'], 'id ="branch_id", class="form-control select2me"');?>
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
												<input type="text" autocomplete="off"  name="location_code" id="location_code" value="<?php echo $data['location_code']?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Location
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="location_name" id="location_name" value="<?php echo $data['location_name']?>" class="form-control">
												<input type="hidden" name="location_token" id="location_token" class="form-control" value="<?php echo $location_token?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Location
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