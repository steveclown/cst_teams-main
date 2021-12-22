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
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeeattendance/reset_search";
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeattendance/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeattendance/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
        	var division_id 	= $("#division_id").val();
        	var department_id 	= $("#department_id").val();
            var section_id 		= $("#section_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeattendance/getHROEmployeeData",
               data : {division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);
               }
            });
        });
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendance/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeattendance">
							Employee Attendance List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Employee Attendance List <small>Manage Employee Attendance</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('hroemployeeattendance/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division</label>
							</div>	
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->hroemployeeattendance_model->getCoreDepartment($data['division_id']),'department_id','department_name');

										echo form_dropdown('department_id', $coredepartment,set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Department Name</label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['department_id'])){
										$coresection = create_double($this->hroemployeeattendance_model->getCoreSection($data['department_id']),'section_id','section_name');

										echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Section Name</label>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['section_id'])){
										$hroemployeedata = create_double($this->hroemployeeattendance_model->getHROEmployeeData($data['division_id'], $data['department_id'], $data['section_id']),'employee_id','employee_name');

										echo form_dropdown('employee_id', $hroemployeedata,set_value('employee_id',$data['employee_id']),'id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Employee Code
								</th>
								<th>
									Employee Name
								</th>
								<th>
									Division Name
								</th>
								<th>
									Department Name
								</th>
								<th>
									Section Name
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeedata_attendance as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_code']."</td>
											<td>".$val['employee_name']."</td>
											<td>".$val['division_name']."</td>
											<td>".$val['department_name']."</td>
											<td>".$val['section_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeeattendance/addHROEmployeeAttendance/'.$val['employee_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Add
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>