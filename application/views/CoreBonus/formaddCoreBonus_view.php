<script>
	function ulang(){
		document.getElementById("bonus_code").value = "";
		document.getElementById("bonus_name").value = "";
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
			
		  	if(bonus_code!='' && bonus_name!='' ){
				return true;
			}else{
				alert('Data of Bonus Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreBonus/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
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
					<a href="<?php echo base_url();?>CoreBonus">
						Daftar Bonus
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreBonus/addCoreBonus">
						Tambah Bonus
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Bonus 
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
					<a href="<?php echo base_url();?>CoreBonus" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('CoreBonus/processAddCoreBonus',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addbonus');
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="bonus_code" id="bonus_code" onChange="warningbonuscode(bonus_code); function_elements_add(this.name, this.value);" value="<?php echo set_value('bonus_code',$data['bonus_code']);?>"/>
								<span class="help-block">
									 Diisi karakter huruf dan angka
								</span>
								<label class="control-label">Kode Bonus<span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="bonus_name" id="bonus_name" onChange="warningbonusname(bonus_name); function_elements_add(this.name, this.value);" value="<?php echo set_value('bonus_name',$data['bonus_name']);?>"/>
								<label class="control-label">Nama Bonus<span class="required">*</span></label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>