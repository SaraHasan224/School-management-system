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
$route['default_controller'] = 'welcome';
$route['404_override'] = 'errors/error_404';
$route['translate_uri_dashes'] = FALSE;

/***********My Routes************ */
$route['AdminLogin'] = 'Login/AdminLogin';
$route['TeacherLogin'] = 'Login/TeacherLogin';
$route['StudentLogin'] = 'Login/StudentLogin';
$route['ParentLogin'] = 'Login/ParentLogin';
$route['admin'] = 'Admin';
$route['InsertSubject'] = 'Admin/InsertSubject';
$route['InsertClass'] = 'Admin/InsertClass';
$route['InsertSchool'] = 'Admin/InsertSchool';
$route['PrimarySchool'] = 'Admin/PrimarySchool';
$route['SecondarySchool'] = 'Admin/SecondarySchool';
$route['ManageSyllabus'] = 'Admin/ManageSyllabus';
$route['ManageHolidays'] = 'Admin/ManageHolidays';
$route['ManageSchedule'] = 'Admin/ManageSchedule';
$route['JobResponsibility'] = 'Admin/JobResponsibility';
$route['Employees'] = 'Admin/Employees';
$route['ManageExams'] = 'Admin/ManageExams';
$route['Recruitment'] = 'Admin/Recruitment';
$route['ManageExams'] = 'Admin/ManageExams';
$route['Shortlisted'] = 'Admin/Shortlisted';
$route['Selected'] = 'Admin/Selected';
$route['HireCandidate/(:any)/(:num)'] = 'Admin/HireCandidate/$1/$2';
$route['InsertStudent'] = 'Admin/InsertStudent';
$route['StudentsList'] = 'Admin/StudentsList';
$route['StudentsActiveList'] = 'Admin/StudentsActiveList';
$route['StudentsInActiveList'] = 'Admin/StudentsInActiveList';
$route['TeachersList'] = 'Admin/TeachersList';
$route['AssignedCourses'] = 'Admin/AssignedCourses';
$route['Profile'] = 'Admin/Profile';
$route['SoftwareSetting'] = 'Admin/SoftwareSetting';
$route['AddPayment'] = 'Admin/AddPayment';
$route['StudentLedger'] = 'Admin/StudentLedger';
$route['StudentLedger/(:any)'] = 'Admin/StudentLedger/$1';
$route['StudentLedger/(:any)/(:num)'] = 'Admin/StudentLedger/$1/$2';
$route['BulkPayment'] = 'Admin/BulkPayment';
$route['BulkPayment/(:any)'] = 'Admin/BulkPayment/$1';
$route['ExportCSVFee'] = 'Admin/ExportCSVFee';
$route['ExportCSVFeeBulk'] = 'Admin/ExportCSVFeeBulk';
$route['Invoice'] = 'Admin/insertinvoice';
$route['InvoiceList'] = 'Admin/invoicelist';
$route['OutStandingList'] = 'Admin/OutStandingList';
$route['OutStandingList/(:any)'] = 'Admin/OutStandingList/$1';
$route['StudentOutstanding/(:num)'] = 'Admin/StudentOutstanding/$1';
$route['ClearAllOutStanding/(:num)'] = 'Admin/ClearAllOutStanding/$1';
$route['ExportCSVOutStandingList'] = 'Admin/ExportCSVOutStandingList';
$route['ExportCSVStudentOutstanding/(:num)'] = 'Admin/ExportCSVStudentOutstanding/$1';
$route['AddUser'] = 'Admin/AddUser';
$route['UserRoles'] = 'Admin/UserRoles';
$route['UsersList'] = 'Admin/UsersList';
$route['AssignmentList'] = 'Admin/AssignmentList';
$route['ClearAssignment'] = 'Admin/ClearAssignment';
$route['StudentResultCheck'] = 'Admin/StudentResultCheck';
$route['ClassStudentResult/(:num)'] = 'Admin/ClassStudentResult/$1';
$route['UploadAssignmentList/(:num)'] = 'Admin/UploadAssignmentList/$1';
$route['StudentReportCard/(:num)/(:num)'] = 'Admin/StudentReportCard/$1/$2';
$route['PromoteAll'] = 'Admin/PromoteAll';
$route['SearchStudent'] = 'Admin/SearchStudent';
$route['ClassStudent'] = 'Admin/ClassStudent';
$route['ClassStudentsList/(:num)'] = 'Admin/ClassStudentsList/$1';
$route['ClassStudentCSV/(:num)'] = 'Admin/ClassStudentCSV/$1';
$route['OutStandingSummary'] = 'Admin/OutStandingSummary';
$route['OutStandingSummary/(:any)'] = 'Admin/OutStandingSummary/$1';
$route['SearchStudentInvoice'] = 'Admin/SearchStudentInvoice';
$route['SearchStudentInvoiceBulk'] = 'Admin/SearchStudentInvoiceBulk';
$route['PrintVouchersMul'] = 'Admin/PrintVouchersMul';
$route['PrintVouchersMul/(:any)'] = 'Admin/PrintVouchersMul/$1';
// $route['Language/(:any)'] = 'Admin/ManageExams/$1';
// $route['Language/(:any)'] = 'Admin/ManageExams/$1';
$route['Logout'] = 'Admin/logout';



/*************Teacher Dashboard start************ */

$route['Teacher'] = 'Teacher';
$route['LogoutTeacher'] = 'Teacher/LogoutTeacher';
$route['CourseList'] = 'Teacher/CourseList';
$route['Syllabus'] = 'Teacher/Syllabus';
$route['Assignment'] = 'Teacher/Assignment';
$route['CheckAssignment/(:num)'] = 'Teacher/CheckAssignment/$1';
$route['Schedule'] = 'Teacher/Schedule';
$route['Exams'] = 'Teacher/Exams';
$route['StudentMarks'] = 'Teacher/StudentMarks';
$route['SetMarks/(:num)/(:num)'] = 'Teacher/SetMarks/$1/$2';
$route['StudentResult'] = 'Teacher/StudentResult';
$route['ResultList/(:num)/(:num)'] = 'Teacher/ResultList/$1/$2';



/*************Student Dashboard start************ */

$route['Student'] = 'Student';
$route['LogoutStudent'] = 'Student/LogoutStudent';
$route['MyCourses'] = 'Student/MyCourses';
$route['MySyllabus'] = 'Student/MySyllabus';
$route['MyAssignment'] = 'Student/MyAssignment';
$route['YearlySchedule'] = 'Student/YearlySchedule';
$route['ExamsTime'] = 'Student/ExamsTime';
$route['SubjectResult'] = 'Student/SubjectResult';
$route['ReportCard'] = 'Student/ReportCard';
$route['ResultList/(:num)/(:num)'] = 'Teacher/ResultList/$1/$2';
