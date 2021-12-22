<script>
	function ulang(){
		document.getElementById("rating_code").value = "";
		document.getElementById("rating_name").value = "";
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
					<a href="<?php echo base_url();?>CoreRating">
						Daftar Peringkat
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreRating/addCoreRating">
						Tambah Peringkat
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Peringkat
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
					<a href="<?php echo base_url();?>CoreRating" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('CoreRating/processAddCoreRating',array('class' => 'horizontal-form'));
						$data = $this->session->userdata('Addrating');
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="rating_code" id="rating_code"  value="<?php echo set_value('rating_code',$data['rating_code']);?>"/>
								<span class="help-block">
									Mohon hanya diisi karakter huruf dan angka.
								</span>
								<label class="control-label">Kode peringkat<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="rating_name" id="rating_name" value="<?php echo set_value('rating_name',$data['rating_name']);?>"/>
								<label class="control-label">Nama Peringkat<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="rating_range1" id="rating_range1" value="<?php echo set_value('rating_range1',$data['rating_range1']);?>"/>
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Range Peringkat 1<span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="rating_range2" id="rating_range2" value="<?php echo set_value('rating_range2',$data['rating_range2']);?>"/>
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Range Peringkat 2<span class="required">*</span></label>
							</div>
						</div>
					</div>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="rating_value" id="rating_value" value="<?php echo set_value('rating_value',$data['rating_value']);?>"/>
								<span class="help-block">
									Mohon hanya diisi angka.
								</span>
								<label class="control-label">Nilai Peringkat<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="rating_remark" id="rating_remark" class="form-control" ><?php echo $data['rating_remark'];?></textarea>		
								<label class="control-label">Keterangan </label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
