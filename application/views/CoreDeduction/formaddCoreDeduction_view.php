<script>
	base_url = '<?php echo base_url()?>';

	mappia = "	<?php 
					$site_url = 'CoreDeduction/addCoreDeduction/';
					echo site_url($site_url); 
				?>";

	function reset_data(){
	 	/*alert('asd');*/
		document.location = base_url+"reset_data";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreDeduction/function_elements_add');?>",
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
				url : "<?php echo site_url('CoreDeduction/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayCoreDeductionAllowance(){
		
		var allowance_id 					= document.getElementById("allowance_id").value;
		var deduction_allowance_ratio 		= document.getElementById("deduction_allowance_ratio").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('CoreDeduction/processAddArrayCoreDeductionAllowance');?>",
			  data: {
					'allowance_id' 					: allowance_id,
					'deduction_allowance_ratio' 	: deduction_allowance_ratio, 
					'session_name' 					: "addarrayCoreDeductionallowance-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>
<?php 
	$sesi 	= $this->session->userdata('unique');
	
	if($this->uri->segment(3)!=''){
		$uri = $this->uri->segment(3);
	}else{
		$uri = '';
	}
?>

<?php 
	echo form_open('CoreDeduction/processAddCoreDeduction',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$sesi 			= $this->session->userdata('unique');
	$data 			= $this->session->userdata('addCoreDeduction-'.$sesi['unique']);

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
?>

<?php
	$CoreDeductionallowance	= $this->session->userdata('addarrayCoreDeductionallowance-'.$sesi['unique']);

	if(empty($data['deduction_code'])){
		$data['deduction_code']=" ";
	}
	if(empty($data['deduction_name'])){
		$data['deduction_name']=" ";
	}
	if(empty($data['deduction_type'])){
		$data['deduction_type']=" ";
	}
	if(empty($data['deduction_amount'])){
		$data['deduction_amount']=" ";
	}
	if(empty($data['deduction_allowance_ratio'])){
		$data['deduction_allowance_ratio']=" ";
	}
	if(empty($data['deduction_late_start_duration'])){
		$data['deduction_late_start_duration']=" ";
	}
	if(empty($data['deduction_late_end_duration'])){
		$data['deduction_late_end_duration']=" ";
	}
	if(empty($data['deduction_premi_attendance_ratio'])){
		$data['deduction_premi_attendance_ratio']=" ";
	}
	if(empty($data['deduction_premi_attendance_status'])){
		$data['deduction_premi_attendance_status']=" ";
	}
	if(empty($data['deduction_remark'])){
		$data['deduction_remark']=" ";
	}
	if(empty($data['deduction_basic_salary_ratio'])){
		$data['deduction_basic_salary_ratio']=" ";
	}
	if(empty($data['allowance_name'])){
		$data['allowance_name']=" ";
	}
	if(empty($data['allowance_id'])){
		$data['allowance_id']=" ";
	}
	if(empty($data['deduction_allowance_ratio'])){
		$data['deduction_allowance_ratio']=" ";
	}
	if(empty($data['deduction_id'])){
		$data['deduction_id']=" ";
	}
?>
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb ">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreDeduction">
									Daftar Potongan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreDeduction">
									Tambah Potongan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Potongan
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreDeduction" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
								
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_code" id="deduction_code" class="form-control" value="<?php echo $data['deduction_code']?>" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Potongan
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_name" id="deduction_name" class="form-control" value="<?php echo $data['deduction_name']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Potongan</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tipe Potongan
												<span class="required">
												*
												</span></label>												
												<?php echo form_dropdown('deduction_type', $deductiontype, $data['deduction_type'], 'id ="deduction_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_amount" id="deduction_amount" class="form-control" value="<?php echo $data['deduction_amount']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Jumlah Potongan </label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_premi_attendance_ratio" id="deduction_premi_attendance_ratio" class="form-control" value="<?php echo $data['deduction_premi_attendance_ratio']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Rasio Potongan Premi Kehadiran</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('deduction_premi_attendance_status', $deductionpremiattendancestatus ,set_value('deduction_premi_attendance_status', $data['deduction_premi_attendance_status']),'id="allowance_id", class="form-control select2me"');
												?>
												<label class="control-label">Status Potongan Premi Kehadiran</label>
											</div>
										</div>
									</div>
										
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_basic_salary_ratio" id="deduction_basic_salary_ratio" class="form-control" value="<?php echo $data['deduction_basic_salary_ratio']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Rasio Potongan Gaji Pokok</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_late_start_duration" id="deduction_late_start_duration" class="form-control" value="<?php echo $data['deduction_late_start_duration']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Potongan Keterlambatan Awal</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_late_end_duration" id="deduction_late_end_duration" class="form-control" value="<?php echo $data['deduction_late_end_duration']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Potongan Keterlambatan Akhir</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="deduction_remark" id="deduction_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['deduction_remark']?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>

									<h4>Tunjangan </h4>
									<br>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id',$data['allowance_id']),'id="allowance_id", class="form-control select2me"');
												?>
												<label class="control-label">Nama Tunjangan </label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="deduction_allowance_ratio" name="deduction_allowance_ratio" value="<?php echo $data['deduction_allowance_ratio'];?>">
												<label class="control-label">Rasio Tunjangan </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class="form-actions right">
											<input type="button" name="add2" id="buttonAddArrayCoreDeductionAllowance" value="Add" class="btn blue" title="Simpan Data" onClick="processAddArrayCoreDeductionAllowance();">
										</div>
									</div>
								</div>

								<input name="created_on" id="created_on" type="hidden" value="<?php if (empty($data['created_on'])){echo date('Ymdhis');}else{echo $data['created_on'];}?>" />
								
							</div>
						</div>
					</div>
				</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>Daftar
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">									
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Tunjangan</th>
									<th>Rasio Potongan Tunjangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($CoreDeductionallowance)){
									foreach($CoreDeductionallowance as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->CoreDeduction_model->getAllowanceName($val['allowance_id'])."</td>
												<td>".$val['deduction_allowance_ratio']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'CoreDeduction/deleteArrayCoreDeductionAllowance/'.$val['allowance_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='11' style='text-align:center;'>
												<b>Tidak Ada Data</b>
											</td>
										</tr>
									";
								}
							?>		
							<tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-actions right">
					<input type="hidden" name="deduction_id2" id="deduction_id2" value="<?php echo $data['deduction_id'];?>" class="form-control">
					<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>