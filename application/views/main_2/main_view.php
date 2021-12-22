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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<?php 
	$selectedemployee=$this->session->userdata('selectedemployee');
	//session tab aktif
	$tabatas=$this->session->userdata('tabatas');
	$tabbawah=$this->session->userdata('tabbawah');
	// $tabatas="coverage";
	// $tabbawah="glassescoverage";
	
?>
<script>
function reload(value) {
	var employee_id = document.getElementById("employee_id").value;
	
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>main/setselectedindexsession",
	   data: {'employee_id' : employee_id},
	   success: function(data){
			window.location = "<?php echo base_url(); ?>main";
	   }
	});	
}
function setselectedtab(value) {
	// alert(value);
	$.ajax({
	   type : "POST",
	   url  : "<?php echo base_url(); ?>main/setselectedtab",
	   data: {'selectedtab' : value},
	   success: function(data){
	   }
	});	
}

</script>
<?php
	// $msg = "<div class='alert alert-success'>
	// Transaksional yang sudah : <br>
	// Coverage/Medical Claim <br>
	// Coverage/Glasses Claim <br>
	// Coverage/Hospital Claim <br>
	// Coverage/Medical Adjustment <br>
	// Coverage/Glasses Adjustment <br>
	// Coverage/Hospital Adjustment <br>
	// Award & Warning/Award</br>
	// Award & Warning/Warning</br>
	// <button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
	// $this->session->set_userdata('message',$msg);
	// echo $this->session->userdata('message');
	// $this->session->unset_userdata('message');

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<!--
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					
				</div>
				<div class="actions">
					<a href="main/addemployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i>Add
					</a>
					<a data-toggle="modal" href="#mainfilter" class="btn default btn-sm">
						<i class="fa fa-search icon-black"></i>Search
					</a>
					<a href="main/reset_filter" class="btn default btn-sm">
						<i class="fa fa-search-minus icon-black"></i>Reset
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<div class="row">
	
</div>

<!-- BEGIN FORM-->
<?php
	echo form_open('main/filter',array('id' => 'myform', 'class' => 'horizontal-form'));
	$sesi=$this->session->userdata('filter-employee');
	if(!is_array($sesi)){
		$sesi['filter_employee_name'] ='';
		$sesi['sort_employee_name'] ='';
	}
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
					<a href="<?php echo base_url();?>main">
						Executive Dashboard  
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
			Executive Dashboard
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->


<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Current Selection
				</div>
			</div>
			<div class="portlet-body">
				<div id='currentselectionlist' style='margin-left:10px; height:100px !important;overflow-y:auto;'>
					<?php echo $this->load->view('main/currentselection_view');?>
				</div>
				<hr style="margin: 0 !important;">
				<!--<div class="reset-fill">
					<a href='javascript:resetFilter()' title='Reset Selections'>Reset Selections</a>
				</div>-->
				<div class="clear"></div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					Filter
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-6">
									<div id='loaderParticipant' style="width: 23.076923076923077%; text-align:center"></div>
									<div id='participantrow'>
										<div class="span3" style="margin-left:20px;">Participant</div>
											<div class="span5" style="width: 300px; height: 120px">
												<div class="block-fluid table-sorting">
													<table height="100px" cellpadding="0" cellspacing="0" width="100%" class="table">
														<div id='participantlist'>
															<?php 
																$this->load->view('transactiontestingresult/treeviewparticipant_view');
															?>
														</div>
													</table>
												</div>
											</div>
									
									</div>
								</div>
								
								<div class="col-md-6">
									<div id='loaderIQClass' style="width: 23.076923076923077%; text-align:center"></div>
									<div id='IQClassrow'>
										<div class="span3" style="margin-left:20px;">IQ Classification</div>
											<div class="span5" style="width: 300px; height: 120px">
												<div class="block-fluid table-sorting">
													<table height="100px" cellpadding="0" cellspacing="0" width="100%" class="table">
														<div id='IQClasslist'>
															<?php 
																$this->load->view('transactiontestingresult/treeviewiqclass_view');
															?>
														</div>
													</table>
												</div>
											</div>
									
									</div>
								</div>
							</div>

							<div class = "row">
								<div class="col-md-6">
									<div id='loaderCoreIntellectual' style="width: 23.076923076923077%; text-align:center"></div>
									<div id='coreIntellectualRow'>
										<div class="span3" style="margin-left:20px;">Intellectual List</div>
											<div class="span5" style="width: 300px; height: 120px">
												<div class="block-fluid table-sorting">
													<table height="100px" cellpadding="0" cellspacing="0" width="100%" class="table">
														<div id='coreIntellectualList'>
															<?php 
																$this->load->view('transactiontestingresult/treeviewintellectual_view');
															?>
														</div>
													</table>
												</div>
											</div>
									
									</div>
								</div>
							</div>					
						</div>
					</div>
				</div>
			</div>
		</div>
	
	
			
	<?php
		$this->load->view('transactiontestingresult/drilldown_view'); 
	?>
	
	</div>
</div>
	<!-- /.modal -->
<?php
echo form_close(); 
?>