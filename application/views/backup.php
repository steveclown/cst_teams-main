<div class="workplace">
	<div class="row-fluid"> 
		<div class="span12">
			<div class="head">
				<div class="isw-documents"></div>
					<h1>Form Dump Sql File</h1>
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<?php echo form_open('backup/backup_db');?>
				
				<div class="row-form">
					<div class="span3">Last Back Up Database History : <b><big><?php echo SQL_DB; ?></big></b> </div>
					<div class="span7">
						<?php
							$filename=$root_path."logbackup.log";
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
					</div>				
					<div class="clear"></div>
				</div>				
				
				<div class="row-form">
					<div class="btn-group" align="right">
						<input class="btn ttLT" type="submit" value="Back Up" title="Simpan Data">
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>