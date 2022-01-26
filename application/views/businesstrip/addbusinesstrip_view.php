<script>
	function ulang(){
		document.getElementById("expense_business_trip_name").value = "";
	}

	function warningname(inputname) {
		//var letter = /^[0-9a-zA-Z]+ $+ +/;  
		var letter = /^[a-zA-Z\s]*$/;   
		//var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("expense_business_trip_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var expense_business_trip_name = $("#expense_business_trip_name").val();
			
		  	if(expense_business_trip_name!='' ){
				return true;
			}else{
				alert('Data of Businnes Trip Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Add Business Trip
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>businesstrip" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
						</span>
					</a>
				</div>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo base_url();?>">
					Master
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>businesstrip">
					Business Trip List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Add Business Trip
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Add
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php 
						echo form_open('businesstrip/processaddbusinesstrip',array('id' => 'myform', 'class' => 'form-horizontal')); 
						$data = $this->session->userdata('addbusinesstrip');
					?>
						<div class="form-group">
							<label class="col-md-3 control-label">Business Trip Name</label>
							<div class="col-md-8">
								<input type="text" autocomplete="off"  name="expense_business_trip_name" id="expense_business_trip_name" onChange="warningname(expense_business_trip_name);" value="<?php echo $data['expense_business_trip_name'];?>" class="form-control" placeholder="Business Trip Name">
							</div>
						</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
					<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
