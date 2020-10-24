<?php //$include_path = '../../'; ?>
<?php include('include/meta_tags.php'); ?>
<!DOCTYPE html>
<html>

<?php include('include/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include('include/header.php'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include('include/left-bar.php'); ?>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Class</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Class</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        
                        <?php if(!empty($Courses)){ foreach($Courses as $COU){ ?> 
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php if(!empty($COU->ClassName)){ echo $COU->ClassName; } ?></h3>

                                    <p><?php if(!empty($COU->SubjectName)){ echo $COU->SubjectName; } ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-book" style="color:white;"></i>
                                </div>
                                <a href="<?php echo base_url('ResultList/'.$COU->ClassId.'/'.$COU->SubjectId); ?>" class="small-box-footer">Student's Marks <i
                                        class="fas fa-arrow-circle-right"></i></a>
                                </div>
                        </div>
                        <?php } } ?>
                        
                        
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include('include/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <?php include('include/footer-scripts.php'); ?>
</body>
</html>