<script>
	function ulang(){
		document.getElementById("bonus_code").value = "<?php echo $CoreBonus['bonus_code'] ?>";
		document.getElementById("bonus_name").value = "<?php echo $CoreBonus['bonus_name'] ?>";
		document.getElementById("bonus_id").value = "<?php echo $CoreBonus['bonus_id'] ?>";
	}
	
	function warningbonuscode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("bonus_code").value = "";
			return false;
		}
	}
	
	function warningbonusname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("bonus_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var bonus_code = $("#bonus_code").val();
			var bonus_name = $("#bonus_name").val();
			var bonus_remark = $("#bonus_remark").val();
			
		  	if(bonus_code!='' && bonus_name!='' && bonus_remark!=''){
				return true;
			}else{
				alert('Data of Bonus Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>
<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
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
								<a href="<?php echo base_url();?>CoreBonus">
									Daftar Bonus
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreBonus/editCoreBonus/<?php echo $CoreBonus['bonus_id'];?>">
									Edit Bonus
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Bonus 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>CoreBonus" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreBonus/processEditCoreBonus',array('id' => 'myform', 'class' => 'horizontal-form')); 		
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="bonus_code" id="bonus_code" onChange="warningbonuscode(bonus_code);" value="<?php echo $CoreBonus['bonus_code'];?>" class="form-control" >
									<span class="help-block">
										Diisi karakter huruf dan angka
									</span>
									<label class="control-label">Kode Bonus<span class="required">*</span></label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="bonus_name" id="bonus_name" onChange="warningbonusname(bonus_name);" value="<?php echo $CoreBonus['bonus_name'];?>" class="form-control" >
									<label class="control-label">Nama Bonus<span class="required">*</span></label>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="bonus_id" value="<?php echo $CoreBonus['bonus_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" id="Save" name="Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

