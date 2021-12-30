<script>
	base_url 	= '<?php echo base_url()?>';
	mappia = "	<?php 
					$site_url = 'hroemployeeemployment/addHROEmployeeEmployment/'.$hroemployeedata['employee_id'];
					echo site_url($site_url); 
				?>";

	function reset_add_appraisal(){
		document.location = base_url+"hroemployeeemployment/reset_add_appraisal/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_appraisal(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemployment/function_elements_add_appraisal');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}

	function reset_add_detail(){
		document.location = base_url+"hroemployeeemployment/reset_add_detail/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_detail(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemployment/function_elements_add_detail');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}

	function processAddArrayHROEmployeeAppraisalDetail(){
		var appraisal_id 						= document.getElementById("appraisal_id").value;
		var employee_appraisal_detail_value	 	= document.getElementById("employee_appraisal_detail_value").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('hroemployeeemployment/processAddArrayHROEmployeeAppraisalDetail');?>",
			  data: {
					'appraisal_id' 						: appraisal_id, 
					'employee_appraisal_detail_value' 	: employee_appraisal_detail_value, 
					'session_name' 						: "addarrayorganization-"
					},
			  success: function(msg){

			   window.location.replace(mappia);
			 }
			});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

					
				
<?php 
	echo form_open('hroemployeeemployment/processAddHROEmployeeAppraisal',array('id' => 'myform', 'class' => 'horizontal-form')); 
	
	$unique 		= $this->session->userdata('unique');

	$dataappraisal	= $this->session->userdata('addhroemployeeappraisal-'.$unique['unique']);

	if (empty($dataappraisal)){
		$dataappraisal['employee_appraisal_date'] 		= date("Y-m-d");
	}
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_appraisal_date" id="employee_appraisal_date" onChange="function_elements_add_appraisal(this.name, this.value);" value="<?php echo tgltoview($dataappraisal['employee_appraisal_date']);?>"/>
			<label class="control-label">Appraisal Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_appraisal_remark" id="employee_appraisal_remark" onChange="function_elements_add_appraisal(this.name, this.value);" class="form-control"><?php echo $dataappraisal['employee_appraisal_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<h4 class = "form-section bold">Data Appraisal</h4>

<?php
	$unique 					= $this->session->userdata('unique');
	$hroemployeeappraisaldetail	= $this->session->userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique']);
	$dataappraisaldetail		= $this->session->userdata('addhroemployeeappraisaldetail-'.$unique['unique']);	
?>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('appraisal_id', $coreappraisal, set_value('appraisal_id', $dataappraisaldetail['appraisal_id']),'id="appraisal_id" class="form-control select2me" onChange="function_elements_add_detail(this.name, this.value);"');
			?>
			<label>Appraisal Name</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_appraisal_detail_value" name="employee_appraisal_detail_value" onChange="function_elements_add_detail(this.name, this.value);" value="<?php echo $dataappraisaldetail['employee_appraisal_detail_value'];?>">
			<label>Appraisal Value</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeAppraisalDetail" value="Reset" class="btn red" title="Reset" onClick="reset_add_detail();">
		<input type="button" name="Add2" id="buttonAddArrayHROEmployeeAppraisalDetail" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayHROEmployeeAppraisalDetail();">
	</div>
</div>
<br>
<br>


			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="15%">No.</th>
									<th style='text-align:center' width="25%">Appraisal Name</th>
									<th style='text-align:center' width="25%">Appraisal Value</th>
									<th style='text-align:center' width="25%">Appraisal Code</th>
									<th style='text-align:center' width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($hroemployeeappraisaldetail)){
									foreach($hroemployeeappraisaldetail as $key => $val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>".$no."</td>
												<td>".$this->hroemployeeemployment_model->getAppraisalName($val['appraisal_id'])."</td>
												<td>".$val['employee_appraisal_detail_value']."</td>
												<td>".$val['employee_appraisal_detail_code']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'hroemployeeemployment/deleteArrayHROEmployeeAppraisalDetail/'.$hroemployeedata['employee_id'].'/'.$val['appraisal_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='6' style='text-align:center;'>
												<b>No Data</b>
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

<br>
<br>
<br>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_appraisal();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>

<br>
							
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Appraisal Date</th>
						<th>Appraisal Total Value</th>
						<th>Appraisal Remark</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeappraisal)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeappraisal as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_appraisal_date'])."</td>
									<td>".$val['employee_appraisal_total_value']."</td>
									<td>".$val['employee_appraisal_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeemployment/deleteHROEmployeeAppraisal/'.$val['employee_id']."/".$val['employee_appraisal_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
										<a href='".$this->config->item('base_url').'hroemployeeemployment/detailHROEmployeeAppraisal/'.$val['employee_id']."/".$val['employee_appraisal_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs yellow-lemon'>
											<i class='fa fa-trash-o'></i> Detail
										</a>";

									echo"
								</tr>
								
							";
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>