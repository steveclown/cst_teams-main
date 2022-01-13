<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Configuration {
	public function __construct(){
		define('SQL_HOST','localhost');
		define('SQL_USER','root');
		define('SQL_PASSWORD','');
		define('SQL_DB','ims_mitra_utama');
		define('PAGGING','10');
		define('LIMIT','E5BWpg==');
	}

	public function Status(){
		$status 							= array (0 =>"Tidak", 1=>"Ya");

		return $status;
	}
	
	public function State(){
		$state 								= array (0 =>"Tidak Aktif", 1=>"Aktif");

		return $state();
	}

	// public function employeestatus(){
	// 	$employee_status					= array (0 =>"Masa Percobaan ", 1=>"Kontak", 2=>"Tetap", 3=>"Resign", 4=>"Skorsing");

	// 	return $employee_status;
	// }
	public function RfidMode(){
		$status = array (0 => 'SCAN', 1 => 'ADD');
		return $status;
	}
	
	public function Status1(){
		$status1 							= array (0 =>"Not Fancy", 1=>"Fancy");

		return $status1;
	}

	public function StatusApplicant(){
		$status_applicant 							= array (0 =>"New", 1=>"Interview", 2=>"Test 1", 3=>"Test 2", 4=>"Test 3", 5=>"Finalisasi");

		return $status_applicant;
	}

	public function skorsingstatus(){
		$skorsing_status 					= array (0 =>"Unskorsing", 1=>"Skorsing");

		return $skorsing_status;
	}

	public function Type(){
		$type 								= array (0 =>"Full Time", 1=>"Part Time");

		return $type;
	}

	public function DataState(){
		$data_state 						= array (0 =>"Aktif", 1=>"Dihapus");

		return $data_state;
	}
	
	public function EmployeeType(){
		$employee_type 						= array (0 =>"Full Time", 1=>"Part Time");

		return $employee_type;
	}
	
	public function AllowanceType(){
		$allowance_type 					= array (0=>"Tunjangan Tetap", 1=>"Tunjangan Kehadiran"); 

		return $allowance_type;
	}
		
	public function AllowanceGroup(){
		$allowance_group 					= array (0=>"Makan", 1=>"Transportasi", 2=>"Housing", 3=>"Fire Team", 4=>"Lain-Lain");

		return $allowance_group;
	}

	public function AnnualLeaveType(){
		$annual_leave_type 					= array (0=>"Non Normatif", 1=>"Normatif");

		return $annual_leave_type;
	}

	public function IncludeDayOff(){
		$include_day_off 					= array (0=>"Tidak", 1=>"Ya");

		return $include_day_off;
	}
	
	public function TrainingType(){
		$training_type 						= array (0=>"Training", 1=>"Certification");

		return $training_type;
	}
	
	public function GlassesCoverageType(){
		$glasses_coverage_type 				= array (0=>"Frame Single Vision", 1=>"Frame Double Vision");

		return $glasses_coverage_type;
	}
	
	public function EducationType(){
		$education_type 					= array (0=>"Formal", 1=>"Non Formal");

		return $education_type;
	}

	public function EducationPassed(){
		$education_passed 					= array (0=>"Tidak", 1=>"Ya");

		return $education_passed;
	}
	
	public function EducationCertificate(){
		$education_certificate 				= array (0=>"Tidal", 1=>"Ya");

		return $education_certificate;
	}
	
	public function ExpertisePassed(){
		$expertise_passed 					= array (0=>"Tidak", 1=>"Ya");

		return $expertise_passed;
	}

	public function ExpertiseCertificate(){
		$expertise_certificate 				= array (0=>"Tidak", 1=>"Ya");

		return $expertise_certificate;
	}
	
	public function OrganizationStatus(){
		$organization_status 				= array (0=>"Tidak Aktif", 1=>"Aktif");

		return $organization_status;
	}
	
	public function Religion(){
		$religion 							= array (0=>"Islam", 1=>"Kristen", 2=>"Katolik", 3=>"Hindu", 4=>"Buddha");

		return $religion;
	}
	
	public function BloodType(){
		$blood_type 						= array (0=>"O", 1=>"A", 2=>"B", 3=>"AB");

		return $blood_type;
	}
	
	public function Gender(){
		$gender 							= array (0 => 'Perempuan', 1 => 'Laki - Laki');

		return $gender;
	}
	
	public function ResidenceStatus(){
		$residence_status					= array (0 => 'Private Property', 1 => 'Family Owned', 2 => 'Rent', 3 => 'Boarding');

		return $residence_status;
	}

	public function Nationality(){
		$nationality 						= array (0 => 'WNI', 1 => 'WNA');

		return $nationality;
	}

	public function IDType(){
		$id_type 							= array (0 => 'KTP', 1 => 'SIM');

		return $id_type;
	}

	public function StatusEmployment(){
		$status_employment 					= array (0 => 'Masa Percobaan', 1 => 'Kontrak', 2 => 'Tetap');

		return $status_employment;
	}

	public function WorkingStatus(){
		$working_status 					= array (1 => 'Bulanan', 0 => 'Harian');

		return $working_status;
	}
	
	public function OvertimeStatus(){
		$overtime_status 					= array (0 => 'Automatic', 1 => 'SPL');

		return $overtime_status;
	}
	
	public function RegistrationSelected(){
		$registration_selected 				= array (0 => 'Tidak', 1 => 'Ya');

		return $registration_selected;
	}
	
	public function HasLeavePermission(){
		$has_leave_permission 				= array (0 => 'Tidak', 1 => 'Ya');

		return $has_leave_permission;
	}
	
	public function HasCoverageClaim(){
		$has_coverage_claim 				= array (0 => 'Tidak', 1 => 'Ya');

		return $has_coverage_claim;
	}
	
	public function SeparationLetter(){
		$separation_letter 					= array (0 => 'Tidak', 1 => 'Ya');

		return $separation_letter;
	}

	public function SickOpname(){
		$sick_opname 						= array (0 => 'Tidak', 1 => 'Ya');

		return $sick_opname;
	}
	
	public function ColourBlind(){
		$colour_blind 						= array (0 => 'Tidak', 1 => 'Ya');

		return $colour_blind;
	}

	public function EmployeeRequestStatus(){
		$employee_request_status 			= array (0 => 'Requested', 1 => 'Rejected', 2 => 'Selected', 3 => 'Recruited', 9 => 'Approved' );

		return $employee_request_status;
	}
	
	public function RequestStatus2(){
		$request_status 					= array (2 => 'Selected', 1 => 'Rejected');

		return $request_status;
	}
	
	public function HeaderRequestStatus(){
		$header_request_status 				= array (2 => 'Selected', 1 => 'Rejected');

		return $header_request_status;
	}
	
	public function SelectionStatus(){
		$selection_status 					= array (0 => 'Selected', 1 => 'Rejected', 2 => 'Interviewed', 3 => 'Recruited');

		return $selection_status;
	}

	public function EmployeeStatus(){
		$employee_status 					= array (1 => 'Tetap', 2 => 'Masa Percobaan', 3 => 'Kontrak 1', 4 => 'Kontrak 2'); 

		return $employee_status;
	}
	
	public function HeaderSelectionStatus(){
		$header_selection_status 			= array (0 => 'Selected', 1 => 'Recruited');

		return $header_selection_status;
	} 
	
	public function WorkingEnvironment(){
		$working_environment 				= array (0 => 'Back Office', 1 => 'Front Office', 2 => 'Production', 3 => 'Workshop', 4 => 'Out Station', 5 => 'Other');

		return $working_environment;
	}
	
	public function RecruitmentStatus(){
		$recruitment_status 				= array (0 => 'Tidak', 1 => 'Ya');

		return $recruitment_status;
	}
	
	public function DeductionType(){
		$deduction_type 					= array (0 => 'Potongan Personal', 1 => 'Potongan Absensi', 2 => 'Potongan Normatif', 3 => 'Potongan Sakit', 4 => 'Potongan Keterlambatan', 5=> 'Potongan Asuransi', 6 => 'Potongan Pelanggaran', 7 => 'Tidak Ada potongan' );
		return $deduction_type;
	}
		
	public function ListeningSkill(){
		$listening_skill 					= array (0 => 'Buruk', 1 => 'Standard', 2 => 'Baik', 3 => 'Sangat Baik');

		return $listening_skill;
	}

	public function WritingSkill(){
		$writing_skill 						= array (0 => 'Buruk', 1 => 'Standard', 2 => 'Baik', 3 => 'Sangat Baik');

		return $writing_skill;
	}

	public function ReadingSkill(){
		$reading_skill 						= array (0 => 'Buruk', 1 => 'Standard', 2 => 'Baik', 3 => 'Sangat Baik');

		return $reading_skill;
	}

	public function SpeakingSkill(){
		$speaking_skill 					= array (0 => 'Buruk', 1 => 'Standard', 2 => 'Baik', 3 => 'Sangat Baik');

		return $speaking_skill;
	}
	
	public function SubjectsStatus(){
		$subject_status 					= array (0 => "Dislike", 1 => "Like");

		return $subject_status;
	}
	
	public function OrganizationType(){
		$organization_type 					= array (0 => 'Politik', 1 => 'Sosial', 2 => 'Olahraga', 3 => 'Kebudayaan', 4 => 'Keagamaan');

		return $organization_type;
	}
	
	public function PhotoDirectory(){
		$photo_directory 					= "./img/employee/";

		return $photo_directory;
	}
	
	public function AvatarDirectory(){
		$avatar_directory 					= "./img/avatar/";

		return $avatar_directory;
	}
	
	public function Approved(){
		$approved 							= array (0 => 'Not Approved', 1 => 'Approved');

		return $approved;
	}
	
	public function AssetStatus(){
		$asset_status 						= array (0 => 'Returned', 1 => 'Active');

		return $asset_status;
	}
	
	public function ServicePayType(){
		$service_pay_type 			 		= array (0 => 'Gaji Pokok', 1 => 'Upah Harian');

		return $service_pay_type;
	}

	public function SuspendStatus(){
		$suspend_status 					= array (0 =>"Unsuspended", 1=>"Suspended");

		return $suspend_status;
	}	

	public function PermitType(){
		$permit_type 						= array (1 =>"Daily Permit", 2=>"Sick Permit", 3=>"Early Permit", 4=>"Duty Permit", 5=>"Personal Permit");

		return $permit_type;
	}	 			

	public function ShiftPatternDay(){
		$shift_pattern_day					= array (0 => "Not Define", 1 =>"Monday", 2 => "Tuesday", 3 => "Wednesday", 4 => "Thursday", 5 => "Friday", 6 => "Saturday", 7 => "Sunday");

		return $shift_pattern_day;
	}			

	public function ShiftPatternDayShift(){
		$shift_pattern_day_shift 			= array (0 => "Not Define", 1 =>"Sen", 2 => "Sel", 3 => "Rab", 4 => "Kam", 5 => "Jum", 6 => "Sab", 7 => "Minggu");

		return $shift_pattern_day_shift;
	}		

	public function BPJSStatus(){
		$bpjs_status 						= array (1 => 'Aktif', 0 => 'Tidak Aktif');

		return $bpjs_status;
	}	 			

	public function IncludeBPJS(){
		$include_bpjs 						= array (0 => 'Exclude', 1 => 'Include');

		return $include_bpjs;
	}	 			

	public function HomeEarlyStatus(){
		$home_early_status 					= array (0 => 'Working Hour', 1 => 'Minimum Working Hour');

		return $home_early_status;
	} 			

	public function Month(){
		$month 									= array(
													'01'		=> "Januari",
													'02'		=> "Februari",
													'03'		=> "Maret",
													'04'		=> "April",
													'05'		=> "Mei",
													'06'		=> "Juni",
													'07'		=> "Juli",
													'08'		=> "Agustus",
													'09'		=> "September",
													'10'		=> "Oktober",
													'11'		=> "November",
													'12'		=> "Desember",
												);

		return $month;
	}					
										
	public function MonthName(){
		$month_name 							= array(
													'Januari'		=> "01",
													'Februari'		=> "02",
													'Maret'			=> "03",
													'April'			=> "04",
													'Mei'			=> "05",
													'Juni'			=> "06",
													'Juli'			=> "07",
													'Agustus'		=> "08",
													'September'		=> "09",
													'Oktober'		=> "10",
													'November'		=> "11",
													'Desember'		=> "12",
												);

		return $month_name;
	}		

	public function UserStatus(){
		$user_status 							= array (0 => 'Suspended', 1 => 'Active');

		return $user_status;
	} 						

	public function EmployeeRequestApproval(){
		$employee_request_approval 				= array (0 => "Draft", 1 => "Approved", 2 => "Rejeected");

		return $employee_request_approval;		
	}				

	public function LeaveRequestApproved(){
		$leave_requesr_approved 				= array (0 => "Draft", 1 => "Approved", 2 => "Rejected");

		return $leave_requesr_approved;
	}					

	public function OvertimeRequestApproved(){
		$overtime_request_apporved 				= array (0 => "Draft", 1 => "Approved", 2 => "Rejected");

		return $overtime_request_apporved;
	}				

	public function PayrollEmployeeLevel(){
		$payroll_employee_level 				= array (1 => "Payroll Level 1", 2 => "Payroll Level 2", 3 => "Payroll Level 3");

		return $payroll_employee_level;
	}					

	public function BPJSMonthlyStatus(){
		$bpjs_monthly_status 					= array (1 => "Include Company", 0 => "Exclude Company");

		return $bpjs_monthly_status;
	}					

	public function EmployeeDocumentStatus(){
		$employee_document_status 				= array (0 => "Belum Diambil", 1 => "Sudah Diambil");

		return $employee_document_status;
	}				

	public function ScheduleEmployeeScheduleItemStatus(){
		$schedule_employee_schedule_item_status = array (0 => "Keluar Jadwal", 1 => "Jadwal", 2 => "Masuk Jadwal");

		return $schedule_employee_schedule_item_status;
	}	

	public function ScheduleEmployeeShiftStatus(){
		$schedule_employee_shift_status 		= array (0 => 'Tidak Aktif', 1 => 'Aktif');

		return $schedule_employee_shift_status;
	} 			

	public function EmployeeLoanStatus(){
		$employee_loan_status					= array (0 => 'Tidak Aktif', 1 => 'Aktif');

		return $employee_loan_status;
	}

	public function ScheduleEmployeeScheduleItem(){
		$schedule_employee_schedule_item 		= array (0 => 'Day Off', 1 => 'Active', 2 => 'Absence', 3 => 'Permit', 9 => '-');

		return $schedule_employee_schedule_item;
	}			

	public function DayOffStatus(){
		$day_off_status 						= array (0 => 'Sunday Day Off Include', 1 => 'Sunday Day Off Exclude');

		return $day_off_status;
	}							

	public function EmployeeAttendanceWorkingStatus(){
		$employee_attandance_working_status 	= array (9 => 'Not Present', 1 => 'Overtime', 2 => 'Home Early', 3 => 'Late', 4 => 'Normal');

		return $employee_attandance_working_status;
	}		

	public function EmployeeAttendanceDateStatus(){
		$employee_attandance_date_status 		= array (8 => 'Not Define', 0 => 'Off', 1 => 'Hadir', 2 => 'Mangkir', 3 => 'Ijin Biasa', 4 => 'Ijin Sakit', 5 => 'Cuti', 6 => 'Pulang Awal', 7 => 'Kecelakaan Kerja', 9 => 'Default', 10 => 'Tidak Absen Masuk', 11 => 'Tidak Absen Pulang' );

		return $employee_attandance_date_status;
	}			

	public function EmployeeAttendanceLateStatus(){
		$employee_attandance_last_status 		= array (9 => 'Not Define', 0 => 'Todak', 1 => 'Ya');

		return $employee_attandance_last_status;
	}			

	public function EmployeeAttendanceOvertimeStatus(){
		$employee_attandance_overtime_status 	= array (9 => 'Not Define', 0 => 'Tidak', 1 => 'Ya');

		return $employee_attandance_overtime_status;
	}		

	public function EmployeeAttendanceHomeEarlyStatus(){
		$employee_attandance_home_early_status 	= array (9 => 'Not Define', 0 => 'Tidak', 1 => 'Ya');

		return $employee_attandance_home_early_status;
	}

	public function EmployeeAttendanceIncentiveStatus(){
		$employee_attandance_incentive_status 	= array (9 => 'Not Define', 0 => 'Tidak', 1 => 'Ya');

		return $employee_attandance_incentive_status;
	}	

	public function AppraisalType(){
		$appraisal_type 						= array (9 => 'Not Define', 0 => 'Quantitative', 1 => 'Qualitative');

		return $appraisal_type;
	}						

	public function EmployeeAttendanceOvertimeDayOff(){
		$employee_attandance_overtime_day_off 	= array (9 => 'Not Define', 0 => 'Reguler', 1 => 'Day Off');

		return $employee_attandance_overtime_day_off;
	}		

	public function ShiftNextDay(){
		$shift_next_day 						= array (0 => 'Tidak', 1 => 'Ya');

		return $shift_next_day;
	}							

	public function DeliveryStatus(){
		$delivery_status 						= array (0 => 'Tidak Menginap', 1 => 'Menginap');

		return $delivery_status;
	}	

	public function DeliveryDays(){
		$delivery_days							= array (0 => 'Not Define', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu');

		return $delivery_days;
	}					
	
	
	
	function Unpush($pesan,$key){//$key >= 0 or <=25
		$msg = str_split($pesan);
		$dresult = '';
		for($j=1;$j<=strlen($pesan);$j++){
			if ((ord($msg[$j-1])<65) or (ord($msg[$j-1])>90)){
				$dresult = $dresult.$msg[$j-1];
			} else {
				$ord_msg[$j-1] = 65+fmod(ord($msg[$j-1])+65-$key,26);
				$dresult = $dresult.chr($ord_msg[$j-1]);
			}
		}
		return $dresult;
	}
	
	function convert($msg){
		$division	= bindec("010");
		$lenght		= strlen($msg);
		$div		= $lenght/$division;
		$ret		='';
		$block		='';
		for($i=0;$i<$div;$i++){
			$val	= substr($msg,$i*$division,$division);
			if(substr($val,1,1)=="0"){
				$val = substr($val,0,1);
			}
			$dec 	= hexdec($val);
			if(strlen($dec)==1){
				$bin='00'.$dec;
			}else if(strlen($dec)==2){
				$bin='0'.$dec;
			} else {
				$bin=$dec;
			}
			$block .= $bin;
			if (strlen($block)==6){
				$text = chr(bindec($block));
				$ret	.= $text;
				$block='';
			}
		}
		return $ret;
	}
	
	function Text($plain){
		$division	= bindec("010");
		$lenght		= strlen($plain);
		$div		= $lenght/$division;
		$ret		='';
		$block		='';
		for($i=0;$i<$div;$i++){
			$val	= substr($plain,$i*$division,$division);
			if($val=='00'){
				continue;
			} else {
				$dec 	= hexdec($val);
				if(strlen($dec)==1){
					$bin='00'.$dec;
				}else if(strlen($dec)==2){
					$bin='0'.$dec;
				} else {
					$bin=$dec;
				}
				$ret .= $bin;
			}
		}
		return chr(bindec($ret));
	}
	
	function reassembly($byte){
		$text = '';
		for($i=0;$i<(strlen($byte)/6);$i++){
			$text .= $this->Text(substr($byte,$i*6,6));
		}
		return $text;
	}
	
	function rearrange($text){
		for($i=0;$i<(strlen($text)/2);$i++){
			$arr[$i] = substr($text,$i*2,2);
		}
		$result = implode(":",$arr);
		return $result;
	}
}