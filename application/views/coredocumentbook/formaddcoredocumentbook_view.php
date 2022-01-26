<script>
	function ulang(){
		document.getElementById("document_book_code").value = "";
		document.getElementById("document_book_name").value = "";
	}
</script>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coredocumentbook">Document Book</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coredocumentbook/addCoreDocumentBook">Add Document Book</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Form Add Document Book
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->		

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addcoredocumentbook');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>coredocumentbook/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php echo form_open('coredocumentbook/processAddCoreDocumentBook',array('class' => 'horizontal-form')); ?>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" autocomplete="off"  class="form-control" name="document_book_code" id="document_book_code" value="<?php echo $coredocumentbook['document_book_code']?>" >
								<label for="form_control">Document Book Code
									<span class="required">*</span>
								</label>
								<span class="help-block">Please input only alpha-numerical characters..</span>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="document_book_name" id="document_book_name" value="<?php echo $coredocumentbook['document_book_name']?>" >
								<label for="form_control">Document Book Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>