<script>
function ulang(){
	document.getElementById("premi_attendance_id").value = "";
	document.getElementById("premi_attendance_code").value = "";
	document.getElementById("premi_attendance_name").value = "";
	document.getElementById("premi_attendance_range1").value = "";
	document.getElementById("premi_attendance_range2").value = "";
	document.getElementById("premi_attendance_amount").value = "";
	document.getElementById("premi_attendance_remark").value = "";
}
$(document).ready(function(){
        $("#premi_attendance_range2").change(function(){
       	  var premi_attendance_range2 	= $("#premi_attendance_range2").val();
          var premi_attendance_range1  	= $("#premi_attendance_range1").val();
           

          var premi_attendance_amount = parseFloat(premi_attendance_range2) + parseFloat(premi_attendance_range1);

          
          document.getElementById('premi_attendance_range1').value				= premi_attendance_range1;
		  document.getElementById('premi_attendance_amount').value				= premi_attendance_amount;
			
		
        });
    });
</script>

					<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<ul class="page-breadcrumb breadcrumb">
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
								<a href="<?php echo base_url();?>CorePremiAttendance/addCorePremiAttendance">
									Tambah Premi Kehadiran
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Premi Kehadiran
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
									<a href="<?php echo base_url();?>CorePremiAttendance" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CorePremiAttendance/processAddCorePremiAttendance',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addpremiattendance');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="premi_attendance_code" id="premi_attendance_code" class="form-control" value="<?php echo $data['premi_attendance_code']?>">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Premi Kehadiran
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="premi_attendance_name" id="premi_attendance_name" class="form-control" value="<?php echo $data['premi_attendance_name']?>" >
												<label class="control-label">Nama Premi Kehadiran</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="premi_attendance_range1" id="premi_attendance_range1" class="form-control" value="<?php echo $data['premi_attendance_range1']?>" >
												<label class="control-label">Range Premi Kehadiran 1</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="premi_attendance_range2" id="premi_attendance_range2" class="form-control" value="<?php echo $data['premi_attendance_range2']?>">
												<label class="control-label">Range Premi Kehadiran 2</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input readonly type="text" name="premi_attendance_amount" id="premi_attendance_amount" class="form-control" value="<?php echo $data['premi_attendance_amount']?>" >
												<label class="control-label">Total Premi Kehadiran</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="premi_attendance_remark" id="premi_attendance_remark" class="form-control"><?php echo $data['premi_attendance_remark']?></textarea>
												<label class="control-label">Keterangan</label>
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
