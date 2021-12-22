<script>
	function ulang(){
		document.getElementById("job_title_code").value = "";
		document.getElementById("job_title_name").value = "";
		document.getElementById("job_title_remark").value = "";
	}
	function reset_session(){
		document.getElementById("quantity").value = "";
		document.getElementById("item_name").value = "";
		document.location= base_url+"CoreJobTitle/reset_session";
	}
</script>
<script src="<?php echo base_url();?>asset/multilevel/tree/lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	var site_url = "<?php echo base_url();?>";
	function load_uri(uri,dom)
	{
		$.ajax({
			// url: site_url+"/"+uri,
			url: site_url+uri,
			success: function(response){			
			$(dom).html(response);
			},
		dataType:"html"
		});
		return false;
	}
	function show_extra_combo(combo,combo_level)
	{
		var id = $(combo).val();
		// buat dom '.combo-level' di dalam extra-combo jika belum ada
		var domcombo = 'combo-'+combo_level;
		// alert(id);
		if($('.'+domcombo).length == 0)
		{
			$('#extra-combo').append('&nbsp;<div class="'+domcombo+'"></div>');
			 $('#job_title_parent').val(id);
		}
		load_uri("CoreJobTitle/showChileCoreJobTitle/"+id+"/"+combo_level,'.'+domcombo);
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
								<a href="<?php echo base_url();?>CoreJobTitle">
									Daftar Judul Pekerjaan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreJobTitle/addCoreJobTitle">
									Tambah Judul Pekerjaan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Judul Pekerjaan
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
									Form Tambah
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
										echo form_open('CoreJobTitle/processAddCoreJobTitle',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addjobtitle');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
													<?php echo form_dropdown('job_title_parent_id', $corejobtitle_parent, $data['job_title_parent_id'], 'id ="job_title_parent_id", class="form-control select2me"');?>


													<label class="control-label">Parent Name</label>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="job_title_code" id="job_title_code" class="form-control" value="<?php echo $data['job_title_code']?>">
												<span class="help-block">
													 Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Judul Pekerjaan</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="job_title_name" id="job_title_name" class="form-control" value="<?php echo $data['job_title_name']?>">
												<label class="control-label">Nama Judul Pekerjaan</label>
											</div>
										</div>
									</div>
										
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3"  name="job_title_remark", id="job_title_remark" class="form-control" value="<?php echo $data['job_title_remark'];?>"></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
									
									
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="job_title_token" id="job_title_token" class="form-control" value="<?php echo $job_title_token?>" onChange="function_elements_add(this.name, this.value);">
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>