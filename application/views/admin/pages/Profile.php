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
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?>
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Profile"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Profile";}?></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Advanced Elements</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if(!empty($StaffList->StaffImage)){ ?> 
                <img src="<?php echo base_url('uploads/StaffImage/'.$StaffList->StaffImage); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
              <?php }else{ ?>
                <img src="<?php echo base_url('uploads/StaffImage/default.png'); ?>" class="profile-user-img img-responsive img-circle" alt="User Image">
              <?php } ?>
              <h3 class="profile-username text-center"><?php if(!empty($StaffList->StaffName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->StaffName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->StaffName;} }else{ echo "JemsTech"; } ?></h3>

              <p class="text-muted text-center"><?php if(!empty($StaffList->Designation)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->Designation.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->Designation;} }else{ echo "JemsTech"; } ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></b> <a class="pull-right"><?php if(!empty($StaffList->FatherName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->FatherName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->FatherName;} }else{ echo "JemsTech"; } ?></a>
                </li>
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?></b> <a class="pull-right"><?php if(!empty($StaffList->PhoneNumber)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->PhoneNumber.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->PhoneNumber;} }else{ echo "JemsTech"; } ?></a>
                </li>
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "National Identity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "National Identity";}?> #</b> <a class="pull-right"><?php if(!empty($StaffList->NationalIdentity)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->NationalIdentity.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->NationalIdentity;} }else{ echo "JemsTech"; } ?></a>
                </li>
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Gender"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Gender";}?></b> <a class="pull-right"><?php if(!empty($StaffList->Gender)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->Gender.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->Gender;} }else{ echo "JemsTech"; } ?></a>
                </li>
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Date Of Birth"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Date Of Birth";}?></b> <a class="pull-right"><?php if(!empty($StaffList->DateOfBirth)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->DateOfBirth.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->DateOfBirth;} }else{ echo "JemsTech"; } ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Activity"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Activity";}?></a></li>
              <li><a href="#password" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Change Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Change Password";}?></a></li>
              <li><a href="#settings" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Setting"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Setting";}?></a></li>
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
              <div class="tab-pane" id="password">
              <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Old Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Old Password";}?></label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="OldPassword" onkeyup="checkoldpassword()" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Old Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Old Password";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "New Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "New Password";}?></label>

                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="NewPassword" onkeyup="confirmpassword()" disabled="true" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "New Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "New Password";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Confirm Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Confirm Password";}?></label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="ConfirmPassword" onkeyup="confirmpassword()" disabled="true" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Confirm Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Confirm Password";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "I agree to the terms and conditions"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "I agree to the terms and conditions";}?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="changepassword()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Change Password"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Change Password";}?></button>
                    </div>
                  </div>
                </form>
                
              </div>

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?></label>

                    <div class="col-sm-10">
                    <input type="text" name="StaffName" id="Edit_StaffName" value="<?php if(!empty($StaffList->StaffName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->StaffName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->StaffName;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Name";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?></label>

                    <div class="col-sm-10">
                    <input type="text" name="FatherName" id="Edit_FatherName" value="<?php if(!empty($StaffList->FatherName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->FatherName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->FatherName;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Father Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Father Name";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?></label>

                    <div class="col-sm-10">
                    <input type="phone" name="PhoneNumber" id="Edit_PhoneNumber" value="<?php if(!empty($StaffList)){ echo $StaffList->PhoneNumber; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?></label>

                    <div class="col-sm-10">
                    <input type="text" name="StaffAddress" id="Edit_StaffAddress" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Address";}?>" value="<?php if(!empty($StaffList->StaffAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$StaffList->StaffAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $StaffList->StaffAddress;} }else{ echo "JemsTech"; } ?>" class="form-control" required=""> 
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "I agree to the terms and conditions"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "I agree to the terms and conditions";}?>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="UpdateStaff()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>
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
$( document ).ready(function() {
  $( ".datepicker-inline" ).remove();
});
  
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //Random default events
      events    : [
        <?php if(!empty($LoginDetails)){foreach ($LoginDetails as $LODE) { $date = substr($LODE->LoginDate, -2);  ?>
        {
          title          : 'Login'+' <?php echo $LODE->LoginTime; ?>',
          start          : new Date(y,m,<?php echo $date; ?>),
          backgroundColor: '#f56954', //red
          borderColor    : '#f56954' //red
        },
        <?php }  } ?>
      ],
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>









