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
            <h1 class="m-0 text-dark">Set Marks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Set Marks</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <div class="content">
    <div class="mb-3">
      
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Students List</h3>

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
                <th style="width:10%;">Image</th>
                <th class="text-center">Student Name</th>
                <th class="text-center">GR No</th>
                <th class="text-center">Father Name</th>
                <th class="text-center">Father Phone #</th>
                <th class="text-center">Mother Phone #</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="subject-table">
              <?php $i = 1; if(!empty($Students)){foreach($Students as $STUS){ ?> 
              <tr>
                <td class="text-center"><?php if(!empty($i)){ echo $i; } ?></td>
                <td class="text-center"><img src="<?php if(!empty($STUS->StudentImage)){ echo base_url('uploads/Students/'.$STUS->StudentId.'/'.$STUS->StudentImage); }else{ echo base_url('assets/dist/images/studenticon.png'); } ?>" width="50" height="50"></td>
                <td class="text-center"><?php if(!empty($STUS->StudentName)){ echo $STUS->StudentName; } ?></td>
                <td class="text-center"><?php if(!empty($STUS->StudentGR)){ echo $STUS->StudentGR; } ?></td>
                <td class="text-center"><?php if(!empty($STUS->FatherName)){ echo $STUS->FatherName; } ?></td>
                <td class="text-center"><?php if(!empty($STUS->FatherPhone)){ echo $STUS->FatherPhone; } ?></td>
                <td class="text-center"><?php if(!empty($STUS->MotherPhone)){ echo $STUS->MotherPhone; } ?></td>
                
                <td class="text-center">
                    <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-warning cxm-btn-1 fs13" title="AddMarks" data-toggle="modal" data-target="#AddMarks" onclick = "AddMarks(<?php echo $STUS->StudentId; ?>,<?php echo $ClassId; ?>,<?php echo $SubjectId; ?>)"><span class="fas fa-edit"></span></button>

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

  
  <div class="modal fade" id="AddMarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="MarksModal">
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="updatemarks" onclick="UpdateMarks()">Save changes</button>
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
     function AddMarks(StudentId,ClassId,SubjectId) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#MarksModal").empty();
                    var edit_data = new FormData();
                      edit_data.append("StudentId", StudentId);
                      edit_data.append("ClassId", ClassId);
                      edit_data.append("SubjectId", SubjectId);
                      $.ajax({
                        url:"<?php echo base_url('Teacher/AddMarks/View'); ?>",
                        method:"POST",
                        dataType: 'JSON',
                        data: edit_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(editdetails)
                        {
                          var MarksId = 0;
                          var FirstExam = 0;
                          var SecondExam = 0;
                          var ThirdExam = 0;
                          var ExtraActivityExam = 0;
                          var Remarks = "No Remarks";
                          var Grade = "No Grade";

                          if(editdetails.data != null){ 
                              MarksId = editdetails.data['MarksId']; 
                              FirstExam = editdetails.data['FirstExam']; 
                              SecondExam = editdetails.data['SecondExam'];
                              ThirdExam = editdetails.data['ThirdExam'];
                              ExtraActivityExam = editdetails.data['ExtraActivityMarks'];
                              Remarks = editdetails.data['Remarks'];
                              Grade = editdetails.data['Grade'];
                            }
                            document.getElementById("MarksModal").innerHTML+= "<form action='#' method='post' id='cxm-assignment-form'>"+
                                       "    <div class='row'>"+
                                  "<input type='hidden' id='MarksId' value='"+MarksId+"'>"+
                                  "<input type='hidden' id='StudentId' value='"+StudentId+"'>"+
                                  "<input type='hidden' id='ClassId' value='"+ClassId+"'>"+
                                  "<input type='hidden' id='SubjectId' value='"+SubjectId+"'>"+
                                              "     <div class='col-sm-6'>"+
                                              "      <div class='form-group'>"+
                                              "         <label for='usr-nm'>First Exams Marks</label>"+
                                              "         <input type='number' id='FirstExam' class='form-control' placeholder='First Exams Marks' value='"+FirstExam+"' onkeyup='countmarks()'>"+
                                              "        <div id='due-vald'></div>"+
                                              "      </div>"+
                                              "   </div>"+
                                              "     <div class='col-sm-6'>"+
                                              "      <div class='form-group'>"+
                                              "         <label for='usr-nm'>Second Exams Marks</label>"+
                                              "         <input type='number' id='SecondExam' class='form-control' placeholder='Second Exams Marks' value='"+SecondExam+"' onkeyup='countmarks()'>"+
                                              "        <div id='due-vald'></div>"+
                                              "      </div>"+
                                              "   </div>"+
                                              "     <div class='col-sm-6'>"+
                                              "      <div class='form-group'>"+
                                              "         <label for='usr-nm'>Third/Final Exam</label>"+
                                              "         <input type='number' id='ThirdExam' class='form-control' placeholder='Third Exams Marks' value='"+ThirdExam+"' onkeyup='countmarks()'>"+
                                              "        <div id='due-vald'></div>"+
                                              "      </div>"+
                                              "   </div>"+
                                              "       <div class='col-sm-6'>"+
                                    "          <div class='form-group'>"+
                                     "            <label for='usr-nm'>Exrtra Activity Marks</label>"+
                                      "            <input type='number' id='ExtraActivityMarks' class='form-control' value='"+ExtraActivityExam+"' placeholder='Extra Activity Marks' onkeyup='countmarks()'>"+
                                           "       <div id='marks-vald'></div>"+
                                              " </div>"+
                                            "</div>"+
                                            "       <div class='col-sm-6'>"+
                                    "          <div class='form-group'>"+
                                     "            <label for='usr-nm'>Remarks</label>"+
                                      "            <input type='text' id='Remarks' class='form-control' value='"+Remarks+"' placeholder='Remarks'>"+
                                           "       <div id='marks-vald'></div>"+
                                              " </div>"+
                                            "</div>"+
                                            "       <div class='col-sm-6'>"+
                                    "          <div class='form-group'>"+
                                     "            <label for='usr-nm'>Grade</label>"+
                                      "            <input type='text' id='Grade' class='form-control' value='"+Grade+"' placeholder='Grade'>"+
                                           "       <div id='marks-vald'></div>"+
                                              " </div>"+
                                            "</div>"+
                                            "       <div class='col-sm-6'>"+
                                    "          <div class='form-group'>"+
                                     "            <label for='usr-nm'>Year</label>"+
                                      "            <select class='form-control select2' id='Year' style='width:100%;'>"+
                                                      "<option value='2012'>2012</option>"+
                                                      "<option value='2013'>2013</option>"+
                                                      "<option value='2014'>2014</option>"+
                                                      "<option value='2015'>2015</option>"+
                                                      "<option value='2016'>2016</option>"+
                                                      "<option value='2017'>2017</option>"+
                                                      "<option value='2018'>2018</option>"+
                                                      "<option value='2019'>2019</option>"+
                                                      "<option value='2020'>2020</option>"+
                                                      "<option value='2021'>2021</option>"+
                                                      "<option value='2022'>2022</option>"+
                                                      "<option value='2023'>2023</option>"+
                                                      "<option value='2024'>2024</option>"+
                                                      "<option value='2025'>2025</option>"+
                                                      "<option value='2026'>2026</option>"+
                                                      "<option value='2027'>2027</option>"+
                                                      "<option value='2028'>2028</option>"+
                                                      "<option value='2029'>2029</option>"+
                                                      "<option value='2030'>2030</option>"+
                                                "   </select>"+
                                           "       <div id='marks-vald'></div>"+
                                              " </div>"+
                                            "</div>"+
                                              "  </div>"+
                                              "   <div class='' id='SubmitMessage'></div> "+
                                              "    <div class='text-center'>"+
                                              "         <div role='status' id='SpinnerBorder'>"+
                                              "        </div>"+
                                              "     </div>"+
                                              "  </div>"+
                                              "  </form>";
                            
                                      if(editdetails.data != null){ 
                                        document.getElementById('Year').value = editdetails.data['Year'];
                                      }

                                      $('.select2').select2()
                        }
                      });
                  }

                  function countmarks(){
                    var FirstExam = $("#FirstExam").val();
                    var SecondExam = $("#SecondExam").val();
                    var ThirdExam = $("#ThirdExam").val();
                    var ExtraActivityMarks = $("#ExtraActivityMarks").val();
                    var TotalCount = eval(FirstExam) + eval(SecondExam) + eval(ThirdExam) + eval(ExtraActivityMarks);
                    if(TotalCount > 100){
                      $('#updatemarks').prop('disabled', true);
                    }else{
                      $('#updatemarks').prop('disabled', false);
                    }
                  }

          /**************** Insert Department Field Using Ajax *************/
              function UpdateMarks() {
                var MarksId = $("#MarksId").val();
                var StudentId = $("#StudentId").val();
                var ClassId = $("#ClassId").val();
                var SubjectId = $("#SubjectId").val();
                var FirstExam = $("#FirstExam").val();
                var SecondExam = $("#SecondExam").val();
                var ThirdExam = $("#ThirdExam").val();
                var Year = $("#Year").val();
                var Remarks = $("#Remarks").val();
                var Grade = $("#Grade").val();
                var ExtraActivityMarks = $("#ExtraActivityMarks").val();
                
                var form_data = new FormData();
                
                form_data.append("MarksId", MarksId);
                form_data.append("StudentId", StudentId);
                form_data.append("ClassId", ClassId);
                form_data.append("SubjectId", SubjectId);
                form_data.append("FirstExam", FirstExam);
                form_data.append("SecondExam", SecondExam);
                form_data.append("ThirdExam", ThirdExam);
                form_data.append("ExtraActivityMarks", ExtraActivityMarks);
                form_data.append("Year", Year);
                form_data.append("Remarks", Remarks);
                form_data.append("Grade", Grade);
                    $.ajax({
                  url:"<?php echo base_url('Teacher/AddMarks/Edit'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateMarks)
                  {
                    if (UpdateMarks.status == true) {
                      swal("Marks Add Successfully");
                      setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                      swal("Error : "+UpdateMarks.message);
                    }
                  }
                });
              } 

    </script>
    </body>
</html>
