<?php
	Class hroemployeedocument extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeedocument_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$sesi	= $this->session->userdata('filter-hroemployeedocument');
			$auth	= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			if(!is_array($sesi)){
				$sesi['employee_id']		='';
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeedocument_model->getCoreDivision(),'division_id', 'division_name');
			$data['main_view']['hroemployeedocument']	= $this->hroemployeedocument_model->getHroEmployeeDocument($region_id, $branch_id, $location_id, $sesi['employee_id']);
			$data['main_view']['content']				= 'hroemployeedocument/listhroemployeedocument_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter_hroemployeedocument(){
			$data = array (
				'employee_id'	=> $this->input->post('employee_id',true),
			);

			$this->session->set_userdata('filter-hroemployeedocument',$data);
			redirect('hroemployeedocument');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->hroemployeedocument_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->hroemployeedocument_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHroEmployeeData(){
			$auth	= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$division_id 	= $this->input->post('division_id');
			$department_id	= $this->input->post('department_id');
			$section_id		= $this->input->post('section_id');
			
			$item = $this->hroemployeedocument_model->getHroEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}
		
		public function addHroEmployeeDocument(){
			$data['main_view']['coredocumentbook'] 			= create_double($this->hroemployeedocument_model->getCoreDocumentBook(),'document_book_id', 'document_book_code');
			$data['main_view']['coredivision']				= create_double($this->hroemployeedocument_model->getCoreDivision(),'division_id', 'division_name');
			$data['main_view']['employeedocumentstatus']	= $this->configuration->EmployeeDocumentStatus;
			$data['main_view']['content']					= 'hroemployeedocument/formaddhroemployeedocument_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddHroEmployeeDocument(){
			$auth 					= $this->session->userdata('auth');
			
			$data_hroemployeedocument = array(
				'employee_id'						=> $this->input->post('employee_id', true),
				'document_book_id'					=> $this->input->post('document_book_id', true),
				'employee_document_receipt_date'	=> tgltodb($this->input->post('employee_document_receipt_date', true)),
				'employee_document_status'			=> 0,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date('Y-m-d- H:i:s'),
			);

			// print_r($data_hroemployeedocument);exit;
			if($this->hroemployeedocument_model->insertHroEmployeeDocument($data_hroemployeedocument)){

				$employee_document_id   = $this->hroemployeedocument_model->getEmployeeDocumentID($data_hroemployeedocument['created_id']);

				$document_book_code 	= $this->hroemployeedocument_model->getDocumentBookCode($data_hroemployeedocument['document_book_id']);
				$employee_document_location = $this->hroemployeedocument_model->getEmployeeDocumentLocation();

					$tempat = './'.$employee_document_location.'/'.$document_book_code.'/'.$data_hroemployeedocument['employee_id'].'/';
					 if( !is_dir($tempat) ) {
					 mkdir($tempat, DIR_WRITE_MODE);
					 }


					 // print_r('$_FILES[item_picture][tmp_name] ');
					 // print_r($_FILES['item_picture']['tmp_name']);exit;
					if($_FILES['item_picture']['tmp_name']!=''){
						$newfilename = strtoupper(md5_file($_FILES['item_picture']['tmp_name']));
						if($_FILES['item_picture']['error'] == 0 && $_FILES['item_picture']['size']>0){
							if($_POST[old_item_picture]!=""){
								$gambarlama=$this->configuration->$tempat.$_POST[old_item_picture];
								if(file_exists($gambarlama)){
									unlink($gambarlama);
								}
							}
							$config['upload_path'] = $tempat;
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['overwrite'] = false;
							$config['remove_spaces'] = true;
							$config['file_name'] = $newfilename;
							$this->load->library('upload', $config);
							// print_r($_FILES['item_picture']['tmp_name']); exit;
							if( $_POST AND $this->upload->do_upload('item_picture') ) {
								$media = $this->upload->data('item_picture');
								// print_r('media'); exit;
								$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
								$config['maintain_ratio'] = FALSE;
								// $config['width'] = 30;
								// $config['height'] = 30;
								$this->load->library('image_lib', $config);
								if ( ! $this->image_lib->resize()){
									$msg = "<div class='alert alert-danger'>                
										".$this->upload->display_errors('', '')."
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
									$this->session->set_userdata('message',$msg);
									redirect('item/add');
								} else {
									$data_hroemployeedocumentitem = array(
										'employee_document_id'				=> $employee_document_id,
										'employee_document_item_name'		=> $this->input->post('employee_document_item_name', true),
										'employee_document_item_filename'	=> $this->upload->file_name,
									);
								}
							}else{
								$data_hroemployeedocumentitem = array(
										'employee_document_id'				=> $employee_document_id,
										'employee_document_item_name'		=> $this->input->post('employee_document_item_name', true),
										'employee_document_item_filename'	=> $this->upload->file_name,
								);
							}
						}else{
							$data_hroemployeedocumentitem = array(
									'employee_document_id'				=> $employee_document_id,
									'employee_document_item_name'		=> $this->input->post('employee_document_item_name', true),
									'employee_document_item_filename'	=> $this->upload->file_name,
							);
						}
					}else{
						$data_hroemployeedocumentitem = array(
								'employee_document_id'				=> $employee_document_id,
								'employee_document_item_name'		=> $this->input->post('employee_document_item_name', true),
								'employee_document_item_filename'	=> $this->upload->file_name,
						);
					}
				
				$this->hroemployeedocument_model->insertHroEmployeeDocumentItem($data_hroemployeedocumentitem);

				$auth = $this->session->userdata('auth');

				$msg = "<div class='alert alert-success'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
							Add Data Employee Document Success
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('addhroemployeedocument-'.$sesi['unique']);
				$this->session->unset_userdata('addarrayhroemployeedocumentitem-'.$sesi['unique']);
				redirect('hroemployeedocument/addHroEmployeeDocument/');
			}else{
				$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
							Add Data Employee Document UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeedocument/addHroEmployeeDocument/');
			}
		}		

		public function filter_hroemployeedocumentreturn(){
			$data = array (
				'employee_id'	=> $this->input->post('employee_id',true),
			);

			$this->session->set_userdata('filter-hroemployeedocumentreturn',$data);
			redirect('hroemployeedocument/returnedHroEmployeeDocument');
		}

				
		public function returnedHroEmployeeDocument(){
			$sesi	= $this->session->userdata('filter-hroemployeedocumentreturn');
			$auth	= $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			if(!is_array($sesi)){
				$sesi['employee_id']		='';
			}

			$data['main_view']['coredivision']			= create_double($this->hroemployeedocument_model->getCoreDivision(),'division_id', 'division_name');
			$data['main_view']['hroemployeedocument']	= $this->hroemployeedocument_model->getHroEmployeeDocumentReturned($region_id, $branch_id, $location_id, $sesi['employee_id']);
			$data['main_view']['content']				= 'hroemployeedocument/listreturnedhroemployeedocument_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addReturnedHroEmployeeDocument(){
			$employee_document_id = $this->uri->segment(3);

			$data['main_view']['hroemployeedocument']		= $this->hroemployeedocument_model->getHroEmployeeDocument_Detail($employee_document_id);
			$data['main_view']['hroemployeedocumentitem']	= $this->hroemployeedocument_model->getHroEmployeeDocumentItem($employee_document_id);
			$data['main_view']['content']				= 'hroemployeedocument/formreturnedhroemployeedocument_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processReturnHroEmployeeDocument(){
			$data = array(
				'employee_document_id'				=> $this->input->post('employee_document_id', true),
				'employee_document_returned_date'		=> tgltodb($this->input->post('employee_document_returned_date', true)),
				'employee_document_status'			=> 1,
			);

			// print_r($data); exit;
			if($this->hroemployeedocument_model->updateHroEmployeeDocument($data)){
			$auth = $this->session->userdata('auth');

				$msg = "<div class='alert alert-success'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
							Returned Employee Document Success
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('addhroemployeedocument-'.$sesi['unique']);
				$this->session->unset_userdata('addarrayhroemployeedocumentitem-'.$sesi['unique']);
				redirect('hroemployeedocument/returnedHroEmployeeDocument/');
			}else{
				$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
							Returned Employee Document UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeedocument/returnedHroEmployeeDocument/');
			}

		}

		public function resetitem(){
			$sesi 	= $this->session->userdata('unique');
			$header = $this->session->userdata('addhroemployeedocument-'.$sesi['unique']);
			
			$this->session->unset_userdata('addhroemployeedocument-'.$sesi['unique']);
			$this->session->unset_userdata('addarrayhroemployeedocumentitem-'.$sesi['unique']);	
			$this->session->unset_userdata($data['created_on']);
			redirect('hroemployeedocument/addHroEmployeeDocument');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeedocument-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeedocument-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeedocument-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeedocument-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeedocument');
			$this->session->unset_userdata('filter-hroemployeedocument');
			redirect('hroemployeedocument');
		}
	}
?>