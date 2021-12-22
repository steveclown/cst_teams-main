<script>
	base_url = '<?php echo base_url()?>';

	function reset_edit(){
		document.location = base_url+"CoreShift/reset_edit/<?php echo $CoreShift['shift_id']?>";
	}

	function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreShift/function_elements_edit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_edit(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreShift/function_state_edit');?>",
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
					<a href="<?php echo base_url();?>CoreShift/editCoreShift/<?php echo $CoreShift['shift_id']?>">Edit Shift</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Edit Shift
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
						<a href="<?php echo base_url();?>CoreShift/" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php
						echo form_open('CoreShift/processEditCoreShift',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
	                                <input type="text" class="form-control" name="shift_code" id="shift_code" value="<?php echo $CoreShift['shift_code']?>" onChange="function_elements_edit(this.name, this.value);">
									<label for="form_control">kode Shift
										<span class="required">*</span>
									</label>
									<span class="help-block">Mohon hanya diisi karakter huruf dan angka.</span>
								</div>	
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="shift_name" id="shift_name" value="<?php echo $CoreShift['shift_name']?>" onChange="function_elements_edit(this.name, this.value);" >
									<label for="form_control">Nama Shift
										<span class="required">*</span>
									</label>
								</div>	
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
                                    <input type="text" class="form-control timepicker timepicker-24" name="start_working_hour" id="start_working_hour" value="<?php echo $CoreShift['start_working_hour'] ?>" onChange="function_elements_edit(this.name, this.value);" >
									<label for="form_control">Start Working Hour
										<span class="required">*</span>
									</label>
								</div>	
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control timepicker timepicker-24" name="end_working_hour" id="end_working_hour" value="<?php echo $CoreShift['end_working_hour'] ?>"  onChange="function_elements_edit(this.name, this.value);">
									<label for="form_control">End Working Hour
										<span class="required">*</span>
									</label>
								</div>	
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
	                                <input type="text" class="form-control" name="working_hours_start" id="working_hours_start" value="<?php echo $CoreShift['working_hours_start']?>" onChange="function_elements_edit(this.name, this.value);">
									<label for="form_control">Working Hours Start
										<span class="required">*</span>
									</label>
								</div>	
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="working_hours_end" id="working_hours_end" value="<?php echo $CoreShift['working_hours_end']?>" onChange="function_elements_edit(this.name, this.value);" >
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
										echo form_dropdown('shift_next_day', $shiftnextday, set_value('shift_next_day', $CoreShift['shift_next_day']), 'id="shift_next_day" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
									?>
									<label class="control-label">Shift Hari Berikutnya</label>
								</div>	
							</div>
						</div>

						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
	                                <input type="text" class="form-control" name="shift_remark" id="shift_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $CoreShift['shift_remark']?>"  onChange="function_elements_edit(this.name, this.value);">
									<label for="form_control">Keterangan
									</label>
								</div>	
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<input type="hidden" name="shift_id" value="<?php echo $CoreShift['shift_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>