<style>
	.row-fluid [class*="span"] {
		margin-left:30px;
		padding:5;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
</style>
<div class="workplace">   
	<div class="row-fluid">
		<div class="span12">
			<?php
				$this->load->view('PullAttLog/filterMachine');
			?>
			<div class="dr"></div>
			<div class="head">
				<div class="isw-grid"></div>
				<h1>Data Attendance Log</h1>                       
				<div class="clear"></div>
			</div>
			<div class="block-fluid">                        
				<table cellpadding="0" cellspacing="0" width="100%" class="table">
					<thead>
						<tr>  
							<th>No</th>
							<th>User ID</th>
							<th>Tanggal</th>
							<th>Jam</th>
							<th>Verifikasi</th>
							<th>Status</th>                           
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
									$soap_request="
									<GetAttLog>
										<ArgComKey xsi:type=\"xsd:integer\">
											".$sesi['comkey']."
										</ArgComKey>
										<Arg>
											<PIN xsi:type=\"xsd:integer\">All</PIN>
										</Arg>
									</GetAttLog>";
									$newLine="\r\n";
									fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
									fputs($Connect, "Content-Type: text/xml".$newLine);
									fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
									fputs($Connect, $soap_request.$newLine);
									$buffer="";
									while($Response=fgets($Connect, 4096)){
										$buffer=$buffer.$Response;
									}
								}else{
									echo "<tr><th colspan='10' style='text-align  : center !important;'>Koneksi ke Mesin Gagal !!!</th></tr>";
								}
								$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
								$buffer=explode("\r\n",$buffer);
								// print_r($buffer); exit;
								for($a=0;$a<count($buffer);$a++){
									$data=Parse_Data($buffer[$a],"<Row>","</Row>");
									$PIN=Parse_Data($data,"<PIN>","</PIN>");
									$DateTime=Parse_Data($data,"<DateTime>","</DateTime>");
									$Verified=Parse_Data($data,"<Verified>","</Verified>");
									$Status=Parse_Data($data,"<Status>","</Status>");
					
									//kemudian di simpan dalam variabel dua data di atas
									$tanggal=$DateTime;
									// $id=$data_employe['user_id'];
									//di sini kita menggunakan fungsi list dalam php
									// list($id,$tanggal) = mysql_fetch_array($data_employe);
									// echo "$DateTime";
									// print_r($DateTime); exit;
									
									//pisahkan tanggal
									$array1=explode(" ",$tanggal);
									$tahun=$array1[0];
									$bulan=$array1[1];
									$sisa1=$array1[2];
									$array2=explode(" ",$sisa1);
									$tanggal=$array2[0];
									$sisa2=$array2[1];
									$array3=explode(":",$sisa2);
									$jam=$array3[0];
									$menit=$array3[1];
									$detik=$array3[2];
									
									if(!empty($data)){
										$data_employe = array(
											'user_id' 	=> $PIN,
											'date' => $tahun,
											'time' => $bulan,
											'verified' 	=> $Verified,
											'status' 	=> $Status
										);
																			
										$this->PullAttLog_model->saveLogData($data_employe);
										$no++;
										echo "
											<tr>
												<td>$no</td>
												<td style='text-align  : left !important;'>$PIN</td>
												<td style='text-align  : left !important;'>".$data_employe['date']."</td>
												<td style='text-align  : left !important;'>".$data_employe['time']."</td>
												<td style='text-align  : center !important;'>".$Verified."</td>
												<td style='text-align  : center !important;'>$Status</td>
											</tr>
										";
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