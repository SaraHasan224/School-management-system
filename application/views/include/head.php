<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo base_url('adminassets/media/favicon.ico'); ?>" type="image/x-icon">
    <title><?php pageTitle(); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'); ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/datatables-bs4/css/dataTables.bootstrap4.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
    <?php if($curl === 'admin'){ ?>
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/jqvmap/jqvmap.min.css'); ?>">
    <?php } ?>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('AdminLTE/bower_components/select2/dist/css/select2.min.css');?>">
    <!-- SweetAlert -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/css/adminlte.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/daterangepicker/daterangepicker.css'); ?>">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/plugins/summernote/summernote-bs4.css'); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Custom style -->
    <link rel="stylesheet" href="<?php echo base_url('adminassets/css/common.css'); ?>">