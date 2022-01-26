<script>
	function reset_data(){
		document.getElementById("shift_code").value 	= "<?php echo $CoreShift['shift_code'] ?>";
		document.getElementById("shift_name").value 	= "<?php echo $CoreShift['shift_name'] ?>";
	}

	function warningCoreShiftCode(inputname){
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon masukan hanya huruf atau angka saja');
			document.getElementById("shift_code").value = "";	
			$('#shift_code').focus();
			return false;
		}
	}

	function warningCoreShiftName(inputname){
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon masukan hanya huruf atau angka saja');
			document.getElementById("shift_name").value = "";	
			$('#shift_name').focus();
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var shift_code = $("#shift_code").val();
			var shift_name = $("#shift_name").val();
			
		  	if(shift_code!='' && shift_name!=''){
				return true;
			}else{
				alert('Data of Item Unit Not Yet Complete');
				return false;
			}
		});
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreShift/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreShift/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function reset_edit(){
		document.location = "<?php echo base_url();?>CoreShift/reset_edit/<?php echo $CoreShift['shift_id']?>";
	}
</script>
<?php 
	echo form_open('shift/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); 
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
					<a href="<?php echo base_url();?>CoreShift">
						Daftar Jam pelajaran
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreShift/editCoreShift<?php echo $CoreShift['shift_id']; ?>">
						Ubah Jam Pelajaran
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
			Form Ubah Jam Pelajaran	
		</h3>
	
<div class="row">
	<div class="col-md-12">
		<div class="portlet"> 
			<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Ubah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>shift" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							Kembali
						</span>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">					
					<?php
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="shift_id" id="shift_id" value="<?php echo $CoreShift['shift_id'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">

								<input type="text" autocomplete="off"  name="shift_code" id="shift_code" value="<?php echo $CoreShift['shift_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Kode Kelas
								<span class="required">*</span></label>
								<div class="help-block">
									Mohon hanya masukan huruf atau angka saja
								</div>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="shift_name" id="shift_name" value="<?php echo $CoreShift['shift_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value); warningCoreShiftName(this.value);">
								<label class="control-label">Nama Kelas
								<span class="required">*</span></label>
								<div class="help-block">
									Mohon hanya masukan huruf atau angka saja
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">												
								
								<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="shift_start_hour" id="shift_start_hour" value="<?php if(!empty($CoreShift['shift_start_hour'])){echo $CoreShift['shift_start_hour'];}else{ echo date('h:i:s');}  ?>" onChange="function_elements_add(this.name, this.value);">

								<label class="control-label">Jam Mulai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
						
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="shift_end_hour" id="shift_end_hour" value="<?php if(!empty($CoreShift['shift_end_hour'])){echo $CoreShift['shift_end_hour'];}else{ echo date('h:i:s');}  ?>" onChange="function_elements_add(this.name, this.value);">
																										
								<label class="control-label">Jam Selesai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">												
								
								<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="shift_rest_start_hour" id="shift_rest_start_hour" value="<?php if(!empty($CoreShift['shift_rest_start_hour'])){echo $CoreShift['shift_rest_start_hour'];}else{ echo date('h:i:s');}  ?>" onChange="function_elements_add(this.name, this.value);">

								<label class="control-label">Jam Istirahat Mulai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
						
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								
								<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="shift_rest_end_hour" id="shift_rest_end_hour" value="<?php if(!empty($CoreShift['shift_rest_end_hour'])){echo $CoreShift['shift_rest_end_hour'];}else{ echo date('h:i:s');}  ?>" onChange="function_elements_add(this.name, this.value);">
																		
								<label class="control-label">Jam Istirahat Selesai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div> -->
					<div class="row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
						<?php
							echo form_dropdown('shift_next_day', $ShiftNextDay, set_value('shift_next_day', $CoreShift['shift_next_day']),'id="shift_next_day" class="form-control select2me" style="width:100%;"onChange="function_elements_add(this.name, this.value);"');
						?>
						<label class="control-label">Jam Mapel hari berikutnya
							<span class="required">
								*
							</span>
						</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
<!-- <input type="hidden" name="shift_id" value="<?php echo $CoreShift['shift_id']; ?>"/> -->
<?php echo form_close(); ?>