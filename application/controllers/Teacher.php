<?php 
class Teacher extends CI_controller /********** My Teacher Class Inherit CI main controller */
{/********* Start of Teacher classs ****/
	function __construct() /************* Constructor **********/
	{/************ Start Of Constructor ********/
        parent:: __construct(); /********** Launch Constructer **********/
        $TeacherSession = $this->session->userdata('TeacherSession'); /****** Check User Session ********/
        if ($TeacherSession == false) { /********* If Session Is not Activated ******/
			return redirect('login');/******** Redirect User To Login*****/
        }/********end of user check condition********/
        $this->load->model('Admindb');/******* Initialize Teacher Model Database ********/
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
        // var_dump($this->session->userdata('TeacherSession')); die();
        $this->load->view('Teacher/index'); /********* hit index home screen ********** */
    }/*********end of function index/home******** */

    /************ CourseList Home Function *********** */
    public function CourseList()
    { /********* start of CourseList/home function********** */
        $data['Courses'] = $this->Admindb->TwoJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','subject','assigncourses.SubjectId = subject.SubjectId','Id','DESC','assigncourses.Id,assigncourses.AssignId,assigncourses.EmployeeId,class.ClassName,assigncourses.ClassId,assigncourses.SubjectId,assigncourses.Day,assigncourses.ClassTimeFrom,assigncourses.ClassTimeTo,assigncourses.IsActive,subject.SubjectName'); /********get all courses******* */
        $this->load->view('Teacher/Courses',$data); /********* hit CourseList home screen ********** */
    }/*********end of function CourseList/home******** */

