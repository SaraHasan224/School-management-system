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
            <h1 class="m-0 text-dark">Report Card</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Report Card</li>
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
    <table class="tableclass" style=" margin-top:5%;">
                <thead class="theadclass">
                <tr>
                    <td colspan="3" class="tdclass">Course </td>
                    <td rowspan="2" class="tdclass"> First Exam </td>
                    <td rowspan="2" class="tdclass"> Second Exam </td>
                    <td rowspan="2" class="tdclass"> Third Exam </td>
                    <td rowspan="2" class="tdclass"> Extra Activity </td>
                    <td rowspan="2" class="tdclass"> Remarks </td>
                    <td colspan="2" class="tdclass"> Grade </td>
                </tr>
                <tr>
                    <td>Code </td>
                    <td colspan="2" class="tdclass"> Name </td>
                    <td class="tdclass"> Grade </td>
                    <td class="tdclass"> Marks </td>
                </tr>
                </thead>
                <tbody class="tbodyclass">
                <?php $i = 1; $CompleteTotal = 0; if(!empty($Subjects)){ foreach($Subjects as $SUBJ){ 
                
                $FirstExam = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','FirstExam');

                $SecondExam = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','SecondExam');

                $ThirdExam = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','ThirdExam');

                $ExtraActivityMarks = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','ExtraActivityMarks');

                $Remarks = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','Remarks');

                $Grade = $this->Admindb->SingleRowField(['SubjectId'=>$SUBJ->SubjectId,'StudentId'=>$StudentId,'IsActive'=>true,'IsDeleted'=>false],'studentmarks','Grade');


                ?>
                <tr>
                    <td class="tdclass"><?php if(!empty($SUBJ->SubjectId)){ echo $SUBJ->SubjectId; } ?> </td>
                    <td colspan="2" class="tdclass"><?php if(!empty($SUBJ->SubjectName)){ echo $SUBJ->SubjectName; } ?> </td>
                    <td class="tdclass"> <?php if(!empty($FirstExam)){ echo $FirstExam; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($SecondExam)){ echo $SecondExam; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($ThirdExam)){ echo $ThirdExam; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($ExtraActivityMarks)){ echo $ExtraActivityMarks; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($Remarks)){ echo $Remarks; }else{ echo "Not Inserted"; } ?></td>
                    <td class="tdclass"> <?php if(!empty($Grade)){ echo $Grade; }else{ echo "Not Inserted"; } ?></td>
                    <?php 
                    if(!empty($FirstExam)){ $FirstExam = $FirstExam; }else{ $FirstExam = 0; }
                    if(!empty($SecondExam)){ $SecondExam = $SecondExam; }else{ $SecondExam = 0; }
                    if(!empty($ThirdExam)){ $ThirdExam = $ThirdExam; }else{ $ThirdExam = 0; }
                    if(!empty($ExtraActivityMarks)){ $ExtraActivityMarks = $ExtraActivityMarks; }else{ $ExtraActivityMarks = 0; }
                    $TotalMarks = 0;
                    $TotalMarks = $FirstExam + $SecondExam + $ThirdExam + $ExtraActivityMarks;
                    $CompleteTotal += $TotalMarks;
                    ?>
                    <td class="tdclass"> <?php if(!empty($TotalMarks)){ echo $TotalMarks; }else{ echo "0"; } ?></td>
                </tr>
                <?php $i++; }} ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                    <td class="tdclass"><b>Total</b></td>
                    <td class="tdclass"> <?php if(!empty($CompleteTotal)){ echo $CompleteTotal; }else{ echo "0"; } ?> </td>
                </tr>
            </table>
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


  




    </script>
    </body>
</html>
