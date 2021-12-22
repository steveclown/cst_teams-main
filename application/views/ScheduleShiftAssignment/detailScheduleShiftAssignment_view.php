<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleShiftAssignment">Tugas Shift</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Detail Tugas Shift
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->	
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleShiftAssignment/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php  
						echo form_open('ScheduleShiftAssignment/processAddScheduleShiftAssignment',array('class' => 'horizontal-form'));

						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('addScheduleShiftAssignment-'.$unique['unique']);

						if (empty($data)){
							$data['shift_assignment_start_date']	= date("Y-m-d");
                      	}
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_name" id="division_name" class="form-control" value="<?php echo $ScheduleShiftAssignment['division_name']; ?>" readonly onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Nama Devisi
									<span class="required">*</span>
								</label>
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
			Daftar
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th width="5%" >No</th>
									<th>Kode Pola Shift</th> 
									<th>Nama Pola Shift</th>
									<th>Tanggal Mulai </th>			
									<th>Siklus Tugas Shift</th>	
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									if(!is_array($ScheduleShiftAssignmentitem)){
										echo "<tr><th colspan='12'>Data is empty</th></tr>";
									}else{
										foreach ($ScheduleShiftAssignmentitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>".$no."</td>
													<td>".$val['shift_pattern_code']."</td>
													<td>".$val['shift_pattern_name']."</td>
													<td>".tgltoview($val['shift_assignment_start_date'])."</td>
													<td>".$val['shift_assignment_cycle']."</td>
												</tr>
											";
											$no++;
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>