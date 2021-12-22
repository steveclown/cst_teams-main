<script>
	function warningItemCategoryCode(inputname){
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon hanya masukan huruf atau angka saja');
			document.getElementById("shift_code").value = "";	
			$('#shift_code').focus();
			return false;
		}
	}

	function warningItemCategoryName(inputname){
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Mohon hanya masukan huruf atau angka saja');
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
				alert('Data Barang Satuan Belum Lengkap');
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

	function reset_add(){
		document.location = "<?php echo base_url();?>CoreShift/reset_add";
	}
</script>

<?php echo form_open('shift/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
<?php
	
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('addCoreShift-'.$unique['unique']);
	$token 		= $this->session->userdata('CoreShifttoken-'.$unique['unique']);

	if(empty($data['shift_code'])){
		$data['shift_code']='';
	}
	if(empty($data['shift_name'])){
		$data['shift_name']='';
	}
	if(empty($data['shift_next_day'])){
		$data['shift_next_day']='';
	}
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
					<a href="<?php echo base_url();?>shift">
						Daftar Jam Pelajaran
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>shift/add">
						Tambah Data Jam Pelajaran
					</a>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
			Form Tambah Data Jam Pelajaran
		</h3>

<div class="row">
	<div class="col-md-12">
		<div class="portlet"> 
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah
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
								<input type="text" name="shift_code" id="shift_code" value="<?php if($data['shift_code'] != '') { echo set_value('shift_code',$data['shift_code']); } ?>"  class="form-control" onChange="function_elements_add(this.name, this.value);">
								<input type="hidden" name="shift_token" id="shift_token" value="<?php echo $token; ?>"  class="form-control" onChange="function_elements_add(this.name, this.value);">

								<label class="control-label">Kode Kelas
								<span class="required">*</span></label>
							</div>
						</div>
					
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_name" id="shift_name" value="<?php echo $data['shift_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">

								<input class="form-control" type="hidden" name="shift_token" id="shift_token" value="<?php echo $token;?>"/>

								<label class="control-label">Nama Jam Pelajaran
								<span class="required">*</span></label>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">												
								
								<input type="text" class="form-control timepicker timepicker-24" name="shift_start_hour" id="shift_start_hour" value="<?php echo date('h:i'); ?>" onChange="function_elements_add(this.name, this.value);">
								
								<!-- <input type="text" name="shift_start_hour" id="shift_start_hour" placeholder="09:15" class="form-control" onChange="function_elements_add(this.name, this.value);"> -->

								<label class="control-label">Jam Mulai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
						
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								
								<input type="text" class="form-control timepicker timepicker-24" name="shift_end_hour" id="shift_end_hour" value="<?php echo date('h:i'); ?>" onChange="function_elements_add(this.name, this.value);">
																		
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
								
								<input type="text" class="form-control timepicker timepicker-24" name="shift_rest_start_hour" id="shift_rest_start_hour" value="<?php echo date('h:i:s'); ?>" onChange="function_elements_add(this.name, this.value);">

								<label class="control-label">Jam Istirahat Mulai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
						
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								
								<input type="text" class="form-control timepicker timepicker-24" name="shift_rest_end_hour" id="shift_rest_end_hour" value="<?php echo date('h:i:s'); ?>" onChange="function_elements_add(this.name, this.value);">
																		
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
							echo form_dropdown('shift_next_day', $ShiftNextDay, set_value('shift_next_day', $data['shift_next_day']),'id="shift_next_day" class="form-control select2me" style="width:100%;"onChange="function_elements_add(this.name, this.value);"');
						?>
						<label class="control-label">Jam Pelajaran hari berikutnya
							<span class="required">
								*
							</span>
						</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>