<?php
	Class tax extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('tax_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['tax']		= $this->tax_model->get_list();
			$data['main_view']['content']	= 'tax/listtax_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']	= 'tax/formaddtax_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddTax(){
			$data = array(
				'tax_period' 		=> $this->input->post('tax_period',true),
				'tax_type' 		=> $this->input->post('tax_type',true),
				'tax_non_taxable_income' 		=> $this->input->post('tax_non_taxable_income',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('tax_period', 'Tax Period', 'required|numeric');
			$this->form_validation->set_rules('tax_type', 'Tax Type', 'required');
			$this->form_validation->set_rules('tax_non_taxable_income', 'Tax Non Taxable Income', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->tax_model->saveNewTax($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.tax.processAddtax',$auth['username'],'Add New Tax');
					$msg = "<div class='alert alert-success'>                
								Add Data Tax Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtax');
					redirect('tax/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Tax UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddTax',$data);
					redirect('tax/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddTax',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('tax/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->tax_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'tax/formedittax_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditTax(){
			
			$data = array(
				'tax_id' 		=> $this->input->post('tax_id',true),
				'tax_period' 		=> $this->input->post('tax_period',true),
				'tax_type' 		=> $this->input->post('tax_type',true),
				'tax_non_taxable_income' 		=> $this->input->post('tax_non_taxable_income',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('tax_period', 'Tax Period', 'required|numeric');
			$this->form_validation->set_rules('tax_type', 'Tax Type', 'required');
			$this->form_validation->set_rules('tax_non_taxable_income', 'Tax Non Taxable Income', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->tax_model->saveEditTax($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.tax.Edit',$auth['username'],'Edit Tax');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['tax_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Tax Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('tax/Edit/'.$data['tax_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('tax/Edit/'.$data['tax_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('tax/Edit/'.$data['tax_id']);
			}
		}
		
				
		function delete(){
			if($this->tax_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.tax.delete',$auth['username'],'Delete Tax');
				$msg = "<div class='alert alert-success'>                
							Delete Data Tax Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('tax');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Tax UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('tax');
			}
		}
	}
?>