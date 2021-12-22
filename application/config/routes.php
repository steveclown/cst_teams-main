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


