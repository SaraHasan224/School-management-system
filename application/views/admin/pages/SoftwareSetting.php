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
        <small><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Software Setting"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Software Setting";}?></small>
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
                <img src="<?php if(!empty($CompanyList->CompanyLogo)){ echo base_url('assets/dist/images/'.$CompanyList->CompanyLogo); }else{ echo base_url('assets/dist/images/School.jpg'); }  ?>" class="profile-user-img img-responsive img-circle" alt="User Image">

              <h3 class="profile-username text-center"><?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?></h3>

              <p class="text-muted text-center"><?php if(!empty($CompanyList->CompanySlogan)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanySlogan.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanySlogan;} }else{ echo "JemsTech"; } ?></p>

              <ul class="list-group list-group-unbordered">
                
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Phone Number"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Phone Number";}?></b> <a class="pull-right"><?php if(!empty($CompanyList->CompanyPhone)){ echo $CompanyList->CompanyPhone; }else{ echo "JemsTech"; } ?></a>
                </li>
                <li class="list-group-item">
                  <b><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Address";}?></b> <a class="pull-right"><?php if(!empty($CompanyList->CompanyAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyAddress;} }else{ echo "JemsTech"; } ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- About Me Box -->
          <!-- /.box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event";}?></a></li>
              <li><a href="#event" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Add Event"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Add Event";}?></a></li>
              <li><a href="#settings" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Setting"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Setting";}?></a></li>
              <li><a href="#language" data-toggle="tab"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Language"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Language";}?></a></li>
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
              <div class="tab-pane" id="event">
              <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event Title";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="EventTitle"  placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event Title"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event Title";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event Date";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="datepicker" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event Date"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event Date";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Event Detail"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Event Detail";}?></label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="EventDetails"></textarea>
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
                      <button type="button" class="btn btn-danger" onclick="addevent()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Event"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Event";}?></button>
                    </div>
                  </div>
                </form>
                
              </div>
              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
              <div class="row">
              <div class="col-md-10"></div>
              <div class="col-md-2">
                <img class="img-responsive" id="blah" alt="" src="<?php if(!empty($CompanyList->CompanyLogo)){ echo base_url('assets/dist/images/'.$CompanyList->CompanyLogo); }else{echo base_url('assets/dist/images/default_logo.png');} ?>" height="150" width="150" />
                    <div class=''>
                        <label class="upimage"> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload Image"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload Image";}?>
                        <input type="file" name="CompanyLogo" id="imgInp"  class="form-control custom-input-form-control" >
                        </label>
                    </div> <!-- text-right / end -->
              </div>
              </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Name";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="Company Name" id="CompanyName" value="<?php if(!empty($CompanyList->CompanyName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyName;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Name"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Name";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CompanyNickName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CompanyNickName";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="CompanyShortName" id="CompanyShortName" value="<?php if(!empty($CompanyList->CompanyShortName)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyShortName.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyShortName;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "CompanyNickName"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "CompanyNickName";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Slogan"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Slogan";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="CompanySlogan" id="CompanySlogan" value="<?php if(!empty($CompanyList->CompanySlogan)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanySlogan.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanySlogan;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Slogan"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Slogan";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Email";}?></label>
                    <div class="col-sm-10">
                    <input type="email" name="CompanyEmail" id="CompanyEmail" value="<?php if(!empty($CompanyList->CompanyEmail)){ echo $CompanyList->CompanyEmail; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Email"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Email";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Phone";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="CompanyPhone" id="CompanyPhone" value="<?php if(!empty($CompanyList->CompanyPhone)){ echo $CompanyList->CompanyPhone; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Phone"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Phone";}?>" class="form-control" required="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Address";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="CompanyAddress" id="CompanyAddress" value="<?php if(!empty($CompanyList->CompanyAddress)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->CompanyAddress.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->CompanyAddress;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Company Address"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Company Address";}?>" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Due Date Penalty"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Due Date Penalty";}?></label>
                    <div class="col-sm-10">
                    <input type="text" name="AfterDueDate" id="AfterDueDate" value="<?php if(!empty($CompanyList->AfterDateDue)){ $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "'.$CompanyList->AfterDateDue.'"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo $CompanyList->AfterDateDue;} }else{ echo "JemsTech"; } ?>" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "After Due Date Penalty Price"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "After Due Date Penalty Price";}?>" class="form-control">
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
                      <button type="button" class="btn btn-danger" onclick="UpdateCompany()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="tab-pane" id="language">
              <form class="form-horizontal" id="LangaugeForm">
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "English"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "English";}?></label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="English" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "English"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "English";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Urdu"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Urdu";}?></label>

                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="Urdu" placeholder="<?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Urdu"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Urdu";}?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="addlanguage()"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Language"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Language";}?></button>
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
        <?php if(!empty($EventList)){foreach ($EventList as $LODE) { $date = substr($LODE->EventDate, -2);  ?>
        {
          title          : '<?php echo $LODE->EventTitle; ?>',
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

/**************** Insert Doctor Field Using Ajax *************/
  function addevent() {
      var form_data = new FormData();
      form_data.append("EventTitle", document.getElementById('EventTitle').value);
      form_data.append("EventDate", document.getElementById('datepicker').value);
      form_data.append("EventDetails", document.getElementById('EventDetails').value);
        $.ajax({
        url:"<?php echo base_url('Admin/SoftwareSetting/event'); ?>",
        method:"POST",
        dataType: 'JSON',
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success:function(addevent)
        {
            if (addevent.status == true) {
            Snackbar.show({pos: 'top-right',text:addevent.message});
            setTimeout(function(){
                        location.reload(true);
            }, 3000);
            }else{
            Snackbar.show({pos: 'top-right',text:addevent.message});
            }
        }
        });

  } 

  /**************** Insert Langauge Field Using Ajax *************/
  function addlanguage() {

    var form_data = new FormData();
    form_data.append("English", document.getElementById('English').value);
    form_data.append("Urdu", document.getElementById('Urdu').value);
    $.ajax({
    url:"<?php echo base_url('Admin/SoftwareSetting/language'); ?>",
    method:"POST",
    dataType: 'JSON',
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    success:function(addlangauge)
    {
        if (addlangauge.status == true) {
        Snackbar.show({pos: 'top-right',text:addlangauge.message});
        document.getElementById("LanguageForm").reset();
        }else{
        Snackbar.show({pos: 'top-right',text:addlangauge.message});
        }
    }
    });

} 


 /**************** Insert Staff Field Using Ajax *************/
 function UpdateCompany() {
                
              var form_data = new FormData();
              form_data.append("CompanyName", document.getElementById('CompanyName').value);
              form_data.append("CompanyShortName", document.getElementById('CompanyShortName').value);
              form_data.append("CompanySlogan", document.getElementById('CompanySlogan').value);
              form_data.append("CompanyAddress", document.getElementById('CompanyAddress').value);
              form_data.append("CompanyPhone", document.getElementById('CompanyPhone').value);
              form_data.append("CompanyEmail", document.getElementById('CompanyEmail').value);
              form_data.append("AfterDueDate", document.getElementById('AfterDueDate').value);
              form_data.append("CompanyLogo", document.getElementById('imgInp').files[0]);
              $.ajax({
                url:"<?php echo base_url('Admin/SoftwareSetting/Edit'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(updateCompany)
                {
                  if (updateCompany.status == true) {
                    Snackbar.show({pos: 'top-right',text:updateCompany.message});
                    setTimeout(function(){
                        location.reload(true);
                  }, 3000);
                  }else{
                    Snackbar.show({pos: 'top-right',text:updateCompany.message});
                  }
                }
              });
            } 
</script>

</body>
</html>
