<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
	</ul>
</div>

<h1 class="page-title">
	Document Book List <small>Manage Document Book</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
					
					<div class="actions">
						<a href="<?php echo base_url();?>coredocumentbook/addCoreDocumentBook" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i> Add New Document Book</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="20%">Document Book Code</th>
								<th>Document Book Name</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coredocumentbook as $key=>$val){
									echo"
										<tr>								
											<td>$val[document_book_code]</td>
											<td>$val[document_book_name]</td>
											<td>
												<a href='".$this->config->item('base_url').'coredocumentbook/deleteCoreDocumentBook/'.$val[document_book_id].'/'.$val[document_book_code]."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
												</a>
											</td>
										</tr>
									";
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>	