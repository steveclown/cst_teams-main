<div class = "page-bar">
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				Home
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeepresent">
				Employee Present
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">
				Add Employee Present
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Add Employee Present
</h1>

<?php
	echo form_open('hroemployeepresent/processAddHroEmployeePresent',array('id' => 'myform', 'class' => 'horizontal-form')); 
	?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeepresent" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">														
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_code" id="employee_code" value="<?php echo $hroemployeedata['employee_code']?>" class="form-control" readonly>
								<label class="control-label">Employee Code</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>	
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="reset" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>