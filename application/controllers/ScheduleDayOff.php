<?php
	Class ScheduleDayOff extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('ScheduleDayOff_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['ScheduleDayOff']	= $this->ScheduleDayOff_model->getScheduleDayOff();
			$data['Main_view']['content']			= 'ScheduleDayOff/listScheduleDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addScheduleDayOff(){
			$data['Main_view']['content']			= 'ScheduleDayOff/formaddScheduleDayOff_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addScheduleDayOff-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addScheduleDayOff-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addScheduleDayOff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addScheduleDayOff-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addScheduleDayOff-'.$unique['unique']);	
			redirect('ScheduleDayOff/addScheduleDayOff');
		}
		
		public function processAddScheduleDayOff(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'day_off_name' 			=> $this->input->post('day_off_name',true),
				'day_off_start_date' 	=> tgltodb($this->input->post('day_off_start_date',true)),
				'day_off_end_date' 		=> tgltodb($this->input->post('day_off_end_date',true)),
				'day_off_remark' 		=> $this->input->post('day_off_remark',true),
				'created_id' 			=> $auth['user_id'],
				'data_state'			=> 0
			);

			$day_off_start_date = date_create($data['day_off_start_date']);
			$day_off_end_date 	= date_create($data['day_off_end_date']);

			$diff  = date_diff($day_off_start_date, $day_off_end_date);

			$date_diff = ($diff->days) + 1;

			$this->session->set_userdata('Add',$data);
			$this->form_validation->set_rules('day_off_name', 'Day Off Name', 'required');
			$this->form_validation->set_rules('day_off_start_date', 'Day Off Start Date', 'required');
			$this->form_validation->set_rules('day_off_end_date', 'Day Off End Date', 'required');

			if($this->form_validation->run()==true){
				if($this->ScheduleDayOff_model->insertScheduleDayOff($data)){
					$day_off_id = $this->ScheduleDayOff_model->getDayOffID($data['created_id']);

					$auth = $this->session->userdata('auth');

					date_sub($day_off_start_date, date_interval_create_from_date_string("1 days"));

					$day_off_start_date = date_create(date_format($day_off_start_date, "Y-m-d"));

					for ($i=1; $i<=$date_diff; $i++){
						date_add($day_off_start_date, date_interval_create_from_date_string("1 days"));

						$day_off_start_date = date_format($day_off_start_date, "Y-m-d");

						$data_dayoffitem = array(
							'day_off_id'		=> $day_off_id,
							'day_off_item_date'	=> $day_off_start_date,
						);

						$day_off_start_date = date_create($day_off_start_date);						

						$this->ScheduleDayOff_model->insertScheduleDayOffItem($data_dayoffitem);
					}

					$this->fungsi->set_log($auth['user_id'],'1003','Application.ScheduleDayOff.ProcessAddDayOff',$auth['user_id'],'Add New Day Off');
					$msg = "<div class='alert alert-success'>                
								Add Data Dayoff Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$unique 	= $this->session->userdata('unique');
					$this->session->unset_userdata('addScheduleDayOff-'.$unique['unique']);
					redirect('ScheduleDayOff/addScheduleDayOff');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Day Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";;
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addScheduleDayOff',$data);
					redirect('ScheduleDayOff/addScheduleDayOff');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddDayOff',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleDayOff/addScheduleDayOff');
			}
		}
		
		public function editScheduleDayOff(){
			$day_off_id = $this->uri->segment(3);
			$data['Main_view']['ScheduleDayOff']	= $this->ScheduleDayOff_model->getScheduleDayOff_Detail($day_off_id);
			$data['Main_view']['content']			= 'ScheduleDayOff/formeditScheduleDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditScheduleDayOff(){
			
			$data = array(
				'day_off_id' 			=> $this->input->post('day_off_id',true),
				'day_off_name' 			=> $this->input->post('day_off_name',true),
				'day_off_start_date' 	=> tgltodb($this->input->post('day_off_start_date',true)),
				'day_off_end_date' 		=> tgltodb($this->input->post('day_off_end_date',true)),
				'day_off_remark' 		=> $this->input->post('day_off_remark',true),
				'data_state'			=> 0
			);

			$day_off_start_date = date_create($data['day_off_start_date']);
			$day_off_end_date 	= date_create($data['day_off_end_date']);

			$diff  = date_diff($day_off_start_date, $day_off_end_date);

			$date_diff = ($diff->days) + 1;


			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('day_off_name', 'Day Off Name', 'required');
			$this->form_validation->set_rules('day_off_start_date', 'Day Off Start Date', 'required');
			$this->form_validation->set_rules('day_off_end_date', 'Day Off End Date', 'required');

			if($this->form_validation->run()==true){
				if($this->ScheduleDayOff_model->updateScheduleDayOff($data)==true){
					$auth 	= $this->session->userdata('auth');

					if ($this->ScheduleDayOff_model->deleteScheduleDayOffItem($data['day_off_id'])){
						date_sub($day_off_start_date, date_interval_create_from_date_string("1 days"));

						$day_off_start_date = date_create(date_format($day_off_start_date, "Y-m-d"));

						for ($i=1; $i<=$date_diff; $i++){
							date_add($day_off_start_date, date_interval_create_from_date_string("1 days"));

							$day_off_start_date = date_format($day_off_start_date, "Y-m-d");

							$data_dayoffitem = array(
								'day_off_id'		=> $data['day_off_id'],
								'day_off_item_date'	=> $day_off_start_date,
							);

							$day_off_start_date = date_create($day_off_start_date);						

							$this->ScheduleDayOff_model->insertScheduleDayOffItem($data_dayoffitem);
						}
					}

					// $this->fungsi->set_log($auth['user_id'],'1077','Application.ScheduleDayOff.ProcessScheduleDayOff',$auth['user_id'],'Edit Day Off');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['day_off_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('ScheduleDayOff/editScheduleDayOff/'.$data['day_off_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('ScheduleDayOff/editScheduleDayOff/'.$data['day_off_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleDayOff/editScheduleDayOff/'.$data['day_off_id']);
			}
		}
		
				
		function deleteScheduleDayOff(){
			if($this->ScheduleDayOff_model->deleteScheduleDayOff($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.ScheduleDayOff.deleteScheduleDayOff',$auth['user_id'],'Delete Day Off');
				$msg = "<div class='alert alert-success'>                
							Delete Data Day Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleDayOff');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Day Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleDayOff');
			}
		}
	}
?>