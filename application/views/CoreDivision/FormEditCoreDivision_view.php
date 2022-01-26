<script>
	function ulang(){
		document.getElementById("division_code").value = "<?php echo $coredivision['division_code'] ?>";
		document.getElementById("division_name").value = "<?php echo $coredivision['division_name'] ?>";
		document.getElementById("division_id").value = "<?php echo $coredivision['division_id'] ?>";
	}
</script>
			
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
						<a href="<?php echo base_url();?>coredivision">
							Daftar Devisi
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>coredivision/editCoreDivison/<?php echo $coredivision['division_id']?>">
							Edit Devisi
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Form Edit Devisi 
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
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>division" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('coredivision/processEditcoredivision',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  name="division_code" id="division_code" value="<?php echo $coredivision['division_code'];?>" class="form-control" >
													<label class="control-label">Division Code
														<span class="required">
															*
														</span>
													</label>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $coredivision['division_name'];?>" class="form-control" >
												<label class="control-label">Division Name
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
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="division_id" value="<?php echo $coredivision['division_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>