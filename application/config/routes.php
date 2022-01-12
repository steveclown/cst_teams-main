<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'MainPage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*======================================  Recruitment ======================================== */

/* CORE Recruitment */
$route['recruitment-applicant-data'] 			                    = 'RecruitmentApplicantData';
$route['recruitment-applicant-data/add'] 			                = 'RecruitmentApplicantData/addRecruitmentApplicantData';
$route['recruitment-applicant-data/elements-add'] 	                = 'RecruitmentApplicantData/function_elements_add';
$route['recruitment-applicant-data/reset-add'] 	                    = 'RecruitmentApplicantData/reset_add';
$route['recruitment-applicant-data/process-add'] 	                = 'RecruitmentApplicantData/processAddRecruitmentApplicantData';
$route['recruitment-applicant-data/edit/(:num)']	                = 'RecruitmentApplicantData/editRecruitmentApplicantData/$1';
$route['recruitment-applicant-data/delete/(:num)']	                = 'RecruitmentApplicantData/deleteRecruitmentApplicantData/$1';
$route['recruitment-applicant-data/process-edit'] 	                = 'RecruitmentApplicantData/processEditRecruitmentApplicantData';
$route['recruitment-applicant-data/reset-edit/(:num)'] 	            = 'RecruitmentApplicantData/reset_edit/$1';

/*======================================  Organization ======================================== */

/* CORE Region */
$route['region'] 			                    = 'CoreRegion';
$route['region/add'] 			                = 'CoreRegion/addCoreRegion';
$route['region/elements-add'] 	                = 'CoreRegion/function_elements_add';
$route['region/reset-add'] 	                    = 'CoreRegion/reset_add';
$route['region/process-add'] 	                = 'CoreRegion/processAddCoreRegion';
$route['region/edit/(:num)']	                = 'CoreRegion/editCoreRegion/$1';
$route['region/delete/(:num)']	                = 'CoreRegion/deleteCoreRegion/$1';
$route['region/process-edit'] 	                = 'CoreRegion/processEditCoreRegion';
$route['region/reset-edit/(:num)'] 	            = 'CoreRegion/reset_edit/$1';

/* CORE Branch */
$route['branch']		                        = 'CoreBranch';
$route['branch/add'] 			                = 'CoreBranch/addCoreBranch';
$route['branch/elements-add'] 	                = 'CoreBranch/function_elements_add';
$route['branch/reset-add'] 	                    = 'CoreBranch/reset_add';
$route['branch/process-add'] 	                = 'CoreBranch/processAddCoreBranch';
$route['branch/edit/(:num)']	                = 'CoreBranch/editCoreBranch/$1';
$route['branch/delete/(:num)']	                = 'CoreBranch/deleteCoreBranch/$1';
$route['branch/process-edit'] 	                = 'CoreBranch/processEditCoreBranch';
$route['branch/reset-edit/(:num)'] 	            = 'CoreBranch/reset_edit/$1';

/* CORE Location */
$route['location']		                        = 'CoreLocation';
$route['location/add'] 			                = 'CoreLocation/addCoreLocation';
$route['location/elements-add'] 	            = 'CoreLocation/function_elements_add';
$route['location/reset-add'] 	                = 'CoreLocation/reset_add';
$route['location/process-add'] 	                = 'CoreLocation/processAddCoreLocation';
$route['location/edit/(:num)']	                = 'CoreLocation/editCoreLocation/$1';
$route['location/delete/(:num)']	            = 'CoreLocation/deleteCoreLocation/$1';
$route['location/process-edit'] 	            = 'CoreLocation/processEditCoreLocation';
$route['location/reset-edit/(:num)'] 	        = 'CoreLocation/reset_edit/$1';

/* CORE Company */
$route['company']		                        = 'CoreCompany';
$route['company/add'] 			                = 'CoreCompany/addCoreCompany';
$route['company/elements-add'] 	                = 'CoreCompany/function_elements_add';
$route['company/reset-add'] 	                    = 'CoreCompany/reset_add';
$route['company/process-add'] 	                = 'CoreCompany/processAddCoreCompany';
$route['company/edit/(:num)']	                = 'CoreCompany/editCoreCompany/$1';
$route['company/delete/(:num)']	                = 'CoreCompany/deleteCoreCompany/$1';
$route['company/process-edit'] 	                = 'CoreCompany/processEditCoreCompany';
$route['company/reset-edit/(:num)'] 	            = 'CoreCompany/reset_edit/$1';

