<script>
	function ulang() {
		document.getElementById("employee_allowance_id").value = "<?php echo $result['employee_allowance_id'] ?>";
		document.getElementById("allowance_id").value = "<?php echo $result['allowance_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_allowance_period").value = "<?php echo $result['employee_allowance_period'] ?>";
		document.getElementById("employee_allowance_amount").value = "<?php echo $result['employee_allowance_amount'] ?>";
		document.getElementById("employee_allowance_remark").value = "<?php echo $result['employee_allowance_remark'] ?>";
	}
</script>
<?php
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Edit Employee Allowance Data
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url(); ?>hroemployeeallowance" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							Back
						</span>
					</a>
				</div>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo base_url(); ?>">
					Master
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>hroemployeeallowance">
					Employee Allowance Data List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>hroemployeeallowance/edit/<?php echo $result['employee_allowance_id']; ?>">
					Edit Employee Allowance Data
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form add
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
					echo form_open('hroemployeeallowance/processEdithroemployeeallowance', array('id' => 'myform', 'class' => 'form-horizontal'));
					$employee_id =  $this->session->userdata('employee_id');
					?>
					<div class="form-group">
						<label class="col-md-3 control-label">Allowance Name
							<span class="required">
								*
							</span></label>
						<div class="col-md-8">
							<?php echo form_dropdown('allowance_id', $allowance, set_value('allowance_id', $result['allowance_id']), 'id="allowance_id", class="form-control select2me"'); ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Employee Name
							<span class="required">
								*
							</span></label>
						<div class="col-md-8">
							<input type="text" autocomplete="off" name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeallowance_model->getemployeename($employee_id) ?>" class="form-control" placeholder="Employee Name" readonly>
							<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Period
							<span class="required">
								*
							</span></label>
						<div class="col-md-8">
							<input type="text" autocomplete="off" name="employee_allowance_period" id="employee_allowance_period" value="<?php echo $result['employee_allowance_period'] ?>" class="form-control" placeholder="Period">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Amount
							<span class="required">
								*
							</span></label>
						<div class="col-md-8">
							<input type="text" autocomplete="off" name="employee_allowance_amount" id="employee_allowance_amount" value="<?php echo $result['employee_allowance_amount'] ?>" class="form-control" placeholder="Amount">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<textarea rows="5" name="employee_allowance_remark" id="employee_allowance_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_allowance_remark']; ?></textarea>
						</div>
					</div>
				</div>
				<input type="hidden" name="employee_allowance_id" value="<?php echo $result['employee_allowance_id']; ?>" />
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>