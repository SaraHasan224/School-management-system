
<body class="hold-transition skin-blue sidebar-mini">
  <!-- Modal -->
      <div class="modal fade bd-example-modal-sm" id="ListClick" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      </div>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('Admin'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><?php if(!empty($CompanyList->CompanyShortName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyShortName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyShortName;} }else{ echo "JT"; } ?></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-cogs"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <?php if(!empty($UserSession->StaffImage)){ ?> 
          <img src="<?php echo base_url('uploads/StaffImage/'.$UserSession->StaffImage); ?>" class="img-circle" alt="User Image">
        <?php }else{ ?>
          <img src="<?php echo base_url('uploads/StaffImage/default.png'); ?>" class="img-circle" alt="User Image">
        <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php if(!empty($UserSession->StaffName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$UserSession->StaffName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $UserSession->StaffName;} }else{ echo "JemsTech"; } ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Online"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Online";}?></a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Main Navigation"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Main Navigation";}?></li>

        <!-- Reports Li Start -->

        <?php if($this->session->userdata('UserSession')->ManageSchool == true){ ?>

        <li class="treeview<?php echo ($curl === 'InsertSchool' || $curl === 'InsertClass' || $curl === 'ManageSyllabus')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $Reportlan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage School"')->row();?>
          <i class="fa fa-school"></i>
            <span><?php if(!empty($Reportlan)){ echo $Reportlan->$Word; }else{echo "Manage School";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="nav-link<?php //echo ($curl === 'InsertSchool')?' active' :''; ?>"><a href="<?php //echo base_url('InsertSchool'); ?>"><i class="fa fa-circle-o"></i><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert School"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert School";}?></a></li>
            <li class="nav-link<?php //echo ($curl === 'PrimarySchool')?' active' :''; ?>"><a href="<?php //echo base_url('PrimarySchool'); ?>"><i class="fa fa-circle-o"></i><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Primary School"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Primary School";}?></a></li>
            <li class="nav-link<?php //echo ($curl === 'SecondarySchool')?' active' :''; ?>"><a href="<?php //echo base_url('SecondarySchool'); ?>"><i class="fa fa-circle-o"></i><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Secondary School"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Secondary School";}?></a></li> -->
            <?php if($this->session->userdata('UserSession')->InsertClass == true){ ?>

              <li class="nav-link<?php echo ($curl === 'InsertClass')?' active' :''; ?>"><a href="<?php echo base_url('InsertClass') ?>"><i class="fa fa-book"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Class";}?></a></li>
              <!-- onclick="CallFunction('InsertSubject')" -->

              <?php } ?>

            <?php if($this->session->userdata('UserSession')->InsertSubject == true){ ?>

              <li class="nav-link<?php echo ($curl === 'InsertSubject')?' active' :''; ?>"><a href="<?php echo base_url('InsertSubject') ?>"><i class="fa fa-book"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Subject";}?></a></li>

              <?php } ?>

              <?php if($this->session->userdata('UserSession')->InsertSyllabus == true){ ?>
              <li class="nav-link<?php echo ($curl === 'ManageSyllabus')?' active' :''; ?>"><a href="<?php echo base_url('ManageSyllabus') ?>"><i class="fa fa-file-alt"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Syllabus"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Syllabus";}?></a></li>
              <?php } ?>

          </ul>
        </li>
        <?php } ?>

        <?php if($this->session->userdata('UserSession')->ManageStudent == true){ ?>
        <!-- Reports Li Start -->
        <li class="treeview<?php echo ($curl === 'InsertStudent' || $curl === 'StudentsList' || $curl === 'AssignmentList' || $curl === 'StudentResultCheck' || $curl === 'ClassStudent')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $Reportlan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage Student"')->row();?>
          <i class="fa fa-users"></i>
            <span><?php if(!empty($Reportlan)){ echo $Reportlan->$Word; }else{echo "Manage Student";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($this->session->userdata('UserSession')->InsertStudent == true){ ?>

            <li class="nav-link<?php echo ($curl === 'InsertStudent')?' active' :''; ?>"><a href="<?php echo base_url('InsertStudent'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Student"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Student";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->StudentList == true){ ?>

            <li class="nav-link<?php echo ($curl === 'StudentsList')?' active' :''; ?>"><a href="<?php echo base_url('StudentsList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Students List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Students List";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->StudentActiveList = true){ ?>

            <li class="nav-link<?php echo ($curl === 'StudentsActiveList')?' active' :''; ?>"><a href="<?php echo base_url('StudentsActiveList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Students Active List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Students Active List";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->StudentInActiveList = true){ ?>

            <li class="nav-link<?php echo ($curl === 'StudentsInActiveList')?' active' :''; ?>"><a href="<?php echo base_url('StudentsInActiveList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Students InActive List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Students InActive List";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->AssignmentList = true){ ?>

            <li class="nav-link<?php echo ($curl === 'AssignmentList')?' active' :''; ?>"><a href="<?php echo base_url('AssignmentList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Students List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assignment List";}?></a></li>

            <?php } ?>


            <?php if($this->session->userdata('UserSession')->StudentResultCheck = true){ ?>
              <li class="nav-link<?php echo ($curl === 'StudentResultCheck')?' active' :''; ?>"><a href="<?php echo base_url('StudentResultCheck') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Result"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student Result";}?></a></li>
            <?php } ?>

            <?php if($this->session->userdata('UserSession')->ClassStudent = true){ ?>
              <li class="nav-link<?php echo ($curl === 'ClassStudent')?' active' :''; ?>"><a href="<?php echo base_url('ClassStudent') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class Students"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class Students";}?></a></li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if($this->session->userdata('UserSession')->TeachersList == true){ ?>
        <li class="nav-link<?php echo ($curl === 'TeachersList')?' active' :''; ?>"><a href="<?php echo base_url('TeachersList'); ?>"><i class="fa fa-book"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Teachers List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Teachers List";}?></a></li>
        <?php } ?>

        <?php if($this->session->userdata('UserSession')->AssignedCourses == true){ ?>

        <li class="nav-link<?php echo ($curl === 'AssignedCourses')?' active' :''; ?>"><a href="<?php echo base_url('AssignedCourses'); ?>"><i class="fa fa-book"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Assigned Courses"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assigned Courses";}?></a></li>

        <?php } ?>
          <!-- Reports Li Start -->

          <?php if($this->session->userdata('UserSession')->ManageAccounts == true){ ?>


          <li class="treeview<?php echo ($curl === 'AddPayment' || $curl === 'StudentLedger')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $Reportlan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage Accounts"')->row();?>
          <i class="fa fa-users"></i>
            <span><?php if(!empty($Reportlan)){ echo $Reportlan->$Word; }else{echo "Manage Accounts";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($this->session->userdata('UserSession')->AddPayment == true){ ?>

            <li class="nav-link<?php echo ($curl === 'AddPayment')?' active' :''; ?>"><a href="<?php echo base_url('AddPayment'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Payment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Payment";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->StudentLedger == true){ ?>

            <li class="nav-link<?php echo ($curl === 'StudentLedger')?' active' :''; ?>"><a href="<?php echo base_url('StudentLedger'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Ledger"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student Ledger";}?></a></li>

            <?php } ?>
            
            <?php if($this->session->userdata('UserSession')->BulkStudentPayment == true){ ?>

            <li class="nav-link<?php echo ($curl === 'BulkPayment')?' active' :''; ?>"><a href="<?php echo base_url('BulkPayment'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Bulk Student Payment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Bulk Student Payment";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->OutStandingList = true){ ?>

            <li class="nav-link<?php echo ($curl === 'OutStandingList')?' active' :''; ?>"><a href="<?php echo base_url('OutStandingList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Summary"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Summary";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->OutStandingSummary = true){ ?>

            <li class="nav-link<?php echo ($curl === 'OutStandingSummary')?' active' :''; ?>"><a href="<?php echo base_url('OutStandingSummary'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Outstanding Summary"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Outstanding Summary";}?></a></li>

            <?php } ?>
            
            <?php if($this->session->userdata('UserSession')->PrintVouchersMul = true){ ?>

            <li class="nav-link<?php echo ($curl === 'PrintVouchersMul')?' active' :''; ?>"><a href="<?php echo base_url('PrintVouchersMul'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Print Voucher"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Print Voucher";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->InsertInvoice == true){ ?>

            <li class="nav-link<?php echo ($curl === 'Invoice')?' active' :''; ?>"><a href="<?php echo base_url('Invoice'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Invoice"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Invoice";}?></a></li>

            <?php } ?>
            
            <?php if($this->session->userdata('UserSession')->InvoiceList == true){ ?>

            <li class="nav-link<?php echo ($curl === 'InvoiceList')?' active' :''; ?>"><a href="<?php echo base_url('InvoiceList'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Invoice List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Invoice List";}?></a></li>

            <?php } ?>
          </ul>
        </li>

          <?php } ?>
          <!-- Reports Li Start -->
          <?php if($this->session->userdata('UserSession')->ManageSchedule == true){ ?>

        <li class="treeview<?php echo ($curl === 'ManageSchedule' || $curl === 'ManageExams')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $Reportlan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage Yearly Schedule"')->row();?>
          <i class="fa fa-users"></i>
            <span><?php if(!empty($Reportlan)){ echo $Reportlan->$Word; }else{echo "Manage Schedule";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($this->session->userdata('UserSession')->YearlyCalendar == true){ ?>

          <li class="nav-link<?php echo ($curl === 'ManageSchedule')?' active' :''; ?>"><a href="<?php echo base_url('ManageSchedule') ?>"><i class="fa fa-calendar"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Yearly Calendar"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Yearly Calendar";}?></a></li>

          <?php } ?>

          <?php if($this->session->userdata('UserSession')->ExamsSchedule == true){ ?>

          <li class="nav-link<?php echo ($curl === 'ManageExams')?' active' :''; ?>"><a href="<?php echo base_url('ManageExams') ?>"><i class="fa fa-clock"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exams Schedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exams Schedule";}?></a></li> 

          <?php } ?>
          </ul>
        </li>
          
          <?php } ?>




            <!-- <li class="nav-link<?php //echo ($curl === 'ManageHolidays')?' active' :''; ?>"><a href="<?php //echo base_url('ManageHolidays') ?>"><i class="fa fa-clock"></i><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holidays"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holidays";}?></a></li>   -->
        <!-- Reports Li Start -->
        
            
            <?php if($this->session->userdata('UserSession')->EmployeeList == true){ ?>

              <li class="nav-link<?php echo ($curl === 'Employees')?' active' :''; ?>"><a href="<?php echo base_url('Employees') ?>"><i class="fa fa-user-shield"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Employee List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Employee List";}?></a></li>
            
            <?php } ?>
            
            <?php if($this->session->userdata('UserSession')->JobResponsibility == true){ ?>

            <li class="nav-link<?php echo ($curl === 'JobResponsibility')?' active' :''; ?>"><a href="<?php echo base_url('JobResponsibility') ?>"><i class="fa fa-calendar"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Job Responsibility"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Job Responsibility";}?></a></li>
          
            <?php } ?> 
          
            
          <!-- Recruitment Li Start -->
          <?php if($this->session->userdata('UserSession')->Recruitment == true){ ?>

        <li class="treeview<?php echo ($curl === 'Recruitment' || $curl === 'Shortlisted' || $curl === 'Selected')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $InsLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Recruitment"')->row();?>
          <i class="fa fa-recycle"></i>
            <span><?php if(!empty($InsLan)){ echo $InsLan->$Word; }else{echo "Recruitment";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <?php if($this->session->userdata('UserSession')->CandidatesInformation == true){ ?>

            <li class="nav-link<?php echo ($curl === 'Recruitment')?' active' :''; ?>"><a href="<?php echo base_url('Recruitment') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Candidates Information"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Candidates Information";}?></a></li>
          
          <?php } ?>

            <?php if($this->session->userdata('UserSession')->ShortlistedCandidates == true){ ?>

            <li class="nav-link<?php echo ($curl === 'Shortlisted')?' active' :''; ?>"><a href="<?php echo base_url('Shortlisted') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Shortlisted Candidates"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Shortlisted Candidates";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->SelectedCandidates == true){ ?>

            <li class="nav-link<?php echo ($curl === 'Selected')?' active' :''; ?>"><a href="<?php echo base_url('Selected') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Selected Candidates"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Selected Candidates";}?></a></li>
         
            <?php } ?>
          </ul>
        </li>

          <?php } ?>






        <?php if($this->session->userdata('UserSession')->Users == true){ ?>
        <li class="treeview<?php echo ($curl === 'UsersList' || $curl === 'AddUser' || $curl === 'UserRoles')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $InsLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Users"')->row();?>
          <i class="fa fa-users"></i>
            <span><?php if(!empty($InsLan)){ echo $InsLan->$Word; }else{echo "Users";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <?php if($this->session->userdata('UserSession')->AllUsers == true){ ?>
            <li class="nav-link<?php echo ($curl === 'UsersList')?' active' :''; ?>"><a href="<?php echo base_url('UsersList') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "All Users"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "All Users";}?></a></li>

            <?php } ?>

            <?php if($this->session->userdata('UserSession')->AddUsers == true){ ?>
            <li class="nav-link<?php echo ($curl === 'AddUser')?' active' :''; ?>"><a href="<?php echo base_url('AddUser') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add User"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add User";}?></a></li>
            <?php } ?>

            <?php if($this->session->userdata('UserSession')->UsersRole == true){ ?>
            <li class="nav-link<?php echo ($curl === 'UserRoles')?' active' :''; ?>"><a href="<?php echo base_url('UserRoles') ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "User Roles"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "User Roles";}?></a></li>
            <?php } ?>

          </ul>
        </li>
        <?php } ?>

        <?php $LogLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Admission Form"')->row();?>
        <li><a href="<?php echo base_url('AdmissionForm/AdmissionForm.pdf'); ?>" target="_blank"><i class="fa fa-sign-out-alt"></i> <span><?php if(!empty($LogLan)){ echo $LogLan->$Word; }else{echo "Admission Form";} ?></span></a></li>

        <?php if($this->session->userdata('UserSession')->Setting == true){ ?>
        <!-- Setting Li Start -->
        <li class="treeview<?php echo ($curl === 'Profile' || $curl === 'SoftwareSetting')?' active menu-open' :''; ?>">
          <a href="#">
          <?php $SetLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Setting"')->row();?>
          <i class="fa fa-cogs"></i>
            <span><?php if(!empty($SetLan)){ echo $SetLan->$Word; }else{echo "Setting";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

          <?php if($this->session->userdata('UserSession')->Profile == true){ ?>
            <li class="nav-link<?php echo ($curl === 'Profile')?' active' :''; ?>"><a href="<?php echo base_url('Profile'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Profile"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Profile";}?></a></li>
          <?php } ?>

          <?php if($this->session->userdata('UserSession')->SoftwareSetting == true){ ?>
            <li class="nav-link<?php echo ($curl === 'SoftwareSetting')?' active' :''; ?>"><a href="<?php echo base_url('SoftwareSetting'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Software Setting"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Software Setting";}?></a></li>
          <?php } ?>
          </ul>
        </li>
        <!-- Language Li Start -->
        <?php } ?>

        <li class="treeview">
          <a href="#">
          <?php $LangLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Language"')->row();?>
          <i class="fa fa-language"></i>
            <span><?php if(!empty($LangLan)){ echo $LangLan->$Word; }else{echo "Language";} ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/language/English'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "English"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "English";}?></a></li>
            <li><a href="<?php echo base_url('admin/language/Urdu'); ?>"><i class="fa fa-circle-o"></i><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Urdu"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Urdu";}?></a></li>
          </ul>
        </li>
        
        

        <?php $LogLan = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Logout"')->row();?>
        <li><a href="<?php echo base_url('Logout'); ?>"><i class="fa fa-sign-out-alt"></i> <span><?php if(!empty($LogLan)){ echo $LogLan->$Word; }else{echo "Logout";} ?></span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script>
                // function CallFunction(param) {
                //   $('#ContentResult').empty();
                //     $.ajax({
                //       url:"<?php //echo base_url('Admin/'); ?>"+param,
                //       beforeSend: function(){
                //         document.getElementById('ContentResult').innerHTML = "<div class='page-loader' id='page-loader'>"+
                //         "<div class='loader'>"+
                //           "<span class='dot dot_1'></span>"+
                //           "<span class='dot dot_2'></span>"+
                //           "<span class='dot dot_3'></span>"+
                //           "<span class='dot dot_4'></span>"+
                //         "</div>"+
                //       "</div>";
                //       },
                //       complete: function(){
                //         $("#page-loader").hide();
                //       },
                //       success:function(data)
                //       {
                //         $('#ContentResult').html(data);
                //       }
                //     });
                // }
              </script>
  
        




