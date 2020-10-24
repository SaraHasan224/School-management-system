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

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Job Responsibility"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Job Responsibility";}?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Insert Job Type</h3>
            </div>
            <div class="box-body">
              <!-- /btn-group -->
              <div class="input-group">
                <input id="JobType" type="text" class="form-control" placeholder="Insert Job Type">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-primary btn-flat" onclick="JobResponsibility()">Add</button>
                </div>
                <!-- /btn-group -->
              </div>
              <!-- /input-group -->
            </div>
          </div>

          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Job Type List</h3>
            </div>
             <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>#</th>
                  <th>JobType</th>
                  <th>Option</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($JobeTypeList)){ foreach($JobeTypeList as $JBTYLIS){?> 
                <tr>
                  <td><?php echo $JBTYLIS->Id; ?></td>
                  <td><?php echo $JBTYLIS->JobType; ?></td>
                  <td><a href="#" data-toggle="modal" data-target="#DeleteJobType" onclick = "DeleteJobType(<?php echo $JBTYLIS->JobTypeId; ?>)"><i class="fa fa-trash text-danger"></i></a></td>
                </tr>
                <?php $i++; }} ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

         <!-- /.col -->
         <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Insert Description</a></li>
              <li><a href="#list" data-toggle="tab">List</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" id="SelectJobTypeId">
                        <option value="">Select Job Type</option>
                        <?php if(!empty($RemainJobType)){ foreach($RemainJobType as $REJOTY){ ?>
                        <option value="<?php echo $REJOTY->JobTypeId; ?>"><?php echo $REJOTY->JobType; ?></option>
                        <?php } } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Job Description</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="JobDescription" placeholder="Job Description"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" class="btn btn-danger" onclick="InsertDescription()">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="list">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "JobType"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "JobType";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "JobDescription"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "JobDescription";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i =1; if(!empty($DescribedJob)){ foreach ($DescribedJob as $JOBLIS) { ?>
                <tr>
                  <td><?php echo $JOBLIS->Id; ?></td>
                  <td><?php echo $JOBLIS->JobType; ?></td>
                  <td><?php echo $JOBLIS->JobDescription; ?></td>
                  <td>
                    <button type="button" class="btn btn-default" data-toggle="modal" onclick="EditJobType(<?php echo $JOBLIS->JobTypeId; ?>)"><i class="fa fa-edit text-success"></i></button>
                  </td>
                </tr>
                <?php $i++; } }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "JobType"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "JobType";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "JobDescription"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "JobDescription";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </tfoot>
              </table>
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
    <!-- /.content -->
   


              <!-- Modal For Delete -->
              <div class="modal fade" id="EditJobType">
                
              </div>
              <!-- /.modal -->


 
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
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true,
      'pageLength' : 100
    })
    $("#example2_previous").css("display", "none");
    $("#example2_next").css("display", "none");
  })

  function EditJobType(Id) {
    $('#EditJobType').empty();
    var JobTypeId = Id;
        if (JobTypeId != "") {/******** Check If Fields exits Is Same *********/
            var form_data = new FormData();
            form_data.append("JobTypeId", Id);
            $.ajax({
                url:"<?php echo base_url('Admin/JobResponsibility/View'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(JobType)
                {
                    if (JobType.status == true) {
                      document.getElementById('EditJobType').innerHTML = "<div class='modal-dialog'>"+
                      "<div class='modal-content'>"+
                        "<div class='modal-header'>"+
                          "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                            "<span aria-hidden='true'>&times;</span></button>"+
                          "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit";}?></h4>"+
                        "</div>"+
                        "<div class='modal-body'>"+
                        "<div class='form-group'>"+
                            "<label for='inputExperience' class='col-sm-3 control-label'>JobDescription</label>"+
                            "<div class='col-sm-9'>"+
                              "<textarea class='form-control' id='JobDescription2' placeholder='Job Description'>"+JobType.data['JobDescription']+"</textarea>"+
                            "</div>"+
                          "</div>"+
                        "</div>"+
                        "<div class='modal-footer' style='margin-top: 10%;'>"+
                          "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                          "<button type='button' class='btn btn-success' onclick='UpdateJobType("+Id+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit";}?></button>"+
                        "</div>"+
                      "</div>"+
                    "</div>";
                    $('#EditJobType').modal('show');
                    }else{
                      Snackbar.show({pos: 'top-right',text:JobType.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
  }

  /**************** Insert JobResponsibility Field Using Ajax *************/
  function JobResponsibility() {
        var JobType = document.getElementById('JobType').value;
        if (JobType != "") {/******** Check If Fields exits Is Same *********/
            var form_data = new FormData();
            form_data.append("JobType", document.getElementById('JobType').value);
            $.ajax({
                url:"<?php echo base_url('Admin/JobResponsibility/InsertJobType'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(JobType)
                {
                    if (JobType.status == true) {
                        Snackbar.show({pos: 'top-right',text:JobType.message});
                        setTimeout(function(){
                          location.reload(true);
                      }, 3000);
                    }else{
                    Snackbar.show({pos: 'top-right',text:JobType.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
  } 


  /**************** Insert UpdateJobType Field Using Ajax *************/
function UpdateJobType(Id) {
        var JobTypeId = Id;
        var JobDescription = document.getElementById('JobDescription2').value;
        if (JobDescription != "" && JobTypeId != "") {/******** Check If Fields exits Is Same *********/
            var form_data = new FormData();
            form_data.append("JobTypeId", Id);
            form_data.append("JobDescription", document.getElementById('JobDescription2').value);
            $.ajax({
                url:"<?php echo base_url('Admin/JobResponsibility/Edit'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(JobType)
                {
                    if (JobType.status == true) {
                        Snackbar.show({pos: 'top-right',text:JobType.message});
                        setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                    Snackbar.show({pos: 'top-right',text:JobType.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
}


/**************** Insert InsertDescription Field Using Ajax *************/
function InsertDescription() {
        var JobTypeId = document.getElementById('SelectJobTypeId').value;
        var JobDescription = document.getElementById('JobDescription').value;
        if (JobDescription != "" && JobTypeId != "") {/******** Check If Fields exits Is Same *********/
            var form_data = new FormData();
            form_data.append("JobTypeId", document.getElementById('SelectJobTypeId').value);
            form_data.append("JobDescription", document.getElementById('JobDescription').value);
            $.ajax({
                url:"<?php echo base_url('Admin/JobResponsibility/InsertDescription'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(JobType)
                {
                    if (JobType.status == true) {
                        Snackbar.show({pos: 'top-right',text:JobType.message});
                        setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                    Snackbar.show({pos: 'top-right',text:JobType.message});
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }
  } 

  /**************** Insert Department Field Using Ajax *************/
  /**************** Insert Department Field Using Ajax *************/
function DeleteJobType(Id) {
        var form_data = new FormData();
        form_data.append("JobTypeId", Id);

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
                        url:"<?php echo base_url('Admin/JobResponsibility/Delete'); ?>",
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


</script>
