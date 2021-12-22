<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeepresent/reset_search";
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeepresent/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeepresent/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
        	var division_id = $("#division_id").val();
        	var department_id = $("#department_id").val();
            var section_id = $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeepresent/getHroEmployeeData",
               data : {division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });
</script>
			
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
			<a href="hroemployeepresent">
				Employee Present List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>	
<!-- END PAGE TITLE & BREADCRUMB-->
<h1 class="page-title">
	Employee Present List
</h1>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<?php echo form_open('hroemployeepresent/filter',array('id' => 'myform', 'class' => '')); ?>
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
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Department</label>
							</div>	
						</div>
					</div>
					
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Section </label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<label class="control-label">Employee Name </label>
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

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
								<th width="5%">No</th>
								<th>Employee Name</th>
								<th>Division Name</th>
								<th>Department Name</th>
								<th>Section Name</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeepresent as $key=>$val){
									
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_name']."</td>
											<td>".$this->hroemployeepresent_model->getCoreDivisionName($val['division_id'])."</td>
											<td>".$this->hroemployeepresent_model->getCoreDepartmentName($val['department_id'])."</td>
											<td>".$this->hroemployeepresent_model->getCoreSectionName($val['section_id'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeepresent/addHroEmployeePresent/'.$val['employee_id']."' class='btn default btn-xs green-jungle'>
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