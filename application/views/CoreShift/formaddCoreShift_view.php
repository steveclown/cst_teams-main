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
		margin-bottom: 10px !important;
	}
</style>

<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"CoreShift/reset_add";
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

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreShift/function_elements_add');?>",
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
				url : "<?php echo site_url('CoreShift/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreShift">Shift</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreShift/addCoreShift">Tambah Shift</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Tambah Shift
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->		

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php 
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addCoreShift-'.$unique['unique']);
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreShift/" class="btn btn-default btn-sm">
									<i class="fa fa-angle-left"></i> Kembali</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php echo form_open('CoreShift/processAddCoreShift',array('class' => 'horizontal-form')); ?>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="shift_code" id="shift_code" value="<?php echo $data['shift_code']?>" onChange="function_elements_add(this.name, this.value);">
												<label for="form_control">Kode Shift
													<span class="required">*</span>
												</label>
												<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="shift_name" id="shift_name" value="<?php echo $data['shift_name']?>" onChange="function_elements_add(this.name, this.value);" >
												<label for="form_control">Nama Shift
													<span class="required">*</span>
												</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control timepicker timepicker-24" name="start_working_hour" id="start_working_hour" value="<?php echo date('h:i:s'); ?>" onChange="function_elements_add(this.name, this.value);">
												<label for="form_control">Start Working Hour
													<span class="required">*</span>
												</label>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control timepicker timepicker-24" name="end_working_hour" id="end_working_hour" value="<?php echo date('h:i:s'); ?>" onChange="function_elements_add(this.name, this.value);">
												<label for="form_control">End Working Hour
													<span class="required">*</span>
												</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="working_hours_start" id="working_hours_start" value="<?php echo $data['working_hours_start']?>" onChange="function_elements_add(this.name, this.value);">
												<label for="form_control">Working Hours Start
													<span class="required">*</span>
												</label>
											</div>	
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" name="working_hours_end" id="working_hours_end" value="<?php echo $data['working_hours_end']?>" onChange="function_elements_add(this.name, this.value);" >
												<label for="form_control">Working Hours End
													<span class="required">*</span>
												</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('shift_next_day', $shiftnextday, set_value('shift_next_day', $data['shift_next_day']), 'id="shift_next_day" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Shift Hari berikutnya</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="shift_remark" id="shift_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['shift_remark']?>" >
												<label for="form_control">keterangan
												</label>
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