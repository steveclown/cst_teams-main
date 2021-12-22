<style>
	th{
		font-size: 14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<div class="workplace">   
	<div class="row-fluid">
		<div class="span12">
			<?php
				$this->load->view('PullEmployes/filterMachine');
			?>
			<div class="dr"></div>
			<div class="head">
				<div class="isw-grid"></div>
				<h1>Data Employes</h1>                       
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<table cellpadding="0" cellspacing="0" width="100%" class="table">
					<thead>
						<tr>  
							<th>No</th>
							<th>UserID</th>
							<th>Name</th>
							<th>Password</th>
							<th>Group</th>
							<th>No. KTP</th>
							<th>Alamat</th>
							<th>TTL</th>
							<th>PIN2</th>
							<th>Action</th>
							                                
						</tr>
					</thead>
					<tbody>
						<?php 
							$sesi	= 	$this->session->userdata('filter-selectMachine');
							$no = 0;
							if(empty($sesi)){
								echo "<tr><th colspan='10' style='text-align  : center !important;'>Data Pegawai Tidak Ada</th></tr>";
							} else {
								$Connect = fsockopen($sesi['ip'], "80", $errno, $errstr, 1);
								if($Connect){
									$soap_request="<GetAllUserInfo><ArgComKey xsi:type=\"xsd:integer\">".$sesi['comkey']."</ArgComKey></GetAllUserInfo>";
									$newLine="\r\n";
									fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
									fputs($Connect, "Content-Type: text/xml".$newLine);
									fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
									fputs($Connect, $soap_request.$newLine);
									$buffer="";
									while($Response=fgets($Connect, 1024)){
										$buffer=$buffer.$Response;
									}
								}else{
									echo "<tr><th colspan='10' style='text-align  : center !important;'>Koneksi ke Mesin Gagal !!!</th></tr>";
								}
								$buffer=Parse_Data($buffer,"<GetAllUserInfoResponse>","</GetAllUserInfoResponse>");
								// print_r($buffer); exit;
								$buffer=explode("\r\n",$buffer);
								for($a=0;$a<count($buffer);$a++){
									$data=Parse_Data($buffer[$a],"<Row>","</Row>");
									$PIN=Parse_Data($data,"<PIN>","</PIN>");
									$Name=Parse_Data($data,"<Name>","</Name>");
									$Password=Parse_Data($data,"<Password>","</Password>");
									$Group=Parse_Data($data,"<Group>","</Group>");
									$Privilege=Parse_Data($data,"<Privilege>","</Privilege>");
									$Card=Parse_Data($data,"<Card>","</Card>");
									$PIN2=Parse_Data($data,"<PIN2>","</PIN2>");
									$TZ1=Parse_Data($data,"<TZ1>","</TZ1>");
									$TZ2=Parse_Data($data,"<TZ2>","</TZ2>");
									$TZ3=Parse_Data($data,"<TZ3>","</TZ3>");	
									if(!empty($data)){
										$data_employe = array(
											'user_id' 	=> $PIN,
											'name' 		=> $Name,
											'password' 	=> $Password,
											'group' 	=> $Group,
											'privilege' => $Privilege,
											'card' 		=> $Card,
											'pin2' 		=> $PIN2,
											'tz1' 		=> $TZ1,
											'tz2' 		=> $TZ2,
											'tz3' 		=> $TZ3
										);
										$employee = array(
											'user_id' 	=> $PIN,
											'employee_name' 		=> $Name
										);
										// $this->PullEmployes_model->saveEmployesData($data_employe);
										// $this->PullEmployes_model->saveEmployesDatatoHro($employee);
										$no++;
										echo "
											<tr>
												<td>$no</td>
												<td style='text-align  : left !important;'>$PIN</td>
												<td style='text-align  : left !important;'>".$Name."</td>
												<td style='text-align  : center !important;'>".$Password."</td>
												<td style='text-align  : center !important;'>$Group</td>
												<td style='text-align  : center !important;'>".$this->PullEmployes_model->getEmployeeKTP($data_employe)."</td>
												<td style='text-align  : center !important;'>".$this->PullEmployes_model->getAlamatEmployee($data_employe)."</td>
												<td style='text-align  : center !important;'>".$this->PullEmployes_model->getTTL($data_employe)."</td>
												<td>$data_employe[pin2]</td>
												<td><a href=".$this->config->item('base_url').'pullemployes/getdetail/'.$data_employe['user_id']." title='View Data'><center><img border='0' src='img/flexi/edit.png'></a></td>
					
											</tr>";
												// <td style='text-align  : center !important;'>$Privilege</td>
												// <td style='text-align  : left !important;'>$Card</td>
												// <td style='text-align  : right !important;'>".$PIN2."</td>  
												// <td style='text-align  : right !important;'>".$TZ1."</td>
												// <td style='text-align  : left !important;'>$TZ2</td>
												// <td style='text-align  : right !important;'>".$TZ3."</td>  
											// </tr>
										// ";
									}
								}
							}
						?> 
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>