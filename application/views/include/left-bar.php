<aside class="main-sidebar sidebar-dark-orange elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin'); ?>" class="brand-link">
        <img src="<?php echo base_url('adminassets/media/tvl-logo.jpg'); ?>" alt="TVL Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">TVL Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo base_url('adminassets/media/courseimagenotfound.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo BASE_URL; ?>profile.php" class="d-block">TVL User</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 fs13">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview<?php echo ($curl === 'admin')?' menu-open' :''; ?>">
                    <a href="<?php echo base_url('admin'); ?>" class="nav-link<?php echo ($curl === 'admin')?' active' :''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <!-- <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
                </li>
                <?php if($this->session->userdata('UserSession')->Courses == true){ ?> 
                <li class="nav-item has-treeview<?php echo ($curl === 'CourseList' || $curl === 'Subjects' || $curl === 'Grades' || $curl === 'ResourceTypes')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'CourseList' || $curl === 'Subjects' || $curl === 'Grades' || $curl === 'ResourceTypes')?' active' :''; ?>">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Courses
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if($this->session->userdata('UserSession')->AllCourses == true){ ?> 
                        <li class="nav-item">
                            <a href="<?php echo base_url('CourseList'); ?>" class="nav-link<?php echo ($curl === 'CourseList')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Courses</p>
                            </a>
                        </li>
                    <?php } ?>
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/product/product-add.php" class="nav-link<?php //echo ($curl === 'product-add.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add New</p>
                            </a>
                        </li> -->
                    <?php if($this->session->userdata('UserSession')->Subjects == true){ ?> 
                        <li class="nav-item">
                            <a href="<?php echo base_url('Subjects'); ?>" class="nav-link<?php echo ($curl === 'Subjects')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Subjects</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->Grades == true){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Grades'); ?>" class="nav-link<?php echo ($curl === 'Grades')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Grades</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->ResourceTypes == true){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('ResourceTypes'); ?>" class="nav-link<?php echo ($curl === 'ResourceTypes')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Resource Types</p>
                            </a>
                        </li>
                    <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <!-- <li class="nav-item has-treeview<?php //echo ($curl === 'coupon-list.php')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php //echo ($curl === 'coupon-list.php')?' active' :''; ?>">
                    <i class="nav-icon fas fa-barcode"></i>
                    <p>
                        Coupons
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/coupon/coupon-list.php" class="nav-link<?php //echo ($curl === 'coupon-list.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Coupon</p>
                            </a>
                        </li>                        
                    </ul>
                </li> -->
                <?php if($this->session->userdata('UserSession')->SellerBuyer == true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'TeachersList' || $curl === 'School' || $curl === 'Publishers' || $curl === 'Students')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'TeachersList' || $curl === 'School' || $curl === 'Publishers' || $curl === 'Students')?' active' :''; ?>">
                    <i class="nav-icon fab fa-sellsy"></i>
                    <p>
                        Sellers/Buyers
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if($this->session->userdata('UserSession')->Teachers == true){ ?>
                        <li class="nav-item has-treeview<?php echo ($curl === 'TeachersList')?' menu-open' :''; ?>">
                            <a href="<?php echo base_url('TeachersList'); ?>" class="nav-link<?php echo ($curl === 'TeachersList')?' active' :''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Teachers
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->Schools == true){ ?>
                        <li class="nav-item has-treeview<?php echo ($curl === 'School')?' menu-open' :''; ?>">
                            <a href="<?php echo base_url('School'); ?>" class="nav-link<?php echo ($curl === 'School')?' active' :''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Schools
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->Publishers == true){ ?>
                        <li class="nav-item has-treeview<?php echo ($curl === 'Publishers')?' menu-open' :''; ?>">
                            <a href="<?php echo base_url('Publishers'); ?>" class="nav-link<?php echo ($curl === 'Publishers')?' active' :''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Publishers
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->Students == true){ ?>
                        <li class="nav-item has-treeview<?php echo ($curl === 'Students')?' menu-open' :''; ?>">
                            <a href="<?php echo base_url('Students'); ?>" class="nav-link<?php echo ($curl === 'Students')?' active' :''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Students
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->PendingReq == true){ ?>
                        <li class="nav-item has-treeview<?php echo ($curl === 'PendingRequests')?' menu-open' :''; ?>">
                            <a href="<?php echo base_url('PendingReq'); ?>" class="nav-link<?php echo ($curl === 'PendingRequests')?' active' :''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    PendingRequest
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>
                        </li>
                    <?php } ?>                   
                    </ul>
                </li>
                <?php } ?>

                <?php if($this->session->userdata('UserSession')->Users == true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'UsersList' || $curl === 'AddUser' || $curl === 'UserRoles')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'UsersList' || $curl === 'AddUser' || $curl === 'UserRoles')?' active' :''; ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Users
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if($this->session->userdata('UserSession')->AllUsers == true){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('UsersList'); ?>" class="nav-link<?php echo ($curl === 'UsersList')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>All Users</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->AddUser == true){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('AddUser'); ?>" class="nav-link<?php echo ($curl === 'AddUser')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add User</p>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if($this->session->userdata('UserSession')->UserRoles == true){ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('UserRoles'); ?>" class="nav-link<?php echo ($curl === 'UserRoles')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User Roles</p>
                            </a>
                        </li> 
                    <?php } ?>                       
                    </ul>
                </li>
                <?php } ?>
                <?php if($this->session->userdata('UserSession')->Reports == true){ ?>
                <li class="nav-item has-treeview<?php echo ($curl === 'report.php' || $curl === 'sale.php' || $curl === 'seller.php' || $curl === 'buyer.php' || $curl === 'commission.php')?' menu-open' :''; ?>">
                    <a href="#" class="nav-link<?php echo ($curl === 'report.php' || $curl === 'sale.php' || $curl === 'seller.php' || $curl === 'buyer.php' || $curl === 'commission.php')?' active' :''; ?>">
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
                        </li> -->
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>views/reports/sale.php" class="nav-link<?php echo ($curl === 'sale.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Total Sale</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/seller.php" class="nav-link<?php //echo ($curl === 'seller.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Seller</p>
                            </a>
                        </li> -->
                        <!-- <li class="nav-item">
                            <a href="<?php //echo BASE_URL; ?>views/reports/buyer.php" class="nav-link<?php echo ($curl === 'buyer.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buyer</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>views/reports/commission.php" class="nav-link<?php echo ($curl === 'commission.php')?' active' :''; ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Commission</p>
                            </a>
                        </li>                        
                    </ul>
                </li>
                <?php } ?>                        
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>