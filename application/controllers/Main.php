<?php
	class Main extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('Main_model');
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database("default");
			$this->load->helper('url'); 
		}

		public function index(){
			$data['main_view']['employeeorganization']	= $this->create_series_employee_organization();
			
			$data['main_view']['content']				= 'Main/Main_view';
			$this->load->view('Mainpage_view',$data);
		}
		
		public function create_series_employee_organization(){
			$root			= array();
			$data			= array();
			
			$core_division = $this->Main_model->getCoreDivision();
				
			foreach($core_division as $key => $val){
				$data[] = $val['division_id'];
			}
			
			/*print_r("core_division ");
			print_r($core_division);
			print_r("<BR>");
			print_r("<BR>");*/

			/*$itemsByReference = array();

		// Build array of item references:
		foreach($data as $key => &$item) {
		   $itemsByReference[$item['id']] = &$item;
		   // Children array:
		   $itemsByReference[$item['id']]['children'] = array();
		   // Empty data class (so that json_encode adds "data: {}" ) 
		   $itemsByReference[$item['id']]['data'] = new StdClass();
		}

		// Set items as children of the relevant parent item.
		foreach($data as $key => &$item)
		   if($item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
		      $itemsByReference [$item['parent_id']]['children'][] = &$item;
*/

			if(!empty($core_division)){
				/*$i 		= 0;
				$arr 	= array();

				foreach($core_division as $keyDivision => $valDivision){
					$core_department = $this->Main_model->getCoreDepartment($valDivision['division_id']);

					foreach ($core_department as $keyDepartment => $valDepartment) {
						$core_section = $this->Main_model->getCoreSection($valDepartment['department_id']);

						$arr[$valDepartment['department_id']] = $valDepartment;

						foreach ($core_section as $keySection => $valSection) {
		      				$arr[$valDepartment['department_id']]['children'] = $valSection;
						}
					}
				}*/


				$itemsByReference = array();

				$core_section = $this->Main_model->getCoreSection();

				// Build array of item references:
				foreach($core_section as $key => &$item) {
				   $itemsByReference[$item['section_id']] = &$item;
				   // Children array:
				   $itemsByReference[$item['section_id']]['children'] = array();
				    $itemsByReference[$item['section_id']]['children'] = array();
				   // Empty data class (so that json_encode adds "data: {}" ) 
				   $itemsByReference[$item['section_id']]['data'] = new StdClass();
				}

				// Set items as children of the relevant parent item.
				foreach($core_section as $key => &$item)
				   if($item['department_id'] && isset($itemsByReference[$item['department_id']]))
				      $itemsByReference [$item['department_id']]['children'][] = &$item;

			}

			/*if(!empty($core_division)){
				$i 		= 0;
				$arr 	= array();

				foreach($core_division as $keyDivision => $valDivision){
					$core_department = $this->Main_model->getCoreDepartment($valDivision['division_id']);

					foreach ($core_department as $keyDepartment => $valDepartment) {
						$core_section = $this->Main_model->getCoreSection($valDepartment['department_id']);

						$arr[$valDepartment['department_id']] = $valDepartment;

						foreach ($core_section as $keySection => $valSection) {
		      				$arr[$valDepartment['department_id']]['children'] = &$valSection;
						}
					}
				}
			}*/

			/*print_r($itemsByReference);*/
			/*echo json_encode($itemsByReference);
			exit;*/
			return json_encode($core_section);
			/*exit;*/
			 /* $a = encode_to_json($arr);
			 print_r("a encode to json create_series_iq_per_participant ");
			 print_r($a);  */
			/* exit;*/
			/*return encode_to_json($a);*/
		}
	}
?>