<script>
	function ulang(){
		document.getElementById("award_code").value = "";
		document.getElementById("award_name").value = "";
	}
	
	function warningawardcode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("award_code").value = "";
			return false;
		}
	}
	
	function warningawardname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("award_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var award_code = $("#award_code").val();
			var award_name = $("#award_name").val();
			var award_remark = $("#award_remark").val();
			
		  	if(award_code!='' && award_name!='' && award_remark!=''){
				return true;
			}else{
				alert('Data of Award Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
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
					<a href="<?php echo base_url();?>CoreBank">
						Daftar Bank
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreBank/addCoreBank">
						Tambah Bank
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Bank 
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
					Form Tambah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>bank" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i>
						Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('CoreBank/processAddCoreBank',array('id' => 'myform', 'class' => 'horizontal-form'));
						$data = $this->session->userdata('addbank');
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="bank_code" id="bank_code" value="<?php echo $data['bank_code'];?>" class="form-control" onChange="warningawardcode(award_code);">
								<span class="help-block">
									Diisi karakter angka dan huruf
								</span>
								<label class="control-label">Kode Bank
									<span class="required">
										*
									</span></label>
								</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="bank_name" id="bank_name" value="<?php echo $data['bank_name'];?>" class="form-control" onChange="warningawardcode(award_code);">
								<label class="control-label">Nama Bank</label>
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
