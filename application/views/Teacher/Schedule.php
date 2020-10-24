<?php include('include/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('include/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
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
            <h1 class="m-0 text-dark">Schedule</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Schedule</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
        <div class="mb-3">
      
                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                      <div class="box box-primary">
                        <div class="box-body no-padding">
                          <!-- THE CALENDAR -->
                          <div id="calendar"></div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /. box -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </section>
                <!-- /.content -->
        
        <!-- /.card-body -->
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
                <!-- /.modal -->

    <?php include('include/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <?php include('include/footer-scripts.php'); ?>
    <script>

$(function () {

/* initialize the external events
 -----------------------------------------------------------------*/
/* initialize the calendar
 -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
        header    : {
            left  : 'prev,next',
            center: 'title',
            right : ''
        },
        //Random default events
        events    : [
            <?php if(!empty($ScheduleList)){foreach ($ScheduleList as $SHEDLIS) {
            $StartYear = substr($SHEDLIS->StartDate, -10,-6); 
            $StartMonth = substr($SHEDLIS->StartDate, -4,-3) - 1; 
            $StartDate = substr($SHEDLIS->StartDate, -2); 
            
            $EndYear = substr($SHEDLIS->EndDate, -10,-6);
            $EndMonth = substr($SHEDLIS->EndDate, -4,-3) - 1; 
            $EndDate = substr($SHEDLIS->EndDate, -2);
            ?>
            {
            title          : '<?php echo $SHEDLIS->ScheduleTitle; ?>',
            start          : new Date(<?php echo $StartYear; ?>,<?php echo $StartMonth; ?>,<?php echo $StartDate; ?>),
            end            : new Date(<?php echo $EndYear; ?>,<?php echo $EndMonth; ?>,<?php echo $EndDate; ?> + 1),
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954' //red
            },
            <?php }  } ?>
        ],
        })
        })

      $(function() {
        $('.select2').select2()
        //Date picker
        $('#datepicker').datepicker({
        autoclose: true
        })

        $('[data-toggle="tooltip"]').tooltip();
        $("#dataTable1").DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      });
      });


    </script>
    </body>
</html>
