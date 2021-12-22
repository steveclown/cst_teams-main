<script>
	function ulang(){
		document.getElementById("education_code").value = "<?php echo $result['education_code'] ?>";
		document.getElementById("education_name").value = "<?php echo $result['education_name'] ?>";
		document.getElementById("education_id").value = "<?php echo $result['education_id'] ?>";
	}
</script>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreEducation">Pendidikan</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreEducation/editCoreEducation/<?php echo $CoreEducation['education_id']?>">Edit Pendidikan</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Edit Pendidikan
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
						<a href="<?php echo base_url();?>CoreEducation/" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
						echo form_open('CoreEducation/processEditCoreEducation',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="education_code" id="education_code" value="<?php echo $CoreEducation['education_code']?>" >
									<label for="form_control">Kode Pendidikan
										<span class="required">*</span>
									</label>
									<span class="help-block">Mohon hanya diisi karakter huruf dan angka</span>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="education_name" id="education_name" value="<?php echo $CoreEducation['education_name']?>" >
									<label for="form_control">Nama Pendidikan
										<span class="required">*</span>
									</label>
								</div>
							</div>
						</div>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('education_type', $CoreEducationtype, $CoreEducation['education_type'], 'id ="education_type", class="form-control select2me"');?>
									<label for="form_control">Tipe Pendidikan
									<span class="required">*</span></label>
								</div>
							</div>
						</div>
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" class="form-control" name="education_remark" id="education_remark"> <?php echo set_value('education_remark',$CoreEducation['education_remark']);?> </textarea>
									<label for="form_control_1">Keterangan</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="education_id" value="<?php echo $CoreEducation['education_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>