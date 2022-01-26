<script>
	base_url = '<?php echo base_url()?>';

	mappia = "	<?php 
					$site_url = 'CoreDeduction/editCoreDeduction/'.$CoreDeduction['deduction_id'];
					echo site_url($site_url); 
				?>";

	function reset_edit(){
		document.location = base_url+"CoreDeduction/reset_edit/<?php echo $this->uri->segment(3); ?>";
	}

	function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreDeduction/function_elements_edit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function processEditArrayCoreDeductionAllowance(){
		
		var allowance_id 					= document.getElementById("allowance_id").value;
		var deduction_allowance_ratio 		= document.getElementById("deduction_allowance_ratio").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('CoreDeduction/processEditArrayCoreDeductionAllowance');?>",
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
	echo form_open('CoreDeduction/processEditCoreDeduction',array('id' => 'myform', 'class' => 'horizontal-form')); 

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$sesi 	= $this->session->userdata('unique');
	$data 	= $this->session->userdata('editCoreDeduction-'.$sesi['unique']);

	/*print_r("data ");
	print_r($data);*/
?>

<?php 
	$sesi 	= $this->session->userdata('unique');
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	if($this->uri->segment(3)!=''){
		$uri = $this->uri->segment(3);
	}else{
		$uri = '';
	}

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
		$data['deduction_premi_attendance_status']="";
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
						Daftar potongan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreDeduction/editCoreDeduction/<?php echo $CoreDeduction['deduction_id']; ?>">
						Edit Potongan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
		Form Edit Potongan 
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
									<input type="text" autocomplete="off"  name="deduction_code" id="deduction_code" class="form-control" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $data['deduction_code']?>">
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
									<input type="text" autocomplete="off"  name="deduction_name" id="deduction_name" class="form-control" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $data['deduction_name']?>" >
									<label class="control-label">Nama Potongan</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('deduction_type', $deductiontype, $data['deduction_type'], 'id ="deduction_type", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');?>
									<label class="control-label">Tipe Potongan
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_amount" id="deduction_amount" class="form-control" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $data['deduction_amount']?>">
									<label class="control-label">Jumlah Potongan</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_premi_attendance_ratio" id="deduction_premi_attendance_ratio" class="form-control" value="<?php echo $data['deduction_premi_attendance_ratio']?>" onChange="function_elements_edit(this.name, this.value);">
									<label class="control-label">Rasio Potongan Premi kehadiran</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('deduction_premi_attendance_status', $deductionpremiattendancestatus ,set_value('deduction_premi_attendance_status', $data['deduction_premi_attendance_status']),'id="deduction_premi_attendance_status", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
									?>
									<label class="control-label">Status Potongan Premi Kehadiran</label>
								</div>
							</div>
						</div>

						<div class = "row">	
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_basic_salary_ratio" id="deduction_basic_salary_ratio" class="form-control" value="<?php echo $data['deduction_basic_salary_ratio']?>" onChange="function_elements_edit(this.name, this.value);">
									<label class="control-label">Rasio Potongan Gaji Pokok</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_late_start_duration" id="deduction_late_start_duration" class="form-control" value="<?php echo $data['deduction_late_start_duration']?>" onChange="function_elements_edit(this.name, this.value);">
									<label class="control-label">Potongan Keterlambatan awal</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_late_end_duration" id="deduction_late_end_duration" class="form-control" value="<?php echo $data['deduction_late_end_duration']?>" onChange="function_elements_edit(this.name, this.value);">
									<input type="hidden" name="deduction_id" value="<?php echo $data['deduction_id']; ?>"/>
									<label class="control-label">Potongan Keterlambatan akhir</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="deduction_remark" id="deduction_remark" class="form-control"><?php echo $data['deduction_remark']?></textarea>
									<label class="control-label">Keterangan Potongan</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-actions right">
								<input type="hidden" name="deduction_id2" id="deduction_id2" value="<?php echo $CoreDeduction['deduction_id'];?>" class="form-control">
								<button type="button" class="btn red" onClick="reset_edit();"><i class="fa fa-times"></i> Batal</button>
								<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>