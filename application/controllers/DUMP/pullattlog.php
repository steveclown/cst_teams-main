<?php
	Class PullAttLog extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('PullAttLog_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['content']='PullAttLog/pull-attlog';
			$this->load->view('mainpage_view',$data);
		}
		
		public function selectMachine(){
			$data = array (
				"ip" 				=> $this->input->post('ip',true),
				"comkey" 			=> $this->input->post('comkey',true)
			);
			$this->session->set_userdata('filter-selectMachine',$data);
			redirect('pullattlog');
		}
		
		public function reset_machine(){
			$this->session->unset_userdata('filter-selectMachine');
			redirect('pullattlog');
		}
		
		// public function SavePullEmployes(){
			
		// }
	}
?>