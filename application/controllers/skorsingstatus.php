<?php
	Class skorsingstatus extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('skorsingstatus_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['skorsingstatus']		= $this->skorsingstatus_model->get_list();
			$data['main_view']['content']	= 'skorsingstatus/listskorsingstatus_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']	= 'skorsingstatus/formaddskorsingstatus_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddSkorsingStatus(){
			$data = array(
				'skorsing_status_code' 		=> $this->input->post('skorsing_status_code',true),
				'skorsing_status_name' 		=> $this->input->post('skorsing_status_name',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('skorsing_status_code', 'Skorsing Status Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('skorsing_status_name', 'Skorsing Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->skorsingstatus_model->saveNewSkorsingStatus($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.skorsingstatus.processAddskorsingstatus',$auth['username'],'Add New Skorsing Status');
					$msg = "<div class='alert alert-success'>                
								Add Data Skorsing Status Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addskorsingstatus');
					redirect('skorsingstatus/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Skorsing Status UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddSkorsingStatus',$data);
					redirect('skorsingstatus/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddSkorsingStatus',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('skorsingstatus/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->skorsingstatus_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'skorsingstatus/formeditskorsingstatus_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditSkorsingStatus(){
			
			$data = array(
				'skorsing_status_id' 		=> $this->input->post('skorsing_status_id',true),
				'skorsing_status_code' 		=> $this->input->post('skorsing_status_code',true),
				'skorsing_status_name' 		=> $this->input->post('skorsing_status_name',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('skorsing_status_code', 'Skorsing Status Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('skorsing_status_name', 'Skorsing Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->skorsingstatus_model->saveEditSkorsingStatus($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.skorsingstatus.Edit',$auth['username'],'Edit Skorsing Status');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['skorsing_status_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Skorsing Status Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('skorsingstatus/Edit/'.$data['skorsing_status_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('skorsingstatus/Edit/'.$data['skorsing_status_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('skorsingstatus/Edit/'.$data['skorsing_status_id']);
			}
		}
		
				
		function delete(){
			if($this->skorsingstatus_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.skorsingstatus.delete',$auth['username'],'Delete Skorsing Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Skorsing Status Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('skorsingstatus');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Skorsing Status UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('skorsingstatus');
			}
		}
	}
?>