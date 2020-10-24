<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
</head>

<body>
<div class="wrapper">

  <!-- Navbar -->
  <?php include(APPPATH.'views/admin/header.php'); ?>
  <!-- /.navbar -->
  <div class="content-wrapper">
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Assignment List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Assignment List";}?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "GR NO"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "GR NO";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Assignment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assignment";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Marks"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Marks";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($AssignmentList)){ foreach ($AssignmentList as $ASSLIS) { ?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td>
                  <td class="text-center"><?php echo $ASSLIS->StudentName; ?></td>
                  <td class="text-center"><?php echo $ASSLIS->StudentGR; ?></td>
                  <td class="text-center"><a href="<?php echo $ASSLIS->Assignment; ?>" target="_blank" title="Download Assignment"><i class="fa fa-download"></i></a></td>
                  <td class="text-center"><?php echo $ASSLIS->Marks; ?></td>
                </tr>
                <?php $i++; } } ?>
                </tbody>
                <tfoot>
                <tr>
                <th class="text-center">#</th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Student Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Student Name";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "GR NO"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "GR NO";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Assignment"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Assignment";}?></th>
                  <th class="text-center"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Marks"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Marks";}?></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->
  <!-- Models -->
              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditStudent">
                
              </div>
              <!-- /.modal -->

              <!-- Modal For Delete -->

              <div class="modal fade" id="ViewStudent">
                  
              </div>
              <!-- /.modal -->
    </section>
    <!-- /.content -->
<!-- Page script -->

</div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<script>
      function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#blah').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#imgInp").change(function() {
readURL(this);
});



  $(function () {
    //Initialize Select2 Elements
    

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      startDate: '1d'
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false
    })
  })

     
</script>
</body>
</html>
