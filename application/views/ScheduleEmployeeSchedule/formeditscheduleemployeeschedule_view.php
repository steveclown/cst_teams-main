<script>
base_url = '<?= base_url()?>';

function moveScheduleEmployeeScheduleItem(id)
{
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    // alert(id);
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_url('scheduleemployeeschedule/moveScheduleEmployeeScheduleItem/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('#employee_schedule_item_id').val(data.employee_schedule_item_id);
            $('#employee_schedule_id').val(data.employee_schedule_id);
            $('#employee_shift_id').val(data.employee_shift_id);
            $('#shift_id').val(data.shift_id);
            $('#shift_name').val(data.shift_name);
            $('#employee_id').val(data.employee_id);
            $('#employee_schedule_item_date').val(data.employee_schedule_item_date);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Employee Schedule'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}
</script>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Employee Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>scheduleemployeeschedule">Edit Employee Schedule</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Edit Employee Schedule
</h1>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>scheduleemployeeschedule/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
						
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_pattern_name" id="shift_pattern_name" value="<?php echo $scheduleemployeeschedule['shift_pattern_name']; ?>" class="form-control" disabled>
								<label for="form_control">Shift Pattern Name</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date" value="<?php echo tgltoview($scheduleemployeeschedule['employee_schedule_date']);?>" disabled>
								<label for="form_control">Date</label>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th style='text-align:center'>Shift Name</th>
								<th style='text-align:center'>Employee Name</th>
								<th style='text-align:center'>Date</th>
								<th style='text-align:center'>Start Working Hour</th>
								<th style='text-align:center' width="15%">Status</th>
								<th></th> 					
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($scheduleemployeescheduleitem as $key=>$val){
									echo"
									<tr>
										<td style='text-align:center'>".$val['shift_name']."</td>
										<td>".$val['employee_name']."</td>
										<td style='text-align:center'>".$val['employee_schedule_item_date']."</td>
										<td style='text-align:center'>".$val['start_working_hour']."</td>
										<td style='text-align:center'>".$this->configuration->ScheduleEmployeeScheduleItemStatus[$val['employee_schedule_item_status']]."
										<td><a href='javascript:void(0)' onclick='moveScheduleEmployeeScheduleItem($val[employee_schedule_item_id])' class='btn default btn-xs red'>Move
												</td>
									</tr>
									";
								}
							?>
						</tbody>
					</table>
					
				</div>
			</div>
			<label></label>	
		</div>
	</div>
</div>



<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Employee Schedule</h3>
            </div>
            <div class="modal-body form">
                <?php echo form_open('scheduleemployeeschedule/processMoveScheduleEmployeeScheduleItem',array('class' => 'horizontal-form')); ?>
                    <input type="hidden" value="" name="employee_schedule_item_id" id="employee_schedule_item_id" />
                    <input type="hidden" value="" name="employee_schedule_id" id="employee_schedule_id" />
                    <input type="hidden" value="" name="employee_shift_id" id="employee_shift_id" />
                    <input type="hidden" value="" name="employee_id" id="employee_id" />
                    <div class="form-body">
                    	<div class="row">
	                        <div class="col-md-6">
	                        	<div class="form-group form-md-line-input">
	                        		<label class="form_control">Shift Name</label>
						            <input name="shift_name" id="shift_name" placeholder="Shift Name" class="form-control" type="text">
	                                <span class="help-block"></span>

	                                
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                        	<div class="form-group form-md-line-input">
	                        		<label class="form_control">Date</label>
	                                <input name="employee_schedule_item_date" id="employee_schedule_item_date" placeholder="Date" class="form-control" type="text" data-date-format="dd-mm-yyyy">
	                                <span class="help-block"></span>
	                            </div>
	                        </div>	
                    	</div>
                    	<br>
                    	<h3>Move</h3>
                    	<div class="row">
	                       <div class="col-md-6">
		                        <div class="form-group form-md-line-input">
		                        	<label class="form_control">Shift Name</label>
									<?php
									$coreshift = create_double($this->scheduleemployeeschedule_model->getCoreShift(), 'shift_id','shift_name');
						            	echo form_dropdown('shift_id', $coreshift ,set_value('shift_id', $data['shift_id']),'id="shift_id", class="form-control select2me"');
						            ?>
	                                <span class="help-block"></span>
	                                
	                            </div>
	                        </div>
	                        <div class="col-md-6">
		                        <div class="form-group form-md-line-input">
		                        	<label class="form_control">Date</label>
	                                <input name="employee_schedule_item_date2" id="employee_schedule_item_date2" placeholder="Date" class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text">
	                                <span class="help-block"></span>
	                            </div>
	                        </div>
	                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn green-jungle" id="save" name="save">Save</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<?php echo form_close(); ?>