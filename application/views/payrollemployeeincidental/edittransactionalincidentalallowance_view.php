<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result[employee_id]; ?>";
		document.getElementById("incidental_allowance_period").value = "<?php echo $result[incidental_allowance_period]; ?>";
		document.getElementById("incidental_allowance_amount").value = "<?php echo $result[incidental_allowance_amount]; ?>";
		document.getElementById("incidental_allowance_remark").value = "<?php echo $result[incidental_allowance_remark]; ?>";
	}
	
	function warningamount(value){
		if(isNaN(value)===true || value ==''){
			alert('please input only numbers! ');
			document.getElementById('incidental_allowance_amount').value	= '';
			$('#incidental_allowance_amount').focus();
		}else{
			document.getElementById('incidental_allowance_amount').value	= value;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var employee_id = $("#employee_id").val();
			var incidental_allowance_period = $("#incidental_allowance_period").val();
			var incidental_allowance_amount = $("#incidental_allowance_amount").val();
			
		  	if(employee_id!='' && incidental_allowance_period!='' && incidental_allowance_amount!=''){
				return true;
			}else{
				alert('Data of Incidental Allowance Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Edit Transactional Incidental Allowance
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionalincidentalallowance" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
						</span>
					</a>
				</div>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo base_url();?>">
					Master
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionalincidentalallowance">
					Training Incidental Allowance List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionalincidentalallowance/edit">
					Edit Transactional Incidental Allowance
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Edit
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php 
						echo form_open('transactionalincidentalallowance/processupdatetransactionalincidentalallowance',array('id' => 'myform', 'class' => 'form-horizontal')); 
					?>
						<div class="form-group">
							<label class="control-label col-md-3">Employee Name</label>
							<div class="col-md-3">
								<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Allowance Name</label>
							<div class="col-md-3">
								<?php echo form_dropdown('allowance_id', $allowance ,set_value('allowance_id',$result['allowance_id']),'id="allowance_id", class="form-control select2me"');?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Allowance Period</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="yyyy-mm">
									<input name="incidental_allowance_period" id="incidental_allowance_period" type="text" class="form-control" value="<?php if (empty($result['incidental_allowance_period'])){
										echo date('Y-m');
										}else{
										echo $result['incidental_allowance_period'];
										}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Allowance Amount</label>
							<div class="col-md-3">
								<input type="text" autocomplete="off"  name="incidental_allowance_amount" id="incidental_allowance_amount" onChange="warningamount(this.value);" value="<?php echo $result['incidental_allowance_amount'];?>" class="form-control" placeholder="Allowance Amount">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Remark</label>
							<div class="col-md-8">
								<textarea rows="5" name="incidental_allowance_remark" id="incidental_allowance_remark" class="form-control" placeholder="Remark"><?php echo $result['incidental_allowance_remark'];?></textarea>
							</div>
						</div>		
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
						<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="incidental_allowance_id" value="<?php echo $result['incidental_allowance_id']; ?>"/>
