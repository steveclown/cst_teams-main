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