/* CORE Division */
$route['division']		                        = 'CoreDivision';
$route['division/add'] 			                = 'CoreDivision/addCoreDivision';
$route['division/elements-add'] 	            = 'CoreDivision/function_elements_add';
$route['division/reset-add'] 	                = 'CoreDivision/reset_add';
$route['division/process-add'] 	                = 'CoreDivision/processAddCoreDivision';
$route['division/edit/(:num)']	                = 'CoreDivision/editCoreDivision/$1';
$route['division/delete/(:num)']	            = 'CoreDivision/deleteCoreDivision/$1';
$route['division/process-edit'] 	            = 'CoreDivision/processEditCoreDivision';
$route['division/reset-edit/(:num)'] 	        = 'CoreDivision/reset_edit/$1';

/* CORE Department */
$route['department']		                    = 'CoreDepartment';
$route['department/add']                        = 'CoreDepartment/addCoreDepartment';
$route['department/elements-add'] 	            = 'CoreDepartment/function_elements_add';
$route['department/reset-add'] 	                = 'CoreDepartment/reset_add';
$route['department/process-add'] 	            = 'CoreDepartment/processAddCoreDepartment';
$route['department/edit/(:num)']	            = 'CoreDepartment/editCoreDepartment/$1';
$route['department/delete/(:num)']	            = 'CoreDepartment/deleteCoreDepartment/$1';
$route['department/process-edit'] 	            = 'CoreDepartment/processEditCoreDepartment';
$route['department/reset-edit/(:num)'] 	        = 'CoreDepartment/reset_edit/$1';

/* CORE Section */
$route['section']		                        = 'CoreSection';
$route['section/add'] 			                = 'CoreSection/addCoreSection';
$route['section/elements-add'] 	                = 'CoreSection/function_elements_add';
$route['section/reset-add'] 	                = 'CoreSection/reset_add';
$route['section/process-add'] 	                = 'CoreSection/processAddCoreSection';
$route['section/edit/(:num)']	                = 'CoreSection/editCoreSection/$1';
$route['section/delete/(:num)']	                = 'CoreSection/deleteCoreSection/$1';
$route['section/process-edit'] 	                = 'CoreSection/processEditCoreSection';
$route['section/reset-edit/(:num)'] 	        = 'CoreSection/reset_edit/$1';

/* CORE JobTitle */
$route['jobtitle']		                        = 'CoreJobTitle';
$route['jobtitle/add'] 			                = 'CoreJobTitle/addCoreJobTitle';
$route['jobtitle/elements-add'] 	            = 'CoreJobTitle/function_elements_add';
$route['jobtitle/reset-add'] 	                = 'CoreJobTitle/reset_add';
$route['jobtitle/process-add'] 	                = 'CoreJobTitle/processAddCoreJobTitle';
$route['jobtitle/edit/(:num)']	                = 'CoreJobTitle/editCoreJobTitle/$1';
$route['jobtitle/delete/(:num)']	            = 'CoreJobTitle/deleteCoreJobTitle/$1';
$route['jobtitle/process-edit'] 	            = 'CoreJobTitle/processEditCoreJobTitle';
$route['jobtitle/reset-edit/(:num)'] 	        = 'CoreJobTitle/reset_edit/$1';

/* CORE Grade */
$route['grade']		                            = 'CoreGrade';
$route['grade/add'] 			                = 'CoreGrade/addCoreGrade';
$route['grade/elements-add'] 	                = 'CoreGrade/function_elements_add';
$route['grade/reset-add'] 	                    = 'CoreGrade/reset_add';
$route['grade/process-add'] 	                = 'CoreGrade/processAddCoreGrade';
$route['grade/edit/(:num)']	                    = 'CoreGrade/editCoreGrade/$1';
$route['grade/delete/(:num)']	                = 'CoreGrade/deleteCoreGrade/$1';
$route['grade/process-edit'] 	                = 'CoreGrade/processEditCoreGrade';
$route['grade/reset-edit/(:num)'] 	            = 'CoreGrade/reset_edit/$1';

