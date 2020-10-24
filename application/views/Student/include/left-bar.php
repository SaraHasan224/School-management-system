<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin'); ?>" class="brand-link">
        <img src="<?php echo base_url('adminassets/media/tvl-logo.jpg'); ?>" alt="TVL Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Student</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="<?php //echo base_url('adminassets/media/courseimagenotfound.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <!-- <div class="info">
                <a href="<?php //echo BASE_URL; ?>profile.php" class="d-block">TVL User</a>
            </div> -->
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-5 fs13">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview<?php echo ($curl === 'Student')?' menu-open' :''; ?>">
                    <a href="<?php echo base_url('Student'); ?>" class="nav-link<?php echo ($curl === 'Student')?' active' :''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                
                <?php if($this->session->userdata('StudentSession')->Courses = true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'MyCourses' || $curl === 'MySyllabus' || $curl === 'MyAssignment')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'MyCourses' || $curl === 'MySyllabus' || $curl === 'MyAssignment')?' active' :''; ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Courses
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('MyCourses'); ?>" class="nav-link<?php echo ($curl === 'MyCourses')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Courses List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('MySyllabus'); ?>" class="nav-link<?php echo ($curl === 'MySyllabus')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Syllabus</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('MyAssignment'); ?>" class="nav-link<?php echo ($curl === 'MyAssignment')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Assignment</p>
                            </a>
                        </li>                
                    </ul>
                </li>
                <?php } ?> 


                <?php if($this->session->userdata('StudentSession')->Courses = true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'YearlySchedule' || $curl === 'Exams')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'YearlySchedule' || $curl === 'Exams')?' active' :''; ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Schedule
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('YearlySchedule'); ?>" class="nav-link<?php echo ($curl === 'YearlySchedule')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Yearly Calendar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('ExamsTime'); ?>" class="nav-link<?php echo ($curl === 'ExamsTime')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Exams Time</p>
                            </a>
                        </li>             
                    </ul>
                </li>
                <?php } ?>   


                <?php if($this->session->userdata('StudentSession')->Courses = true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'ReportCard' || $curl === 'SubjectResult' || $curl === 'SetMarks')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'ReportCard' || $curl === 'SubjectResult' || $curl === 'SetMarks')?' active' :''; ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Result
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="<?php echo base_url('SubjectResult'); ?>" class="nav-link<?php echo ($curl === 'SubjectResult')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subject's Result</p>
                            </a>
                        </li>  
                        
                        <li class="nav-item">
                            <a href="<?php echo base_url('ReportCard'); ?>" class="nav-link<?php echo ($curl === 'ReportCard')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Final Report Card</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>  

                    

                <!-- <?php //if($this->session->userdata('StudentSession')->Reports = true){ ?>
                <li class="nav-item has-treeview<?php //echo ($curl === 'report.php' || $curl === 'sale.php' || $curl === 'seller.php' || $curl === 'buyer.php' || $curl === 'commission.php')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php //echo ($curl === 'report.php' || $curl === 'sale.php' || $curl === 'seller.php' || $curl === 'buyer.php' || $curl === 'commission.php')?' active' :''; ?>">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        Reports
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/report.php" class="nav-link<?php //echo ($curl === 'report.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Report</p>
                            </a>
                        </li> --
                        <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/sale.php" class="nav-link<?php //echo ($curl === 'sale.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Total Sale</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/seller.php" class="nav-link<?php //echo ($curl === 'seller.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Seller</p>
                            </a>
                        </li> --
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/buyer.php" class="nav-link<?php //echo ($curl === 'buyer.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buyer</p>
                            </a>
                        </li> --
                        <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/commission.php" class="nav-link<?php //echo ($curl === 'commission.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Commission</p>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <?php //} ?>                         -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>