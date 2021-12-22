<?php
	class payrollleaverequestapproval_model extends CI_Model {
		var $table = "transaction_leave_request";
		
		public function payrollleaverequestapproval_model(){
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

		public function getHROEmployeeData_LeaveApproval(){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, hro_employee_data.employee_name, payroll_leave_request.annual_leave_id, core_annual_leave.annual_leave_name, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_start_date, payroll_leave_request.leave_request_end_date, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_duration');
			$this->db->from('payroll_leave_request');
			$this->db->join('hro_employee_data', 'payroll_leave_request.employee_id = hro_employee_data.employee_id');
			$this->db->join('core_annual_leave', 'payroll_leave_request.annual_leave_id = core_annual_leave.annual_leave_id');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.leave_request_approved', 0);
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

		public function getCoreAnnualLeave(){
			$this->db->select('core_annual_leave.annual_leave_id, core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}

		public function getAnnualLeaveName($annual_leave_id){
			$this->db->select('core_annual_leave.annual_leave_name');
			$this->db->from('core_annual_leave');
			$this->db->where('core_annual_leave.annual_leave_id', $annual_leave_id);
			$this->db->where('data_state',0);
			$result=$this->db->get()->row_array();
			return $result['annual_leave_name'];
		}
		
		public function saveNewPayrollLeaveRequest($data){
			return $this->db->insert('payroll_leave_request',$data);
		}

		public function getPayrollLeaveRequestApproval_Data($employee_id){
			$this->db->select('payroll_leave_request.leave_request_id, payroll_leave_request.employee_id, payroll_leave_request.annual_leave_id, payroll_leave_request.leave_request_description, payroll_leave_request.leave_request_date, payroll_leave_request.leave_request_duration, payroll_leave_request.leave_request_reason, payroll_leave_request.leave_request_approved, payroll_leave_request.leave_request_approved_id, payroll_leave_request.leave_request_approved_on, payroll_leave_request.leave_request_approved_remark');
			$this->db->from('payroll_leave_request');
			$this->db->where('payroll_leave_request.data_state',0);
			$this->db->where('payroll_leave_request.employee_id', $employee_id);
			$this->db->order_by('payroll_leave_request.leave_request_id', DESC);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getDetail($id){
			$this->db->select('*')->from($this->table);
			$this->db->where('leave_request_id',$id);
			return $this->db->get()->row_array();
		}

		public function saveEditPayrollLeaveRequestApproval($data){
			$this->db->where('leave_request_id',$data['leave_request_id']);
			$query = $this->db->update('payroll_leave_request', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollLeaveRequest($employee_id){
			$this->db->where("payroll_leave_request.employee_id", $employee_id);
			$query = $this->db->update('payroll_leave_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deletePayrollLeaveRequest_Data($leave_request_id){
			$this->db->where("payroll_leave_request.leave_request_id", $leave_request_id);
			$query = $this->db->update('payroll_leave_request', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>