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
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Calendar"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Calendar";}?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Calendar"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Calendar";}?></a></li>
              <li><a href="#Schedule" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Schedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Schedule";}?></a></li>
              <li><a href="#ScheduleList" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule List"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule List";}?></a></li>
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
              <div class="tab-pane" id="Schedule">
              <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Title";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="ScheduleTitle"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Title";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Date";}?></label>

                    <div class="col-sm-10">
                    <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group --> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Detail";}?></label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="ScheduleDetails" placeholder="Schedule Details"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="addSchedule()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Schedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Schedule";}?></button>
                    </div>
                  </div>
                </form>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="ScheduleList">
                <!-- Main content -->
                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Title";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Detail";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "StartDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "StartDate";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EndDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EndDate";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($ScheduleList)){ foreach ($ScheduleList as $SHEDLIS) { ?>
                <tr>
                  <td><?php echo $SHEDLIS->Id; ?></td>
                  <td><?php echo ucwords($SHEDLIS->ScheduleTitle); ?></td>
                  <td><?php echo $SHEDLIS->ScheduleDetails; ?></td>
                  <td><?php echo $SHEDLIS->StartDate; ?></td>
                  <td><?php echo $SHEDLIS->EndDate; ?></td>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick = "DeleteSchedule(<?php echo $SHEDLIS->ScheduleId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditSchedule" onclick = "EditSchedule(<?php echo $SHEDLIS->ScheduleId; ?>)"><i class="fa fa-edit text-success"></i></button>
                  </td>
                </tr>
                <?php $i++; } } ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Title";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Detail";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "StartDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "StartDate";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "EndDate"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "EndDate";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </tfoot>
              </table>
                <!-- /.content -->
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    </div>
</div>

<?php include(APPPATH.'views/admin/footer.php'); ?>


              <!-- Modal For Delete -->
              <div class="modal fade" id="EditSchedule">
                
              </div>
              <!-- /.modal -->
    <!-- /.content -->
  <!-- /.content-wrapper -->
<!-- ./wrapper -->
<!-- Page script -->

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
</script>


<script type="text/javascript">

function SetMonthSchedule() {
 
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
    // $('#reservation').daterangepicker({
    //   autoclose: true,
    //   startDate: '1'
    // })

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

  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'pageLength' : 100
    })
  })
</script>
<script type="text/javascript">

