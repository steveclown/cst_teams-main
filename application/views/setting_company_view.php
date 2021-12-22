<script>
	function ulang(){
		document.getElementById("company_name").value='';
		document.getElementById("company_address").value='';
		document.getElementById("company_city").value='';
		document.getElementById("company_state").value='';
		document.getElementById("company_postal_code").value='';
		document.getElementById("supplier_phone").value='';
		document.getElementById("supplier_website").value='';
		document.getElementById("supplier_email").value='';
	}
</script>
<div class="workplace">
	<?php
		echo form_open_multipart('SettingCompany/processSetting');
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>
	<div class="row-fluid"> 
		<div class="span12">
			<div class="head">
				<div class="isw-documents"></div>
					<h1>Setting Perusahaan</h1>
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<div class="row-form">
					<div class="span3">Nama Perusahaan:</div>
					<div class="span9"><input type="text" name="company_name" id="company_name" placeholder="Nama Perusahaan" value="<?php echo $result['company_name'];?>"/></div>
					<div class="clear"></div>
				</div> 
				
				<div class="row-form">
					<div class="span3">Alamat Perusahaan:</div>
					<div class="span9"><textarea type="textarea" name="company_address" id="company_address" placeholder="Jl. Menoreh Timur No 3" value="<?php echo $result['company_address'];?>"/></textarea></div>
					<div class="clear"></div>
				</div>
				
				<div class="row-form">
					<div class="span3">Kota:</div>
					<div class="span2"><input type="text" name="company_city" id="company_city" placeholder="Kota" value="<?php echo $result['company_city'];?>"/></div>
					<div class="span1">Negara:</div>
					<div class="span2"><input type="text" name="company_state" id="company_state" placeholder="Negara" value="<?php echo $result['company_state'];?>"/></div>
					<div class="span1">Kode Pos:</div>
					<div class="span2"><input type="text" name="company_postal_code" id="company_postal_code" placeholder="Kode Pos" value="<?php echo $result['company_postal_code'];?>"/></div>					
					<div class="clear"></div>
				</div>
				
				<div class="row-form">
					<div class="span3">Kontak Perusahaan:</div>
					<div class="span3"><input type="text" name="company_phone" id="company_phone" placeholder="No. HP/Telp." value="<?php echo $result['company_phone'];?>"/></div>
					<div class="clear"></div>
				</div>
				
				<div class="row-form">
					<div class="span3">Website Perusahaan:</div>
					<div class="span3"><input type="text" name="company_website" id="company_website" placeholder="No HP/Telp." value="<?php echo $result['company_website'];?>"/></div>
					<div class="clear"></div>
				</div>
				
				<div class="row-form">
					<div class="span3">Email Perusahaan:</div>
					<div class="span9"><input type="text" name="company_email" id="company_email" placeholder="Imel mu beroww,.." value="<?php echo $result['company_email'];?>"/></div>
					<div class="clear"></div>
				</div>
				
				<div class="row-form">
					<div class="span3">Logo Perusahaan:</div>
					<div class="span7">
						<input type="file" name="filename"  size="50"/>
						 <!--<input type="file" name="file"/>-->
					</div>				
					<div class="clear"></div>
				</div>				
				
				<div class="row-form">
					<div class="btn-group" align="right">
						<input class="btn btn-danger" type="reset" value="Reset" onclick="ulang()">
						<input class="btn ttLT" type="submit" value="Simpan" title="Simpan Data">
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>