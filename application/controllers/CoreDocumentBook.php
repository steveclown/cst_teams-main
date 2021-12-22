<?php
	Class CoreDocumentBook extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreDocumentBook_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreDocumentBook']		= $this->CoreDocumentBook_model->getCoreDocumentBook();
			$data['main_view']['content']				= 'CoreDocumentBook/listCoreDocumentBook_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreDocumentBook(){
			$data['main_view']['content']		= 'CoreDocumentBook/formaddCoreDocumentBook_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreDocumentBook(){
			$data = array(
				'document_book_code' 			=> $this->input->post('document_book_code',true),
				'document_book_name' 			=> $this->input->post('document_book_name',true),
				'data_state'			=> 0
				
			);
			
			$this->form_validation->set_rules('document_book_code', 'Document Book Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('document_book_name', 'Document Book Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreDocumentBook_model->insertCoreDocumentBook($data)){
					$employee_document_location = $this->CoreDocumentBook_model->getEmployeeDocumentLocation();

					$tempat = './'.$employee_document_location.'/'.$data['document_book_code'].'/';
					 if( !is_dir($tempat) ) {
					 mkdir($tempat, DIR_WRITE_MODE);
					 }

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreDocumentBook.processaddCoreDocumentBook',$auth['username'],'Add New CoreDocumentBook');
					$msg = "<div class='alert alert-success'>                
								Add Data Document Book Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreDocumentBook');
					redirect('CoreDocumentBook/addCoreDocumentBook');
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Data Document Book UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDocumentBook/addCoreDocumentBook');
				}
			}else{
				$this->session->set_userdata('addCoreDocumentBook',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreDocumentBook/addCoreDocumentBook');
			}
		}		
				
		public function deleteCoreDocumentBook(){
			$document_book_id 	= $this->uri->segment(3);
			$document_book_code = $this->uri->segment(4);
			

			$tempat = './employee_document/'.$document_book_code;
			rmdir($tempat);



			if($this->CoreDocumentBook_model->deleteCoreDocumentBook($document_book_id)){

				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreDocumentBook.delete',$auth['username'],'Delete CoreDocumentBook');
				$msg = "<div class='alert alert-success'>                
							Delete Data Document Book Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDocumentBook');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Document Book UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDocumentBook');
			}
		}
	}
?>