<script>
	function ulang(){
		document.getElementById("warning_code").value = "";
		document.getElementById("warning_name").value = "";
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
			
		  	if(warning_code!='' && warning_name!=''){
				return true;
			}else{
				alert('Data belum lengkap');
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
					<a href="<?php echo base_url();?>CoreWarning/addCoreWarning">
						Tambah Peringatan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Peringatan
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
					<a href="<?php echo base_url();?>CoreWarning" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('warning/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');

							$unique 		= $this->session->userdata('unique');
							$data 			= $this->session->userdata('addCoreWarning-'.$unique['unique']);
							$warning_token	= $this->session->userdata('CoreWarningToken-'.$unique['unique']);

							if(empty($data['warning_code']))
							{
								$data['warning_code'] 					= '';
							}

							if(empty($data['warning_name'])){
							$data['warning_name'] 					= '';
						}
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="warning_code" id="warning_code"  onChange="warningcode(warning_code);" value="<?php echo set_value('warning_code',$data['warning_code']);?>"/>
								<span class="help-block">
									Mohon hanya diisi karakter huruf dan angka.
								</span>
								<label class="control-label">Kode Peringatan<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">	
								<input type="text" class="form-control" name="warning_name" id="warning_name" onChange="warningname(warning_name);" value="<?php echo set_value('warning_name',$data['warning_name']);?>"/>
								<input type="hidden" name="warning_token" id="warning_token" class="form-control" value="<?php echo $warning_token?>" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Nama Peringatan<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="warning_remark" id="warning_remark" class="form-control"><?php echo $data['warning_remark'];?></textarea>		
								<label class="control-label"> Ketrangan</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" name="Save" id="Save"class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