<script type="text/javascript">
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
      autoclose: true
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

/************ Check Old Password ******************/
function checkoldpassword() {
            var Verify_email_form = new FormData();
          Verify_email_form.append("OldPassword", document.getElementById('OldPassword').value);
          $.ajax({
            url:"<?php echo base_url('Admin/VerifyPassword/check'); ?>",
            method:"POST",
            dataType: 'JSON',
            data: Verify_email_form,
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
              if (data.status == true) {
                document.getElementById('NewPassword').disabled = false;
                document.getElementById('ConfirmPassword').disabled = false;
              }else{
                document.getElementById('NewPassword').disabled = true;
                document.getElementById('ConfirmPassword').disabled = true;
              }
            }
          });
        }


        /************** Check Either Password are Same confirm Password ***************/
      function confirmpassword() {
                  var Password = document.getElementById('NewPassword').value;
                  var ConfirmPassword = document.getElementById('ConfirmPassword').value;
                    if (!Password) {
                      var Password = document.getElementById('NewPassword').style.borderColor = "";
                      var ConfirmPassword = document.getElementById('ConfirmPassword').style.borderColor = "";
                    }else{
                    if (Password === ConfirmPassword) {
                      var Password = document.getElementById('NewPassword').style.borderColor = "green";
                      var ConfirmPassword = document.getElementById('ConfirmPassword').style.borderColor = "green";
                    }else{
                      var Password = document.getElementById('NewPassword').style.borderColor = "red";
                      var ConfirmPassword = document.getElementById('ConfirmPassword').style.borderColor = "red";
                    }
                    }
                  }

/**************** Insert Doctor Field Using Ajax *************/
  function changepassword() {
    
    var OldPassword = document.getElementById('OldPassword').value;
    var Password = document.getElementById('NewPassword').value;
    var ConfirmPassword = document.getElementById('ConfirmPassword').value;
    if (Password == ConfirmPassword && Password != "" && OldPassword != Password) {/******** Check If Password Is Same */
      var form_data = new FormData();
    form_data.append("Password", document.getElementById('NewPassword').value);
    $.ajax({
      url:"<?php echo base_url('Admin/VerifyPassword/changepassword'); ?>",
      method:"POST",
      dataType: 'JSON',
      data: form_data,
      contentType: false,
      cache: false,
      processData: false,
      success:function(ChangePassword)
      {
        if (ChangePassword.status == true) {
          Snackbar.show({pos: 'top-right',text:ChangePassword.message});
          setTimeout(function(){// wait for 5 secs(2)
                        location.reload(true);
                      }, 2000);
        }else{
          Snackbar.show({pos: 'top-right',text:ChangePassword.message});
        }
      }
    });
    }else{
      Snackbar.show({pos: 'top-right',text:'Password Can not be Empty Or Should Be Same'});
    }

  } 


 /**************** Insert Staff Field Using Ajax *************/
 function UpdateStaff() {
                

                var form_data = new FormData();
              form_data.append("StaffId", <?php echo $StaffList->StaffId ?>);
              form_data.append("StaffName", document.getElementById('Edit_StaffName').value);
              form_data.append("FatherName", document.getElementById('Edit_FatherName').value);
              form_data.append("PhoneNumber", document.getElementById('Edit_PhoneNumber').value);
              form_data.append("StaffAddress", document.getElementById('Edit_StaffAddress').value);
              $.ajax({
                url:"<?php echo base_url('Admin/VerifyPassword/Edit'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(updateStaff)
                {
                  if (updateStaff.status == true) {
                    Snackbar.show({pos: 'top-right',text:updateStaff.message});
                    
                    setTimeout(function(){// wait for 5 secs(2)
                        location.reload(true);
                      }, 3000);
                  }else{
                    Snackbar.show({pos: 'top-right',text:updateStaff.message});
                  }
                }
              });
            } 
</script>

</body>
</html>