/* CORE Class */
$route['class']		                            = 'CoreClass';
$route['class/add'] 			                = 'CoreClass/addCoreClass';
$route['class/elements-add'] 	                = 'CoreClass/function_elements_add';
$route['class/reset-add'] 	                    = 'CoreClass/reset_add';
$route['class/process-add'] 	                = 'CoreClass/processAddCoreClass';
$route['class/edit/(:num)']	                    = 'CoreClass/editCoreClass/$1';
$route['class/delete/(:num)']	                = 'CoreClass/deleteCoreClass/$1';
$route['class/process-edit'] 	                = 'CoreClass/processEditCoreClass';
$route['class/reset-edit/(:num)'] 	            = 'CoreClass/reset_edit/$1';

/* CORE Unit */
$route['unit']		                            = 'CoreUnit';
$route['unit/add'] 			                    = 'CoreUnit/addCoreUnit';
$route['unit/elements-add'] 	                = 'CoreUnit/function_elements_add';
$route['unit/reset-add'] 	                    = 'CoreUnit/reset_add';
$route['unit/process-add'] 	                    = 'CoreUnit/processAddCoreUnit';
$route['unit/edit/(:num)']	                    = 'CoreUnit/editCoreUnit/$1';
$route['unit/delete/(:num)']	                = 'CoreUnit/deleteCoreUnit/$1';
$route['unit/process-edit'] 	                = 'CoreUnit/processEditCoreUnit';
$route['unit/reset-edit/(:num)'] 	            = 'CoreUnit/reset_edit/$1';


/*===============================  Education and Expertise ================================== */

/* CORE Language */
$route['language']		                        = 'CoreLanguage';
$route['language/add'] 			                = 'CoreLanguage/addCoreLanguage';
$route['language/elements-add'] 	            = 'CoreLanguage/function_elements_add';
$route['language/reset-add'] 	                = 'CoreLanguage/reset_add';
$route['language/process-add'] 	                = 'CoreLanguage/processAddCoreLanguage';
$route['language/edit/(:num)']	                = 'CoreLanguage/editCoreLanguage/$1';
$route['language/delete/(:num)']	            = 'CoreLanguage/deleteCoreLanguage/$1';
$route['language/process-edit'] 	            = 'CoreLanguage/processEditCoreLanguage';
$route['language/reset-edit/(:num)'] 	        = 'CoreLanguage/reset_edit/$1';

/* CORE Education */
$route['education']		                        = 'CoreEducation';
$route['education/add'] 			            = 'CoreEducation/addCoreEducation';
$route['education/elements-add'] 	            = 'CoreEducation/function_elements_add';
$route['education/reset-add'] 	                = 'CoreEducation/reset_add';
$route['education/process-add'] 	            = 'CoreEducation/processAddCoreEducation';
$route['education/edit/(:num)']	                = 'CoreEducation/editCoreEducation/$1';
$route['education/delete/(:num)']	            = 'CoreEducation/deleteCoreEducation/$1';
$route['education/process-edit'] 	            = 'CoreEducation/processEditCoreEducation';
$route['education/reset-edit/(:num)'] 	        = 'CoreEducation/reset_edit/$1';

/* CORE Expertise */
$route['expertise']		                        = 'CoreExpertise';
$route['expertise/add'] 			            = 'CoreExpertise/addCoreExpertise';
$route['expertise/elements-add'] 	            = 'CoreExpertise/function_elements_add';
$route['expertise/reset-add'] 	                = 'CoreExpertise/reset_add';
$route['expertise/process-add'] 	            = 'CoreExpertise/processAddCoreExpertise';
$route['expertise/edit/(:num)']	                = 'CoreExpertise/editCoreExpertise/$1';
$route['expertise/delete/(:num)']	            = 'CoreExpertise/deleteCoreExpertise/$1';
$route['expertise/process-edit'] 	            = 'CoreExpertise/processEditCoreExpertise';
$route['expertise/reset-edit/(:num)'] 	        = 'CoreExpertise/reset_edit/$1';

/*=====================================  Award & Warning ======================================== */

