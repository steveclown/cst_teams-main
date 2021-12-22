<div class="workplace">
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>
	<div class="row-fluid"> 
		<div class="span12">
			<div class="head">
				<div class="isw-documents"></div>
					<h1>Form Restore Sql File</h1>
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<?php echo form_open_multipart('restore/do_upload');?>
				
				<div class="row-form">
					<div class="span3">Restore History : <b><big><?php echo SQL_DB; ?></big></b> </div>
					<div class="span7">
						<?php
							$filename=$root_path."logrestore.log";
							if (is_file($filename)){
								$fp  = fopen($filename, 'r');
								$content = fread($fp, filesize($filename));
								fclose($fp);
								$content=explode('
',$content);
								$count = count($content);
								if ($count>5){
									for ($i=0;$i<5;$i++){
										echo $content[$i]."</br>";
									}
								} else {
									for ($i=0;$i<$count;$i++){
										echo $content[$i]."</br>";
									}
								}
							}
						?>
						<input type="file" name="userfile" size="20" />
					</div>				
					<div class="clear"></div>
				</div>				
				
				<div class="row-form">
					<div class="btn-group" align="right">
						<input class="btn ttLT" type="submit" value="Restore" title="Restore Data">
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>