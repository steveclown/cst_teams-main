<?php
	Class MainPage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			
			
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->helper('url');
		}
		
		public function index(){
			$data['main_view']['content']	='home';
			$this->load->view('MainPage_view',$data);
		}
	}
?>