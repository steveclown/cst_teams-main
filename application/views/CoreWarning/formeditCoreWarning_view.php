<script>
	function ulang(){
		document.getElementById("warning_code").value = "<?php echo $corewarning['warning_code'] ?>";
		document.getElementById("warning_name").value = "<?php echo $corewarning['warning_name'] ?>";
		document.getElementById("warning_id").value = "<?php echo $corewarning['warning_id'] ?>";
	}
	
	function warningcode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon hanya diisi karakter huruf dan angka');
			document.getElementById("warning_code").value = "";
			return false;
		}
	}
	
	function warningname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon hanya diisi karakter huruf dan angka');
			document.getElementById("warning_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var warning_code = $("#warning_code").val();
			var warning_name = $("#warning_name").val();
			var warning_remark = $("#warning_remark").val();
			
		  	if(warning_code!='' && warning_name!='' && warning_remark!=''){
				return true;
			}else{
				alert('Data of PeringatanNot Yet Complete');
				return false;
			}
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
					<a href="<?php echo base_url();?>CoreWarning">
						Daftar Peringatan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>warning/edit/<?php echo $corewarning['warning_id'];?>">
						Edit Peringatan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Peringatan
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
						<a href="<?php echo base_url();?>warning" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php
							echo form_open('CoreWarning/processEditCoreWarning',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="warning_code" id="warning_code" onChange="warningcode(warning_code);" value="<?php echo $corewarning['warning_code'];?>" class="form-control">
									<span class="help-block">
										 mohon hanya diisi karakter huruf dan angka.
									</span>
									<label class="control-label">Kode Peringatan<span class="required">*</span></label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="warning_name" id="warning_name" onChange="warningname(warning_name);" value="<?php echo $corewarning['warning_name'];?>" class="form-control">
									<label class="control-label">Nama Peringatan<span class="required">*</span></label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="warning_remark" id="warning_remark" class="form-control" placeholder="Remark"><?php echo $corewarning['warning_remark'];?></textarea>		
									<label class="control-label">Keterangan</label>
								</div>
							</div>
						</div>
						<input type="hidden" name="warning_id" value="<?php echo $corewarning['warning_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" name="Save" id = "Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