    /************ Syllabus Home Function *********** */
    public function Syllabus()
    { /********* start of Syllabus/home function********** */
        $data['ClassList'] = $this->Admindb->SimpleJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','assigncourses.Id','DESC','class.ClassId,class.ClassName');

        $data['Syllabus'] = $this->Admindb->TwoJoin(['syllabus.TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'syllabus.IsActive'=>true,'syllabus.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'syllabus','subject','syllabus.Subject = subject.SubjectId','class','syllabus.Class = class.ClassId','Id','DESC','syllabus.Id,syllabus.TeacherId,syllabus.SyllabusId,syllabus.Syllabus,syllabus.Class,syllabus.InsertDate,syllabus.IsActive,syllabus.Subject,subject.SubjectName,class.ClassName'); /********get all courses******* */

        $this->load->view('Teacher/Syllabus',$data); /********* hit Syllabus home screen ********** */
    }/*********end of function Syllabus/home******** */

    public function EnableSubject($param=""){
            if($param=="Enable"){
                $Class = $this->input->post('ClassId');/********data field******* */

                $Subjects = $this->Admindb->SimpleJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.ClassId'=>$Class,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','subject','assigncourses.SubjectId = subject.SubjectId','assigncourses.Id','DESC','subject.SubjectId,subject.SubjectName');/**********get data*********** */
                echo json_encode(['status'=>true,'message'=>'Subject Founds','data'=>$Subjects]);/*******send jason data******* */
                exit;/******exit here******* */
            }elseif($param == 'Insert') { /**********if param is upload************ */
                    if($this->input->post()){ /*********** Check Field mandetory **********/
                        $SyllabusId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random SyllabusId ******/
                        if (!is_dir('./uploads/Syllabus/'.$SyllabusId.'')) {/********check if folder not exist******** */
                            mkdir('./uploads/Syllabus/'.$SyllabusId.'', 0777, TRUE);/*****create mkdir*******/
                        }/******end of if****** */
                        /*********Configrations to Upload Files *******/
                        $Syllabus = [ /********Syllabus Config ********/
                            'upload_path' => './uploads/Syllabus/'.$SyllabusId.'/',/******** upload path ********/
                            'allowed_types' => 'pdf|docx'/********* allowed types ********/
                        ];/******config end********/
                        /**********Configration End ***********/
                        $this->load->library('upload'); /***** Upload File Library *******/
                        /********upload Syllabus ******/
                        $this->upload->initialize($Syllabus); /*****Initialize Syllabus ****/
                        if ($this->upload->do_upload('Syllabus') /***** Upload Syllabus ****/) { /***** Check Syllabus File Upload *****/
                            $Syllabus = $this->upload->data(); /****** push Array ************/
                        }else{/*******else  not uploaded******** */
                            /****** File Validation Run ******/
                            $error = $this->upload->display_errors(); /**********display error ******** */
                            $error = trim($error, "<p></");/********trim errror******* */
                            echo json_encode(['status'=>false,'message'=>'Syllabus '.$error,'data'=>null]); /*****send jason********** */
                            $Syllabus = $this->upload->data();/*********push value to array******* */
                            exit;/*******exit here******** */
                        }/***** End of DoctorImage file check *****/
                        $SyllabusData = array( /********start of array******* */
                            'SyllabusId' => $SyllabusId,/********Syllabus id********** */
                            'TeacherId' => $this->session->userdata('TeacherSession')->EmployeeId,/********teacher id******* */
                            'Subject'=>$this->input->post('SubjectId'),/********Subject name***********/
                            'Class'=>$this->input->post('ClassId'),/********Class***********/
                            'Syllabus'=> base_url('uploads/Syllabus/').$SyllabusId."/".$Syllabus['raw_name'].$Syllabus['file_ext'],/********Company Logo*********/
                            'InsertDate'=>date('Y-m-d h:m:s'),
                            'IsActive'=>true/********Syllabus name********** */
                        );/*********Syllabus array******** */
                        $SyllabusInserted = $this->Admindb->InsertData($SyllabusData,'syllabus'); /** Database Syllabus Inserted **/
                        if ($SyllabusInserted) {/****** Check If Syllabus Inserted *****/
                            echo json_encode(['status'=>true,'message'=>'Syllabus Insert Successfully','data'=>null]);/******send jason data******* */
                            exit;/*****exit here******* */
                        }else{ /************ If Syllabus Not Insreted *********/
                            echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */
                            exit;/*******exit here****** */
                        }/******inserted condition end*******/
                    }else{/************* Fields Are Mandetory ***********/
                        echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */
                        exit;/*******exit here******* */
                    }/*******condition end here******* */
            }elseif($param == "Delete") {/********* If Request Is for Delete**********/
                if ($this->input->post('SyllabusId')) { /******** If Id Exist ***********/
                    $SyllabusId = $this->input->post('SyllabusId');/*******Syllabus id******** */
                    $DeleteSyllabus = $this->Admindb->BlockRecord('syllabus',$SyllabusId,'SyllabusId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */
                    if ($DeleteSyllabus) {/********* If Data Deleted Successfully ***********/
                        echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */
                        exit;/***** exit here ****** */
                    }else{/********** Id data not deleted */
                        echo json_encode(['status'=>false,'message'=>'Data Not Deleted Try Again!!','data'=>null]);/******send jason****** */
                        exit;/*******exit here****** */
                    }/******condition end here****** */
                }else{/*********** If Id Not Found ************/
                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */
                    exit;/*******exit here******* */
                }/********end of condition******** */
            }
            
         
    }



    /************ Assignment Home Function *********** */
    public function Assignment()
    { /********* start of Assignment/home function********** */
        $data['ClassList'] = $this->Admindb->SimpleJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','assigncourses.Id','DESC','class.ClassId,class.ClassName');

        $data['Assignment'] = $this->Admindb->TwoJoin(['assignment.TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assignment.IsActive'=>true,'assignment.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assignment','subject','assignment.Subject = subject.SubjectId','class','assignment.Class = class.ClassId','Id','DESC','assignment.Id,assignment.TeacherId,assignment.AssignmentId,assignment.Assignment,assignment.Class,assignment.InsertDate,assignment.IsActive,assignment.Subject,subject.SubjectName,class.ClassName,assignment.Marks,assignment.DueDate'); /********get all courses******* */

        $this->load->view('Teacher/Assignment',$data); /********* hit Syllabus home screen ********** */
    }/*********end of function Syllabus/home******** */

    public function EnableAssignment($param=""){
        if($param=="Enable"){
            $Class = $this->input->post('ClassId');/********data field******* */

            $Subjects = $this->Admindb->SimpleJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.ClassId'=>$Class,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','subject','assigncourses.SubjectId = subject.SubjectId','assigncourses.Id','DESC','subject.SubjectId,subject.SubjectName');/**********get data*********** */
            
            if($Subjects){
                echo json_encode(['status'=>true,'message'=>'Subject Founds','data'=>$Subjects]);/*******send jason data******* */
            exit;/******exit here******* */
            }
            
        }elseif($param == 'Insert') { /**********if param is upload************ */
                if($this->input->post()){ /*********** Check Field mandetory **********/
                    $AssignmentId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random AssignmentId ******/
                    if (!is_dir('./uploads/Assignment/'.$AssignmentId.'')) {/********check if folder not exist******** */
                        mkdir('./uploads/Assignment/'.$AssignmentId.'', 0777, TRUE);/*****create mkdir*******/
                    }/******end of if****** */
                    /*********Configrations to Upload Files *******/
                    $Assignment = [ /********Assignment Config ********/
                        'upload_path' => './uploads/Assignment/'.$AssignmentId.'/',/******** upload path ********/
                        'allowed_types' => 'pdf|docx'/********* allowed types ********/
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
                        'AssignmentId' => $AssignmentId,/********Assignment id********** */
                        'TeacherId' => $this->session->userdata('TeacherSession')->EmployeeId,/********teacher id******* */
                        'Subject'=>$this->input->post('SubjectId'),/********Subject name***********/
                        'Class'=>$this->input->post('ClassId'),/********Class***********/
                        'Marks'=>$this->input->post('Marks'),/********Marks***********/
                        'Assignment'=> base_url('uploads/Assignment/').$AssignmentId."/".$Assignment['raw_name'].$Assignment['file_ext'],/********Company Logo*********/
                        'InsertDate'=>date('Y-m-d'),
                        'DueDate'=> date('Y-m-d',strtotime($this->input->post('DueDate'))),
                        'IsActive'=>true/********Assignment name********** */
                    );/*********Assignment array******** */
                    $AssignmentInserted = $this->Admindb->InsertData($AssignmentData,'assignment'); /** Database Assignment Inserted **/
                    if ($AssignmentInserted) {/****** Check If Assignment Inserted *****/
                        echo json_encode(['status'=>true,'message'=>'Assignment Insert Successfully','data'=>null]);/******send jason data******* */
                        exit;/*****exit here******* */
                    }else{ /************ If Assignment Not Insreted *********/
                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */
                        exit;/*******exit here****** */
                    }/******inserted condition end*******/
                }else{/************* Fields Are Mandetory ***********/
                    echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */
                    exit;/*******exit here******* */
                }/*******condition end here******* */
        }elseif($param == "Delete") {/********* If Request Is for Delete**********/
            if ($this->input->post('AssignmentId')) { /******** If Id Exist ***********/
                $AssignmentId = $this->input->post('AssignmentId');/*******Assignment id******** */
                $DeleteAssignment = $this->Admindb->BlockRecord('assignment',$AssignmentId,'AssignmentId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */
                if ($DeleteAssignment) {/********* If Data Deleted Successfully ***********/
                    echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */
                    exit;/***** exit here ****** */
                }else{/********** Id data not deleted */
                    echo json_encode(['status'=>false,'message'=>'Data Not Deleted Try Again!!','data'=>null]);/******send jason****** */
                    exit;/*******exit here****** */
                }/******condition end here****** */
            }else{/*********** If Id Not Found ************/
                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */
                exit;/*******exit here******* */
            }/********end of condition******** */
        }elseif($param == "View"){/*********** Request for assignment Detail *********/
                if ($this->input->post('AssignmentId')) { /******** If Id Exist ***********/
                    $AssignmentId = $this->input->post('AssignmentId');/*******assignment Id********/
                    $RowData = $this->Admindb->RowData('AssignmentId',$AssignmentId,'assignment');/******get assignment details *****/
                    if ($RowData) {/*******if data exist******* */
                        echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */
                        exit; /*******exit here*********/
                    }else{/**********else********* */
                        echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */
                        exit;/****** exit here *******/
                    }/********condition end*******/
                }else{/*********** If Id Not Exist **********/
                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */
                    exit;/*****exit****** */
                }/********end of condition view******** */
        }elseif ($param == "Edit") {/******* If Request Is for Edit/Update ************/

            $UpdateData = array(
                'Marks'=> $this->input->post('Marks'),
                'DueDate'=> $this->input->post('DueDate'),
            );

            $UpdateData = $this->Admindb->UpdateData1(['AssignmentId'=>$this->input->post('AssignmentId'),'IsActive'=>true,'IsDeleted'=>false],$UpdateData,'assignment'); /** Database Assignment Update **/
            if ($UpdateData) {/****** Check If user Updated */
                echo json_encode(['status'=>true,'message'=>'Assignment Edit Successfully','data'=>null]);/*******send jason data***** */
                exit;/******exit here****** */
            }else{ /************ If user Not Insreted *********/
                echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */
                exit;/********exit here******** */
            }/******condition end******* */
        }
}


    public function Schedule(){
        $data['ScheduleList'] = $this->Admindb->ScheduleList();/*********Event List******** */
        $this->load->view('Teacher/Schedule',$data);/********hit Schedule view******** */
    }

    public function Exams(){
        $data['ExamsList'] = $this->Admindb->TwoJoin(['examstimetable.IsActive'=>true,'examstimetable.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'examstimetable','subject','examstimetable.SubjectId = subject.SubjectId','class','examstimetable.ClassId = class.ClassId','Id','ASC','examstimetable.Id,examstimetable.ExamId,examstimetable.ExamDate,examstimetable.ExamTime,subject.SubjectName,class.ClassName');/*********Event List******** */
            
        $this->load->view('Teacher/Exams',$data);/********hit Exams view******** */
    }

    

    /************ Teachers Home Function *********** */
    public function TeachersList()
    { /********* start of Teachers/home function********** */
        $data['Teachers'] = $this->Admindb->GetAllResult(['Role'=>'teachers','IsDeleted'=>false],'Id','DESC','users'); /********get all users********* */
        $this->load->view('Admin/SellersAndBuyers/Teachers',$data); /********* hit Teachers home screen ********** */
    }/*********end of function Teachers/home******** */

  

    /************ Students Home Function *********** */
    public function Students()
    { /********* start of Students/home function********** */
        $data['Students'] = $this->Admindb->GetAllResult(['Role'=>'users','IsDeleted'=>false],'Id','DESC','users'); /********get all users********* */
        $this->load->view('Teacher/SellersAndBuyers/Students',$data); /********* hit Students home screen ********** */
    }/*********end of function Students/home******** */


    /************ StudentMarks Home Function *********** */
    public function StudentMarks()
    { /********* start of StudentMarks/home function********** */
        $data['Courses'] = $this->Admindb->TwoJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','subject','assigncourses.SubjectId = subject.SubjectId','Id','DESC','assigncourses.Id,assigncourses.AssignId,assigncourses.EmployeeId,class.ClassName,assigncourses.ClassId,assigncourses.SubjectId,assigncourses.Day,assigncourses.ClassTimeFrom,assigncourses.ClassTimeTo,assigncourses.IsActive,subject.SubjectName'); /********get all courses******* */
        $this->load->view('Teacher/StudentMarks',$data); /********* hit StudentMarks home screen ********** */
    }/*********end of function StudentMarks/home******** */

    public function SetMarks($param="",$param2=""){
        $data['Students'] = $this->Admindb->getdata(['ClassId'=>$param,'IsActive'=>true,'IsDeleted'=>false],'students','Id','DESC');
        $data['ClassId'] = $param;
        $data['SubjectId'] = $param2;
        $this->load->view('Teacher/SetMarks',$data); /********* hit StudentMarks home screen ********** */
    }

    public function AddMarks($param=""){
        if($param=="View"){
            if($this->input->post()){
                $GetStudentData = $this->Admindb->CheckConditionData(['StudentId'=>$this->input->post('StudentId'),'ClassId'=>$this->input->post('ClassId'),'SubjectId'=>$this->input->post('SubjectId'),'TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks');
                if($GetStudentData){
                    echo json_encode(['status'=>true,'message'=>'Data Found','data'=>$GetStudentData]);/*****send jason data***** */
                    exit;/******exit here******* */ 
                }else{
                    echo json_encode(['status'=>false,'message'=>'No Data Found','data'=>null]);/*****send jason data***** */
                    exit;/******exit here******* */ 
                }
            }else{
                echo json_encode(['status'=>false,'message'=>'Input Fields Required','data'=>null]);/*****send jason data***** */
                exit;/******exit here******* */
            }
        }elseif($param=="Edit"){
            if($this->input->post()){
                if($this->input->post('MarksId') == '0'){
                    $updatedata = array(
                        'MarksId'=> rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),
                        'TeacherId'=> $this->session->userdata('TeacherSession')->EmployeeId,
                        'StudentId'=> $this->input->post('StudentId'),
                        'ClassId'=> $this->input->post('ClassId'),
                        'SubjectId'=> $this->input->post('SubjectId'),
                        'FirstExam'=> $this->input->post('FirstExam'),
                        'SecondExam'=> $this->input->post('SecondExam'),
                        'ThirdExam'=> $this->input->post('ThirdExam'),
                        'ExtraActivityMarks'=> $this->input->post('ExtraActivityMarks'),
                        'Year'=> $this->input->post('Year'),
                        'Remarks'=> $this->input->post('Remarks'),
                        'Grade'=> $this->input->post('Grade'),
                        'InsertDate'=> date('Y-m-d')
                    );
                    $Addmarks = $this->Admindb->InsertData($updatedata,'studentmarks');
                }else{
                    $updatedata = array(
                        'FirstExam'=> $this->input->post('FirstExam'),
                        'SecondExam'=> $this->input->post('SecondExam'),
                        'ThirdExam'=> $this->input->post('ThirdExam'),
                        'ExtraActivityMarks'=> $this->input->post('ExtraActivityMarks'),
                        'Year'=> $this->input->post('Year'),
                        'Remarks'=> $this->input->post('Remarks'),
                        'Grade'=> $this->input->post('Grade'),
                    );
                    $Addmarks = $this->Admindb->UpdateData1(['MarksId'=>$this->input->post('MarksId'),'IsActive'=>true,'IsDeleted'=>false],$updatedata,'studentmarks');
                }
                
                if($Addmarks){
                    echo json_encode(['status'=>true,'message'=>'Marks add Found','data'=>null]);/*****send jason data***** */
                    exit;/******exit here******* */ 
                }else{
                    echo json_encode(['status'=>false,'message'=>'No marks addes','data'=>null]);/*****send jason data***** */
                    exit;/******exit here******* */ 
                }
            }else{
                echo json_encode(['status'=>false,'message'=>'Input Fields Required','data'=>null]);/*****send jason data***** */
                exit;/******exit here******* */
            }
        }
    }

    /************ StudentResult Home Function *********** */
    public function StudentResult()
    { /********* start of StudentResult/home function********** */
        $data['Courses'] = $this->Admindb->TwoJoin(['assigncourses.EmployeeId'=>$this->session->userdata('TeacherSession')->EmployeeId,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','class','assigncourses.ClassId = class.ClassId','subject','assigncourses.SubjectId = subject.SubjectId','Id','DESC','assigncourses.Id,assigncourses.AssignId,assigncourses.EmployeeId,class.ClassName,assigncourses.ClassId,assigncourses.SubjectId,assigncourses.Day,assigncourses.ClassTimeFrom,assigncourses.ClassTimeTo,assigncourses.IsActive,subject.SubjectName'); /********get all courses******* */
        $this->load->view('Teacher/StudentResult',$data); /********* hit StudentResult home screen ********** */
    }/*********end of function StudentResult/home******** */

    public function ResultList($param="",$param2=""){
        $data['Students'] = $this->Admindb->getdata(['ClassId'=>$param,'SubjectId'=>$param2,'TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','Id','DESC');
        $data['Students'] = $this->Admindb->SimpleJoin(['studentmarks.ClassId'=>$param,'studentmarks.SubjectId'=>$param2,'studentmarks.TeacherId'=>$this->session->userdata('TeacherSession')->EmployeeId,'studentmarks.IsActive'=>true,'studentmarks.IsDeleted'=>false,'students.IsActive'=>true,'students.IsDeleted'=>false],'studentmarks','students','studentmarks.StudentId = students.StudentId','Id','DESC','studentmarks.Id,studentmarks.MarksId,studentmarks.StudentId,studentmarks.TeacherId,studentmarks.SubjectId,studentmarks.ClassId,studentmarks.FirstExam,studentmarks.SecondExam,studentmarks.ThirdExam,studentmarks.ExtraActivityMarks,studentmarks.InsertDate,studentmarks.Year,studentmarks.Remarks,students.StudentName,students.StudentGR,students.FatherName,students.StudentImage');
        $this->load->view('Teacher/ResultList',$data); /********* hit StudentMarks home screen ********** */
    }

    public function CheckAssignment($param=""){
        $data['Assignments'] = $this->Admindb->SimpleJoin(['uploadassignment.AssignmentId'=>$param,'uploadassignment.IsActive'=>true,'uploadassignment.IsDeleted'=>false,'students.IsActive'=>true,'uploadassignment.IsDeleted'=>false],'uploadassignment','students','uploadassignment.StudentId = students.StudentId','Id','DESC','uploadassignment.Id,uploadassignment.UploadAssignmentId,uploadassignment.StudentId,uploadassignment.AssignmentId,uploadassignment.Assignment,uploadassignment.InsertDate,students.StudentName,students.StudentGR,uploadassignment.Marks');
        $this->load->view('Teacher/CheckAssignment',$data); /********* hit StudentMarks home screen ********** */
    }


    public function AssignmentMarks(){
        if($this->input->post()){
            $checktotal = $this->Admindb->SingleRowField(['AssignmentId'=>$this->input->post('AssignmentId'),'IsActive'=>true,'IsDeleted'=>false],'assignment','Marks');

            if($checktotal >= $this->input->post('Marks') ){
                $UpdateData = $this->Admindb->UpdateData1(['UploadAssignmentId'=>$this->input->post('UploadAssignmentId'),'IsActive'=>true,'IsDeleted'=>false],['Marks'=>$this->input->post('Marks')],'uploadassignment');
                if($UpdateData){
                    echo json_encode(['status'=>true,'message'=>'Marks submitted successfully','data'=>null]);/*****send jason data***** */
                    exit;/******exit here******* */ 
                }else{
                    echo json_encode(['status'=>false,'message'=>'Marks not submitted','data'=>null]);/*****send jason data***** */
                    exit;/******exit here******* */
                }
            }else{
                echo json_encode(['status'=>false,'message'=>'Total Marks of this assignment is '.$checktotal.' give under this','data'=>null]);/*****send jason data***** */
                exit;/******exit here******* */ 
            }
            
        }else{
            echo json_encode(['status'=>false,'message'=>'Please submit marks','data'=>null]);/*****send jason data***** */
            exit;/******exit here******* */ 
        }
    }

    /**************Logout function**************/
	public function LogoutTeacher()
	{/*********logout function start******* */
        $TeacherSession = $this->session->userdata('TeacherSession');/*********user data session******** */
        $UpdateLogin = $this->Admindb->UpdateData1(['SessionId'=>$TeacherSession->SessionId],['LogoutDate'=>date('Y-m-d'),'LogoutTime'=>date('h:m:s'),'IsActive'=>false],'teacherloginlogs');/*******update login***** */
		$this->session->unset_userdata('TeacherSession');/*********unset session******** */
		return redirect('TeacherLogin');/********redirect to login******* */
    }/********logout function******** */
}
?>