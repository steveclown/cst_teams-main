<?php	Class pulldataemployee extends CI_Controller{		public function __construct(){			parent::__construct();			$this->load->model('pulldataemployee_model');			$this->load->helper('sistem');			$this->load->library('fungsi');			$this->load->library('configuration');			$this->load->library('zklibs');		}				public function index(){			$this->lists();		}				public function filter(){			$data = array (				'machine_id'						=> $this->input->post('machine_id',true),			);						$this->form_validation->set_rules('machine_id', 'Machine', 'required');						if($this->form_validation->run()==true){				$this->session->set_userdata('filter-employee',$data);				redirect('pulldataemployee');			}else{				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");				$this->session->set_userdata('message',$msg);				redirect('pulldataemployee');			}		}				public function resetfilter(){			$this->session->unset_userdata('filter-employee');			$this->session->unset_userdata('dataemployee');			redirect('pulldataemployee');		}				function lists(){			$sesi	= 	$this->session->userdata('filter-employee');			if(!is_array($sesi)){					$sesi['machine_id']						='';			}else{				if($this->session->userdata("dataemployee")==""){					$machine_info = $this->pulldataemployee_model->getmachineinfo($sesi['machine_id']);					$zk = new ZKLib($machine_info[machine_ip_address],$machine_info[machine_port]);					$ret = $zk->connect();					$user = $zk->getUser();					// print_r($user);exit;					$zk->disconnect();					foreach($user as $key=>$val){						$data_item = array(											'id' 		=> $val[0],											'name' 		=> $val[1],											'password' 	=> $val[3],						);						$dataArray 	= $this->session->userdata("dataemployee");						$dataArray[$data_item['id']] = $data_item;						$this->session->set_userdata("dataemployee",$dataArray);												$data_insert = array(										'machine_id'	=> $sesi['machine_id'],										'id' 			=> $val[0],										'name' 			=> $val[1],										'password' 		=> $val[3],						);												if($this->pulldataemployee_model->checkifexist($sesi['machine_id'],$data_insert['id'])==false){							if($this->pulldataemployee_model->insertdata($data_insert)){								$msg = "<div class='alert alert-success'>											Employee Data Updated										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";								$this->session->set_userdata('message',$msg);							}						}else{							if($this->pulldataemployee_model->updatedata($data_insert)){								$msg = "<div class='alert alert-success'>											Employee Data Updated										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";								$this->session->set_userdata('message',$msg);							}						}					}				}			}			$data['main_view']['machine']		= create_double($this->pulldataemployee_model->getmachine(),"machine_id","machine_name");			$data['main_view']['content']		= 'pulldataemployee/filteremployee_view';			$this->load->view('mainpage_view',$data);		}	}