<?php
	Class incentiverealizationpercentage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('incentiverealizationpercentage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['incentiverealizationpercentage']		= $this->incentiverealizationpercentage_model->getIncentiveRealizationPercentage();
			$data['main_view']['content']								= 'incentiverealizationpercentage/listincentiverealizationpercentage_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiverealizationpercentage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addincentiverealizationpercentage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiverealizationpercentage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addincentiverealizationpercentage-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addincentiverealizationpercentage-'.$sesi['unique']);	
			redirect('incentiverealizationpercentage/addIncentiveRealizationPercentage');
		}
		
		public function addIncentiveRealizationPercentage(){
			$data['main_view']['content']		= 'incentiverealizationpercentage/formaddincentiverealizationpercentage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddIncentiveRealizationPercentage(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'realization_percentage_min' 		=> $this->input->post('realization_percentage_min',true),
				'realization_percentage_max' 		=> $this->input->post('realization_percentage_max',true),
				'realization_percentage_omzet' 		=> $this->input->post('realization_percentage_omzet',true),
				'realization_percentage_share' 		=> $this->input->post('realization_percentage_share',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")	
				
			);
			
			$this->form_validation->set_rules('realization_percentage_min', 'Realization Percentage Min', 'required');
			$this->form_validation->set_rules('realization_percentage_max', 'Realization Percentage Max', 'required');
			$this->form_validation->set_rules('realization_percentage_omzet', 'Realization Percentage Omzet', 'required');
			$this->form_validation->set_rules('realization_percentage_share', 'Realization Percentage Share', 'required');

			if($this->form_validation->run()==true){
				if($this->incentiverealizationpercentage_model->insertIncentiveRealizationPercentage($data)){
					$auth = $this->session->userdata('auth');

					/*$this->fungsi->set_log($auth['username'],'1003','Application.incentiverealizationpercentage.processaddincentiverealizationpercentage',$auth['username'],'Add NewAsset');*/

					$msg = "<div class='alert alert-success'>                
								Add Data Realization Percentage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addincentiverealizationpercentage');
					redirect('incentiverealizationpercentage/addIncentiveRealizationPercentage');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Realization Percentage UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationpercentage/addIncentiveRealizationPercentage');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addincentiverealizationpercentage',$data);
				$msg = validation_errors("<div class='alert alert-error'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationpercentage/addIncentiveRealizationPercentage');
			}
		}
		
		public function editIncentiveRealizationPercentage(){
			$realization_percentage_id = $this->uri->segment(3);

			$data['main_view']['incentiverealizationpercentage']	= $this->incentiverealizationpercentage_model->getIncentiveRealizationPercentage_Detail($realization_percentage_id);
			$data['main_view']['content']							= 'incentiverealizationpercentage/formeditincentiverealizationpercentage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditIncentiveRealizationPercentage(){
			
			$data = array(
				'realization_percentage_id' 		=> $this->input->post('realization_percentage_id',true),
				'realization_percentage_min' 		=> $this->input->post('realization_percentage_min',true),
				'realization_percentage_max' 		=> $this->input->post('realization_percentage_max',true),
				'realization_percentage_omzet' 		=> $this->input->post('realization_percentage_omzet',true),
				'realization_percentage_share' 		=> $this->input->post('realization_percentage_share',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('realization_percentage_min', 'Realization Percentage Min', 'required');
			$this->form_validation->set_rules('realization_percentage_max', 'Realization Percentage Max', 'required');
			$this->form_validation->set_rules('realization_percentage_omzet', 'Realization Percentage Omzet', 'required');
			$this->form_validation->set_rules('realization_percentage_share', 'Realization Percentage Share', 'required');
			
			if($this->form_validation->run()==true){
				if($this->incentiverealizationpercentage_model->updateIncentiveRealizationPercentage($data)==true){
					$auth 	= $this->session->userdata('auth');

					/*$this->fungsi->set_log($auth['username'],'1077','Application.incentiverealizationpercentage.Edit',$auth['username'],'EditAsset');*/

					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['realization_percentage_id']);

					$msg = "<div class='alert alert-success'>                
								Edit Realization Percentage Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationpercentage/editIncentiveRealizationPercentage/'.$data['realization_percentage_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Realization Percentage Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationpercentage/editIncentiveRealizationPercentage/'.$data['realization_percentage_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationpercentage/editIncentiveRealizationPercentage/'.$data['realization_percentage_id']);
			}
		}
		
				
		public function deleteIncentiveRealizationPercentage(){
			$realization_percentage_id = $this->uri->segment(3);

			if($this->incentiverealizationpercentage_model->deleteIncentiveRealizationPercentage($realization_percentage_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['username'],'1005','Application.incentiverealizationpercentage.delete',$auth['username'],'DeleteAsset');

				$msg = "<div class='alert alert-success'>                
							Delete Data Realization Percentage Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationpercentage');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Realization Percentage Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationpercentage');
			}
		}
	}
?>