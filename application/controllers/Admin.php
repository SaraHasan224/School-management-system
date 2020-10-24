<?php 

class Admin extends CI_controller /********** My Admin Class Inherit CI main controller */

{/********* Start of admin classs ****/

	function __construct() /************* Constructor **********/

	{/************ Start Of Constructor ********/

        parent:: __construct(); /********** Launch Constructer **********/

        $UserSession = $this->session->userdata('UserSession'); /****** Set User Session ********/

        if ($UserSession == false) { /********* If Session Is not Activated ******/

			return redirect('AdminLogin');/******** Redirect User To Login*****/

        }/********end of user check condition********/

        $this->load->model('Admindb');/******* Initialize Admin Model Database ********/

        $this->encryption->initialize(/*********** Initialize encryption *********/

            array(/******start of array***** */

                    'cipher' => 'aes-256',

                    'mode' => 'ctr',

                    'key' => '<a 32-character random string>'

            )/******array end for password encryption****** */

        );/********encryption library end********** */

        date_default_timezone_set('Asia/Karachi');

    } /************* End Of Constructor *************/



    /*********** Show Admin Dashboard *********/

    public function index()

    {/******start of index function******* */

        $language = $this->session->userdata('language');/*********Userdata language****** */

        if($language == 'Urdu'){ /******** If language is Urdu */

            $data['Word'] = 'Urdu'; /******** Word array Urdu ****/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English */

        }/*********End of condition********* */

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

        /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['Students'] = $this->Admindb->CountRowDynamic(['IsDeleted'=>false, 'IsActive' => true],'students');

        $data['Teachers'] = $this->Admindb->CountRowDynamic(['Designation'=>'Teacher', 'IsActive' => true,'IsDeleted'=>false],'employee');

        $data['Users'] = $this->Admindb->CountRowDynamic(['IsDeleted'=>false, 'IsActive' => true],'staff');

        $data['Recruite'] = $this->Admindb->CountRowDynamic(['IsHired'=>false,'IsActive'=>true,'IsDeleted'=>false],'recruitment');

        $this->load->view('admin/pages/index.php',$data); /************ Load Dashboard Index file *************/

    }/**********end of a function************* */



    public function VerifyData($param="")

