<script>
	function ulang(){
		document.getElementById("username").value = "<?php echo $result['username'] ?>";
		document.getElementById("user_group_id").value = "<?php echo $result['user_group_id'] ?>";
		document.getElementById("log_stat").value = "<?php echo $result['log_stat'] ?>";
	}
	
</script>
<style>
	label {
		display: inline !important;
		width:50% !important;
		margin:0 !important;
		padding:0 !important;
		vertical-align:middle !important;
	}
</style>
<?php echo form_open_multipart('pullemployes/processEditEmployee',array('id' => 'myform')); ?>
<div class="workplace">
	<?php
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$logstat = array('off'=>'off','on'=>'on');
		// print_r($item); exit;
	?>
	<div class="span12" style="margin-left: 0px !important;"><?php echo anchor('pullemployes', '<button type="button" class="btn btn-success">Kembali</button>', 'title="Kembali ke daftar user"');?></div>
	<div class="row-fluid">
		<div class="span12">
			<div class="head">
				<div class="isw-documents"></div>
					<h1>Form Edit Data Employee</h1>
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<div class="row-form">
					<div class="span2">Nama</div>
					<div class="span1">:</div>
					<div class="span4" style="margin-left:5px;">
						<input type="text" autocomplete="off"  name="name" id="name" value="<?php echo $item['name'];?>" readonly />
						
					</div>
					<div class="span1">User ID</div>
					<div class="span1">:</div>
					<div class="span3" style="margin-left:5px;">
						<input type="text" autocomplete="off"  name="user_id" id="user_id" value="<?php echo $item['user_id'];?>" readonly />
						
					</div>
					
					<div class="clear"></div>
				</div> 
				<div class="row-form">
					<div class="span2">Tanggal Lahir:</div>
					<div class="span1">:</div>
					<div class="span2" style="margin-left:5px;">
						<div class="input-append date" id="dp3" data-date="<?php echo date('Y-m-d');?>" data-date-format="yyyy-mm-dd">
						  <span class="add-on"><i class="icon-calendar"></i></span>
						  <input class="span2" size="16" type="text" name='employee_ttl' id='employee_ttl'
								value="<?php if (empty($item['employee_ttl'])){
												echo date('Y-m-d');
											}else{
												echo $item['employee_ttl'];
										}?>" readonly>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					$('#dp3').datepicker().on('changeDate', function(){
						$('#dp3').datepicker('hide');
					}); 
				</script>
				<div class="row-form">
					<div class="span2">No. KTP</div>
					<div class="span1">:</div>
					<div class="span5" style="margin-left:5px;">
						<input type="text" autocomplete="off"  name="employee_ktp" id="employee_ktp" value="<?php echo $item['employee_ktp'];?>"/>
					</div>
					<div class="clear"></div>
				</div>
					
				<div class="row-form">
					<div class="span2">Alamat</div>
					<div class="span1">:</div>
					<div class="span8" style="margin-left:5px;"><?php echo form_textarea(array('name'=>'employee_address','id'=>'employee_address','value'=>set_value('employee_address',$item['employee_address'])))?></div>
					<div class="clear"></div>
				</div> 
								
				<div class="row-form">
					<div class="btn-group" align="right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="ulang();">
						<input type="submit" name="Save" value="Simpan" class="btn ttLT" title="Simpan Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>