<?php 
class Student extends CI_controller /********** My Student Class Inherit CI main controller */
{/********* Start of Student classs ****/
	function __construct() /************* Constructor **********/
	{/************ Start Of Constructor ********/
        parent:: __construct(); /********** Launch Constructer **********/
        $StudentSession = $this->session->userdata('StudentSession'); /****** Check User Session ********/
        if ($StudentSession == false) { /********* If Session Is not Activated ******/
			return redirect('login');/******** Redirect User To Login*****/
        }/********end of user check condition********/
        $this->load->model('Admindb');/******* Initialize Student Model Database ********/
        /******** Language Get from model**********/
        $this->encryption->initialize(/*********** Initialize encryption *********/
            array(/******start of array***** */
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => '<a 32-character random string>'
            )/******array end for password encryption****** */
        );/********encryption library end********** */
        date_default_timezone_set('Asia/Karachi');
    } /************* End Of Constructor *************/

    /************ Index Home Function *********** */
    public function index()
    { /********* start of index/home function********** */
        // var_dump($this->session->userdata('StudentSession')); die();
        $this->load->view('Student/index'); /********* hit index home screen ********** */
    }/*********end of function index/home******** */

    /************ MyCourses Home Function *********** */
    public function MyCourses()
    { /********* start of MyCourses/home function********** */
        $data['Courses'] = $this->Admindb->TwoJoin(['assigncourses.ClassId'=>$this->session->userdata('StudentSession')->ClassId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','subject','assigncourses.SubjectId = subject.SubjectId','Id','DESC','assigncourses.Id,assigncourses.AssignId,assigncourses.EmployeeId,class.ClassName,assigncourses.ClassId,assigncourses.SubjectId,assigncourses.Day,assigncourses.ClassTimeFrom,assigncourses.ClassTimeTo,assigncourses.IsActive,subject.SubjectName'); /********get all courses******* */
        $this->load->view('Student/Courses',$data); /********* hit MyCourses home screen ********** */
    }/*********end of function MyCourses/home******** */

    /************ MySyllabus Home Function *********** */
    public function MySyllabus()
    { /********* start of MySyllabus/home function********** */
        
        $data['Syllabus'] = $this->Admindb->TwoJoin(['syllabus.Class'=>$this->session->userdata('StudentSession')->ClassId,'syllabus.IsActive'=>true,'syllabus.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'syllabus','subject','syllabus.Subject = subject.SubjectId','class','syllabus.Class = class.ClassId','Id','DESC','syllabus.Id,syllabus.TeacherId,syllabus.SyllabusId,syllabus.Syllabus,syllabus.Class,syllabus.InsertDate,syllabus.IsActive,syllabus.Subject,subject.SubjectName,class.ClassName'); /********get all courses******* */

        $this->load->view('Student/Syllabus',$data); /********* hit Syllabus home screen ********** */
    }/*********end of function Syllabus/home******** */



    /************ MyAssignment Home Function *********** */
    public function MyAssignment()
    { /********* start of MyAssignment/home function********** */

        $data['Assignment'] = $this->Admindb->TwoJoin(['assignment.Class'=>$this->session->userdata('StudentSession')->ClassId,'assignment.IsActive'=>true,'assignment.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assignment','subject','assignment.Subject = subject.SubjectId','class','assignment.Class = class.ClassId','Id','DESC','assignment.Id,assignment.TeacherId,assignment.AssignmentId,assignment.Assignment,assignment.Class,assignment.InsertDate,assignment.IsActive,assignment.Subject,subject.SubjectName,class.ClassName,assignment.Marks,assignment.DueDate'); /********get all courses******* */

        $this->load->view('Student/Assignment',$data); /********* hit Syllabus home screen ********** */
    }/*********end of function Syllabus/home******** */

    public function UploadAssignment(){

                if($this->input->post()){ /*********** Check Field mandetory **********/
                    $checkassignment = $this->Admindb->CheckConditionData(['StudentId'=>$this->session->userdata('StudentSession')->StudentId,'AssignmentId'=>$this->input->post('AssignmentId'),'IsActive'=>true,'IsDeleted'],'uploadassignment');
                    if($checkassignment){
                        echo json_encode(['status'=>false,'message'=>'You Already Submitted this Assignment','data'=>null]);/******send jason data****** */
                        exit;/*******exit here****** */
                    }else{
                        $UploadAssignmentId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random UploadAssignmentId ******/
                    if (!is_dir('./uploads/UploadAssignment/'.$UploadAssignmentId.'')) {/********check if folder not exist******** */
                        mkdir('./uploads/UploadAssignment/'.$UploadAssignmentId.'', 0777, TRUE);/*****create mkdir*******/
                    }/******end of if****** */
                    /*********Configrations to Upload Files *******/
                    $Assignment = [ /********Assignment Config ********/
                        'upload_path' => './uploads/UploadAssignment/'.$UploadAssignmentId.'/',/******** upload path ********/
                        'allowed_types' => '*'/********* allowed types ********/
                    ];/******config end********/
                    /**********Configration End ***********/
                    $this->load->library('upload'); /***** Upload File Library *******/
                    /********upload Assignment ******/
                    $this->upload->initialize($Assignment); /*****Initialize Assignment ****/
                    if ($this->upload->do_upload('Assignment') /***** Upload Assignment ****/) { /***** Check Assignment File Upload *****/
                        $Assignment = $this->upload->data(); /****** push Array ************/
                    }else{/*******else  not uploaded******** */
                        /****** File Validation Run ******/
                        $error = $this->upload->display_errors(); /**********display error ******** */
                        $error = trim($error, "<p></");/********trim errror******* */
                        echo json_encode(['status'=>false,'message'=>'Assignment '.$error,'data'=>null]); /*****send jason********** */
                        $Assignment = $this->upload->data();/*********push value to array******* */
                        exit;/*******exit here******** */
                    }/***** End of DoctorImage file check *****/
                    $AssignmentData = array( /********start of array******* */
                        'UploadAssignmentId' => $UploadAssignmentId,/********Assignment id********** */
                        'StudentId' => $this->session->userdata('StudentSession')->StudentId,/********teacher id******* */
                        'ClassId'=>$this->session->userdata('StudentSession')->ClassId,/********Subject name***********/
                        'AssignmentId'=>$this->input->post('AssignmentId'),/********Class***********/
                        'Assignment'=> base_url('uploads/UploadAssignment/').$UploadAssignmentId."/".$Assignment['raw_name'].$Assignment['file_ext'],/********Company Logo*********/
                        'InsertDate'=>date('Y-m-d'),
                        'IsActive'=>true/********Assignment name********** */
                    );/*********Assignment array******** */
                    $AssignmentInserted = $this->Admindb->InsertData($AssignmentData,'uploadassignment'); /** Database Assignment Inserted **/
                    if ($AssignmentInserted) {/****** Check If Assignment Inserted *****/
                        echo json_encode(['status'=>true,'message'=>'Assignment Insert Successfully','data'=>null]);/******send jason data******* */
                        exit;/*****exit here******* */
                    }else{ /************ If Assignment Not Insreted *********/
                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */
                        exit;/*******exit here****** */
                    }/******inserted condition end*******/
                    }
                    
                }else{/************* Fields Are Mandetory ***********/
                    echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */
                    exit;/*******exit here******* */
                }/*******condition end here******* */
}


    public function YearlySchedule(){
        $data['ScheduleList'] = $this->Admindb->ScheduleList();/*********Event List******** */
        $this->load->view('Student/Schedule',$data);/********hit Schedule view******** */
    }

    public function ExamsTime(){
        $data['ExamsList'] = $this->Admindb->TwoJoin(['examstimetable.IsActive'=>true,'examstimetable.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'examstimetable','subject','examstimetable.SubjectId = subject.SubjectId','class','examstimetable.ClassId = class.ClassId','Id','ASC','examstimetable.Id,examstimetable.ExamId,examstimetable.ExamDate,examstimetable.ExamTime,subject.SubjectName,class.ClassName');/*********Event List******** */
            
        $this->load->view('Student/Exams',$data);/********hit Exams view******** */
    }

    public function SubjectResult(){
        // $data['Students'] = $this->Admindb->getdata(['ClassId'=>$param,'SubjectId'=>$param2,'TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','Id','DESC');
        $data['Students'] = $this->Admindb->SimpleJoin(['studentmarks.StudentId'=>$this->session->userdata('StudentSession')->StudentId,'studentmarks.ClassId'=>$this->session->userdata('StudentSession')->ClassId,'studentmarks.IsActive'=>true,'studentmarks.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'studentmarks','subject','studentmarks.SubjectId = subject.SubjectId','Id','DESC','studentmarks.Id,studentmarks.MarksId,studentmarks.StudentId,studentmarks.TeacherId,studentmarks.SubjectId,studentmarks.ClassId,studentmarks.FirstExam,studentmarks.SecondExam,studentmarks.ThirdExam,studentmarks.ExtraActivityMarks,studentmarks.InsertDate,studentmarks.Year,studentmarks.Remarks,subject.SubjectName,studentmarks.Grade');
        $this->load->view('Student/ResultList',$data); /********* hit StudentMarks home screen ********** */
    }

    public function ViewAssignment(){
        
        $getdata = $this->Admindb->SingleRowField(['AssignmentId'=>$this->input->post('AssignmentId'),'StudentId'=>$this->session->userdata('StudentSession')->StudentId,'IsActive'=>true,'IsDeleted'=>false],'uploadassignment','Marks');

        if($getdata){
            echo json_encode(['status'=>true,'message'=>'Marks Found','data'=>$getdata]);/******send jason data****** */
            exit;/*******exit here****** */
        }else{
            echo json_encode(['status'=>false,'message'=>'No Marks Found','data'=>null]);/******send jason data****** */
            exit;/*******exit here****** */
        }
    }

    public function ReportCard(){
        
        $data['Subjects'] = $this->Admindb->getdata(['ClassId'=>$this->session->userdata('StudentSession')->ClassId,'IsActive'=>true,'IsDeleted'=>false],'subject','Id','DESC'); /********get all class********* */
        $data['Class'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********get all class********* */
        $data['StudentId'] = $this->session->userdata('StudentSession')->StudentId;
        $data['ClassId'] = $this->session->userdata('StudentSession')->ClassId;
        // var_dump($data['ReportCard']); die();
        $this->load->view('Student/ReportCard',$data); /********* hit StudentResult home screen ********** */
     }

    /**************Logout function**************/
	public function LogoutStudent()
	{/*********logout function start******* */
        $StudentSession = $this->session->userdata('StudentSession');/*********user data session******** */
        $UpdateLogin = $this->Admindb->UpdateData1(['SessionId'=>$StudentSession->SessionId],['LogoutDate'=>date('Y-m-d'),'LogoutTime'=>date('h:m:s'),'IsActive'=>false],'teacherloginlogs');/*******update login***** */
		$this->session->unset_userdata('StudentSession');/*********unset session******** */
		return redirect('StudentLogin');/********redirect to login******* */
    }/********logout function******** */
}
?>