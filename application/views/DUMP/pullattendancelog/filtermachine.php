<?php 
	echo form_open('pullattlog/selectmachine');
	$sesi	= 	$this->session->userdata('filter-selectmachine');
	if(!is_array($sesi)){
		$sesi['ip']			='192.168.0.10';
		$sesi['comkey']		='0';
		$sesi['start_date']	=date('d-m-Y');
		$sesi['end_date']	=date('d-m-Y');
	}
?>
<style>
	input[type="submit"], input[type="reset"] {
		width:100px !important;
		margin : 0 auto;
	}
	.row-form {
		padding:5px !important;
	}
	.dr {
		height: 5px;
		margin: 7px 0px !important;
	}
	th{
		vertical-align : middle !important;
		text-align : center !important;
	}
</style>
<script>
	base_url = '<?= base_url() ?>';
	
	function ulang(){
		document.location= base_url+"pullattlog/reset_machine";
	}
</script>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Pull Attendance Log
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<a href="<?php echo base_url();?>pullattlog">
					Select Machine
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
					<i class="fa fa-reorder"></i>Form Add
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-md-3">IP</label>
							<div class="col-md-3">
								<input type="text" name="ip" id="ip" value="<?php echo $sesi['ip'];?>" class="form-control" placeholder="">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Com Key</label>
							<div class="col-md-3">
								<input type="text" name="comkey" id="comkey" value="<?php echo $sesi['comkey'];?>" class="form-control" placeholder="">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Start Date</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
								<input name="start_date" id="start_date" type="text" class="form-control" value="<?php if (empty($sesi['start_date'])){
											echo date('d-m-Y');
										}else{
											echo $sesi['start_date'];
									}?>" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>	
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">End Date</label>
							<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
								<input name="end_date" id="end_date" type="text" class="form-control" value="<?php if (empty($sesi['end_date'])){
											echo date('d-m-Y');
										}else{
											echo $sesi['end_date'];
									}?>" readonly>
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
								</span>
							</div>	
						</div>
						
					</div>					
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
						<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php //echo form_close(); ?>
	<!--<div class="head">
		<div class="isw-grid"></div>
		<h1>Select Machine</h1>                       
		<div class="clear"></div>
	</div>
	<div class="block-fluid">                        
		<div class="row-form">
			<div class="span2">IP</div>
			<div class="span2" style="margin-left:0px !important;">
				<input type="text" name="ip" value="<?=$sesi['ip']?>" size=15>
			</div>
			<div class="span2">Com Key</div>
			<div class="span2" >
				<input type="text" name="comkey" value="<?=$sesi['comkey']?>" size=15>
			</div>
			<div class="span3" style="margin-left:60px !important; text-align  : right !important;">
				<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="ulang();">
				<input type="submit" name="Pull Off" value="Get Data" class="btn ttLT" title="Get Data">
			</div>
			<div class="clear"></div>
		</div>
	</div>-->
<?php echo form_close(); ?>