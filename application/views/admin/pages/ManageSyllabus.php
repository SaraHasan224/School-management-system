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
        <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Manage Syllabus"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Manage Syllabus";}?>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
        <div class="box-header with-border">
          <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#InsertSyllabus"><?php //$LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Syllabus"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Syllabus";}?></button> -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SubjectId"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SubjectId";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Download"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Download";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 1; if(!empty($SyllabusList)){ foreach ($SyllabusList as $SYLLLIS) { ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $SYLLLIS->SyllabusId; ?></td>
                  <td><?php echo $SYLLLIS->SubjectName; ?></td>
                  <td><?php echo $SYLLLIS->ClassName; ?></td>
                  <td onclick="DownloadSyllabus(<?php echo $SYLLLIS->SyllabusId; ?>)" style="cursor:pointer;"><i class="fa fa-download text-success"></i></td>
                  <td>
                    <button type="button" class="btn btn-default"  onclick = "DeleteSyllabus(<?php echo $SYLLLIS->SyllabusId; ?>)"><i class="fa fa-trash text-danger"></i></button>
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#EditSyllabus" onclick = "EditSyllabus(<?php //echo $SYLLLIS->SyllabusId; ?>)"><i class="fa fa-edit text-success"></i></button> -->
                  </td>
                </tr>
                <?php $i++; } } ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>#</th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "SubjectId"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "SubjectId";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Download"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Download";}?></th>
                  <th><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Option"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Option";}?></th>
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
  <div class="modal fade" id="InsertSyllabus">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert Syllabus"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert Syllabus";}?></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                          <!-- -->
                          <div class="col-md-12">
                          <div class="img-top">
                          <img class="img-responsive" id="blah" alt="" src="<?php echo base_url('assets/dist/images/Syllabus.png');?>" height="150" width="150" />
                                  <div class=''>
                                      <label class="upimage"> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload";}?>
                                      <input type="file" name="SyllabusFile" id="imgInp"  class="form-control custom-input-form-control" >
                                      </label>
                                  </div> <!-- text-right / end -->
                            </div>
                          </div>
                          <!-- -->
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Class"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Class";}?></label>
                                <div class="col-sm-9">
                                  <select class="form-control" id="Class" onchange="EnableSubjects()">
                                    <option value="">Select Class</option>
                                    <?php if(!empty($ClassList)){ foreach($ClassList as $CLIS){ ?>
                                      <option value="<?php echo $CLIS->ClassId; ?>"><?php echo $CLIS->ClassName; ?></option>
                                    <?php }} ?>
                                  </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Subject"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Subject";}?></label>
                                <div class="col-sm-9">
                                  <select class="form-control" id="Subject" disabled="true">
                                    
                                  </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-default pull-left" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>
                      <button type="button" class="btn btn-primary" onclick="InsertSyllabus()" data-dismiss="modal"><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Insert"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Insert";}?></button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

              
                  <!-- Modal For Delete -->
              <div class="modal fade" id="EditSyllabus">
                
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
      $('#blah').attr('src', '<?php echo base_url('assets/dist/images/completed.png');?>');
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
</script>

<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      'pageLength' : 100
    })
  })

  function EnableSubjects(){
    var SchoolClass = document.getElementById('Class').value;
    if(SchoolClass !=""){
      var form_data = new FormData();
          form_data.append("Class", SchoolClass);
          $.ajax({
              url:"<?php echo base_url('Admin/VerifyData/SubjectCheck'); ?>",
              method:"POST",
              dataType: 'JSON',
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              success:function(ManageSyllabus)
              {
                $('#Subject').empty();
                if (ManageSyllabus.status == true) {
                  const EditRow = []; 
                  for(var inv = 0; inv < ManageSyllabus.data.length; inv++){
                    EditRow.push("<option value='"+ManageSyllabus.data[inv]['SubjectId']+"'>"+ManageSyllabus.data[inv]['SubjectName']+"</option>");
                  }
                  document.getElementById('Subject').innerHTML +="<option value=''>Select Subject</option>"+EditRow;
                  document.getElementById('Subject').disabled = false;
                }else{
                  Snackbar.show({pos: 'top-right',text:ManageSyllabus.message});
                  document.getElementById('Subject').disabled = true;
                }
              }
          });
    }else{
      document.getElementById('Subject').disabled = true;
    }
  }

  
  /**************** Insert Insurance Details Field Using Ajax *************/
  function InsertSyllabus() {
        var Subject = document.getElementById('Subject').value;
        var Class = document.getElementById('Class').value;
        var Syllabus = document.getElementById('imgInp').files[0];
            if (Subject != "" && Class != "" && Syllabus != "") {/******** Check If Fields exits Is Same *********/
                var form_data = new FormData();
                form_data.append("Subject", Subject);
                form_data.append("Class", Class);
                form_data.append("Syllabus", Syllabus);
                $.ajax({
                url:"<?php echo base_url('Admin/ManageSyllabus/Insert'); ?>",
                method:"POST",
                dataType: 'JSON',
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(ManageSyllabus)
                {
                    if (ManageSyllabus.status == true) {
                        Snackbar.show({pos: 'top-right',text:ManageSyllabus.message});
                        location.reload();
                    }else{
                        Snackbar.show({pos: 'top-right',text:ManageSyllabus.message});
                        location.reload();
                    }
                }
                });
            }else{
              Snackbar.show({pos: 'top-right',text:'All Fields Are Mandatory!!!'});
            }

  } 

