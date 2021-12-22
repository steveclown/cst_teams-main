<?php
	Class transactionalapplicantfamily extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantfamily_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->Add();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantfamily']		= $this->transactionalapplicantfamily_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantfamily/listtransactionalapplicantfamily_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantfamily/addtransactionalapplicantfamily_view';
			$data['main_view']['maritalstatus']	= create_double($this->transactionalapplicantfamily_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantfamily_model->getfamilystatus(),'family_status_id','family_status_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantfamily_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		
 		function arrayaddtransactionalapplicantfamily(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
									'created_on'						=> $this->input->post('created_on',true),
			);
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			
			$data_item = array(
							'family_status_id'						=> $this->input->post('family_status_id',true),
							'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
							'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
							'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
							'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
							'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
							'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
							'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
							'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
							'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
							'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
							'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
							'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
							'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
							'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
							'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
							'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
							'marital_status_id'						=> $this->input->post('marital_status_id',true),
							'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
							'data_state'							=> '0',
							'created_by'							=> $auth['username'],
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('applicant_family_name', 'Name', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_family_address', 'Address', 'filterspecialchar');
			$this->form_validation->set_rules('applicant_family_city', 'City', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_zip_code', 'Zip Code', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_rt', 'RT', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_rw', 'RW', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_kecamatan', 'Kecamatan', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_kelurahan', 'Kelurahan', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_home_phone', 'Home Phone', 'numeric');
			$this->form_validation->set_rules('applicant_family_mobile_phone1', 'Mobile Phone 1', 'required|numeric');
			$this->form_validation->set_rules('applicant_family_mobile_phone2', 'Mobile Phone 2', 'numeric');
			$this->form_validation->set_rules('applicant_family_gender', 'Gender', 'required');
			$this->form_validation->set_rules('applicant_family_date_of_birth', 'Date Of Birth', 'required');
			$this->form_validation->set_rules('applicant_family_place_of_birth', 'Place Of Birth', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_education', 'Education', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_occupation', 'Occupation', 'alpha-numeric');
			$this->form_validation->set_rules('applicant_family_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
				$this->session->set_userdata('addtransactionalapplicantfamily-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addtransactionalapplicantfamily-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddtransactionalapplicantfamily-".$data_header['created_on']);
				
				// $dataArray[$data_item['family_id'].$data_item['family_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddtransactionalapplicantfamily-".$data_header['created_on'],$dataArray);
				$this->session->unset_userdata('addtransactionalapplicantfamily');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}else{
				$this->session->set_userdata('addtransactionalapplicantfamily',$data_item);
				$this->session->set_userdata('addtransactionalapplicantfamily-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}
			
		}
		
		public function resetapplicantfamily(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddtransactionalapplicantfamily-".$header['created_on']);
			$this->session->unset_userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
			redirect('transactionalapplicantfamily');
		}
		
		public function deletearrayapplicantfamilyitem(){
			$arrayBaru		=array();
			$created_on				= $this->uri->segment(3);
			$keyZ 			= $this->uri->segment(4);
			$transactionalapplicantfamily				= $this->session->userdata("dataitemaddtransactionalapplicantfamily-".$created_on);
			// print_r($transactionalapplicantfamily); exit;
			foreach($transactionalapplicantfamily as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
				$this->session->unset_userdata('addtransactionalapplicantfamily-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddtransactionalapplicantfamily-'.$created_on,$arrayBaru);
			redirect('transactionalapplicantfamily');
		}
		
 		function processaddtransactionalapplicantfamily(){
			redirect('transactionalapplicantaccidentexperience');
		}
/* 		function processaddtransactionalapplicantfamily(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'								=> $this->input->post('status',true),
				'family_status_id'						=> $this->input->post('family_status_id',true),
				'applicant_id'							=> $this->input->post('applicant_id',true),
				'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
				'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
				'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
				'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
				'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
				'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
				'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
				'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
				'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
				'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
				'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
				'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
				'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
				'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
				'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
				'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantfamily_model->saveNewtransactionalapplicantfamily($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantfamily.processaddtransactionalapplicantfamily',$auth['username'],'Add New Transactional Applicant Family');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Family Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantfamily');
					redirect('transactionalapplicantfamily/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Family UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantfamily',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantfamily_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantfamily/edittransactionalapplicantfamily_view';
			$data['main_view']['maritalstatus']		= create_double($this->transactionalapplicantfamily_model->getmaritalstatus(),'marital_status_id','marital_status_name');
			$data['main_view']['familystatus']	= create_double($this->transactionalapplicantfamily_model->getfamilystatus(),'family_status_id','family_status_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantfamily_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantfamily(){
			$data = array(
				'applicant_family_id'					=> $this->input->post('applicant_family_id',true),
				'status'								=> $this->input->post('status',true),
				'family_status_id'						=> $this->input->post('family_status_id',true),
				'applicant_id'							=> $this->input->post('applicant_id',true),
				'applicant_family_name'					=> $this->input->post('applicant_family_name',true),
				'applicant_family_address'				=> $this->input->post('applicant_family_address',true),
				'applicant_family_city'					=> $this->input->post('applicant_family_city',true),
				'applicant_family_zip_code'				=> $this->input->post('applicant_family_zip_code',true),
				'applicant_family_rt'					=> $this->input->post('applicant_family_rt',true),
				'applicant_family_rw'					=> $this->input->post('applicant_family_rw',true),
				'applicant_family_kecamatan'			=> $this->input->post('applicant_family_kecamatan',true),
				'applicant_family_kelurahan'			=> $this->input->post('applicant_family_kelurahan',true),
				'applicant_family_home_phone'			=> $this->input->post('applicant_family_home_phone',true),
				'applicant_family_mobile_phone1'		=> $this->input->post('applicant_family_mobile_phone1',true),
				'applicant_family_mobile_phone2'		=> $this->input->post('applicant_family_mobile_phone2',true),
				'applicant_family_gender'				=> $this->input->post('applicant_family_gender',true),
				'applicant_family_date_of_birth'		=> $this->input->post('applicant_family_date_of_birth',true),
				'applicant_family_place_of_birth'		=> $this->input->post('applicant_family_place_of_birth',true),
				'applicant_family_education'			=> $this->input->post('applicant_family_education',true),
				'applicant_family_occupation'			=> $this->input->post('applicant_family_occupation',true),
				'marital_status_id'						=> $this->input->post('marital_status_id',true),
				'applicant_family_remark'				=> $this->input->post('applicant_family_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('family_status_id', 'Family Status Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantfamily_model->saveEdittransactionalapplicantfamily($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantfamily.Edit',$auth['username'],'Edit Transactional Applicant Family');
					$this->fungsi->set_change_log($old_family,$data,$auth['username'],$data['applicant_family_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Family Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Family UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily/Edit/'.$data['applicant_family_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantfamily_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantfamily.delete',$auth['username'],'Delete transactionalapplicantfamily');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Family Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Family UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantfamily');
			}
		} */
	}
?>