/* CORE Award */
$route['award']		                            = 'CoreAward';
$route['award/add'] 			                = 'CoreAward/addCoreAward';
$route['award/elements-add'] 	                = 'CoreAward/function_elements_add';
$route['award/reset-add'] 	                    = 'CoreAward/reset_add';
$route['award/process-add'] 	                = 'CoreAward/processAddCoreAward';
$route['award/edit/(:num)']	                    = 'CoreAward/editCoreAward/$1';
$route['award/delete/(:num)']	                = 'CoreAward/deleteCoreAward/$1';
$route['award/process-edit'] 	                = 'CoreAward/processEditCoreAward';
$route['award/reset-edit/(:num)'] 	            = 'CoreAward/reset_edit/$1';

/* CORE Warning */
$route['warning']		                        = 'CoreWarning';
$route['warning/add'] 			                = 'CoreWarning/addCoreWarning';
$route['warning/elements-add'] 	                = 'CoreWarning/function_elements_add';
$route['warning/reset-add'] 	                = 'CoreWarning/reset_add';
$route['warning/process-add'] 	                = 'CoreWarning/processAddCoreWarning';
$route['warning/edit/(:num)']	                = 'CoreWarning/editCoreWarning/$1';
$route['warning/delete/(:num)']	                = 'CoreWarning/deleteCoreWarning/$1';
$route['warning/process-edit'] 	                = 'CoreWarning/processEditCoreWarning';
$route['warning/reset-edit/(:num)'] 	        = 'CoreWarning/reset_edit/$1';

/*=========================================  Leave  ======================================== */

/* CORE AnnualLeave */
$route['annual-leave']		                    = 'CoreAnnualLeave';
$route['annual-leave/add'] 			            = 'CoreAnnualLeave/addCoreAnnualLeave';
$route['annual-leave/elements-add'] 	        = 'CoreAnnualLeave/function_elements_add';
$route['annual-leave/reset-add'] 	            = 'CoreAnnualLeave/reset_add';
$route['annual-leave/process-add'] 	            = 'CoreAnnualLeave/processAddCoreAnnualLeave';
$route['annual-leave/edit/(:num)']	            = 'CoreAnnualLeave/editCoreAnnualLeave/$1';
$route['annual-leave/delete/(:num)']	        = 'CoreAnnualLeave/deleteCoreAnnualLeave/$1';
$route['annual-leave/process-edit'] 	        = 'CoreAnnualLeave/processEditCoreAnnualLeave';
$route['annual-leave/reset-edit/(:num)'] 	    = 'CoreAnnualLeave/reset_edit/$1';

/* CORE Extraleave */
$route['extra-leave']		                    = 'CoreExtraleave';
$route['extra-leave/add'] 			            = 'CoreExtraleave/addCoreExtraleave';
$route['extra-leave/elements-add'] 	            = 'CoreExtraleave/function_elements_add';
$route['extra-leave/reset-add'] 	            = 'CoreExtraleave/reset_add';
$route['extra-leave/process-add'] 	            = 'CoreExtraleave/processAddCoreExtraleave';
$route['extra-leave/edit/(:num)']	            = 'CoreExtraleave/editCoreExtraleave/$1';
$route['extra-leave/delete/(:num)']	            = 'CoreExtraleave/deleteCoreExtraleave/$1';
$route['extra-leave/process-edit'] 	            = 'CoreExtraleave/processEditCoreExtraleave';
$route['extra-leave/reset-edit/(:num)'] 	    = 'CoreExtraleave/reset_edit/$1';


/*=========================================  Overtime  ======================================== */

/* CORE OvertimeType */
$route['overtime-type']		                    = 'CoreOvertimeType';
$route['overtime-type/add'] 			        = 'CoreOvertimeType/addCoreOvertimeType';
$route['overtime-type/elements-add'] 	        = 'CoreOvertimeType/function_elements_add';
$route['overtime-type/reset-add'] 	            = 'CoreOvertimeType/reset_add';
$route['overtime-type/process-add'] 	        = 'CoreOvertimeType/processAddCoreOvertimeType';
$route['overtime-type/edit/(:num)']	            = 'CoreOvertimeType/editCoreOvertimeType/$1';
$route['overtime-type/delete/(:num)']	        = 'CoreOvertimeType/deleteCoreOvertimeType/$1';
$route['overtime-type/process-edit'] 	        = 'CoreOvertimeType/processEditCoreOvertimeType';
$route['overtime-type/reset-edit/(:num)'] 	    = 'CoreOvertimeType/reset_edit/$1';


