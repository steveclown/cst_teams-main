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
	
	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedatailufa/getCoreDepartment",
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
               url  : "<?php echo base_url(); ?>hroemployeedatailufa/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    function reset_filter(){
		document.location = base_url+"hroemployeedatailufa/reset_search";
	}
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
								<a href="#">
									Employee Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Employee Data List <small>Manage Employee Data</small>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
				
<?php 
	$data = $this->session->userdata('filter-hroemployeedatailufa');
 	echo form_open('hroemployeedatailufa/filter',array('id' => 'myform', 'class' => '')); 
 ?>

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
									echo form_dropdown('division_id', $coredivision, set_value('division_id', $data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division Name</label>
							</div>	
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->hroemployeedatailufa_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']), 'id="department_id" class="form-control select2me"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" >
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
										$coresection = create_double($this->hroemployeedatailufa_model->getCoreSection($data['department_id']), 'section_id', 'section_name');

										echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me"');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" >
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Section Name</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me" ');
								?>
								<label class="control-label">Branch Name</label>
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
								List
							</div>

							<div class="actions">
								<a href="<?php echo base_url();?>hroemployeedatailufa/addHROEmployeeData" class="btn btn-default sm">
									<i class="fa fa-plus"></i>
									Add Employee Data
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th width="15%">
											Employee Code
										</th>
										<th width="15%">
											Employee Name
										</th>
										<th width="15%">
											Division Name
										</th>
										<th width="15%">
											Department Name
										</th>
										<th width="15%">
											Section Name
										</th>
										<th width="15%">
											Branch Name
										</th>
										<th width="15%">
											Location Name
										</th>
										<th width="10%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										/*print_r("HRO Employee Data ");
										print_r($hroemployeedatailufa);
										*/
										foreach ($hroemployeedatailufa as $key=>$val){
											echo"
												<tr>				
													<td>".$no."</td>					
													<td>".$val['employee_code']."</td>
													<td>".$val['employee_name']."</td>
													<td>".$val['division_name']."</td>
													<td>".$val['department_name']."</td>
													<td>".$val['section_name']."</td>
													<td>".$val['branch_name']."</td>
													<td>".$val['location_name']."</td>
													<td>
														<a href='".$this->config->item('base_url').'hroemployeedatailufa/editHROEmployeeData/'.$val['employee_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
													</td>
												</tr>
											";
											$no++;
										} 
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	