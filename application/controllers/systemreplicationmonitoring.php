<?php
	Class systemreplicationmonitoring extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('systemreplicationmonitoring_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library('config.inc');
			$this->load->library('engine.inc');
		}
		
		
	}
?>