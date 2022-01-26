<script>
	function ulang(){
		document.getElementById("premi_attendance_id").value = "<?php echo $CorePremiAttendance['premi_attendance_id'] ?>";
		document.getElementById("premi_attendance_code").value = "<?php echo $CorePremiAttendance['premi_attendance_code'] ?>";
		document.getElementById("premi_attendance_name").value = "<?php echo $CorePremiAttendance['premi_attendance_name'] ?>";
		
	}
</script>


		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url();?>">
						Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CorePremiAttendance">
							Daftar Premi Kehadiran
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CorePremiAttendance/editCorePremiAttendance/<?php echo $CorePremiAttendance['premi_attendance_id']; ?>">
						Edit Premi Kehadiran
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
		Form Edit Premi Kehadiran
		</h3>
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
						<a href="<?php echo base_url();?>CorePremiAttendance" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CorePremiAttendance/processEditCorePremiAttendance',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="premi_attendance_code" id="premi_attendance_code" class="form-control" value="<?php echo $CorePremiAttendance['premi_attendance_code']?>" >
									<span class="help-block">
										Mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Kode Premi Kehadiran									
									</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="premi_attendance_name" id="premi_attendance_name" class="form-control" value="<?php echo $CorePremiAttendance['premi_attendance_name']?>" >
									<label class="control-label">Nama Premi Kehadiran</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="premi_attendance_range1" id="premi_attendance_range1" class="form-control" value="<?php echo $CorePremiAttendance['premi_attendance_range1']?>">
									<label class="control-label">Range Premi Kehadiran 1</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="premi_attendance_range2" id="premi_attendance_range2" class="form-control" value="<?php echo $CorePremiAttendance['premi_attendance_range2']?>">
									<label class="control-label">Range Premi Kehadiran 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
							<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="premi_attendance_amount" id="premi_attendance_amount" class="form-control" value="<?php echo $CorePremiAttendance['premi_attendance_amount']?>">
									<label class="control-label">Total Premi Kehadiran</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="premi_attendance_remark" id="premi_attendance_remark" class="form-control"><?php echo $CorePremiAttendance['premi_attendance_remark']?></textarea>
									<label class="control-label">Keterangan</label>
								</div>
							</div>
						</div>
							<input type="hidden" name="premi_attendance_id" value="<?php echo $CorePremiAttendance['premi_attendance_id']; ?>"/>
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
	
