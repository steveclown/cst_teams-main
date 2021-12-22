<script>
	function ulang(){
		document.getElementById("lost_item_code").value = "";
		document.getElementById("lost_item_name").value = "";
	}
	
	function warninglostitemcode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("lostitem_code").value = "";
			return false;
		}
	}
	
	function warninglostitemname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("lostitem_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var lostitem_code = $("#lostitem_code").val();
			var lostitem_name = $("#lostitem_name").val();
			var lostitem_remark = $("#lostitem_remark").val();
			
		  	if(lostitem_code!='' && lostitem_name!='' ){
				return true;
			}else{
				alert('Data of Lost Item Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corelostitem/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

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
					<a href="<?php echo base_url();?>corelostitem/addCoreLostItem">
						Add Lost Item
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Add Lost Item 
		</h1>
	<!-- END PAGE TITLE & BREADCRUMB-->

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
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
						echo form_open('corelostitem/processAddCoreLostItem',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addlostitem');
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="lost_item_code" id="lost_item_code" onChange="warninglostitemcode(lost_item_code); function_elements_add(this.name, this.value);" value="<?php echo set_value('lost_item_code',$data['lost_item_code']);?>"/>
								<span class="help-block">
									 Please input only alpha-numerical characters.
								</span>
								<label class="control-label">Lost Item Code<span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="lost_item_name" id="lost_item_name" onChange="warninglostitemname(lost_item_name); function_elements_add(this.name, this.value);" value="<?php echo set_value('lost_item_name',$data['lost_item_name']);?>"/>
								<label class="control-label">Lost Item Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