/**************** Insert Department Field Using Ajax *************/
function DeleteSyllabus(Id) {
        var form_data = new FormData();
        form_data.append("SyllabusId", Id);

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
                        url:"<?php echo base_url('Admin/ManageSyllabus/Delete'); ?>",
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
                  function EditSyllabus(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#EditSyllabus").empty();
                    var edit_data = new FormData();
                      edit_data.append("SyllabusId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Admin/ManageSyllabus/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            document.getElementById("EditSyllabus").innerHTML+= "<div class='modal-dialog'>"+
                  "<div class='modal-content'>"+
                    "<div class='modal-header'>"+
                      "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>"+
                        "<span aria-hidden='true'>&times;</span></button>"+
                      "<h4 class='modal-title'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Edit Syllabus"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Edit Syllabus";}?></h4>"+
                    "</div>"+
                      "<div class='col-md-12'>"+
                      "<form>"+
                          "<div class='col-md-12'>"+
                          "<div class='img-top'>"+
                          "<img class='img-responsive' id='blah2' alt='' src='<?php echo base_url('assets/dist/images/Syllabus.png'); ?>' height='150' width='150' />"+
                                  "<div class=''>"+
                                      "<label class='upimage'> <?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Upload"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Upload";}?>"+
                                      "<input type='file' name='Syllabus' id='imgInp2'  class='form-control custom-input-form-control'>"+
                                      "</label>"+
                                  "</div>"+
                            "</div>"+
                          "</div>"+
                        "</form>"+
                      "</div>"+
                    "<div class='modal-footer'>"+
                      "<button type='button' class='btn btn-default pull-left' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Close"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Close";}?></button>"+
                      "<button type='button' class='btn btn-success' onclick='UpdateSyllabus("+editdetails.data['SyllabusId']+")' data-dismiss='modal'><?php $LangList = $this->db->query('SELECT English,Urdu FROM language WHERE English = "Update"')->row(); if(!empty($LangList)){ echo $LangList->$Word; }else{echo "Update";}?></button>"+
                    "</div>"+
                  "</div>"+
                "</div>";
                            $("#EditSyllabus").modal('show');

                            function readURL2(input) {

                                if (input.files && input.files[0]) {
                                  var reader = new FileReader();

                                  reader.onload = function(e) {
                                    $('#blah2').attr('src', "<?php echo base_url('assets/dist/images/completed.png'); ?>");
                                  }

                                  reader.readAsDataURL(input.files[0]);
                                }
                                }

                                $("#imgInp2").change(function() {
                                readURL2(this);
                                });
                          }else{
                            Snackbar.show({pos: 'top-right',text:editdetails.message});
                          }
                        }
                      });
                  }


          /**************** Insert Department Field Using Ajax *************/
              function UpdateSyllabus(Id) {
                var form_data = new FormData();
                form_data.append("SyllabusId", Id);
                form_data.append("Syllabus", document.getElementById('imgInp2').files[0]);
                    $.ajax({
                  url:"<?php echo base_url('Admin/ManageSyllabus/Edit'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateSyllabus)
                  {
                    if (UpdateSyllabus.status == true) {
                      Snackbar.show({pos: 'top-right',text:UpdateSyllabus.message});
                      location.reload();
                    }else{
                      Snackbar.show({pos: 'top-right',text:UpdateSyllabus.message});
                    }
                  }
                });
              } 

              /**************Download Syllabus**************** */
        function DownloadSyllabus(SyllabusId) {
          var form_data = new FormData();
          form_data.append("SyllabusId", SyllabusId);
          $.ajax({
          url:"<?php echo base_url('Admin/VerifyData/Download'); ?>",
          method:"POST",
          dataType: 'JSON',
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
          success:function(FilesData)
            {
            if (FilesData.status == true) {
                  var x=new XMLHttpRequest();
                  x.open("GET", "http:"+FilesData.data['FileUrl'], true);
                  x.responseType = 'blob';
                  x.onload=function(e){download(x.response, FilesData.data['Subject']+'_'+FilesData.data['Class'] , "text/plain" ); }
                  x.send();
              }else{
                Snackbar.show({pos: 'top-right',text:FilesData.message});
              }
            }
          });
        }
</script>
</body>
</html>