/*=========================================  Late - Permit  ======================================== */

/* CORE Late */
$route['late']		                            = 'CoreLate';
$route['late/add'] 			                    = 'CoreLate/addCoreLate';
$route['late/elements-add'] 	                = 'CoreLate/function_elements_add';
$route['late/reset-add'] 	                    = 'CoreLate/reset_add';
$route['late/process-add'] 	                    = 'CoreLate/processAddCoreLate';
$route['late/edit/(:num)']	                    = 'CoreLate/editCoreLate/$1';
$route['late/delete/(:num)']	                = 'CoreLate/deleteCoreLate/$1';
$route['late/process-edit'] 	                = 'CoreLate/processEditCoreLate';
$route['late/reset-edit/(:num)'] 	            = 'CoreLate/reset_edit/$1';

/* CORE Permit */
$route['permit']		                        = 'CorePermit';
$route['permit/add'] 			                = 'CorePermit/addCorePermit';
$route['permit/elements-add'] 	                = 'CorePermit/function_elements_add';
$route['permit/reset-add'] 	                    = 'CorePermit/reset_add';
$route['permit/process-add'] 	                = 'CorePermit/processAddCorePermit';
$route['permit/edit/(:num)']	                = 'CorePermit/editCorePermit/$1';
$route['permit/delete/(:num)']	                = 'CorePermit/deleteCorePermit/$1';
$route['permit/process-edit'] 	                = 'CorePermit/processEditCorePermit';
$route['permit/reset-edit/(:num)'] 	            = 'CorePermit/reset_edit/$1';

/* CORE DayOff */
$route['day-off']		                        = 'CoreDayOff';
$route['day-off/add'] 			                = 'CoreDayOff/addCoreDayOff';
$route['day-off/elements-add'] 	                = 'CoreDayOff/function_elements_add';
$route['day-off/reset-add'] 	                    = 'CoreDayOff/reset_add';
$route['day-off/process-add'] 	                = 'CoreDayOff/processAddCoreDayOff';
$route['day-off/edit/(:num)']	                = 'CoreDayOff/editCoreDayOff/$1';
$route['day-off/delete/(:num)']	                = 'CoreDayOff/deleteCoreDayOff/$1';
$route['day-off/process-edit'] 	                = 'CoreDayOff/processEditCoreDayOff';
$route['day-off/reset-edit/(:num)'] 	            = 'CoreDayOff/reset_edit/$1';

/* CORE Absence */
$route['absence']		                        = 'CoreAbsence';
$route['absence/add'] 			                = 'CoreAbsence/addCoreAbsence';
$route['absence/elements-add'] 	                = 'CoreAbsence/function_elements_add';
$route['absence/reset-add'] 	                = 'CoreAbsence/reset_add';
$route['absence/process-add'] 	                = 'CoreAbsence/processAddCoreAbsence';
$route['absence/edit/(:num)']	                = 'CoreAbsence/editCoreAbsence/$1';
$route['absence/delete/(:num)']	                = 'CoreAbsence/deleteCoreAbsence/$1';
$route['absence/process-edit'] 	                = 'CoreAbsence/processEditCoreAbsence';
$route['absence/reset-edit/(:num)'] 	        = 'CoreAbsence/reset_edit/$1';

/* CORE HomeEarly */
$route['home-early']		                        = 'CoreHomeEarly';
$route['home-early/add'] 			            = 'CoreHomeEarly/addCoreHomeEarly';
$route['home-early/elements-add'] 	            = 'CoreHomeEarly/function_elements_add';
$route['home-early/reset-add'] 	                = 'CoreHomeEarly/reset_add';
$route['home-early/process-add'] 	            = 'CoreHomeEarly/processAddCoreHomeEarly';
$route['home-early/edit/(:num)']	                = 'CoreHomeEarly/editCoreHomeEarly/$1';
$route['home-early/delete/(:num)']	            = 'CoreHomeEarly/deleteCoreHomeEarly/$1';
$route['home-early/process-edit'] 	            = 'CoreHomeEarly/processEditCoreHomeEarly';
$route['home-early/reset-edit/(:num)'] 	        = 'CoreHomeEarly/reset_edit/$1';

