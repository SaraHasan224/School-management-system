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
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exams"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exams";}?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exams Shedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exams Shedule";}?></a></li>
              <li><a href="#AddExams" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add ExamShedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add ExamShedule";}?></a></li>
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
              <div class="tab-pane" id="AddExams">
              <form class="form-horizontal" style="margin-top:4%;">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></label>

                    <div class="col-sm-10">
                        <select class="form-control select2" id="Class" onchange="GetSubject()">
                            <option value=""><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Class";}?></option>
                            <?php if(!empty($ClassList)){ foreach($ClassList as $CLALI){ ?> 
                              <option value="<?php echo $CLALI->ClassId; ?>"><?php echo $CLALI->ClassName; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></label>

                    <div class="col-sm-10">
                      <select class="form-control select2" id="Subject" disabled="true">
                      <option><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Select Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Select Subject";}?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exam Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exam Date";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="datepicker" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exam Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exam Date";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exam Time"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exam Time";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control timepicker" id="ExamTime" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Exam Time"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Exam Time";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="AddExamShedule()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
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
        <?php if(!empty($ExamsList)){foreach ($ExamsList as $EXAMLIST) {$Year = substr($EXAMLIST->ExamDate, -10,-6); $Month = substr($EXAMLIST->ExamDate, -4,-3) - 1; $Date = substr($EXAMLIST->ExamDate, -2); $Hour = substr($EXAMLIST->ExamTime, -8,-6); $Minute = substr($EXAMLIST->ExamTime, -5,-3); ?>
        {
          title          : '<?php echo $EXAMLIST->SubjectName.' '.$EXAMLIST->ClassName; ?>',
          start          : new Date(<?php echo $Year; ?>,<?php echo $Month; ?>,<?php echo $Date; ?>, <?php echo $Hour; ?>, <?php echo $Minute; ?>),
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
    $('.select2').css('width','100%');
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
  function AddExamShedule() {
      var form_data = new FormData();
      form_data.append("Class", document.getElementById('Class').value);
      form_data.append("Subject", document.getElementById('Subject').value);
      form_data.append("ExamDate", document.getElementById('datepicker').value);
      form_data.append("ExamTime", document.getElementById('ExamTime').value);
        $.ajax({
        url:"<?php echo base_url('Admin/ManageExams/Exam'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(AddExamShedule)
        {
            if (AddExamShedule.status == true) {
            Snackbar.show({pos: 'top-right',text:AddExamShedule.message});
            setTimeout(function(){
                        location.reload(true);
            }, 3000);
            }else{
            Snackbar.show({pos: 'top-right',text:AddExamShedule.message});
            }
        }
        });

  } 


  function GetSubject() {
      Class = document.getElementById('Class').value;
      if (Class !="") {
        var form_data = new FormData();
        form_data.append("Class", document.getElementById('Class').value);
        $.ajax({
        url:"<?php echo base_url('Admin/VerifyData/SubjectCheck'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(AddExamShedule)
        {
            $('#Subject').empty();
            if (AddExamShedule.status == true) {
                const EditRow = []; 
                for(var inv = 0; inv < AddExamShedule.data.length; inv++){
                EditRow.push("<option value='"+AddExamShedule.data[inv]['SubjectId']+"'>"+AddExamShedule.data[inv]['SubjectName']+"</option>");
            }
                document.getElementById('Subject').innerHTML +="<option value=''>Select Subject</option>"+EditRow;
                document.getElementById('Subject').disabled = false;
            }else{
                Snackbar.show({pos: 'top-right',text:AddExamShedule.message});
                document.getElementById('Subject').disabled = true;
            }
        }
        });
      }else{
        $('#Subject').empty();
        document.getElementById('Subject').innerHTML +="<option value=''>Select Subject</option>";
        document.getElementById('Subject').disabled = true;
        Snackbar.show({pos: 'top-right',text:"Class Can Not Be Empty!!"});
      }
  }

</script>

</body>
</html>
