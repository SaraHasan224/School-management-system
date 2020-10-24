<?php include(APPPATH.'views/admin/meta_tags.php'); ?>
<!DOCTYPE html>
<html lang="en">

<?php include(APPPATH.'views/admin/head.php'); ?>
<style>
.datepicker-inline{
  display : none !important;
}
</style>
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
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Manage";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holidays"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holidays";}?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holidays"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holidays";}?></a></li>
              <li><a href="#holiday" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Holiday"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Holiday";}?></a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
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
              </div>
              <div class="tab-pane" id="holiday">
              <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holiday Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holiday Title";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="HolidayTitle"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holiday Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holiday Title";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holiday Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holiday Date";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="datepicker" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holiday Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holiday Date";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Holiday Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Holiday Detail";}?></label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="HolidayDetails" placeholder="Holiday Details"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="addHoliday()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Holiday"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Holiday";}?></button>
                    </div>
                  </div>
                </form>
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
<!-- ./wrapper -->
<!-- Page script -->
</div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>
<!-- Page specific script for calndar-->
<script>
  // A $( document ).ready() block.
  
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
        <?php if(!empty($HolidayList)){foreach ($HolidayList as $HOLLIS) {$Year = substr($HOLLIS->HolidayDate, -10,-6); $Month = substr($HOLLIS->HolidayDate, -4,-3) - 1; $Date = substr($HOLLIS->HolidayDate, -2); ?>
        {
          title          : '<?php echo $HOLLIS->HolidayTitle; ?>',
          start          : new Date(<?php echo $Year; ?>,<?php echo $Month; ?>,<?php echo $Date; ?>),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        <?php }  } ?>
      ],
    })
  })
</script>


<script type="text/javascript">

function SetMonthHoliday() {
 
}
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

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

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
<script type="text/javascript">

/**************** Insert Holiday Field Using Ajax *************/
  function addHoliday() {
      var form_data = new FormData();
      form_data.append("HolidayTitle", document.getElementById('HolidayTitle').value);
      form_data.append("HolidayDate", document.getElementById('datepicker').value);
      form_data.append("HolidayDetails", document.getElementById('HolidayDetails').value);
        $.ajax({
        url:"<?php echo base_url('Admin/ManageHolidays/Holiday'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(addHoliday)
        {
            if (addHoliday.status == true) {
              Snackbar.show({pos: 'top-right',text:addHoliday.message});
              location.reload();
            }else{
            Snackbar.show({pos: 'top-right',text:addHoliday.message});
            }
        }
        });

  } 


</script>

</body>
</html>
