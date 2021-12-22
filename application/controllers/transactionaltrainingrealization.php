<?php
	Class transactionaltrainingrealization extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionaltrainingrealization_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionaltrainingrealization']		= $this->transactionaltrainingrealization_model->get_list();
			$data['main_view']['content']	= 'transactionaltrainingrealization/listtransactionaltrainingrealization_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'transactionaltrainingrealization/addtransactionaltrainingrealization_view';
			$data['main_view']['selection']	= create_double($this->transactionaltrainingrealization_model->getselection(),'training_selection_id', 'employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddtransactionaltrainingrealization(){
			$auth = $this->session->userdata('auth');
						
			$data = array(				
				'training_selection_id'		=> $this->input->post('training_selection_id',true),
				'realization_training_date'	=> tgltodb($this->input->post('realization_training_date',true)),
				'realization_training_remark'	=> $this->input->post('realization_training_remark',true),
				'status'					=> '0',
				'data_state'				=> '0',
				'created_by'				=> $auth['username'],
				'created_on'				=> date("Y-m-d H:i:s")	
			);
			
			$this->form_validation->set_rules('training_selection_id', 'Training Selection', 'required');
			$this->form_validation->set_rules('realization_training_date', 'Realization Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingrealization_model->inserttrainingrealization($data)){
					$auth = $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1003','Application.transactionaltrainingselection.processaddtransactionaltrainingselection',$auth['username'],'Add New Transactional Training Schedule');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Training Realization Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addtransactionaltrainingrealization');
					redirect('transactionaltrainingrealization/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Training Selection UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingrealization/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addtransactionaltrainingrealization',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingrealization/add');
			}
		}
		
		function edit(){
			$data['main_view']['result']		= $this->transactionaltrainingrealization_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionaltrainingrealization/edittransactionaltrainingrealization_view';
			$data['main_view']['selection']	= create_double($this->transactionaltrainingrealization_model->getselection(),'training_selection_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processedittransactionaltrainingrealization(){
		
			$data = array(				
				'realization_training_id'		=> $this->input->post('realization_training_id',true),
				'training_selection_id'			=> $this->input->post('training_selection_id',true),
				'realization_training_date'		=> tgltodb($this->input->post('realization_training_date',true)),
				'realization_training_remark'	=> $this->input->post('realization_training_remark',true),
				'status'						=> '0',
				'data_state'					=> '0',
				'created_by'					=> $auth['username'],
				'created_on'					=> date("Y-m-d H:i:s")	
			);
			
			//print_r($data);exit;
			$this->form_validation->set_rules('training_selection_id', 'Training Selection', 'required');
			$this->form_validation->set_rules('realization_training_date', 'Realization Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->transactionaltrainingrealization_model->updatetrainingrealization($data)==true){
				//print_r($data);exit;
					$auth 	= $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1077','Application.transactionaltrainingselection.Edit',$auth['username'],'Edit Transactional Training Selection');
					//$this->fungsi->set_change_log($old_schedule,$data,$auth['username'],$data['training_selection_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Training Realization Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingrealization/edit/'.$data['realization_training_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Training Realization UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionaltrainingrealization/edit/'.$data['realization_training_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingrealization/edit/'.$data['realization_training_id']);
			}
		}
		
		function delete(){
			if($this->transactionaltrainingrealization_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				//$this->fungsi->set_log($auth['username'],'1005','Application.transactionaltrainingselection.delete',$auth['username'],'Delete transactionaltrainingselection');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Training Realization Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingrealization');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Training Realization UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionaltrainingrealization');
			}
		}
	}
?>