/*=========================================  Marital Status  ======================================== */

/* CORE MaritalStatus */
$route['marital-status']		                    = 'CoreMaritalStatus';
$route['marital-status/add'] 			        = 'CoreMaritalStatus/addCoreMaritalStatus';
$route['marital-status/elements-add'] 	        = 'CoreMaritalStatus/function_elements_add';
$route['marital-status/reset-add'] 	            = 'CoreMaritalStatus/reset_add';
$route['marital-status/process-add'] 	        = 'CoreMaritalStatus/processAddCoreMaritalStatus';
$route['marital-status/edit/(:num)']	            = 'CoreMaritalStatus/editCoreMaritalStatus/$1';
$route['marital-status/delete/(:num)']	        = 'CoreMaritalStatus/deleteCoreMaritalStatus/$1';
$route['marital-status/process-edit'] 	        = 'CoreMaritalStatus/processEditCoreMaritalStatus';
$route['marital-status/reset-edit/(:num)'] 	    = 'CoreMaritalStatus/reset_edit/$1';

/*=========================================  Separation Reason  ======================================== */

/* CORE SeparationReason */
$route['separation-reason']		                = 'CoreSeparationReason';
$route['separation-reason/add'] 			        = 'CoreSeparationReason/addCoreSeparationReason';
$route['separation-reason/elements-add'] 	    = 'CoreSeparationReason/function_elements_add';
$route['separation-reason/reset-add'] 	        = 'CoreSeparationReason/reset_add';
$route['separation-reason/process-add'] 	        = 'CoreSeparationReason/processAddCoreSeparationReason';
$route['separation-reason/edit/(:num)']	        = 'CoreSeparationReason/editCoreSeparationReason/$1';
$route['separation-reason/delete/(:num)']	    = 'CoreSeparationReason/deleteCoreSeparationReason/$1';
$route['separation-reason/process-edit'] 	    = 'CoreSeparationReason/processEditCoreSeparationReason';
$route['separation-reason/reset-edit/(:num)'] 	= 'CoreSeparationReason/reset_edit/$1';

/*=========================================  HRO Employee  ======================================== */

/* HRO EmployeeData */
$route['hroemployeedata']		                = 'HroEmployeeData';
$route['hroemployeedata/add'] 			        = 'HroEmployeeData/addHroEmployeeData';
$route['hroemployeedata/elements-add'] 	        = 'HroEmployeeData/function_elements_add';
$route['hroemployeedata/reset-add'] 	        = 'HroEmployeeData/reset_add';
$route['hroemployeedata/process-add'] 	        = 'HroEmployeeData/processAddHroEmployeeData';
$route['hroemployeedata/edit/(:num)']	        = 'HroEmployeeData/editHroEmployeeData/$1';
$route['hroemployeedata/delete/(:num)']	        = 'HroEmployeeData/deleteHroEmployeeData/$1';
$route['hroemployeedata/process-edit'] 	        = 'HroEmployeeData/processEditHroEmployeeData';
$route['hroemployeedata/reset-edit/(:num)'] 	= 'HroEmployeeData/reset_edit/$1';

/* HRO EmployeeEmployment */
$route['hroemployeeemployment']		                    = 'HroEmployeeEmployment';
$route['hroemployeeemployment/add'] 			        = 'HroEmployeeEmployment/addHroEmployeeEmployment';
$route['hroemployeeemployment/elements-add'] 	        = 'HroEmployeeEmployment/function_elements_add';
$route['hroemployeeemployment/reset-add'] 	            = 'HroEmployeeEmployment/reset_add';
$route['hroemployeeemployment/process-add'] 	        = 'HroEmployeeEmployment/processAddHroEmployeeEmployment';
$route['hroemployeeemployment/edit/(:num)']	            = 'HroEmployeeEmployment/editHroEmployeeEmployment/$1';
$route['hroemployeeemployment/delete/(:num)']	        = 'HroEmployeeEmployment/deleteHroEmployeeEmployment/$1';
$route['hroemployeeemployment/process-edit'] 	        = 'HroEmployeeEmployment/processEditHroEmployeeEmployment';
$route['hroemployeeemployment/reset-edit/(:num)'] 	    = 'HroEmployeeEmployment/reset_edit/$1';

