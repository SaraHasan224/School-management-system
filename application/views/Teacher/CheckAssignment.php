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
            <h1 class="m-0 text-dark">Assignment Marks</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Assignment Marks</li>
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
                <th class="text-center">Student Name</th>
                <th class="text-center">GR No</th>
                <th class="text-center">Assignment</th>
                <th class="text-center">Marks</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="subject-table">
              <?php $i = 1; if(!empty($Assignments)){foreach($Assignments as $ASSM){ 

              ?> 
              <tr>
                <td class="text-center"><?php if(!empty($i)){ echo $i; } ?></td>
                <td class="text-center"><?php if(!empty($ASSM->StudentName)){ echo $ASSM->StudentName; } ?></td>
                <td class="text-center"><?php if(!empty($ASSM->StudentGR)){ echo $ASSM->StudentGR; } ?></td>
                <td class="text-center"><a href="<?php if(!empty($ASSM->Assignment)){ echo $ASSM->Assignment; } ?>" title="Download Assignment"><i class="fa fa-download"></a></a></td>
                <td class="text-center"><?php if(!empty($ASSM->Marks)){ echo $ASSM->Marks; }else{ echo "0"; } ?></td>
                <td class="text-center"><button type="button" class="btn btn-warning cxm-btn-1 fs13" onclick="SubmitMarks(<?php echo $ASSM->UploadAssignmentId; ?>,<?php echo $ASSM->AssignmentId; ?>)"><i class="fa fa-pencil-alt"></i></button></td>
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


  function SubmitMarks(Id,assid){
    swal({
  text: 'Assignment Marks.',
  content: "input",
  button: {
    text: "Submit!",
    closeModal: false,
  },
})
.then(name => {
  if (!name) throw null;
                var form_data = new FormData();
                
                form_data.append("UploadAssignmentId", Id);
                form_data.append("AssignmentId", assid);
                form_data.append("Marks", name);
                $.ajax({
                  url:"<?php echo base_url('Teacher/AssignmentMarks'); ?>",
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
  
})
.then(results => {
  return results.json();
})
.then(json => {
 
})
.catch(err => {
  if (err) {
    swal("Oh noes!", "The AJAX request failed!", "error");
  } else {
    swal.stopLoading();
    swal.close();
  }
});
  }
    </script>
    </body>
</html>