/**************** Insert Schedule Field Using Ajax *************/
  function addSchedule() {
      var form_data = new FormData();
      form_data.append("ScheduleTitle", document.getElementById('ScheduleTitle').value);
      form_data.append("ScheduleDate", document.getElementById('reservation').value);
      form_data.append("ScheduleDetails", document.getElementById('ScheduleDetails').value);
        $.ajax({
        url:"<?php echo base_url('Admin/ManageSchedule/Schedule'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(addSchedule)
        {
            if (addSchedule.status == true) {
              Snackbar.show({pos: 'top-right',text:addSchedule.message});
              setTimeout(function(){
                  location.reload(true);
                }, 3000);
            }else{
            Snackbar.show({pos: 'top-right',text:addSchedule.message});
            }
        }
        });

  } 

  /**************** Insert Department Field Using Ajax *************/
  function DeleteSchedule(Id) {
        var form_data = new FormData();
        form_data.append("ScheduleId", Id);

        swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
                        url:"<?php echo base_url('Admin/ManageSchedule/Delete'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(data)
                        {
                          if (data.status == true) {
                            swal("Poof! Your imaginary file has been deleted!", {
                              icon: "success",
                            });
                            location.reload();
                          }else{
                            swal("Your imaginary file is safe!");
                            location.reload();
                          }
                        }
                      });
        } else {
          swal("Your imaginary file is safe!");
        }
      });

      } 


                  /**************Edit Insurance*********** */
                  function EditSchedule(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditSchedule").empty();
                    var edit_data = new FormData();
                      edit_data.append("ScheduleId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/ManageSchedule/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            var StartYear = editdetails.data['StartDate'].substr(0,editdetails.data['StartDate'].length - 6);
                            var StartMonth = editdetails.data['StartDate'].substr(5,editdetails.data['StartDate'].length - 8);
                            var StartDate = editdetails.data['StartDate'].substr(8,editdetails.data['StartDate'].length);

                            var EndYear = editdetails.data['EndDate'].substr(0,editdetails.data['EndDate'].length - 6);
                            var EndMonth = editdetails.data['EndDate'].substr(5,editdetails.data['EndDate'].length - 8);
                            var EndDate = editdetails.data['EndDate'].substr(8,editdetails.data['EndDate'].length);
                            // alert(StartDate); exit;
                            document.getElementById("EditSchedule").innerHTML+= "<div class='modal-dialog'>"+
                              "<div class='modal-content'>"+
                                "<div class='modal-header'>"+
                                  "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                                    "<span aria-hidden='true'>&times;</span></button>"+
                                  "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Schedule"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Schedule";}?></h4>"+
                                "</div>"+
                                  "<div class='col-md-12'>"+
                                  "<form class='form-horizontal'>"+
                                    "<div class='form-group'>"+
                                      "<label for='inputName' class='col-sm-3 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Title";}?></label>"+
                                      "<div class='col-sm-9'>"+
                                        "<input type='text' class='form-control' id='ScheduleTitle2' value='"+editdetails.data['ScheduleTitle']+"'  placeholder='<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Title";}?>'>"+
                                      "</div>"+
                                    "</div>"+
                                    "<div class='form-group'>"+
                                      "<label for='inputEmail' class='col-sm-3 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Date";}?></label>"+
                                      "<div class='col-sm-9'>"+
                                      "<div class='input-group'>"+
                                    "<div class='input-group-addon'>"+
                                      "<i class='fa fa-calendar'></i>"+
                                    "</div>"+
                                    "<input type='text' class='form-control pull-right' id='reservation2' value='"+StartMonth+"/"+StartDate+"/"+StartYear+" - "+EndMonth+"/"+EndDate+"/"+EndYear+"'>"+
                                  "</div>"+
                                      "</div>"+
                                    "</div>"+
                                    "<div class='form-group'>"+
                                      "<label for='inputName' class='col-sm-3 control-label'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Schedule Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Schedule Detail";}?></label>"+
                                      "<div class='col-sm-9'>"+
                                        "<textarea class='form-control' id='ScheduleDetails2' placeholder='Schedule Details'>"+editdetails.data['ScheduleDetails']+"</textarea>"+
                                      "</div>"+
                                    "</div>"+
                                  "</form>"+
                                  "</div>"+
                                "<div class='modal-footer'>"+
                                  "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                                  "<button type='button' class='btn btn-success' onclick='UpdateSchedule("+editdetails.data['ScheduleId']+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                                "</div>"+
                              "</div>"+
                            "</div>";
                            $("#EditSchedule").modal('show');
                            $('#reservation2').daterangepicker()
                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }

      /**************** Insert Department Field Using Ajax *************/
      function UpdateSchedule(Id) {
                var ScheduleTitle = document.getElementById('ScheduleTitle2').value;
                var ScheduleDate = document.getElementById('reservation2').value;
                var ScheduleDetails = document.getElementById('ScheduleDetails2').value;
                if(ScheduleTitle !="" && ScheduleDate !="" && ScheduleDetails !=""){
                  var form_data = new FormData();
                  form_data.append("ScheduleId", Id);
                  form_data.append("ScheduleTitle", document.getElementById('ScheduleTitle2').value);
                  form_data.append("ScheduleDate", document.getElementById('reservation2').value);
                  form_data.append("ScheduleDetails", document.getElementById('ScheduleDetails2').value);
                    $.ajax({
                  url:"<?php echo base_url('Admin/ManageSchedule/Edit'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateSchedule)
                  {
                    if (UpdateSchedule.status == true) {
                      Snackbar.show({pos: 'top-right',text:UpdateSchedule.message});
                      setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                      Snackbar.show({pos: 'top-right',text:UpdateSchedule.message});
                    }
                  }
                });
                }else{
                  Snackbar.show({pos: 'top-right',text:"Fields can not be empty"});
                }
              } 
 

</script>

</body>
</html>
