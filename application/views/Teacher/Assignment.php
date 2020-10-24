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
            <h1 class="m-0 text-dark">Assignment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Assignment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
    <div class="mb-3">
      <a href="#CollapseAdd" data-toggle="collapse" class="btn btn-warning cxm-btn-1 rounded-pill px-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add">Insert Assignment</a>

      <div class="collapse addcollapse" id="CollapseAdd">
      <form action="#" method="post" id="cxm-assignment-form">
        <div class="form-row">
            <div class="col-sm-3 order-sm-9">
                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type="file" id="imageUpload" />
                        <label for="imageUpload"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image:url(<?php  echo base_url('assets/dist/images/Syllabus.png'); ?>);"></div>  
                    </div>
                </div>
            </div>
            <div class="col-sm-9 order-sm-0"></div>
        </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr-nm">Select Class</label>
                <select class="form-control select2" id="ClassId" onchange="EnableSubjects()" style="width:100%">
                    <option value="">Select Class</option>
                    <?php if(!empty($ClassList)){ foreach($ClassList as $CLIS){ ?>
                        <option value="<?php echo $CLIS->ClassId; ?>"><?php echo $CLIS->ClassName; ?></option>
                    <?php }} ?>
                </select>
                <div id="cls-vald"></div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr-nm">Select Subject</label>
                <select class="form-control select2" id="SubjectId" disabled="true" style="width:100%">
                </select>
                <div id="sub-vald"></div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr-nm">Marks</label>
                <input type="number" id="Marks" class="form-control" placeholder="Marks">
                <div id="marks-vald"></div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="usr-nm">Due Date</label>
                <input type="text" id="datepicker" class="form-control" placeholder="Select Due Date">
                <div id="due-vald"></div>
              </div>
            </div>
          </div>
          <div class="" id="SubmitMessage"></div> <!-- When Message Got From DataBase -->
            <div class="text-center">
                <div role="status" id="SpinnerBorder">
                </div>
            </div>
          <div class="text-right">
            <button type="submit" class="btn btn-warning cxm-btn-1 rounded-pill px-3">Add Assignment</button>
          </div>
        </div>
        </form>
      </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Assignment List</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table id="dataTable1" class="table table-striped">
            <thead>
              <tr>
                <th style="width:10%;">#</th>
                <th class="text-center">Subject</th>
                <th class="text-center">Class</th>
                <th class="text-center">Marks</th>
                <th class="text-center">DueDate</th>
                <th class="text-center">Assignment</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="subject-table">
              <?php $i = 1; if(!empty($Assignment)){foreach($Assignment as $SUBJ){ ?> 
              <tr>
                <td class="text-center"><?php if(!empty($i)){ echo $i; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->SubjectName)){ echo $SUBJ->SubjectName; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->ClassName)){ echo $SUBJ->ClassName; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->Marks)){ echo $SUBJ->Marks; } ?></td>
                <td class="text-center"><?php if(!empty($SUBJ->DueDate)){ echo $SUBJ->DueDate; } ?></td>
                <td class="text-center" style="cursor:pointer;"><a href="<?php if(!empty($SUBJ->Assignment)){ echo $SUBJ->Assignment; } ?>" target="_blank" title="Download Assignment"><i class="fa fa-download text-success"></i></a></td>
                
                <td class="text-center">
                  <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-warning cxm-btn-1 fs13" title="Update" data-toggle="modal" data-target="#EditAssignment" onclick = "EditAssignment(<?php echo $SUBJ->AssignmentId; ?>)"><span class="fas fa-pencil-alt"></span></button>
                    <button class="btn btn-warning cxm-btn-1 fs13" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="DeleteAssignment(<?php if(!empty($SUBJ->AssignmentId)){ echo $SUBJ->AssignmentId; } ?>)"><span class="fas fa-trash-alt"></span></button>

                    <a href="<?php echo base_url('CheckAssignment/'.$SUBJ->AssignmentId); ?>" class="btn btn-warning cxm-btn-1 fs13" title="Check Assignment"><span class="fas fa-edit"></span></a>
                  </div>
                </td>
              </tr>
              <?php $i++; }} ?>           
            </tbody>
          </table>
        </div>
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

  
  <div class="modal fade" id="EditAssignment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Assignment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="AssignmentModal">
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="UpdateAssignment()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
                <!-- /.modal -->

    <?php include('include/footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <?php include('include/footer-scripts.php'); ?>
    <script>

    /************** Read and place url ************** */
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
          console.log(e);
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
    /*********** end of image url ************ */


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


      /**************** Insert Department Field Using Ajax *************/
function DeleteAssignment(Id) {
        var form_data = new FormData();
        form_data.append("AssignmentId", Id);

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
                        url:"<?php echo base_url('Teacher/EnableAssignment/Delete'); ?>",
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
  


      function EnableSubjects(){
            var SchoolClass = document.getElementById('ClassId').value;
            if(SchoolClass !=""){
            var form_data = new FormData();
                form_data.append("ClassId", SchoolClass);
                $.ajax({
                    url:"<?php echo base_url('Teacher/EnableAssignment/Enable'); ?>",
                    method:"POST",
                    dataType: 'JSON',
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(ManageSyllabus)
                    {
                        $('#SubjectId').empty();
                        if (ManageSyllabus.status == true) {
                        const EditRow = []; 
                        for(var inv = 0; inv < ManageSyllabus.data.length; inv++){
                            EditRow.push("<option value='"+ManageSyllabus.data[inv]['SubjectId']+"'>"+ManageSyllabus.data[inv]['SubjectName']+"</option>");
                        }
                        document.getElementById('SubjectId').innerHTML +="<option value=''>Select Subject</option>"+EditRow;
                        document.getElementById('SubjectId').disabled = false;
                        }else{
                        Snackbar.show({pos: 'top-right',text:ManageSyllabus.message});
                        document.getElementById('SubjectId').disabled = true;
                        }
                    }
                });
            }else{
            document.getElementById('SubjectId').disabled = true;
            }
        }



      /****************** Registration jquery submit button ******************* */
    $('#cxm-assignment-form').submit(function (e) { /******** Call A Function When Contact Form Submitted ********* */
        e.preventDefault(); /***********Prevent Page to not load *********** */
        var ClassId = $("#ClassId").val(); /*********** Get NameValue Value *********** */
        var SubjectId = $("#SubjectId").val(); /*********** Get NameValue Value *********** */
        var Marks = $("#Marks").val(); /*********** Get NameValue Value *********** */
        var DueDate = $("#datepicker").val(); /*********** Get NameValue Value *********** */
        if(ClassId == ""){ /******** if name is empty ********* */
          $("#cls-vald").empty(); /*******make name validation div empty ****** */
          $("#cls-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#cls-vald").append("Class Required"); /*********Add Text to name validation********* */
        }else if(SubjectId == ""){
            $("#sub-vald").empty(); /*******make name validation div empty ****** */
          $("#sub-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#sub-vald").append("Subject Required"); /*********Add Text to name validation********* */
        }else if(Marks == ""){
            $("#marks-vald").empty(); /*******make name validation div empty ****** */
          $("#marks-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#marks-vald").append("Marks Required"); /*********Add Text to name validation********* */
        }else if(DueDate == ""){
            $("#due-vald").empty(); /*******make name validation div empty ****** */
          $("#due-vald").addClass("cxm-err animated fadeInDown"); /**********add class to name validation div*********** */
          $("#due-vald").append("Subject Required"); /*********Add Text to name validation********* */
        }else{
          var form_data = new FormData(); /*********** Initialize form data ************ */
              form_data.append("ClassId", ClassId); /********Add NameValue to form ******* */
              form_data.append("SubjectId", SubjectId);  /*******add Email to form******* */
              form_data.append("Marks", Marks);  /*******add Email to form******* */
              form_data.append("DueDate", DueDate);  /*******add Email to form******* */
              form_data.append("Assignment", document.getElementById('imageUpload').files[0]);  /*******add Email to form******* */
              $.ajax({ /********start of an ajax ******** */
                url:"<?php echo base_url('Teacher/EnableAssignment/Insert'); ?>", /*******url to send ******* */
                method:"POST", /********method post******** */
                dataType: 'JSON', /********data type json******* */
                data: form_data, /*********send form here ******** */
                contentType: false, /*******content type false******** */
                cache: false, /*********cache false ********* */
                processData: false, /******* Process data false******* */
                beforeSend: function() { /********before send function start******** */
                  $("#SpinnerBorder").addClass("spinner-border fc2"); /********add class to spinner border********* */
                  $("#SpinnerBorder").append("<span class='sr-only'>Loading...</span>"); /*******append span to div******* */
                },/********end of before send function********* */
                success:function(data) /*******start of success function******** */
                { /********start of success function********* */
                  if (data.status == true) { /********if status is true********* */
                    $("#SpinnerBorder").empty(); /*****empty spinner board******** */
                    $("#SpinnerBorder").removeClass("spinner-border fc2"); /*******remove class from border******** */
                    $("#SubmitMessage").empty(); /*******empty the message****** */
                    $("#SubmitMessage").removeClass("alert alert-danger mb-4"); /********set class in message******* */
                    $("#SubmitMessage").addClass("alert alert-success mb-4"); /********set class in message******* */
                    $("#SubmitMessage").append(data.message); /*******add text to message******** */
                    
                    setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                  
                  }else{ /*******else result is false******** */
                    $("#SpinnerBorder").empty(); /********spinnre border empty****** */
                    $("#SpinnerBorder").removeClass("spinner-border fc2"); /******remove spinner clas******* */
                    $("#SubmitMessage").empty(); /*******empty message div******* */
                    $("#SubmitMessage").removeClass("alert alert-success mb-4"); /*******add class to alert messages******** */
                    $("#SubmitMessage").addClass("alert alert-danger mb-4"); /*******add class to alert messages******** */
                    $("#SubmitMessage").append(data.message); /********add text in alert message******** */
                  } /********enf of result check status******** */
                } /*******end of success function******* */
              });/*******end of ajax ******* */
        }
    }); /*********end of submit form********* */


     /**************Edit Insurance*********** */
     function EditAssignment(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#AssignmentModal").empty();
                    var edit_data = new FormData();
                      edit_data.append("AssignmentId", Id);
                      $.ajax({
                        url:"<?php echo base_url('Teacher/EnableAssignment/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          if (editdetails.status == true) {
                            document.getElementById("AssignmentModal").innerHTML+= "<form action='#' method='post' id='cxm-assignment-form'>"+
                                       "    <div class='row'>"+
                                  "<input type='hidden' id='AssignmentId' value='"+editdetails.data['AssignmentId']+"'>"+
                                    "       <div class='col-sm-6'>"+
                                    "          <div class='form-group'>"+
                                     "            <label for='usr-nm'>Marks</label>"+
                                      "            <input type='number' id='Marks2' class='form-control' value='"+editdetails.data['Marks']+"' placeholder='Marks'>"+
                                           "          <div id='marks-vald'></div>"+
                                              "       </div>"+
                                              "     </div>"+
                                              "     <div class='col-sm-6'>"+
                                              "      <div class='form-group'>"+
                                              "         <label for='usr-nm'>Due Date</label>"+
                                              "         <input type='text' id='datepicker2' class='form-control' placeholder='Select Due Date' value='"+editdetails.data['DueDate']+"'>"+
                                              "        <div id='due-vald'></div>"+
                                              "      </div>"+
                                              "   </div>"+
                                              "  </div>"+
                                              "   <div class='' id='SubmitMessage'></div> "+
                                              "    <div class='text-center'>"+
                                              "         <div role='status' id='SpinnerBorder'>"+
                                              "        </div>"+
                                              "     </div>"+
                                              "  </div>"+
                                              "  </form>";
                            $("#EditAssignment").modal('show');
                            $('.select2').select2()
                            //Date picker
                            $('#datepicker2').datepicker({
                            autoclose: true
                            })
                            
                          }else{
                            swal("Error : "+editdetails.message);
                          }
                        }
                      });
                  }


          /**************** Insert Department Field Using Ajax *************/
              function UpdateAssignment() {
                var AssignmentId = $("#AssignmentId").val();
                var Marks = $("#Marks2").val();
                var DueDate = $("#datepicker2").val();
                var form_data = new FormData();
                form_data.append("AssignmentId", AssignmentId);
                form_data.append("Marks", Marks);
                form_data.append("DueDate", DueDate);
                    $.ajax({
                  url:"<?php echo base_url('Teacher/EnableAssignment/Edit'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateSyllabus)
                  {
                    if (UpdateSyllabus.status == true) {
                      swal("Assignment Edit Successfully");
                      setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                      swal("Error : "+UpdateSyllabus.message);
                    }
                  }
                });
              } 

    </script>
    </body>
</html>
