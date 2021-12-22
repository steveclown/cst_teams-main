<?php
	Class transactionalapplicantaccidentexperience extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicantaccidentexperience_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->Add();
		}
		
		public function lists(){
			$data['main_view']['transactionalapplicantaccidentexperience']		= $this->transactionalapplicantaccidentexperience_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicantaccidentexperience/listtransactionalapplicantaccidentexperience_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicantaccidentexperience/addtransactionalapplicantaccidentexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantaccidentexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}

 		function arrayaddtransactionalapplicantaccidentexperience(){
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
							'accident_experience_period'=> $this->input->post('accident_experience_period',true),
							'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
							'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
							'created_by'							=> $auth['username'],
							'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('accident_experience_period', 'Period', 'required|numeric');
			$this->form_validation->set_rules('accident_experience_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('accident_experience_consequence', 'Consequence', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique']);
				$this->session->set_userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddtransactionalapplicantaccidentexperience-".$data_header['created_on']);
				
				// $dataArray[$data_item['accidentexperience_id'].$data_item['accidentexperience_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddtransactionalapplicantaccidentexperience-".$data_header['created_on'],$dataArray);
				$this->session->unset_userdata('addtransactionalapplicantaccidentexperience');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}else{
				$this->session->set_userdata('addtransactionalapplicantaccidentexperience',$data_item);
				$this->session->set_userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}
			
		}
		
		public function resetapplicantaccidentexperience(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddtransactionalapplicantaccidentexperience-".$header['created_on']);
			$this->session->unset_userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique']);
			redirect('transactionalapplicantaccidentexperience');
		}
		
		public function deletearrayapplicantaccidentexperienceitem(){
			$arrayBaru		=array();
			$created_on				= $this->uri->segment(3);
			$keyZ 			= $this->uri->segment(4);
			$transactionalapplicantaccidentexperience				= $this->session->userdata("dataitemaddtransactionalapplicantaccidentexperience-".$created_on);
			// print_r($transactionalapplicantaccidentexperience); exit;
			foreach($transactionalapplicantaccidentexperience as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique']);
				$this->session->unset_userdata('addtransactionalapplicantaccidentexperience-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddtransactionalapplicantaccidentexperience-'.$created_on,$arrayBaru);
			redirect('transactionalapplicantaccidentexperience');
		}
		
 		function processaddtransactionalapplicantaccidentexperience(){
			redirect('transactionalapplicantworkingexperience');
		}
		
/* 		
		function processaddtransactionalapplicantaccidentexperience(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'accident_experience_period'=> $this->input->post('accident_experience_period',true),
				'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
				'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantaccidentexperience_model->saveNewtransactionalapplicantaccidentexperience($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicantaccidentexperience.processaddtransactionalapplicantaccidentexperience',$auth['username'],'Add New Transactional Applicant Accident Experience');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Accident Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicantaccidentexperience');
					redirect('transactionalapplicantaccidentexperience/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Accident Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionalapplicantaccidentexperience',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience/add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicantaccidentexperience_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicantaccidentexperience/edittransactionalapplicantaccidentexperience_view';
			$data['main_view']['applicant']	= create_double($this->transactionalapplicantaccidentexperience_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicantaccidentexperience(){
			$data = array(
				'applicant_accident_experience_id'=> $this->input->post('applicant_accident_experience_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'accident_experience_period'=> $this->input->post('accident_experience_period',true),
				'accident_experience_remark'=> $this->input->post('accident_experience_remark',true),
				'accident_experience_consequence'=> $this->input->post('accident_experience_consequence',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicantaccidentexperience_model->saveEdittransactionalapplicantaccidentexperience($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicantaccidentexperience.Edit',$auth['username'],'Edit Transactional Applicant Accident Experience');
					$this->fungsi->set_change_log($old_accident_experience,$data,$auth['username'],$data['applicant_accident_experience_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Accident Experience Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Accident Experience UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience/Edit/'.$data['applicant_accident_experience_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicantaccidentexperience_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicantaccidentexperience.delete',$auth['username'],'Delete transactionalapplicantaccidentexperience');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Accident Experience Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Accident Experience UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicantaccidentexperience');
			}
		} */
	}
?>