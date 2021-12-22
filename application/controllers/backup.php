## DEDUCTION EMPLOYEE PERMIT
$corepermit = $this->payrollemployeemonthlyspa_model->getCorePermit();
$total_employee_permit_days = 0;

foreach($corepermit as $keyCorePermit => $valCorePermit){
	$deduction_id 			= $valCorePermit['deduction_id'];
	$permit_id 				= $valCorePermit['permit_id'];
	$employee_permit_days 	= 0;

	$hroemployeepermit 		= $this->payrollemployeemonthlyspa_model->getHROEmployeePermit($employee_id, $payrollmonthlyperiod['monthly_period_start_date'], $payrollmonthlyperiod['monthly_period_end_date'], $permit_id);

	print_r("hroemployeepermit ");
	print_r($hroemployeepermit);
	print_r("<BR>");

	$employee_deduction_amount = 0;
	if (!empty($hroemployeepermit)){
		
		foreach ($hroemployeepermit as $keyEmployeePermit => $valEmployeePermit) {
			$employee_permit_days++;
		}

		$total_employee_permit_days = $total_employee_permit_days + $employee_permit_days;

		$payrollemployeededuction = $this->payrollemployeemonthlyspa_model-> getPayrollEmployeeDeduction($employee_id, $year_period, $deduction_id);

		$employee_deduction_amount 			= $payrollemployeededuction['employee_deduction_amount'];

		$deduction_amount 					= $payrollemployeededuction['deduction_amount'];
		$deduction_basic_salary_ratio 		= $payrollemployeededuction['deduction_basic_salary_ratio'];
		$deduction_premi_attendance_ratio 	= $payrollemployeededuction['deduction_premi_attendance_ratio'];
		$deduction_premi_attendance_status 	= $payrollemployeededuction['deduction_premi_attendance_status'];

		$coredeductionallowance 			= $this->payrollemployeemonthlyspa_model->getCoreDeductionAllowance($employee_id, $year_period, $deduction_id);


		if ($employee_deduction_amount == 0){
			if(!empty($coredeductionallowance)){
				$employee_deduction_subtotal 		= 0;
				foreach ($coredeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
					$deduction_allowance_ratio 		= $valDeductionAllowance['deduction_allowance_ratio'];
					$employee_allowance_amount 		= $valDeductionAllowance['employee_allowance_amount'];
					$employee_deduction_subtotal 	= $employee_deduction_subtotal + ($deduction_allowance_ratio * $employee_allowance_amount);
				}
				$deduction_amount1				= $deduction_amount;
			}else{
				$employee_deduction_subtotal 	= $deduction_amount;
				$deduction_amount1 				= 0;
			}

			if ($deduction_premi_attendance_ratio > 0){
				$total_premi = 100 / ($deduction_premi_attendance_ratio * 100);	
			} else {
				$total_premi = 0;
			}
			
			if ($deduction_premi_attendance_status == 0){
				if ($employee_permit_days <= $total_premi){
					$premi_attendance = $employee_permit_days;  # Daily	
				} else {
					$premi_attendance = $total_premi;  # Daily	
				}
			} else {
				$premi_attendance = 1;
			}

			if ($deduction_premi_attendance_ratio > 0){
				$employee_deduction_subtotal 		= $employee_deduction_subtotal + $deduction_amount1;

				$employee_premi_attendance_amount 	= $employee_premi_attendance_amount - ($premi_attendance * $deduction_premi_attendance_ratio * $employee_premi_attendance_amount);
			}else {
				$employee_deduction_subtotal 		= $employee_deduction_subtotal  + $deduction_amount1;
			}						

			if ($deduction_basic_salary_ratio > 0){
				$employee_deduction_subtotal 		= $employee_deduction_subtotal + ($payrollemployeepayment['payment_basic_salary'] / $deduction_basic_salary_ratio) + $deduction_amount1;
			}else {
				$employee_deduction_subtotal 		= $employee_deduction_subtotal;
			}
		} else {

		}
	}

	if ($employee_permit_days > 0){
		$data_payrollemployeededuction = array(
			'employee_monthly_deduction_id'		=> date("YmdHis"),
			'employee_id' 						=> $employee_id,
			'deduction_id' 						=> $deduction_id,
			'deduction_type' 					=> $valCoreDeduction['deduction_type'],
			'employee_deduction_id'				=> $payrollemployeededuction['employee_deduction_id'],
			'employee_monthly_period'			=> $payrollmonthlyperiod['monthly_period'],
			'employee_deduction_amount'			=> $employee_deduction_amount,
			'employee_monthly_working_days'		=> $employee_monthly_working_days,
			'employee_monthly_deduction_days'	=> $employee_permit_days,
			'employee_deduction_subtotal'		=> $employee_deduction_subtotal,
		);

		$unique 			= $this->session->userdata('unique');
		$dataArrayHeader	= $this->session->userdata('addarrayemployeededuction-'.$unique['unique']);
		$dataArrayHeader[$data_payrollemployeededuction['deduction_id']] = $data_payrollemployeededuction;
		$this->session->set_userdata('addarrayemployeededuction-'.$unique['unique'],$dataArrayHeader);
		$sesi 	= $this->session->userdata('unique');
		$data_payrollemployeededuction = $this->session->userdata('addpayrollemployeemonthlyspa-'.$sesi['unique']);

		$this->session->set_userdata('addpayrollemployeemonthlyspa-'.$sesi['unique'],$data_payrollemployeededuction);
	}
}