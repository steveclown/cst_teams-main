<?php
	Class transactionalapplicanteducation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalapplicanteducation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			// $this->lists();
			$this->Add();
		}
		
/* 		public function lists(){
			$data['main_view']['transactionalapplicanteducation']		= $this->transactionalapplicanteducation_model->get_list();
			$data['main_view']['content']	= 'transactionalapplicanteducation/listtransactionalapplicanteducation_view';
			$this->load->view('mainpage_view',$data);
		} */
		
		function Add(){
			$data['main_view']['content']		= 'transactionalapplicanteducation/addtransactionalapplicanteducation_view';
			$data['main_view']['education']	= create_double($this->transactionalapplicanteducation_model->geteducation(),'education_id','education_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicanteducation_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function arrayaddtransactionalapplicanteducation(){
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
				'status'=> $this->input->post('status',true),
				'education_id'=> $this->input->post('education_id',true),
				'education_type'=> $this->input->post('education_type',true),
				'applicant_education_name'=> $this->input->post('applicant_education_name',true),
				'applicant_education_city'=> $this->input->post('applicant_education_city',true),
				'applicant_education_from_period'=> $this->input->post('applicant_education_from_period',true),
				'applicant_education_to_period'=> $this->input->post('applicant_education_to_period',true),
				'applicant_education_duration'=> $this->input->post('applicant_education_duration',true),
				'applicant_education_passed'=> $this->input->post('applicant_education_passed',true),
				'applicant_education_certificate'=> $this->input->post('applicant_education_certificate',true),
				'applicant_education_remark'=> $this->input->post('applicant_education_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> $this->input->post('created_on',true)
			);
			
			$this->form_validation->set_rules('education_id', 'Education', 'required');
			$this->form_validation->set_rules('education_type', 'Type', 'required');
			$this->form_validation->set_rules('applicant_education_name', 'Name', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_education_city', 'City', 'required|alpha-numeric');
			$this->form_validation->set_rules('applicant_education_from_period', 'From', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_to_period', 'To', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_duration', 'Duration', 'required|numeric');
			$this->form_validation->set_rules('applicant_education_passed', 'Passed', 'required');
			$this->form_validation->set_rules('applicant_education_certificate', 'Certification', 'required');
			$this->form_validation->set_rules('applicant_education_remark', 'Certification', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addtransactionalapplicanteducation-'.$sesi['unique']);
				$this->session->set_userdata('addtransactionalapplicanteducation-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addtransactionalapplicanteducation-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddtransactionalapplicanteducation-".$data_header['created_on']);
				
				// $dataArray[$data_item['education_id'].$data_item['education_type']] = $data_item;
				$dataArray[] = $data_item;
				$this->session->set_userdata("dataitemaddtransactionalapplicanteducation-".$data_header['created_on'],$dataArray);
				$this->session->unset_userdata('addtransactionalapplicanteducation');
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation');
			}else{
				$this->session->set_userdata('addtransactionalapplicanteducation',$data_item);
				$this->session->set_userdata('addtransactionalapplicanteducation-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation');
			}
		}
		
		public function resetapplicanteducation(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addtransactionalapplicanteducation-'.$sesi['unique']);
			$this->session->unset_userdata("dataitemaddtransactionalapplicanteducation-".$header['created_on']);
			$this->session->unset_userdata('addtransactionalapplicanteducation-'.$sesi['unique']);
			redirect('transactionalapplicanteducation');
		}
		
		public function deletearrayapplicanteducationitem(){
			$arrayBaru		=array();
			$created_on				= $this->uri->segment(3);
			$keyZ 			= $this->uri->segment(4);
			$transactionalapplicanteducation				= $this->session->userdata("dataitemaddtransactionalapplicanteducation-".$created_on);
			// print_r($transactionalapplicanteducation); exit;
			foreach($transactionalapplicanteducation as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addtransactionalapplicanteducation-'.$sesi['unique']);
				$this->session->unset_userdata('addtransactionalapplicanteducation-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddtransactionalapplicanteducation-'.$created_on,$arrayBaru);
			redirect('transactionalapplicanteducation');
		}
		
		function processaddtransactionalapplicanteducation(){
			redirect('transactionalapplicantfamily');
		}
/* 		function processaddtransactionalapplicanteducation(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'education_id'=> $this->input->post('education_id',true),
				'education_type'=> $this->input->post('education_type',true),
				'applicant_education_name'=> $this->input->post('applicant_education_name',true),
				'applicant_education_city'=> $this->input->post('applicant_education_city',true),
				'applicant_education_from_period'=> $this->input->post('applicant_education_from_period',true),
				'applicant_education_to_period'=> $this->input->post('applicant_education_to_period',true),
				'applicant_education_duration'=> $this->input->post('applicant_education_duration',true),
				'applicant_education_passed'=> $this->input->post('applicant_education_passed',true),
				'applicant_education_certificate'=> $this->input->post('applicant_education_certificate',true),
				'applicant_education_remark'=> $this->input->post('applicant_education_remark',true),
				'data_state'							=> '0',
				'created_by'							=> $auth['username'],
				'created_on'							=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicanteducation_model->saveNewtransactionalapplicanteducation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalapplicanteducation.processaddtransactionalapplicanteducation',$auth['username'],'Add New Transactional Applicant Education');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Applicant Education Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionalapplicanteducation');
					redirect('transactionalapplicanteducation/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Applicant Education UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicanteducation/add');
				}
			}else{
				$this->session->set_userdata('addtransactionalapplicanteducation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation/add');
			}
		} */
		
/* 		function Edit(){
			$data['main_view']['result']		= $this->transactionalapplicanteducation_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalapplicanteducation/edittransactionalapplicanteducation_view';
			$data['main_view']['education']	= create_double($this->transactionalapplicanteducation_model->geteducation(),'education_id','education_name');
			$data['main_view']['applicant']	= create_double($this->transactionalapplicanteducation_model->getapplicant(),'applicant_id','applicant_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalapplicanteducation(){
			$data = array(
				'applicant_education_id'=> $this->input->post('applicant_education_id',true),
				'status'=> $this->input->post('status',true),
				'applicant_id'=> $this->input->post('applicant_id',true),
				'education_id'=> $this->input->post('education_id',true),
				'education_type'=> $this->input->post('education_type',true),
				'applicant_education_name'=> $this->input->post('applicant_education_name',true),
				'applicant_education_city'=> $this->input->post('applicant_education_city',true),
				'applicant_education_from_period'=> $this->input->post('applicant_education_from_period',true),
				'applicant_education_to_period'=> $this->input->post('applicant_education_to_period',true),
				'applicant_education_duration'=> $this->input->post('applicant_education_duration',true),
				'applicant_education_passed'=> $this->input->post('applicant_education_passed',true),
				'applicant_education_certificate'=> $this->input->post('applicant_education_certificate',true),
				'applicant_education_remark'=> $this->input->post('applicant_education_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('education_id', 'Education Name', 'required');
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionalapplicanteducation_model->saveEdittransactionalapplicanteducation($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalapplicanteducation.Edit',$auth['username'],'Edit Transactional Applicant Education');
					$this->fungsi->set_change_log($old_education,$data,$auth['username'],$data['applicant_education_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Applicant Education Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicanteducation/Edit/'.$data['applicant_education_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Applicant Education UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalapplicanteducation/Edit/'.$data['applicant_education_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation/Edit/'.$data['applicant_education_id']);
			}
		}
		
		function delete(){
			if($this->transactionalapplicanteducation_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalapplicanteducation.delete',$auth['username'],'Delete transactionalapplicanteducation');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Applicant Education Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Applicant Education UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalapplicanteducation');
			}
		} */
	}
?>