<?php
	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	
?>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_permit(){
		document.location = base_url+"hroemployeeadministrationckp/reset_add_permit/<?php echo $employee_id; ?>/<?php echo $employee_attendance_date; ?>/<?php echo $employee_attendance_data_id; ?>";
	}

	function function_elements_add_permit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckp/function_elements_add_permit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>
<?php 
	$year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i=($year_now); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 
?>

			



<?php 
	echo form_open('hroemployeeattendancediscrepancy/processAddHROEmployeePermit',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$datapermit	= $this->session->userdata('addhroemployeepermit-'.$unique['unique']);

	$employee_id 					= $this->uri->segment(3);	
	$employee_attendance_date 		= $this->uri->segment(4);	
	$employee_attendance_data_id	= $this->uri->segment(5);	

	if (empty($datapermit)){
		$datapermit['employee_permit_date'] 		= $employee_attendance_date;
	}
	if(empty($datapermit['permit_id'])){
		$datapermit['permit_id']=9;
	}
	if (empty($datapermit['employee_permit_description'])) {
		$datapermit['employee_permit_description']="";
		# code...
	}

?>

<?php 
	echo $this->session->userdata('message_permit');
	$this->session->unset_userdata('message_permit');
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_permit_date" name="employee_permit_date" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo tgltoview($datapermit['employee_permit_date']);?>" readonly>
			<label class="control-label">Permit Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('permit_id', $corepermit ,set_value('permit_id',$datapermit['permit_id']),'id="permit_id", class="form-control select2me" onChange="function_elements_add_permit(this.name, this.value);" onChange="function_elements_add_permit(this.name, this.value);"');?>
			<label class="control-label">Permit Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_permit_description" name="employee_permit_description" onChange="function_elements_add_permit(this.name, this.value);" value="<?php echo $datapermit['employee_permit_description'];?>">
			<label class="control-label">Permit Description </label>
		</div>	
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_permit();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"/>
<input type="hidden" name="employee_attendance_date" value="<?php echo $employee_attendance_date; ?>"/>
<input type="hidden" name="employee_attendance_data_id" value="<?php echo $employee_attendance_data_id; ?>"/>
<?php echo form_close(); ?>

<br>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Permit Date</th>
						<th>Permit Name</th>
						<th>Permit Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeepermit)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeepermit as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_permit_date'])."</td>
									<td>".$val['permit_name']."</td>
									<td>".$val['employee_permit_description']."</td>
									<td>
										<a href='".$this->config->item('base_url').'hroemployeeattendancediscrepancy/deleteHROEmployeePermit/'.$val['employee_id']."/".$val['employee_permit_id']."/".$employee_attendance_date."/".$employee_attendance_data_id."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				


