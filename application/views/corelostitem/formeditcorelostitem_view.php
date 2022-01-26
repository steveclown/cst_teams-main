<script>
	function ulang(){
		document.getElementById("lost_item_code").value = "<?php echo $corelostitem['lost_item_code'] ?>";
		document.getElementById("lost_item_name").value = "<?php echo $corelostitem['lost_item_name'] ?>";
		document.getElementById("lost_item_id").value = "<?php echo $corelostitem['lost_item_id'] ?>";
	}
	
	function warningbonuscode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("lost_item_code").value = "";
			return false;
		}
	}
	
	function warningbonusname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("lost_item_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var lost_item_code = $("#lost_item_code").val();
			var lost_item_name = $("#lost_item_name").val();
			var bonus_remark = $("#bonus_remark").val();
			
		  	if(lost_item_code!='' && lost_item_name!='' && bonus_remark!=''){
				return true;
			}else{
				alert('Data of Lost Item Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>
<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
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
								<a href="<?php echo base_url();?>corelostitem">
									Lost Item List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corelostitem/editCoreLostItem/<?php echo $corelostitem['lost_item_id'];?>">
									Edit Lost Item
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Lost Item 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>corelostitem" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('corelostitem/processEditCoreLostItem',array('id' => 'myform', 'class' => 'horizontal-form')); 		
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="lost_item_code" id="lost_item_code" onChange="warningbonuscode(lost_item_code);" value="<?php echo $corelostitem['lost_item_code'];?>" class="form-control" >
									<span class="help-block">
										Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Lost Item Code<span class="required">*</span></label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="lost_item_name" id="lost_item_name" onChange="warningbonusname(lost_item_name);" value="<?php echo $corelostitem['lost_item_name'];?>" class="form-control" >
									<label class="control-label">Lost Item Name<span class="required">*</span></label>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="lost_item_id" value="<?php echo $corelostitem['lost_item_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" id="Save" name="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