    {/***********start of verify data function********** */

        if($param == "SubjectCheck"){/********if param is SubjectCheck********* */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                   $Class = $this->input->post('Class');/********data field******* */

                   $Subjects = $this->Admindb->getdata(['ClassId'=>$Class,'IsActive'=>true,'IsDeleted'=>false],'subject','Id','ASC');/**********get data*********** */

                   echo json_encode(['status'=>true,'message'=>'Subject Founds','data'=>$Subjects]);/*******send jason data******* */

                   exit;/******exit here******* */

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */

        }elseif ($param == "Download") { /*************if param is Download**************** */

            /******** Check Email Is Unique Or Exist ********/

            if ($this->input->post()) {/*******if input post exist******** */

                $SyllabusId = $this->input->post('SyllabusId'); /*******get FileId****** */

                $Syllabus = $this->Admindb->RowData('SyllabusId',$SyllabusId,'syllabus');/********Files data from database****** */

                if ($Syllabus) {/*********if Files exist********/

                    $Syllabus->FileUrl = $Syllabus->Syllabus;/*********** Add File Url to array *********** */

                    echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$Syllabus]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }else{/******if Files not exist****** */

                    echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }/********if condition end***** */

            }else{/******if post not there********* */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit Here ********/

            }/*******end of condition***** */

        }elseif ($param == "Candidate") { /*************if param is Candidate**************** */

            /******** Check Email Is Unique Or Exist ********/

            $Email = $this->input->post('EmailAddress'); /********** Staff Email ************/

            $CheckEmail = $this->Admindb->CheckVerifyData($Email,'recruitment','EmailAddress');/********check email******** */

            if ($CheckEmail) { /***********If Email Exist */

                echo json_encode(['status'=>false,'message'=>'Email Already Exist','data'=>null]);/**********send jason data******* */

                exit;/****************exit here************** */

            }else{/*******else email ot exist********* */

                echo json_encode(['status'=>true,'message'=>'Email Verified','data'=>null]);/***********send jason data********** */

                exit; /********exit here****** */

            }/***********email exist condition end*********** */

        }elseif ($param == "CVDownload") { /*************if param is Download**************** */

            /******** Check Email Is Unique Or Exist ********/

            if ($this->input->post()) {/*******if input post exist******** */

                $DocumentId = $this->input->post('DocumentId'); /*******get FileId****** */

                $User = $this->input->post('User'); /*******get FileId****** */

                $DocumentFile = $this->Admindb->RowData('RecruitmentId',$DocumentId,'recruitment');/********Files data from database****** */

                if ($DocumentFile) {/*********if Files exist******* */

                    $DocumentFile->FileUrl = base_url('uploads/'.$User.'/'.$DocumentFile->Cv);/***********Add File Url to array *********** */

                    echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$DocumentFile]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }else{/******if Files not exist****** */

                    echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }/********if condition end***** */

            }else{/******if post not there********* */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit Here ********/

            }/*******end of condition***** */

        }elseif ($param == "EmployeeCv") { /*************if param is Download**************** */

            /******** Check Email Is Unique Or Exist ********/

            if ($this->input->post()) {/*******if input post exist******** */

                $EmployeeId = $this->input->post('EmployeeId'); /*******get FileId****** */

                $DocumentFile = $this->Admindb->RowData('EmployeeId',$EmployeeId,'employee');/********Files data from database****** */

                if ($DocumentFile) {/*********if Files exist******* */

                    $DocumentFile->FileUrl = $DocumentFile->Cv;/***********Add File Url to array *********** */

                    echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$DocumentFile]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }else{/******if Files not exist****** */

                    echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                    exit;/******* exit cHere ********/

                }/********if condition end***** */

            }else{/******if post not there********* */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit Here ********/

            }/*******end of condition***** */

        }else{/*******if param is not given***** */

            echo json_encode(['status'=>false,'message'=>'Param Is Required','data'=>null]);/*******send jason data******* */

            exit;/******exit here******* */

        }/********end of param check******* */

    }/*******end of verify data function******* */



    /*************** Insert InsertSchool Function ****************/

    public function InsertSchool($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'Insert') { /**********if param is upload************ */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/ 

                if($this->input->post()){ /*********** Check Field mandetory **********/

                    $SchoolId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random SchoolId ******/

                    if (!is_dir('./uploads/School/'.$SchoolId.'')) {/********check if folder not exist******** */

                        mkdir('./uploads/School/'.$SchoolId.'', 0777, TRUE);/*****create mkdir*******/

                    }/******end of if****** */

                    /*********Configrations to Upload Files */

                    $SchoolLogo = [ /********SchoolLogo Config ********/

                        'upload_path' => './uploads/School/'.$SchoolId.'/',/********upload path******* */

                        'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                        // 'allowed_types' => '*',

                    ];/******config end********/

                    /**********Configration End ***********/

                    $this->load->library('upload'); /***** Upload File Library *******/

                    /********upload SchoolLogo ******/

                    $this->upload->initialize($SchoolLogo); /*****Initialize SchoolLogo ****/

                    if ($this->upload->do_upload('SchoolLogo') /***** Upload SchoolLogo ****/) { /***** Check SchoolLogo File Upload *****/

                        $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    }else{/*******else logo not uploaded******** */

                        $SchoolLogo = $this->upload->data(); /****** push Array ************/

                        $SchoolLogo = array('raw_name'=>'','file_ext'=>'');/********Company Image there******* */

                    }/***** End of DoctorImage file check *****/

                    $SchoolData = array( /********start of array******* */

                        'SchoolId' => $SchoolId,/********School id********** */

                        'SchoolName'=>$this->input->post('SchoolName'),/********School name***********/

                        'SchoolAddress'=>$this->input->post('SchoolAddress'),/********School name***********/

                        'SchoolType'=>$this->input->post('SchoolType'),/********School name***********/

                        'SchoolLogo'=> base_url('uploads/School/').$SchoolId."/".$SchoolLogo['raw_name'].$SchoolLogo['file_ext'],/********Company Logo*********/

                        'IsActive'=>true/********School name********** */

                    );/*********School array******** */



                    $SchoolInserted = $this->Admindb->InsertData($SchoolData,'school'); /** Database School Inserted **/

                    if ($SchoolInserted) {/****** Check If School Inserted *****/

                        echo json_encode(['status'=>true,'message'=>'School Insert Successfully','data'=>null]);/******send jason data******* */

                        exit;/*****exit here******* */

                    }else{ /************ If School Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                    }/******inserted condition end*******/

                }else{/************* Fields Are Mandetory ***********/

                    echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/*******condition end here******* */

            }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/*******condition end******* */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $DeleteSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSchool) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "Block") {/********* If Request Is for Block**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $SchoolData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');

                if ($SchoolData->IsActive == true) {

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>false]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Block */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here*******/

                    }/******condition end here*******/

                }else{/******else ****** */

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>true]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Un-Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Blockd */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here****** */

                    }/******condition end here****** */

                }/*********end of isActive condition ********* */

            }else{/*********** If Id Not Found ************/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Block!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                $SchoolId = $this->input->post('SchoolId');/*******School id****** */

                if (!is_dir('./uploads/School/'.$SchoolId.'')) {/********check if folder not exist******** */

                    mkdir('./uploads/School/'.$SchoolId.'', 0777, TRUE);/*****create mkdir*******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $SchoolLogo = [ /********SchoolLogo Config ********/

                    'upload_path' => './uploads/School/'.$SchoolId.'/',/********upload path******* */

                    'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                    // 'allowed_types' => '*',

                ];/******config end********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                /********upload SchoolLogo ******/

                $this->upload->initialize($SchoolLogo); /*****Initialize SchoolLogo ****/

                if ($this->upload->do_upload('SchoolLogo') /***** Upload SchoolLogo ****/) { /***** Check SchoolLogo File Upload *****/

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                        'SchoolLogo'=>base_url('uploads/School/').$SchoolId."/".$SchoolLogo['raw_name'].$SchoolLogo['file_ext'],/********school Logo*********/

                    ); /*******data array end********/

                }else{/*******else logo not uploaded******** */

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $SchoolLogo = array('raw_name'=>'','file_ext'=>'');/********Company Image there******* */

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                    ); /*******data array end********/

                }/***** End of DoctorImage file check *****/

            

            $UpdateData = $this->Admindb->UpdateData($Data,'school',$SchoolId,'SchoolId'); /** Database School Update **/

                if ($UpdateData) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'School Update Successfully','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******** */

                }/******condition end******* */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for School Detail *********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                    $SchoolId = $this->input->post('SchoolId');/*******School Id******* */

                    $RowData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');/******get School details *****/

                    if ($RowData) {/*******if data exist******* */

                        echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                        exit; /*******exit here******** */

                    }else{/**********else********* */

                        echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/********condition end******* */

                }else{/*********** If Id Not Exist **********/

                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                    exit;/*****exit****** */

                }/********end of condition view******** */

            }else{/*******else******* */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['SchoolList'] = $this->Admindb->getdata(['IsDeleted'=>false],'school','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/InsertSchool',$data);/********send to display view page******* */

        }/*******end of else****** */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/********function end******* */





    /*************** Insert PrimarySchool Function ****************/

    public function PrimarySchool($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $DeleteSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSchool) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "Block") {/********* If Request Is for Block**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $SchoolData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');

                if ($SchoolData->IsActive == true) {

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>false]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Block */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here*******/

                    }/******condition end here*******/

                }else{/******else ****** */

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>true]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Un-Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Blockd */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here****** */

                    }/******condition end here****** */

                }/*********end of isActive condition ********* */

            }else{/*********** If Id Not Found ************/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Block!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                $SchoolId = $this->input->post('SchoolId');/*******School id****** */

                if (!is_dir('./uploads/School/'.$SchoolId.'')) {/********check if folder not exist******** */

                    mkdir('./uploads/School/'.$SchoolId.'', 0777, TRUE);/*****create mkdir*******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $SchoolLogo = [ /********SchoolLogo Config ********/

                    'upload_path' => './uploads/School/'.$SchoolId.'/',/********upload path******* */

                    'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                    // 'allowed_types' => '*',

                ];/******config end********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                /********upload SchoolLogo ******/

                $this->upload->initialize($SchoolLogo); /*****Initialize SchoolLogo ****/

                if ($this->upload->do_upload('SchoolLogo') /***** Upload SchoolLogo ****/) { /***** Check SchoolLogo File Upload *****/

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                        'SchoolLogo'=>$SchoolLogo['raw_name'].$SchoolLogo['file_ext']/********school Logo*********/

                    ); /*******data array end********/

                }else{/*******else logo not uploaded******** */

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $SchoolLogo = array('raw_name'=>'','file_ext'=>'');/********Company Image there******* */

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                    ); /*******data array end********/

                }/***** End of DoctorImage file check *****/

            

            $UpdateData = $this->Admindb->UpdateData($Data,'school',$SchoolId,'SchoolId'); /** Database School Update **/

                if ($UpdateData) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'School Update Successfully','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******** */

                }/******condition end******* */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for School Detail *********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                    $SchoolId = $this->input->post('SchoolId');/*******School Id******* */

                    $RowData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');/******get School details *****/

                    if ($RowData) {/*******if data exist******* */

                        echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                        exit; /*******exit here******** */

                    }else{/**********else********* */

                        echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/********condition end******* */

                }else{/*********** If Id Not Exist **********/

                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                    exit;/*****exit****** */

                }/********end of condition view******** */

            }else{/*******else******* */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['SchoolList'] = $this->Admindb->getconditiondata('SchoolType','Primary','school');/********get list rows******** */

            $this->load->view('admin/pages/PrimarySchool',$data);/********send to display view page******* */

        }/*******end of else****** */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/********function end******* */



    /*************** Insert SecondarySchool Function ****************/

    public function SecondarySchool($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $DeleteSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSchool) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "Block") {/********* If Request Is for Block**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                $SchoolId = $this->input->post('SchoolId');/*******School id******** */

                $SchoolData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');

                if ($SchoolData->IsActive == true) {

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>false]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Block */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here*******/

                    }/******condition end here*******/

                }else{/******else ****** */

                    $BlockSchool = $this->Admindb->BlockRecord('school',$SchoolId,'SchoolId',['IsActive'=>true]);/********Block record********* */

                    if ($BlockSchool) {/********* If Data Blockd Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'School Un-Block Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Blockd */

                        echo json_encode(['status'=>false,'message'=>'School Not Block Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here****** */

                    }/******condition end here****** */

                }/*********end of isActive condition ********* */

            }else{/*********** If Id Not Found ************/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Block!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                $SchoolId = $this->input->post('SchoolId');/*******School id****** */

                if (!is_dir('./uploads/School/'.$SchoolId.'')) {/********check if folder not exist******** */

                    mkdir('./uploads/School/'.$SchoolId.'', 0777, TRUE);/*****create mkdir*******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $SchoolLogo = [ /********SchoolLogo Config ********/

                    'upload_path' => './uploads/School/'.$SchoolId.'/',/********upload path******* */

                    'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                    // 'allowed_types' => '*',

                ];/******config end********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                /********upload SchoolLogo ******/

                $this->upload->initialize($SchoolLogo); /*****Initialize SchoolLogo ****/

                if ($this->upload->do_upload('SchoolLogo') /***** Upload SchoolLogo ****/) { /***** Check SchoolLogo File Upload *****/

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                        'SchoolLogo'=>$SchoolLogo['raw_name'].$SchoolLogo['file_ext']/********school Logo*********/

                    ); /*******data array end********/

                }else{/*******else logo not uploaded******** */

                    $SchoolLogo = $this->upload->data(); /****** push Array ************/

                    $SchoolLogo = array('raw_name'=>'','file_ext'=>'');/********Company Image there******* */

                    $Data = array(/*******data array******* */

                        'SchoolName'=>$this->input->post('SchoolName'), /*******School Name****** */

                        'SchoolAddress'=>$this->input->post('SchoolAddress'), /*******SchoolAddress****** */

                        'SchoolType'=>$this->input->post('SchoolType'), /*******SchoolType*******/

                    ); /*******data array end********/

                }/***** End of DoctorImage file check *****/

            

            $UpdateData = $this->Admindb->UpdateData($Data,'school',$SchoolId,'SchoolId'); /** Database School Update **/

                if ($UpdateData) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'School Update Successfully','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******** */

                }/******condition end******* */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for School Detail *********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                if ($this->input->post('SchoolId')) { /******** If Id Exist ***********/

                    $SchoolId = $this->input->post('SchoolId');/*******School Id******* */

                    $RowData = $this->Admindb->RowData('SchoolId',$SchoolId,'school');/******get School details *****/

                    if ($RowData) {/*******if data exist******* */

                        echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                        exit; /*******exit here******** */

                    }else{/**********else********* */

                        echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/********condition end******* */

                }else{/*********** If Id Not Exist **********/

                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                    exit;/*****exit****** */

                }/********end of condition view******** */

            }else{/*******else******* */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['SchoolList'] = $this->Admindb->getconditiondata('SchoolType','Secondary','school');/********get list rows******** */

            $this->load->view('admin/pages/SecondarySchool',$data);/********send to display view page******* */

        }/*******end of else****** */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/********function end******* */



    

    /*************** Insert InsertSubject Function ****************/

    public function InsertSubject($param1='')

    {/**********start of function************/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'Insert') { /**********if param is upload************ */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/ 

                if($this->input->post()){ /*********** Check Field mandetory **********/

                    $Class = json_decode($this->input->post('Class'));

                    foreach ($Class as $value) {/*********start of foreach loop*********** */

                    $SubjectId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random SubjectId ******/

                        $SubjectData = array( /********start of array******* */

                            'SubjectId' => $SubjectId,/********Subject id********** */

                            'SubjectName'=>$this->input->post('SubjectName'),/********Subject name***********/

                            'ClassId'=> $this->Admindb->SingleRowField(['ClassName'=>$value->Class,'IsActive'=>true,'IsDeleted'=>false],'class','ClassId'),/********Class***********/

                            'InsertDate'=>date('y-m-d'),/********InsertDate***********/

                            'IsActive'=>true/********Subject name********** */

                        );/*********Subject array******** */

                    $CheckSubject = $this->Admindb->CheckConditionData(['SubjectName'=>$SubjectData['SubjectName'],'ClassId'=>$SubjectData['ClassId'],'IsDeleted'=>false],'subject');/************get condition data ************ */

                        if($CheckSubject == false){/*********if data exist********* */

                            $SubjectInserted = $this->Admindb->InsertData($SubjectData,'subject'); /** Database Subject Inserted **/

                        }/*********end of if condition********** */

                    }/**********end of foreach loop********** */

                    if ($SubjectInserted) {/****** Check If Subject Inserted *****/

                        $this->session->set_flashdata('InsertSubject', 'Subject Insert Successfully');

                        $this->session->set_flashdata('CheckStatus', 'True');

                        echo json_encode(['status'=>true,'message'=>'Subject Insert Successfully','data'=>null]);/******send jason data******* */

                        exit;/*****exit here******* */

                    }else{ /************ If Subject Not Insreted *********/

                        $this->session->set_flashdata('InsertSubject', 'There Is issue Please Try Again');

                        $this->session->set_flashdata('CheckStatus', 'False');

                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                    }/******inserted condition end*******/

                }else{/************* Fields Are Mandetory ***********/

                    $this->session->set_flashdata('InsertSubject', 'Insert Mandatory Form Fields!!');

                    $this->session->set_flashdata('CheckStatus', 'False');

                    echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/*******condition end here******* */

            }else{/********else user is not admin ******** */

                $this->session->set_flashdata('InsertSubject', 'You dont have Authority!!');

                $this->session->set_flashdata('CheckStatus', 'False');

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/*******condition end******* */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('SubjectId')) { /******** If Id Exist ***********/

                $SubjectId = $this->input->post('SubjectId');/*******subject id******** */

                $DeleteSubject = $this->Admindb->BlockRecord('subject',$SubjectId,'SubjectId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSubject) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['SubjectList'] = $this->Admindb->SimpleJoin(['subject.IsActive'=>true,'subject.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'subject','class','subject.ClassId = class.ClassId','Id','DESC','subject.Id,subject.SubjectId,subject.SubjectName,subject.InsertDate,class.ClassName');/********get list rows******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC');/********get list rows******** */

            $this->load->view('admin/pages/InsertSubject',$data);/********send to display view page********/

        }/*******end of else****** */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/******** function end ********/





    /*************** Insert InsertClass Function ****************/

    public function InsertClass($param1='')

    {/**********start of function************/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'Insert') { /**********if param is upload************ */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/ 

                if($this->input->post()){ /*********** Check Field mandetory **********/

                    $ClassId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random ClassId ******/

                    $ClassData = array( /********start of array******* */

                        'ClassId' => $ClassId,/********Class id********** */

                        'ClassName'=>$this->input->post('ClassName'),/********Class name***********/

                        'IsActive'=>true/********Class name********** */

                    );/*********Class array******** */

                    $CheckClass = $this->Admindb->CheckConditionData(['ClassName'=>$ClassData['ClassName'],'IsDeleted'=>false],'class');

                    if($CheckClass){

                            $this->session->set_flashdata('InsertClass', 'This Class Already Exist');

                            $this->session->set_flashdata('CheckStatus', 'False');

                            echo json_encode(['status'=>false,'message'=>'This Class Already Exist','data'=>null]);/******send jason data****** */

                            exit;/*******exit here****** */

                    }else{

                        $ClassInserted = $this->Admindb->InsertData($ClassData,'class'); /** Database class Inserted **/

                        if ($ClassInserted) {/****** Check If Class Inserted *****/

                            $this->session->set_flashdata('InsertClass', 'Class Insert Successfully');

                            $this->session->set_flashdata('CheckStatus', 'True');

                            echo json_encode(['status'=>true,'message'=>'Class Insert Successfully','data'=>null]);/******send jason data******* */

                            exit;/*****exit here******* */

                            

                            // return redirect('InsertClass');

                        }else{ /************ If Class Not Insreted *********/

                            $this->session->set_flashdata('InsertClass', 'There Is issue Please Try Again');

                            $this->session->set_flashdata('CheckStatus', 'False');

                            echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                            exit;/*******exit here****** */

                        }/******inserted condition end*******/



                            

                    }

                    

                }else{/************* Fields Are Mandetory ***********/

                    $this->session->set_flashdata('InsertClass', 'Insert Mandatory Form Fields!!');

                    $this->session->set_flashdata('CheckStatus', 'False');

                    echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/*******condition end here******* */

            }else{/********else user is not admin ******** */

                $this->session->set_flashdata('InsertClass', 'You dont have Authority!!');

                    $this->session->set_flashdata('CheckStatus', 'False');

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/*******condition end******* */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('ClassId')) { /******** If Id Exist ***********/

                $ClassId = $this->input->post('ClassId');/*******subject id******** */

                $DeleteSubject = $this->Admindb->BlockRecord('class',$ClassId,'ClassId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSubject) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/InsertClass',$data);/********send to display view page********/

        }/*******end of else****** */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/******** function end ********/





    /*************** Insert ManageSyllabus Function ****************/

    public function ManageSyllabus($param1='')

    {/**********start of function************/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'Insert') { /**********if param is upload************ */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/ 

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

                        'Subject'=>$this->input->post('Subject'),/********Subject name***********/

                        'Class'=>$this->input->post('Class'),/********Class***********/

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

            }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/*******condition end******* */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                $SyllabusId = $this->input->post('SyllabusId');/*******Syllabus id****** */

                if (!is_dir('./uploads/Syllabus/'.$SyllabusId.'')) {/********check if folder not exist******** */

                    mkdir('./uploads/Syllabus/'.$SyllabusId.'', 0777, TRUE);/*****create mkdir*******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $Syllabus = [ /********Syllabus Config ********/

                    'upload_path' => './uploads/Syllabus/'.$SyllabusId.'/', /********upload path******* */

                    'allowed_types' => 'pdf|docx' /*********allowed types********/

                ];/******config end********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                /********upload Syllabus ******/

                $this->upload->initialize($Syllabus); /*****Initialize Syllabus ****/

                if ($this->upload->do_upload('Syllabus') /***** Upload Syllabus ****/) { /***** Check Syllabus File Upload *****/

                    $Syllabus = $this->upload->data(); /****** push Array ************/

                    $Data = array(/*******data array******* */

                        'Syllabus'=>base_url('uploads/Syllabus/').$SyllabusId."/".$Syllabus['raw_name'].$Syllabus['file_ext'],/********Syllabus Logo*********/

                    ); /*******data array end********/

                    $UpdateData = $this->Admindb->UpdateData($Data,'syllabus',$SyllabusId,'SyllabusId'); /** Database Syllabus Update **/

                    if ($UpdateData) {/****** Check If user Updated */

                        echo json_encode(['status'=>true,'message'=>'Syllabus Update Successfully','data'=>null]);/*******send jason data***** */

                        exit;/******exit here****** */

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                        exit;/********exit here******** */

                    }/******condition end******* */

                }else{/*******else logo not uploaded******** */

                    echo json_encode(['status'=>false,'message'=>'No File To Update','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******** */

                }/***** End of DoctorImage file check *****/

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for syllabus Detail *********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                if ($this->input->post('SyllabusId')) { /******** If Id Exist ***********/

                    $SyllabusId = $this->input->post('SyllabusId');/*******syllabus Id********/

                    $RowData = $this->Admindb->RowData('SyllabusId',$SyllabusId,'syllabus');/******get syllabus details *****/

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

            }else{/*******else******* */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ****/

            }/*********End of condition********* */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

             $data['SyllabusList'] = $this->Admindb->TwoJoin(['syllabus.IsActive'=>true,'syllabus.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'syllabus','class','syllabus.Class = class.ClassId','subject','syllabus.Subject = subject.SubjectId','Id','DESC','syllabus.Id,syllabus.SyllabusId,syllabus.Syllabus,syllabus.InsertDate,class.ClassName,subject.SubjectName');/********get list rows******** */

             

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC');/********get list rows******** */

            $this->load->view('admin/pages/ManageSyllabus',$data);/********send to display view page********/

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/******** function end ********/



    // /*************** Insert Holidays Function ****************/

    // public function ManageHolidays($param1='')

    // {/**********start of ManageHolidays function******** */

    //     if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is superadmin ****/

    //     if ($param1 == 'Holiday') {/*******if param is Holiday****** */

    //         if($this->input->post()){ /*********** Check Field mandetory **********/

    //                $HolidayId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random HolidayId ******/

    //                $HolidayData = array(/******Holiday data array****** */

    //                    'HolidayId' => $HolidayId,/*******Holiday id********/

    //                    'HolidayTitle'=>$this->input->post('HolidayTitle'),/*******Holiday title******* */

    //                    'HolidayDetails'=>$this->input->post('HolidayDetails'),/*******Holiday details****** */

    //                    'HolidayDate'=>date("Y-m-d", strtotime($this->input->post('HolidayDate'))),/*******Holiday date****** */

    //                    'UploadDate'=>date('y-m-d')/*******upload date********/

    //                );/**********end of array******** */

    //                $HolidayInserted = $this->Admindb->InsertData($HolidayData,'holiday'); /** Database Holiday Inserted **/

    //                if ($HolidayInserted) {/****** Check If user Inserted ******/

    //                    echo json_encode(['status'=>true,'message'=>'Holiday Insert Successfully','data'=>null]);/*******send jason data****** */

    //                    exit;/*******exit here******* */

    //                }else{ /************ If user Not Insreted *********/

    //                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*******send jason data****** */

    //                    exit;/*******exit here****** */

    //                }/*********end of else check******* */

    //        }else{/************* Fields Are Mandetory ***********/

    //            echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/********send jason data***** */

    //            exit;/*********exit here********* */

    //        }/********end of condition******** */

    //     }else{ /**********else no language given********** */

    //         $language = $this->session->userdata('language');/**********language session********** */

    //         if($language == 'Urdu'){ /******** If language is Urdu ********/

    //             $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

    //         }else{ /******* If Language Is English **********/

    //             $data['Word'] = 'English'; /********* Word array Is English ********/

    //         }/*********End of condition**********/

    //         $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

    //         /******** Language Get from model**********/

    //         $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

    //         $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //         $data['HolidayList'] = $this->Admindb->HolidayList();/*********Event List******** */

    //         $data['ClassList'] = $this->Admindb->getdata(['IsDeleted'=>false],'syllabus','Id','DESC');/********get list rows******** */

    //         $this->load->view('admin/pages/ManageHolidays',$data);/********hit ManageHolidays view******** */

    //     }/*********end of condition********* */

    //     }else{/*******else user is not admin********* */

    //         return redirect('admin');/*********return redirect to admin********* */

    //     }/*******end of condition******** */

    // }/**********end of function********* */





    /*************** Insert Exam Function ****************/

    public function ManageExams($param1='')

    {/**********start of ManageExams function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is superadmin ****/

        if ($param1 == 'Exam') {/*******if param is Exam****** */

            if($this->input->post()){ /*********** Check Field mandetory **********/

                $ExamId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random ExamId ******/

                $dt = date("Y-m-d", strtotime($this->input->post('ExamDate')));

                $dt = strtotime($dt);

                $ExamData = array(/******Exam data array****** */

                    'ExamId' => $ExamId,/*******Exam id********/

                    'ClassId'=>$this->input->post('Class'),/*******Class********/

                    'SubjectId'=>$this->input->post('Subject'),/*******Exam details****** */

                    'ExamDate'=>date("Y-m-d", strtotime($this->input->post('ExamDate'))),/*******Exam date****** */

                    'ExamDateLimit'=>date("Y-m-d", strtotime("+2 month", $dt)),/*******Exam date****** */

                    'ExamTime'=>$this->input->post('ExamTime')/*******upload date********/

                );/**********end of array******** */

                $Class = $this->Admindb->CheckConditionData(['ClassId'=>$ExamData['ClassId'],'ExamDate'=>$ExamData['ExamDate'],'IsDeleted'=> false],'examstimetable');



                $ExamRow = $this->Admindb->CheckConditionData(['ClassId'=>$ExamData['ClassId'], 'SubjectId'=>$ExamData['SubjectId'],'ExamDateLimit>='=>$ExamData['ExamDate'],'IsDeleted'=> false],'examstimetable');

 

                if($Class){

                    echo json_encode(['status'=>false,'message'=>'Class already inserted in this date','data'=>null]);/*******send jason data****** */

                    exit;/*******exit here******* */

                }elseif($ExamRow){

                    echo json_encode(['status'=>false,'message'=>'Exam already taken for this subject','data'=>null]);/*******send jason data****** */

                    exit;/*******exit here******* */

                }else{

                    $ExamInserted = $this->Admindb->InsertData($ExamData,'examstimetable'); /** Database Exam Inserted **/

                    if ($ExamInserted) {/****** Check If user Inserted ******/

                        echo json_encode(['status'=>true,'message'=>'Exam Insert Successfully','data'=>null]);/*******send jason data****** */

                        exit;/*******exit here******* */

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*******send jason data****** */

                        exit;/*******exit here****** */

                    }/*********end of else check******* */

                }

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/********send jason data***** */

               exit;/*********exit here********* */

           }/********end of condition******** */

        }else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['ExamsList'] = $this->Admindb->TwoJoin(['examstimetable.IsActive'=>true,'examstimetable.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'examstimetable','subject','examstimetable.SubjectId = subject.SubjectId','class','examstimetable.ClassId = class.ClassId','Id','ASC','examstimetable.Id,examstimetable.ExamId,examstimetable.ExamDate,examstimetable.ExamTime,subject.SubjectName,class.ClassName');/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC');/********get list rows******** */

            

            $this->load->view('admin/pages/ManageExams',$data);/********hit ManageExams view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */





    /*************** Insert Schedule Function ****************/

    public function ManageSchedule($param1='')

    {/**********start of ManageSchedule function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is superadmin ****/

        if ($param1 == 'Schedule') {/*******if param is Schedule****** */

            if($this->input->post()){ /*********** Check Field mandetory **********/

                   $ScheduleId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random ScheduleId ******/

                   $ScheduleData = array(/******Schedule data array****** */

                       'ScheduleId' => $ScheduleId,/*******Schedule id********/

                       'ScheduleTitle'=>$this->input->post('ScheduleTitle'),/*******Schedule title******* */

                       'ScheduleDetails'=>$this->input->post('ScheduleDetails'),/*******Schedule details****** */

                       'StartDate'=>date("Y-m-d", strtotime(substr($this->input->post('ScheduleDate'), 1,9))),/*******Schedule date****** */

                       'EndDate'=>date("Y-m-d", strtotime(substr($this->input->post('ScheduleDate'),-10))),/*******Schedule date****** */

                       'UploadDate'=>date('y-m-d')/*******upload date********/

                   );/**********end of array******** */

                   $ScheduleInserted = $this->Admindb->InsertData($ScheduleData,'schedule'); /** Database Schedule Inserted **/

                   if ($ScheduleInserted) {/****** Check If user Inserted ******/

                       echo json_encode(['status'=>true,'message'=>'Schedule Insert Successfully','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here******* */

                   }else{ /************ If user Not Insreted *********/

                       echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here****** */

                   }/*********end of else check******* */

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/********send jason data***** */

               exit;/*********exit here**********/

           }/********end of condition******** */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('ScheduleId')) { /******** If Id Exist ***********/

                $ScheduleId = $this->input->post('ScheduleId');/*******Syllabus id******** */

                $DeleteSyllabus = $this->Admindb->BlockRecord('schedule',$ScheduleId,'ScheduleId',['IsDeleted'=>true]);/********delete record********* */

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "View"){/*********** Request for syllabus Detail *********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

                if ($this->input->post('ScheduleId')) { /******** If Id Exist ***********/

                    $ScheduleId = $this->input->post('ScheduleId');/*******syllabus Id********/

                    $RowData = $this->Admindb->RowData('ScheduleId',$ScheduleId,'schedule');/******get syllabus details *****/

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

            }else{/*******else******* */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == 'Edit') {/******* if param is Schedule *******/

            if($this->input->post()){ /*********** Check Field mandetory **********/

                   $ScheduleId = $this->input->post('ScheduleId'); /****Random ScheduleId ******/

                   $ScheduleData = array(/******Schedule data array*******/

                       'ScheduleTitle'=>$this->input->post('ScheduleTitle'),/*******Schedule title******* */

                       'ScheduleDetails'=>$this->input->post('ScheduleDetails'),/*******Schedule details****** */

                       'StartDate'=>date("Y-m-d", strtotime(substr($this->input->post('ScheduleDate'), 1,9))),/*******Schedule date****** */

                       'EndDate'=>date("Y-m-d", strtotime(substr($this->input->post('ScheduleDate'),-10))),/*******Schedule date****** */

                       'UploadDate'=>date('y-m-d')/*******upload date********/

                   );/**********end of array******** */

                   $UpdateData = $this->Admindb->UpdateData($ScheduleData,'schedule',$ScheduleId,'ScheduleId'); /** Database Syllabus Update **/

                   if ($UpdateData) {/****** Check If user Inserted ******/

                       echo json_encode(['status'=>true,'message'=>'Schedule Edit Successfully','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here******* */

                   }else{ /************ If user Not Insreted *********/

                       echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here****** */

                   }/*********end of else check******* */

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/********send jason data***** */

               exit;/*********exit here********* */

           }/********end of condition******** */

        }else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['ScheduleList'] = $this->Admindb->ScheduleList();/*********Event List******** */

            $this->load->view('admin/pages/ManageSchedule',$data);/********hit ManageSchedule view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */



    /*************** Insert Recruitment Function ****************/

    public function Recruitment($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'InsertCandidate') { /**********if param is upload************ */

             if($this->input->post()){ /*********** Check Field mandetory **********/

                $cv = [/********* CV Config ***********/

                    'upload_path' => './uploads/CandidateCv/',/********path to upload file******* */

                    'allowed_types' => 'pdf|doc|docx',/*******types allowed******** */

                ];/*********end of config****** */

               /**********Configration End ***********/

                 $this->load->library('upload'); /***** Upload File Library *******/

                 $this->upload->initialize($cv);/*****Initialize Cv ****/

                 if ($this->upload->do_upload('Cv')/***** Upload Cv ****/) { /***** Check CV File Upload *****/

                     $CandidateCV = $this->upload->data();/****** push Array ************/

                 }else{/******else file not given******** */

                     /****** File Validation Run ******/

                     $errorcv = $this->upload->display_errors();/*******display eerror function******* */

                     $errorcv = trim($errorcv, "<p></");/*******trim para from result******** */

                     echo json_encode(['status'=>false,'message'=>'Cv '.$errorcv,'data'=>null]);/*******send jason data******* */

                     $CandidateCV = $this->upload->data();/*******set cv null******** */

                     exit;/********exit here******* */

                 }/******* End of CV Check file */

                 if($CandidateCV['file_name'] == null){/***** Check File Upload *****/

                    /****** echo files not upload ******/

                        echo json_encode(['status'=>false,'message'=>'There Is Some Error While File Uploading Upload File Again.','data'=>null]);/*********send jason data********* */

                        exit;/********exit here************ */

                    }else{/****** progress on file upload *******/

                        $Cv = $CandidateCV['raw_name'].$CandidateCV['file_ext'];/********cv file********** */

                        $RecruitmentId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random RecruitmentId ******/

                        $RecruitmentData = array( /********start of array******* */

                            'RecruitmentId' => $RecruitmentId,/********Recruitment id********** */

                            'CandidateName'=>$this->input->post('CandidateName'),/********Employee Id********** */

                            'EmailAddress'=>$this->input->post('EmailAddress'),/********Recruitment name********** */

                            'PhoneNumber'=>$this->input->post('PhoneNumber'),/********Recruitment name********** */

                            'Address'=>$this->input->post('Address'),/********Recruitment name********** */

                            'Date'=>date("Y-m-d"),/********Recruitment name********** */

                            'Cv'=>$Cv,/********Recruitment name********** */

                            'IsActive'=> true,/********Recruitment name********** */

                        );/*********Recruitment array*********/

                        $checkEmail = $this->Admindb->CheckConditionData(['EmailAddress'=>$RecruitmentData['EmailAddress'],'IsDeleted'=>false],'recruitment');

                        $checkEmailemployee = $this->Admindb->CheckConditionData(['EmailAddress'=>$RecruitmentData['EmailAddress'],'IsDeleted'=>false],'employee');

                        if($checkEmail || $checkEmailemployee){

                            echo json_encode(['status'=>false,'message'=>'This email already exist try other email','data'=>null]);/******send jason data****** */

                                exit;/*******exit here****** */

                        }else{

                            $RecruitmentInserted = $this->Admindb->InsertData($RecruitmentData,'recruitment'); /** Database Recruitment Inserted **/

                            if ($RecruitmentInserted) {/****** Check If Recruitment Inserted ******/

                                echo json_encode(['status'=>true,'message'=>'Recruitment Insert Successfully','data'=>null]);/******send jason data******* */

                                exit;/*****exit here******* */

                            }else{ /************ If Recruitment Not Insreted *********/

                                echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                                exit;/*******exit here****** */

                            }/******inserted condition end****** */

                        }

                    }

            }else{/************* Fields Are Mandetory ***********/

                echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/*******condition end here******* */

        }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                $RecruitmentId = $this->input->post('RecruitmentId');/*******Recruitment id******** */

                $DeleteRecruitment = $this->Admindb->BlockRecord('recruitment',$RecruitmentId,'RecruitmentId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteRecruitment) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            $Active = "";/*******blank active****** */

            if($this->input->post('IsShortlisted') == 1){/******if is active is one****** */

                $Active = true; /*******set as true****** */

            }else{/*******else ****** */

                $Active = false;/******set as false****** */

            }/******condition end****** */

            $RecruitmentId = $this->input->post('RecruitmentId');/*******Recruitment id****** */

            $Data = array(/*******data array******* */

                'CandidateName'=>$this->input->post('CandidateName'), /*******Candidate Name****** */

                'PhoneNumber'=>$this->input->post('PhoneNumber'), /*******Recruitment PhoneNumber****** */

                'IsShortlisted'=> $Active/******is active****** */

            ); /*******data array end******* */

            $UpdateData = $this->Admindb->UpdateData($Data,'recruitment',$RecruitmentId,'RecruitmentId'); /** Database Recruitment Update **/

                if ($UpdateData) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'Recruitment Update Successfully','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******** */

                }/******condition end********/

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for Recruitment Detail *********/

            if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                $RecruitmentId = $this->input->post('RecruitmentId');/*******Recruitment Id******* */

                $RowData = $this->Admindb->RowData('RecruitmentId',$RecruitmentId,'recruitment');/******get Recruitment details *****/

                if ($RowData) {/*******if data exist******* */

                    echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                    exit; /*******exit here******** */

                }else{/**********else********* */

                    echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                    exit;/******exit here****** */

                }/********condition end******* */

            }else{/*********** If Id Not Exist **********/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                exit;/*****exit****** */

            }/********end of condition view******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['RecruitmentList'] = $this->Admindb->getdata(['IsShortlisted'=>false,'IsDeleted'=>false],'recruitment','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/Recruitment',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */



     /*************** Insert ShortListed Function ****************/

     public function Shortlisted($param1='')

     {/**********start of function*********** */

         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

           if($param1 == "Delete") {/********* If Request Is for Delete**********/

             if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

             if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                 $RecruitmentId = $this->input->post('RecruitmentId');/*******ShortListed id******** */

                 $DeleteShortListed = $this->Admindb->UpdateData(['IsDeleted'=>true],'recruitment',$RecruitmentId,'RecruitmentId');/********delete record********* */

                 if ($DeleteShortListed) {/********* If Data Deleted Successfully ***********/

                     echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */

                     exit;/***** exit here ****** */

                 }else{/********** Id data not deleted */

                     echo json_encode(['status'=>false,'message'=>'Data Not Deleted Try Again!!','data'=>null]);/******send jason****** */

                     exit;/*******exit here*******/

                 }/******condition end here*******/

             }else{/*********** If Id Not Found ************/

                 echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

                 exit;/*******exit here******* */

             }/********end of condition******** */

         }else{/********else user is not admin ******** */

                 echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                 exit;/******exit here******* */

         }/*******condition end******* */

         }elseif ($param1 == "Select") {/********* If Request Is for Delete**********/

             if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

             if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                 $RecruitmentId = $this->input->post('RecruitmentId');/*******ShortListed id******** */

                 $SelectShortlisted = $this->Admindb->UpdateData(['IsSelected'=>true],'recruitment',$RecruitmentId,'RecruitmentId');/********delete record********* */

                 if ($SelectShortlisted) {/********* If Data Deleted Successfully ***********/

                     echo json_encode(['status'=>true,'message'=>'User Selected Successfully!!','data'=>null]);/********send jason data****** */

                     exit;/***** exit here ****** */

                 }else{/********** Id data not deleted *******/

                     echo json_encode(['status'=>false,'message'=>'User Not Selected Try Again!!','data'=>null]);/******send jason****** */

                     exit;/*******exit here****** */

                 }/******condition end here****** */

             }else{/*********** If Id Not Found ************/

                 echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Select!!','data'=>null]);/******send jason data****** */

                 exit;/*******exit here******* */

             }/********end of condition******** */

         }else{/********else user is not admin ******** */

                 echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                 exit;/******exit here******* */

         }/*******condition end******* */

         }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

             if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

             $Active = "";/*******blank active****** */

             if($this->input->post('IsInterview') == 1){/******if is active is one****** */

                 $Active = true; /*******set as true****** */

             }else{/*******else ****** */

                 $Active = false;/******set as false****** */

             }/******condition end****** */

             $RecruitmentId = $this->input->post('RecruitmentId');/*******ShortListed id****** */

             $Data = array(/*******data array******* */

                 'InterViewTime'=>$this->input->post('InterViewTime'), /*******Candidate Name****** */

                 'IsInterview'=> $Active/******is active****** */

             ); /*******data array end******* */

             $UpdateData = $this->Admindb->UpdateData($Data,'recruitment',$RecruitmentId,'RecruitmentId'); /** Database ShortListed Update **/

                 if ($UpdateData) {/****** Check If user Updated */

                     echo json_encode(['status'=>true,'message'=>'Candidate Data Update Successfully','data'=>null]);/*******send jason data***** */

                     exit;/******exit here****** */

                 }else{ /************ If user Not Insreted *********/

                     echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                     exit;/********exit here******** */

                 }/******condition end********/

             }else{/*******else******* */

                     echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                     exit;/******exit here****** */

             }/*****user permission condition end ******** */

         }elseif($param1 == "View"){/*********** Request for Recruitment Detail *********/

             if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                 $RecruitmentId = $this->input->post('RecruitmentId');/*******Recruitment Id******* */

                 $RowData = $this->Admindb->RowData('RecruitmentId',$RecruitmentId,'recruitment');/******get Recruitment details *****/

                 if ($RowData) {/*******if data exist******* */

                     echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                     exit; /*******exit here******** */

                 }else{/**********else********* */

                     echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                     exit;/******exit here****** */

                 }/********condition end******* */

             }else{/*********** If Id Not Exist **********/

                 echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                 exit;/*****exit****** */

             }/********end of condition view******** */

         }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

             $data['ShortListedList'] = $this->Admindb->getdata(['IsSelected'=>false,'IsShortlisted'=>true,'IsDeleted'=>false],'recruitment','Id','DESC');/********get list rows******** */

             $this->load->view('admin/pages/Shortlisted',$data);/********send to display view page******* */

         }/*******end of else****** */

     }else{/*******else user is not admin******* */

         return redirect('admin');/*******return redirect to admin******* */

     }/******admin condition end******* */

     }/********function end******* */





       /*************** Insert Selected Function ****************/

    public function Selected($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

          if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('RecruitmentId')) { /******** If Id Exist ***********/

                $RecruitmentId = $this->input->post('RecruitmentId');/******* Selected id *********/

                $DeleteSelected = $this->Admindb->UpdateData(['IsDeleted'=>false],'recruitment',$RecruitmentId,'RecruitmentId');/********delete record********* */

                if ($DeleteSelected) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['SelectedList'] = $this->Admindb->getdata(['IsSelected'=>true,'IsHired'=>false,'IsDeleted'=>false],'recruitment','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/Selected',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */





    /*************** Insert JobResponsibility Function ****************/

    public function JobResponsibility($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'InsertJobType') { /**********if param is upload************ */

             if($this->input->post()){ /*********** Check Field mandetory **********/

               /**********Configration End ***********/

                $JobTypeId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random JobTypeId ******/

                $JobTypeData = array( /********start of array********/

                    'JobTypeId' => $JobTypeId,/********JobType id***********/

                    'JobType'=>$this->input->post('JobType'),

                    'IsActive'=> true,/********JobType name***********/

                );/*********JobType array*********/

                $JobTypeInserted = $this->Admindb->InsertData($JobTypeData,'jobtype'); /** Database JobType Inserted **/

                if ($JobTypeInserted) {/****** Check If JobType Inserted ******/

                    echo json_encode(['status'=>true,'message'=>'JobType Insert Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                    exit;/*******exit here****** */

                }/******inserted condition end****** */

            }else{/************* Fields Are Mandetory ***********/

                echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/*******condition end here******* */

        }elseif ($param1 == 'InsertDescription') { /**********if param is upload************ */

            if($this->input->post()){ /*********** Check Field mandetory **********/

              /**********Configration End ***********/

               $JobTypeId = $this->input->post('JobTypeId'); /**** JobTypeId ******/

               $JobTypeData = array( /********start of array********/

                   'JobDescription'=>$this->input->post('JobDescription'),

                   'IsDescribed'=> true,/********JobType name***********/

               );/*********JobType array*********/

               $JobTypeInserted = $this->Admindb->UpdateData($JobTypeData,'jobtype',$JobTypeId,'JobTypeId'); /** Database JobType Inserted **/

               if ($JobTypeInserted) {/****** Check If JobType Inserted ******/

                   echo json_encode(['status'=>true,'message'=>'Description Insert Successfully','data'=>null]);/******send jason data******* */

                   exit;/*****exit here******* */

               }else{ /************ If JobType Not Insreted *********/

                   echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                   exit;/*******exit here****** */

               }/******inserted condition end****** */

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

               exit;/*******exit here******* */

           }/*******condition end here******* */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('JobTypeId')) { /******** If Id Exist ***********/

                $JobTypeId = $this->input->post('JobTypeId');/*******JobType id******** */

                $DeleteJobType = $this->Admindb->BlockRecord('jobtype',$JobTypeId,'JobTypeId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteJobType) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/

                $JobTypeId = $this->input->post('JobTypeId'); /**** JobTypeId ******/

                $JobTypeData = array( /********start of array********/

                    'JobDescription'=>$this->input->post('JobDescription'),

                    'IsDescribed'=> true,/********JobType name***********/

                );/*********JobType array*********/

                $JobTypeEdited = $this->Admindb->UpdateData($JobTypeData,'jobtype',$JobTypeId,'JobTypeId'); /** Database JobType Inserted **/

                if ($JobTypeEdited) {/****** Check If JobType Edited ******/

                    echo json_encode(['status'=>true,'message'=>'Description Edit Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                }/******Edited condition end****** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for jobtype Detail *********/

            if ($this->input->post('JobTypeId')) { /******** If Id Exist ***********/

                $JobTypeId = $this->input->post('JobTypeId');/*******jobtype Id******* */

                $RowData = $this->Admindb->RowData('JobTypeId',$JobTypeId,'jobtype');/******get jobtype details*****/

                if ($RowData) {/*******if data exist******* */

                    echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                    exit; /*******exit here******** */

                }else{/**********else********* */

                    echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                    exit;/******exit here****** */

                }/********condition end******* */

            }else{/*********** If Id Not Exist **********/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                exit;/*****exit****** */

            }/********end of condition view******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['JobeTypeList'] = $this->Admindb->getdata(['IsDeleted'=>false],'jobtype','Id','DESC');/********get list rows******** */

            $data['RemainJobType'] = $this->Admindb->getconditiondata('IsDescribed',false,'jobtype');/********get list rows******** */

            $data['DescribedJob'] = $this->Admindb->getconditiondata('IsDescribed',true,'jobtype');/********get list rows******** */

            $this->load->view('admin/pages/JobResponsibility',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */





    /*************** Insert HireCandidate Function ****************/

    public function HireCandidate($param1='',$param2='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'GetForm') { /**********if param is upload************ */

            /**********Configration End ***********/

                $RecruitmentId = $param2; /****Random RecruitmentId ******/

                $UserData = $this->Admindb->RowData('RecruitmentId',$RecruitmentId,'recruitment');/******get jobtype details*****/



                $Data['EmployeeData'] = array(

                    'EmployeeId'=> rand(1, 100000).''.rand(1,100000),

                    'RecruitmentId'=>$UserData->RecruitmentId,

                    'EmployeeName'=>$UserData->CandidateName,

                    'EmailAddress'=>$UserData->EmailAddress,

                    'PhoneNumber'=>$UserData->PhoneNumber,

                    'Address'=>$UserData->Address,

                    'Cv'=>$UserData->Cv,

                    'IsActive'=>true

                );

                

                $language = $this->session->userdata('language');/**********language session********** */

                if($language == 'Urdu'){ /******** If language is Urdu ********/

                    $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

                }else{ /******* If Language Is English **********/

                    $Data['Word'] = 'English'; /********* Word array Is English ********/

                }/*********End of condition**********/

                $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

                /******** Language Get from model**********/

                $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

                $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

                $this->load->view('admin/pages/InsertEmployee',$Data);/********send to display view page******* */

        }elseif ($param1 == 'InsertData') { /**********if param is upload************/

            if($this->input->post()){ /*********** Check Field mandetory **********/

              /**********Configration End ***********/

              $EmployeeId = rand(1, 100000).''.rand(1,100000); /****Random EmployeeId ******/

              if (!is_dir('./uploads/EmployeeImage/'.$EmployeeId.'')) {/********check if folder not exist******** */

                  mkdir('./uploads/EmployeeImage/'.$EmployeeId.'', 0777, TRUE);/*****create mkdir*******/

              }/******end of if****** */

              /*********Configrations to Upload Files */

              $EmployeeImage = [ /********EmployeeImage Config ********/

                  'upload_path' => './uploads/EmployeeImage/'.$EmployeeId.'/',/********upload path******* */

                  'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                  // 'allowed_types' => '*',

              ];/******config end********/

              /**********Configration End ***********/

              $this->load->library('upload'); /***** Upload File Library *******/

              /********upload EmployeeImage ******/

              $this->upload->initialize($EmployeeImage); /*****Initialize EmployeeImage ****/

              if ($this->upload->do_upload('EmployeeImage') /***** Upload EmployeeImage ****/) { /***** Check EmployeeImage File Upload *****/

                  $EmployeeImage = $this->upload->data(); /****** push Array ************/

                  $EmployeeData = array( /********start of array******* */

                    'EmployeeId' => $EmployeeId,/********Employee id***********/

                    'EmployeeName'=>$this->input->post('EmployeeName'),/********Employee EmployeeName***********/

                    'EmailAddress'=>$this->input->post('EmailAddress'),/********Employee EmailAddress***********/

                    'Password'=>$this->encryption->encrypt(rand(1,1000).''.rand(1,1000)),

                    'Designation'=>$this->input->post('Designation'),/********Employee Designation***********/

                    'PhoneNumber'=>$this->input->post('PhoneNumber'),/********Employee PhoneNumber***********/

                    'NationalIdentity'=>$this->input->post('NationalIdentity'),/********Employee NationalIdentity***********/

                    'Address'=>$this->input->post('Address'),/********Employee Address***********/

                    'EmployeeDetails'=>$this->input->post('EmployeeDetails'),/********Employee EmployeeDetails***********/

                    'Gender'=>$this->input->post('Gender'),/********Employee Gender***********/

                    'Cv'=>base_url('uploads/CandidateCv/'.$this->input->post('Cv')),

                    'EmployeeImage'=> base_url('uploads/EmployeeImage/').$EmployeeId."/".$EmployeeImage['raw_name'].$EmployeeImage['file_ext'],/********Company Logo*********/

                    'IsActive'=>true/********Employee IsActive********** */

                );/*********Employee array*********/

              }else{/*******else logo not uploaded******** */

                echo json_encode(['status'=>false,'message'=>'Upload Employee Image','data'=>null]);/******send jason data******* */

                exit;/*****exit here******* */

              }/***** End of Employee Image file check *****/

                $checkEmailemployee = $this->Admindb->CheckConditionData(['EmailAddress'=>$EmployeeData['EmailAddress'],'IsDeleted'=>false],'employee');

                if($checkEmailemployee){

                    echo json_encode(['status'=>false,'message'=>'This email already exist try other email','data'=>null]);/******send jason data****** */

                    exit;/*******exit here****** */

                }else{

                    $EmployeeInserted = $this->Admindb->InsertData($EmployeeData,'employee'); /** Database Employee Inserted **/

                    if ($EmployeeInserted) {/****** Check If employee Inserted ******/

                        $this->Admindb->UpdateData(['IsHired'=>true],'recruitment',$this->input->post('RecruitmentId'),'RecruitmentId'); /** Database recruitment Inserted **/

                        echo json_encode(['status'=>true,'message'=>'Employee Insert Successfully','data'=>null]);/******send jason data******* */

                        exit;/*****exit here******* */

                    }else{ /************ If recruitment Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                    }/******inserted condition end****** */

                }

              

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

               exit;/*******exit here******* */

           }/*******condition end here******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */





    /*************** Insert Employees Function ****************/

    public function Employees($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'InsertJobType') { /**********if param is upload************ */

             if($this->input->post()){ /*********** Check Field mandetory **********/

               /**********Configration End ***********/

                $JobTypeId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000).''.rand(1, 1000); /****Random JobTypeId ******/

                $JobTypeData = array( /********start of array********/

                    'JobTypeId' => $JobTypeId,/********JobType id***********/

                    'JobType'=>$this->input->post('JobType'),

                    'IsActive'=> true,/********JobType name***********/

                );/*********JobType array*********/

                $JobTypeInserted = $this->Admindb->InsertData($JobTypeData,'jobtype'); /** Database JobType Inserted **/

                if ($JobTypeInserted) {/****** Check If JobType Inserted ******/

                    echo json_encode(['status'=>true,'message'=>'JobType Insert Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                    exit;/*******exit here****** */

                }/******inserted condition end****** */

            }else{/************* Fields Are Mandetory ***********/

                echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/*******condition end here******* */

        }elseif ($param1 == 'InsertDescription') { /**********if param is upload************ */

            if($this->input->post()){ /*********** Check Field mandetory **********/

              /**********Configration End ***********/

               $JobTypeId = $this->input->post('JobTypeId'); /**** JobTypeId ******/

               $JobTypeData = array( /********start of array********/

                   'JobDescription'=>$this->input->post('JobDescription'),

                   'IsDescribed'=> true,/********JobType name***********/

               );/*********JobType array*********/

               $JobTypeInserted = $this->Admindb->UpdateData($JobTypeData,'jobtype',$JobTypeId,'JobTypeId'); /** Database JobType Inserted **/

               if ($JobTypeInserted) {/****** Check If JobType Inserted ******/

                   echo json_encode(['status'=>true,'message'=>'Description Insert Successfully','data'=>null]);/******send jason data******* */

                   exit;/*****exit here******* */

               }else{ /************ If JobType Not Insreted *********/

                   echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                   exit;/*******exit here****** */

               }/******inserted condition end****** */

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>false,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/******send jason data****** */

               exit;/*******exit here******* */

           }/*******condition end here******* */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('EmployeeId')) { /******** If Id Exist ***********/

                $EmployeeId = $this->input->post('EmployeeId');/*******employee id******** */

                $DeleteEmployee = $this->Admindb->BlockRecord('employee',$EmployeeId,'EmployeeId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteEmployee) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/

                $EmployeeId = $this->input->post('EmployeeId'); /**** EmployeeId ******/



                if (!is_dir('./uploads/EmployeeImage/'.$EmployeeId.'')) {/********check if folder not exist******** */

                    mkdir('./uploads/EmployeeImage/'.$EmployeeId.'', 0777, TRUE);/*****create mkdir*******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $EmployeeImage = [ /********EmployeeImage Config ********/

                    'upload_path' => './uploads/EmployeeImage/'.$EmployeeId.'/',/********upload path******* */

                    'allowed_types' => 'jpg|jpeg|png',/*********allowed types********/

                    // 'allowed_types' => '*',

                ];/******config end********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                /********upload EmployeeImage ******/

                $this->upload->initialize($EmployeeImage); /*****Initialize EmployeeImage ****/

                if ($this->upload->do_upload('EmployeeImage') /***** Upload EmployeeImage ****/) { /***** Check EmployeeImage File Upload *****/

                    $EmployeeImage = $this->upload->data(); /****** push Array ************/

                    $EmployeeData = array( /********start of array********/

                        'EmployeeName'=>$this->input->post('EmployeeName'),

                        'Designation'=>$this->input->post('Designation'),

                        'PhoneNumber'=>$this->input->post('PhoneNumber'),

                        'Address'=>$this->input->post('Address'),

                        'EmployeeImage'=> base_url('uploads/EmployeeImage/').$EmployeeId."/".$EmployeeImage['raw_name'].$EmployeeImage['file_ext'],/********Company Logo*********/

                    );/*********JobType array*********/

                }else{/*******else logo not uploaded******** */

                    $EmployeeData = array( /********start of array********/

                        'EmployeeName'=>$this->input->post('EmployeeName'),

                        'Designation'=>$this->input->post('Designation'),

                        'PhoneNumber'=>$this->input->post('PhoneNumber'),

                        'Address'=>$this->input->post('Address')

                    );/*********JobType array*********/

                }/***** End of Employee Image file check *****/

                

                $EmployeeUpdated = $this->Admindb->UpdateData($EmployeeData,'employee',$EmployeeId,'EmployeeId'); /** Database JobType Inserted **/

                if ($EmployeeUpdated) {/****** Check If JobType Edited ******/

                    echo json_encode(['status'=>true,'message'=>'Employee Edit Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                }/******Edited condition end****** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif ($param1 == "Posting") {/******* If Request Is for Posting/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/

                $EmployeeId = $this->input->post('EmployeeId'); /**** EmployeeId ******/

                $EmployeeData = array( /********start of array********/

                    'Posting'=>$this->input->post('SchoolId')

                );/*********JobType array*********/

                

                $EmployeeUpdated = $this->Admindb->UpdateData($EmployeeData,'employee',$EmployeeId,'EmployeeId'); /** Database JobType Inserted **/

                if ($EmployeeUpdated) {/****** Check If JobType Edited ******/

                    echo json_encode(['status'=>true,'message'=>'Action Perform Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                    exit;/*******exit here****** */

                }/******Edited condition end****** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }elseif($param1 == "View"){/*********** Request for employee Detail *********/

            if ($this->input->post('EmployeeId')) { /******** If Id Exist ***********/

                $EmployeeId = $this->input->post('EmployeeId');/*******employee Id******* */

                $RowData = $this->Admindb->RowData('EmployeeId',$EmployeeId,'employee');/******get employee details*****/

                if ($RowData) {/*******if data exist******* */

                    echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                    exit; /*******exit here******** */

                }else{/**********else********* */

                    echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                    exit;/******exit here****** */

                }/********condition end******* */

            }else{/*********** If Id Not Exist **********/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

                exit;/*****exit****** */

            }/********end of condition view******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['EmployeeList'] = $this->Admindb->getdata(['IsDeleted'=>false],'employee','Id','DESC');/********get list rows******** */

            $data['SchoolList'] = $this->Admindb->getdata(['IsDeleted'=>false],'school','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/Employees',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin********/

    }/******admin condition end******* */

    }/********function end******* */





    // /**********Download Files******** */

    // public function DownloadCSV($param='')

    // {/***********start of excel file download function********* */

    //     if($param == "Pharmacy"){/********if paaram is pharmacy******* */

    //         $this->load->helper('csv');/*********call Csv helper create by self********** */

    //         $ExportFile = array();/*********define empty array here******** */

    //         $PharmacyData = $this->Admindb->getdata(['IsDeleted'=>false],'pharmacy','Id','DESC');/*********get pharmacy data********* */

    //         $Header = array("Id", "PharmacyId", "PharmacyName", "UserName", "CitizenshipNumber", "RegistrationNumber",

    //         "PhoneNumber", "Gender", "PharmacyFoundationDate", "Address", "StartTime","EndTime",

    //         "SubscriptionStartDate", "SubscriptionEndDate", "CreationDate", "IsActive"

    //         );/*********array of head field names********** */

    //         array_push($ExportFile, $Header);/*******pish values to array********* */

    //         if (!empty($PharmacyData)) {/*******if data is exist of pharmacy******* */

    //             foreach ($PharmacyData as $Pharmacy) {/**********execute foreach loop to print data******* */

    //                 array_push($ExportFile, array($Pharmacy->Id, $Pharmacy->PharmacyId, $Pharmacy->PharmacyName, 

    //                 $Pharmacy->UserName,$Pharmacy->CitizenshipNumber, $Pharmacy->RegistrationNumber,

    //                 $Pharmacy->PhoneNumber,$Pharmacy->Gender,$Pharmacy->PharmacyFoundationDate,$Pharmacy->Address,

    //                 $Pharmacy->StartTime,$Pharmacy->EndTime,$Pharmacy->SubscriptionStartDate,

    //                 $Pharmacy->SubscriptionEndDate,$Pharmacy->CreationDate,$Pharmacy->IsActive

    //                 ));/***********push array fields result comes from database********** */

    //             }/********end of foreach loop******** */

    //         }/*********if data not empty condition end******* */

    //         convert_to_csv($ExportFile, 'Pharmacy' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    //     }elseif ($param == "Patient") {/**********else if param is patient********** */

    //         $this->load->helper('csv');/***********load scv helper created by self********** */

    //         $ExportFile = array();/**********empty export array ********* */

    //         $PatientData = $this->Admindb->getdata(['IsDeleted'=>false],'patient','Id','DESC');/************get data from database*********** */

    //         $Header = array("Id", "PatientId", "PatientName", "Email", "PhoneNumber", "NationalIdentity",

    //         "Gender", "DateOfBirth", "City", "InsuranceCoverage", "SubscriptionStartDate","SubscriptionEndDate",

    //         "IsActive"

    //         );/********header or head key name define********** */

    //         array_push($ExportFile, $Header);/********push array******* */

    //         if (!empty($PatientData)) {/********if patient data is not empty******* */

    //             foreach ($PatientData as $Patient) {/**********foreach run data to print multiple row********** */

    //                 array_push($ExportFile, array($Patient->Id, $Patient->PatientId, $Patient->PatientName, 

    //                 $Patient->Email,$Patient->PhoneNumber, $Patient->NationalIdentity,

    //                 $Patient->Gender,$Patient->DateOfBirth,$Patient->City,$Patient->InsuranceCoverage,

    //                 $Patient->SubscriptionStartDate,$Patient->SubscriptionEndDate,$Patient->IsActive

    //                 ));

    //             }

    //         }

    //         convert_to_csv($ExportFile, 'Patient' . date('F-d-Y') . '.csv', ',');

    //     }

    // }



    /**********Download Files******** */

    public function DownloadCSVIndividual($param='',$param2='')

    {/***********start of excel file download function********* */

        if($param == "Pharmacy"){/********if paaram is pharmacy******* */

            $this->load->helper('csv');/*********call Csv helper create by self********** */

            $ExportFile = array();/*********define empty array here******** */

            $Pharmacy = $this->Admindb->RowData('PharmacyId',$param2,'pharmacy');/*********get pharmacy data********* */

            $Header = array("Id", "PharmacyId", "PharmacyName", "UserName", "CitizenshipNumber", "RegistrationNumber",

            "PhoneNumber", "Gender", "PharmacyFoundationDate", "Address", "StartTime","EndTime",

            "SubscriptionStartDate", "SubscriptionEndDate", "CreationDate", "IsActive"

            );/*********array of head field names********** */

            array_push($ExportFile, $Header);/*******pish values to array********* */

            if (!empty($Pharmacy)) {/*******if data is exist of pharmacy******* */

                    array_push($ExportFile, array($Pharmacy->Id, $Pharmacy->PharmacyId, $Pharmacy->PharmacyName, 

                    $Pharmacy->UserName,$Pharmacy->CitizenshipNumber, $Pharmacy->RegistrationNumber,

                    $Pharmacy->PhoneNumber,$Pharmacy->Gender,$Pharmacy->PharmacyFoundationDate,$Pharmacy->Address,

                    $Pharmacy->StartTime,$Pharmacy->EndTime,$Pharmacy->SubscriptionStartDate,

                    $Pharmacy->SubscriptionEndDate,$Pharmacy->CreationDate,$Pharmacy->IsActive

                    ));/***********push array fields result comes from database********** */

            }/*********if data not empty condition end******* */

            convert_to_csv($ExportFile, 'Pharmacy' . $Pharmacy->PharmacyId . '.csv', ',');/***********convert and download csv file******** */

        }elseif ($param == "Patient") {/**********else if param is patient********** */

            $this->load->helper('csv');/***********load scv helper created by self********** */

            $ExportFile = array();/**********empty export array ********* */

            $Patient = $this->Admindb->RowData('PatientId',$param2,'patient');/*********get pharmacy data********* */

            $Header = array("Id", "PatientId", "PatientName", "Email", "PhoneNumber", "NationalIdentity",

            "Gender", "DateOfBirth", "City", "InsuranceCoverage", "SubscriptionStartDate","SubscriptionEndDate",

            "IsActive"

            );/********header or head key name define********** */

            array_push($ExportFile, $Header);/********push array******* */

            if (!empty($Patient)) {/********if patient data is not empty******* */

                    array_push($ExportFile, array($Patient->Id, $Patient->PatientId, $Patient->PatientName, 

                    $Patient->Email,$Patient->PhoneNumber, $Patient->NationalIdentity,

                    $Patient->Gender,$Patient->DateOfBirth,$Patient->City,$Patient->InsuranceCoverage,

                    $Patient->SubscriptionStartDate,$Patient->SubscriptionEndDate,$Patient->IsActive

                    ));/*********** array push ********* */

            }/************patient data end******* */

            convert_to_csv($ExportFile, 'Patient' . $Patient->PatientId . '.csv', ',');/***********download scv file********* */

        }/********** check if condition ********* */

    }/************end of download pharmacy*********** */







    /*************** Insert Invoice Function ****************/

    public function insertinvoice($param1='')

    {/******* start of invoice function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /********* if user is admin********** */

        if ($param1 == 'upload') {/********* if param is upload ********** */

             if($this->input->post()){ /*********** Check Field mandetory **********/

                $InvoiceId = rand(1, 1000).''.rand(1, 1000).''.rand(1, 1000); /****Random InvoiceId ******/

                $Invoice = $this->input->post('Item');/******** get product items******** */

                $InvoiceData = array(/******* start array ******** */

                    'InvoiceId'=> $InvoiceId,/***** invoice id *********** */

                    'InvoiceName'=> $this->input->post('InvoiceName'),/********** invoice name ********* */

                    'Invoice'=> $Invoice,/******** invoice ********** */

                    'Total'=> $this->input->post('Total'),/******** total amount********** */

                    'OnCreate'=>date('Y-m-d')/******* on create date************* */

                );/*********end of array ******** */

                $InvoiceInserted = $this->Admindb->InsertData($InvoiceData,'invoice'); /** Database Invoice Inserted **/

                if ($InvoiceInserted) {/****** Check If user Inserted */

                    echo json_encode(['status'=>true,'message'=>'Invoice Insert Successfully','data'=>null]);/*******send jason data ****** */

                    exit;/******exit here ********** */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*********send jason data***** */

                    exit;/*******exit here****** */

                }/*******end of check else******* */

            }else{/************* Fields Are Mandetory ***********/

                echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/*****send jason data*** */

                exit;/******exit here********* */

            }/*******end of else check mandatory****** */

        }else{/********** if param not give ********/

            $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           $this->load->view('admin/pages/InsertInvoice',$data); /******** hit insert invoice page******* */

        }/******** else end of check param ********** */

    }else{/***** else end of user check ****** */

            return redirect('admin');/***** return to admin********** */

    }/****** end of else admin check******** */

    }/********* end of functon insert invopice********** */





    /***************** Invoice List Function **************/

    public function invoicelist($param1="")

    {/***************** Invoice List Function start **************/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /********* check user is admin *********** */

        if ($param1 == "Delete") {/********* If Request Is for Delete**********/

            if ($this->input->post('InvoiceId')) { /******** If InvoiceId Exist ***********/

                $InvoiceId = $this->input->post('InvoiceId'); /******* InvoiceId ****** */

                $DeleteInvoice = $this->Admindb->UpdateData1(['InvoiceId'=>$InvoiceId],['IsDeleted'=>true],'invoice'); /** Database Invoice Inserted **/ /******* delete record******* */

                if ($DeleteInvoice) {/********* If Data Deleted Successfully ***********/

                    echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/*******send jason data***** */

                    exit;/*****exit here******* */

                }else{/********** Id data not deleted */

                    echo json_encode(['status'=>false,'message'=>'Data Not Deleted Try Again!!','data'=>null]);/*********send jason data******* */

                    exit;/*******exit here********** */

                }/*****check data is deleeted end********** */

            }else{/*********** If Id Not Found ************/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/****send jason data******* */

                exit;/*******exit here****** */

            }/***********end of else here***** */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

                $InvoiceId = $this->input->post('InvoiceId'); /******* invoice id****** */

                $Invoice = $this->input->post('Item');/******* items********** */

                $InvoiceData = array(/*********array ******* */

                    'Invoice'=> $Invoice,/*******invoice ******* */

                    'Total'=> $this->input->post('Total'),/****** total amount******** */

                    'IsPaid'=> $this->input->post('IsPaid'),/******* paid status******* */

                    'OnUpdate'=>date('Y-m-d')/********** on update******* */

                );/*****array end**** */

                $UpdateInvoice = $this->Admindb->UpdateData1(['InvoiceId'=>$InvoiceId,'IsDeleted'=>false],$InvoiceData,'invoice'); /** Database Invoice Inserted **/

                if ($UpdateInvoice) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'Invoice Update Successfully','data'=>null]);/****** send jason data***** */

                    exit;/******exit here****** */

                }else{ /************ If invoice Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/******send jason data******* */

                    exit;/********exit here******** */

                }/*******end of else here***** */

        }elseif($param1 == "View"){/*********** Request for Invoice Detail *********/

            if ($this->input->post('InvoiceId')) { /******** If Id Exist ***********/

                $Id = $this->input->post('InvoiceId');/****** invoice id****** */

                $InvoiceDetails = $this->Admindb->CheckUser($Id,'invoice','InvoiceId');/******get Invoice details *****/

                if ($InvoiceDetails) {/***** if detail exist**** */

                    $InvoiceData = array(/****** array started******** */

                        'InvoiceId'=> $InvoiceDetails->InvoiceId, /********* invoice id********* */

                        'InvoiceName'=> $InvoiceDetails->InvoiceName,/******** invoice name*********** */

                        'Total'=> $InvoiceDetails->Total,/******* total ********** */

                        'OnCreate'=> $InvoiceDetails->OnCreate,/******** on create************* */

                        'IsPaid'=> $InvoiceDetails->IsPaid/******** ispaid******** */

                    );/******* array end here******* */

                    $Invoice = json_decode($InvoiceDetails->Invoice);/******* decode invoice data******* */

                    echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$InvoiceData,'Invoice'=>$Invoice]);/*****send jason data******* */

                    exit;/**********exit here*********** */

                }else{/******else check ******* */

                    echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/******send jason data*** */

                    exit;/****** exit here******** */

                }/***** else here end******** */

            }else{/*********** If Id Not Exist **********/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/*******send jason data*** */

                exit;/*****exit herer***** */

            }/*****else id not end here****** */

        }/**********view end here****** */

        else{/********* Show Normal List Of Invoice **********/

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

            $data['InvoiceList'] = $this->Admindb->getdata(['IsDeleted'=>false],'invoice','Id','DESC');/******* send invoice list***** */

            $this->load->view('admin/pages/InvoiceList',$data);/****** hit invoice list page********* */

        }/****** end of else******* */

    }else{/****** user is not admin*********** */

        return redirect('admin');/****** redircrt admin******* */

    }/*********check admin end here********* */

    }/*********** invoice list function end here******* */



    /*************** Insert InsertStudent Function ****************/

    public function InsertStudent($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'InsertData') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                // var_dump($this->input->post()); die();

                $StudentId = rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000);

                if (!is_dir('./uploads/Students/'.$StudentId)) {/********check if folder not exist******** */

                    mkdir('./uploads/Students/'.$StudentId, 0777, TRUE);/***** create mkdir *******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $StudentImage = [ /******** cover Image ********/

                    'upload_path' => './uploads/Students/'.$StudentId.'/',/*****upload path***** */

                    'allowed_types' => 'jpg|jpeg|png'/******allowed types****** */

                ];/******array condition********/

                $File = [ /******** file ********/

                    'upload_path' => './uploads/Students/'.$StudentId.'/',/*****upload path***** */

                    'allowed_types' => '*'/******allowed types****** */

                ];/******array condition********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                 /********upload Profile Image ******/

                $this->upload->initialize($StudentImage); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('StudentImage') ) { /***** Check Profile Image File Upload *****/

                    $StudentImage = $this->upload->data(); /****** push Array ************/



                    $config['image_library'] = 'gd2';

                    $config['source_image'] = './uploads/Students/'.$StudentId.'/'.$StudentImage['file_name'];

                    $config['create_thumb'] = false;

                    $config['maintain_ratio'] = false;

                    $config['width']         = 500;

                    $config['height']       = 500;



                    $this->load->library('image_lib', $config);



                    $this->image_lib->resize();



                }else{

                    $StudentImage = null;

                }

                $this->upload->initialize($File); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('Document') ) { /***** Check File Upload *****/

                    $File = $this->upload->data(); /****** push Array ************/

                }else{

                    $File['file_name'] = "";

                }



                if($StudentImage != null){

                    $StudentData = array(

                        'StudentId'=> $StudentId,

                        'StudentName'=> $this->input->post('StudentName'),

                        'Password'=>$this->encryption->encrypt(rand(1,1000).''.rand(1,1000)),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name'],

                        'Document'=> $File['file_name'],

                        'InsertDate' => date('Y-m-d h:m:s'),

                        'IsActive' => true

                    );

                    $checkdata = $this->Admindb->CheckConditionData(['StudentGR'=>$this->input->post('StudentGR'),'IsDeleted'=>false],'students');

                    if($checkdata){

                        echo json_encode(['status'=>false,'message'=>'This GR No already assigned to other student','data'=>null]); /******* echo json data***** */

                    log_message('error', 'This GR No already assigned to other student'); /******insert log****** */

                    exit; /*****exit **** */

                    }else{

                        $InsertStudent = $this->Admindb->InsertData($StudentData,'students');

                    if($InsertStudent){

                        /********** send message ********** */

                        echo json_encode(['status'=>true,'message'=>'Student Insert Successfully','data'=>null]); /*******send jason data****** */

                        log_message('error', 'Student Insert Successfully'); /******insert log****** */

                        exit; /*****exit **** */

                    }else{

                        echo json_encode(['status'=>false,'message'=>'Network Problem Data Not Inserted','data'=>null]); /******* echo json data***** */

                        log_message('error', 'Network Problem Data Not Inserted'); /******insert log****** */

                        exit; /*****exit **** */

                    }

                    }

                    

                }else{

                    echo json_encode(['status'=>false,'message'=>'ProfileImage Required','data'=>null]); /******* echo json data***** */

                    log_message('error', 'Document And Image Both Required'); /******insert log****** */

                    exit; /*****exit **** */

                }

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******insert log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }else{

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $Data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           $Data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

           $Data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get class Data From Database ************/

           $Data['LastId'] = $this->Admindb->GetDec('1','students','Id','DESC','Id') + 1;

           $this->load->view('admin/pages/InsertStudent',$Data);/********send to display view page******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */



    /*************** StudentList Function ****************/

    public function StudentsList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'Edit') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                if (!is_dir('./uploads/Students/'.$this->input->post('StudentId'))) {/********check if folder not exist******** */

                    mkdir('./uploads/Students/'.$this->input->post('StudentId'), 0777, TRUE);/***** create mkdir *******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $StudentImage = [ /******** cover Image ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => 'jpg|jpeg|png'/******allowed types****** */

                ];/******array condition********/

                $File = [ /******** file ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => '*'/******allowed types****** */

                ];/******array condition********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                 /********upload Profile Image ******/

                $this->upload->initialize($StudentImage); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('StudentImage') ) { /***** Check Profile Image File Upload *****/

                    $StudentImage = $this->upload->data(); /****** push Array ************/



                    $config['image_library'] = 'gd2';

                    $config['source_image'] = './uploads/Students/'.$this->input->post('StudentId').'/'.$StudentImage['file_name'];

                    $config['create_thumb'] = false;

                    $config['maintain_ratio'] = false;

                    $config['width']         = 500;

                    $config['height']       = 500;



                    $this->load->library('image_lib', $config);



                    $this->image_lib->resize();



                }else{

                    $StudentImage = null;

                }

                $this->upload->initialize($File); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('Document') ) { /***** Check File Upload *****/

                    $File = $this->upload->data(); /****** push Array ************/

                }else{

                    $File = null;

                }

                if($File != null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name'],

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name']

                    );

                }elseif($File != null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender')

                    );

                }

                    $checkdata = $this->Admindb->CheckConditionData(['StudentId !='=> $this->input->post('StudentId'),'StudentGR'=>$this->input->post('StudentGR'),'IsDeleted'=>false],'students');

                    if($checkdata){

                        echo json_encode(['status'=>true,'message'=>'This GR No already assigned to another student','data'=>null]); /*******send jason data****** */

                        log_message('error', 'This GR No already assigned to another student'); /******Update log****** */

                        exit; /*****exit **** */

                    }else{

                        $UpdateStudent = $this->Admindb->UpdateData1(['StudentId'=>$this->input->post('StudentId')],$StudentData,'students');

                        if($UpdateStudent){

                            /********** send message ********** */

                            echo json_encode(['status'=>true,'message'=>'Student Update Successfully','data'=>null]); /*******send jason data****** */

                            log_message('error', 'Student Update Successfully'); /******Update log****** */

                            exit; /*****exit **** */

                        }else{

                            echo json_encode(['status'=>false,'message'=>'Network Problem Data Not Updateed','data'=>null]); /******* echo json data***** */

                            log_message('error', 'Network Problem Data Not Updateed'); /******Update log****** */

                            exit; /*****exit **** */

                        }

                    }

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******Update log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */

            $statusdata = $this->Admindb->SingleRowField(['StudentId'=>$StudentId,'IsDeleted'=>false],'students','IsActive');

            if($statusdata == true){
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false],'students',$StudentId,'StudentId');/********delete record********* */
            }else{
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>true],'students',$StudentId,'StudentId');/********delete record********* */

            }
            
            if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/

                echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */

                exit;/***** exit here ****** */

            }else{/********** Id data not Deactivfate */

                echo json_encode(['status'=>false,'message'=>'Student Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                exit;/*******exit here*******/

            }/******condition end here*******/

        }else{/*********** If Id Not Found ************/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

            exit;/*******exit here******* */

        }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "DeleteStudent") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/
    
            if ($this->input->post('StudentId')) { /******** If Id Exist ***********/
    
                $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */
    
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false,'IsDeleted'=>true],'students',$StudentId,'StudentId');/********delete record********* */
                
                
                if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/
    
                    echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */
    
                    exit;/***** exit here ****** */
    
                }else{/********** Id data not Deactivfate */
    
                    echo json_encode(['status'=>false,'message'=>'Student Not deleted Try Again!!','data'=>null]);/******send jason****** */
    
                    exit;/*******exit here*******/
    
                }/******condition end here*******/
    
            }else{/*********** If Id Not Found ************/
    
                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */
    
                exit;/*******exit here******* */
    
            }/********end of condition******** */
    
            }else{/********else user is not admin ******** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
            }/*******condition end******* */
    
            }elseif($param1 == "View"){/*********** Request for students Detail *********/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******students Id******* */

            $RowData = $this->Admindb->SimplesingleJoin(['students.StudentId' => $StudentId,'students.IsDeleted' =>false],'students','class','students.ClassId = class.ClassId','students.Id','ASC','*');/******get students details*****/

            

            if ($RowData) {/*******if data exist******* */

                $RowData->Password = $this->encryption->decrypt($RowData->Password);

                echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                exit; /*******exit here******** */

            }else{/**********else********* */

                echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                exit;/******exit here****** */

            }/********condition end******* */

        }else{/*********** If Id Not Exist **********/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

            exit;/*****exit****** */

        }/********end of condition view******** */

        }elseif($param1 == "Download"){

        /******** Check Email Is Unique Or Exist ********/

        if ($this->input->post()) {/*******if input post exist******** */

            $StudentId = $this->input->post('StudentId'); /*******get FileId****** */

            $StudDoc = $this->Admindb->RowData('StudentId',$StudentId,'students');/********Files data from database****** */

            if ($StudDoc) {/*********if Files exist********/

                $StudDoc->FileUrl = $StudDoc->Document;/*********** Add File Url to array *********** */

                echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$StudDoc]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }else{/******if Files not exist****** */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }/********if condition end***** */

        }else{/******if post not there********* */

            echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

            exit;/******* exit Here ********/

        }/*******end of condition***** */

        }else{

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $Data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/

           $Data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

           $Data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get class Data From Database ************/

           $this->load->view('admin/pages/StudentsList',$Data);/********send to display view page******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */


    /*************** StudentActiveList Function ****************/

    public function StudentsActiveList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'Edit') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                if (!is_dir('./uploads/Students/'.$this->input->post('StudentId'))) {/********check if folder not exist******** */

                    mkdir('./uploads/Students/'.$this->input->post('StudentId'), 0777, TRUE);/***** create mkdir *******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $StudentImage = [ /******** cover Image ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => 'jpg|jpeg|png'/******allowed types****** */

                ];/******array condition********/

                $File = [ /******** file ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => '*'/******allowed types****** */

                ];/******array condition********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                 /********upload Profile Image ******/

                $this->upload->initialize($StudentImage); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('StudentImage') ) { /***** Check Profile Image File Upload *****/

                    $StudentImage = $this->upload->data(); /****** push Array ************/



                    $config['image_library'] = 'gd2';

                    $config['source_image'] = './uploads/Students/'.$this->input->post('StudentId').'/'.$StudentImage['file_name'];

                    $config['create_thumb'] = false;

                    $config['maintain_ratio'] = false;

                    $config['width']         = 500;

                    $config['height']       = 500;



                    $this->load->library('image_lib', $config);



                    $this->image_lib->resize();



                }else{

                    $StudentImage = null;

                }

                $this->upload->initialize($File); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('Document') ) { /***** Check File Upload *****/

                    $File = $this->upload->data(); /****** push Array ************/

                }else{

                    $File = null;

                }

                if($File != null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name'],

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name']

                    );

                }elseif($File != null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender')

                    );

                }

                    $checkdata = $this->Admindb->CheckConditionData(['StudentId !='=> $this->input->post('StudentId'),'StudentGR'=>$this->input->post('StudentGR'),'IsDeleted'=>false],'students');

                    if($checkdata){

                        echo json_encode(['status'=>true,'message'=>'This GR No already assigned to another student','data'=>null]); /*******send jason data****** */

                        log_message('error', 'This GR No already assigned to another student'); /******Update log****** */

                        exit; /*****exit **** */

                    }else{

                        $UpdateStudent = $this->Admindb->UpdateData1(['StudentId'=>$this->input->post('StudentId')],$StudentData,'students');

                        if($UpdateStudent){

                            /********** send message ********** */

                            echo json_encode(['status'=>true,'message'=>'Student Update Successfully','data'=>null]); /*******send jason data****** */

                            log_message('error', 'Student Update Successfully'); /******Update log****** */

                            exit; /*****exit **** */

                        }else{

                            echo json_encode(['status'=>false,'message'=>'Network Problem Data Not Updateed','data'=>null]); /******* echo json data***** */

                            log_message('error', 'Network Problem Data Not Updateed'); /******Update log****** */

                            exit; /*****exit **** */

                        }

                    }

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******Update log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */

            $statusdata = $this->Admindb->SingleRowField(['StudentId'=>$StudentId,'IsDeleted'=>false],'students','IsActive');

            if($statusdata == true){
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false],'students',$StudentId,'StudentId');/********delete record********* */
            }else{
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>true],'students',$StudentId,'StudentId');/********delete record********* */

            }
            
            if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/

                echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */

                exit;/***** exit here ****** */

            }else{/********** Id data not Deactivfate */

                echo json_encode(['status'=>false,'message'=>'Student Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                exit;/*******exit here*******/

            }/******condition end here*******/

        }else{/*********** If Id Not Found ************/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

            exit;/*******exit here******* */

        }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "DeleteStudent") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/
    
            if ($this->input->post('StudentId')) { /******** If Id Exist ***********/
    
                $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */
    
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false,'IsDeleted'=>true],'students',$StudentId,'StudentId');/********delete record********* */
                
                
                if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/
    
                    echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */
    
                    exit;/***** exit here ****** */
    
                }else{/********** Id data not Deactivfate */
    
                    echo json_encode(['status'=>false,'message'=>'Student Not deleted Try Again!!','data'=>null]);/******send jason****** */
    
                    exit;/*******exit here*******/
    
                }/******condition end here*******/
    
            }else{/*********** If Id Not Found ************/
    
                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */
    
                exit;/*******exit here******* */
    
            }/********end of condition******** */
    
            }else{/********else user is not admin ******** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
            }/*******condition end******* */
    
            }elseif($param1 == "View"){/*********** Request for students Detail *********/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******students Id******* */

            $RowData = $this->Admindb->SimplesingleJoin(['students.StudentId' => $StudentId,'students.IsDeleted' =>false],'students','class','students.ClassId = class.ClassId','students.Id','ASC','*');/******get students details*****/

            

            if ($RowData) {/*******if data exist******* */

                $RowData->Password = $this->encryption->decrypt($RowData->Password);

                echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                exit; /*******exit here******** */

            }else{/**********else********* */

                echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                exit;/******exit here****** */

            }/********condition end******* */

        }else{/*********** If Id Not Exist **********/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

            exit;/*****exit****** */

        }/********end of condition view******** */

        }elseif($param1 == "Download"){

        /******** Check Email Is Unique Or Exist ********/

        if ($this->input->post()) {/*******if input post exist******** */

            $StudentId = $this->input->post('StudentId'); /*******get FileId****** */

            $StudDoc = $this->Admindb->RowData('StudentId',$StudentId,'students');/********Files data from database****** */

            if ($StudDoc) {/*********if Files exist********/

                $StudDoc->FileUrl = $StudDoc->Document;/*********** Add File Url to array *********** */

                echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$StudDoc]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }else{/******if Files not exist****** */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }/********if condition end***** */

        }else{/******if post not there********* */

            echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

            exit;/******* exit Here ********/

        }/*******end of condition***** */

        }else{

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $Data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>true,'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/

           $Data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

           $Data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get class Data From Database ************/

           $this->load->view('admin/pages/StudentsActiveList',$Data);/********send to display view page******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */


    
    /*************** StudentList Function ****************/

    public function StudentsInActiveList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'Edit') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                if (!is_dir('./uploads/Students/'.$this->input->post('StudentId'))) {/********check if folder not exist******** */

                    mkdir('./uploads/Students/'.$this->input->post('StudentId'), 0777, TRUE);/***** create mkdir *******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $StudentImage = [ /******** cover Image ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => 'jpg|jpeg|png'/******allowed types****** */

                ];/******array condition********/

                $File = [ /******** file ********/

                    'upload_path' => './uploads/Students/'.$this->input->post('StudentId').'/',/*****upload path***** */

                    'allowed_types' => '*'/******allowed types****** */

                ];/******array condition********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                 /********upload Profile Image ******/

                $this->upload->initialize($StudentImage); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('StudentImage') ) { /***** Check Profile Image File Upload *****/

                    $StudentImage = $this->upload->data(); /****** push Array ************/



                    $config['image_library'] = 'gd2';

                    $config['source_image'] = './uploads/Students/'.$this->input->post('StudentId').'/'.$StudentImage['file_name'];

                    $config['create_thumb'] = false;

                    $config['maintain_ratio'] = false;

                    $config['width']         = 500;

                    $config['height']       = 500;



                    $this->load->library('image_lib', $config);



                    $this->image_lib->resize();



                }else{

                    $StudentImage = null;

                }

                $this->upload->initialize($File); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('Document') ) { /***** Check File Upload *****/

                    $File = $this->upload->data(); /****** push Array ************/

                }else{

                    $File = null;

                }

                if($File != null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name'],

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage != null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'StudentImage'=> $StudentImage['file_name']

                    );

                }elseif($File != null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender'),

                        'Document'=> $File['file_name']

                    );

                }elseif($File == null && $StudentImage == null){

                    $StudentData = array(

                        'StudentName'=> $this->input->post('StudentName'),

                        'Religion'=> $this->input->post('Religion'),

                        'StudentGR'=> $this->input->post('StudentGR'),

                        'GRNumber'=> substr($this->input->post('StudentGR'),3),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SectionId'=> $this->input->post('SectionId'),

                        'Nationality'=> $this->input->post('nationality'),

                        'PhoneNumber'=> $this->input->post('PhoneNumber'),

                        'BirthDate'=> date('Y-m-d',strtotime($this->input->post('BirthDate'))),

                        'Address'=> $this->input->post('Address'),

                        'Fee'=> $this->input->post('Fee'),

                        'childMedical'=> $this->input->post('childMedical'),

                        'FatherName'=> $this->input->post('FatherName'),

                        'FatherCNIC'=> $this->input->post('FatherCNIC'),

                        'MotherName'=> $this->input->post('MotherName'),

                        'MotherCNIC'=> $this->input->post('MotherCNIC'),

                        'FatherPhone'=> $this->input->post('FatherPhone'),

                        'FatherOccupation'=> $this->input->post('FatherOccupation'),

                        'MotherPhone'=> $this->input->post('MotherPhone'),

                        'MotherOccupation'=> $this->input->post('MotherOccupation'),

                        'Gender'=> $this->input->post('Gender')

                    );

                }

                    $checkdata = $this->Admindb->CheckConditionData(['StudentId !='=> $this->input->post('StudentId'),'StudentGR'=>$this->input->post('StudentGR'),'IsDeleted'=>false],'students');

                    if($checkdata){

                        echo json_encode(['status'=>true,'message'=>'This GR No already assigned to another student','data'=>null]); /*******send jason data****** */

                        log_message('error', 'This GR No already assigned to another student'); /******Update log****** */

                        exit; /*****exit **** */

                    }else{

                        $UpdateStudent = $this->Admindb->UpdateData1(['StudentId'=>$this->input->post('StudentId')],$StudentData,'students');

                        if($UpdateStudent){

                            /********** send message ********** */

                            echo json_encode(['status'=>true,'message'=>'Student Update Successfully','data'=>null]); /*******send jason data****** */

                            log_message('error', 'Student Update Successfully'); /******Update log****** */

                            exit; /*****exit **** */

                        }else{

                            echo json_encode(['status'=>false,'message'=>'Network Problem Data Not Updateed','data'=>null]); /******* echo json data***** */

                            log_message('error', 'Network Problem Data Not Updateed'); /******Update log****** */

                            exit; /*****exit **** */

                        }

                    }

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******Update log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */

            $statusdata = $this->Admindb->SingleRowField(['StudentId'=>$StudentId,'IsDeleted'=>false],'students','IsActive');

            if($statusdata == true){
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false],'students',$StudentId,'StudentId');/********delete record********* */
            }else{
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>true],'students',$StudentId,'StudentId');/********delete record********* */

            }
            
            if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/

                echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */

                exit;/***** exit here ****** */

            }else{/********** Id data not Deactivfate */

                echo json_encode(['status'=>false,'message'=>'Student Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                exit;/*******exit here*******/

            }/******condition end here*******/

        }else{/*********** If Id Not Found ************/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

            exit;/*******exit here******* */

        }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif($param1 == "DeleteStudent") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/
    
            if ($this->input->post('StudentId')) { /******** If Id Exist ***********/
    
                $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */
    
                $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false,'IsDeleted'=>true],'students',$StudentId,'StudentId');/********delete record********* */
                
                
                if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/
    
                    echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */
    
                    exit;/***** exit here ****** */
    
                }else{/********** Id data not Deactivfate */
    
                    echo json_encode(['status'=>false,'message'=>'Student Not deleted Try Again!!','data'=>null]);/******send jason****** */
    
                    exit;/*******exit here*******/
    
                }/******condition end here*******/
    
            }else{/*********** If Id Not Found ************/
    
                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */
    
                exit;/*******exit here******* */
    
            }/********end of condition******** */
    
            }else{/********else user is not admin ******** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
            }/*******condition end******* */
    
            }elseif($param1 == "View"){/*********** Request for students Detail *********/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******students Id******* */

            $RowData = $this->Admindb->SimplesingleJoin(['students.StudentId' => $StudentId,'students.IsDeleted' =>false],'students','class','students.ClassId = class.ClassId','students.Id','ASC','*');/******get students details*****/

            

            if ($RowData) {/*******if data exist******* */

                $RowData->Password = $this->encryption->decrypt($RowData->Password);

                echo json_encode(['status'=>true,'message'=>'Record Found!!','data'=>$RowData]);/*******send jason data****** */

                exit; /*******exit here******** */

            }else{/**********else********* */

                echo json_encode(['status'=>false,'message'=>'Record Not Found Cant Show!!','data'=>null]);/********send jason data****** */

                exit;/******exit here****** */

            }/********condition end******* */

        }else{/*********** If Id Not Exist **********/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Show!!','data'=>null]);/******send jason data******* */

            exit;/*****exit****** */

        }/********end of condition view******** */

        }elseif($param1 == "Download"){

        /******** Check Email Is Unique Or Exist ********/

        if ($this->input->post()) {/*******if input post exist******** */

            $StudentId = $this->input->post('StudentId'); /*******get FileId****** */

            $StudDoc = $this->Admindb->RowData('StudentId',$StudentId,'students');/********Files data from database****** */

            if ($StudDoc) {/*********if Files exist********/

                $StudDoc->FileUrl = $StudDoc->Document;/*********** Add File Url to array *********** */

                echo json_encode(['status'=>true,'message'=>'Files Download Successfully','data'=>$StudDoc]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }else{/******if Files not exist****** */

                echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

                exit;/******* exit cHere ********/

            }/********if condition end***** */

        }else{/******if post not there********* */

            echo json_encode(['status'=>false,'message'=>'No File Found','data'=>null]);/********* send json result email is unique */

            exit;/******* exit Here ********/

        }/*******end of condition***** */

        }else{

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $Data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>false,'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/

           $Data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

           $Data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get class Data From Database ************/

           $this->load->view('admin/pages/StudentsInActiveList',$Data);/********send to display view page******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */



    /*************** StudentList Function ****************/

    public function SearchStudent()

    {/**********start of function*********** */
        if($this->input->post()){
            // var_dump($this->input->post()); die();
            $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $Data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $Data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $Data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $Data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

           $Data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school Data From Database ************/

           if(!empty($this->input->post('ClassId')) && empty($this->input->post('SectionId'))){
            $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>$this->input->post('ActiveInActive'),'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'students.ClassId'=>$this->input->post('ClassId')],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/
           }elseif(empty($this->input->post('ClassId')) && !empty($this->input->post('SectionId'))){
            $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>$this->input->post('ActiveInActive'),'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'students.SectionId'=>$this->input->post('SectionId')],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/   
           }elseif(!empty($this->input->post('ClassId')) && !empty($this->input->post('SectionId'))){
            $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>$this->input->post('ActiveInActive'),'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'students.ClassId'=>$this->input->post('ClassId'),'students.SectionId'=>$this->input->post('SectionId')],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/
           }else{
            $Data['StudentList'] = $this->Admindb->SimpleJoin(['students.IsActive'=>$this->input->post('ActiveInActive'),'students.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'students','class','students.ClassId = class.ClassId','students.GRNumber','DESC','students.Id,students.StudentId,students.StudentName,students.FatherName,students.PhoneNumber,students.StudentImage,students.Document,students.BirthDate,students.Address,students.InsertDate,students.Password,students.IsActive,class.ClassName,students.Religion,students.StudentGR,students.Nationality,students.childMedical,students.FatherCNIC,students.MotherName,students.MotherCNIC,students.FatherPhone,students.FatherOccupation,students.Gender,students.MotherPhone,students.MotherOccupation,students.SectionId,students.Fee,students.GRNumber'); /********* Get class Data From Database ************/
           }
           

           $Data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

           $Data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get class Data From Database ************/

           $this->load->view('admin/pages/StudentsList',$Data);/********send to display view page******* */
        }else{
            return redirect('StudentList');
        }
    }


    /*************** Assignmentlist Function ****************/

    public function AssignmentList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'Edit') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******Update log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($this->input->post('StudentId')) { /******** If Id Exist ***********/

            $StudentId = $this->input->post('StudentId');/*******ShortListed id******** */

            $DeleteStudent = $this->Admindb->UpdateData(['IsActive'=>false],'students',$StudentId,'StudentId');/********delete record********* */

            if ($DeleteStudent) {/********* If Data Deactivfate Successfully ***********/

                echo json_encode(['status'=>true,'message'=>'Student Delete Successfully!!','data'=>null]);/********send jason data****** */

                exit;/***** exit here ****** */

            }else{/********** Id data not Deactivfate */

                echo json_encode(['status'=>false,'message'=>'Student Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                exit;/*******exit here*******/

            }/******condition end here*******/

        }else{/*********** If Id Not Found ************/

            echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

            exit;/*******exit here******* */

        }/********end of condition******** */

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }else{

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $data['Language'] = $this->Admindb->language(); /********* Get Language From database ********/

           $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school data From database ************/

           $data['AssignmentList'] = $this->Admindb->ThreeJoin(['assignment.IsActive'=>true,'assignment.IsDeleted'=>false,'employee.IsActive'=>true,'employee.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false],'assignment','employee','assignment.TeacherId = employee.EmployeeId','subject','assignment.Subject = subject.SubjectId','class','assignment.Class = class.ClassId','Id','DESC','assignment.Id,assignment.AssignmentId,assignment.TeacherId,assignment.Assignment,assignment.Marks,assignment.InsertDate,assignment.DueDate,subject.SubjectId,subject.SubjectName,class.ClassId,class.ClassName,employee.EmployeeName'); /********* Get class Data From Database ************/

           

           $this->load->view('admin/pages/AssignmentList',$data);/********send to display view page******* */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */



    /*************** Assignment List Function ****************/

    public function UploadAssignmentList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        

           $language = $this->session->userdata('language');/**********language session********** */

           if($language == 'Urdu'){ /******** If language is Urdu ********/

               $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

           }else{ /******* If Language Is English **********/

               $data['Word'] = 'English'; /********* Word array Is English ********/

           }/*********End of condition**********/

           $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

           /******** Language Get from model**********/

           $data['Language'] = $this->Admindb->language(); /********* Get Language From database ********/

           $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get school data From database ************/

           $data['AssignmentList'] = $this->Admindb->SimpleJoin(['uploadassignment.AssignmentId'=>$param1,'uploadassignment.IsActive'=>true,'uploadassignment.IsDeleted'=>false,'students.IsActive'=>true,'students.IsDeleted'=>false],'uploadassignment','students','uploadassignment.StudentId = students.StudentId','Id','DESC','uploadassignment.Id,uploadassignment.UploadAssignmentId,uploadassignment.StudentId,uploadassignment.AssignmentId,uploadassignment.Assignment,uploadassignment.InsertDate,uploadassignment.Marks,students.StudentName,students.StudentGR'); /********* Get class Data From Database ************/

           

           $this->load->view('admin/pages/UploadAssignmentList',$data);/********send to display view page******* */

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/********function end******* */



    /*************** Insert TeachersList Function ****************/

    public function TeachersList($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('EmployeeId')) { /******** If Id Exist ***********/

                $EmployeeId = $this->input->post('EmployeeId');/*******employee id******** */

                $DeleteEmployee = $this->Admindb->BlockRecord('employee',$EmployeeId,'EmployeeId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteEmployee) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "AssignCourse") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/

                if ($this->input->post()) { /******** If Id Exist ***********/

                    $AssignData = array(

                        'AssignId'=> rand(1,1000).''.rand(1,1000).''.rand(1,1000),

                        'EmployeeId'=> $this->input->post('EmployeeId'),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SubjectId'=> $this->input->post('SubjectId'),

                        'Day'=> $this->input->post('Day'),

                        'ClassTimeFrom'=> $this->input->post('ClassTimeFrom'),

                        'ClassTimeTo'=> $this->input->post('ClassTimeTo'),

                        'IsActive'=>true

                    );



                    $conditionone = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'ClassId'=>$AssignData['ClassId'],'SubjectId'=>$AssignData['SubjectId'],'Day'=>$AssignData['Day'],'ClassTimeFrom<='=>$AssignData['ClassTimeFrom'],'ClassTimeTo>='=>$AssignData['ClassTimeTo'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /****** check overall data *** */



                    $conditiontwo = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'ClassId'=>$AssignData['ClassId'],'SubjectId'=>$AssignData['SubjectId'],'Day'=>$AssignData['Day'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /********not again on day********** */



                    $conditionthree = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'Day'=>$AssignData['Day'],'ClassTimeFrom<='=>$AssignData['ClassTimeFrom'],'ClassTimeTo>='=>$AssignData['ClassTimeTo'],'ClassTimeFrom>='=>$AssignData['ClassTimeFrom'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /****** check overall data *** */



                    if($conditionone || $conditiontwo || $conditionthree){

                        echo json_encode(['status'=>false,'message'=>'Teacher is busy in this timeslot!!','data'=>null]);/******send jason****** */

                            exit;/*******exit here****** */

                    }else{

                        $InsertAssign = $this->Admindb->InsertData($AssignData,'assigncourses');

                        if ($InsertAssign) {/********* If Course Assignd Successfully ***********/

                            echo json_encode(['status'=>true,'message'=>'Course Assign Successfully!!','data'=>null]);/********send jason data****** */

                            exit;/***** exit here ****** */

                        }else{/********** Id data not deleted */

                            echo json_encode(['status'=>false,'message'=>'Course Not Assign Try Again!!','data'=>null]);/******send jason****** */

                            exit;/*******exit here****** */

                        }/******condition end here****** */

                    }





                }else{/*********** If Id Not Found ************/

                    echo json_encode(['status'=>false,'message'=>'All input field required!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/********end of condition******** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['EmployeeList'] = $this->Admindb->getdata(['Designation'=>'Teacher','IsActive'=>true,'IsDeleted'=>false],'employee','Id','DESC');/********get list rows******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC');/********get list rows******** */

            // $data['SchoolList'] = $this->Admindb->getdata(['IsDeleted'=>false],'school','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/TeachersList',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin********/

    }/******admin condition end******* */

    }/********function end******* */



    /*************** Insert AssignedCourses Function ****************/

    public function AssignedCourses($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('AssignId')) { /******** If Id Exist ***********/

                $AssignId = $this->input->post('AssignId');/*******employee id******** */

                $DeleteCourse = $this->Admindb->BlockRecord('assigncourses',$AssignId,'AssignId',['IsDeleted'=>true]);/********delete record********* */

                if ($DeleteCourse) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }elseif ($param1 == "AssignCourse") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/

                if ($this->input->post()) { /******** If Id Exist ***********/

                    $AssignData = array(

                        'AssignId'=> rand(1,1000).''.rand(1,1000).''.rand(1,1000),

                        'EmployeeId'=> $this->input->post('EmployeeId'),

                        'ClassId'=> $this->input->post('ClassId'),

                        'SubjectId'=> $this->input->post('SubjectId'),

                        'Day'=> $this->input->post('Day'),

                        'ClassTimeFrom'=> $this->input->post('ClassTimeFrom'),

                        'ClassTimeTo'=> $this->input->post('ClassTimeTo'),

                        'IsActive'=>true

                    );



                    $conditionone = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'ClassId'=>$AssignData['ClassId'],'SubjectId'=>$AssignData['SubjectId'],'Day'=>$AssignData['Day'],'ClassTimeFrom<='=>$AssignData['ClassTimeFrom'],'ClassTimeTo>='=>$AssignData['ClassTimeTo'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /****** check overall data *** */



                    $conditiontwo = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'ClassId'=>$AssignData['ClassId'],'SubjectId'=>$AssignData['SubjectId'],'Day'=>$AssignData['Day'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /********not again on day********** */



                    $conditionthree = $this->Admindb->CheckConditionData(['EmployeeId'=>$AssignData['EmployeeId'],'Day'=>$AssignData['Day'],'ClassTimeFrom<='=>$AssignData['ClassTimeFrom'],'ClassTimeTo>='=>$AssignData['ClassTimeTo'],'ClassTimeFrom>='=>$AssignData['ClassTimeFrom'],'IsActive'=>true,'IsDeleted'=>false],'assigncourses'); /****** check overall data *** */



                    if($conditionone || $conditiontwo || $conditionthree){

                        echo json_encode(['status'=>false,'message'=>'Teacher is busy in this timeslot!!','data'=>null]);/******send jason****** */

                            exit;/*******exit here****** */

                    }else{

                        $InsertAssign = $this->Admindb->InsertData($AssignData,'assigncourses');

                        if ($InsertAssign) {/********* If Course Assignd Successfully ***********/

                            echo json_encode(['status'=>true,'message'=>'Course Assign Successfully!!','data'=>null]);/********send jason data****** */

                            exit;/***** exit here ****** */

                        }else{/********** Id data not deleted */

                            echo json_encode(['status'=>false,'message'=>'Course Not Assign Try Again!!','data'=>null]);/******send jason****** */

                            exit;/*******exit here****** */

                        }/******condition end here****** */

                    }





                }else{/*********** If Id Not Found ************/

                    echo json_encode(['status'=>false,'message'=>'All input field required!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/********end of condition******** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }else{/*****else no  condition given****** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['EmployeeList'] = $this->Admindb->getdata(['Designation'=>'Teacher','IsActive'=>true,'IsDeleted'=>false],'employee','Id','DESC');/********get list rows******** */

            $data['CourseList'] = $this->Admindb->ThreeJoin(['employee.IsActive'=>true,'employee.IsDeleted'=>false,'assigncourses.IsActive'=>true,'assigncourses.IsDeleted'=>false,'class.IsActive'=>true,'class.IsDeleted'=>false,'subject.IsActive'=>true,'subject.IsDeleted'=>false],'assigncourses','employee','assigncourses.EmployeeId = employee.EmployeeId','class','assigncourses.ClassId = class.ClassId','subject','assigncourses.SubjectId = subject.SubjectId','Id','DESC','assigncourses.Id,assigncourses.AssignId,assigncourses.AssignId,assigncourses.Day,assigncourses.ClassTimeFrom,assigncourses.ClassTimeTo,assigncourses.IsActive,employee.EmployeeName,subject.SubjectName,class.ClassName');/********get list rows******** */

            

            // $data['SchoolList'] = $this->Admindb->getdata(['IsDeleted'=>false],'school','Id','DESC');/********get list rows******** */

            $this->load->view('admin/pages/AssignedCourses',$data);/********send to display view page******* */

        }/*******end of else****** */

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin********/

    }/******admin condition end******* */

    }/********function end******* */

    

    /*************** Insert Profile Function ****************/

    public function Profile($param1='')

    {/*********** function Of Profile ********** */

            $language = $this->session->userdata('language');

            if($language == 'Urdu'){ /******** If language is Urdu *****/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ****/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English */

            }/*********End of condition********* */

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $UserSession = $this->session->userdata('UserSession');/*********User session********* */

            $data['StaffList'] = $this->Admindb->CheckUser($UserSession->StaffId,'staff','StaffId');

            $data['LoginDetails'] = $this->Admindb->LoginDetails($UserSession->StaffId);/********Login Details******** */

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            $this->load->view('admin/pages/Profile',$data);/**********Hit Profile page********* */

    }/*********end of function of profile********** */





    /*************** Insert Profile Function ****************/

    public function SoftwareSetting($param1='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'event') {/*******if param is event****** */

            if($this->input->post()){ /*********** Check Field mandetory **********/

                   $EventId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000); /****Random EventId ******/

                   $EventData = array(/******event data array****** */

                       'EventId' => $EventId,/*******event id******* */

                       'EventTitle'=>$this->input->post('EventTitle'),/*******event title******* */

                       'EventDetails'=>$this->input->post('EventDetails'),/*******event details****** */

                       'EventDate'=>date("Y-m-d", strtotime($this->input->post('EventDate'))),/*******event date****** */

                       'UploadDate'=>date('y-m-d')/*******upload date******* */

                   );/**********end of array******** */

                   $EventInserted = $this->Admindb->InsertData($EventData,'eventlist'); /** Database Event Inserted **/

                   if ($EventInserted) {/****** Check If user Inserted */

                       echo json_encode(['status'=>true,'message'=>'Event Insert Successfully','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here******* */

                   }else{ /************ If user Not Insreted *********/

                       echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/*******send jason data****** */

                       exit;/*******exit here****** */

                   }/*********end of else check******* */

           }else{/************* Fields Are Mandetory ***********/

               echo json_encode(['status'=>true,'message'=>'Insert Mandatory Form Fields!!','data'=>null]);/********send jason data***** */

               exit;/*********exit here********* */

           }/********end of condition******** */

        }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            /*********Configrations to Upload Files */

            $CompanyLogo = [ /********CompanyLogo Config ********/

                'upload_path' => './assets/dist/images/',/********upload path******* */

                'allowed_types' => 'jpg|jpeg|png',/*********allowed types******* */

                // 'allowed_types' => '*',

            ];/******config end******* */

            /**********Configration End ***********/

            $this->load->library('upload'); /***** Upload File Library *******/

           /********upload CompanyLogo ******/

           $this->upload->initialize($CompanyLogo); /*****Initialize CompanyLogo ****/

           if ($this->upload->do_upload('CompanyLogo') /***** Upload CompanyLogo ****/) { /***** Check CompanyLogo File Upload *****/

               $CompanyImage = $this->upload->data(); /****** push Array ************/

           }else{/*******else logo not uploaded******** */

               $CompanyList = $this->Admindb->CompanyList();/*********Company Lis Data******** */

               $CompanyImage = array('raw_name'=>$CompanyList->CompanyLogo,'file_ext'=>'');/********Company Image there******* */

           }/***** End of DoctorImage file check *****/

            $CompanyData = array( /**********company array data ********* */

                'CompanyName'=>$this->input->post('CompanyName'),/**********Company Data******** */

                'CompanyShortName'=>$this->input->post('CompanyShortName'),/********Company Short name*******/

                'CompanySlogan'=>$this->input->post('CompanySlogan'),/*******Company Slogan******* */

                'CompanyAddress'=>$this->input->post('CompanyAddress'),/*******Company Address****** */

                'CompanyPhone'=>$this->input->post('CompanyPhone'),/******Company Phone****** */

                'CompanyEmail'=>$this->input->post('CompanyEmail'),/********Company Email******* */

                'AfterDateDue'=>$this->input->post('AfterDueDate'),/********Company Email******* */

                'CompanyLogo'=>$CompanyImage['raw_name'].$CompanyImage['file_ext']/********Company Logo******** */

            );/********Company data array******** */

            $UpdateCompany = $this->Admindb->UpdateCompany($CompanyData); /** Database Panel Update **/

                if ($UpdateCompany) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'Data Update Successfully','data'=>null]);/******send jason data**** */

                    exit;/*******exit here******/

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/********send jason data****** */

                    exit;/******exit here****** */

                }/*********end of company update condition******* */

        }elseif ($param1 == "language") {/******* If Request Is for Language Upload ************/

            $WordId = rand(1, 1000).''.rand(1,1000).''.rand(1, 1000); /****Random Word Id ******/

            $LanguageData = array(/********language array data******* */

                'WordId'=>$WordId,/********WordId****** */

                'English'=>$this->input->post('English'),/********English******* */

                'Urdu'=>$this->input->post('Urdu')/*********Urdu******* */

            );/********Array language data******** */

            $insertlanguageword = $this->Admindb->InsertData($LanguageData,'language'); /** Database Panel insert **/

                if ($insertlanguageword) {/****** Check If user inserted */

                    echo json_encode(['status'=>true,'message'=>'Language Word Insert Successfully','data'=>null]);/*******send jason data******* */

                    exit;/*******exit here******* */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data****** */

                    exit;/********exit here******* */

                }/******langauge insert condition end******* */

        }else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $this->load->view('admin/pages/SoftwareSetting',$data);/********hit softwaresetting view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */





    /*************** Insert AddPayment Function ****************/

    public function AddPayment($param1='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/
            if ($param1 == 'GetStudent') {/*******if param is event****** */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
    
                       $ClassId = $this->input->post('ClassId');/********data field******* */
    
                       $SectionId = $this->input->post('SectionId');/********data field******* */
    
                       $Students = $this->Admindb->getdata(['ClassId'=>$ClassId,'SectionId'=>$SectionId,'IsActive'=>true,'IsDeleted'=>false],'students','GRNumber','ASC');/**********get data*********** */
    
                       echo json_encode(['status'=>true,'message'=>'Data Founds','data'=>$Students]);/*******send jason data******* */
    
                       exit;/******exit here******* */
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
            }
            elseif($param1 == 'GetStudentFee') {/*******if param is event****** */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
    
                       $StudentId = $this->input->post('StudentId');/********data field******* */
    
                       $Students = $this->Admindb->CheckConditionData(['StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'students');/**********get data*********** */
    
                       $OutStandingAmount = $this->Admindb->getdata(['StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');/**********get data*********** */
                       
                       $RemFee = 0;
    
                        if(!empty($OutStandingAmount)){
                            foreach($OutStandingAmount as $OUSTAM){
                                $RemFee += $OUSTAM->Dues;
                            }
                        }
                       
    
                       echo json_encode(['status'=>true,'message'=>'Data Founds','data'=>$Students,'Dues'=>$RemFee]);/*******send jason data******* */
    
                       exit;/******exit here******* */
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
            }
            elseif ($param1 == "Insert") {/******* If Request Is for Insert ************/
    
                /*********Configrations to Upload Files */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                    if($this->input->post()){/*******if data exist******* */
                        $year = $this->input->post('Year');
                        $month = $this->input->post('Month');
                        $annualfee_month = $this->input->post('AnnualFeeMonth');
                        if($month !== "Annual")
                        {
                            $feeMonth = DateTime::createFromFormat('F', $month)->format('m');
                            $FeeMonth =  date('Y-m-d',strtotime($year.'-'.$feeMonth.'-29'));
                        }else{
                            $feeMonth = 0;
                            $annualfee_Month = DateTime::createFromFormat('F', $annualfee_month)->format('m');
                            $FeeMonth =  date('Y-m-d',strtotime($year.'-'.$annualfee_Month.'-29'));
                        }

                        $paymentStatus = $this->input->post('Status');
                        
                        $InsertFee = array( /**********fee array data ********* */
    
                            'FeeId'=>rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),/**********FeeId Data******** */
    
                            'StudentId'=>$this->input->post('StudentId'),/********fee Short name*******/
    
                            'ClassId'=>$this->input->post('ClassId'),/*******fee ****** */
    
                            'SectionId'=>$this->input->post('SectionId'),/*******fee ****** */
    
                            'Month'=>$this->input->post('Month'),/******fee ****** */
                            //      Updated on 26-9-2020
                            'FeeMonth'=> $FeeMonth,/*****fee date***** */
    
                            'MonthNumber'=> $feeMonth,/******fee ****** */
    
                            'Year'=> $year,/********fee ******* */
    
                            'Fee'=>$this->input->post('Fee'),/********fee ******* */
    
                            'OutStanding'=>$this->input->post('OutStanding'),/********fee ******* */
    
                            'Status'=> $paymentStatus,/********Status ******* */
    
                            'Method'=>$this->input->post('Method'),/********Method ******* */
    
                            'AfterDueDate'=>$this->input->post('AfterDueDate'),/********AfterDueDate ******* */
    
                            'Dues'=>$this->input->post('Fee') - $this->input->post('AmountPaid'),/********AmountPaid ******* */
    
                            'Description'=>$this->input->post('Description'),/********Description ******* */
    
                            'PaidDate'=> $paymentStatus == 1 ? date('Y-m-d',strtotime($this->input->post('PaidDate'))) : NULL,/*****PaidDate date***** */
    
                            'CreationDate'=>date('Y-m-d',strtotime($this->input->post('CreationDate'))),/*****fee date***** */
    
                            'DueDate'=>date('Y-m-d',strtotime($this->input->post('DueDate'))),/*****fee date***** */
    
                        );/********fee data array******** */

                        $checkfee = $this->Admindb->CheckConditionData(['StudentId'=>$InsertFee['StudentId'],'ClassId'=>$InsertFee['ClassId'],'Month'=>$InsertFee['Month'],'Year'=>$InsertFee['Year'],'IsActive'=>true,'IsDeleted'=>false],'fee');

                        if($month == "Annual"){
                            $checkfee = $this->Admindb->CheckConditionData(['StudentId'=>$InsertFee['StudentId'],'ClassId'=>$InsertFee['ClassId'],'Month'=>$InsertFee['Month'],'Year'=>$InsertFee['Year'],'IsActive'=>true,'IsDeleted'=>false],'fee');
                        }
                        if($checkfee){
    
                            echo json_encode(['status'=>false,'message'=>'Voucher already exist','data'=>null]);/********send jason data****** */
    
                                exit;/******exit here****** */
    
                        }else{
                            $InsertFee = $this->Admindb->InsertData($InsertFee,'fee'); /** Database Panel inserted **/
    
                            if ($InsertFee) {/****** Check If user insertedd */
    
                                echo json_encode(['status'=>true,'message'=>'Fee insert Successfully','data'=>null]);/******send jason data**** */
    
                                exit;/*******exit here******/
    
                            }else{ /************ If user Not Insreted *********/
    
                                echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/********send jason data****** */
    
                                exit;/******exit here****** */
    
                            }/*********end of fee inserted condition******* */
    
                        }
    
                        
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
    
    
            }
            elseif ($param1 == "InsertMass") {/******* If Request Is for Insert ************/
                /*********Configrations to Upload Files */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
    
                        // var_dump($this->input->post('Students')); die();
    
                        $Students = explode(',',$this->input->post('Students'));
    
                            // $data = array();
    
                            // foreach ($Students as $key) {
    
                            //     $data[$key] = true;
    
                            // }
    
                        // $Students = $this->Admindb->getdata(['ClassId'=>$this->input->post('ClassId'),'IsActive'=>true,'IsDeleted'=>false],'students','Id','ASC');/**********get data*********** */
    
                        if(!empty($Students)){
                            
                            foreach($Students as $STU){
                                $OutStandingAmount = $this->Admindb->getdata(['StudentId'=>$STU,'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');/**********get data*********** */
    
                                $StuLi = $this->Admindb->CheckConditionData(['StudentId'=>$STU,'IsActive'=>true,'IsDeleted'=>false],'students');
    
                                
                                $RemFeeMass = 0;
    
                                    if(!empty($OutStandingAmount)){
                                        foreach($OutStandingAmount as $OUSTAM){
                                            $RemFeeMass += $OUSTAM->Dues;
                                        }
                                    }
    
                                $CompanyList = $this->Admindb->CompanyList(); /**** Get company Data From Database ********/
    
                                $PayAfter = (int)$StuLi->Fee;
                                $DateDue = (int)$CompanyList->AfterDateDue;
    
                                $AddPay = $PayAfter +  $DateDue;
    
                                $year = $this->input->post('Year');
                                $month = $this->input->post('Month');
    
                                $feeMonth = $month;
                                $FeeMonth = null;
                                if($month !== "Annual")
                                {
                                    $feeMonth = DateTime::createFromFormat('F', $month)->format('m');
                                    $FeeMonth =  date('Y-m-d',strtotime($year.'-'.$feeMonth.'-29'));
                                }else{
                                    $FeeMonth =  date('Y-m-d',strtotime((new \DateTime())->format('Y-m-d')));
                                }
                                $paymentStatus = $this->input->post('Status');
                                $InsertFee = array( /**********fee array data ********* */
    
                                    'FeeId'=>rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),/**********FeeId Data******** */
            
                                    'ClassId'=>$this->input->post('ClassId'),/*******fee ****** */
    
                                    'SectionId'=>$this->input->post('SectionId'),/*******fee ****** */
    
                                    'StudentId'=>$STU,/*******fee ****** */
    
                                    'Fee'=>$StuLi->Fee,/*******fee ****** */
    
                                    'OutStanding'=>$RemFeeMass,/*******fee ****** */
    
                                    'Dues'=>$StuLi->Fee,/*******Dues ****** */
    
                                    'AfterDueDate'=> $AddPay, /*******AfterDueDate ****** */
    
                                    'FeeMonth'=> $FeeMonth,/*****fee date***** */
    
                                    'Month'=> $month,/******fee ****** */
                                    //      Updated on 26-9-2020
                                    'MonthNumber'=>$feeMonth ,/******fee ****** */
            
                                    'Year'=> $year,/********fee ******* */
            
                                    'Status'=> $paymentStatus,/********Status ******* */
            
                                    'Method'=>$this->input->post('Method'),/********Method ******* */
            
                                    'Description'=>$this->input->post('Description'),/********Description ******* */
            
                                    'PaidDate'=>$paymentStatus == 1 ? date('Y-m-d',strtotime($this->input->post('PaidDate'))) : NULL,/*****PaidDate date***** */
            
                                    'CreationDate'=>date('Y-m-d',strtotime($this->input->post('CreationDate'))),/*****fee date***** */
            
                                    'DueDate'=>date('Y-m-d',strtotime($this->input->post('DueDate'))),/*****fee date***** */
            
                                );/********fee data array******** */
    
    
    
                                $checkfee = $this->Admindb->CheckConditionData(['StudentId'=>$InsertFee['StudentId'],'ClassId'=>$InsertFee['ClassId'],'Month'=>$InsertFee['Month'],'Year'=>$InsertFee['Year'],'IsActive'=>true,'IsDeleted'=>false],'fee');
    
                                if(empty($checkfee)){
    
                                    $Inserted = $this->Admindb->InsertData($InsertFee,'fee'); /** Database Panel inserted **/
    
                                }else{
                                    $Inserted = null;
                                }
    
                            }
    
    
                            if ($Inserted) {/****** Check If user insertedd */
    
                                echo json_encode(['status'=>true,'message'=>'Fee insert Successfully','data'=>null]);/******send jason data**** */
    
                            }else{ /************ If user Not Insreted *********/
    
                                echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/********send jason data****** */
    
                            }/*********end of fee inserted condition******* */
    
                        }else{
    
                            echo json_encode(['status'=>false,'message'=>'No students found in this class!!','data'=>null]);/*******send jason data******* */
    
                            exit;/******exit here******* */ 
    
                        }
    
                        
    
                        
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
    
    
            }
            else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
            $data['SectionList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'sections','Id','ASC'); /********* Get section Data From Database ************/

            $this->load->view('admin/pages/CreateFee',$data);/********hit CreateFee view******** */

        }/*********end of condition********* */
        }
        else{/*******else user is not admin********* */
            return redirect('admin');/*********return redirect to admin********* */
        }/*******end of condition******** */
    }/**********end of function********* */


    // public function SearchStudentInvoice(){

    //     if($this->input->post()){

    //         $StudentGR = $this->input->post('GRNumber');

    //         $GetFeeData = $this->Admindb->TwoJoin(['students.GRNumber'=>$StudentGR,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //         $language = $this->session->userdata('language');/**********language session********** */

    //         if($language == 'Urdu'){ /******** If language is Urdu ********/

    //             $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

    //         }else{ /******* If Language Is English **********/

    //             $data['Word'] = 'English'; /********* Word array Is English ********/

    //         }/*********End of condition**********/

    //         $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

    //         /******** Language Get from model**********/

    //         $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

    //         $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //         $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

    //         if($GetFeeData){

    //             $data['StudentList'] = $GetFeeData;
                
    //         }else{
                
    //             $data['StudentList'] = $GetFeeData;
            
    //         }

    //         $this->load->view('admin/pages/StudentLedger',$data);/********hit StudentLedger view******** */
    //     }else{

    //         $language = $this->session->userdata('language');/**********language session********** */

    //         if($language == 'Urdu'){ /******** If language is Urdu ********/

    //             $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

    //         }else{ /******* If Language Is English **********/

    //             $data['Word'] = 'English'; /********* Word array Is English ********/

    //         }/*********End of condition**********/

    //         $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

    //         /******** Language Get from model**********/

    //         $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

    //         $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //         $data['StudentList'] = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //         // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

    //         $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

    //         $this->load->view('admin/pages/StudentLedger',$data);/********hit StudentLedger view******** */
    //     }

        
    //  }



    /***************StudentLedger Function ****************/

    public function StudentLedger($param1='',$param2='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == 'GetStudent') {/*******if param is event****** */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                   $ClassId = $this->input->post('ClassId');/********data field******* */

                   $Students = $this->Admindb->getdata(['ClassId'=>$ClassId,'IsActive'=>true,'IsDeleted'=>false],'students','Id','ASC');/**********get data*********** */

                   echo json_encode(['status'=>true,'message'=>'Subject Founds','data'=>$Students]);/*******send jason data******* */

                   exit;/******exit here******* */

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */

        }
        elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                /**********Configration End ***********/
                
                $FeeId = $this->input->post('FeeId'); /**** FeeId ******/

                $feedata = array(

                    'Fee'=> $this->input->post('Fee'),

                    'AmountPaid'=> $this->input->post('AmountPaid'),

                    'Status'=> $this->input->post('Status'),

                    'PaidDate'=>date('Y-m-d',strtotime($this->input->post('PaidDate'))),/*****PaidDate date***** */

                    'Method'=> $this->input->post('Method'),

                    'BankRef'=> $this->input->post('BankRef'),

                    'Dues'=>$this->input->post('Fee') - $this->input->post('AmountPaid'),/********AmountPaid ******* */

                );

                

                $feeupdated = $this->Admindb->UpdateData1(['FeeId'=>$FeeId,'IsDeleted'=>false],$feedata,'fee'); /** Database JobType Inserted **/

                if ($feeupdated) {/****** Check If JobType Edited ******/

                    echo json_encode(['status'=>true,'message'=>'Fee Edit Successfully','data'=>null]);/******send jason data******* */

                    exit;/*****exit here******* */

                }else{ /************ If JobType Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

                        exit;/*******exit here****** */

                }/******Edited condition end****** */

            }else{/*******else******* */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

                    exit;/******exit here****** */

            }/*****user permission condition end ******** */

        }
        elseif ($param1 == "PrintVoucher") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if(!empty($param2)){/*******if data exist******* */

                    $FeeId = $param2;



                    $data['Voucher'] = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'students.IsActive' => true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate,fee.MonthNumber');

                    
                    // $OutStandingAmount = $this->Admindb->getdata(['StudentId'=>$StudentId,'FeeId !='=>$data['Voucher']->FeeId,'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');/**********get data*********** */
                   
                    // $RemFeeMass = 0;

                    //  if(!empty($OutStandingAmount)){
                    //     foreach($OutStandingAmount as $OUSTAM){
                    //         $RemFeeMass += $OUSTAM->Dues;
                    //     }
                    // }

                    

                    if($data['Voucher']){
                        $Month = $data['Voucher']->MonthNumber;
                        $Year = $data['Voucher']->Year;
                        $dated = '31/'.$Month.'/'.$Year;
                        $date_converted = str_replace('/', '-', $dated);
                        $data['PreviousDate']  =  date("Y-m-d", strtotime("-1 months", strtotime($date_converted)));

                        $data['OutStanding'] = $this->Admindb->SumRecord(['StudentId'=>$data['Voucher']->StudentId,'MonthNumber <'=>$data['Voucher']->MonthNumber,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');;
                        $data['Dues_OutStanding'] = $this->Admindb->SumRecord(['StudentId'=>$data['Voucher']->StudentId,'MonthNumber <'=>$data['Voucher']->MonthNumber,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
                        $data['MonthNumber'] = $data['Voucher']->MonthNumber;
                        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

                        $this->load->view('admin/pages/printvoucher',$data);/********hit StudentLedger view******** */

                    }else{

                        return redirect('StudentLedger');

                    }

                    

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }
        elseif ($param1 == "Filter") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $ClassId = $this->input->post('ClassId');

                    $Month = $this->input->post('Month');

                    $Year = $this->input->post('Year');



                    if($ClassId !="" && $Month =="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId =="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId =="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId !="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId !="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId =="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else if($ClassId !="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }else{

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

                    }



                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'No Data Found!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }
        elseif ($param1 == "View") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $FeeId = $this->input->post('FeeId');



                    $GetFeeData = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid');



                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue while getting data Please Try Again','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }
        elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if ($this->input->post('FeeId')) { /******** If Id Exist ***********/

                $FeeId = $this->input->post('FeeId');/*******subject id******** */

                $DeleteSubject = $this->Admindb->BlockRecord('fee',$FeeId,'FeeId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */

                if ($DeleteSubject) {/********* If Data Deleted Successfully ***********/

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

        }else{/********else user is not admin ******** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

        }/*******condition end******* */

        }
        elseif($param1 == "GRSearch"){
            if($this->input->post()){

                $StudentGR = $this->input->post('GRNumber');

                $StudentId = $this->Admindb->SingleRowField(['GRNumber'=>$StudentGR,'IsActive'=>true,'IsDeleted'=>false],'students','StudentId');
                // Updated order by command
                //      Updated on 26-9-2020 only order by clause
                $GetFeeData = $this->Admindb->TwoJoin(
                    ['students.GRNumber'=>$StudentGR,'fee.IsActive'=>true,'fee.IsDeleted'=>false],
                    'fee',
                    'students',
                    'fee.StudentId = students.StudentId',
                    'class',
                    'fee.ClassId = class.ClassId',
                    'fee.Year,fee.MonthNumber','ASC',
                    'fee.BankRef,fee.PaidDate,fee.Id,fee.FeeId,fee.StudentId,fee.FeeMonth,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber,fee.MonthNumber'
                );

                $data['PaidAmount'] = $this->Admindb->SumRecord(['StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');

                $data['TotalDues'] = $this->Admindb->SumRecord(['StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
                $data['GRSearch'] = $StudentGR;
                $this->load->view('admin/pages/StudentLedger',$data);/********hit StudentLedger view******** */
            }else{
                return redirect('StudentLedger');
            }
        }
        elseif($param1 == "MonthlySearch"){

            if($this->input->post()){

                $ClassId = $this->input->post('ClassId');
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');
                $MonthNumber = 0;
                if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }elseif($Month == "December"){ $MonthNumber = 0; }
    
                $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.BankRef,fee.PaidDate,fee.Id,fee.FeeId,fee.FeeMonth,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber,fee.MonthNumber');

                $data['PaidAmount'] = $this->Admindb->SumRecord(['MonthNumber <='=> $MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['TotalDues'] = $this->Admindb->SumRecord(['MonthNumber <='=> $MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
                $data['Class'] = $ClassId;
                $data['Month'] = $Month;
                $data['Year'] = $Year;
                $data['MonthNumber'] = $MonthNumber;
    
                $this->load->view('admin/pages/StudentLedger',$data);/********hit StudentLedger view******** */
            }else{
                return redirect('StudentLedger');
            }
            
        }
        else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['StudentList'] = null;


            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            $data['PaidAmount'] = 0;
            $data['TotalDues'] = 0;

            $this->load->view('admin/pages/StudentLedger',$data);/********hit StudentLedger view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */


    // /***************OutStandingSummary Function ****************/

    // public function OutStandingSummary($param1='',$param2='')

    // {/**********start of software setting function******** */

    //     if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

    //     if ($param1 == 'GetStudent') {/*******if param is event****** */

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

    //             if($this->input->post()){/*******if data exist******* */

    //                $ClassId = $this->input->post('ClassId');/********data field******* */

    //                $Students = $this->Admindb->getdata(['ClassId'=>$ClassId,'IsActive'=>true,'IsDeleted'=>false],'students','Id','ASC');/**********get data*********** */

    //                echo json_encode(['status'=>true,'message'=>'Subject Founds','data'=>$Students]);/*******send jason data******* */

    //                exit;/******exit here******* */

    //             }else{/********if data not exist********** */

    //                 echo json_encode(['status'=>false,'message'=>'Select Class Required!!','data'=>null]);/*******send jason data******* */

    //                 exit;/******exit here******* */

    //             }/**********end of condition********* */

    //         }else{/********else user is not Super admin*********** */

    //             echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

    //             exit;/******exit here******* */

    //         }/********end of user check******** */

    //     }elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

    //             /**********Configration End ***********/

    //             $FeeId = $this->input->post('FeeId'); /**** FeeId ******/

    //             $feedata = array(

    //                 'Fee'=> $this->input->post('Fee'),

    //                 'AmountPaid'=> $this->input->post('AmountPaid'),

    //                 'Status'=> $this->input->post('Status'),

    //                 'PaidDate'=>date('Y-m-d',strtotime($this->input->post('PaidDate'))),/*****PaidDate date***** */

    //                 'Method'=> $this->input->post('Method'),

    //                 'BankRef'=> $this->input->post('BankRef'),

    //                 'Dues'=>$this->input->post('Fee') - $this->input->post('AmountPaid'),/********AmountPaid ******* */

    //             );

                

    //             $feeupdated = $this->Admindb->UpdateData1(['FeeId'=>$FeeId,'IsDeleted'=>false],$feedata,'fee'); /** Database JobType Inserted **/

    //             if ($feeupdated) {/****** Check If JobType Edited ******/

    //                 echo json_encode(['status'=>true,'message'=>'Fee Edit Successfully','data'=>null]);/******send jason data******* */

    //                 exit;/*****exit here******* */

    //             }else{ /************ If JobType Not Insreted *********/

    //                 echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */

    //                     exit;/*******exit here****** */

    //             }/******Edited condition end****** */

    //         }else{/*******else******* */

    //                 echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */

    //                 exit;/******exit here****** */

    //         }/*****user permission condition end ******** */

    //     }elseif ($param1 == "PrintVoucher") {/******* If Request Is for Insert ************/

    //         /*********Configrations to Upload Files */

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

    //             if(!empty($param2)){/*******if data exist******* */

    //                 $FeeId = $param2;



    //                 $data['Voucher'] = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

    //                 $OutStandingAmount = $this->Admindb->getdata(['StudentId'=>$data['Voucher']->StudentId,'FeeId !='=>$FeeId,'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');/**********get data*********** */
                   
    //                 $RemFeeMass = 0;

    //                  if(!empty($OutStandingAmount)){
    //                     foreach($OutStandingAmount as $OUSTAM){
    //                         $RemFeeMass += $OUSTAM->Dues;
    //                     }
    //                 }

    //                 $data['OutStanding'] = $RemFeeMass;

    //                 if($data['Voucher']){

    //                     $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //                     $this->load->view('admin/pages/printvoucher',$data);/********hit StudentLedger view******** */

    //                 }else{

    //                     return redirect('StudentLedger');

    //                 }

                    

                    

                    

    //             }else{/********if data not exist********** */

    //                 echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

    //                 exit;/******exit here******* */

    //             }/**********end of condition********* */

    //         }else{/********else user is not Super admin*********** */

    //             echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

    //             exit;/******exit here******* */

    //         }/********end of user check******** */



    //     }elseif ($param1 == "Filter") {/******* If Request Is for Insert ************/

    //         /*********Configrations to Upload Files */

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

    //             if($this->input->post()){/*******if data exist******* */

    //                 $ClassId = $this->input->post('ClassId');

    //                 $Month = $this->input->post('Month');

    //                 $Year = $this->input->post('Year');



    //                 if($ClassId !="" && $Month =="" && $Year ==""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId =="" && $Month !="" && $Year ==""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId =="" && $Month =="" && $Year !=""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId !="" && $Month !="" && $Year ==""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId !="" && $Month =="" && $Year !=""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId =="" && $Month !="" && $Year !=""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else if($ClassId !="" && $Month !="" && $Year !=""){

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }else{

    //                     $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //                 }



    //                 if ($GetFeeData) {/****** Check If user insertedd */

    //                     echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

    //                     exit;/*******exit here******/

    //                 }else{ /************ If user Not Insreted *********/

    //                     echo json_encode(['status'=>false,'message'=>'No Data Found!!','data'=>null]);/********send jason data****** */

    //                     exit;/******exit here****** */

    //                 }/*********end of fee inserted condition******* */

                    

                    

    //             }else{/********if data not exist********** */

    //                 echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

    //                 exit;/******exit here******* */

    //             }/**********end of condition********* */

    //         }else{/********else user is not Super admin*********** */

    //             echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

    //             exit;/******exit here******* */

    //         }/********end of user check******** */



    //     }elseif ($param1 == "View") {/******* If Request Is for Insert ************/

    //         /*********Configrations to Upload Files */

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

    //             if($this->input->post()){/*******if data exist******* */

    //                 $FeeId = $this->input->post('FeeId');



    //                 $GetFeeData = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid');



    //                 if ($GetFeeData) {/****** Check If user insertedd */

    //                     echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

    //                     exit;/*******exit here******/

    //                 }else{ /************ If user Not Insreted *********/

    //                     echo json_encode(['status'=>false,'message'=>'There Is issue while getting data Please Try Again','data'=>null]);/********send jason data****** */

    //                     exit;/******exit here****** */

    //                 }/*********end of fee inserted condition******* */

                    

                    

    //             }else{/********if data not exist********** */

    //                 echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

    //                 exit;/******exit here******* */

    //             }/**********end of condition********* */

    //         }else{/********else user is not Super admin*********** */

    //             echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

    //             exit;/******exit here******* */

    //         }/********end of user check******** */



    //     }elseif($param1 == "Delete") {/********* If Request Is for Delete**********/

    //         if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

    //         if ($this->input->post('FeeId')) { /******** If Id Exist ***********/

    //             $FeeId = $this->input->post('FeeId');/*******subject id******** */

    //             $DeleteSubject = $this->Admindb->BlockRecord('fee',$FeeId,'FeeId',['IsActive'=>false,'IsDeleted'=>true]);/********delete record********* */

    //             if ($DeleteSubject) {/********* If Data Deleted Successfully ***********/

    //                 echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */

    //                 exit;/***** exit here ****** */

    //             }else{/********** Id data not deleted */

    //                 echo json_encode(['status'=>false,'message'=>'Data Not Deleted Try Again!!','data'=>null]);/******send jason****** */

    //                 exit;/*******exit here****** */

    //             }/******condition end here****** */

    //         }else{/*********** If Id Not Found ************/

    //             echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

    //             exit;/*******exit here******* */

    //         }/********end of condition******** */

    //     }else{/********else user is not admin ******** */

    //             echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

    //             exit;/******exit here******* */

    //     }/*******condition end******* */

    //     }else{ /**********else no language given********** */

    //         $language = $this->session->userdata('language');/**********language session********** */

    //         if($language == 'Urdu'){ /******** If language is Urdu ********/

    //             $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

    //         }else{ /******* If Language Is English **********/

    //             $data['Word'] = 'English'; /********* Word array Is English ********/

    //         }/*********End of condition**********/

    //         $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

    //         /******** Language Get from model**********/

    //         $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

    //         $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //         $data['StudentList'] = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.Dues >'=>0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,students.GRNumber');

    //         // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

    //         $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

    //         $this->load->view('admin/pages/OutStandingSummary',$data);/********hit OutStandingSummary view******** */

    //     }/*********end of condition********* */

    //     }else{/*******else user is not admin********* */

    //         return redirect('admin');/*********return redirect to admin********* */

    //     }/*******end of condition******** */

    // }/**********end of function********* */


    public function OutStandingSummary($param1='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == "View") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $FeeId = $this->input->post('FeeId');



                    $GetFeeData = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'students.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid');



                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue while getting data Please Try Again','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }elseif ($param1 == "Filter") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $ClassId = $this->input->post('ClassId');

                    $Month = $this->input->post('Month');

                    $Year = $this->input->post('Year');



                    if($ClassId !="" && $Month =="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');





                        

                    }else{

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }



                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'No Data Found!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }elseif($param1 == "ClassSearch"){
            if($this->input->post()){

                $ClassId = $this->input->post('ClassId');
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');

                $Day = 31;
                $dated = $Day.'/'.$Month.'/'.$Year;
                $date_converted = str_replace('/', '-', $dated);
                $date = date("Y-m-d", strtotime($date_converted));
                $data['FilteredDate']=$date;
                $MonthNumber = 0;
                if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }
    
                $GetFeeData = $this->Admindb->TwoJoinGroupBy(['students.IsActive'=>true,'fee.ClassId'=>$ClassId,'fee.FeeMonth<='=>$date,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.FeeMonth,fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');
    
                $data['PaidAmount'] = $this->Admindb->SumRecord(['StudentId <>'=>"",'fee.FeeMonth<='=>$date,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['TotalDues'] = $this->Admindb->SumRecord(['StudentId <>'=>"",'fee.FeeMonth<='=>$date,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
                // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
    
                $data['MonthClass'] = $Month;
                $data['MonthNumber'] = $MonthNumber;
                $data['YearClass'] = $Year;
                $data['Class'] = $ClassId;
                $data['SearchField'] = 'ClassSearch';
                $this->load->view('admin/pages/OutStandingSummary',$data);/********hit OutStandingSummary view******** *//********hit StudentLedger view******** */
            }else{
                return redirect('OutStandingSummary');
            }
        }elseif($param1 == "MonthlySearch"){
            if($this->input->post()){
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');

                $Day = 31;
                $dated = $Day.'/'.$Month.'/'.$Year;
                $date_converted = str_replace('/', '-', $dated);
                $date = date("Y-m-d", strtotime($date_converted));
                $data['FilteredDate']=$date;

                $MonthNumber = 0;
                if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }

                $GetFeeData = $this->Admindb->TwoJoinGroupBy(['students.IsActive'=>true,'FeeMonth <='=>$date,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.FeeMonth,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');

                //      Updated on 26-9-2020
                $data['PaidAmount'] = $this->Admindb->SumRecord(['StudentId <>'=>"",'FeeMonth <='=>$date,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['TotalDues'] = $this->Admindb->SumRecord(['StudentId <>'=>"",'FeeMonth <='=>$date,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

//                $data['PaidAmount'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
//                $data['TotalDues'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
                
                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
    
                // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
    
                $data['Month'] = $Month;
                $data['MonthNumber'] = $MonthNumber;
                $data['Year'] = $Year;
                $data['SearchField'] = 'MonthlySearch';

                $this->load->view('admin/pages/OutStandingSummary',$data);/********hit OutStandingSummary view******** *//********hit StudentLedger view******** */
            }else{
                return redirect('OutStandingSummary');
            }
        }else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['StudentList'] = null;

            $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

            // $data['AmountPaid'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
            $data['PaidAmount'] = 0;
            $data['TotalDues'] = 0;
            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            $this->load->view('admin/pages/OutStandingSummary',$data);/********hit OutStandingSummary view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */


    public function OutStandingList($param1='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

        if ($param1 == "View") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $FeeId = $this->input->post('FeeId');

                    $GetFeeData = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid');

                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'There Is issue while getting data Please Try Again','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }elseif ($param1 == "Filter") {/******* If Request Is for Insert ************/

            /*********Configrations to Upload Files */

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/

                if($this->input->post()){/*******if data exist******* */

                    $ClassId = $this->input->post('ClassId');

                    $Month = $this->input->post('Month');

                    $Year = $this->input->post('Year');



                    if($ClassId !="" && $Month =="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month !="" && $Year ==""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month =="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId =="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }else if($ClassId !="" && $Month !="" && $Year !=""){

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');





                        

                    }else{

                        $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');



                        

                    }



                    if ($GetFeeData) {/****** Check If user insertedd */

                        echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */

                        exit;/*******exit here******/

                    }else{ /************ If user Not Insreted *********/

                        echo json_encode(['status'=>false,'message'=>'No Data Found!!','data'=>null]);/********send jason data****** */

                        exit;/******exit here****** */

                    }/*********end of fee inserted condition******* */

                    

                    

                }else{/********if data not exist********** */

                    echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/**********end of condition********* */

            }else{/********else user is not Super admin*********** */

                echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                exit;/******exit here******* */

            }/********end of user check******** */



        }elseif($param1 == "ClassSearch"){
            if($this->input->post()){

                $ClassId = $this->input->post('ClassId');
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');

                $MonthNumber = 0;
                if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }
    
                $GetFeeData = $this->Admindb->TwoJoinGroupBy(['students.IsActive'=>true,'fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');
    
                $data['PaidAmount'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['TotalDues'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
                // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
    
                $data['MonthClass'] = $Month;
                $data['MonthNumber'] = $MonthNumber;
                $data['YearClass'] = $Year;
                $data['Class'] = $ClassId;
                $data['SearchField'] = 'ClassSearch';
                $this->load->view('admin/pages/OutStandingList',$data);/********hit OutStandingList view******** *//********hit StudentLedger view******** */
            }else{
                return redirect('OutStandingList');
            }
        }elseif($param1 == "MonthlySearch"){
            if($this->input->post()){
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');

                $Day = 29;
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');
                $dated = $Day.'/'.$Month.'/'.$Year;
                $date_converted = str_replace('/', '-', $dated);
                $date = date("Y-m-d", strtotime($date_converted));

                $MonthNumber = 0;
                if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }

                $GetFeeData = $this->Admindb->TwoJoinGroupBy(['students.IsActive'=>true,'FeeMonth'=>$date,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');


//                $data['PaidAmount'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
//                $data['TotalDues'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
                $data['PaidAmount'] = $this->Admindb->SumRecord(['FeeMonth'=>$date,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['TotalDues'] = $this->Admindb->SumRecord(['FeeMonth'=>$date,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
                
                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
    
                // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                
    
                if($GetFeeData){
    
                    $data['StudentList'] = $GetFeeData;
                    
                }else{
                    
                    $data['StudentList'] = $GetFeeData;
                
                }
    
                $data['Month'] = $Month;
                $data['MonthNumber'] = $MonthNumber;
                $data['Year'] = $Year;
                $data['SearchField'] = 'MonthlySearch';

                $this->load->view('admin/pages/OutStandingList',$data);/********hit OutStandingList view******** *//********hit StudentLedger view******** */
            }else{
                return redirect('OutStandingList');
            }
        }else{ /**********else no language given********** */

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['StudentList'] = null;

            $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

            // $data['AmountPaid'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
            $data['PaidAmount'] = 0;
            $data['TotalDues'] = 0;
            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            $this->load->view('admin/pages/OutStandingList',$data);/********hit OutStandingList view******** */

        }/*********end of condition********* */

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */


    /***************OutStandingList Function ****************/

    // public function OutStandingList($param1='',$param2='')

    // {/**********start of software setting function******** */

    //     if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/


    //         $language = $this->session->userdata('language');/**********language session********** */

    //         if($language == 'Urdu'){ /******** If language is Urdu ********/

    //             $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

    //         }else{ /******* If Language Is English **********/

    //             $data['Word'] = 'English'; /********* Word array Is English ********/

    //         }/*********End of condition**********/

    //         $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

    //         /******** Language Get from model**********/

    //         $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

    //         $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

    //         // $data['StudentList'] = $this->Admindb->TwoJoin(['students.IsActive'=>true,'students.IsDeleted'=>false,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.OutStanding >'=> 0],'students','fee','students.StudentId = fee.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.OutStanding');

    //         $data['StudentList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'students','GRNumber','DESC');

    //         // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

    //         $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

    //         $this->load->view('admin/pages/OutStandingList',$data);/********hit OutStandingList view******** */


    //     }else{/*******else user is not admin********* */

    //         return redirect('admin');/*********return redirect to admin********* */

    //     }/*******end of condition******** */

    // }/**********end of function********* */


    /***************StudentOutstanding Function ****************/

    public function StudentOutstanding($param1='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/


            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['StudentList'] = $this->Admindb->TwoJoin(['students.StudentId'=>$param1,'fee.IsActive'=>true,'fee.IsDeleted'=>false,'fee.OutStanding >'=> 0],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.OutStanding');

            
            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
            $data['StudentId'] = $param1;

            $this->load->view('admin/pages/StudentOutstanding',$data);/********hit StudentOutstanding view******** */


        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */


    /***************ClearAllOutStanding Function ****************/

    public function ClearAllOutStanding($param='')

    {/**********start of software setting function******** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/

            if($param !=""){
                $UpdateOutStanding = $this->Admindb->UpdateData1(['StudentId'=>$param,'IsActive'=>true,'IsDeleted'=>false],['OutStanding'=>0,'Dues'=>0],'fee');
                if($UpdateOutStanding){
                    return redirect('OutStandingList');/*********return redirect to admin********* */
                }else{
                    return redirect('StudentOutstanding/'.$param);
                }
            }else{
                return redirect('OutStandingList');/*********return redirect to admin********* */
            }

        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */


    /**********Download Files******** */

    public function ExportCSVStudentOutstanding($param = "")

    {/***********start of excel file download function********* */


            $this->load->helper('csv');/*********call Csv helper create by self********** */

            $ExportFile = array();/*********define empty array here******** */

            

                $GetFeeData = $this->Admindb->TwoJoin(['fee.StudentId'=>$param,'fee.OutStanding >'=> 0,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');




            

            $Header = array("Id", "Name", "GR No", "FatherName", "Class", "Description","Dues"

            );/*********array of head field names********** */

            array_push($ExportFile, $Header);/*******pish values to array********* */

            if (!empty($GetFeeData)) {/*******if data is exist of fee******* */

                foreach ($GetFeeData as $Fee) {/**********execute foreach loop to print data******* */

                    if($Fee->Status == true){

                        $Fee->Status = "Paid";

                    }else{

                        $Fee->Status = "UnPaid";

                    }

                    array_push($ExportFile, array($Fee->Id, $Fee->StudentName, 

                    $Fee->StudentGR,$Fee->FatherName, $Fee->ClassName,

                    $Fee->Description,$Fee->Dues

                    ));/***********push array fields result comes from database********** */

                }/********end of foreach loop******** */

            }/*********if data not empty condition end******* */

            convert_to_csv($ExportFile, 'Fee' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    }


    /**********Download Files******** */

    public function ExportCSVOutStandingList()

    {/***********start of excel file download function********* */


            $this->load->helper('csv');/*********call Csv helper create by self********** */

            $ExportFile = array();/*********define empty array here******** */

            

            $GetFeeData = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'students','Id','DESC');


            $Header = array("Id", "Name", "GR No", "FatherName", "Class", "OutStandings"

            );/*********array of head field names********** */

            array_push($ExportFile, $Header);/*******pish values to array********* */

            if (!empty($GetFeeData)) {/*******if data is exist of fee******* */

                foreach ($GetFeeData as $Fee) {/**********execute foreach loop to print data******* */

                    if(!empty($Fee->StudentId)){ $StudentAmount = $this->Admindb->SumRecord(['StudentId'=>$Fee->StudentId,'IsActive'=>true,'IsDeleted'=>false],'OutStanding','fee'); }else{ $StudentAmount = "0"; }

                    if(!empty($Fee->ClassId)){ $ClassName = $this->Admindb->SingleRowField(['ClassId'=>$Fee->ClassId,'IsActive'=>true,'IsDeleted'=>false],'class','ClassName'); }else{ $ClassName = "0"; }

                    if($StudentAmount > 0){

                    array_push($ExportFile, array($Fee->Id, $Fee->StudentName, 

                    $Fee->StudentGR,$Fee->FatherName, $ClassName,

                    $StudentAmount

                    ));/***********push array fields result comes from database********** */
                    }

                }/********end of foreach loop******** */

            }/*********if data not empty condition end******* */

            convert_to_csv($ExportFile, 'Fee' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    }




    /**********Download Files******** */

    public function ExportCSVFee()

    {/***********start of excel file download function********* */

        // var_dump($this->input->post()); die();

            $this->load->helper('csv');/*********call Csv helper create by self********** */

            $ExportFile = array();/*********define empty array here******** */

            

            $ClassId = $this->input->post('ClassId');

            $Month = $this->input->post('Month');

            $Year = $this->input->post('Year');



            if($ClassId !="" && $Month =="" && $Year ==""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId =="" && $Month !="" && $Year ==""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId =="" && $Month =="" && $Year !=""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId !="" && $Month !="" && $Year ==""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId !="" && $Month =="" && $Year !=""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId =="" && $Month !="" && $Year !=""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else if($ClassId !="" && $Month !="" && $Year !=""){

                $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }else{

                $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate');

            }



            

            $Header = array("Id", "Name", "GR No", "FatherName", "Class", "Description","Month", "Year","TotalFee","AmountPaid","Dues","Status","DueDate","PaymentAfterDueDate"

            );/*********array of head field names********** */

            array_push($ExportFile, $Header);/*******pish values to array********* */

            if (!empty($GetFeeData)) {/*******if data is exist of fee******* */

                foreach ($GetFeeData as $Fee) {/**********execute foreach loop to print data******* */

                    if($Fee->Status == true){

                        $Fee->Status = "Paid";

                    }else{

                        $Fee->Status = "UnPaid";

                    }

                    array_push($ExportFile, array($Fee->Id, $Fee->StudentName, 

                    $Fee->StudentGR,$Fee->FatherName, $Fee->ClassName,

                    $Fee->Description,$Fee->Month,$Fee->Year,$Fee->Fee,

                    $Fee->AmountPaid,$Fee->Dues,$Fee->Status,

                    $Fee->DueDate,$Fee->AfterDueDate

                    ));/***********push array fields result comes from database********** */

                }/********end of foreach loop******** */

            }/*********if data not empty condition end******* */

            convert_to_csv($ExportFile, 'Fee' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    }



    /**********Download Files******** */

    public function ExportCSVFeeBulk()

    {/***********start of excel file download function********* */

        // var_dump($this->input->post()); die();

            // $this->load->helper('csv');/*********call Csv helper create by self********** */

            // $ExportFile = array();/*********define empty array here******** */

            

            $ClassId = $this->input->post('ClassId');

            $Month = $this->input->post('Month');

            $Year = $this->input->post('Year');




            if($ClassId !="" && $Month =="" && $Year ==""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

                

                

            }else if($ClassId =="" && $Month !="" && $Year ==""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');


                
                

            }else if($ClassId =="" && $Month =="" && $Year !=""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

                


                

            }else if($ClassId !="" && $Month !="" && $Year ==""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');


                
                

            }else if($ClassId !="" && $Month =="" && $Year !=""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

                


                

            }else if($ClassId =="" && $Month !="" && $Year !=""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');


                
                

            }else if($ClassId !="" && $Month !="" && $Year !=""){

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');


                


                

            }else{

                $data['BulkFee'] = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

                
                

            }

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $this->load->view('admin/pages/BulkVoucher',$data);/********hit BulkVoucher view******** */
            

            // $Header = array("Id", "Name", "GR No", "FatherName", "Class", "Description","Month", "Year","TotalFee","AmountPaid","Dues","Status","PaidDate","UpdatedBy"

            // );/*********array of head field names********** */

            // array_push($ExportFile, $Header);/*******pish values to array********* */

            // if (!empty($GetFeeData)) {/*******if data is exist of fee******* */

            //     // foreach ($GetFeeData as $Fee) {/**********execute foreach loop to print data******* */

            //     //     if($Fee->Status == true){

            //     //         $Fee->Status = "Paid";

            //     //     }else{

            //     //         $Fee->Status = "UnPaid";

            //     //     }

            //     //     array_push($ExportFile, array($Fee->Id, $Fee->StudentName, 

            //     //     $Fee->StudentGR,$Fee->FatherName, $Fee->ClassName,

            //     //     $Fee->Description,$Fee->Month,$Fee->Year,$Fee->Fee,

            //     //     $Fee->AmountPaid,$Fee->Dues,$Fee->Status,

            //     //     $Fee->PaidDate,$Fee->StaffName

            //     //     ));/***********push array fields result comes from database********** */

            //     // }/********end of foreach loop******** */

                    

            // }/*********if data not empty condition end******* */

            // convert_to_csv($ExportFile, 'Fee' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    }


    public function SearchStudentInvoiceBulk(){

        if($this->input->post()){

            $StudentGR = $this->input->post('GRNumber');

            $GetFeeData = $this->Admindb->TwoJoin(['students.GRNumber'=>$StudentGR,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

            
            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

            $data['AmountPaid'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');

            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            
            

            if($GetFeeData){

                $data['StudentList'] = $GetFeeData;
                
            }else{
                
                $data['StudentList'] = $GetFeeData;
            
            }

            $this->load->view('admin/pages/BulkPayment',$data);/********hit BulkPayment view******** *//********hit StudentLedger view******** */
        }else{

            
            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $data['StudentList'] = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

            $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

            $data['AmountPaid'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');

            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            $this->load->view('admin/pages/BulkPayment',$data);/********hit BulkPayment view******** */
        }

        
     }

    /***************BulkPayment Function ****************/

    public function BulkPayment($param1='')

    {/**********start of software setting function******** */
        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is admin ****/
            if ($param1 == 'Insert') {/*******if param is event****** */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
                        if($this->input->post('Amount')){
                            // $result = array_filter($this->input->post('Amount'));
                            $result = $this->input->post('Amount');
                        
                            $countdata = count($result);
                            // var_dump($result);
                        }else{
                            $countdata = 0;
                        }
                        
                        if($countdata > 0){
                            for($i= 0; $i < $countdata; $i++){
                                
                              $GetStudent = $this->Admindb->getdata(['StudentId'=>$this->input->post('StudentId')[$i],'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');
    
                              $Amount = $this->input->post('Amount')[$i];
                              
                              if(isset($this->input->post('PaidDate')[$i])){ $date = $this->input->post('PaidDate')[$i]; }else{ $date = date('Y-m-d');}
                              
                              if(isset($this->input->post('BankRef')[$i])){ $bank = $this->input->post('BankRef')[$i]; }else{ $bank = "";}
    
                              if(!empty($GetStudent)){ foreach($GetStudent as $GTSU){
                                if($GTSU->Dues > $Amount){
                                    $insertdata = array(
    
                                        'AmountPaid'=> (int)$GTSU->AmountPaid + (int)$Amount,
          
                                        'PaidDate'=>date('Y-m-d',strtotime($date)),
          
                                        'BankRef'=>$bank,
          
                                        'UpdatedBy'=>$this->session->userdata('UserSession')->StaffId,
          
                                        'Dues'=> (int)$GTSU->Dues - (int)$Amount,
    
                                        'Status' => true
          
                                    );
                                    
                                    $updateData = $this->Admindb->UpdateData1(['FeeId'=>$GTSU->FeeId,'IsDeleted'=>false],$insertdata,'fee');
                                    if($updateData){
                                        $insertuser = array(
                                            'FeeDataId' => rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),
    
                                            'AmountPaid'=> (int)$GTSU->AmountPaid + (int)$Amount,
          
                                            'PaidDate'=>date('Y-m-d',strtotime($date)),
            
                                            'BankRef'=>$bank,
            
                                            'UpdatedBy'=>$this->session->userdata('UserSession')->StaffId,
            
                                            'Dues'=> (int)$GTSU->Dues - (int)$Amount,
    
                                            'MonthNumber'=> $GTSU->MonthNumber,

                                            'Month'=> $GTSU->Month,
    
                                            'StudentId'=> $GTSU->StudentId,
    
                                            'Year'=> $GTSU->Year,
    
                                            'IsActive' => true
                                        );
                                        $this->Admindb->InsertData($insertuser,'feedata');
                                    }
                                    break;
                                }else{
                                    if($GTSU->Dues != 0){
                                        $insertdata = array(
    
                                            'AmountPaid'=> (int)$GTSU->AmountPaid + (int)$GTSU->Dues,
              
                                            'PaidDate'=>date('Y-m-d',strtotime($date)),
              
                                            'BankRef'=>$bank,
              
                                            'UpdatedBy'=>$this->session->userdata('UserSession')->StaffId,
              
                                            'Dues'=> (int)$GTSU->Dues - (int)$GTSU->Dues
              
                                        );
                                        
                                        $updateData = $this->Admindb->UpdateData1(['FeeId'=>$GTSU->FeeId,'IsDeleted'=>false],$insertdata,'fee');
        
                                        if($updateData){
                                            $insertuser = array(
                                                'FeeDataId' => rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),
    
                                                'AmountPaid'=> (int)$GTSU->AmountPaid + (int)$Amount,
              
                                                'PaidDate'=>date('Y-m-d',strtotime($date)),
                
                                                'BankRef'=>$bank,
                
                                                'UpdatedBy'=>$this->session->userdata('UserSession')->StaffId,
                
                                                'Dues'=> (int)$GTSU->Dues - (int)$Amount,
        
                                                'MonthNumber'=> $GTSU->MonthNumber,
        
                                                'Month'=> $GTSU->Month,

                                                'StudentId'=> $GTSU->StudentId,
        
                                                'Year'=> $GTSU->Year,
        
                                                'IsActive' => true
                                            );
                                            $this->Admindb->InsertData($insertuser,'feedata');
                                        }
                                        
                                        $Amount = (int)$Amount - (int)$GTSU->Dues;
                                        
                                    }
                                }
    
                              }}
    
                            //   $updateData = $this->Admindb->UpdateData1(['FeeId'=>$this->input->post('FeeId')[$i],'IsDeleted'=>false],$insertdata,'fee');
    
                            }
                            
                        }else{
                            if($this->input->post('SearchField') == 'ClassSearch'){
        
                                $this->BulkPayment('ClassSearch');
    
                            }elseif($this->input->post('SearchField') == 'MonthlySearch'){
    
                                $this->BulkPayment('MonthlySearch');
                            }else{
                                return redirect('BulkPayment');
                            }
                            
                        }
    
                        if($this->input->post('SearchField') == 'ClassSearch'){
    
                            $this->BulkPayment('ClassSearch');
    
                        }elseif($this->input->post('SearchField') == 'MonthlySearch'){
    
                            $this->BulkPayment('MonthlySearch');
                        }
                        // if($updateData){
    
                        //     // $this->session->set_flashdata('Payment', 'Payment insert successfully');
    
                        //     // $this->session->set_flashdata('CheckStatus', 'True');
                        //     if($this->input->post('SearchField') == 'ClassSearch'){
    
                        //         $this->BulkPayment('ClassSearch');
    
                        //     }elseif($this->input->post('SearchField') == 'MonthlySearch'){
    
                        //         $this->BulkPayment('MonthlySearch');
                        //     }
    
    
                        // }else{
    
                        //     // $this->session->set_flashdata('Payment', 'Payment not inserted');
    
                        //     // $this->session->set_flashdata('CheckStatus', 'False');
                        //     if($this->input->post('SearchField') == 'ClassSearch'){
    
                        //         $this->BulkPayment('ClassSearch');
    
                        //     }elseif($this->input->post('SearchField') == 'MonthlySearch'){
    
                        //         $this->BulkPayment('MonthlySearch');
                        //     }
    
                        // }
                       
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Payment Inserted!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
            }
            elseif ($param1 == "Edit") {/******* If Request Is for Edit/Update ************/
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/
    
                    /**********Configration End ***********/
    
                    $FeeId = $this->input->post('FeeId'); /**** FeeId ******/
    
                    $feedata = array(
    
                        'Fee'=> $this->input->post('Fee'),
    
                        'AmountPaid'=> $this->input->post('AmountPaid'),
    
                        'Status'=> $this->input->post('Status'),
    
                        'PaidDate'=>date('Y-m-d',strtotime($this->input->post('PaidDate'))),/*****PaidDate date***** */
    
                        'Method'=> $this->input->post('Method'),
    
                        'Dues'=>$this->input->post('Fee') - $this->input->post('AmountPaid'),/********AmountPaid ******* */
    
                    );
    
                    
    
                    $feeupdated = $this->Admindb->UpdateData1(['FeeId'=>$FeeId,'IsDeleted'=>false],$feedata,'fee'); /** Database JobType Inserted **/
    
                    if ($feeupdated) {/****** Check If JobType Edited ******/
    
                        echo json_encode(['status'=>true,'message'=>'Fee Edit Successfully','data'=>null]);/******send jason data******* */
    
                        exit;/*****exit here******* */
    
                    }else{ /************ If JobType Not Insreted *********/
    
                        echo json_encode(['status'=>false,'message'=>'There Is issue Please Try Again','data'=>null]);/******send jason data****** */
    
                            exit;/*******exit here****** */
    
                    }/******Edited condition end****** */
    
                }else{/*******else******* */
    
                        echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data***** */
    
                        exit;/******exit here****** */
    
                }/*****user permission condition end ******** */
    
            }
            elseif ($param1 == "View") {/******* If Request Is for Insert ************/
    
                /*********Configrations to Upload Files */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
    
                        $FeeId = $this->input->post('FeeId');
    
    
    
                        $GetFeeData = $this->Admindb->TwoJoinrow(['fee.FeeId'=>$FeeId,'students.IsActive'=>true,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid');
    
    
    
                        if ($GetFeeData) {/****** Check If user insertedd */
    
                            echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */
    
                            exit;/*******exit here******/
    
                        }else{ /************ If user Not Insreted *********/
    
                            echo json_encode(['status'=>false,'message'=>'There Is issue while getting data Please Try Again','data'=>null]);/********send jason data****** */
    
                            exit;/******exit here****** */
    
                        }/*********end of fee inserted condition******* */
    
                        
    
                        
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
    
    
            }
            elseif ($param1 == "Filter") {/******* If Request Is for Insert ************/
    
                /*********Configrations to Upload Files */
    
                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is Superadmin ****/
    
                    if($this->input->post()){/*******if data exist******* */
    
                        $ClassId = $this->input->post('ClassId');
    
                        $Month = $this->input->post('Month');
    
                        $Year = $this->input->post('Year');
    
    
    
                        if($ClassId !="" && $Month =="" && $Year ==""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId =="" && $Month !="" && $Year ==""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId =="" && $Month =="" && $Year !=""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId !="" && $Month !="" && $Year ==""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId !="" && $Month =="" && $Year !=""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId =="" && $Month !="" && $Year !=""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }else if($ClassId !="" && $Month !="" && $Year !=""){
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
    
    
                            
    
                        }else{
    
                            $GetFeeData = $this->Admindb->TwoJoin(['fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');
    
    
    
                            
    
                        }
    
    
    
                        if ($GetFeeData) {/****** Check If user insertedd */
    
                            echo json_encode(['status'=>true,'message'=>'Fee Found Successfully','data'=>$GetFeeData]);/******send jason data**** */
    
                            exit;/*******exit here******/
    
                        }else{ /************ If user Not Insreted *********/
    
                            echo json_encode(['status'=>false,'message'=>'No Data Found!!','data'=>null]);/********send jason data****** */
    
                            exit;/******exit here****** */
    
                        }/*********end of fee inserted condition******* */
    
                        
    
                        
    
                    }else{/********if data not exist********** */
    
                        echo json_encode(['status'=>false,'message'=>'Field Required!!','data'=>null]);/*******send jason data******* */
    
                        exit;/******exit here******* */
    
                    }/**********end of condition********* */
    
                }else{/********else user is not Super admin*********** */
    
                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */
    
                    exit;/******exit here******* */
    
                }/********end of user check******** */
    
    
    
            }
            elseif($param1 == "ClassSearch"){
                if($this->input->post()){
    
                    $ClassId = $this->input->post('ClassId');
                    $Month = $this->input->post('Month');
                    $Year = $this->input->post('Year');
                    $Day = 31;
                    $dated = $Day.'/'.$Month.'/'.$Year;
                    $date_converted = str_replace('/', '-', $dated);
                    $date = date("Y-m-d", strtotime($date_converted));
                    $data['FilteredDate']=$date;

                    $MonthNumber = 0;
                    if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }
        
                    $GetFeeData = $this->Admindb->TwoJoinGroupBy(['students.IsActive'=>true,'fee.ClassId'=>$ClassId,'fee.MonthNumber'=>$MonthNumber,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeMonth,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');

                    $data['PaidAmount'] = $this->Admindb->SumRecord(['StudentId<>'=>"",'MonthNumber'=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                    $data['TotalDues'] = $this->Admindb->SumRecord(['StudentId<>'=>"",'MonthNumber'=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
//                    $data['PaidAmount'] = $this->Admindb->SumRecord(['FeeMonth<='=>$date,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
//                    $data['TotalDues'] = $this->Admindb->SumRecord(['FeeMonth<='=>$date,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                    $language = $this->session->userdata('language');/**********language session********** */
        
                    if($language == 'Urdu'){ /******** If language is Urdu ********/
        
                        $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
        
                    }else{ /******* If Language Is English **********/
        
                        $data['Word'] = 'English'; /********* Word array Is English ********/
        
                    }/*********End of condition**********/
        
                    $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
        
                    /******** Language Get from model**********/
        
                    $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
        
                    $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
        
                    $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
        
                    // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
        
                    $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
        
                    
        
                    if($GetFeeData){
        
                        $data['StudentList'] = $GetFeeData;
                        
                    }else{
                        
                        $data['StudentList'] = $GetFeeData;
                    
                    }
        
                    $data['MonthClass'] = $Month;
                    $data['MonthNumber'] = $MonthNumber;
                    $data['YearClass'] = $Year;
                    $data['Class'] = $ClassId;
                    $data['SearchField'] = 'ClassSearch';
                    $this->load->view('admin/pages/BulkPayment',$data);/********hit BulkPayment view******** *//********hit StudentLedger view******** */
                }else{
                    return redirect('BulkPayment');
                }
            }
            elseif($param1 == "MonthlySearch"){
                if($this->input->post()){
                    $Day = 31;
                    $Month = $this->input->post('Month');
                    $Year = $this->input->post('Year');
                    $dated = $Day.'/'.$Month.'/'.$Year;
                    $date_converted = str_replace('/', '-', $dated);
                    $date = date("Y-m-d", strtotime($date_converted));

                    $MonthNumber = 0;
                    if($Month == "January"){ $MonthNumber = 1; }elseif($Month == "February"){ $MonthNumber = 2; }elseif($Month == "March"){ $MonthNumber = 3; }elseif($Month == "April"){ $MonthNumber = 4; }elseif($Month == "May"){ $MonthNumber = 5; }elseif($Month == "June"){ $MonthNumber = 6; }elseif($Month == "July"){ $MonthNumber = 7; }elseif($Month == "August"){ $MonthNumber = 8; }elseif($Month == "September"){ $MonthNumber = 9; }elseif($Month == "October"){ $MonthNumber = 10; }elseif($Month == "November"){ $MonthNumber = 11; }elseif($Month == "December"){ $MonthNumber = 12; }elseif($Month == "Annual"){ $MonthNumber = 0; }
//                    $where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$field,$value,$select,$distinct
                    $GetFeeData = $this->Admindb->TwoJoinGroupBy(
                      ['students.IsActive'=>true,'fee.MonthNumber'=>$MonthNumber,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],
                      'fee',
                      'students',
                      'fee.StudentId = students.StudentId',
                      'class',
                      'fee.ClassId = class.ClassId',
                      'students.GRNumber','DESC',
                      'fee.Id,fee.FeeMonth,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber',
                      'fee.StudentId'
                    );
//                    $GetFeeData = $this->Admindb->TwoJoinGroupBy(['fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber,fee.MonthNumber','fee.StudentId');
                    $studentIds = [];
                    if($GetFeeData != [])
                    {
                        foreach ($GetFeeData as $key => $test) {
                            $studentIds[$key] = $test->StudentId;
                        }
                    }
                    if($Month == "Annual")
                    {
                        $data['FilteredDate'] = date('Y-m-d',strtotime((new \DateTime())->format('Y-m-d')));
                    }else{
                        $data['FilteredDate'] = $date;
                    }
                    $data['PaidAmount'] = $this->Admindb->SumRecord(['StudentId<>'=>"",'MonthNumber'=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                    $data['TotalDues'] = $this->Admindb->SumRecord(['StudentId<>'=>"",'MonthNumber'=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
//                    $data['PaidAmount'] = $this->Admindb->BulkRecord(['FeeMonth'=>$date,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee','StudentId',$studentIds);
//                  $data['PaidAmount'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
//                    $data['TotalDues'] = $this->Admindb->BulkRecord(['FeeMonth<='=>$date,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee','StudentId',$studentIds);
//                    $data['TotalDues'] = $this->Admindb->SumRecord(['MonthNumber <='=>$MonthNumber,'Year'=>$Year,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                    $language = $this->session->userdata('language');/**********language session********** */
        
                    if($language == 'Urdu'){ /******** If language is Urdu ********/
        
                        $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
        
                    }else{ /******* If Language Is English **********/
        
                        $data['Word'] = 'English'; /********* Word array Is English ********/
        
                    }/*********End of condition**********/
        
                    $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
        
                    /******** Language Get from model**********/
        
                    $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
        
                    $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
        
                    $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
        
        
                    // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
        
                    $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
        
                    
        
                    if($GetFeeData){
        
                        $data['StudentList'] = $GetFeeData;
                        
                    }else{
                        
                        $data['StudentList'] = $GetFeeData;
                    
                    }

                    $data['Month'] = $Month;
                    $data['MonthNumber'] = $MonthNumber;
                    $data['Year'] = $Year;
                    $data['SearchField'] = 'MonthlySearch';
                    $this->load->view('admin/pages/BulkPayment',$data);/********hit BulkPayment view******** *//********hit StudentLedger view******** */
                }else{
                    return redirect('BulkPayment');
                }
            }
            else
                { 
                /**********else no language given********** */
    
                $language = $this->session->userdata('language');/**********language session********** */
    
                if($language == 'Urdu'){ /******** If language is Urdu ********/
    
                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/
    
                }else{ /******* If Language Is English **********/
    
                    $data['Word'] = 'English'; /********* Word array Is English ********/
    
                }/*********End of condition**********/
    
                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/
    
                /******** Language Get from model**********/
    
                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/
    
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
    
                $data['StudentList'] = null;
    
                $data['TotalOutstandings'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'Dues','fee');
    
                // $data['AmountPaid'] = $this->Admindb->SumRecord(['IsActive'=>true,'IsDeleted'=>false],'AmountPaid','fee');
                $data['PaidAmount'] = 0;
                $data['TotalDues'] = 0;
                // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */
    
                $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/
    
                $this->load->view('admin/pages/BulkPayment',$data);/********hit BulkPayment view******** */
    
            }/*********end of condition********* */
        }else{/*******else user is not admin********* */

            return redirect('admin');/*********return redirect to admin********* */

        }/*******end of condition******** */

    }/**********end of function********* */





    /************ UsersList Home Function *********** */

    public function UsersList($param1="")

    { /********* start of UsersList/home function********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if($param1 == "Delete") {/********* If Request Is for Delete**********/

            if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if ($this->input->post('StaffId')) { /******** If Id Exist ***********/

                $StaffId = $this->input->post('StaffId');/*******ShortListed id******** */

                $DeleteUser = $this->Admindb->UpdateData1(['StaffId'=>$StaffId,'IsDeleted'=>false],['IsDeleted'=>true],'staff');/********delete record********* */

                if ($DeleteUser) {/********* If Data Deactivfate Successfully ***********/

                    echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */

                    exit;/***** exit here ****** */

                }else{/********** Id data not Deactivfate */

                    echo json_encode(['status'=>false,'message'=>'Data Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                    exit;/*******exit here*******/

                }/******condition end here*******/

            }else{/*********** If Id Not Found ************/

                echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

                exit;/*******exit here******* */

            }/********end of condition******** */

            }else{/********else user is not admin ******** */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

            }/*******condition end******* */

            }elseif($param1 == "Updated") {/********* If Request Is for Delete**********/

                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

                if ($this->input->post('StaffId')) { /******** If Id Exist ***********/

                    $StaffId = $this->input->post('StaffId');/*******ShortListed id******** */



                    $checkdata = $this->Admindb->CheckConditionData(['StaffId'=>$this->input->post('StaffId'),'IsActive'=>true],'staff');

                    if($checkdata){

                        $UpdateStaff = $this->Admindb->UpdateData1(['StaffId'=>$StaffId],['IsActive'=>false],'staff');/********delete record********* */

                    }else{

                        $UpdateStaff = $this->Admindb->UpdateData1(['StaffId'=>$StaffId],['IsActive'=>true],'staff');/********delete record********* */

                    }

                    

                    if ($UpdateStaff) {/********* If Data Deactivfate Successfully ***********/

                        echo json_encode(['status'=>true,'message'=>'Data Delete Successfully!!','data'=>null]);/********send jason data****** */

                        exit;/***** exit here ****** */

                    }else{/********** Id data not Deactivfate */

                        echo json_encode(['status'=>false,'message'=>'Data Not Deactivfate Try Again!!','data'=>null]);/******send jason****** */

                        exit;/*******exit here*******/

                    }/******condition end here*******/

                }else{/*********** If Id Not Found ************/

                    echo json_encode(['status'=>false,'message'=>'Id Not Found Cant Delete!!','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }/********end of condition******** */

                }else{/********else user is not admin ******** */

                        echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                        exit;/******exit here******* */

                }/*******condition end******* */

                }else{

                $language = $this->session->userdata('language');/**********language session********** */

                if($language == 'Urdu'){ /******** If language is Urdu ********/

                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

                }else{ /******* If Language Is English **********/

                    $data['Word'] = 'English'; /********* Word array Is English ********/

                }/*********End of condition**********/

                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

                    /******** Language Get from model**********/

                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

                $data['UsersList'] = $this->Admindb->getdata(['IsDeleted'=>false,'StaffId !='=>$this->session->userdata('UserSession')->StaffId],'staff','Id','DESC'); /********get all users********* */

                $this->load->view('admin/pages/UsersList',$data); /********* hit UsersList home screen ********** */

            }

        }else{/*******else user is not admin******* */

            return redirect('admin');/*******return redirect to admin******* */

        }/******admin condition end******* */

    }/*********end of function UsersList/home******** */







    /*************** Insert AddUser Function ****************/

    public function AddUser($param1='')

    {/**********start of function*********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

        if ($param1 == 'InsertData') { /**********if param is upload************/

            if($this->input->post()){ /********* if session exist ********* */

                // var_dump($this->input->post()); die();

                $StaffId = rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000);

                if (!is_dir('./uploads/Staff/'.$StaffId)) {/********check if folder not exist******** */

                    mkdir('./uploads/Staff/'.$StaffId, 0777, TRUE);/***** create mkdir *******/

                }/******end of if****** */

                /*********Configrations to Upload Files */

                $StaffImage = [ /******** cover Image ********/

                    'upload_path' => './uploads/Staff/'.$StaffId.'/',/*****upload path***** */

                    'allowed_types' => 'jpg|jpeg|png'/******allowed types****** */

                ];/******array condition********/

                /**********Configration End ***********/

                $this->load->library('upload'); /***** Upload File Library *******/

                 /********upload Profile Image ******/

                $this->upload->initialize($StaffImage); /*****Initialize Profile Image ****/

                if ($this->upload->do_upload('StaffImage') ) { /***** Check Profile Image File Upload *****/

                    $StaffImage = $this->upload->data(); /****** push Array ************/



                    $config['image_library'] = 'gd2';

                    $config['source_image'] = './uploads/Staff/'.$StaffId.'/'.$StaffImage['file_name'];

                    $config['create_thumb'] = false;

                    $config['maintain_ratio'] = false;

                    $config['width']         = 500;

                    $config['height']       = 500;



                    $this->load->library('image_lib', $config);



                    $this->image_lib->resize();



                }else{

                    $StaffImage = null;

                }

                



                if($StaffImage != null){



                    $staffdata = array(

                        'StaffId'=> $StaffId,

                        'StaffName'=> $this->input->post('StaffName'),

                        'Password'=>$this->encryption->encrypt($this->input->post('Password')),

                        'Designation'=> $this->input->post('Designation'),

                        'StaffEmail'=> $this->input->post('StaffEmail'),

                        'PhoneNumber'=> $this->input->post('Phone'),

                        'StaffImage'=> $StaffImage['file_name'],

                        'IsActive' => true

                    );



                    $staffrole = array(

                        'StaffId'=> $StaffId,

                        'StaffRole'=> "SuperAdmin"

                    );



                    $checkdata = $this->Admindb->CheckConditionData(['StaffEmail'=>$this->input->post('StaffEmail'),'IsDeleted'=>false],'staff');



                    if($checkdata){



                        echo json_encode(['status'=>false,'message'=>'Email is already exist','data'=>null]); /******* echo json data***** */

                        log_message('error', 'Email is already exist'); /****** insert log****** */

                        exit; /***** exit *****/



                    }else{

                        $InsertStaff = $this->Admindb->InsertData($staffdata,'staff');

                        $insertrole = $this->Admindb->InsertData($staffrole,'staffrole');

                        if($InsertStaff){



                            /********** send message ***********/

                            echo json_encode(['status'=>true,'message'=>'Staff Insert Successfully','data'=>null]); /*******send jason data****** */

                            log_message('error', 'Staff Insert Successfully'); /****** insert log****** */

                            exit; /*****exit **** */



                        }else{



                            echo json_encode(['status'=>false,'message'=>'Network Problem Data Not Inserted','data'=>null]); /******* echo json data***** */

                            log_message('error', 'Network Problem Data Not Inserted'); /****** insert log****** */

                            exit; /*****exit **** */



                        }

                    }

                    

                }else{

                    echo json_encode(['status'=>false,'message'=>'ProfileImage Required','data'=>null]); /******* echo json data***** */

                    log_message('error', 'Document And Image Both Required'); /******insert log****** */

                    exit; /*****exit **** */

                }

            }else{ /****** else session not ******* */

                echo json_encode(['status'=>false,'message'=>'No Input Field Given','data'=>null]); /******* echo json data***** */

                log_message('error', 'No Input Field Given'); /******insert log****** */

                exit; /*****exit **** */

            } /****** condition *** */

       }else{

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

                /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

            $this->load->view('admin/pages/AddUser',$data); /********* hit AddUser home screen ********** */

       }

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/********function end******* */





    /************ UserRoles Home Function *********** */

    public function UserRoles($param="")

    { /********* start of UserRoles/home function********** */

        if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/

            if($param == "AssignRoles"){

                if($this->session->userdata('UserSession')->StaffRole == 'SuperAdmin'){ /****** check if user is SuperAdmin ****/



                    if($this->input->post()){ /********** if got post methode************ */

                        $falseadd = array(

                            'ManageSchool'=>false,

                            'InsertClass'=>false,

                            'InsertSubject'=>false,

                            'InsertSyllabus'=>false,

                            'ManageStudent'=>false,

                            'InsertStudent'=>false,

                            'StudentList'=>false,

                            'TeachersList'=>false,

                            'AssignedCourses'=>false,

                            'ManageAccounts'=>false,

                            'AddPayment'=>false,

                            'StudentLedger'=>false,

                            'BulkStudentPayment'=>false,

                            'InsertInvoice'=>false,

                            'InvoiceList'=>false,

                            'ManageSchedule'=>false,

                            'YearlyCalendar'=>false,

                            'ExamsSchedule'=>false,

                            'EmployeeList'=>false,

                            'JobResponsibility'=>false,

                            'Recruitment'=>false,

                            'CandidatesInformation'=>false,

                            'ShortlistedCandidates'=>false,

                            'SelectedCandidates'=>false,

                            'Users'=>false,

                            'AllUsers'=>false,

                            'AddUsers'=>false,

                            'UsersRole'=>false,

                            'Setting'=>false,

                            'Profile'=>false,

                            'SoftwareSetting'=>false,

                        );



                        $FalseUpdate = $this->Admindb->UpdateData1(['StaffId'=>$this->input->post('StaffId')],$falseadd,'staffrole');

                        

                        $roles = explode(',',$this->input->post('Roles'));

                        $data = array();

                        foreach ($roles as $key) {

                            $data[$key] = true;

                        }

                        $Update = $this->Admindb->UpdateData1(['StaffId'=>$this->input->post('StaffId')],$data,'staffrole');

                        if($Update){

                            echo json_encode(['status'=>true,'message'=>'Responsibility Added','data'=>null]); /********** send message ********** */

                            log_message('error', 'Responsibility Added'); /********* log messages******* */

                            exit; /********exit ******** */

                        }else{

                            echo json_encode(['status'=>false,'message'=>'Network problem Try Again','data'=>null]); /********** send message ********** */

                            log_message('error', 'Network problem Try Again'); /********* log messages******* */

                            exit; /********exit ******** */  

                        }

                    }

                }else{/********else user is not admin ******** */

                    echo json_encode(['status'=>false,'message'=>'You dont have Authority!!','data'=>null]);/*******send jason data******* */

                    exit;/******exit here******* */

                }/*******condition end******* */

            }else{

                $language = $this->session->userdata('language');/**********language session********** */

                if($language == 'Urdu'){ /******** If language is Urdu ********/

                    $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

                }else{ /******* If Language Is English **********/

                    $data['Word'] = 'English'; /********* Word array Is English ********/

                }/*********End of condition**********/

                $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

                    /******** Language Get from model**********/

                $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

                $data['UsersList'] = $this->Admindb->getdata(['IsDeleted'=>false,'StaffId !='=>$this->session->userdata('UserSession')->StaffId],'staff','Id','DESC'); /********get all users********* */

                $data['UserRole'] = $this->Admindb->SimpleJoin(['staff.StaffId !='=>$this->session->userdata('UserSession')->StaffId,'staff.IsActive'=>true,'staff.IsDeleted'=>false],'staff','staffrole','staff.StaffId = staffrole.StaffId','staff.Id','DESC','*');

                $this->load->view('admin/pages/UserRoles',$data); /********* hit UserRoles home screen ********** */

            }

        

    }else{/*******else user is not admin******* */

        return redirect('admin');/*******return redirect to admin******* */

    }/******admin condition end******* */

    }/*********end of function UserRoles/home******** */





     /*********** Verify Password Function **********/

     public function VerifyPassword($param="")

     {/**********password function start here**********/

        $UserSession = $this->session->userdata('UserSession');/**********get user session data********* */

         if ($param=="check") {/********** If Input Check ********/

            /******** Check Password Is Unique Or Exist ********/

             $Password = $this->input->post('OldPassword'); /********** Doctor Password ************/

            if ($this->encryption->decrypt($UserSession->Password) == $Password) { /***********If Password Exist */

                 /*******if Password  Exist */  

                 echo json_encode(['status'=>true,'message'=>'Password Verified','data'=>null]);/*******send jason data****** */

                 exit;/******exit here ***** */

             }else{/*******else if password not match******* */

                 /*******if Password Not Exist */

                 echo json_encode(['status'=>false,'message'=>'Password Not Verified','data'=>null]);/*******send jason data****** */

                 exit;/*******exit here******* */

             }/*********condition of password check end********* */

         }elseif($param == "changepassword"){/********if param is changepassword******** */

            $Password = $this->encryption->encrypt($this->input->post('Password'));/*******get password******* */

            $UpdatePassword = $this->Admindb->UpdateData(['Password'=>$Password],'staff',$UserSession->StaffId,'StaffId'); /** Database Password Update **/

                if ($UpdatePassword) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'Password Update Successfully','data'=>null]);/*******send jason data****** */

                    $this->session->unset_userdata('UserSession');/*******unset session user data******* */

                    exit;/********exit here********* */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data******* */

                    exit;/********exit here******* */

                }/*******condition end of update password******* */

         }elseif ($param == "Edit") {/******* If Request Is for Edit/Update ************/

            $StaffId = $this->input->post('StaffId');/********Staff Id get******** */

            $StaffData = array(/********start of array data******* */

                'StaffName'=>$this->input->post('StaffName'),/********Staff Name******** */

                'FatherName'=>$this->input->post('FatherName'),/********Father Name******* */

                'PhoneNumber'=>$this->input->post('PhoneNumber'),/******Phone Number******* */

                'StaffAddress'=>$this->input->post('StaffAddress'),/********Staff Address******** */

            );/********end of data******** */

            $UpdateStaff = $this->Admindb->UpdateData($StaffData,'staff',$StaffId,'StaffId'); /** Database Staff Update **/

                if ($UpdateStaff) {/****** Check If user Updated */

                    echo json_encode(['status'=>true,'message'=>'Employee Update Successfully','data'=>null]);/******send jason data****** */

                    exit;/*******exit here******* */

                }else{ /************ If user Not Insreted *********/

                    echo json_encode(['status'=>false,'message'=>'There Is issue while updating Please Try Again','data'=>null]);/*******send jason data******* */

                    exit; /*******exit here******** */

                }/********end of condition******* */

         }/******end of param condition******* */

     }/**********end of function********** */



     public function ClearAssignment(){

         $this->Admindb->TruncateTable('assignment');

         $this->Admindb->TruncateTable('uploadassignment');

         return redirect('AssignmentList');/*******return redirect to admin******* */

     }



     public function StudentResultCheck(){

        $language = $this->session->userdata('language');/**********language session********** */

        if($language == 'Urdu'){ /******** If language is Urdu ********/

            $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English ********/

        }/*********End of condition**********/

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********get all class********* */

        $this->load->view('admin/pages/StudentResultCheck',$data); /********* hit StudentResult home screen ********** */

     }





     public function ClassStudentResult($param=""){

        $language = $this->session->userdata('language');/**********language session********** */

        if($language == 'Urdu'){ /******** If language is Urdu ********/

            $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English ********/

        }/*********End of condition**********/

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['StudentsList'] = $this->Admindb->getdata(['ClassId'=>$param,'IsActive'=>true,'IsDeleted'=>false],'students','Id','DESC'); /********get all class********* */
        $data['ClassId'] = $param;
        $this->load->view('admin/pages/ClassStudentResult',$data); /********* hit StudentResult home screen ********** */

     }





     public function StudentReportCard($param="",$param2=""){

        $language = $this->session->userdata('language');/**********language session********** */

        if($language == 'Urdu'){ /******** If language is Urdu ********/

            $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English ********/

        }/*********End of condition**********/

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['Subjects'] = $this->Admindb->getdata(['ClassId'=>$param2,'IsActive'=>true,'IsDeleted'=>false],'subject','Id','DESC'); /********get all class********* */

        $data['Class'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********get all class********* */

        $data['StudentId'] = $param;

        $data['ClassId'] = $param2;

        // var_dump($data['ReportCard']); die();

        $this->load->view('admin/pages/StudentReportCard',$data); /********* hit StudentResult home screen ********** */

     }



     public function PromoteStudent(){

         if($this->input->post()){

            $data = array(

                'PromoteId' => rand(1,1000).''.rand(1,1000).''.rand(1,1000).''.rand(1,1000),

                'ClassId' => $this->input->post('ClassId'),

                'StudentId' => $this->input->post('StudentId'),

                'InsertDate' => date('Y-m-d')

            );

            $checkdata = $this->Admindb->CheckConditionData(['StudentId'=>$this->input->post('StudentId'),'IsActive'=>true,'IsDeleted'=>false],'promotelist');

            if($checkdata){

                echo json_encode(['status'=>false,'message'=>'Data already exist','data'=>null]);/*****send jason data**** */

                exit;/*******exit here******* */

            }else{

                $insertdata = $this->Admindb->InsertData($data,'promotelist');

                if($insertdata){

                    echo json_encode(['status'=>true,'message'=>'Student Promoted','data'=>null]);/*****send jason data**** */

                    exit;/*******exit here******* */

                }else{

                    echo json_encode(['status'=>true,'message'=>'Nework problem try later','data'=>null]);/*****send jason data**** */

                    exit;/*******exit here******* */

                }

            }

         }else{

            echo json_encode(['status'=>false,'message'=>'Please Select Class','data'=>null]);/*****send jason data**** */

            exit;/*******exit here******* */

         }

     }



     public function PromoteAll(){

         $getpromotiondata = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'promotelist','Id','ASC');

         if($getpromotiondata){

            foreach($getpromotiondata as $GEPR){

                $updatepromotion = $this->Admindb->UpdateData1(['StudentId'=>$GEPR->StudentId,'IsActive'=>true,'IsDeleted'=>false],['ClassId'=>$GEPR->ClassId],'students');

            }

         }

         if($updatepromotion){

             $this->Admindb->TruncateTable('promotelist');

            $this->session->set_flashdata('Promoted', 'Students Promoted');

            $this->session->set_flashdata('CheckStatus', 'True');

            return redirect('PromoteStudent');

         }else{

            $this->session->set_flashdata('Promoted', 'Network issue try later');

            $this->session->set_flashdata('CheckStatus', 'False');

            return redirect('PromoteStudent');

         }

     }


     public function ClassStudent(){

        $language = $this->session->userdata('language');/**********language session********** */

        if($language == 'Urdu'){ /******** If language is Urdu ********/

            $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English ********/

        }/*********End of condition**********/

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********get all class********* */

        $this->load->view('admin/pages/ClassStudent',$data); /********* hit StudentResult home screen ********** */

     }

     public function ClassStudentsList($param=""){

        $language = $this->session->userdata('language');/**********language session********** */

        if($language == 'Urdu'){ /******** If language is Urdu ********/

            $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

        }else{ /******* If Language Is English **********/

            $data['Word'] = 'English'; /********* Word array Is English ********/

        }/*********End of condition**********/

        $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

        $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/

        $data['StudentsList'] = $this->Admindb->getdata(['ClassId'=>$param,'IsActive'=>true,'IsDeleted'=>false],'students','Id','DESC'); /********get all class********* */
        $data['ClassId'] = $param;

        $this->load->view('admin/pages/ClassStudentsList',$data); /********* hit StudentResult home screen ********** */

     }


     public function ClassStudentCSV($param = "")

    {/***********start of excel file download function********* */


            $this->load->helper('csv');/*********call Csv helper create by self********** */

            $ExportFile = array();/*********define empty array here******** */

            

                $StudentData = $this->Admindb->getdata(['ClassId'=>$param,'IsActive'=>true,'IsDeleted'=>false],'students','Id','DESC'); /********get all class********* */


                $Class = $this->Admindb->SingleRowField(['ClassId'=>$param,'IsActive'=>true,'IsDeleted'=>false],'class','ClassName');

            

            $Header = array("#","Student Name","Father Name", "GR No","Class","Section", "Phone", "BirthDate", "Fee","Religion","Address",

            );/*********array of head field names********** */

            array_push($ExportFile, $Header);/*******pish values to array********* */

            if (!empty($StudentData)) {/*******if data is exist of fee******* */
                $i = 1;
                foreach ($StudentData as $STUD) {/**********execute foreach loop to print data******* */

                    $Section = $this->Admindb->SingleRowField(['SectionId'=>$STUD->SectionId,'IsActive'=>true,'IsDeleted'=>false],'sections','SectionName');
                    

                    array_push($ExportFile, array($i, $STUD->StudentName,$STUD->FatherName,$STUD->StudentGR,$Class,$Section,$STUD->FatherPhone,$STUD->BirthDate,$STUD->Fee,$STUD->Religion,$STUD->Address
                    ));/***********push array fields result comes from database********** */

                    $i++;
                }/********end of foreach loop******** */

            }/*********if data not empty condition end******* */

            convert_to_csv($ExportFile, 'Student' . date('F-d-Y') . '.csv', ',');/***********convert and download csv file******** */

    }


    


     


      /****************** Insert PrintVouchersMul ******************/

    
      public function PrintVouchersMul($param='')

	{
            
            if($param == "SingleVoucher"){
                $GRNumber = $this->input->post('GRNumber');
                $Month = $this->input->post('Month');
                $Year = $this->input->post('Year');

                $StudentId = $this->Admindb->SingleRowField(['GRNumber'=>$GRNumber,'IsActive'=>true,'IsDeleted'=>false],'students','StudentId');
                
                if($StudentId){

                    $data['Voucher'] = $this->Admindb->TwoJoinrow(['students.IsActive' => true,'fee.StudentId'=>$StudentId,'fee.Month'=>$Month,'Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','Id','ASC','fee.Id,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.AfterDueDate,fee.MonthNumber');

                    
                    // $OutStandingAmount = $this->Admindb->getdata(['StudentId'=>$StudentId,'FeeId !='=>$data['Voucher']->FeeId,'IsActive'=>true,'IsDeleted'=>false],'fee','Id','ASC');/**********get data*********** */
                   
                    // $RemFeeMass = 0;

                    //  if(!empty($OutStandingAmount)){
                    //     foreach($OutStandingAmount as $OUSTAM){
                    //         $RemFeeMass += $OUSTAM->Dues;
                    //     }
                    // }

                    

                    if($data['Voucher']){

                        $dated = '31/'.$Month.'/'.$Year;
                        $date_converted = str_replace('/', '-', $dated);
                        //back month date
                        $data['PreviousDate']  =  date("Y-m-d", strtotime("-1 months", strtotime($date_converted)));
                        $data['OutStanding'] = $this->Admindb->SumRecord(['StudentId'=>$data['Voucher']->StudentId,'MonthNumber <>'=>0,'MonthNumber <'=>$data['Voucher']->MonthNumber,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');;
                        
                        $data['Dues_OutStanding'] = $this->Admindb->SumRecord(['StudentId'=>$data['Voucher']->StudentId,'MonthNumber <'=>$data['Voucher']->MonthNumber,'IsActive'=>true,'IsDeleted'=>false],'Dues','fee');

                        $data['MonthNumber'] = $data['Voucher']->MonthNumber;
                        $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/
                        
                        $this->load->view('admin/pages/printvoucher',$data);/********hit StudentLedger view******** */

                    }else{

                        return redirect('PrintVouchersMul');

                    }


                }else{
                    return redirect('PrintVouchersMul');
                }
            }elseif($param == 'MultipleVoucher'){

                $ClassId = $this->input->post('ClassId');

                $Month = $this->input->post('Month');

                $Year = $this->input->post('Year');

                $dated = '31/'.$Month.'/'.$Year;
                $date_converted = str_replace('/', '-', $dated);

                //back month date 
                $data['PreviousDate']  =  date("Y-m-d", strtotime("-1 months", strtotime($date_converted)));

                $data['BulkFee'] = $this->Admindb->TwoJoin(['students.IsActive' => true,'fee.ClassId'=>$ClassId,'fee.Month'=>$Month,'fee.Year'=>$Year,'fee.IsActive'=>true,'fee.IsDeleted'=>false],'fee','students','fee.StudentId = students.StudentId','class','fee.ClassId = class.ClassId','students.GRNumber','DESC','fee.Id,fee.FeeMonth,fee.FeeId,fee.StudentId,fee.Month,fee.Year,fee.Fee,fee.Status,fee.Method,fee.Description,fee.CreationDate,fee.DueDate,fee.IsActive,students.StudentName,students.StudentGR,students.FatherName,class.ClassName,fee.Dues,fee.AmountPaid,fee.PaidDate,fee.BankRef,fee.UpdatedBy,students.GRNumber');

//                echo "<pre>"; print_r($data['BulkFee']); echo "</pre>";
                $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ***/

                if($data['BulkFee']){
                    $data['ClassId'] = $ClassId;
                    $data['Month'] = $Month;
                    $data['Year'] = $Year;
//                    echo "<pre>"; print_r($data); echo "</pre>";
                    $this->load->view('admin/pages/BulkVoucher',$data);
                    /********hit BulkVoucher view******** */
                }else{
                    return redirect('PrintVouchersMul');
                }
            }else{

            $language = $this->session->userdata('language');/**********language session********** */

            if($language == 'Urdu'){ /******** If language is Urdu ********/

                $data['Word'] = 'Urdu'; /******** Word array Urdu ******/

            }else{ /******* If Language Is English **********/

                $data['Word'] = 'English'; /********* Word array Is English ********/

            }/*********End of condition**********/

            $data['UserSession'] = $this->session->userdata('UserSession'); /********** Send User Data Into Array *********/

            /******** Language Get from model**********/

            $data['Language'] = $this->Admindb->language(); /********* Get Language From Database ********/

            $data['CompanyList'] = $this->Admindb->CompanyList(); /********* Get Hospital Data From Database ************/


            // $data['EventList'] = $this->Admindb->EventList();/*********Event List******** */

            $data['ClassList'] = $this->Admindb->getdata(['IsActive'=>true,'IsDeleted'=>false],'class','Id','ASC'); /********* Get class Data From Database ************/

            $this->load->view('admin/pages/PrintVouchersMul',$data);/********hit PrintVoucherMul view******** */
        }

    }/*********end of language function********* */

     
     /****************** Insert Language ******************/

	public function language($param='')

	{/**********start of language function********** */

       if($param == 'Urdu'){/*********param is Urdu********* */

        $this->session->set_userdata('language','Urdu');/******set user data language******* */

        return redirect('admin');/********return redirect******** */

       }else{/********else******* */

        $this->session->set_userdata('language','English');/*******set userdata language******** */

        return redirect('admin');/******return redirect****** */

       }/********end of condition********* */

    }/*********end of language function********* */



    /**************Logout function**************/

	public function logout()

	{/*********logout function start******* */

        $UserSession = $this->session->userdata('UserSession');/*********user data session******** */

        $UpdateLogin = $this->Admindb->UpdateLogin($UserSession->SessionId,date('y-m-d'),date('h:i:s'));/*******update login***** */

		$this->session->unset_userdata('UserSession');/*********unset session******** */

		return redirect('AdminLogin');/********redirect to login******* */

    }/********logout function******** */

}





?>

