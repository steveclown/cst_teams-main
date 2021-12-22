<script>
	function ulang(){
		document.getElementById("job_title_code").value 		= "<?php echo $CoreJobTitle['job_title_code'] ?>";
		document.getElementById("job_title_name").value 		= "<?php echo $CoreJobTitle['job_title_name'] ?>";
		document.getElementById("job_title_parent_id").value 	= "<?php echo $CoreJobTitle['job_title_parent_id'] ?>";
		document.getElementById("job_title_remark").value 		= "<?php echo $CoreJobTitle['job_title_remark'] ?>";
	}
	
	function openform(){
		var a = document.getElementById("passwordf").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
			document.getElementById("application_user_password").value ='';
			document.getElementById("re_password").value ='';
		}
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
					<a href="<?php echo base_url();?>CoreJobTitle">
						Job Title List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreJobTitle/editCoreJobTitle/<?php echo $CoreJobTitle['job_title_id']?>">
						Edit Job Title
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Job Title 
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
						<a href="<?php echo base_url();?>CoreJobTitle" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreJobTitle/processEditCoreJobTitle',array('id' => 'myform', 'class' => 'horizontal-form')); 
							// print_r($result);exit;
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="job_title_parent_id" class="form-control" id="job_title_parent_id" readonly value="<?php echo $this->CoreJobTitle_model->getJobTitleName($CoreJobTitle['job_title_parent_id']);?>"/>
									<label class="control-label">Parent Name</label>
								</div>
							</div>
						</div>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="job_title_code" id="job_title_code" class="form-control" value="<?php echo $CoreJobTitle['job_title_code']?>">
									<span class="help-block">
										 Mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Kode Judul Pekerjaan</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="job_title_name" id="job_title_name" class="form-control" value="<?php echo $CoreJobTitle['job_title_name']?>">
									<label class="control-label">Nama Judul Pekerjaan</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea class="form-control" rows="3" name="job_title_remark" id="job_title_remark" value="<?php echo $CoreJobTitle['job_title_remark'];?>"><?php echo $CoreJobTitle['job_title_remark'];?></textarea>
									<label class="control-label">Keterangan</label>						
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="job_title_id" id="job_title_id" value="<?php echo $CoreJobTitle['job_title_id'];?>"/>
					<input type="hidden" name="job_title_parent_id" id="job_title_parent" value="<?php echo $CoreJobTitle['job_title_parent_id'];?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

