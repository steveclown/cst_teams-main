<?php
	class payrollovertimerequestapproval_model extends CI_Model {
		var $table = "transaction_overtime_request";
		
		public function payrollovertimerequestapproval_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreDivision(){
			$this->db->select('core_division.division_id, core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreDepartment(){
			$this->db->select('core_department.department_id, core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getCoreSection(){
			$this->db->select('core_section.section_id, core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData($employee_id){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name, hro_employee_data.division_id, hro_employee_data.department_id, hro_employee_data.section_id');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.employee_id', $employee_id);
			$result = $this->db->get();
			return $result->row_array();
		}

		public function getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level){
			$this->db->select('hro_employee_data.employee_id, hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.data_state',0);
			$this->db->where('hro_employee_data.region_id', $region_id);
			$this->db->where('hro_employee_data.branch_id', $branch_id);
			$this->db->where('hro_employee_data.location_id', $location_id);

			if ($payroll_employee_level != 9){
				$this->db->where('hro_employee_data.payroll_employee_level', $payroll_employee_level);
			}
			
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getHROEmployeeData_OvertimeApproval(){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, hro_employee_data.employee_name, payroll_overtime_request.overtime_type_id, core_overtime_type.overtime_type_name, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_duration');
			$this->db->from('payroll_overtime_request');
			$this->db->join('hro_employee_data', 'payroll_overtime_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_overtime_type', 'payroll_overtime_request.overtime_type_id = core_overtime_type.overtime_type_id');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.overtime_request_approved', 0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getEmployeeName($id){
			$this->db->select('hro_employee_data.employee_name');
			$this->db->from('hro_employee_data');
			$this->db->where('hro_employee_data.employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}

		public function getDivisionName($division_id){
			$this->db->select('core_division.division_name');
			$this->db->from('core_division');
			$this->db->where('core_division.division_id', $division_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['division_name'];
		}


		public function getDepartmentName($department_id){
			$this->db->select('core_department.department_name');
			$this->db->from('core_department');
			$this->db->where('core_department.department_id', $department_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['department_name'];
		}

		public function getSectionName($section_id){
			$this->db->select('core_section.section_name');
			$this->db->from('core_section');
			$this->db->where('core_section.section_id', $section_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['section_name'];
		}

		public function getCoreOvertimeType(){
			$this->db->select('core_overtime_type.overtime_type_id, core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getOvertimeTypename($overtime_type_id){
			$this->db->select('core_overtime_type.overtime_type_name');
			$this->db->from('core_overtime_type');
			$this->db->where('core_overtime_type.overtime_type_id', $overtime_type_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['overtime_type_name'];
		}
		
		public function saveNewPayrollOvertimeRequest($data){
			return $this->db->insert('payroll_overtime_request',$data);
		}

		public function getPayrollOvertimeRequestApproval_Data($employee_id){
			$this->db->select('payroll_overtime_request.overtime_request_id, payroll_overtime_request.employee_id, payroll_overtime_request.overtime_type_id, payroll_overtime_request.overtime_request_description, payroll_overtime_request.overtime_request_date, payroll_overtime_request.overtime_request_duration, payroll_overtime_request.overtime_request_remark, payroll_overtime_request.overtime_request_approved, payroll_overtime_request.overtime_request_approved_id, payroll_overtime_request.overtime_request_approved_on, payroll_overtime_request.overtime_request_approved_remark');
			$this->db->from('payroll_overtime_request');
			$this->db->where('payroll_overtime_request.data_state',0);
			$this->db->where('payroll_overtime_request.employee_id', $employee_id);
			$this->db->order_by('payroll_overtime_request.overtime_request_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('overtime_request_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEditPayrollOvertimeRequestApproval($data){
			$this->db->where('overtime_request_id',$data['overtime_request_id']);
			$query = $this->db->update('payroll_overtime_request', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollOvertimeRequest($employee_id){
			$this->db->where("payroll_overtime_request.employee_id", $employee_id);
			$query = $this->db->update('payroll_overtime_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollOvertimeRequest_Data($overtime_request_id){
			$this->db->where("payroll_overtime_request.overtime_request_id", $overtime_request_id);
			$query = $this->db->update('payroll_overtime_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>