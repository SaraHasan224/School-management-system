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
                <th style="width:10%;">ID</th>
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
                    <button class="btn btn-warning cxm-btn-1 fs13" title="Upload" data-toggle="modal" data-target="#UploadAssignment" onclick = "UploadAssignment(<?php echo $SUBJ->AssignmentId; ?>)"><span class="fas fa-upload"></span></button>
                    <button class="btn btn-warning cxm-btn-1 fs13" title="View Marks" onclick = "ViewMarks(<?php echo $SUBJ->AssignmentId; ?>)"><span class="fas fa-eye"></span></button>
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

  
  <div class="modal fade" id="UploadAssignment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload Assignment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="AssignmentModal">
 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="UpdateAssignment()">Upload</button>
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




     /**************Edit Insurance*********** */
     function UploadAssignment(Id) {
                    /**************** View Insurance Detail Using Ajax *************/
                    $("#AssignmentModal").empty();
                            document.getElementById("AssignmentModal").innerHTML+= "<form action='#' method='post' id='cxm-assignment-form'>"+
                                       "    <div class='row'>"+
                                  "<input type='hidden' id='AssignmentId' value='"+Id+"'>"+
                                     
                                      "<div class='form-row'>"+
                                         " <div class='col-sm-12 order-sm-9 pull-right'>"+
                                          "    <div class='avatar-upload'>"+
                                          "      <div class='avatar-edit'>"+
                                          "         <input type='file' id='imageUpload' />"+
                                          "         <label for='imageUpload'></label>"+
                                          "     </div>"+
                                          "   <div class='avatar-preview'>"+
                                          "       <div id='imagePreview' style='background-image:url(<?php  echo base_url('assets/dist/images/Syllabus.png'); ?>);'></div>  "+
                                          "   </div>"+
                                          " </div>"+
                                          " </div>"+
                                          "  </div>"+
                                              "  </div>"+
                                              "   <div class='' id='SubmitMessage'></div> "+
                                              "    <div class='text-center'>"+
                                              "         <div role='status' id='SpinnerBorder'>"+
                                              "        </div>"+
                                              "     </div>"+
                                              "  </div>"+
                                              "  </form>";
                            $("#UploadAssignment").modal('show');
                           
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
                          
                }


          /**************** Insert Department Field Using Ajax *************/
              function UpdateAssignment() {
                var AssignmentId = $("#AssignmentId").val();
                var form_data = new FormData();
                form_data.append("AssignmentId", AssignmentId);
                form_data.append("Assignment", document.getElementById('imageUpload').files[0]);  /*******add Email to form******* */
                    $.ajax({
                  url:"<?php echo base_url('Student/UploadAssignment'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(UpdateSyllabus)
                  {
                    if (UpdateSyllabus.status == true) {
                      swal("Assignment Upload Successfully");
                      setTimeout(function(){
                        location.reload(true);
                      }, 3000);
                    }else{
                      swal("Error : "+UpdateSyllabus.message);
                    }
                  }
                });
              } 


              function ViewMarks(id){
                var form_data = new FormData();
                form_data.append("AssignmentId", id);
                    $.ajax({
                  url:"<?php echo base_url('Student/ViewAssignment'); ?>",
                  method:"POST",
                  dataType: 'JSON',
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData: false,
                  success:function(ViewMarks)
                  {
                    if (ViewMarks.status == true) {
                      swal("Marks : "+ViewMarks.data);
                    }else{
                      swal("Error : "+ViewMarks.message);
                    }
                  }
                });
              }

    </script>
    </body>
</html>
