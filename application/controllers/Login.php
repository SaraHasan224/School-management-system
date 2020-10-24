<?php 

class Login extends CI_controller
{
    function __construct() /************* Constructor **********/
	{
		parent:: __construct(); /********** Launch Constructer **********/

        if ($this->session->userdata('UserSession')) { /****** If User Session Is Activate Redirect to account *******/
            return redirect('Admin');
        }elseif($this->session->userdata('TeacherSession')){
            return redirect('Teacher');
        }elseif($this->session->userdata('StudentSession')){
            return redirect('Student');
        }
        $this->load->model('Logindb');/******* Initialize Admin Model Database */
        $this->encryption->initialize(
            array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => '<a 32-character random string>'
            )
    );
    }

    public function AdminLogin()
    {
        $this->load->view('adminindex.php');
    }

    public function TeacherLogin()
    {
        $this->load->view('teacherindex.php');
    }

    public function StudentLogin()
    {
        $this->load->view('studentindex.php');
    }

    public function ParentLogin()
    {
        $this->load->view('parentindex.php');
    }

    /****** login service start ********/
	public function verifylogin()
	{
        /************Check Method is post? ******/
        if($this->input->post()){
            if(!$this->input->post('Email')){/********* Check Param is given or not */
                echo json_encode(['status'=>false,'message'=>'Email Required','data'=>null]);
                exit;
            }elseif (!$this->input->post('Password')) {
                echo json_encode(['status'=>false,'message'=>'Password Required','data'=>null]);
                exit;
            }elseif (!$this->input->post('LoginType')) {
                echo json_encode(['status'=>false,'message'=>'Login Type is required','data'=>null]);
                exit;
            }else{
                $params = array(
                    'Email'=>$this->input->post('Email'),
                    'Password'=>$this->input->post('Password'),
                    'LoginType'=>$this->input->post('LoginType')
                );
                /***** Check if Email or Password Exist */
                if ($params['Email'] != "" && $params['Password'] !="" && $params['LoginType'] !="") {
                    /********* Verify User Credential from DB */    
                    $verifyuser = $this->Logindb->verifyuser($params);
                    if ($verifyuser) {/*******if userexist */
                        $verifyuser->User = $params['LoginType'];
                        $verifyuser->SessionId = rand(1, 1000).''.rand(1, 1000).''.rand(1, 1000);
                        if ($this->encryption->decrypt($verifyuser->Password) == $params['Password']) { /**** Check Password Match ******/
                            /********** Insert User Log ***********/
                            if ($params['LoginType'] == "staff") {/********* Staff Login ******/
                                $login_logs = array('UserId'=>$verifyuser->StaffId,'SessionId'=>$verifyuser->SessionId,'LoginDate'=>date('Y-m-d'),'LoginType'=>$params['LoginType'],'LoginTime'=>date('h:i:s'),'IsActive'=>true);
                                $insert_loginlog = $this->Logindb->insert_loginlog($login_logs);
                                /************* Activate Session **************/
                                $this->session->set_userdata('UserSession',$verifyuser);
                                /******** Response if user get*******/
                                echo json_encode(['status'=>true,'message'=>'User Verified','data'=>$verifyuser]);
                                /************* Session Activate End *************/
                            }elseif ($params['LoginType'] == "doctor") { /******** If Doctor login*/
                                $login_logs = array('UserId'=>$verifyuser->DoctorId,'LoginDate'=>date('Y-m-d'),'LoginType'=>$params['LoginType'],'LoginTime'=>date('h:i:s'),'IsActive'=>true);
                                $insert_loginlog = $this->Logindb->insert_loginlog($login_logs);
                                /************* Activate Session **************/
                                $this->session->set_userdata('UserSession',$verifyuser);
                                /******** Response if user get*******/
                                echo json_encode(['status'=>true,'message'=>'User Verified','data'=>$verifyuser]);
                                /************* Session Activate End *************/
                            }elseif($params['LoginType'] == "patient"){/******** patient Login **********/
                                $login_logs = array('UserId'=>$verifyuser->PatientId,'LoginDate'=>date('Y-m-d'),'LoginType'=>$params['LoginType'],'LoginTime'=>date('h:i:s'),'IsActive'=>true);
                                $insert_loginlog = $this->Logindb->insert_loginlog($login_logs);
                                /************* Activate Session **************/
                                $this->session->set_userdata('UserSession',$verifyuser);
                                /******** Response if user get*******/
                                echo json_encode(['status'=>true,'message'=>'User Verified','data'=>$verifyuser]);
                                /************* Session Activate End *************/
                            }
                        
                        
                        exit;
                        }else{/******** else if not match */
                            echo json_encode(['status'=>false,'message'=>'Password does not match','data'=>null]);
                            exit;
                        }/****** End of password check match */
                        
                    }else{ /*******if userexist */
                        echo json_encode(['status'=>false,'message'=>'User does not exist','data'=>null]);
                        exit;
                    }
                }else{ /***** Check if Email or Password Exist */
                    echo json_encode(['status'=>false,'message'=>'Email or password Can not be empty','data'=>null]);
                    exit;
                }
            }/******** end of check isset params validation */
        }else{ /************Check Method is post? ******/
            echo json_encode(['status'=>false,'message'=>'Please fill all the field first','data'=>null]);
            exit;
        }

    }


    /************ SignInAdmin Home Function *********** */
    public function SignInAdmin()
    { /********* start of SignInAdmin/home function********** */
        if($this->input->post()){ /********* check input fields ********* */
            if(!$this->input->post('Email')){/********* Check email is given or not ********/
                echo json_encode(['status'=>false,'message'=>'Email Required','data'=>null]); /*******message if mail not found****** */
                log_message('error', 'Email Not Given!!'); /*****log message***** */
                exit; /******exit***** */
            }elseif (!$this->input->post('Password')) { /**********check password is given r not********** */
                echo json_encode(['status'=>false,'message'=>'Password Required','data'=>null]); /********** send message ********** */
                log_message('error', 'Password Not Given!!'); /********* log messages******* */
                exit; /********exit ******** */
            }else{ /**********else param found ********** */
                $CheckUser = $this->Logindb->SimplesingleJoin(['staff.StaffEmail'=>$this->input->post('Email'),'staff.IsActive'=>true,'staff.IsDeleted'=>false],'staff','staffrole','staff.StaffId = staffrole.StaffId','staff.Id','ASC','*'); /********* get user data check ******** */
                
                
                if($CheckUser){ /******** if user found ******** */
                    if ($this->encryption->decrypt($CheckUser->Password) == $this->input->post('Password')) { /**** Check Password Match ******/
                        $CheckUser->SessionId = rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000); /*******random session id******* */
                        $InsertLogs = array( /********** array insert log ********* */
                            'SessionId' => $CheckUser->SessionId, /********* Session Id ******** */
                            'UserId' => $CheckUser->StaffId, /********* Teacher Id ********* */
                            'LoginDate' => date('Y-m-d'), /********* LoginDate ******** */
                            'LoginTime' => date('h:m:s'), /********* Login Time ******** */
                            'IsActive' => true /******** Is Active ******* */
                        ); /********* Insert logs ******** */
                        $LogsInserted = $this->Logindb->InsertData($InsertLogs,'loginlogs'); /********insert login******* */
                        $this->session->set_userdata('UserSession',$CheckUser);
                        echo json_encode(['status'=>true,'message'=>'Login Successfully','data'=>null]); /*******message yes ***** */
                        log_message('error', 'User Login Successfully!!'); /********* log messages******* */
                        exit; /******** exit ******** */
                    }else{/******** else if not match */
                        echo json_encode(['status'=>false,'message'=>'In-Correct Password','data'=>null]); /*******message false****** */
                        log_message('error', 'In-Correct Password!!'); /********* log messages******* */
                        exit; /*******exit******* */
                    }/****** End of password check match */
                }else{ /******** else user not found ******* */
                    echo json_encode(['status'=>false,'message'=>'No User Found!!','data'=>null]); /*******send jason data****** */
                    log_message('error', 'No User Found!!'); /******insert log****** */
                    exit; /****** exit ****** */
                } /**********end of user check condition end****** */
            } /******** end of param conditions ********* */
        }else{ /********else fileds not found ******** */
            echo json_encode(['status'=>false,'message'=>'All Fields Are Required','data'=>null]); /*******send jason data****** */
            log_message('error', 'All Fields Are Required'); /******insert log****** */
            exit; /******* exit ****** */
        } /*********** end of filed check condition *********** */
    }/*********end of function SignIn/home******** */



    /************ SignInTeacher Home Function *********** */
    public function SignInTeacher()
    { /********* start of SignInTeacher/home function********** */
        if($this->input->post()){ /********* check input fields ********* */
            if(!$this->input->post('Email')){/********* Check email is given or not ********/
                echo json_encode(['status'=>false,'message'=>'Email Required','data'=>null]); /*******message if mail not found****** */
                log_message('error', 'Email Not Given!!'); /*****log message***** */
                exit; /******exit***** */
            }elseif (!$this->input->post('Password')) { /**********check password is given r not********** */
                echo json_encode(['status'=>false,'message'=>'Password Required','data'=>null]); /********** send message ********** */
                log_message('error', 'Password Not Given!!'); /********* log messages******* */
                exit; /********exit ******** */
            }else{ /**********else param found ********** */
                $CheckUser = $this->Logindb->CheckConditionData(['EmailAddress'=>$this->input->post('Email'),'Designation'=>'Teacher','IsActive'=>true,'IsDeleted'=>false],'employee'); /********* get user data check ******** */
                
                if($CheckUser){ /******** if user found ******** */
                    if ($this->encryption->decrypt($CheckUser->Password) == $this->input->post('Password')) { /**** Check Password Match ******/
                        $CheckUser->SessionId = rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000); /*******random session id******* */
                        $InsertLogs = array( /********** array insert log ********* */
                            'SessionId' => $CheckUser->SessionId, /********* Session Id ******** */
                            'TeacherId' => $CheckUser->EmployeeId, /********* Teacher Id ********* */
                            'LoginDate' => date('Y-m-d'), /********* LoginDate ******** */
                            'LoginTime' => date('h:m:s'), /********* Login Time ******** */
                            'IsActive' => true /******** Is Active ******* */
                        ); /********* Insert logs ******** */
                        $LogsInserted = $this->Logindb->InsertData($InsertLogs,'teacherloginlogs'); /********insert login******* */
                        $this->session->set_userdata('TeacherSession',$CheckUser);
                        echo json_encode(['status'=>true,'message'=>'Login Successfully','data'=>null]); /*******message yes ***** */
                        log_message('error', 'User Login Successfully!!'); /********* log messages******* */
                        exit; /******** exit ******** */
                    }else{/******** else if not match */
                        echo json_encode(['status'=>false,'message'=>'In-Correct Password','data'=>null]); /*******message false****** */
                        log_message('error', 'In-Correct Password!!'); /********* log messages******* */
                        exit; /*******exit******* */
                    }/****** End of password check match */
                }else{ /******** else user not found ******* */
                    echo json_encode(['status'=>false,'message'=>'No User Found!!','data'=>null]); /*******send jason data****** */
                    log_message('error', 'No User Found!!'); /******insert log****** */
                    exit; /****** exit ****** */
                } /**********end of user check condition end****** */
            } /******** end of param conditions ********* */
        }else{ /********else fileds not found ******** */
            echo json_encode(['status'=>false,'message'=>'All Fields Are Required','data'=>null]); /*******send jason data****** */
            log_message('error', 'All Fields Are Required'); /******insert log****** */
            exit; /******* exit ****** */
        } /*********** end of filed check condition *********** */
    }/*********end of function SignIn/home******** */



    /************ SignInStudent Home Function *********** */
    public function SignInStudent()
    { /********* start of SignInStudent/home function********** */
        if($this->input->post()){ /********* check input fields ********* */
            if(!$this->input->post('StudentGR')){/********* Check StudentGR is given or not ********/
                echo json_encode(['status'=>false,'message'=>'StudentGR Required','data'=>null]); /*******message if mail not found****** */
                log_message('error', 'StudentGR Not Given!!'); /*****log message***** */
                exit; /******exit***** */
            }elseif (!$this->input->post('Password')) { /**********check password is given r not********** */
                echo json_encode(['status'=>false,'message'=>'Password Required','data'=>null]); /********** send message ********** */
                log_message('error', 'Password Not Given!!'); /********* log messages******* */
                exit; /********exit ******** */
            }else{ /**********else param found ********** */
                $CheckUser = $this->Logindb->CheckConditionData(['StudentGR'=>$this->input->post('StudentGR'),'IsActive'=>true,'IsDeleted'=>false],'students'); /********* get user data check ******** */
                
                if($CheckUser){ /******** if user found ******** */
                    if ($this->encryption->decrypt($CheckUser->Password) == $this->input->post('Password')) { /**** Check Password Match ******/
                        $CheckUser->SessionId = rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000); /*******random session id******* */
                        $InsertLogs = array( /********** array insert log ********* */
                            'SessionId' => $CheckUser->SessionId, /********* Session Id ******** */
                            'StudentId' => $CheckUser->StudentId, /********* student Id ********* */
                            'LoginDate' => date('Y-m-d'), /********* LoginDate ******** */
                            'LoginTime' => date('h:m:s'), /********* Login Time ******** */
                            'IsActive' => true /******** Is Active ******* */
                        ); /********* Insert logs ******** */
                        $LogsInserted = $this->Logindb->InsertData($InsertLogs,'studentslog'); /********insert login******* */
                        $this->session->set_userdata('StudentSession',$CheckUser);
                        echo json_encode(['status'=>true,'message'=>'Login Successfully','data'=>null]); /*******message yes ***** */
                        log_message('error', 'User Login Successfully!!'); /********* log messages******* */
                        exit; /******** exit ******** */
                    }else{/******** else if not match */
                        echo json_encode(['status'=>false,'message'=>'In-Correct Password','data'=>null]); /*******message false****** */
                        log_message('error', 'In-Correct Password!!'); /********* log messages******* */
                        exit; /*******exit******* */
                    }/****** End of password check match */
                }else{ /******** else user not found ******* */
                    echo json_encode(['status'=>false,'message'=>'No User Found!!','data'=>null]); /*******send jason data****** */
                    log_message('error', 'No User Found!!'); /******insert log****** */
                    exit; /****** exit ****** */
                } /**********end of user check condition end****** */
            } /******** end of param conditions ********* */
        }else{ /********else fileds not found ******** */
            echo json_encode(['status'=>false,'message'=>'All Fields Are Required','data'=>null]); /*******send jason data****** */
            log_message('error', 'All Fields Are Required'); /******insert log****** */
            exit; /******* exit ****** */
        } /*********** end of filed check condition *********** */
    }/*********end of function SignIn/home******** */


}


?>