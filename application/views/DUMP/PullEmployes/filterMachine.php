<?php 
	echo form_open('pullemployes/selectMachine');
	$sesi	= 	$this->session->userdata('filter-selectMachine');
	if(!is_array($sesi)){
		$sesi['ip']			='192.168.0.10';
		$sesi['comkey']		='0';
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
		document.location= base_url+"pullemployes/reset_machine";
	}
</script>
	<div class="head">
		<div class="isw-grid"></div>
		<h1>Select Machine</h1>                       
		<div class="clear"></div>
	</div>
	<div class="block-fluid">                        
		<div class="row-form">
			<div class="span2">IP</div>
			<div class="span2" style="margin-left:0px !important;">
				<input type="text" autocomplete="off"  name="ip" value="<?=$sesi['ip']?>" size=15>
			</div>
			<div class="span2">Com Key</div>
			<div class="span2" >
				<input type="text" autocomplete="off"  name="comkey" value="<?=$sesi['comkey']?>" size=15>
			</div>
			<div class="span3" style="margin-left:60px !important; text-align  : right !important;">
				<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="ulang();">
				<input type="submit" name="Pull Off" value="Get Data" class="btn ttLT" title="Get Data">
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?php echo form_close(); ?>