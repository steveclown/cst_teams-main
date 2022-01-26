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
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('hroemployeedatailufa/addHROEmployeeData'); ?>";

	function reset_add_family(){
		document.location = base_url+"hroemployeedatailufa/reset_add_family";
	}

	function function_elements_add_family(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_elements_add_family');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function processAddArrayHROEmployeeFamily(){
		
		var family_relation_id					= document.getElementById("family_relation_id").value;
		var employee_family_name				= document.getElementById("employee_family_name").value;
		var employee_family_address				= document.getElementById("employee_family_address").value;
		var employee_family_city				= document.getElementById("employee_family_city").value;
		var employee_family_postal_code			= document.getElementById("employee_family_postal_code").value;
		var employee_family_rt					= document.getElementById("employee_family_rt").value;
		var employee_family_rw					= document.getElementById("employee_family_rw").value;
		var employee_family_kelurahan			= document.getElementById("employee_family_kelurahan").value;
		var employee_family_kecamatan			= document.getElementById("employee_family_kecamatan").value;
		var employee_family_home_phone			= document.getElementById("employee_family_home_phone").value;
		var employee_family_mobile_phone		= document.getElementById("employee_family_mobile_phone").value;
		var employee_family_gender				= document.getElementById("employee_family_gender").value;
		var marital_status_id					= document.getElementById("family_marital_status_id").value;
		var employee_family_date_of_birth		= document.getElementById("employee_family_date_of_birth").value;
		var employee_family_place_of_birth		= document.getElementById("employee_family_place_of_birth").value;
		var employee_family_education			= document.getElementById("employee_family_education").value;
		var employee_family_remark				= document.getElementById("employee_family_remark").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('hroemployeedatailufa/processAddArrayHROEmployeeFamily');?>",
			  data: {
					'family_relation_id' 				: family_relation_id,	
					'employee_family_name'				: employee_family_name,	
					'employee_family_address'			: employee_family_address,	
					'employee_family_city'				: employee_family_city,	
					'employee_family_postal_code'		: employee_family_postal_code,	
					'employee_family_rt'				: employee_family_rt,	
					'employee_family_rw'				: employee_family_rw,	
					'employee_family_kelurahan'			: employee_family_kelurahan,	
					'employee_family_kecamatan'			: employee_family_kecamatan,	
					'employee_family_home_phone'		: employee_family_home_phone,	
					'employee_family_mobile_phone'		: employee_family_mobile_phone,	
					'employee_family_gender'			: employee_family_gender,	
					'marital_status_id'					: marital_status_id,	
					'employee_family_date_of_birth'		: employee_family_date_of_birth,	
					'employee_family_place_of_birth'	: employee_family_place_of_birth,	
					'employee_family_education'			: employee_family_education,	
					'employee_family_remark'			: employee_family_remark,	
					'session_name' 						: "addarraypurchaseorderitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});

	}
</script>

					

<?php
	$unique 			= $this->session->userdata('unique');
	$data 				= $this->session->userdata('addhroemployeefamily-'.$unique['unique']);

	$hroemployeefamily	= $this->session->userdata('addarrayhroemployeefamily-'.$unique['unique']);
?>			
								
<?php 
	echo $this->session->userdata('message_family');
	$this->session->unset_userdata('message_family');
?>							
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('family_relation_id', $corefamilyrelation ,set_value('family_relation_id', $data['family_relation_id']),'id="family_relation_id", class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');?>
			<label class="control-label">Family Relation
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_name" id="employee_family_name" value="<?php echo $data['employee_family_name']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Family Name
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
			<textarea rows="3" name="employee_family_address" id="employee_family_address" class="form-control" onChange="function_elements_add_family(this.name, this.value);" ><?php echo $data['employee_family_address'];?></textarea>
			<label class="control-label">Address</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_city" id="employee_family_city" value="<?php echo $data['employee_family_city']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">City</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_postal_code" id="employee_family_postal_code" value="<?php echo $data['employee_family_postal_code']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Postal Code</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_rt" id="employee_family_rt" value="<?php echo $data['employee_family_rt']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_rw" id="employee_family_rw" value="<?php echo $data['employee_family_rw']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_kelurahan" id="employee_family_kelurahan" value="<?php echo $data['employee_family_kelurahan']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_kecamatan" id="employee_family_kecamatan" value="<?php echo $data['employee_family_kecamatan']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_home_phone" id="employee_family_home_phone" value="<?php echo $data['employee_family_home_phone']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Home Phone</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_mobile_phone" id="employee_family_mobile_phone" value="<?php echo $data['employee_family_mobile_phone']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Mobile Phone</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_family_gender', $gender ,set_value('employee_family_gender',$data['employee_family_gender']),'id="employee_family_gender", class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');?>
			<label class="control-label">Gender</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('family_marital_status_id', $coremaritalstatus ,set_value('family_marital_status_id',$data['marital_status_id']),'id="family_marital_status_id", class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');?>
			<label class="control-label">Marital Status</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_family_date_of_birth" id="employee_family_date_of_birth" onChange="function_elements_add_family(this.name, this.value);" value="<?php echo tgltoview($data['employee_family_date_of_birth']);?>"/>
			<label class="control-label">Date Of Birth
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_place_of_birth" id="employee_family_place_of_birth" value="<?php echo $data['employee_family_place_of_birth']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);" >
			<label class="control-label">Place Of Birth</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_education" id="employee_family_education" value="<?php echo $data['employee_family_education']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Education</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_family_occupation" id="employee_family_occupation" value="<?php echo $data['employee_family_occupation']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Occupation</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="5" name="employee_family_remark" id="employee_family_remark" class="form-control" onChange="function_elements_add_family(this.name, this.value);"><?php echo $data['employee_family_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeFamily" value="Reset" class="btn red" title="Reset" onClick="reset_add_family();">
		<input type="button" name="Add2" id="buttonAddArrayHROEmployeeFamily" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayHROEmployeeFamily();">
	</div>
</div>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Family Relation</th>
						<th>Family Name</th>
						<th>City</th>
						<th>Mobile Phone</th>
						<th>Education</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeefamily)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeefamily as $key => $val){
							echo"
								<tr>
									<td>".$this->hroemployeedatailufa_model->getFamilyRelationName($val['family_relation_id'])."</td>
									<td>".$val['employee_family_name']."</td>
									<td>".$val['employee_family_city']."</td>
									<td>".$val['employee_family_mobile_phone']."</td>
									<td>".$val['employee_family_education']."</td>
									<td>
									<a href='".$this->config->item('base_url').'hroemployeedatailufa/deleteArrayHROEmployeeFamily/'.$val['record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
										<i class='fa fa-trash-o'></i> Delete
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