/* HRO EmployeeStatusAlteration */
$route['hroemployeestatusalteration']		            = 'HroEmployeeStatusAlteration';
$route['hroemployeestatusalteration/add'] 			    = 'HroEmployeeStatusAlteration/addHroEmployeeStatusAlteration';
$route['hroemployeestatusalteration/elements-add'] 	    = 'HroEmployeeStatusAlteration/function_elements_add';
$route['hroemployeestatusalteration/reset-add'] 	    = 'HroEmployeeStatusAlteration/reset_add';
$route['hroemployeestatusalteration/process-add'] 	    = 'HroEmployeeStatusAlteration/processAddHroEmployeeStatusAlteration';
$route['hroemployeestatusalteration/edit/(:num)']	    = 'HroEmployeeStatusAlteration/editHroEmployeeStatusAlteration/$1';
$route['hroemployeestatusalteration/delete/(:num)']	    = 'HroEmployeeStatusAlteration/deleteHroEmployeeStatusAlteration/$1';
$route['hroemployeestatusalteration/process-edit'] 	    = 'HroEmployeeStatusAlteration/processEditHroEmployeeStatusAlteration';
$route['hroemployeestatusalteration/reset-edit/(:num)'] = 'HroEmployeeStatusAlteration/reset_edit/$1';

/* HRO EmployeeTransfer */
$route['hroemployeetransfer']		                    = 'HroEmployeeTransfer';
$route['hroemployeetransfer/add'] 			            = 'HroEmployeeTransfer/addHroEmployeeTransfer';
$route['hroemployeetransfer/elements-add'] 	            = 'HroEmployeeTransfer/function_elements_add';
$route['hroemployeetransfer/reset-add'] 	            = 'HroEmployeeTransfer/reset_add';
$route['hroemployeetransfer/process-add'] 	            = 'HroEmployeeTransfer/processAddHroEmployeeTransfer';
$route['hroemployeetransfer/edit/(:num)']	            = 'HroEmployeeTransfer/editHroEmployeeTransfer/$1';
$route['hroemployeetransfer/delete/(:num)']	            = 'HroEmployeeTransfer/deleteHroEmployeeTransfer/$1';
$route['hroemployeetransfer/process-edit'] 	            = 'HroEmployeeTransfer/processEditHroEmployeeTransfer';
$route['hroemployeetransfer/reset-edit/(:num)'] 	    = 'HroEmployeeTransfer/reset_edit/$1';

/*=========================================  Payroll Allowance & Deduction  ======================================== */

/* CORE Allowance */
$route['allowance']		                                = 'CoreAllowance';
$route['allowance/add'] 			                    = 'CoreAllowance/addCoreAllowance';
$route['allowance/elements-add'] 	                    = 'CoreAllowance/function_elements_add';
$route['allowance/reset-add'] 	                        = 'CoreAllowance/reset_add';
$route['allowance/process-add'] 	                    = 'CoreAllowance/processAddCoreAllowance';
$route['allowance/edit/(:num)']	                        = 'CoreAllowance/editCoreAllowance/$1';
$route['allowance/delete/(:num)']	                    = 'CoreAllowance/deleteCoreAllowance/$1';
$route['allowance/process-edit'] 	                    = 'CoreAllowance/processEditCoreAllowance';
$route['allowance/reset-edit/(:num)'] 	                = 'CoreAllowance/reset_edit/$1';

/* CORE Deduction */
$route['deduction']		                                = 'CoreDeduction';
$route['deduction/add'] 			                    = 'CoreDeduction/addCoreDeduction';
$route['deduction/elements-add'] 	                    = 'CoreDeduction/function_elements_add';
$route['deduction/reset-add'] 	                        = 'CoreDeduction/reset_add';
$route['deduction/process-add'] 	                    = 'CoreDeduction/processAddCoreDeduction';
$route['deduction/edit/(:num)']	                        = 'CoreDeduction/editCoreDeduction/$1';
$route['deduction/delete/(:num)']	                    = 'CoreDeduction/deleteCoreDeduction/$1';
$route['deduction/process-edit'] 	                    = 'CoreDeduction/processEditCoreDeduction';
$route['deduction/reset-edit/(:num)'] 	                = 'CoreDeduction/reset_edit/$1';