<script>
	base_url = '<?php echo base_url()?>';

	

</script>
<?php 
	// $year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	// for($i=($year_now-2); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 

	$unique 	= $this->session->userdata('unique');

	$data 		= $this->session->userdata('deleteHroEmployeeDataCkp-'.$unique['unique']);
?>

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeDataCkp">
									Daftar Data Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeDataCkp/deleteHROEmployeeData/<?php echo $HroEmployeeDataCkp['employee_id']?>">
									Hapus data karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Hapus data karyawan
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Hapus
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>HroEmployeeDataCkp" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Kembali
					</a>
				</div>
			</div>
			
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>	
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$tabemployeeorganization = "<li class='active'><a href='#tabemployeeorganization' name='employeeorganization' data-toggle='tab' onClick='function_state_delete(this.name);'><b>Organisasi</b></a></li>";
								}else{
									$tabemployeeorganization = "<li><a href='#tabemployeeorganization' data-toggle='tab' name='employeeorganization' onClick='function_state_delete(this.name);'><b>Organisasi</b></a></li>";
								}

								if($data['active_tab']=="employeepersonal"){
									$tabemployeepersonal = "<li class='active'><a href='#tabemployeepersonal' name='employeepersonal' data-toggle='tab' onClick='function_state_delete(this.name)'><b>Personal</b></a></li>";
								}else{
									$tabemployeepersonal = "<li><a href='#tabemployeepersonal' data-toggle='tab' name='employeepersonal' onClick='function_state_delete(this.name)'><b>Personal</b></a></li>";
								}
								
								echo $tabemployeeorganization;
								echo $tabemployeepersonal;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$statemployeeorganization = "active";
								}else{
									$statemployeeorganization = "";
								}

								if($data['active_tab']=="employeepersonal"){
									$statemployeepersonal = "active";
								}else{
									$statemployeepersonal = "";
								}
								
								echo"<div class='tab-pane ".$statemployeeorganization."' id='tabemployeeorganization'>";
									$this->load->view("HroEmployeeDataCkp/formdeletehroemployeeorganization_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeepersonal."' id='tabemployeepersonal'>";
									$this->load->view("HroEmployeeDataCkp/formdeletehroemployeepersonal_view");
								echo"</div>";
							?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<div class="form-actions right">
								<a class="btn red" data-toggle="modal" href="#modaldelete"><i class="fa fa-pencil"></i> Hapus</a>
							</div>
						</div>
					</div>

					<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $HroEmployeeDataCkp['employee_id'];?>">


<?php echo form_open('HroEmployeeDataCkp/processDeleteHROEmployeeData',array('id' => 'myform', 'class' => 'horizontal-form'));?>
<!-- /.modal -->
<script>
	$(document).ready(function(){
        $("#Save").click(function(){
			var employee_data_deleted_remark = $("#employee_data_deleted_remark").val();
			
		  	if(employee_data_deleted_remark!=''){
				return true;
			}else{
				alert('Please insert remark');
				return false;
			}
		});
    });
</script>
<div class="modal fade bs-modal-lg" id="modaldelete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-salesorder">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<h4 class="modal-title">Delete HRO Employee Data</h4>
				<div class="row">
					<div class="col-md-12">
						<label class="control-label">Keterangan</label>
						<div class="input-icon right">
							<i class="fa"></i>
							<?php echo form_textarea(array('rows'=>'3','name'=>'employee_data_deleted_remark','class'=>'form-control','id'=>'employee_data_deleted_remark','value'=>set_value('employee_data_deleted_remark',$HroEmployeeDataCkp['employee_data_deleted_remark'])))?>
						</div>	
					</div>	
				</div>
					
				<input type="hidden" class="form-control" name="employee_id" id="employee_id"  value="<?php echo $HroEmployeeDataCkp['employee_id'];?>"/>
					
				<div class="modal-footer">
					<button type="button" class="btn red" data-dismiss="modal">Tutup</button>
					<button type="submit" id="Save" class="btn green"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</div>
				<!-- /.modal-content -->
		</div>
			<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->
<?php
	echo form_close(); 
?>	
				</div>
			</div>
		</div>
	</div>
</div>
