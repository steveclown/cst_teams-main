<script>
	function ulang(){
		document.getElementById("award_code").value = "";
		document.getElementById("award_name").value = "";
	}
	
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var award_code = $("#award_code").val();
			var award_name = $("#award_name").val();
			var award_remark = $("#award_remark").val();
			
		  	if(award_code!='' && award_name!='' && award_remark!=''){
				return true;
			}else{
				alert('Data Penghargaan belum lengkap');
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
					<a href="<?php echo base_url();?>CoreAward">
						Daftar Penghargaan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreAward/addCoreAward">
						Tambah Penghargaan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Tambah Penghargaan
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
					<a href="<?php echo base_url();?>award" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('award/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');

							$unique 		= $this->session->userdata('unique');
							$data 			= $this->session->userdata('addCoreAward-'.$unique['unique']);
							$award_token	= $this->session->userdata('CoreAwardToken-'.$unique['unique']);

							if(empty($data['award_code']))
							{
								$data['award_code'] 					= '';
							}

							if(empty($data['award_name'])){
							$data['award_name'] 					= '';
							}
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="award_code" id="award_code" onChange="warningawardcode(award_code);" value="<?php echo set_value('award_code',$data['award_code']);?>"/>
								<span class="help-block">
									Mohon hanya isi dengan karakter huruf dan angka.
								</span>
								<label class="control-label">Kode Penghargaan<span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="award_name" id="award_name" onChange="warningawardname(award_name);" value="<?php echo set_value('award_name',$data['award_name']);?>"/>
								
								<input type="hidden" name="award_token" id="award_token" class="form-control" value="<?php echo $award_token?>" onChange="function_elements_add(this.name, this.value);">
								
								<label class="control-label">Nama Penghargaan<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">					
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="award_remark" id="award_remark" class="form-control" ><?php echo $data['award_remark'];?></textarea>	
								<label class="control-label">Keterangan</label>								
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i>Batal</button>
					<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i>Simpan</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>