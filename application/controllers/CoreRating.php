<?php
	Class CoreRating extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreRating_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreRating']		= $this->CoreRating_model->getCoreRating();
			$data['Main_view']['content']			= 'CoreRating/listCoreRating_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreRating(){
			$data['Main_view']['content']			= 'CoreRating/formaddCoreRating_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreRating(){
			$data = array(
				'rating_code' 		=> $this->input->post('rating_code',true),
				'rating_name' 		=> $this->input->post('rating_name',true),
				'rating_range1' 	=> $this->input->post('rating_range1',true),
				'rating_range2' 	=> $this->input->post('rating_range2',true),
				'rating_value' 		=> $this->input->post('rating_value',true),
				'rating_remark' 	=> $this->input->post('rating_remark',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('rating_code', 'Rating Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('rating_name', 'Rating Name', 'required');
			$this->form_validation->set_rules('rating_range1', 'Rating Range1', 'required');
			$this->form_validation->set_rules('rating_range2', 'Rating Range2', 'required');
			$this->form_validation->set_rules('rating_value', 'Rating Value', 'required');
			$this->form_validation->set_rules('rating_remark', 'Rating Remark', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreRating_model->saveNewCoreRating($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.Rating.processAddRating',$auth['username'],'Add New Rating');
					$msg = "<div class='alert alert-success'>                
								Add Data Rating Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCoreRating');
					redirect('CoreRating/addCoreRating');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Rating UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreRating/addCoreRating');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddCoreRating',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreRating/addCoreRating');
			}
		}
		
		function editCoreRating(){
			$data['Main_view']['CoreRating']	= $this->CoreRating_model->getCoreRating_Detail($this->uri->segment(3));
			$data['Main_view']['content']		= 'CoreRating/formeditCoreRating_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreRating(){
			$data = array(
				'rating_id' 		=> $this->input->post('rating_id',true),
				'rating_code' 		=> $this->input->post('rating_code',true),
				'rating_name' 		=> $this->input->post('rating_name',true),
				'rating_range1' 	=> $this->input->post('rating_range1',true),
				'rating_range2' 	=> $this->input->post('rating_range2',true),
				'rating_value' 		=> $this->input->post('rating_value',true),
				'rating_remark' 	=> $this->input->post('rating_remark',true),
				'data_state'		=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('rating_code', 'Rating Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('rating_name', 'Rating Name', 'required');
			$this->form_validation->set_rules('rating_range1', 'Rating Range1', 'required');
			$this->form_validation->set_rules('rating_range2', 'Rating Range2', 'required');
			$this->form_validation->set_rules('rating_value', 'Rating Value', 'required');
			$this->form_validation->set_rules('rating_remark', 'Rating Remark', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreRating_model->saveEditCoreRating($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.Rating.Edit',$auth['username'],'Edit Rating');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['rating_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Rating Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreRating/editCoreRating/'.$data['rating_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Rating UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreRating/editCoreRating/'.$data['rating_id']);
				}
			}else{
				$msg = "<div class='alert alert-error'>                
							Id Rating : <b>".$data['rating_id']."</b> has been exist !
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreRating/editCoreRating/'.$data['rating_id']);
			}
		}
		
				
		function deleteCoreRating(){
			if($this->CoreRating_model->deleteCoreRating($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.Rating.DeleteCoreRating',$auth['username'],'Delete Rating');
				$msg = "<div class='alert alert-success'>                
							Delete Data Rating Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreRating');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Rating UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreRating');
			}
		}
	}
?>