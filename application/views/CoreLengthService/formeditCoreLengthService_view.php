<script>
	function ulang(){
		document.getElementById("length_service_id").value = "<?php echo $CoreLengthService['length_service_id'] ?>";
		document.getElementById("length_service_code").value = "<?php echo $CoreLengthService['length_service_code'] ?>";
		document.getElementById("length_service_name").value = "<?php echo $CoreLengthService['length_service_name'] ?>";
		document.getElementById("length_service_range1").value = "<?php echo $CoreLengthService['length_service_range1'] ?>";
		document.getElementById("length_service_range2").value = "<?php echo $CoreLengthService['length_service_range2'] ?>";
		document.getElementById("length_service_amount").value = "<?php echo $CoreLengthService['length_service_amount'] ?>";
		document.getElementById("length_service_remark").value = "<?php echo $CoreLengthService['length_service_remark'] ?>";
	}
$(document).ready(function(){
        $("#length_service_range2").change(function(){
       	  var length_service_range2 	= $("#length_service_range2").val();
          var length_service_range1  	= $("#length_service_range1").val();
           

          var length_service_amount = parseFloat(length_service_range2) + parseFloat(length_service_range1);

          
          document.getElementById('length_service_range1').value				= length_service_range1;
		  document.getElementById('length_service_amount').value				= length_service_amount;
			
		
        });
    });
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
					<a href="<?php echo base_url();?>CoreLengthService">
						Daftar Masa jabatan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreLengthService/editCoreLengthService/<?php echo $CoreLengthService['length_service_id']; ?>">
						Edit Masa jabatan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Masa jabatan
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
						<a href="<?php echo base_url();?>CoreLengthService" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreLengthService/processEditCoreLengthService',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_code" id="length_service_code" class="form-control" value="<?php echo $CoreLengthService['length_service_code']?>">
									<span class="help-block">
										Mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Kode Masa jabatan
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_name" id="length_service_name" class="form-control" value="<?php echo $CoreLengthService['length_service_name']?>" >
									<span class="help-block">
										Mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Nama Masa jabatan</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_range1" id="length_service_range1" class="form-control" value="<?php echo $CoreLengthService['length_service_range1']?>">
									<span class="help-block">
										Mohon diisi angka.
									</span>
									<label class="control-label">Range Masa jabatan 1</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_range2" id="length_service_range2" class="form-control" value="<?php echo $CoreLengthService['length_service_range2']?>" >
									<span class="help-block">
										Mohon diisi angka.
									</span>
									<label class="control-label">Range Masa jabatan 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input readonly type="text" name="length_service_amount" id="length_service_amount" class="form-control" value="<?php echo $CoreLengthService['length_service_amount']?>" >
									<label class="control-label">Total Masa jabatan</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="length_service_remark" id="length_service_remark" class="form-control"><?php echo $CoreLengthService['length_service_remark']?></textarea>
									<label class="control-label">Keterangan</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="length_service_id" value="<?php echo $CoreLengthService['length_service_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
