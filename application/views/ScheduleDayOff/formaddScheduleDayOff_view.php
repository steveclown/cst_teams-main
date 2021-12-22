<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
	 	/*alert('asd');*/
		document.location = base_url+"ScheduleDayOff/reset_add";
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

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleDayOff/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleDayOff/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
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
								<a href="<?php echo base_url();?>ScheduleDayOff">
									Daftar Hari Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>ScheduleDayOff/addScheduleDayOff">
									Tambah Hari Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Hari Libur
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
									</i>Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>ScheduleDayOff" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('ScheduleDayOff/processAddScheduleDayOff',array('id' => 'myform', 'class' => 'horizontal-form')); 

										$unique 	= $this->session->userdata('unique');
										$data		= $this->session->userdata('addScheduleDayOff-'.$unique['unique']);

										if (empty($data)){
											$data['day_off_start_date'] = date('Y-m-d');
											$data['day_off_end_date'] 	= date('Y-m-d');
										}

										if (empty($data['day_off_name'])) {
											$data['day_off_name']="";
										}
										if (empty($data['day_off_name'])) {
											$data['day_off_name']="";
										}
										if (empty($data['day_off_remark'])) {
											$data['day_off_remark']="";
										}

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" name="day_off_name" id="day_off_name" value="<?php echo $data['day_off_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Hari LIbur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class = "col-md-3">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="day_off_start_date" id="day_off_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['day_off_start_date']);?>">
												<label class="control-label">Tanggal Mulai Hari Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-3">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="day_off_end_date" id="day_off_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['day_off_end_date']);?>">
												<label class="control-label">Tanggal Akhir Hari Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">											
											<textarea rows="3" name="day_off_remark" id="day_off_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['day_off_remark'];?></textarea>
											<label class="control-label">Keterangan hari Libur</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
