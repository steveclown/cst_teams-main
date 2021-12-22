<?php
	Class CoreTrainingProviderItem extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreTrainingProviderItem_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreTrainingProviderItem']	= $this->CoreTrainingProviderItem_model->getCoreTrainingProviderItem();
			$data['main_view']['content']					= 'CoreTrainingProviderItem/listCoreTrainingProviderItem_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreTrainingProviderItem(){
			$data['main_view']['coretrainingtitle']			= create_double($this->CoreTrainingProviderItem_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['main_view']['coretrainingprovider']		= create_double($this->CoreTrainingProviderItem_model->getCoreTrainingProvider(),'training_provider_id','training_provider_name');
			$data['main_view']['content']					= 'CoreTrainingProviderItem/formaddCoreTrainingProviderItem_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingProviderItem-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreTrainingProviderItem-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingProviderItem-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreTrainingProviderItem-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function processAddCoreTrainingProviderItem(){
			$data = array(
				'training_provider_id' 				=> $this->input->post('training_provider_id',true),
				'training_title_id' 				=> $this->input->post('training_title_id',true),
				'training_provider_item_name' 		=> $this->input->post('training_provider_item_name',true),
				'training_provider_item_cost' 		=> $this->input->post('training_provider_item_cost',true),
				'training_provider_item_duration' 	=> $this->input->post('training_provider_item_duration',true),
				'training_provider_item_remark' 	=> $this->input->post('training_provider_item_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('training_provider_id', 'Training Provider Name', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title Name', 'required');
			$this->form_validation->set_rules('training_provider_item_name', 'Training Provider Item Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingProviderItem_model->saveNewCoreTrainingProviderItem($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreTrainingProviderItem.processAddCoreTrainingProviderItem',$auth['user_id'],'Add New Training Provider');
					$msg = "<div class='alert alert-success'>                
								Add Data Training Provider Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreTrainingProviderItem');
					redirect('CoreTrainingProviderItem/addCoreTrainingProviderItem');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Training Provider UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreTrainingProviderItem',$data);
					redirect('CoreTrainingProviderItem/addCoreTrainingProviderItem');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreTrainingProviderItem',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProviderItem/addCoreTrainingProviderItem');
			}	
		}
		
		function editCoreTrainingProviderItem(){
			$data['main_view']['CoreTrainingProviderItem']	= $this->CoreTrainingProviderItem_model->getCoreTrainingProviderItem_Detail($this->uri->segment(3));
			$data['main_view']['coretrainingtitle']			= create_double($this->CoreTrainingProviderItem_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['main_view']['coretrainingprovider']		= create_double($this->CoreTrainingProviderItem_model->getCoreTrainingProvider(),'training_provider_id','training_provider_name');
			$data['main_view']['content']					= 'CoreTrainingProviderItem/formeditCoreTrainingProviderItem_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreTrainingProviderItem(){
			$data = array(
				'training_provider_item_id'	 		=> $this->input->post('training_provider_item_id',true),
				'training_provider_id'	 			=> $this->input->post('training_provider_id',true),
				'training_title_id'	 				=> $this->input->post('training_title_id',true),
				'training_provider_item_name' 		=> $this->input->post('training_provider_item_name',true),
				'training_provider_item_cost' 		=> $this->input->post('training_provider_item_cost',true),
				'training_provider_item_duration'	=> $this->input->post('training_provider_item_duration',true),
				'training_provider_item_remark' 	=> $this->input->post('training_provider_item_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('training_provider_id', 'Training Provider Name', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title Name', 'required');
			$this->form_validation->set_rules('training_provider_item_name', 'Training Provider Item Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingProviderItem_model->saveEditCoreTrainingProviderItem($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.CoreTrainingProviderItem.processEditCoreTrainingProviderItem',$auth['user_id'],'Edit Training Provider');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_provider_item_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Provider Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingProviderItem/editCoreTrainingProviderItem/'.$data['training_provider_item_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Provider UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingProviderItem/editCoreTrainingProviderItem/'.$data['training_provider_item_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProviderItem/editCoreTrainingProviderItem/'.$data['training_provider_item_id']);
			}
		}
		

		function deleteCoreTrainingProviderItem(){
			if($this->CoreTrainingProviderItem_model->deleteCoreTrainingProviderItem($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreTrainingProviderItem.deleteCoreTrainingProviderItem',$auth['user_id'],'Delete Training Job Title');
				$msg = "<div class='alert alert-success'>                
							Delete Data Training Provider Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProviderItem');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Training Provider UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProviderItem');
			}
		}
	}
?>