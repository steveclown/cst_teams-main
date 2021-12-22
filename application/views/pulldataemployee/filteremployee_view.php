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
</style>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Pull Data Employee
		</h3>
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$sesi	= 	$this->session->userdata('filter-employee');
	// print_r($sesi);exit;
	if(!is_array($sesi)){
			$sesi['machine_id']						='';
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Pull Data Employee
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
				<?php 
					echo form_open('pulldataemployee/filter', array('id' => 'myform', 'class' => 'form-horizontal'));
				?>
					<div class="form-group">
						<label class="control-label col-md-3">Select Machine
						</label>
						<div class="col-md-4">
							<?php 
							if($sesi['machine_id'] != ""){
								echo form_dropdown('machine_id', $machine, $sesi['machine_id'], 'id ="machine_id" class="form-control select2me" disabled');
							}else{
								echo form_dropdown('machine_id', $machine, $sesi['machine_id'], 'id ="machine_id" class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-actions right">
						<a href="pulldataemployee/resetfilter" class="btn red"><i class="fa fa-times"></i> Reset</a>
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('pulldataemployee/resultemployee_view');?>